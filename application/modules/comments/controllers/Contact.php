<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Contact extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->nl->is_admin('errors', FALSE);
        $data = array(
            'title' => 'Contact GRID',
            'comments' => $this->pm->get_data('contact_us')
        );
        $this->nl->view_loader('admin', 'contact', NULL, $data, NULL, NULL, NULL);
    }

    public function delete($id) {
        $this->nl->is_admin('errors', FALSE);
        $this->pm->deleter('id', $id, 'contact_us');
        $this->session->set_flashdata('message', 'Comments Deleted');
        redirect('comments/contact');
    }

}
