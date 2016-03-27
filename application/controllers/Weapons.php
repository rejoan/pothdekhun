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

    public function get_place() {
        $typing = trim($this->input->get('typing', TRUE));
        $district = trim($this->input->get('d', TRUE));
        $thana = trim($this->input->get('t', TRUE));
        $direction = trim($this->input->get('dir', TRUE));
        //$table = $this->nl->lang_based_data('routes', 'route_translation');
        $filter_district = ' WHERE to_district = ' . (int) $district;
        $filter_thana = ' AND to_thana = ' . (int) $thana;

        $fil_dist = ' routes.to_district = ' . (int) $district;
        $fil_thana = ' AND routes.to_thana = ' . (int) $thana;


        if ($direction == 'from_place') {
            $filter_district = ' WHERE from_district = ' . (int) $district;
            $filter_thana = ' AND from_thana = ' . (int) $thana;
            if ($district == 1) {
                $filter_thana = '';
            }

            $fil_dist = ' routes.from_district = ' . (int) $district;
            $fil_thana = ' AND routes.from_thana = ' . (int) $thana;
            if ($district == 1) {
                $fil_thana = '';
            }
        }
        $sql = 'SELECT Location FROM (
                    SELECT to_place as Location,route_id FROM route_translation
                    UNION ALL
                    SELECT from_place,route_id FROM route_translation
                      ) as rtn JOIN routes ON routes.id = rtn.route_id
                    WHERE ' . $fil_dist . $fil_thana . ' 
                    ORDER BY CASE WHEN
                     Location LIKE "' . $typing . '%" THEN 0 WHEN Location LIKE "% %' . $typing . '% %" THEN 1 WHEN Location LIKE "%' . $typing . '%" THEN 2 ELSE 3 END
                    LIMIT 8';

        if ($this->session->lang_code == 'bn') {
            $sql = 'SELECT * FROM (
                    SELECT to_place as Location FROM routes ' . $filter_district . $filter_thana . '
                    UNION ALL
                    SELECT from_place FROM routes
                      ) as rtn
                    ORDER BY CASE WHEN
                     Location LIKE "' . $typing . '%" THEN 0 WHEN Location LIKE "% %' . $typing . '% %" THEN 1 WHEN Location LIKE "%' . $typing . '%" THEN 2 ELSE 3 END
                    LIMIT 8';
        }



        $query = $this->db->query($sql);
        //echo $this->db->last_query();return;
        $places = $query->result_array();
        echo json_encode($places, JSON_UNESCAPED_UNICODE);
//        $place_name = array();
//        foreach ($places as $f) {
//            $place_name[] = array(
//                'pn' => $f['Location']
//            );
//        }
//        echo json_encode($place_name, JSON_UNESCAPED_UNICODE);
    }

    public function get_thanas() {
        $district = (int) $this->input->get('district', TRUE);
        $name = $this->nl->lang_based_data('bn_name', 'name', ' thana');
        $query = $this->db->select('id,' . $name)->from('thanas')->where('district_id', $district)->get();
        //echo $this->db->last_query();return;
        $thanas = $query->result_array();
        echo json_encode($thanas);
    }

}
