<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Transports extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Transport_model', 'tm');
    }

    public function index() {
        $total_rows = $this->db->get('poribohons')->num_rows();
        $per_page = 10;
        $num_links = 5;
        if ($this->input->get('page')) {
            $sgm = (int) trim($this->input->get('page'));
            $segment = $per_page * ($sgm - 1);
        } else {
            $segment = 0;
        }
        $links = $this->nl->generate_pagination('transports/index', $total_rows, $per_page, $num_links);

        $data = array(
            'title' => lang('all_transport'),
            'transports' => $this->tm->get_all(),
            'links' => $links,
            'segment' => $segment
        );
        $this->nl->view_loader('user', 'index', NULL, $data, 'latest', 'rightbar');
    }

}
