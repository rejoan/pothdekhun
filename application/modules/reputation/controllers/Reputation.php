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
        $this->load->model('Reputation_model', 'rem');
    }

    public function index() {
        $p = trim($this->input->get('p', TRUE));
        if ($p == 't') {
            $table = 'transport_points';
        } else {
            $table = 'route_points';
        }

        $total_rows = $this->db->get($table)->num_rows();
        $per_page = 15;
        $num_links = 5;

        if ($this->input->get('page')) {
            $sgm = (int) trim($this->input->get('page'));
            $segment = $per_page * ($sgm - 1);
        } else {
            $segment = 0;
        }

        $url = 'reputation/index?p=' . $p;
        $links = $this->nl->generate_pagination($url, $total_rows, $per_page, $num_links);
        $data = array(
            'title' => lang('reputation'),
            'settings' => $this->nl->get_config(),
            'links' => $links,
            'segment' => $segment,
            'points' => $this->pm->get_data($table, FALSE, 'user_id', $this->user_id, FALSE, FALSE, FALSE, FALSE, $per_page, $segment),
            'load_css' => load_css(array('css' => 'bootstrap-select.min.css','plugins/datatables/media/css' => 'jquery.dataTables.min.css')),
            'load_script' => load_script(array('js/bootstrap' => 'bootstrap-select.min.js', 'js/bootstrap#' => 'bootstrap.file-input.js','plugins/datatables/media/js' => 'jquery.dataTables.min.js')),
            'script_init' => script_init(array('$(\'.dataTable\').DataTable({\'paging\': false,
        \'info\': false,\'searching\': false,\'order\': [[0, \'desc\']]});'))
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
