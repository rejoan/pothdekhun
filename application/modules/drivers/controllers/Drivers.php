<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Drivers extends MX_Controller {

    private $user_id = 4;

    public function __construct() {
        parent::__construct();
        if ($this->session->user_id) {
            $this->user_id = $this->session->user_id;
        }
        $this->load->model('Driver_model', 'dm');
    }

    public function index() {
        $data = array(
            'title' => lang('index'),
            'settings' => $this->nl->get_config(),
            'drivers' => $this->pm->get_data('drivers')
        );
        $this->nl->view_loader('user', 'index', NULL, $data, 'latest', 'rightbar');
    }

    public function add() {
        $data = array(
            'title' => lang('index'),
            'settings' => $this->nl->get_config(),
            'drivers' => $this->pm->get_data('drivers')
        );
        $this->nl->view_loader('user', 'index', NULL, $data, 'latest', 'rightbar');
    }

    public function hire() {
        $data = array(
            'title' => lang('index'),
            'settings' => $this->nl->get_config(),
            'drivers' => $this->pm->get_data('drivers')
        );
        $this->nl->view_loader('user', 'index', NULL, $data, 'latest', 'rightbar');
    }
}