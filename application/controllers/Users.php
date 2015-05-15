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
    
    public function register(){
        
        $data = array(
            'title' => 'নিবন্ধন করুন',
            'action' => site_url('users/register')
        );
        
        if ($this->input->post('submit')) {
          
            $username = trim($this->input->post('username', TRUE));
            $email = trim($this->input->post('email', TRUE));
           
            $password = trim($this->input->post('password2', TRUE));

            $user = array(
                'username' => $username,
                'email' => $email,
                'password' => md5($password)
            );

            $this->form_validation->set_rules('email', 'Email', 'is_unique[users.email]');
            $this->form_validation->set_rules('username', 'Username', 'is_unique[users.username]');
            $this->form_validation->set_message('is_unique', 'এই {field} ইতোমধ্যে নেয়া হয়েছে। অন্যকিছু চেষ্টা করুন');

            if ($this->form_validation->run() == FALSE) {
                //echo 'here';return;
                $this->load->view('header', $data);
                $this->load->view('user/register');
                $this->load->view('footer');
                return;
            } else {
                $this->Prime_model->insert_data('agents', $agent);
                $this->session->set_flashdata('message', 'Agent Added Successfully');
                redirect('road');
            }
        }
    }
}