<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Complains extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->nl->is_admin('errors', FALSE);
        $this->load->model('Complain_model', 'cm');
    }

    public function index() {
        $this->load->helper('admin');
        $total_rows = $this->db->get('route_complains')->num_rows();
        $per_page = 15;
        $num_links = 5;

        if ($this->input->get('page')) {
            $sgm = (int) trim($this->input->get('page'));
            $segment = $per_page * ($sgm - 1);
        } else {
            $segment = 0;
        }

        $url = 'complains/index';
        $links = $this->nl->generate_pagination($url, $total_rows, $per_page, $num_links);

        $data = array(
            'links' => $links,
            'segment' => $segment,
            'title' => 'GRID Complains',
            'complains' => $this->cm->get_complains($per_page, $segment)
        );
        $this->nl->view_loader('admin', 'index', NULL, $data, NULL, NULL, NULL);
    }

    public function delete($id) {
        $this->pm->deleter('id', $id, 'route_complains');
        $this->session->set_flashdata('message', 'Complain Deleted');
        redirect('complains');
    }

}
