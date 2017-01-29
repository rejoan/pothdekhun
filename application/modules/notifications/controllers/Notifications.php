<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Notifications extends MX_Controller {

    private $user_id = 4;

    public function __construct() {
        parent::__construct();
        $this->nl->is_logged();
        $this->user_id = $this->session->user_id;
        $this->load->model('Notification_model', 'nm');
    }

    public function index() {
        $this->pm->updater('user_id', $this->user_id, 'route_points', array('read' => 1));
        $this->pm->updater('user_id', $this->user_id, 'transport_points', array('read' => 1));
        $data = array(
            'title' => 'Notifications',
            'settings' => $this->nl->get_config(),
            'notifications' => $this->nm->all_notification($this->user_id)
        );
        $this->nl->view_loader('user', 'index', NULL, $data, 'latest', 'rightbar');
    }

    public function details($id) {
        $this->pm->updater('id', $id, 'route_points', array('read' => 1));
        $data = array(
            'title' => 'Notification Details',
            'settings' => $this->nl->get_config(),
            'notification' => $this->nm->get_notification($id, $this->user_id)
        );
        $this->nl->view_loader('user', 'details', NULL, $data, 'latest', 'rightbar');
    }

}
