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

        $total_rows = $this->sm->get_routes($from_district, $from_place, $to_district, $to_place, TRUE);
        $per_page = 10;
        $num_links = 5;

        if ($this->input->get('page')) {
            $sgm = (int) trim($this->input->get('page'));
            $segment = $per_page * ($sgm - 1);
        } else {
            $segment = 0;
        }
        $data = array(
            'title' => lang('transport'),
            'routes' => $routes,
            'links' => $this->nl->generate_pagination('search/routes', $total_rows, $per_page, $num_links)
        );
        $this->nl->view_loader('user', 'routes', 'routes', $data, 'latest', 'rightbar');
    }

}
