<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Road extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Prime_model');
    }

    public function index() {
		$this->load->helper('hits');
        $data = array(
            'title' => 'বাংলাদেশের সব পরিবহন রুট তথ্য',
            'action_pull' => site_url('road/get_routes'),
            'action_groute' => site_url('road/add_route')
        );

        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('index');
        $this->load->view('footer');
    }

    public function get_routes() {
        $data['title'] = 'Road';
    }

    public function add_route() {

        $this->load->library('form_validation');
        $data = array(
            'title' => 'রুট তথ্য যোগ',
            'action' => site_url('road/add_route'),
            'from' => trim($this->input->post('from_push', TRUE)),
            'to' => trim($this->input->post('to_push', TRUE))
        );
        if ($this->input->post('submit')) {
            $from = trim($this->input->post('from_place', TRUE));
            if ($from == '') {
                $from = trim($this->input->post('device_from', TRUE));
            }
            $to = trim($this->input->post('to_place', TRUE));
            if ($to == '') {
                $to = trim($this->input->post('device_to', TRUE));
            }
            if (!preg_match('/[^A-Za-z0-9(,|  |_)]/', $from)) {
                $from_field = 'from';
                $to_field = 'to';
            } else {
                $from_field = 'from_bn';
                $to_field = 'to_bn';
            }
            $transport_type = $this->input->post('type', TRUE);
            $transport_name = $this->input->post('transport_name', TRUE);
            $departure_place = $this->input->post('departure_place', TRUE);

            $departure_time = $this->input->post('departure_time', TRUE);
            $main_rent = $this->input->post('main_rent', TRUE);

            if ($departure_time == 'perticular') {
                $departure_time = $this->input->post('departure_dynamic', TRUE);
            }



            $config['upload_path'] = './evidences';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 1000;
            $config['min_width'] = 200;
            $config['min_height'] = 150;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;

            $this->load->library('upload', $config);
            if ($_FILES && $_FILES['evidence']['name']) {
                if (!$this->upload->do_upload('evidence')) {
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                    $this->load->view('header', $data);
                    $this->load->view('menu');
                    $this->load->view('add_route');
                    $this->load->view('footer');
                    return;
                } else {
                    $evidence = $this->upload->data();
                    $evidence_name = $evidence['file_name'];
                }
            } else {
                $evidence_name = '';
            }


            if ($this->session->user_id) {
                $added_by = (int) $this->session->user_id;
            } else {
                $username = trim($this->input->post('username', TRUE));
                $email = trim($this->input->post('email', TRUE));
                $password = trim($this->input->post('password', TRUE));

                //user data process
                $user = array(
                    'username' => $username,
                    'email' => $email,
                    'password' => md5($password),
                    'reg_date' => date('Y-m-d H:i:s')
                );
                $this->Prime_model->insert_data('users', $user);

                $user_id = $this->db->insert_id();
                $added_by = $user_id;
            }

//route data process

            $this->form_validation->set_rules('vehicle_name', 'পরিবহনের নাম', 'required');
            $this->form_validation->set_rules('departure_place', 'ছাড়ার স্থান', 'required');
            $this->form_validation->set_rules('main_rent', 'ভাড়া', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('header', $data);
                $this->load->view('menu');
                $this->load->view('add_route');
                $this->load->view('footer');
                return;
            }

            $route = array(
                $from_field => $from,
                $to_field => $to,
                'type' => $transport_type,
                'vehicle_name' => $transport_name,
                'departure_place' => $departure_place,
                'departure_time' => $departure_time,
                'rent' => $main_rent,
                'evidence' => $evidence_name,
                'added' => date('Y-m-d H:i:s'),
                'added_by' => $added_by
            );
            $this->Prime_model->insert_data('routes', $route);

            $route_id = $this->db->insert_id();

//stoppage data process
            $rent = $this->input->post('rent', TRUE);
            $place_name = $this->input->post('place_name', TRUE);
            $comment = $this->input->post('comments', TRUE);
            $rent = $this->input->post('rent', TRUE);
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
            redirect('road');
        }

        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('add_route');
        $this->load->view('footer');
    }

}
