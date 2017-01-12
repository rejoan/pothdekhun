<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Search extends MX_Controller {

    private $user_id = 4;

    public function __construct() {
        parent::__construct();
        $this->user_id = $this->session->user_id;
        $this->load->model('Search_model', 'sm');
        $this->latest_routes = $this->pm->latest_routes();
    }

    public function index() {
        $place = trim($this->input->get('sp', TRUE));
        $district = trim($this->input->get('ds', TRUE));
        $place_arr = explode(',', $place);
        $place_name = $place_arr[0];
        $thana = trim($place_arr[1]);
        $route = $this->sm->single_route($district, $thana, $place_name);
        $data = array(
            'title' => lang('transport'),
            'route' => $routes,
            'latest_routes' => $this->latest_routes,
            'settings' => $this->nl->get_config()
        );
        $this->nl->view_loader('user', 'index', NULL, $data, 'latest', 'rightbar');
    }

    public function routes() {
        $from_place = trim($this->input->get('f', TRUE));
        $from_district = trim($this->input->get('fd', TRUE));
        //echo $from_district;return;
        $from_thana = trim($this->input->get('ft', TRUE));
        $to_place = trim($this->input->get('t', TRUE));
        $to_district = trim($this->input->get('td', TRUE));
        $to_thana = trim($this->input->get('th', TRUE));
        $stopage_table = $this->nl->lang_based_data('stoppage_bn', 'stoppages');

        $routes = $this->sm->routes($from_district, $from_thana, $from_place, $to_district, $to_thana, $to_place);

        array_walk($routes, function(&$a) use($stopage_table) {
            $stoppage = $this->pm->get_data($stopage_table, FALSE, 'route_id', $a['r_id']);
            $a['stoppages'] = $this->nl->get_all_ids($stoppage,'place_name',TRUE);
        });

        $data = array(
            'title' => lang('search_result'),
            'routes' => $routes,
            'latest_routes' => $this->latest_routes,
            'settings' => $this->nl->get_config()
        );
        $this->nl->view_loader('user', 'index', NULL, $data, 'latest', 'rightbar');
    }

}
