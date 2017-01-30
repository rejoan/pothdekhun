<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Pages extends MX_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->model('Page_model', 'nm');
    }

    public function about_us() {
        $data = array(
            'title' => lang('about_us'),
            'settings' => $this->nl->get_config(),
        );
        $this->nl->view_loader('user', 'about', NULL, $data, 'latest', 'rightbar');
    }

    public function contact_us() {
        $data = array(
            'title' => lang('contact_us'),
            'settings' => $this->nl->get_config(),
        );
        
        $this->nl->view_loader('user', 'contact', NULL, $data, 'latest', 'rightbar');
    }

}
