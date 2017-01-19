<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->nl->is_admin();
        $this->load->model('Users_model', 'um');
    }

    public function index() {
        $total_rows = $this->db->get('users')->num_rows();
        $per_page = 10;
        $num_links = 5;

        if ($this->input->get('page')) {
            $sgm = (int) trim($this->input->get('page'));
            $segment = $per_page * ($sgm - 1);
        } else {
            $segment = 0;
        }
        $links = $this->nl->generate_pagination('users/index', $total_rows, $per_page, $num_links);
        $data = array(
            'title' => 'Users',
            'users' => $this->um->get_users($per_page, $segment),
            'links' => $links,
            'segment' => $segment
        );

        $this->nl->view_loader('admin', 'index', NULL, $data, NULL, NULL, NULL);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('route?ln=' . $this->input->get('ln'));
    }

}
