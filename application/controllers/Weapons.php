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

    public function get_fplaces() {
        $typing = trim($this->input->get('typing', TRUE));
        $language = trim($this->input->get('lan', TRUE));
//        $direction = trim($this->input->get('direction', TRUE));
//        $column = 'from_place';
        $table = 'routes';
        

        if ($language == 'en') {
            $table = 'route_translation';
        }
//        if ($direction == 'to_place') {
//            $column = 'to_place';
//        }

        $sql = 'SELECT * FROM (SELECT to_place Location FROM '.$table.' UNION SELECT CONCAT_WS(", ",departure_place,from_place) FROM '.$table.') r WHERE Location LIKE "%'.$typing.'%" ORDER BY CASE WHEN Location LIKE "'.$typing.'%" THEN 0 WHEN Location LIKE "% %'.$typing.'% %" THEN 1 WHEN Location LIKE "%'.$typing.'%" THEN 2 ELSE 3 END LIMIT 8';

        $query = $this->db->query($sql);
        echo $this->db->last_query();
        $places = $query->result_array();
        $place_name = array();
        foreach ($places as $f) {
            $place_name[] = array(
                'pn' => $f['Location']
            );
        }
        echo json_encode($place_name, JSON_UNESCAPED_UNICODE);
    }

}
