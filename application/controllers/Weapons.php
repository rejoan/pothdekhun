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

    public function search_places() {
        $typing = trim($this->input->get('typing', TRUE));
        $district = (int) trim($this->input->get('d', TRUE));

        $sql = 'SELECT *
                FROM (
                SELECT t.name Thana,r.to_place Location
                FROM routes r LEFT JOIN thanas t ON t.id = r.to_thana
                WHERE r.to_district = ' . $district . ' UNION DISTINCT
                SELECT ft.name Thana,sr.from_place
                FROM routes sr LEFT JOIN thanas ft ON ft.id = sr.from_thana
                WHERE sr.from_district = ' . $district . '
                ) AS rtn
                ORDER BY CASE WHEN
                 Location LIKE "' . $typing . '%" THEN 0 WHEN Location LIKE "% %' . $typing . '% %" THEN 1 WHEN Location LIKE "%' . $typing . '%" THEN 2 ELSE 3 END LIMIT 7';


        if ($this->session->lang_code == 'bn') {// when searching in  bengali
            $sql = 'SELECT *
                    FROM (
                    SELECT t.bn_name Thana,rt.to_place Location
                    FROM route_bn rt
                    LEFT JOIN routes r ON r.id = rt.route_id
                    LEFT JOIN thanas t ON t.id = r.to_thana
                    WHERE r.to_district = ' . $district . '
                     UNION DISTINCT
                    SELECT ft.bn_name Thana,rb.from_place
                    FROM route_bn rb
                    LEFT JOIN routes fr ON fr.id = rb.route_id
                    LEFT JOIN thanas
                     ft ON ft.id = fr.from_thana
                    WHERE fr.from_district = ' . $district . '
                    ) AS rtn

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
        $route_id = $this->input->get('pri', TRUE);
        $place_name = trim($this->input->get('jaig', TRUE));

        $this->db->where('route_id', $route_id)->where('place_name', $place_name)->delete('stoppages');
        $this->db->where('route_id', $route_id)->where('place_name', $place_name)->delete('stoppage_bn');
        $this->db->query('SET @a = 0');
        $this->db->query('UPDATE stoppages SET position = @a:=@a+1 WHERE route_id = ' . $route_id);
        $this->db->query('SET @a = 0');
        $this->db->query('UPDATE stoppage_bn SET position = @a:=@a+1 WHERE route_id = ' . $route_id);
    }

    public function check_duplicate() {
        $vehicle_name = trim($this->input->get('vh', TRUE));
        $from_place = trim($this->input->get('fp', TRUE));
        $to_place = trim($this->input->get('tp', TRUE));
        $edit_id = $this->uri->segment(3);
        var_dump($edit_id);
        $cond = array(
            'r.from_place' => $from_place,
            'r.to_place' => $to_place,
            'p.name' => $vehicle_name
        );
        $or_cond = array(
            'rt.from_place' => $from_place,
            'rt.to_place' => $to_place,
            'p.bn_name' => $vehicle_name
        );
        $this->db->select('r.id');
        $this->db->from('routes r');
        $this->db->join('route_bn rt', 'rt.route_id = r.id', 'left');
        $this->db->join('poribohons p', 'p.id = r.poribohon_id', 'left');
        $this->db->where($cond);
        $this->db->or_where($or_cond);
        if (!empty($edit_id)) {
            $exclude = array($edit_id);
            $this->db->where_not_in('r.id', $exclude);
        }
        $query = $this->db->get();
        echo $this->db->last_query();
        echo json_encode(array('exist' => $query->num_rows()));
    }

}
