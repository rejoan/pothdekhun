<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Transport extends CI_Controller {

    private $language;

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
            'title' => $this->lang->line('transport')
        );

        $this->nut_bolts->view_loader('user', 'transports', $data);
    }

}
