<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Weapons extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
    }

    public function check_existence() {
        $field = trim($this->input->post('field', TRUE));
        $col = trim($this->input->post('col', TRUE));
        $table = trim($this->input->post('table', TRUE));
        $query = $this->db->select($col)->from($table)->where($col, $field)->get()->num_rows();
        if ($query > 0) {
            echo 'exist';
            return;
        }
    }

    public function get_places() {
        $typing = trim($this->input->get('typing', TRUE));
        $district = (int) trim($this->input->get('d', TRUE));
        $thana = (int) trim($this->input->get('t', TRUE));

        $to_thana = ' AND routes.to_thana = ' . $thana;
        $from_thana = ' AND routes.from_thana = ' . $thana;
        if ($district == 1) {//if dhaka no filer required for Thana
            $to_thana = '';
            $from_thana = '';
        }

        $sql = 'SELECT * FROM (
                    SELECT to_place as Location FROM routes WHERE to_district = ' . $district . $to_thana . ' AND to_place LIKE "%%' . $typing . '%%"
                    UNION DISTINCT
                    SELECT from_place FROM routes WHERE from_district = ' . $district . $from_thana . ' AND from_place LIKE "%%' . $typing . '%%"
                      ) as rtn
                    ORDER BY CASE WHEN
                     Location LIKE "' . $typing . '%" THEN 0 WHEN Location LIKE "% %' . $typing . '% %" THEN 1 WHEN Location LIKE "%' . $typing . '%" THEN 2 ELSE 3 END
                    LIMIT 7';


        if ($this->session->lang_code == 'bn') {// when searching in  bengali
            $sql = 'SELECT * FROM (
                    SELECT route_bn.to_place as Location FROM route_bn JOIN routes ON routes.id = route_bn.route_id WHERE to_district = ' . $district . $to_thana . ' AND route_bn.to_place LIKE "%%' . $typing . '%%"
                    UNION DISTINCT
                    SELECT route_bn.from_place FROM route_bn route_bn JOIN routes ON routes.id = route_bn.route_id WHERE from_district = ' . $district . $from_thana . ' AND route_bn.from_place LIKE "%%' . $typing . '%%"
                      ) as rtn 
                    GROUP BY Location
                    ORDER BY CASE WHEN
                     Location LIKE "' . $typing . '%" THEN 0 WHEN Location LIKE "% %' . $typing . '% %" THEN 1 WHEN Location LIKE "%' . $typing . '%" THEN 2 ELSE 3 END
                    LIMIT 7';
        }
        $query = $this->db->query($sql);
        //echo $this->db->last_query();return;
        $places = $query->result_array();
        echo json_encode($places, JSON_UNESCAPED_UNICODE);
    }

    /**
     * search place from homw page
     */
    public function search_places() {
        $typing = trim($this->input->get('typing', TRUE));
        $district = $this->input->get('d', TRUE);
        $sql = 'SELECT * FROM (
                    SELECT to_place as Location FROM routes WHERE to_district = ' . $district . ' AND to_place LIKE "%%' . $typing . '%%"
                    UNION DISTINCT
                    SELECT from_place FROM routes WHERE from_district = ' . $district . ' AND from_place LIKE "%%' . $typing . '%%"
                      ) as rtn
                    ORDER BY CASE WHEN
                     Location LIKE "' . $typing . '%" THEN 0 WHEN Location LIKE "% %' . $typing . '% %" THEN 1 WHEN Location LIKE "%' . $typing . '%" THEN 2 ELSE 3 END
                    LIMIT 7';

        if ($this->session->lang_code == 'bn') {// when searching in  bengali
            $sql = 'SELECT * FROM (
                    SELECT route_bn.to_place as Location FROM route_bn JOIN routes ON routes.id = route_bn.route_id WHERE to_district = ' . $district . ' AND route_bn.to_place LIKE "%%' . $typing . '%%"
                    UNION DISTINCT
                    SELECT route_bn.from_place FROM route_bn route_bn JOIN routes ON routes.id = route_bn.route_id WHERE from_district = ' . $district . ' AND route_bn.from_place LIKE "%%' . $typing . '%%"
                      ) as rtn 
                    GROUP BY Location
                    ORDER BY CASE WHEN
                     Location LIKE "' . $typing . '%" THEN 0 WHEN Location LIKE "%%' . $typing . '%%" THEN 1 WHEN Location LIKE "%' . $typing . '%" THEN 2 ELSE 3 END
                    LIMIT 7';
        }
        $query = $this->db->query($sql);
        //echo $this->db->last_query();return;
        $places = $query->result_array();
        echo json_encode($places, JSON_UNESCAPED_UNICODE);
    }

    public function get_thanas() {
        $district = (int) $this->input->get('district', TRUE);
        $name = $this->nl->lang_based_data('bn_name', 'name', ' thana');
        $query = $this->db->select('id,' . $name)->from('thanas')->where('district_id', $district)->get();
        //echo $this->db->last_query();return;
        $thanas = $query->result_array();
        echo json_encode($thanas, JSON_UNESCAPED_UNICODE);
    }

    public function get_transports() {
        $typing = $this->input->get('typing', TRUE);
        $lname = $this->nl->lang_based_data('bn_name', 'name');
        $name = $this->nl->lang_based_data('bn_name', 'name', ' poribohon');
        $this->db->select($name);
        $this->db->like($lname, $typing);
        $this->db->limit(5);
        $query = $this->db->get('poribohons');
        $transports = $query->result_array();
        echo json_encode($transports, JSON_UNESCAPED_UNICODE);
    }

    public function delete_stopage() {
        $this->load->library('encryption');
        $this->encryption->initialize(
                array(
                    'cipher' => 'des',
                    'mode' => 'ECB'
                )
        );
        $route_id = $this->encryption->decrypt($this->input->get('pri', TRUE));
        $place_name = trim($this->input->get('jaig', TRUE));
        $stoppage_table = $this->nl->lang_based_data('stoppage_bn', 'stoppages');

        $this->db->where('route_id', $route_id)->where('place_name', $place_name)->delete($stoppage_table);

        $this->db->query('SET @a = 0');
        $this->db->query('UPDATE ' . $stoppage_table . ' SET position = @a:=@a+1 WHERE route_id = ' . $route_id);
        echo json_encode(array('deleted' => 'done'));
    }

    public function check_duplicate() {
        $vehicle_name = trim($this->input->get('vh', TRUE));
        $from_place = trim($this->input->get('fp', TRUE));
        $to_place = trim($this->input->get('tp', TRUE));
        $edit_id = trim($this->input->get('pd', TRUE));
        //var_dump($edit_id);
        $cond = array(
            'r.from_place' => $from_place,
            'r.to_place' => $to_place,
            'p.name' => $vehicle_name
        );
        $this->db->select('r.id');
        $this->db->from('routes r');
        $this->db->join('route_bn rt', 'rt.route_id = r.id', 'left');
        $this->db->join('poribohons p', 'p.id = r.poribohon_id', 'left');
        if (!empty($edit_id)) {
            $this->load->library('encryption');
            $this->encryption->initialize(
                    array(
                        'cipher' => 'des',
                        'mode' => 'ECB'
                    )
            );
            $route_id = $this->encryption->decrypt($edit_id);
            //var_dump($route_id);
            $exclude = array($route_id);
            $this->db->where_not_in('r.id', $exclude);
        }
        $this->db->where($cond);
        $this->db->or_where('(r.id NOT IN(' . $route_id . ') AND rt.from_place = "' . $from_place . '" AND rt.to_place = "' . $to_place . '" AND p.bn_name = "' . $vehicle_name . '")', NULL, FALSE);

        $query = $this->db->get();
        //echo $this->db->last_query();
        echo json_encode(array('exist' => $query->num_rows()));
    }

    public function stoppage_search() {
        $typing = trim($this->input->get('typing', TRUE));
        $stoppages_table = $this->nl->lang_based_data('stoppage_bn', 'stoppages');
        $query = $this->db->query('SELECT place_name
                FROM ' . $stoppages_table . '
                WHERE place_name LIKE "%%' . $typing . '%%"
                GROUP BY place_name
                ORDER BY CASE WHEN
                 place_name LIKE "' . $typing . '%" THEN 0 WHEN place_name LIKE "%%' . $typing . '%%" THEN 1 WHEN place_name LIKE "%' . $typing . '%" THEN 2 ELSE 3 END
                LIMIT 5');
        $places = $query->result_array();
        echo json_encode($places, JSON_UNESCAPED_UNICODE);
    }

    public function update_meta() {
        $this->load->library('encryption');
        $this->encryption->initialize(
                array(
                    'cipher' => 'des',
                    'mode' => 'ECB'
                )
        );
        $route_id = $this->encryption->decrypt($this->input->post('pd_identity'));
        if (empty($route_id)) {
            echo json_encode(array('msg' => 'wrong'));
            return;
        }
        $user_id = $this->session->user_id;
        $cond = array(
            'user_id' => $user_id,
            'route_id' => $route_id
        );
        $query = $this->db->where($cond)->where('(fare_upvote = 1 OR fare_downvote = 1)', NULL, FALSE)->get('route_complains');
        if ($query->num_rows() > 0) {//if any feedback given earlier
            echo json_encode(array('msg' => 'exist'));
            return;
        }
        $pd_sts = $this->input->post('pd_sts', TRUE);
        $data = array(
            'fare_downvote' => 1,
            'user_id' => $user_id,
            'route_id' => $route_id
        );

        if ($pd_sts == 'pd_fpk') {//if upvote
            $data = array(
                'fare_upvote' => 1,
                'user_id' => $user_id,
                'route_id' => $route_id
            );
        }
        $query2 = $this->db->where($cond)->get('route_complains');
        $this->db->set('added', 'NOW()', FALSE);
        if ($query2->num_rows() > 0) {
            $row = $query2->row_array();
            $this->pm->updater('id', $row['id'], 'route_complains', $data);
            $insert = $row['id'];
        } else {
            $insert = $this->pm->insert_data('route_complains', $data, TRUE);
        }

        $vot = $this->pm->get_sum('route_id', $route_id, 'fare_downvote', 'route_complains');
        if ($pd_sts == 'pd_fpk') {//if upvote
            $vot = $this->pm->get_sum('route_id', $route_id, 'fare_upvote', 'route_complains');
        }
        if ($insert) {
            echo json_encode(array('msg' => 'updated', 'v' => $vot));
        }
    }

    public function transport_duplicacy() {
        $name = trim($this->input->post('name', TRUE));
        $query = $this->db->where('name', $name)->or_where('bn_name', $name)->get('poribohons');
        if ($query->num_rows() > 0) {
            echo json_encode(array('exist' => 'yes'));
            return;
        }
        echo json_encode(array('exist' => 'no'));
    }

    public function send_verification() {
        if (!$this->session->user_id) {
            echo json_encode(array('sent' => 'no'));
            return;
        }
        $user_id = $this->session->user_id;
        $this->load->library('encryption');
        $this->encryption->initialize(
                array(
                    'cipher' => 'des',
                    'mode' => 'ECB'
                )
        );
        $route_id = $this->encryption->decrypt($this->input->post('pd_identity', TRUE));
        $cond = array(
            'user_id' => $user_id,
            'route_id' => $route_id
        );
        $query = $this->db->where($cond)->get('route_complains');
        $status = trim($this->input->post('latest_status', TRUE));
        if ($status == 0 || empty($status)) {
            $status = NULL;
        }
        $note = trim($this->input->post('note', TRUE));
        $complain = array(
            'user_id' => $user_id,
            'route_id' => $route_id,
            'latest_status' => $status,
            'note' => $note
        );
        $sent = 'no';
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $this->pm->updater('id', $row['id'], 'route_complains', $complain);
            $sent = 'yes';
        } else {
            $insert_id = $this->pm->insert_data('route_complains', $complain, TRUE);
            if ($insert_id) {
                $sent = 'yes';
            }
        }
        echo json_encode(array('sent' => $sent));
    }

}
