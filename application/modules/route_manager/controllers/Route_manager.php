<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Route_manager extends MX_Controller {

    private $user_id;

    public function __construct() {
        parent::__construct();
        $this->user_id = $this->session->user_id;
        $this->load->model('Route_manager_model', 'rmn');
    }

    /**
     * 
     */
    public function index() {
        $total_rows = $this->db->get('edited_routes')->num_rows();
        $per_page = 10;
        $num_links = 5;

        if ($this->input->get('page')) {
            $sgm = (int) trim($this->input->get('page'));
            $segment = $per_page * ($sgm - 1);
        } else {
            $segment = 0;
        }
        $links = $this->nl->generate_pagination('route_manager/index', $total_rows, $per_page, $num_links);
        $data = array(
            'title' => 'All Edited Routes',
            'routes' => $this->rmn->get_all(),
            'segment' => $segment,
            'links' => $links
        );
        $this->nl->view_loader('admin', 'index', 'route_manager', $data, 'leftbar', NULL, NULL);
    }

    /**
     * merge option with user edited things
     * @param int $id
     * @return type
     */
    public function merge($id = NULL) {
        if (!empty($id)) {
            $edited_route_id = (int) $id;
        } else {
            $edited_route_id = $this->input->post('route_id');
        }
        $edited_route = $this->rmn->edited_route($edited_route_id);
        $route_id = $edited_route['route_id']; //main route ID
        $col_name_rev = $this->nl->lang_based_data('bn_name', 'name', FALSE, $edited_route['lang_code']);
        $route_table = $this->nl->lang_based_data('route_bn', 'routes', FALSE, $edited_route['lang_code']);
        $stoppage_table = $this->nl->lang_based_data('stoppage_bn', 'stoppages', FALSE, $edited_route['lang_code']);
        $rid = $this->nl->lang_based_data('route_id', 'id', FALSE, $edited_route['lang_code']);
        $prev_route = $this->rmn->get_row($route_id);
        //var_dump($col_name,$col_name_rev);return;
        $data = array(
            'title' => lang('edit_route'),
            'action' => site_url_tr('route_manager/merge'),
            'districts' => $this->pm->get_data('districts'),
            'fthanas' => $this->pm->get_data('thanas', FALSE, 'district_id', $prev_route['from_district']),
            'tthanas' => $this->pm->get_data('thanas', FALSE, 'district_id', $prev_route['to_district']),
            'prev_route' => $prev_route,
            'prev_stoppages' => $this->pm->get_data($stoppage_table, FALSE, 'route_id', $route_id),
            'edited_route' => $edited_route,
            'edited_stoppages' => $this->pm->get_data('edited_stoppages', FALSE, 'route_id', $edited_route_id)
        );

        $this->load->library('form_validation');

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('f', lang('from_view'), 'required');
            $this->form_validation->set_rules('t', lang('to_view'), 'required');
            $this->form_validation->set_rules('main_rent', lang('main_rent'), 'required|integer|greater_than[0]');

            if ($this->form_validation->run() == FALSE) {
                $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
                return;
            }

            $departure_time = $this->input->post('departure_time', TRUE);
            if ($departure_time != 1) {
                $departure_time = $this->input->post('departure_dynamic', TRUE);
            }

            $fd = trim($this->input->post('fd', TRUE));
            $ft = trim($this->input->post('ft', TRUE));
            $td = trim($this->input->post('td', TRUE));
            $th = trim($this->input->post('th', TRUE));
            $from = trim($this->input->post('f', TRUE));
            $to = trim($this->input->post('t', TRUE));

            //var_dump($floc,$faddress);return;
            $transport_name = trim($this->input->post('vehicle_name', TRUE));
            $transport_id = $this->pm->get_transport_id($transport_name, $this->user_id, $col_name_rev);

            if ($edited_route['lang_code'] == 'bn') {
                $route = array(
                    'from_place' => $from,
                    'to_place' => $to,
                    'departure_time' => $departure_time
                );
            } else {

                $route = array(
                    'from_place' => $from,
                    'to_place' => $to,
                    'departure_time' => $departure_time,
                    'from_district' => $fd,
                    'from_thana' => $ft,
                    'to_district' => $td,
                    'to_thana' => $th,
                    'poribohon_id' => $transport_id,
                    'transport_type' => $this->input->post('transport_type', TRUE),
                    'rent' => $this->input->post('main_rent', TRUE),
                    'evidence' => $this->input->post('edited_file'),
                    'evidence2' => $this->input->post('edited_file2'),
                    'added_by' => $this->user_id,
                );

                $from_place = $edited_route['from_place'];
                $to_place = $edited_route['to_place'];
                if (($edited_route['lang_code'] == 'en') && (strtolower($from_place) != strtolower($from) || strtolower($to_place) != strtolower($to) || empty($prev_route['from_latlong']) || empty($prev_route['to_latlong']))) {

                    $faddress = modules::run('routes/get_address', $ft, $fd, $from);
                    $taddress = modules::run('routes/get_address', $th, $td, $to);
                    $floc = $this->nl->get_lat_long($faddress, 'Bangladesh');
                    $tloc = $this->nl->get_lat_long($taddress, 'Bangladesh');

                    if (!empty($floc) && !empty($tloc)) {//if lat long data found
                        $route['from_latlong'] = $floc['lat'] . ',' . $floc['long'];
                        $route['to_latlong'] = $tloc['lat'] . ',' . $tloc['long'];
                        $dis_dur = $this->nl->get_distance($route['from_latlong'], $route['to_latlong']);
                        if (!empty($dis_dur)) {
                            $route['distance'] = $dis_dur['distance'];
                            $route['duration'] = $dis_dur['duration'];
                        }
                    }
                }

                $this->db->set('added', 'NOW()', FALSE);
            }

            $this->pm->updater($rid, $route_id, $route_table, $route);


            //stoppage data process
            $rent = $this->input->post('rent', TRUE);
            $place_name = $this->input->post('place_name', TRUE);
            $comment = $this->input->post('comments', TRUE);
            $position = $this->input->post('position', TRUE);
            $stoppages = array();
            for ($p = 0; $p < count($place_name); $p++) {
                if ($place_name[$p]) {
                    $stoppages[] = array(
                        'place_name' => $place_name[$p],
                        'comments' => $comment[$p],
                        'rent' => $rent[$p],
                        'route_id' => $route_id,
                        'position' => $position[$p]
                    );
                }
            }

            if (!empty($stoppages)) {
                $this->pm->deleter('route_id', $route_id, $stoppage_table);
                $this->db->insert_batch($stoppage_table, $stoppages);
            }
            $this->pm->deleter('route_id', $route_id, 'edited_routes');
            $this->session->set_flashdata('message', lang('edit_success'));
            redirect_tr('route_manager');
        }

        $this->nl->view_loader('user', 'merge', NULL, $data);
    }

    /**
     * decline an edit
     * @param int $id
     */
    public function decline($id) {
        $route = $this->pm->get_row('id', $id, 'edited_routes');
        $file = 'evidences/' . $route['evidence'];
        $file = 'evidences/' . $route['evidence2'];
        //var_dump(is_file($file));return;
        if (is_file($file)) {
            unlink($file);
        }
        if (is_file($file2)) {
            unlink($file2);
        }
        $this->pm->deleter('id', $id, 'edited_routes');
        $this->session->set_flashdata('message', lang('delete_success'));
        redirect_tr('route_manager');
    }

    public function get_lat_long(){
        
    }
}
