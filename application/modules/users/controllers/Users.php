<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->nl->is_admin('errors', FALSE);
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

    public function points() {
        $p = trim($this->input->get('p', TRUE));
        $u = trim($this->input->get('u', TRUE));
        if ($p == 't') {
            $table = 'transport_points';
        } else {
            $table = 'route_points';
        }


        $total_rows = $this->db->get($table)->num_rows();
        $per_page = 15;
        $num_links = 5;

        if ($this->input->get('page')) {
            $sgm = (int) trim($this->input->get('page'));
            $segment = $per_page * ($sgm - 1);
        } else {
            $segment = 0;
        }

        $url = 'users/points?p=' . $p . '&u=' . $u;
        $links = $this->nl->generate_pagination($url, $total_rows, $per_page, $num_links);
        $data = array(
            'title' => lang('reputation'),
            'settings' => $this->nl->get_config(),
            'links' => $links,
            'segment' => $segment,
            'points' => $this->um->get_points($table, $u, $per_page, $segment)
        );
        $this->nl->view_loader('admin', 'points', NULL, $data,  NULL, NULL, NULL);
    }

}
