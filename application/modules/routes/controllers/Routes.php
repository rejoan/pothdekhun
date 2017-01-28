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
            'districts' => $this->pm->get_data('districts'),
            'thanas' => $this->pm->get_data('thanas', FALSE, 'district_id', 1),
            'action_transport' => site_url_tr('search/routes'),
            'search_action' => site_url_tr('search/index'),
            'settings' => $this->nl->get_config()
        );
        $this->nl->view_loader('user', 'index', NULL, $data, 'latest', 'rightbar');
    }

    /**
     * Add a route
     * @return type
     */
    public function add() {
        $this->nl->is_logged();
        $this->load->library('user_agent');
        $this->load->library('recaptcha');
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
            'action_button' => lang('add_button'),
            'districts' => $this->pm->get_data('districts'),
            'fthanas' => $this->pm->get_data('thanas', FALSE, 'district_id', $fdistrict),
            'tthanas' => $this->pm->get_data('thanas', FALSE, 'district_id', $tdistrict),
            'settings' => $this->nl->get_config(),
            'captcha' => $this->recaptcha->recaptcha_get_html()
        );

        if ($this->input->post('submit')) {
            $from = trim($this->input->post('f', TRUE));
            $to = trim($this->input->post('t', TRUE));
            $transport_type = $this->input->post('transport_type', TRUE);
            $transport_name = trim($this->input->post('vehicle_name', TRUE));
            $route_exist = $this->rm->check_duplicate($from, $to, $transport_name);
            if ($route_exist > 0) {
                $this->session->set_flashdata('message', lang('route_exist'));
                redirect_tr('routes/add');
            }
            $from_district = $fd;
            $from_thana = $ft;
            $to_district = $td;
            $to_thana = $th;
            $departure_time = $this->input->post('departure_time', TRUE);
            $main_rent = trim($this->input->post('main_rent', TRUE));

            if ($departure_time != 1) {//if not consecutively
                $departure_time = $this->input->post('departure_dynamic', TRUE);
            }

            $this->load->library('upload');
            $cpt = count($_FILES);
            $evidence_name = array();
            for ($f = 1; $f < ($cpt + 1); $f++) {
                $evidence_name[$f] = '';
                if (!empty($_FILES['evidence' . $f]['name'])) {
                    $config['upload_path'] = './evidences';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = 2500;
                    $new_name = time() . $_FILES['evidence' . $f]['name'];
                    $config['file_name'] = $new_name;
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('evidence' . $f)) {
                        $this->session->set_flashdata('message', $this->upload->display_errors());
                        $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
                        return;
                    } else {
                        $evidence = $this->upload->data();
                        $evidence_name[$f] = $evidence['file_name'];
                    }
                }
            }
            //var_dump($evidence_name);return;
//route data process
            $this->form_validation->set_rules('f', lang('from_view'), 'required');
            $this->form_validation->set_rules('t', lang('to_view'), 'required');
            $this->form_validation->set_rules('main_rent', lang('main_rent'), 'required|integer');
