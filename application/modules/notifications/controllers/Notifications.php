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
        $total_rows = $this->db->where('user_id', $this->user_id)->get('notifications')->num_rows();
        $per_page = 15;
        $num_links = 5;

        if ($this->input->get('page')) {
            $sgm = (int) trim($this->input->get('page'));
            $segment = $per_page * ($sgm - 1);
        } else {
            $segment = 0;
        }
        $url = 'notifications/index';
        $links = $this->nl->generate_pagination($url, $total_rows, $per_page, $num_links);

        $this->pm->updater('user_id', $this->user_id, 'notifications', array('is_read' => 1));
        $data = array(
            'title' => 'All Notifications',
            'links' => $links,
            'segment' => $segment,
            'settings' => $this->nl->get_config(),
            'notifications' => $this->pm->get_data('notifications', FALSE, 'user_id', $this->user_id, FALSE, FALSE, FALSE, 'id', 'desc', $per_page, $segment)
        );
        $this->nl->view_loader('user', 'latest', NULL, $data, 'index', 'rightbar', 'menu', TRUE);
    }

    public function details($id) {
        $this->pm->updater('id', $id, 'notifications', array('is_read' => 1));
        $data = array(
            'title' => 'Notification Details',
            'settings' => $this->nl->get_config(),
            'notification' => $this->pm->get_row('id', $id, 'notifications')
        );
        $this->nl->view_loader('user', 'latest', NULL, $data, 'details', 'rightbar', 'menu', TRUE);
    }

    public function sent_notification($user_id, $msg = 'Notify') {
        $notification = array(
            'user_id' => $user_id,
            'notification_msg' => $msg
        );
        $this->db->set('added', 'NOW()', FALSE);
        $this->db->insert('notifications', $notification);
    }

}
