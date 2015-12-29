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
        if ($language == 'en') {
            $query = $this->db->select('from_place,departure_place')->from('route_translation')->like('from_place', $typing)->or_like('departure_place', $typing)->get();
        } else {
            $query = $this->db->select('from_place,departure_place')->from('routes')->like('from_place', $typing)->or_like('departure_place', $typing)->get();
        }
        $from_places = $query->result_array();
        $place_name = array();
        foreach ($from_places as $f) {
            $place_name[] = array(
                'pn' => $f['from_place'],
                'dp' => $f['departure_place']
            );
        }
        echo json_encode($place_name,JSON_UNESCAPED_UNICODE);
    }

}
