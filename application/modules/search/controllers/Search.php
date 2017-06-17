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
        if (empty($district)) {
            redirect_tr('routes');
        }

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

        $stoppage_routes = $this->sm->place_stoppage_routes($place_name, $stopage_table, $district, 20, $segment, FALSE);
        //var_dump($stoppage_routes);return;
        array_walk($stoppage_routes, function(&$a) use($stopage_table) {
            $stoppage = $this->pm->get_data($stopage_table, FALSE, 's.route_id', $a['r_id'], FALSE, FALSE, FALSE, 'position', 'asc');
            $a['stoppages'] = $this->nl->get_all_ids($stoppage, 'place_name', TRUE);
        });

        $suggested_routes = $this->sm->place_get_suggestions($place_name, $stopage_table, $district, 20, $segment, FALSE);
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
            'total_route' => $total_rows,
            'load_script' => load_script(array('js' => 'jquery-3.2.1.min.js'))
        );
        $this->nl->view_loader('user', 'latest', NULL, $data, 'place_search', 'rightbar', 'menu', TRUE);
    }

    /**
     * main search
     */
    public function routes() {
        $per_page = 12;
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


        $exact_routes = $this->exact_routes($from_district, $from_thana, $from_place, $to_district, $to_thana, $to_place, $per_page, $segment);
        $total_rows = $this->sm->routes($from_district, $from_thana, $from_place, $to_district, $to_thana, $to_place, $per_page, $segment, TRUE);
        //var_dump($routes);return;
        $links = $this->nl->generate_pagination($url, $total_rows, $per_page, $num_links);

        array_walk($exact_routes, function(&$a) use($stopage_table) {
            $stoppage = $this->pm->get_data($stopage_table, FALSE, 's.route_id', $a['r_id'], FALSE, FALSE, FALSE, 'position', 'asc');
            $a['stoppages'] = $this->nl->get_all_ids($stoppage, 'place_name', TRUE);
        });
        $exclude_exact_ids = $this->nl->get_all_ids($exact_routes, 'r_id');
        //var_dump($excludes);return;
        $stoppage_routes = $this->stoppage_routes($from_place, $stopage_table, $to_place, $per_page, $segment, FALSE, $from_district, $to_district, $exclude_exact_ids);
        array_walk($stoppage_routes, function(&$a) use($stopage_table) {
            $stoppage = $this->pm->get_data($stopage_table, FALSE, 's.route_id', $a['r_id'], FALSE, FALSE, FALSE, 'position', 'asc');
            $a['stoppages'] = $this->nl->get_all_ids($stoppage, 'place_name', TRUE);
        });
        $exclude_stp_ids = $this->nl->get_all_ids($stoppage_routes, 'r_id');
        $exact_stopage = array_merge(array_filter(explode(',', $exclude_exact_ids)), array_filter(explode(',', $exclude_stp_ids)));
        if ($total_rows < 5) {
            $total_rows = $this->sm->stoppage_routes($from_place, $stopage_table, $to_place, $per_page, $segment, TRUE, $from_district, $to_district);
            if (empty($total_rows)) {
                $total_rows = 0;
            }
            $links = $this->nl->generate_pagination($url, $total_rows, $per_page, $num_links);
        }
        //var_dump($routes);return;
        $exact_stopage_ids = implode(',', $exact_stopage);
        //var_dump($exact_stopage_ids);return;
        $suggested_routes = $this->get_suggestions($from_place, $stopage_table, $to_place, $per_page, $segment, FALSE, $from_district, $to_district, $exact_stopage_ids);
        array_walk($suggested_routes, function(&$a) use($stopage_table) {
            $stoppage = $this->pm->get_data($stopage_table, FALSE, 's.route_id', $a['r_id'], FALSE, FALSE, FALSE, 'position', 'asc');
            $a['stoppages'] = $this->nl->get_all_ids($stoppage, 'place_name', TRUE);
        });

        $exclude_suggested_ids = $this->nl->get_all_ids($suggested_routes, 'r_id');
        $exact_stopage_suggested = array_merge(array_filter(explode(',', $exclude_exact_ids)), array_filter(explode(',', $exclude_stp_ids)), array_filter(explode(',', $exclude_suggested_ids)));
        //var_dump($exact_stopage_suggested);return;
        $exact_stopage_suggested_ids = implode(',', $exact_stopage_suggested);
        $possible_matches = $this->sm->possible_collections($from_place, $stopage_table, $to_place, 10, $segment, FALSE, $from_district, $to_district, $exact_stopage_suggested_ids);
        array_walk($possible_matches, function(&$a) use($stopage_table) {
            $stoppage = $this->pm->get_data($stopage_table, FALSE, 's.route_id', $a['r_id'], FALSE, FALSE, FALSE, 'position', 'asc');
            $a['stoppages'] = $this->nl->get_all_ids($stoppage, 'place_name', TRUE);
        });

        $fd = $this->pm->get_row('id', $from_district, 'districts');
        $td = $this->pm->get_row('id', $to_district, 'districts');
        $ft = $this->pm->get_row('id', $from_thana, 'thanas');
        $th = $this->pm->get_row('id', $to_thana, 'thanas');

        $c = $this->input->get('c', TRUE);
        $fthana = mb_convert_case($ft[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8') . ', ';
        $tthana = mb_convert_case($th[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8') . ', ';

        if ($c) {
            $fthana = lang('any_thana');
            $tthana = lang('any_thana');
        }
        
        $f_place = mb_convert_case($from_place, MB_CASE_TITLE, 'UTF-8') . ', ';
        if (empty($from_place)) {
            $f_place = '';
        }

        $t_place = mb_convert_case($to_place, MB_CASE_TITLE, 'UTF-8') . ', ';
        if (empty($to_place)) {
            $t_place = '';
        }

        $density_from = mb_convert_case($ft[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8');
        $density_to = mb_convert_case($th[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8');
        $route_table = $this->nl->lang_based_data('route_bn', 'routes');
        if (!empty($from_place)) {
            $density_from = $this->sm->get_density_word($from_place, $route_table, $stopage_table);
        }
        if (!empty($to_place)) {
            $density_to = $this->sm->get_density_word($to_place, $route_table, $stopage_table);
        }
        //var_dump($density_from,$density_to);return;
        $data = array(
            'title' => lang('transports_available') . ' ' . $f_place . $fthana . mb_convert_case($fd[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8') . ' ' . lang('to_view') . ' ' . $t_place . $tthana . mb_convert_case($td[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8'),
            'routes' => $exact_routes,
            'stoppage_routes' => $stoppage_routes,
            'suggested_routes' => $suggested_routes,
            'possible_matches' => $possible_matches,
            'from_place' => $f_place,
            'to_place' => $t_place,
            'fthana' => $fthana,
            'tthana' => $tthana,
            'fd' => $fd,
            'td' => $td,
            'ft' => $ft,
            'th' => $th,
            'settings' => $this->nl->get_config(),
            'links' => $links,
            'segment' => $segment,
            'total_rows' => $total_rows,
            'density_from' => $density_from,
            'density_to' => $density_to,
            'load_script' => load_script(array('js' => 'jquery-3.2.1.min.js'))
        );
        $this->nl->view_loader('user', 'latest', NULL, $data, 'index', 'rightbar', 'menu', TRUE);
    }

    public function exact_routes($from_district, $from_thana, $from_place, $to_district, $to_thana, $to_place, $per_page, $segment) {
        return $this->sm->routes($from_district, $from_thana, $from_place, $to_district, $to_thana, $to_place, $per_page, $segment);
    }

    public function stoppage_routes($from_place, $stopage_table, $to_place, $per_page, $segment, $pagination, $from_district, $to_district, $excludes) {
        return $this->sm->stoppage_routes($from_place, $stopage_table, $to_place, $per_page, $segment, $pagination, $from_district, $to_district, $excludes);
    }

    public function get_suggestions($from_place, $stopage_table, $to_place, $per_page, $segment, $pagination, $from_district, $to_district, $excludes) {
        return $this->sm->get_suggestions($from_place, $stopage_table, $to_place, $per_page, $segment, $pagination, $from_district, $to_district, $excludes);
    }

}
