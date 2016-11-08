<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Search extends MX_Controller {

    private $user_id;

    public function __construct() {
        parent::__construct();
        $this->user_id = $this->session->user_id;
    }

    public function index() {

        $data = array(
            'title' => lang('index')
        );
        $this->nl->view_loader('user', 'index', NULL, $data, 'latest_routes', 'rightbar');
    }

}
