<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Routes extends MX_Controller {

    private $user_id = 4;

    public function __construct() {
        parent::__construct();
        if ($this->session->user_id) {
            $this->user_id = $this->session->user_id;
        }
        $this->load->model('Routes_model', 'rm');
    }

    public function index() {
        //var_dump($this->session);return;
        $data = array(
            'title' => lang('index'),
            'name' => $this->nl->lang_based_data('bn_name', 'name'),
            'districts' => $this->pm->get_data('districts'),
            'thanas' => $this->pm->get_data('thanas', FALSE, 'district_id', 1),
            'action_transport' => site_url_tr('search/routes'),
            'search_action' => site_url_tr('search/index')
        );
        $this->nl->view_loader('user', 'index', NULL, $data, 'latest', 'rightbar');
    }

    /**
     * Add a route
     * @return type
     */
    public function add() {
        $this->load->library('form_validation');
        $fd = trim($this->input->post('fd', TRUE));
        $td = trim($this->input->post('td', TRUE));
        $ft = trim($this->input->post('ft', TRUE));
        $th = trim($this->input->post('th', TRUE));
        $fdistrict = $tdistrict = 1;
        if ($fd) {
            $fdistrict = (int) $fd;
        }

        if ($td) {
            $tdistrict = (int) $td;
        }

        $data = array(
            'title' => lang('add_route'),
            'action' => site_url_tr('routes/add'),
            'districts' => $this->pm->get_data('districts'),
            'fthanas' => $this->pm->get_data('thanas', FALSE, 'district_id', $fdistrict),
            'tthanas' => $this->pm->get_data('thanas', FALSE, 'district_id', $tdistrict),
            'name' => $this->nl->lang_based_data('bn_name', 'name')
        );

        if ($this->input->post('submit')) {
            $from = trim($this->input->post('f', TRUE));
            $to = trim($this->input->post('t', TRUE));
            $transport_type = $this->input->post('transport_type', TRUE);
            $transport_name = trim($this->input->post('vehicle_name', TRUE));
            $from_district = $fd;
            $from_thana = $ft;
            $to_district = $td;
            $to_thana = $th;
            $departure_time = $this->input->post('departure_time', TRUE);
            $main_rent = trim($this->input->post('main_rent', TRUE));

            if ($departure_time == 2) {
                $departure_time = $this->input->post('departure_dynamic', TRUE);
            }

            $config['upload_path'] = './evidences';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|docx|doc';
            $config['max_size'] = 1000;

            $this->load->library('upload', $config);
            if ($_FILES && $_FILES['evidence']['name']) {
                if (!$this->upload->do_upload('evidence')) {
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                    $this->nl->view_loader('user', 'add_route', $data, TRUE, 'latest', 'rightbar');
                    return;
                } else {
                    $evidence = $this->upload->data();
                    $evidence_name = $evidence['file_name'];
                }
            } else {
                $evidence_name = '';
            }
//route data process
            $this->form_validation->set_rules('f', lang('from_view'), 'required');
            $this->form_validation->set_rules('t', lang('to_view'), 'required');
            $this->form_validation->set_rules('main_rent', lang('main_rent'), 'required|integer');

            if ($this->form_validation->run() == FALSE) {
                $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
                return;
            }

            $transport_id = $this->pm->get_transport_id($transport_name, $this->user_id);
            //get thana and district name to get lat long data
            $faddress = $this->get_address($ft, $fd, $from);

            $taddress = $this->get_address($th, $td, $to);

            $floc = $this->nl->get_lat_long($faddress, 'Bangladesh');
            $tloc = $this->nl->get_lat_long($taddress, 'Bangladesh');
            //lat long end
            //var_dump($floc,$tloc);return;
            $route = array(
                'from_district' => $from_district,
                'from_thana' => $from_thana,
                'to_district' => $to_district,
                'to_thana' => $to_thana,
                'from_place' => $from,
                'to_place' => $to,
                'transport_type' => $transport_type,
                'poribohon_id' => $transport_id,
                'departure_time' => $departure_time,
                'rent' => $main_rent,
                'evidence' => $evidence_name,
                'added_by' => $this->user_id
            );
            if (!empty($floc) && !empty($tloc)) {//if lat long data found
                $route['from_latlong'] = $floc['lat'] . ',' . $floc['long'];
                $route['to_latlong'] = $tloc['lat'] . ',' . $tloc['long'];
            }
            $this->db->set('added', 'NOW()', FALSE);
            $this->db->insert('routes', $route);

            $route_id = $this->db->insert_id();
            $route_bn = array(
                'from_place' => $from,
                'to_place' => $to,
                'departure_time' => $departure_time,
                'route_id' => $route_id
            );
            $this->db->insert('route_bn', $route_bn);

//stoppage data process
            $rent = $this->input->post('rent', TRUE);
            $place_name = $this->input->post('place_name', TRUE);
            $comment = $this->input->post('comments', TRUE);
            $position = $this->input->post('position', TRUE);
            //var_dump($place_name[0]);return;
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

            if ($stoppages) {
                $this->db->insert_batch('stoppages', $stoppages);
                $this->db->insert_batch('stoppage_bn', $stoppages);
            }
            $this->session->set_flashdata('message', lang('route_save_success'));
            redirect_tr('routes/all');
        }
        $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
    }

    /**
     * edit route
     * @param int $id
     * @return type
     */
    public function edit($id) {
        //var_dump($this->session);return;
        $alias = 'r';
        $stopage_table = 'stoppages';
        $route_table = 'routes';
        $rid = 'id';
        //var_dump($this->session->lang_code);return;
        if ($this->session->lang_code == 'bn') {
            $alias = 'rt';
            $stopage_table = 'stoppage_bn';
            $route_table = 'route_bn';
            $rid = 'route_id';
        }

        if (!empty($id)) {
            $route_id = (int) $id;
            $q_edit = $this->pm->total_item('edited_routes', 'route_id', $route_id);
            if ($q_edit > 0) {//if already an edit submitted
                $this->session->set_flashdata('message', lang('already_edit_submitted'));
                redirect_tr('routes/all');
            }
            if ($this->rm->details($alias, $route_id, TRUE) < 1) {//if wrong ID given direct from URL
                $this->session->set_flashdata('message', 'Wrong Access');
                redirect_tr('routes');
            }
        } else {
            show_404();
        }

        $this->load->library('form_validation');
        $route = $this->rm->details($alias, $route_id);
        //var_dump($route);return;
        $data = array(
            'title' => lang('edit_route'),
            'districts' => $this->pm->get_data('districts'),
            'fthanas' => $this->pm->get_data('thanas', FALSE, 'district_id', $route['from_district']),
            'tthanas' => $this->pm->get_data('thanas', FALSE, 'district_id', $route['to_district']),
            'action' => site_url_tr('routes/edit/' . $route_id),
            'countries' => get_countries(),
            'route' => $route,
            'stoppages' => $this->pm->get_data($stopage_table, NULL, 'route_id', $route_id)
        );

        if ($this->input->post('submit')) {
            //route data process
            $this->form_validation->set_rules('f', lang('from_view'), 'required');
            $this->form_validation->set_rules('t', lang('to_view'), 'required');
            $this->form_validation->set_rules('main_rent', lang('main_rent'), 'required|integer|greater_than[0]');

            if ($this->form_validation->run() == FALSE) {
                $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
                return;
            }

            $departure_time = $this->input->post('departure_time', TRUE);
            if ($departure_time == 2) {// if perticular time
                $departure_time = $this->input->post('departure_dynamic', TRUE);
            }

            $transport_name = trim($this->input->post('vehicle_name', TRUE));
            $transport_id = $this->pm->get_transport_id($transport_name, $this->user_id);

            $config['upload_path'] = './evidences';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|docx|doc';
            $config['max_size'] = 1000;

            $this->load->library('upload', $config);
            if ($_FILES && $_FILES['evidence']['name']) {
                if (!$this->upload->do_upload('evidence')) {
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                    $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
                    return;
                } else {
                    $evidence = $this->upload->data();
                    $evidence_name = $evidence['file_name'];
                }
            } else {
                $evidence_name = '';
            }
            $fd = trim($this->input->post('fd', TRUE));
            $ft = trim($this->input->post('ft', TRUE));
            $td = trim($this->input->post('td', TRUE));
            $th = trim($this->input->post('th', TRUE));
            $from = trim($this->input->post('f', TRUE));
            $to = trim($this->input->post('t', TRUE));
            //get thana and district name to get lat long data


            $route = array(
                'from_place' => $from,
                'to_place' => $to,
                'departure_time' => $departure_time
            );

            if ($route_table == 'routes') {
                $route['from_district'] = $fd;
                $route['from_thana'] = $ft;
                $route['to_district'] = $td;
                $route['to_thana'] = $th;
                $route['poribohon_id'] = $transport_id;
                $route['transport_type'] = $th;
                $route['rent'] = $this->input->post('main_rent', TRUE);
                $route['evidence'] = $evidence_name;
                $route['added_by'] = $this->user_id;
                $this->db->set('added', 'NOW()', FALSE);
            }

            if ($this->session->user_type == 'admin') {//if admin then direct approve/update
                $faddress = $this->get_address($ft, $fd, $from);
                $taddress = $this->get_address($th, $td, $to);
                $floc = $this->nl->get_lat_long($faddress, 'Bangladesh');
                $tloc = $this->nl->get_lat_long($taddress, 'Bangladesh');
                if (!empty($floc) && !empty($tloc)) {//if lat long data found
                    $route['from_latlong'] = $floc['lat'] . ',' . $floc['long'];
                    $route['to_latlong'] = $tloc['lat'] . ',' . $tloc['long'];
                }
                $this->pm->updater($rid, $route_id, $route_table, $route);
                //echo $this->db->last_query();
            } else {// send to temp table for review
                $edit_info = array(
                    'route_id' => $route_id,
                    'lang_code' => $this->session->lang_code
                );
                $route_info = array_merge($route, $edit_info);
                $route_id = $this->pm->insert_data('edited_routes', $route_info, TRUE);
            }


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
                if ($this->session->user_type == 'admin') {
                    $this->pm->deleter('route_id', $route_id, $stopage_table);
                    $this->db->insert_batch($stopage_table, $stoppages);
                } else {
                    $this->db->insert_batch('edited_stoppages', $stoppages);
                }
            }
            $this->session->set_flashdata('message', lang('edit_success'));
            redirect_tr('routes/all');
        }
        $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
    }

    public function get_address($thana_id, $district_id, $mini_address) {
        $thana = $this->pm->get_row('id', $thana_id, 'thanas');
        $th_name = ',' . $thana['name'];
        if ($district_id == 1) {
            $th_name = '';
        }

        $district = $this->pm->get_row('id', $district_id, 'districts');
        $address = $mini_address . $th_name . ',' . $district['name'];
        return $address;
    }

    /**
     * show route details
     * @param int $id
     */
    public function show($id) {
        if (!empty($id)) {
            $route_id = (int) $id;
        } else {
            show_404();
        }
        $alias = 'rt';
        $stopage_table = 'stoppages';
        $lang_url = '/bn/';
        if ($this->session->lang_code == 'bn') {
            $alias = 'r';
            $stopage_table = 'stoppage_bn';
            $lang_url = '';
        }

        $exist = $this->rm->details($alias, $route_id, FALSE);
        if ($exist < 1) {
            $this->session->set_flashdata('message', lang('no_route'));
            redirect_tr('routes');
        }
        $result = $this->rm->details($alias, $route_id);
        //var_dump($result);        return;
        $data = array(
            'title' => $result['from_place'] . ' ' . lang('from_view') . ' ' . $result['to_place'] . ' ' . $result[$this->nl->lang_based_data('bn_name', 'name')] . ' ' . lang('route_info'),
            'route' => $result,
            'stoppages' => $this->pm->get_data($stopage_table, NULL, 'route_id', (int) $result['r_id']),
            'segment' => 0,
            'lang_url' => $lang_url
        );
        //echo $this->db->last_query();return;
        $this->nl->view_loader('user', 'details', NULL, $data, 'latest', 'rightbar');
    }

    /**
     * all routes list GRID
     */
    public function all() {
        $total_rows = $this->db->get('routes')->num_rows();
        $per_page = 10;
        $num_links = 5;

        if ($this->input->get('page')) {
            $sgm = (int) trim($this->input->get('page'));
            $segment = $per_page * ($sgm - 1);
        } else {
            $segment = 0;
        }
        $links = $this->nl->generate_pagination('routes/index', $total_rows, $per_page, $num_links);

        $data = array(
            'title' => 'All Routes',
            'routes' => $this->rm->get_all(),
            'links' => $links,
            'segment' => $segment
        );
        $this->nl->view_loader('user', 'routes', NULL, $data, 'latest', 'rightbar');
    }

    public function delete($id) {
        $this->pm->deleter('id', $id, 'routes');
        $this->session->set_flashdata('message', lang('success_delete'));
        redirect_tr('routes/all');
    }

    public function translate($id) {
        
    }

}
