<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Nut_bolts');
    }

    public function index() {
        $data = array(
            'title' => 'Dashboard'
        );
        $this->nut_bolts->view_admin('index', $data, TRUE,TRUE);
    }

}
