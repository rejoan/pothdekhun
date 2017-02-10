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
        $this->pm->updater('user_id', $this->user_id, 'notifications', array('read' => 1));
        $data = array(
            'title' => 'All Notifications',
            'settings' => $this->nl->get_config(),
            'notifications' => $this->pm->get_data('notifications', FALSE, 'user_id', $this->user_id)
        );
        $this->nl->view_loader('user', 'latest', NULL, $data, 'index', 'rightbar', 'menu', TRUE);
    }

    public function details($id) {
        $this->pm->updater('id', $id, 'notifications', array('read' => 1));
        $data = array(
            'title' => 'Notification Details',
            'settings' => $this->nl->get_config(),
            'notification' => $this->pm->get_row('id', $id, 'notifications')
        );
        $this->nl->view_loader('user', 'latest', NULL, $data, 'details', 'rightbar', 'menu', TRUE);
    }

}
