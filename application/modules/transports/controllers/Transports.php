<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Transports extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        //echo 'done';return;
        $from_place = trim($this->input->get('f', TRUE));
        $from_district = trim($this->input->get('fd', TRUE));
        //echo $from_district;return;
        $from_thana = trim($this->input->get('ft', TRUE));
        $to_place = trim($this->input->get('t', TRUE));
        $to_district = trim($this->input->get('td', TRUE));
        $to_thana = trim($this->input->get('th', TRUE));

//        $filter_thana = ' AND from_thana = ' . (int) $thana;
//        if ($district == 1) {
//            $filter_thana = '';
//        }

        $sql = 'SELECT id,to_place,from_place,transport_type,rent
                FROM routes
                WHERE from_district = ' . $from_district . ' AND (from_place = "' . $from_place . '" OR to_place = "' . $from_place . '") AND to_district = ' . $to_district . ' AND  (from_place = "' . $to_place . '" OR to_place = "' . $to_place . '")';
//
//        if ($this->session->lang_code == 'bn') {
//            
//        }
        $query = $this->db->query($sql);

        //echo $this->db->last_query();return;
        $data = array(
            'title' => lang('transport'),
            'transports' => $query->result_array()
        );
        $this->nl->view_loader('user', 'transports', NULL, $data, 'latest_routes', 'rightbar');
    }

}
