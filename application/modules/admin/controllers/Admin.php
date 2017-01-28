<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Admin extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->nl->is_admin();
        $this->load->model('Admin_model', 'am');
    }

    public function index() {
        $data = array(
            'title' => 'Dashboard'
        );

        $this->nl->view_loader('admin', 'index', NULL, $data, NULL, NULl, NULL);
    }

    public function latest_poribohon() {
        $data = array(
            'title' => 'Latest Added Transports',
            'poribohons' => $this->am->get_poribohons(),
            'segment' => 1
        );

        $this->nl->view_loader('admin', 'poribohons', NULL, $data, NULL, NULl, NULL);
    }

    public function create_points($transport_id, $user_id, $point, $note, $action = 'add') {
        $points = array(
            'transport_id' => $transport_id,
            'user_id' => $user_id,
            'point' => $point,
            'note' => $note,
            'notification_msg' => 'Eearned <strong>' . $point . '</strong> point for ' . $action . ' transport'
        );
        $this->db->set('happened_at', 'NOW()', FALSE);
        $this->db->insert('transport_points', $points);
    }

}
