<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Transport extends CI_Controller {

    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->library('Nuts_lib');
        $this->nuts_lib->lang_manager();
        $this->language = $this->session->language;
        $this->lang->load(array('controller', 'view'), $this->language);
        $this->load->model('Prime_model');
    }

    public function index() {
        $from_place = trim($this->input->get('f'), TRUE);
        $to_place = trim($this->input->get('t'), TRUE);
        $cond = array(
            'r.from_place' => $from_place,
            'r.to_place' => $to_place
        );
        $query = $this->db->select('r.from_place,r.to_place,r.type,r.vehicle_name,r.departure_place,r.departure_time,r.rent')->from('routes r')->where($cond)->get();

        $data = array(
            'title' => $this->lang->line('transport'),
            'transports' => $query->result_array()
        );
        $this->nuts_lib->view_loader('user', 'transports', $data, TRUE, 'latest_routes', 'rightbar');
    }

}
