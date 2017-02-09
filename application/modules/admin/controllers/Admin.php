<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Admin extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->uri->segment(1) == 'admin') {
            show_404();
        }
        $this->nl->is_admin('auth/login',FALSE);
        $this->load->model('Admin_model', 'am');
    }

    public function index() {
        $this->load->helper('admin');
        $data = array(
            'title' => 'Dashboard',
            'routes' => $this->db->where('is_publish','0')->get('routes')->num_rows(),
            'edited_routes' => $this->pm->total_item('edited_routes'),
            'transports' => $this->db->where('is_publish','0')->get('poribohons')->num_rows(),
            'edited_transports' => $this->pm->total_item('edited_poribohons'),
            'comments' => $this->pm->total_item('comments'),
            'contact_us' => $this->pm->total_item('contact_us'),
            'verify' => $this->pm->total_item('route_complains'),
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
        $this->db->query('UPDATE users SET reputation = reputation + ' . (int) $point . ' WHERE id = ' . (int) $user_id);
    }

    public function edited_poribohons() {
        $data = array(
            'title' => 'Edited Transports',
            'poribohons' => $this->am->edited_poribohons(),
            'segment' => 1
        );

        $this->nl->view_loader('admin', 'edited_poribohons', NULL, $data, NULL, NULL, NULL);
    }

}
