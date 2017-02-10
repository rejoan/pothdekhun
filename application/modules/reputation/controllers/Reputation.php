<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Reputation extends MX_Controller {

    private $user_id;

    public function __construct() {
        parent::__construct();
        $this->nl->is_logged();
        $this->user_id = (int) $this->session->user_id;
        $this->load->model('Reputation_model', 'rpm');
    }

    public function index() {
        $data = array(
            'title' => lang('reputation'),
            'settings' => $this->nl->get_config()
        );
        $this->nl->view_loader('user', 'latest', NULL, $data, 'index', 'rightbar', 'menu', TRUE);
    }

    public function show($id) {
        $this->nl->view_loader('user', 'latest', NULL, $data, 'index', 'rightbar', 'menu', TRUE);
    }

}
