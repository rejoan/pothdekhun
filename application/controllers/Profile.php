<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Nut_bolts');
        $this->nut_bolts->lang_manager();
        $this->nut_bolts->is_logged();
        $this->language = $this->session->language;
        $this->lang->load(array('controller', 'view'), $this->language);
        $this->load->model('Prime_model');
    }

    public function index() {
        $data['title'] = 'Profile';
        $this->nut_bolts->view_loader('user', 'profile', $data);
    }

}
