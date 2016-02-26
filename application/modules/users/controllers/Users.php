<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Users extends CI_Controller {


    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array(
            'title' => 'বাংলাদেশের সব পরিবহন রুট তথ্য',
            'action_pull' => site_url('road/get_routes')
        );

        $this->nl->view_loader('user', 'login', $data, TRUE, 'latest_routes', 'rightbar');
    }

    public function register() {
        $data = array(
            'title' => lang('register'),
            'action' => site_url('users/register')
        );
        $this->load->library('form_validation');

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('email', lang('email'), 'required|is_unique[users.email]|valid_email');
            $this->form_validation->set_rules('username', lang('username'), 'is_unique[users.username]');
            $this->form_validation->set_message('is_unique', lang('is_unique_msg'));

            $username = trim($this->input->post('username', TRUE));
            $email = trim($this->input->post('email', TRUE));
            $mobile = trim($this->input->post('mobile', TRUE));
            $password = trim($this->input->post('password', TRUE));
            $user = array(
                'username' => $username,
                'email' => $email,
                'mobile' => $mobile,
                'password' => md5($password)
            );

            if ($this->form_validation->run() == FALSE) {
                $this->nuts_lib->view_loader('user', 'register', $data, TRUE, FALSE);
                return;
            } else {
                $this->db->insert('users', $user);
//send email for verification
                $this->session->set_flashdata('message', lang('register_user'));
                redirect('profile?ln=' . $this->ln);
            }
        }
        $this->nuts_lib->view_loader('user', 'register', $data, TRUE, FALSE);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('route?ln=' . $this->input->get('ln'));
    }

}
