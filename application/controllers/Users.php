<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Prime_model');
    }

    public function index() {
        $data = array(
            'title' => 'বাংলাদেশের সব পরিবহন রুট তথ্য',
            'action_pull' => site_url('road/get_routes')
        );

        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('index');
        $this->load->view('footer');
    }

    public function login() {
        $data = array(
            'title' => 'প্রবেশ করুন',
            'action' => site_url('users/login')
        );

        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('user/login');
        $this->load->view('footer');
    }

    public function register() {

        $data = array(
            'title' => 'নিবন্ধন করুন',
            'action' => site_url('users/register')
        );
        $this->load->library('form_validation');

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]|valid_email');
            $this->form_validation->set_rules('username', 'Username', 'is_unique[users.username]');
            $this->form_validation->set_message('is_unique', 'এই {field} ইতোমধ্যে নেয়া হয়েছে। অন্যকিছু চেষ্টা করুন');

            $config['upload_path'] = './avatars';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
//            $config['max_size'] = 1000;
//            $config['max_width'] = 1024;
//            $config['max_height'] = 768;

            $this->load->library('upload', $config);
            

            if (!$this->upload->do_upload('avatar')) {
                echo $this->upload->display_errors();return;
                $avatar_name = '';
            } else {
                $avatar = $this->upload->data();
                if($avatar['image_width'] == 660 && $avatar['image_height'] == 402){
                    die('work');
                }else{
                    die('problem');
                }
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
                //echo 'here';return;
                $this->load->view('header', $data);
                $this->load->view('user/register');
                $this->load->view('footer');
                return;
            } else {
                $this->Prime_model->insert_data('users', $user);
                $this->session->set_flashdata('message', 'সফলভাবে নিবন্ধন হয়েছে');
                redirect('profile');
            }
        }

        $this->load->view('header', $data);
        $this->load->view('menu');
        $this->load->view('user/register');
        $this->load->view('footer');
    }

}
