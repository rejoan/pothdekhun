<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Users extends CI_Controller {

    private $ln;

    public function __construct() {
        parent::__construct();
        $this->load->library('Nut_bolts');
        $this->nut_bolts->lang_manager();
        $this->language = $this->session->language;
        $this->ln = $this->session->ln;
        $this->lang->load(array('controller', 'view'), $this->language);
        $this->load->model('Prime_model');
    }

    public function index() {
        $data = array(
            'title' => 'বাংলাদেশের সব পরিবহন রুট তথ্য',
            'action_pull' => site_url('road/get_routes')
        );

        $this->nut_bolts->view_loader('user', 'index', $data);
    }

    public function login() {
        $data = array(
            'title' => $this->lang->line('login'),
            'action' => site_url('users/login')
        );
        if (!$this->input->get('add')) {
            $this->session->unset_userdata(array('from_login', 'to_login'));
        }
        if ($this->session->user_id) {
            redirect('profile?ln=' . $this->ln);
        }

        if ($this->input->post('submit')) {
            $email = trim($this->input->post('email', TRUE));
            $password = trim($this->input->post('password', TRUE));
            $cond = array(
                'email' => $email,
                'password' => md5($password)
            );

            $query = $this->db->where($cond)->get('users');
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
                redirect('profile?ln=' . $this->ln);
            }
        }
        $this->nut_bolts->view_loader('user', 'login', $data, TRUE, FALSE);
    }

    public function register() {
        $data = array(
            'title' => $this->lang->line('register'),
            'action' => site_url('users/register')
        );
        $this->load->library('form_validation');

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('email', $this->lang->line('email'), 'required|is_unique[users.email]|valid_email');
            $this->form_validation->set_rules('username', $this->lang->line('username'), 'is_unique[users.username]');
            $this->form_validation->set_message('is_unique', $this->lang->line('is_unique_msg'));

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
                $this->nut_bolts->view_loader('user', 'register', $data, TRUE, FALSE);
                return;
            } else {
                $this->db->insert('users', $user);
//send email for verification
                $this->session->set_flashdata('message', $this->lang->line('register_user'));
                redirect('profile?ln=' . $this->ln);
            }
        }
        $this->nut_bolts->view_loader('user', 'register', $data, TRUE, FALSE);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('road?ln=' . $this->input->get('ln'));
    }

}
