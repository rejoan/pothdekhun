<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Search extends MX_Controller {

    private $user_id;

    public function __construct() {
        parent::__construct();
        $this->user_id = $this->session->user_id;
    }

    public function index() {
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

        $sql = 'SELECT r.id,rt.to_place,rt.from_place,r.transport_type,rt.vehicle_name,r.rent
                FROM routes r LEFT JOIN route_translation rt ON r.id = rt.route_id
                WHERE r.from_district = ' . $from_district . ' AND (rt.from_place = "' . $from_place . '" OR rt.to_place = "' . $from_place . '") AND r.to_district = ' . $to_district . ' AND  (rt.from_place = "' . $to_place . '" OR rt.to_place = "' . $to_place . '")';


        if ($this->session->lang_code == 'bn') {
            $sql = 'SELECT id,to_place,from_place,transport_type,rent
                FROM routes
                WHERE from_district = ' . $from_district . ' AND (from_place = "' . $from_place . '" OR to_place = "' . $from_place . '") AND to_district = ' . $to_district . ' AND  (from_place = "' . $to_place . '" OR to_place = "' . $to_place . '")';
        }
        $query = $this->db->query($sql);

        //echo $this->db->last_query();return;
        $data = array(
            'title' => lang('transport'),
            'transports' => $query->result_array()
        );
        $this->nl->view_loader('user', 'transports', NULL, $data, 'latest', 'rightbar');
    }

}
