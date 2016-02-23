<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Dashboard extends MX_Controller {

    public function __construct() {
        parent::__construct();
        
    }

    public function index() {
        echo 'here';return;
        $data = array(
            'title' => 'Dashboard'
        );
       // $this->nuts_lib->view_admin('dashboard', $data, TRUE, TRUE);
    }

   
}
