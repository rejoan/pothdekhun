<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Nut_bolts');
        $this->nut_bolts->lang_manager();
        $this->language = $this->session->language;
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

        if ($this->input->post('submit')) {
            $email = trim($this->input->post('email', TRUE));
            $password = trim($this->input->post('password', TRUE));
            $cond = array(
                'email' => $email,
                'password' => md5($password)
            );

            $query = $this->db->where($cond)->get('users')->num_rows();

            if ($query > 0) {
                $user = $query->row_array();
                $user_data = array(
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'avatar' => $user['avatar']
                );
                $this->session->set_userdata($user_data);
                redirect('users/profile');
            }
        }
        $this->nut_bolts->view_loader('user', 'login', $data);
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

            $config['upload_path'] = './avatars';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->load->library('upload', $config);


            if (!$this->upload->do_upload('avatar')) {
//echo $this->upload->display_errors();return;
                $avatar_name = '';
            } else {
                $avatar = $this->upload->data();

                $avatar_name = $avatar['file_name'];
            }

            $username = trim($this->input->post('username', TRUE));
            $email = trim($this->input->post('email', TRUE));
            $mobile = trim($this->input->post('mobile', TRUE));
            $password = trim($this->input->post('password', TRUE));

            $user = array(
                'username' => $username,
                'email' => $email,
                'mobile' => $mobile,
                'password' => md5($password),
                'avatar' => $avatar_name
            );

            if ($this->form_validation->run() == FALSE) {
                $this->nut_bolts->view_loader('user', 'register', $data);
                return;
            } else {
                $this->Prime_model->insert_data('users', $user);
                $this->session->set_flashdata('message', $this->lang->line('register_user'));
                redirect('profile');
            }
        }

        $this->nut_bolts->view_loader('user', 'register', $data);
    }

}
