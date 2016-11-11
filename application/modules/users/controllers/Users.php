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

        $this->nl->view_loader('user', 'login', $data, TRUE, 'latest', 'rightbar');
    }

   

    public function logout() {
        $this->session->sess_destroy();
        redirect('route?ln=' . $this->input->get('ln'));
    }

}
