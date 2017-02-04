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
        $exact_routes = $this->sm->get_routes($place_name, $district, FALSE, $per_page, $segment);
        //var_dump($exact_routes);return;
        $total_rows = $this->sm->get_routes($place_name, $district, TRUE);

        $url = 'search/index?ds=' . $district . '&f=' . $place;
        $links = $this->nl->generate_pagination($url, $total_rows, $per_page, $num_links);
        //var_dump($routes[1]);        return;
        array_walk($exact_routes, function(&$a) use($stopage_table) {
            $stoppage = $this->pm->get_data($stopage_table, FALSE, 's.route_id', $a['r_id'], FALSE, FALSE, FALSE, 'position', 'asc');
            $a['stoppages'] = $this->nl->get_all_ids($stoppage, 'place_name', TRUE);
        });

        $stoppage_routes = $this->sm->place_stoppage_routes($place_name, $stopage_table, $district, $per_page, $segment, FALSE);
       //var_dump($stoppage_routes);return;
        array_walk($stoppage_routes, function(&$a) use($stopage_table) {
            $stoppage = $this->pm->get_data($stopage_table, FALSE, 's.route_id', $a['r_id'], FALSE, FALSE, FALSE, 'position', 'asc');
            $a['stoppages'] = $this->nl->get_all_ids($stoppage, 'place_name', TRUE);
        });

        $suggested_routes = $this->sm->place_get_suggestions($place_name, $stopage_table, $district, $per_page, $segment, FALSE);
        array_walk($suggested_routes, function(&$a) use($stopage_table) {
            $stoppage = $this->pm->get_data($stopage_table, FALSE, 's.route_id', $a['r_id'], FALSE, FALSE, FALSE, 'position', 'asc');
            $a['stoppages'] = $this->nl->get_all_ids($stoppage, 'place_name', TRUE);
        });
        
     //var_dump($suggested_routes);return;
        $possible_matches = $this->sm->place_possible_collections($place_name, $stopage_table, $district, 10, $segment, FALSE);
        array_walk($possible_matches, function(&$a) use($stopage_table) {
            $stoppage = $this->pm->get_data($stopage_table, FALSE, 's.route_id', $a['r_id'], FALSE, FALSE, FALSE, 'position', 'asc');
            $a['stoppages'] = $this->nl->get_all_ids($stoppage, 'place_name', TRUE);
        });

        $data = array(
            'title' => lang('search_result'),
            'routes' => $exact_routes,
            'stoppage_routes' => $stoppage_routes,
            'suggested_routes' => $suggested_routes,
            'possible_matches' => $possible_matches,
            'd' => $this->pm->get_row('id', $district, 'districts'),
            'settings' => $this->nl->get_config(),
            'links' => $links,
            'total_route' => $total_rows
        );
        $this->nl->view_loader('user', 'latest', NULL, $data, 'place_search', 'rightbar', 'menu', TRUE);
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

        $exact_routes = $this->sm->routes($from_district, $from_thana, $from_place, $to_district, $to_thana, $to_place, $per_page, $segment);
        $total_rows = $this->sm->routes($from_district, $from_thana, $from_place, $to_district, $to_thana, $to_place, $per_page, $segment, TRUE);
        //var_dump($routes);return;
        $links = $this->nl->generate_pagination($url, $total_rows, $per_page, $num_links);

        array_walk($exact_routes, function(&$a) use($stopage_table) {
            $stoppage = $this->pm->get_data($stopage_table, FALSE, 's.route_id', $a['r_id'], FALSE, FALSE, FALSE, 'position', 'asc');
            $a['stoppages'] = $this->nl->get_all_ids($stoppage, 'place_name', TRUE);
        });

        $stoppage_routes = $this->sm->stoppage_routes($from_place, $stopage_table, $to_place, $per_page, $segment, FALSE, $from_district, $to_district);
        array_walk($stoppage_routes, function(&$a) use($stopage_table) {
            $stoppage = $this->pm->get_data($stopage_table, FALSE, 's.route_id', $a['r_id'], FALSE, FALSE, FALSE, 'position', 'asc');
            $a['stoppages'] = $this->nl->get_all_ids($stoppage, 'place_name', TRUE);
        });

        $suggested_routes = $this->sm->get_suggestions($from_place, $stopage_table, $to_place, $per_page, $segment, FALSE, $from_district, $to_district);
        array_walk($suggested_routes, function(&$a) use($stopage_table) {
            $stoppage = $this->pm->get_data($stopage_table, FALSE, 's.route_id', $a['r_id'], FALSE, FALSE, FALSE, 'position', 'asc');
            $a['stoppages'] = $this->nl->get_all_ids($stoppage, 'place_name', TRUE);
        });

        $possible_matches = $this->sm->possible_collections($from_place, $stopage_table, $to_place, 10, $segment, FALSE, $from_district, $to_district);
        array_walk($possible_matches, function(&$a) use($stopage_table) {
            $stoppage = $this->pm->get_data($stopage_table, FALSE, 's.route_id', $a['r_id'], FALSE, FALSE, FALSE, 'position', 'asc');
            $a['stoppages'] = $this->nl->get_all_ids($stoppage, 'place_name', TRUE);
        });

        $data = array(
            'title' => lang('search_result'),
            'routes' => $exact_routes,
            'stoppage_routes' => $stoppage_routes,
            'suggested_routes' => $suggested_routes,
            'possible_matches' => $possible_matches,
            'fd' => $this->pm->get_row('id', $from_district, 'districts'),
            'td' => $this->pm->get_row('id', $to_district, 'districts'),
            'ft' => $this->pm->get_row('id', $from_thana, 'thanas'),
            'th' => $this->pm->get_row('id', $to_thana, 'thanas'),
            'settings' => $this->nl->get_config(),
            'links' => $links,
            'segment' => $segment
        );
        $this->nl->view_loader('user', 'latest', NULL, $data, 'index', 'rightbar', 'menu', TRUE);
    }

    public function get_info() {
        $adds = str_replace(' ', '+', trim($address));
        $lat_long = array();
        //$json = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $adds . '&sensor=false&region=' . $country);
        $ctx = stream_context_create(array('http' =>
            array(
                'timeout' => 60,
            )
        ));

        $json = @file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $adds . ',' . $country . '&key=AIzaSyBgyMl_G_cjNrVViifqYU2DSi0SOc2H8bg', false, $ctx);

        $json = json_decode($json);
        //var_dump($json);return;
        if (empty($json) || empty($json->results)) {
            $prediction_api = @file_get_contents('https://maps.googleapis.com/maps/api/place/autocomplete/json?input=' . $adds . '&key=AIzaSyBgyMl_G_cjNrVViifqYU2DSi0SOc2H8bg', false, $ctx);
            $predictions = json_decode($prediction_api);
            //var_dump($thana,$district);return;
            if (empty($predictions->predictions)) {
                $json = @file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . str_replace(' ', '+', trim($thana)) . ',' . $district . ',' . $country . '&key=AIzaSyBgyMl_G_cjNrVViifqYU2DSi0SOc2H8bg', false, $ctx);

                $json = json_decode($json);
                //var_dump($json);return;
            } else {
                $place_id = $predictions->predictions[0]->place_id;

                //$first_prediction = $predictions->predictions[0]->description;

                $json = @file_get_contents('https://maps.googleapis.com/maps/api/place/details/json?placeid=' . $place_id . '&key=AIzaSyBgyMl_G_cjNrVViifqYU2DSi0SOc2H8bg', false, $ctx);

                $json = json_decode($json);
                $lat = $json->result->geometry->location->lat;
                $long = $json->result->geometry->location->lng;
                $lat_long['lat'] = $lat;
                $lat_long['long'] = $long;

                return $lat_long;
            }
        }
        //var_dump($json->results[0]->geometry);return;
        $lat = $json->results[0]->geometry->location->lat;
        $long = $json->results[0]->geometry->location->lng;
        $lat_long['lat'] = $lat;
        $lat_long['long'] = $long;

        return $lat_long;
    }

}
