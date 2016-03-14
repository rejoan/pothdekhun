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
        $direction = trim($this->input->get('direction', TRUE));
        $sql = ' r.to_district = ' . (int) $district;

        if ($direction == 'from_place') {
            $sql = ' r.from_district = ' . (int) $district;
        }

        $sql = 'SELECT * FROM routes r WHERE '. $sql . ' AND r.from_place LIKE "%' . $typing . '%" ORDER BY CASE WHEN r.from_place LIKE "' . $typing . '%" THEN 0 WHEN r.from_place LIKE "% %' . $typing . '% %" THEN 1 WHEN r.from_place LIKE "%' . $typing . '%" THEN 2 ELSE 3 END LIMIT 8';

        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        $places = $query->result_array();
        $place_name = array();
        foreach ($places as $f) {
            $place_name[] = array(
                'pn' => $f['Location']
            );
        }
        echo json_encode($place_name, JSON_UNESCAPED_UNICODE);
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
