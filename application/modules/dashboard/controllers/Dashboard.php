<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array(
            'title' => 'Dashboard'
        );
        $this->nuts_lib->is_admin();
        $this->nuts_lib->view_admin('dashboard', $data, TRUE, TRUE);
    }

   
}
