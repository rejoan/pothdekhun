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
        $col_name = $this->nl->lang_based_data('bn_name', 'name');
        $data = array(
            'title' => lang('index'),
            'districts' => $this->rm->get_dthana('districts', $col_name),
            'thanas' => $this->rm->get_dthana('thanas', $col_name, 1),
            'action_transport' => site_url_tr('search/routes'),
            'search_action' => site_url_tr('search/index'),
            'settings' => $this->nl->get_config(),
            'meta_title' => lang('home_page_meta'),
            'load_script' => load_script(array('js' => 'jquery-3.2.1.min.js'))
        );

        $this->nl->view_loader('user', 'latest', NULL, $data, 'index', 'rightbar', 'menu', TRUE);
    }

    /**
     * Add a route
     * @return type
     */
    public function add() {
        $this->nl->is_logged();
        //$this->load->library('recaptcha');
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
            'load_css' => load_css(array('plugins/jQueryUI' => 'jquery-ui.min.css', 'bootstrap-sweetalert/dist' => 'sweetalert.css')),
            'load_script' => load_script(array('plugins/jQueryUI' => 'jquery-ui.min.js', 'js' => 'val_lib.js', 'bootstrap-sweetalert/dist' => 'sweetalert.min.js')),
            'script_init' => script_init(array('$(\'#stoppage_section\').sortable({placeholder: \'ui-state-highlight\'});'))
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
            $ac_non = $this->input->post('ac_non');
            $ac_type = $this->input->post('ac_type');
            $mail_local = $this->input->post('mail_local');
            $chair_semi = $this->input->post('chair_semi');

            $ac_type = ($ac_non == 'ac') ? ',' . $ac_type : '';
            $chair_semi = ($chair_semi == 'unknown') ? '' : ',' . $chair_semi;
            $mail_local = ($mail_local == 'unknown') ? '' : ',' . $mail_local;
            $amenities = $ac_non . $ac_type . $chair_semi . $mail_local;

            if ($departure_time != 1) {//if not consecutively
                $departure_time = trim($this->input->post('departure_dynamic', TRUE));
                $departure_time = nl2br($departure_time);
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
                        $this->nl->view_loader('user', 'latest', NULL, $data, 'add', 'rightbar', 'menu', TRUE);
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

            if ($this->form_validation->run() == FALSE) {
                $this->nl->view_loader('user', 'latest', NULL, $data, 'add', 'rightbar', 'menu', TRUE);
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
                'added_by' => $this->user_id,
                'amenities' => $amenities
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
        $this->nl->view_loader('user', 'latest', NULL, $data, 'add', 'rightbar', 'menu', TRUE);
    }

    public function captcha_check() {
        $captcha = $this->input->post('g-recaptcha-response');
        $this->load->library('recaptcha');
        $result = $this->recaptcha->recaptcha_check_answer($captcha);
        $this->form_validation->set_message('captcha_check', lang('auth_invalid_captcha'));
        return $result['success'];
    }

    /**
     * edit route & accept added route by user
     * @param int $id
     * @return type
     */
    public function edit($id) {
        $this->nl->is_logged();
        //check admin, if so then editable even is not published
        $this->pm->is_authorize($id);
        //load agent browser for edit view
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
        $css = array('bootstrap-sweetalert/dist' => 'sweetalert.css');
        $js = array('js' => 'jquery-3.2.1.min.js', 'js#' => 'val_lib.js', 'bootstrap-sweetalert/dist' => 'sweetalert.min.js');
        $init = array('$(\'.fancybox\').fancybox({slideShow  : false,thumbs : false,image : {preload : true,protect : true}});', '$(\'#stoppage_section\').sortable({placeholder: \'ui-state-highlight\'});');

        if ($this->ua->browser() != 'Firefox') {
            $css['plugins/fancybox'] = 'jquery.fancybox.min.css';
            $css['plugins/jQueryUI'] = 'jquery-ui.min.css';
            $js['plugins/fancybox'] = 'jquery.fancybox.min.js';
            $js['plugins/jQueryUI'] = 'jquery-ui.min.js';
        }
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
            'action_button' => lang('edit_button'),
            'load_css' => load_css($css),
            'load_script' => load_script($js),
            'script_init' => script_init($init)
        );
        if ($this->nl->is_admin() && $this->input->get('pd_rev')) {
            $data['point'] = modules::run('route_manager/calculate_point', $route_id);
        }

        if ($this->input->post('submit')) {
            //route data process
            $this->form_validation->set_rules('f', lang('from_view'), 'required');
            $this->form_validation->set_rules('t', lang('to_view'), 'required');
            $this->form_validation->set_rules('main_rent', lang('main_rent'), 'required|integer|greater_than[0]');
            if ($this->form_validation->run() == FALSE) {
                $this->nl->view_loader('user', 'latest', NULL, $data, 'add', 'rightbar', 'menu', TRUE);
                return;
            }

            $departure_time = $this->input->post('departure_time', TRUE);
            if ($departure_time != 1) {// if perticular time
                $departure_time = trim($this->input->post('departure_dynamic', TRUE));
                $departure_time = preg_replace('/(<br\s*\/?>\s*)+/', '<br/>', nl2br($departure_time));
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
                        $this->nl->view_loader('user', 'latest', NULL, $data, 'add', 'rightbar', 'menu', TRUE);
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
            $ac_non = $this->input->post('ac_non');

            $ac_type = $this->input->post('ac_type');
            $mail_local = $this->input->post('mail_local');
            $chair_semi = $this->input->post('chair_semi');

            $ac_type = ($ac_non == 'ac') ? ',' . $ac_type : '';
            $chair_semi = ($chair_semi == 'unknown') ? '' : ',' . $chair_semi;
            $mail_local = ($mail_local == 'unknown') ? '' : ',' . $mail_local;
            $amenities = $ac_non . $ac_type . $chair_semi . $mail_local;
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
                    'evidence2' => $evidence_name[2],
                    'amenities' => $amenities
                );
                if ($this->nl->is_admin()) {
                    $route['is_publish'] = 1;
                }
                $this->db->set('added', 'NOW()', FALSE);
            }

            if ($this->nl->is_admin()) {//if admin then direct approve/update
                $from_place = $route_detail['from_place'];
                $to_place = $route_detail['to_place'];
                if (ENVIRONMENT == 'production') {
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
                }
                //var_dump($route);return;
                $this->pm->updater($rid, $route_id, $route_table, $route, FALSE);
                //echo $this->db->last_query();
            } else {// send to temp table for review
                $edit_info = array(
                    'route_id' => $route_id,
                    'lang_code' => $this->session->lang_code,
                    'added_by' => $this->user_id
                );
                $route_info = array_merge($route, $edit_info);
                //var_dump($route_info);return;
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
                    if ($this->input->post('stoppage_update') == 'yes') {//if delete insert stoppage
                        $this->pm->deleter('route_id', $route_id, $stopage_table);
                        $this->db->insert_batch($stopage_table, $stoppages);
                    }
                    $this->session->set_flashdata('message', lang('edit_success'));
                } else {
                    $this->session->set_flashdata('message', lang('edit_success_user'));
                    $this->db->insert_batch('edited_stoppages', $stoppages);
                }
            }

            if ($this->input->post('point')) {
                $rut = $this->pm->get_row('id', $route_id, 'routes');
                modules::run('reputation/route_points', $route_id, $rut['added_by'], trim($this->input->post('point')), trim($this->input->post('note')));
                $msg = 'Earned <strong>' . $this->input->post('point') . '</strong> point for add <a href="' . site_url_tr('routes/show/' . $route_id) . '">Route</a>';
                modules::run('notifications/sent_notification', $rut['added_by'], $msg);
            }
            $this->column_log($route_id, $rut['added_by'], $this->input->post(), $evidence_name[1], $evidence_name[2], $this->user_id);
            redirect_tr('routes/all');
        }
        $this->nl->view_loader('user', 'latest', NULL, $data, 'add', 'rightbar', 'menu', TRUE);
    }

    public function column_log($route_id, $user_id, $post, $evidence, $evidence2, $edited_by, $insert = TRUE) {
        $route = $this->pm->get_row('id', $route_id, 'routes');
        $poribohons = $this->rm->get_transport($post['vehicle_name']);
        if ($route['from_dictrict'] == $post['fd']) {
            $fd = $user_id;
        } else {
            $fd = $edited_by;
        }
        if ($route['from_thana'] == $post['ft']) {
            $ft = $user_id;
        } else {
            $ft = $edited_by;
        }
        if ($route['to_dictrict'] == $post['td']) {
            $td = $user_id;
        } else {
            $td = $edited_by;
        }
        if ($route['to_thana'] == $post['th']) {
            $th = $user_id;
        } else {
            $th = $edited_by;
        }
        if ($route['from_place'] == $post['f']) {
            $f = $user_id;
        } else {
            $f = $edited_by;
        }
        if ($route['to_place'] == $post['t']) {
            $t = $user_id;
        } else {
            $t = $edited_by;
        }
        if ($route['rent'] == $post['main_rent']) {
            $rent = $user_id;
        } else {
            $rent = $edited_by;
        }
        if ($route['transport_type'] == $post['transport_type']) {
            $transport_type = $user_id;
        } else {
            $transport_type = $edited_by;
        }
        if ($route['departure_time'] == $post['departure_time']) {
            $departure_time = $user_id;
        } else {
            $departure_time = $edited_by;
        }
        if ($route['poribohon_id'] == $poribohons['id']) {
            $poribohon = $user_id;
        } else {
            $poribohon = $edited_by;
        }
        if ($route['evidence'] == $evidence) {
            $evidence = $user_id;
        } else {
            $evidence = $edited_by;
        }
        if (empty($route['evidence'])) {
            $evidence = '';
        }
        if ($route['evidence2'] == $evidence2) {
            $evidence2 = $user_id;
        } else {
            $evidence2 = $edited_by;
        }
        if (empty($route['evidence2'])) {
            $evidence2 = '';
        }
        $column_log = array(
            'route_id' => $route_id,
            'from_dictrict' => $fd,
            'from_thana' => $ft,
            'to_dictrict' => $td,
            'to_thana' => $th,
            'from_place' => $f,
            'to_place' => $t,
            'transport_type' => $transport_type,
            'poribohon' => $poribohon,
            'departure_time' => $departure_time,
            'rent' => $rent,
            'evidence' => $evidence,
            'evidence2' => $evidence2
        );
        if ($insert) {
            $this->pm->insert_data('column_logs', $column_log);
        } else {
            $this->pm->updater('route_id', $route_id, 'column_logs', $column_log);
        }
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
        if (!empty($id)) {
            $route_id = (int) $id;
        } else {
            show_404();
        }
        $stopage_table = $this->nl->lang_based_data('stoppage_bn', 'stoppages');

        $exist = $this->rm->details($route_id);
        if ($exist < 1) {
            $this->session->set_flashdata('message', lang('no_route'));
            redirect_tr('routes');
        }
        $result = $this->rm->details($route_id);


        //array_walk($result, function(&$a) use($route_id) {
        $result['fare_upvote'] = $this->pm->get_sum('route_id', $route_id, 'fare_upvote', 'route_complains');
        $result['fare_downvote'] = $this->pm->get_sum('route_id', $route_id, 'fare_downvote', 'route_complains');
        //});
        $from_place = mb_convert_case($result[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8');
        $from_district = mb_convert_case($result[$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8');
        if (mb_strtolower($from_place) == mb_strtolower($from_district) || ($result['distance'] / 1000) > 150) {
            $final_from = $from_district;
        } else {
            $final_from = $from_place . ', ' . $from_district;
        }
        $to_place = mb_convert_case($result[$this->nl->lang_based_data('tp_bn', 'to_place')], MB_CASE_TITLE, 'UTF-8');
        $to_district = mb_convert_case($result[$this->nl->lang_based_data('td_bn_name', 'td_name')], MB_CASE_TITLE, 'UTF-8');

        if (mb_strtolower($to_place) == mb_strtolower($to_district) || ($result['distance'] / 1000) > 150) {
            $final_to = $to_district;
        } else {
            $final_to = $to_place . ', ' . $to_district;
        }
        $next_q = $this->db->query('SELECT r.id,r.from_place,rt.from_place fp_bn,r.to_place,rt.to_place tp_bn,p.name,p.bn_name FROM routes r LEFT JOIN poribohons p ON p.id = r.poribohon_id LEFT JOIN route_bn rt ON rt.route_id = r.id WHERE r.id = (SELECT MIN(nr.id) FROM routes nr WHERE nr.id > ' . $route_id . ')');
        $prev_q = $this->db->query('SELECT r.id,r.from_place,rt.from_place fp_bn,r.to_place,rt.to_place tp_bn,p.name,p.bn_name FROM routes r LEFT JOIN poribohons p ON p.id = r.poribohon_id LEFT JOIN route_bn rt ON rt.route_id = r.id WHERE r.id = (SELECT MAX(nr.id) FROM routes nr WHERE nr.id < ' . $route_id . ')');

        $css = array('bootstrap-sweetalert/dist' => 'sweetalert.css');
        $js = array('bootstrap-sweetalert/dist' => 'sweetalert.min.js', 'js/bootstrap' => 'tooltip.min.js');
        $init = array('$(\'[data-toggle="tooltip"]\').tooltip();', '$(\'.fancybox\').fancybox({slideShow  : false,thumbs : false,image : {preload : true,protect : true}});');
        if ($this->ua->browser() != 'Firefox') {//if not firefox
            $css['plugins/fancybox'] = 'jquery.fancybox.min.css';
            $js['plugins/fancybox'] = 'jquery.fancybox.min.js';
        }
        $data = array(
            'title' => $final_from . ' ' . lang('to_view') . ' ' . $final_to . ' ' . mb_convert_case(get_tr_type($result['transport_type']), MB_CASE_TITLE, 'UTF-8') . ' ' . lang('service') . ' - ' . $result[$this->nl->lang_based_data('bn_name', 'name')] . ' - ' . lang('route_info'),
            'route' => $result,
            'stoppages' => $this->pm->get_data($stopage_table, NULL, 'route_id', (int) $result['r_id'], FALSE, FALSE, FALSE, 'position', 'asc'),
            'segment' => 0,
            'settings' => $this->nl->get_config(),
            'comments' => $this->rm->get_comments($route_id),
            'next' => $next_q->row_array(),
            'prev' => $prev_q->row_array(),
            'more_transports' => $this->more_transports($result),
            'load_css' => load_css($css),
            'load_script' => load_script($js),
            'script_init' => script_init($init)
        );

        $data['meta_title'] = $data['title'] . lang('meta_title_route');
        //echo $this->db->last_query();return;
        $this->nl->view_loader('user', 'latest', NULL, $data, 'details', 'rightbar', 'menu', TRUE);
    }

    public function more_transports($result) {
        $stopage_table = $this->nl->lang_based_data('stoppage_bn', 'stoppages', ' s');
        $exact = modules::run('search/exact_routes', $result['from_district'], $result['from_thana'], $result['from_place'], $result['to_district'], $result['to_thana'], $result['to_place'], 10, 0);
        $exact_ids = $this->nl->get_all_ids($exact, 'r_id');
        $exact_ids_arr = explode(',', $exact_ids);
        $stoppages = modules::run('search/stoppage_routes', $result['from_place'], $stopage_table, $result['to_place'], 10, 0, FALSE, $result['from_district'], $result['to_district'], NULL);
        $stoppages_ids = $this->nl->get_all_ids($stoppages, 'r_id');
        $stoppages_ids_arr = explode(',', $stoppages_ids);
        $suggestions = modules::run('search/get_suggestions', $result['from_place'], $stopage_table, $result['to_place'], 10, 0, FALSE, $result['from_district'], $result['to_district'], NULL, $result['from_thana'], $result['to_thana']);
        $suggestions_ids = $this->nl->get_all_ids($suggestions, 'r_id');
        $suggestions_ids_arr = explode(',', $suggestions_ids);
        $final_ids = array_filter(array_unique(array_merge($exact_ids_arr, $stoppages_ids_arr, $suggestions_ids_arr)));
        $pos = array_search($result['r_id'], $final_ids);

        unset($final_ids[$pos]);
        $final = implode(',', $final_ids);

        if (empty($final_ids)) {
            return array();
        }
        $this->db->select('r.id r_id, r.from_district, r.to_district, r.from_thana, r.to_thana, r.rent, r.evidence, r.evidence2, r.added, r.transport_type, r.from_place, r.to_place, r.from_latlong, r.to_latlong, r.distance, r.duration, p.name, p.bn_name, r.departure_time, u.username,t.name thana_name,t.bn_name thana_name_bn,th.name th_thana_name,th.bn_name th_thana_name_bn, d.name district_name, d.bn_name district_name_bn, td.name td_name, td.bn_name td_bn_name, rt.from_place fp_bn, rt.to_place tp_bn, rt.departure_time dt_bn, rt.translation_status');
        $this->db->from('routes r');
        $this->db->join('route_bn rt', 'r.id = rt.route_id', 'left');
        $this->db->join('poribohons p', 'r.poribohon_id = p.id', 'left');
        $this->db->join('districts d', 'r.from_district = d.id', 'left');
        $this->db->join('districts td', 'r.to_district = td.id', 'left');
        $this->db->join('thanas t', 'r.from_thana = t.id', 'left');
        $this->db->join('thanas th', 'r.to_thana = th.id', 'left');
        $this->db->join('users u', 'r.added_by = u.id', 'left');
        $this->db->where('r.is_publish = 1 AND  r.id IN(' . $final . ') AND (r.distance/1000) < 100', NULL, FALSE);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function map() {
        $fp = $this->input->get('fp');
        //echo $fp;return;
        $ftn = $this->input->get('ftn');
        $fds = $this->input->get('fds');
        $tp = $this->input->get('tp');
        $thn = $this->input->get('thn');
        $tdn = $this->input->get('tdn');
        $fp = $this->nl->dec($fp);

        if (empty($fp)) {
            $this->session->set_flashdata('message', 'Wrong');
            redirect_tr('routes');
        }
        $pure_thana = str_ireplace('sadar', '', $ftn);
        $pure_thana = trim($pure_thana, '+');
        //var_dump($pure_thana);return;
        $map_disctrict = $ftn . ',' . $fds;
        if ((mb_strtolower($ftn) == mb_strtolower($fds)) || (mb_strtolower($fds) == mb_strtolower($pure_thana))) {
            $map_disctrict = $fds;
        }
        $pure_tthana = str_ireplace('sadar', '', $thn);
        $pure_tthana = trim($pure_tthana, '+ ');
        //var_dump($tdn,$pure_tthana);return;
        $map_tdisctrict = $thn . ',' . $tdn;
        if ((mb_strtolower($thn) == mb_strtolower($tdn)) || (mb_strtolower($tdn) == mb_strtolower($pure_tthana))) {
            $map_tdisctrict = $tdn;
        }
        $final_from_str = $fp . ',' . $map_disctrict;
        $final_from = implode(',', array_unique(array_map('trim', explode(',', $final_from_str))));
        $final_to_str = $tp . ',' . $map_tdisctrict;
        $final_to = implode(',', array_unique(array_map('trim', explode(',', $final_to_str))));
        $dtx = stream_context_create(array('http' =>
            array(
                'timeout' => 10,
            )
        ));
        //var_dump($final_from_str,$final_to_str);return;
        $direction_api = @file_get_contents('https://maps.googleapis.com/maps/api/directions/json?origin=' . $final_from_str . ',Bangladesh&destination=' . $final_to_str . ',Bangladesh&key=&key=AIzaSyBgyMl_G_cjNrVViifqYU2DSi0SOc2H8bg', false, $dtx);
        $api_result = json_decode($direction_api);
        if (empty($api_result) || empty($api_result->routes->status)) {
            $final_from = $map_disctrict;
            $final_to = $map_tdisctrict;
        }
//        if (empty($api_result->routes->status)) {
//            $final_from = $map_disctrict;
//            $final_to = $map_tdisctrict;
//        }
        //var_dump($final_from, $final_to);return;
        redirect('https://www.google.com/maps/dir/' . $final_from . ',Bangladesh/' . $final_to . ',Bangladesh/', 'refresh');
    }

    /**
     * all routes list GRID
     */
    public function all() {
        $total_rows = $this->db->where('is_publish', 1)->get('routes')->num_rows();
        $per_page = 15;
        $num_links = 5;

        if ($this->input->get('page')) {
            $sgm = (int) trim($this->input->get('page'));
            $segment = $per_page * ($sgm - 1);
        } else {
            $segment = 0;
        }

        $d = trim($this->input->get('fd', TRUE));
        $t = trim($this->input->get('ft', TRUE));
        $i = trim($this->input->get('it', TRUE));
        $ttype = trim($this->input->get('t', TRUE));

        $url = 'routes/all?fd=' . $d . '&ft=' . $t . '&t=' . $ttype . '&it=' . $i;
        $links = $this->nl->generate_pagination($url, $total_rows, $per_page, $num_links);

        $district_id = $d;
        if (empty($d)) {
            $district_id = 1;
        }

        $data = array(
            'title' => lang('all_routes'),
            'routes' => $this->rm->get_all($per_page, $segment, $d, $t, $ttype, $i),
            'links' => $links,
            'segment' => $segment,
            'action' => site_url_tr('routes/all'),
            'settings' => $this->nl->get_config(),
            'districts' => $this->pm->get_data('districts'),
            'thanas' => $this->pm->get_data('thanas', FALSE, 'district_id', $district_id),
            'load_script' => load_script(array('js' => 'jquery-3.2.1.min.js', 'js/bootstrap' => 'tooltip.min.js')),
            'script_init' => script_init(array('$(\'[data-toggle="tooltip"]\').tooltip();'))
        );
        $this->nl->view_loader('user', 'latest', NULL, $data, 'routes', 'rightbar', 'menu', TRUE);
    }

    public function delete($id) {
        $this->nl->is_admin('errors', FALSE);
        $this->pm->deleter('id', $id, 'routes');
        $this->session->set_flashdata('message', lang('success_delete'));
        redirect_tr('routes/all');
    }

}
