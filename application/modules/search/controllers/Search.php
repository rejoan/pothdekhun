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
    }

    public function index() {
        $place = trim($this->input->get('f', TRUE));
        $district = trim($this->input->get('ds', TRUE));

        if (strpos($place, ',') !== false) {
            $place_name = trim(substr($place, 0, strrpos($place, ',')));
            $thana_name = trim(substr($place, strrpos($place, ',') + 1));
        } else {
            $place_name = $place;
            $thana_name = '';
        }


        $stopage_table = $this->nl->lang_based_data('stoppage_bn', 'stoppages', ' s');
        $per_page = 5;
        $num_links = 5;
        if ($this->input->get('page')) {
            $sgm = (int) trim($this->input->get('page'));
            $segment = $per_page * ($sgm - 1);
        } else {
            $segment = 0;
        }
        $routes = $this->sm->get_routes($district, $thana_name, $place_name, FALSE, $per_page, $segment);

        $total_rows = $this->sm->get_routes($district, $thana_name, $place_name, TRUE);


        $url = 'search/index?ds=' . $district . '&f=' . $place;
        $links = $this->nl->generate_pagination($url, $total_rows, $per_page, $num_links);
        //var_dump($routes[1]);        return;
        array_walk($routes[0], function(&$a) use($stopage_table) {
            $stoppage = $this->pm->get_data($stopage_table, FALSE, 's.route_id', $a['r_id'], FALSE, FALSE, FALSE, 'position', 'asc');
            $a['stoppages'] = $this->nl->get_all_ids($stoppage, 'place_name', TRUE);
        });
        $data = array(
            'title' => lang('search_result'),
            'routes' => $routes[0],
            'found_in' => $routes[1],
            'settings' => $this->nl->get_config(),
            'links' => $links,
            'total_route' => $total_rows
        );
        $this->nl->view_loader('user', 'index', NULL, $data, 'latest', 'rightbar');
    }

    public function routes() {
        $per_page = 10;
        $num_links = 5;

        if ($this->input->get('page')) {
            $sgm = (int) trim($this->input->get('page'));
            $segment = $per_page * ($sgm - 1);
        } else {
            $segment = 0;
        }

        $from_place = trim($this->input->get('f', TRUE));
        $from_district = trim($this->input->get('fd', TRUE));
        //echo $from_district;return;
        $from_thana = trim($this->input->get('ft', TRUE));
        $to_place = trim($this->input->get('t', TRUE));
        $to_district = trim($this->input->get('td', TRUE));
        $to_thana = trim($this->input->get('th', TRUE));

        $url = 'search/routes?fd=' . $from_district . '&ft=' . $from_thana . '&f=' . $from_place . '&td=' . $to_district . '&th=' . $to_thana . '&t=' . $to_place;


        $stopage_table = $this->nl->lang_based_data('stoppage_bn', 'stoppages', ' s');

        $routes = $this->sm->routes($from_district, $from_thana, $from_place, $to_district, $to_thana, $to_place, $stopage_table, $per_page, $segment);
        $total_rows = $this->sm->routes($from_district, $from_thana, $from_place, $to_district, $to_thana, $to_place, $stopage_table, $per_page, $segment, TRUE);
        //var_dump($routes);return;
        $links = $this->nl->generate_pagination($url, $total_rows, $per_page, $num_links);

        array_walk($routes[0], function(&$a) use($stopage_table) {
            $stoppage = $this->pm->get_data($stopage_table, FALSE, 's.route_id', $a['r_id'], FALSE, FALSE, FALSE, 'position', 'asc');
            $a['stoppages'] = $this->nl->get_all_ids($stoppage, 'place_name', TRUE);
        });

        $data = array(
            'title' => lang('search_result'),
            'routes' => $routes[0],
            'found_in' => $routes[1],
            'settings' => $this->nl->get_config(),
            'links' => $links,
            'segment' => $segment
        );
        $this->nl->view_loader('user', 'index', NULL, $data, 'latest', 'rightbar');
    }

}
