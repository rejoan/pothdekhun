<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Route extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array(
            'title' => $this->lang->line('index'),
            'action_pull' => site_url('transport/index?ln=' . $this->ln),
            'action_groute' => site_url('route/add?ln=' . $this->ln)
        );

        $this->nuts_lib->view_loader('user', 'index', $data, TRUE, 'latest_routes', 'rightbar');
    }

    public function add() {
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
            'action' => site_url('route/add'),
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
            $this->form_validation->set_rules('departure_place', $this->lang->line('departure_place'), 'required|is_unique[routes.departure_place]');
            $this->form_validation->set_rules('main_rent', $this->lang->line('main_rent'), 'required|integer');

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
            $route_eng = array(
                'from_place' => $from,
                'to_place' => $to,
                'vehicle_name' => $transport_name,
                'departure_place' => $departure_place,
                'departure_time' => $departure_time,
                'route_id' => $route_id
            );
            $this->db->insert('route_translation', $route_eng);

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
                $this->db->insert_batch('stoppage_translation', $stoppages);
            }
            redirect('route?ln=' . $this->ln);
        }
        $this->nuts_lib->view_loader('user', 'add_route', $data, TRUE, 'latest_routes', 'rightbar');
    }

    public function edit($id) {
        if ($this->input->get('ln') == 'en') {
            $alias = 'rt';
            $stopage_table = 'stoppage_translation';
        } else {
            $alias = 'r';
            $stopage_table = 'stoppages';
        }
        if (!empty($id)) {
            $route_id = (int) $id;
            $query = $this->db->select('r.id,' . $alias . '.from_place,' . $alias . '.to_place,r.type,' . $alias . '.vehicle_name,' . $alias . '.departure_place,' . $alias . '.departure_time,r.rent,r.evidence,r.added,r.is_publish')->from('routes r')->join('route_translation rt', 'r.id = rt.route_id', 'left')->where('r.added_by', $this->user_id)->where('r.id', $route_id)->get();
            $q_edit = $this->db->where('route_id', $route_id)->get('edited_routes')->num_rows();
            if ($q_edit > 0) {
                $this->session->set_flashdata('message', $this->lang->line('already_edit_submitted'));
                redirect('profile/my_routes?ln=' . $this->ln);
            }
            if ($query->num_rows() < 1) {
                $this->session->set_flashdata('message', 'Wrong Access');
                redirect('profile/my_routes?ln=') . $this->ln;
            }
        } else {
            show_404();
        }

        $this->load->library('form_validation');
        $q_stoppage = $this->db->where('route_id', $route_id)->get($stopage_table);
        $data = array(
            'title' => $this->lang->line('edit_route'),
            'action' => site_url('route/edit/' . $route_id),
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
            $this->form_validation->set_rules('departure_place', $this->lang->line('departure_place'), 'required|is_unique[routes.departure_place]');
            $this->form_validation->set_rules('main_rent', $this->lang->line('main_rent'), 'required|integer');

            if ($this->form_validation->run() == FALSE) {
                $this->nuts_lib->view_loader('user', 'add_route', $data, TRUE, 'latest_routes', 'rightbar');
                return;
            }

            $route = array(
                'route_id' => $route_id,
                'country' => $country,
                'from_place' => $from,
                'to_place' => $to,
                'type' => $transport_type,
                'vehicle_name' => $transport_name,
                'departure_place' => $departure_place,
                'departure_time' => $departure_time,
                'rent' => $main_rent,
                'evidence' => $evidence_name,
                'edited_by' => $this->user_id,
                'language_e' => $this->ln
            );
            $this->db->set('submitted_at', 'NOW()', FALSE);
            $this->db->insert('edited_routes', $route);

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
                $this->db->insert_batch('edited_stoppages', $stoppages);
            }
            $this->session->set_flashdata('message', $this->lang->line('edit_success_user'));
            redirect('profile/my_routes?ln=') . $this->ln;
        }
        $this->nuts_lib->view_loader('user', 'add_route', $data, TRUE, 'latest_routes', 'rightbar');
    }

    public function show($id) {
        if (!empty($id)) {
            $route_id = (int) $id;
        } else {
            show_404();
        }
        if ($this->input->get('ln') == 'en') {
            $alias = 'rt';
            $stopage_table = 'stoppage_translation';
        } else {
            $alias = 'r';
            $stopage_table = 'stoppages';
        }

        $query = $this->db->select('r.id,' . $alias . '.from_place,' . $alias . '.to_place,r.type,' . $alias . '.vehicle_name,' . $alias . '.departure_place,' . $alias . '.departure_time,r.rent,r.evidence,r.added,u.username')->from('routes r')->join('users u', 'r.added_by = u.id', 'left')->join('route_translation rt', 'r.id = rt.route_id', 'left')->where('r.id', $route_id)->get();
        //echo $this->db->last_query();return;
        if ($query->num_rows() < 1) {
            $this->session->set_flashdata('message', $this->lang->line('no_route'));
            redirect('route?ln=' . $this->ln);
        }
        $result = $query->row_array();
        $q_stopage = $this->db->where('route_id', (int) $result['id'])->get($stopage_table);

        $data = array(
            'title' => $result['from_place'] . ' ' . $this->lang->line('from_view') . ' ' . $result['to_place'] . ' ' . $result['vehicle_name'] . ' ' . $this->lang->line('route_info'),
            'route' => $result,
            'stoppages' => $q_stopage->result_array(),
            'segment' => 0
        );
        $this->nuts_lib->view_loader('user', 'route_details', $data, TRUE, 'latest_routes', 'rightbar');
    }

}
