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
        $this->load->model('Search_model', 'sm');
		$this->latest_routes = $this->pm->latest_routes();
    }

    public function index() {
        
    }

    public function routes() {
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

        $routes = $this->sm->get_routes($from_district, $from_place, $to_district, $to_place);

        $data = array(
            'title' => lang('transport'),
            'routes' => $routes,
            'links' => '',
			'latest_routes' => $this->latest_routes,
            'settings' => $this->nl->get_config(),
            'segment' => 0
        );
        $this->nl->view_loader('user', 'routes', 'routes', $data, 'latest', 'rightbar');
    }

}
