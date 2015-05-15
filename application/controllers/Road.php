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

        $data = array(
            'title' => 'রুট তথ্য যোগ',
            'action' => site_url('road/add_route'),
            'from' => trim($this->input->post('from_push', TRUE)),
            'to' => trim($this->input->post('to_push', TRUE))
        );
        if ($this->input->post('submit') == 'যোগ করুন') {
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

            $route = array(
                $from_field => $from,
                $to_field => $to,
                'type' => $transport_type,
                'vehicle_name' => $transport_name,
                'departure_place' => $departure_place,
                'departure_time' => $departure_time,
                'rent' => $main_rent                        ,
                'added' => date('Y-m-d H:i:s'),
                'added_by' => (int) $this->session->user_id
            );

            $rent = $this->input->post('rent', TRUE);
            $place_name = $this->input->post('place_name', TRUE);
            $comment = $this->input->post('comment', TRUE);
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
            var_dump($stoppages);
            return;

            if ($stoppages) {
                $this->db->insert_batch('stoppages', $stoppages);
            }
        }

        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('add_route');
        $this->load->view('footer');
    }

}