//            $captcha_response = $this->recaptcha->recaptcha_check_answer($this->input->post('g-recaptcha-response'));
//            if (!$captcha_response['success']) {
//                $this->session->set_flashdata('message', lang('auth_invalid_captcha'));
//                redirect_tr('routes/add');
//            }
            //$this->form_validation->set_rules('g-recaptcha-response', lang('security_code'), 'callback_captcha_check');

            if ($this->form_validation->run() == FALSE) {
                $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
                return;
            }
            $col_name_rev = $this->nl->lang_based_data('bn_name', 'name');
            $transport_id = $this->pm->get_transport_id($transport_name, $this->user_id, $col_name_rev);

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
                'evidence' => $evidence_name[1],
                'evidence2' => $evidence_name[2],
                'added_by' => $this->user_id
            );
            if ($this->session->user_type == 'admin') {
                $route['is_publish'] = 1;
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
            //var_dump($place_name[0]);return;
            $stoppages = array();
            for ($p = 0; $p < count($place_name); $p++) {
                if ($place_name[$p]) {
                    $stoppages[] = array(
                        'place_name' => $place_name[$p],
                        'comments' => $comment[$p],
                        'rent' => $rent[$p],
                        'route_id' => $route_id,
                        'position' => $p + 1
                    );
                }
            }

            if ($stoppages) {
                $this->db->insert_batch('stoppages', $stoppages);
                $this->db->insert_batch('stoppage_bn', $stoppages);
            }
            if ($this->session->user_type == 'admin') {
                $this->session->set_flashdata('message', lang('route_save_success'));
            } else {
                $this->session->set_flashdata('message', lang('route_sent_review'));
            }
            redirect_tr('routes/all');
        }
        $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
    }

    public function captcha_check() {
        $captcha = $this->input->post('g-recaptcha-response');
        $this->load->library('recaptcha');
        $result = $this->recaptcha->recaptcha_check_answer($captcha);
        $this->form_validation->set_message('captcha_check', lang('auth_invalid_captcha'));
        return $result['success'];
    }

    /**
     * edit route
     * @param int $id
     * @return type
     */
    public function edit($id) {
        $this->nl->is_logged();
        //check admin, if so then editable even is not published
        $this->pm->is_authorize($id);
        $this->load->library('user_agent');
        $this->load->library('encryption');
        $this->encryption->initialize(
                array(
                    'cipher' => 'des',
                    'mode' => 'ECB'
                )
        );

        $stopage_table = $this->nl->lang_based_data('stoppage_bn', 'stoppages');
        $route_table = $this->nl->lang_based_data('route_bn', 'routes');
        $rid = $this->nl->lang_based_data('route_id', 'id');

        if (!empty($id)) {
            $route_id = (int) $id;
            $q_edit = $this->pm->total_item('edited_routes', 'route_id', $route_id);
            if ($q_edit > 0) {//if already an edit submitted
                $this->session->set_flashdata('message', lang('already_edit_submitted'));
                redirect_tr('routes/all');
            }
            if ($this->rm->details($route_id, TRUE) < 1) {//if wrong ID given direct from URL
                $this->session->set_flashdata('message', 'Wrong Access');
                redirect_tr('routes');
            }
        } else {
            show_404();
        }

        $this->load->library('form_validation');
        $route_detail = $this->rm->details($route_id);
        //var_dump($route_detail);return;
        $data = array(
            'title' => lang('edit_route'),
            'districts' => $this->pm->get_data('districts'),
            'fthanas' => $this->pm->get_data('thanas', FALSE, 'district_id', $route_detail['from_district']),
            'tthanas' => $this->pm->get_data('thanas', FALSE, 'district_id', $route_detail['to_district']),
            'action' => site_url_tr('routes/edit/' . $route_id),
            'countries' => get_countries(),
            'route' => $route_detail,
            'stoppages' => $this->pm->get_data($stopage_table, FALSE, 'route_id', $route_id, FALSE, FALSE, FALSE, 'position', 'asc'),
            'settings' => $this->nl->get_config(),
            'action_button' => lang('edit_button')
        );
        if ($this->nl->is_admin()) {
            $data['point'] = modules::run('route_manager/calculate_point', $route_id);
        }

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
            if ($departure_time != 1) {// if perticular time
                $departure_time = $this->input->post('departure_dynamic', TRUE);
            }
            $from = trim($this->input->post('f', TRUE));
            $to = trim($this->input->post('t', TRUE));
            $transport_name = trim($this->input->post('vehicle_name', TRUE));
            $route_exist = $this->rm->check_duplicate($from, $to, $transport_name, TRUE, $route_id);
            if ($route_exist > 0) {
                $this->session->set_flashdata('message', lang('route_exist'));
                redirect_tr('routes/edit/' . $route_id);
            }
            $col_name_rev = $this->nl->lang_based_data('bn_name', 'name');
            $transport_id = $this->pm->get_transport_id($transport_name, $this->user_id, $col_name_rev, FALSE);


            $this->load->library('upload');
            $cpt = count($_FILES);
            $evidence_name = array();
            //first file
            $evidence_name[1] = trim($this->input->post('pd_pthm', TRUE));
            //second file
            $evidence_name[2] = trim($this->input->post('pd_pthmnx', TRUE));
            for ($f = 1; $f < ($cpt + 1); $f++) {
                if (!empty($_FILES['evidence' . $f]['name'])) {
                    $config['upload_path'] = './evidences';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = 2500;
                    $new_name = time() . $_FILES['evidence' . $f]['name'];
                    $config['file_name'] = $new_name;
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('evidence' . $f)) {
                        $this->session->set_flashdata('message', $this->upload->display_errors());
                        $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
                        return;
                    } else {
                        $file = 'evidences/' . $evidence_name[$f];
                        if ($this->nl->is_admin()) {
                            if (is_file($file)) {
                                unlink($file);
                            }
                        }

                        $evidence = $this->upload->data();
                        $evidence_name[$f] = $evidence['file_name'];
                    }
                }
            }
            $fd = trim($this->input->post('fd', TRUE));
            $ft = trim($this->input->post('ft', TRUE));
            $td = trim($this->input->post('td', TRUE));
            $th = trim($this->input->post('th', TRUE));

            //get thana and district name to get lat long data

            if ($this->session->lang_code == 'bn' && $this->nl->is_admin()) {
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
                    'evidence' => $evidence_name[1],
                    'evidence2' => $evidence_name[2]
                );
                if (!$this->input->post('point')) {//if not from admin review
                    $route['added_by'] = $this->user_id;
                }
                $this->db->set('added', 'NOW()', FALSE);
            }

            if ($this->nl->is_admin()) {//if admin then direct approve/update
                $from_place = $route_detail['from_place'];
                $to_place = $route_detail['to_place'];

                if (($this->session->lang_code == 'en') && (strtolower($from_place) != strtolower($from) || strtolower($to_place) != strtolower($to) || empty($route_detail['from_latlong']) || empty($route_detail['to_latlong']))) {
// if lat long not available OR from/to changed and lang is english
                    $faddress = $this->get_address($ft, $fd, $from);
                    $taddress = $this->get_address($th, $td, $to);
                    $fthana = $this->pm->get_row('id', $ft, 'thanas');
                    $fdis = $this->pm->get_row('id', $fd, 'districts');
                    $tthana = $this->pm->get_row('id', $th, 'thanas');
                    $tdis = $this->pm->get_row('id', $td, 'districts');
                    $floc = $this->nl->get_lat_long($faddress, 'Bangladesh', $fthana['name'], $fdis['name']);
                    $tloc = $this->nl->get_lat_long($taddress, 'Bangladesh', $tthana['name'], $tdis['name']);
                    //var_dump($faddress,$taddress,$floc,$tloc);return;
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
                $route['is_publish'] = 1;
                //var_dump($route);return;
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
            $stoppages = array();

            for ($p = 0; $p < count($place_name); $p++) {
                if ($place_name[$p]) {
                    $stoppages[] = array(
                        'place_name' => $place_name[$p],
                        'comments' => $comment[$p],
                        'rent' => $rent[$p],
                        'route_id' => $route_id,
                        'position' => $p + 1
                    );
                }
            }

            if (!empty($stoppages)) {
                if ($this->nl->is_admin()) {
                    $this->pm->deleter('route_id', $route_id, $stopage_table);
                    $this->db->insert_batch($stopage_table, $stoppages);
                    $this->session->set_flashdata('message', lang('edit_success'));
                } else {
                    $this->session->set_flashdata('message', lang('edit_success_user'));
                    $this->db->insert_batch('edited_stoppages', $stoppages);
                }
            }

            if ($this->input->post('point')) {
                $rut = $this->pm->get_row('id',$route_id,'routes');
                modules::run('route_manager/create_points', $route_id, $rut['added_by'], $this->input->post('point'), $this->input->post('note'));
            }

            redirect_tr('routes/all');
        }
        $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
    }

    /**
     * get address for google map API
     * @param int $thana_id
     * @param int $district_id
     * @param string $mini_address
     * @return string
     */
    public function get_address($thana_id, $district_id, $mini_address) {
        $thana = $this->pm->get_row('id', $thana_id, 'thanas');
        $th_name = ',' . $thana['name'];
        if ($district_id == 1) {
            $th_name = '';
        }

        $district = $this->pm->get_row('id', $district_id, 'districts');
        $dis = ',' . $district['name'];
        if (strtolower($mini_address) == strtolower($district['name'])) {
            $dis = '';
            $th_name = '';
        }
        $address = $mini_address . $th_name . $dis;
        return $address;
    }

    /**
     * show route details
     * @param int $id
     */
    public function show($id) {
        $this->load->library('form_validation');
        $this->load->library('encryption');
        $this->encryption->initialize(
                array(
                    'cipher' => 'des',
                    'mode' => 'ECB'
                )
        );
        if (!empty($id)) {
            $route_id = (int) $id;
        } else {
            show_404();
        }
        $stopage_table = $this->nl->lang_based_data('stoppage_bn', 'stoppages');

        $exist = $this->rm->details($route_id, FALSE);
        if ($exist < 1) {
            $this->session->set_flashdata('message', lang('no_route'));
            redirect_tr('routes');
        }
        $result = $this->rm->details($route_id);
        //var_dump($result);        return;
        $data = array(
            'title' => mb_convert_case($result[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8') . ' ' . lang('from_view') . ' ' . mb_convert_case($result[$this->nl->lang_based_data('tp_bn', 'to_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . $result[$this->nl->lang_based_data('bn_name', 'name')] . ' ' . lang('route_info'),
            'route' => $result,
            'stoppages' => $this->pm->get_data($stopage_table, NULL, 'route_id', (int) $result['r_id'], FALSE, FALSE, FALSE, 'position', 'asc'),
            'segment' => 0,
            'settings' => $this->nl->get_config(),
            'comments' => $this->rm->get_comments($route_id)
        );
        //echo $this->db->last_query();return;
        $this->nl->view_loader('user', 'details', NULL, $data, 'latest', 'rightbar');
    }

    /**
     * all routes list GRID
     */
    public function all() {
        $total_rows = $this->db->where('is_publish', 1)->get('routes')->num_rows();
        $per_page = 10;
        $num_links = 5;

        if ($this->input->get('page')) {
            $sgm = (int) trim($this->input->get('page'));
            $segment = $per_page * ($sgm - 1);
        } else {
            $segment = 0;
        }

        $d = trim($this->input->get('fd', TRUE));
        $t = trim($this->input->get('ft', TRUE));
        $ttype = trim($this->input->get('t', TRUE));

        $url = 'routes/all?fd=' . $d . '&ft=' . $t . '&t=' . $ttype;
        $links = $this->nl->generate_pagination($url, $total_rows, $per_page, $num_links);

        $district_id = $d;
        if (empty($d)) {
            $district_id = 1;
        }

        $data = array(
            'title' => lang('all_routes'),
            'routes' => $this->rm->get_all($per_page, $segment, $d, $t, $ttype),
            'links' => $links,
            'segment' => $segment,
            'settings' => $this->nl->get_config(),
            'districts' => $this->pm->get_data('districts'),
            'thanas' => $this->pm->get_data('thanas', FALSE, 'district_id', $district_id)
        );
        $this->nl->view_loader('user', 'routes', NULL, $data, 'latest', 'rightbar');
    }

    public function delete($id) {
        $this->nl->is_logged();
        $this->pm->deleter('id', $id, 'routes');
        $this->session->set_flashdata('message', lang('success_delete'));
        redirect_tr('routes/all');
    }

}
