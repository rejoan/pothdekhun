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

        $data = array(
            'title' => 'Complains GRID',
            'complains' => $this->cm->get_complains()
        );
        $this->nl->view_loader('admin', 'index', NULL, $data, NULL, NULL, NULL);
    }

    public function delete($id) {
        $this->nl->is_admin('errors', FALSE);
        $this->pm->deleter('id', $id, 'comments');
        $this->session->set_flashdata('message', 'Comments Deleted');
        redirect('comments');
    }

}
