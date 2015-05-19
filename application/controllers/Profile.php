<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Prime_model');
    }

    public function index() {
        
    }

    protected function is_logged() {
        if ($this->session->user_id) {
            return true;
        } else {
            redirect('users/login');
        }
    }

}
