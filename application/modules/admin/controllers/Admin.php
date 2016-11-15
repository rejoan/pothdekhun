<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Admin extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array(
            'title' => 'Dashboard'
        );
        $this->nl->is_admin();
        $this->nl->view_loader('admin', 'index', NULL, $data, 'leftbar', NULl, NULL);
    }

}
