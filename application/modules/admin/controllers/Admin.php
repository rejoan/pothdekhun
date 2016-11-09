<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Admin extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array(
            'title' => 'Dashboard'
        );
        $this->nl->is_admin();
        $this->nl->view_admin('index', $data, TRUE, TRUE);
    }

    public function login() {
        $data = array(
            'title' => 'Login',
            'action' => site_url('admin/login'),
            'login' => 'yes'
        );
        if ($this->input->post('submit')) {
            $email = trim($this->input->post('email', TRUE));
            $password = trim($this->input->post('password', TRUE));
            $cond = array(
                'email' => $email,
                'password' => md5($password)
            );
            $query = $this->db->where($cond)->where('type > ', 1, NULL, FALSE)->get('users');
            //echo $this->db->last_query();return;

            if ($query->num_rows() > 0) {
                $user = $query->row_array();
                $user_data = array(
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'avatar' => $user['avatar'],
                    'type' => $user['type']
                );
                $this->session->set_userdata($user_data);
                redirect('admin');
            }
        }
        $this->nl->view_admin('login', $data, FALSE, FALSE);
    }


    public function logout() {
        $this->session->sess_destroy();
        redirect('admin/login');
    }

}
