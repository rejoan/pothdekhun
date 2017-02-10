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

    public function route_points($route_id, $user_id, $point, $note) {
        $points = array(
            'route_id' => $route_id,
            'user_id' => $user_id,
            'point' => $point,
            'note' => $note
        );
        $this->db->set('happened_at', 'NOW()', FALSE);
        $this->db->insert('route_points', $points);
    }

    public function transport_points($transport_id, $user_id, $point, $note) {
        $points = array(
            'transport_id' => $transport_id,
            'user_id' => $user_id,
            'point' => $point,
            'note' => $note
        );
        $this->db->set('happened_at', 'NOW()', FALSE);
        $this->db->insert('transport_points', $points);
    }

}
