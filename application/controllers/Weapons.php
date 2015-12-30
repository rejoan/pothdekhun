<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Weapons extends CI_Controller {

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

    public function get_fplaces() {
        $typing = trim($this->input->get('typing', TRUE));
        $language = trim($this->input->get('lan', TRUE));
        $direction = trim($this->input->get('direction', TRUE));
        $table = 'routes';
        $column = 'from_place';

        if ($language == 'en') {
            $table = 'route_translation';
        }
        if ($direction == 'to_place') {
            $column = 'to_place';
        }
        $sql = 'SELECT to_place,from_place,departure_place FROM ' . $table . ' WHERE from_place LIKE "%' . $typing . '%" OR to_place LIKE "%' . $typing . '%" OR departure_place LIKE "%' . $typing . '%" GROUP BY from_place ORDER BY CASE WHEN '.$column.' like "' . $typing . '%" THEN 0 WHEN '.$column.' like "% %' . $typing . '% %" THEN 1 WHEN '.$column.' like "%' . $typing . '%" THEN 2 ELSE 3 END LIMIT 10';
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        $places = $query->result_array();
        $place_name = array();
        foreach ($places as $f) {
            $place_name[] = array(
                'pn' => $f['from_place'],
                'tp' => $f['to_place'],
                'dp' => $f['departure_place']
            );
        }
        echo json_encode($place_name, JSON_UNESCAPED_UNICODE);
    }

}
