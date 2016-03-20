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
        $alias = $this->nl->lang_based_data('rt','r');
        $filter_district = ' r.to_district = ' . (int) $district;
        $filter_thana = ' AND r.to_thana = ' . (int) $thana;


        if ($direction == 'from_place') {
            $filter_district = ' r.from_district = ' . (int) $district;
            $filter_thana = ' AND r.from_thana = ' . (int) $thana;
            if ($district == 1) {
                $filter_thana = '';
            }

            $sql = 'SELECT r.*,rt.* FROM routes r LEFT JOIN route_translation rt ON r.id = rt.route_id WHERE ' . $filter_district . $filter_thana . ' AND '.$alias.'.from_place LIKE "%' . $typing . '%" OR '.$alias.'.to_place LIKE "%' . $typing . '%" ORDER BY CASE WHEN '.$alias.'.from_place LIKE "' . $typing . '%" OR '.$alias.'.to_place LIKE "' . $typing . '%" THEN 0 WHEN '.$alias.'.from_place LIKE "% %' . $typing . '% %" OR '.$alias.'.to_place LIKE "% %' . $typing . '% %" THEN 1 WHEN '.$alias.'.from_place LIKE "%' . $typing . '%" OR '.$alias.'.to_place LIKE "%' . $typing . '%" THEN 2 ELSE 3 END LIMIT 8';
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
