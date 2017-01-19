<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Admin extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->nl->is_admin();
    }

    public function index() {
        $data = array(
            'title' => 'Dashboard'
        );
        
        $this->nl->view_loader('admin', 'index', NULL, $data, NULL, NULl, NULL);
    }

}
