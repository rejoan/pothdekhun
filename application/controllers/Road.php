<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Road extends CI_Controller {

    private $language;
    private $ln;
    private $user_id;

    public function __construct() {
        parent::__construct();
        $this->load->library('Nuts_lib');
        $this->nuts_lib->lang_manager();
        $this->language = $this->session->language;
        $this->ln = $this->session->ln;
        $this->user_id = (int) $this->session->user_id;
        $this->lang->load(array('controller_lang', 'view_lang'), $this->language);
        $this->load->model('Prime_model');
    }

    public function index() {
        $data = array(
            'title' => $this->lang->line('index'),
            'action_pull' => site_url('transport/index'),
            'action_groute' => site_url('road/add_route?ln=' . $this->ln)
        );

        $this->nuts_lib->view_loader('user', 'index', $data, TRUE, 'latest_routes', 'rightbar');
    }

    public function add_route() {
        $this->load->library('form_validation');
        $from_push = trim($this->input->post('from_push', TRUE));
        $to_push = trim($this->input->post('to_push', TRUE));
//        $user_ip = $this->input->ip_address();
//        $this->load->helper('geo');
//        //$customer_data = get_geolocation($user_ip);
//        $customer_data = get_geolocation('114.130.13.242');
//        if ($customer_data != 'down') {
//            $country = $customer_data['countryName'];
//            //$city = $customer_data['cityName'];
//        } else {
//            $country = 'api failed';
//            //$city = 'api failed';
//        }
        //var_dump($country);return;
        $data = array(
            'title' => $this->lang->line('add_route'),
            'action' => site_url('road/add_route'),
            'from_push' => $from_push,
            'to_push' => $to_push,
            'countries' => $this->nuts_lib->get_countries()
        );
        if (!$this->user_id) {
            $this->session->unset_userdata(array('from_login', 'to_login'));
            $this->session->set_userdata(array('from_login' => $from_push, 'to_login' => $to_push));
            redirect('users/login?add=yes');
        }
        if ($this->input->post('submit')) {
            $from = trim($this->input->post('from_place', TRUE));
            $to = trim($this->input->post('to_place', TRUE));
            $transport_type = $this->input->post('type', TRUE);
            $transport_name = $this->input->post('vehicle_name', TRUE);
            $departure_place = $this->input->post('departure_place', TRUE);
            $country = $this->input->post('country', TRUE);
            $departure_time = $this->input->post('departure_time', TRUE);
            $main_rent = $this->input->post('main_rent', TRUE);

            if ($departure_time == 'perticular') {
                $departure_time = $this->input->post('departure_dynamic', TRUE);
            }

            $config['upload_path'] = './evidences';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|docx|doc';
            $config['max_size'] = 1000;

            $this->load->library('upload', $config);
            if ($_FILES && $_FILES['evidence']['name']) {
                if (!$this->upload->do_upload('evidence')) {
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                    $this->nuts_lib->view_loader('user', 'add_route', $data, TRUE, 'latest_routes', 'rightbar');
                    return;
                } else {
                    $evidence = $this->upload->data();
                    $evidence_name = $evidence['file_name'];
                }
            } else {
                $evidence_name = '';
            }
//route data process
            $this->form_validation->set_rules('from_place', $this->lang->line('from_view'), 'required');
            $this->form_validation->set_rules('to_place', $this->lang->line('to_view'), 'required');
            $this->form_validation->set_rules('vehicle_name', $this->lang->line('vehicle_name'), 'required');
            $this->form_validation->set_rules('departure_place', $this->lang->line('departure_place'), 'required');
            $this->form_validation->set_rules('main_rent', $this->lang->line('main_rent'), 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->nuts_lib->view_loader('user', 'add_route', $data, TRUE, 'latest_routes', 'rightbar');
                return;
            }

            $route = array(
                'country' => $country,
                'from_place' => $from,
                'to_place' => $to,
                'type' => $transport_type,
                'vehicle_name' => $transport_name,
                'departure_place' => $departure_place,
                'departure_time' => $departure_time,
                'rent' => $main_rent,
                'evidence' => $evidence_name,
                'added_by' => $this->user_id
            );
            $this->db->set('added', 'NOW()', FALSE);
            $this->db->insert('routes', $route);

            $route_id = $this->db->insert_id();

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
            }
            redirect('road?ln=' . $this->ln);
        }
        $this->nuts_lib->view_loader('user', 'add_route', $data, TRUE, 'latest_routes', 'rightbar');
    }

    public function edit_route($id) {
        $this->nuts_lib->is_admin('road?ln=' . $this->ln);
        if ($this->ln == 'bn') {
            $route_table = 'routes';
            $stopage_table = 'stoppages';
            $update_id = 'id';
        } else {
            $route_table = 'route_translation';
            $stopage_table = 'stoppage_translation';
            $update_id = 'route_id';
        }
        if (!empty($id)) {
            $route_id = (int) $id;
            $query = $this->db->where('id', $route_id)->get($route_table);
        } else {
            show_404();
        }

        $this->load->library('form_validation');
        $q_stoppage = $this->db->where('route_id', $route_id)->get($stopage_table);
        $data = array(
            'title' => $this->lang->line('edit_route'),
            'action' => site_url('road/edit_route/' . $route_id),
            'countries' => $this->nuts_lib->get_countries(),
            'route' => $query->row_array(),
            'stoppages' => $q_stoppage->result_array()
        );

        if ($this->input->post('submit')) {
            $from = trim($this->input->post('from_place', TRUE));
            $to = trim($this->input->post('to_place', TRUE));
            $transport_type = $this->input->post('type', TRUE);
            $transport_name = $this->input->post('vehicle_name', TRUE);
            $departure_place = $this->input->post('departure_place', TRUE);
            $country = $this->input->post('country', TRUE);
            $departure_time = $this->input->post('departure_time', TRUE);
            $main_rent = $this->input->post('main_rent', TRUE);

            if ($departure_time == 'perticular') {
                $departure_time = $this->input->post('departure_dynamic', TRUE);
            }

            $config['upload_path'] = './evidences';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|docx|doc';
            $config['max_size'] = 1000;

            $this->load->library('upload', $config);
            if ($_FILES && $_FILES['evidence']['name']) {
                if (!$this->upload->do_upload('evidence')) {
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                    $this->nuts_lib->view_loader('user', 'add_route', $data, TRUE, 'latest_routes', 'rightbar');
                    return;
                } else {
                    $evidence = $this->upload->data();
                    $evidence_name = $evidence['file_name'];
                }
            } else {
                $evidence_name = '';
            }
//route data process
            $this->form_validation->set_rules('from_place', $this->lang->line('from_view'), 'required');
            $this->form_validation->set_rules('to_place', $this->lang->line('to_view'), 'required');
            $this->form_validation->set_rules('vehicle_name', $this->lang->line('vehicle_name'), 'required');
            $this->form_validation->set_rules('departure_place', $this->lang->line('departure_place'), 'required');
            $this->form_validation->set_rules('main_rent', $this->lang->line('main_rent'), 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->nuts_lib->view_loader('user', 'add_route', $data, TRUE, 'latest_routes', 'rightbar');
                return;
            }

            $route = array(
                'country' => $country,
                'from_place' => $from,
                'to_place' => $to,
                'type' => $transport_type,
                'vehicle_name' => $transport_name,
                'departure_place' => $departure_place,
                'departure_time' => $departure_time,
                'rent' => $main_rent,
                'evidence' => $evidence_name
            );
            $this->db->where($update_id, $route_id)->update($route_table, $route);

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
                $this->db->where('route_id', $route_id)->delete($stopage_table);
                $this->db->insert_batch('stoppages', $stoppages);
            }
            $this->session->set_flashdata('message', $this->lang->line('edit_success'));
            if ($this->nuts_lib->is_admin()) {
                redirect('routes');
            } else {
                redirect('my_routes');
            }
        }
        $this->nuts_lib->view_loader('user', 'add_route', $data, TRUE, 'latest_routes', 'rightbar');
    }

}
