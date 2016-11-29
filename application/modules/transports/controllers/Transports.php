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

    public function add() {
        $data = array(
            'title' => lang('add_transport')
        );
        $this->load->library('form_validation');

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('transport_name', lang('transport_name'), 'required|is_unique[poribohons.name]');

            if ($this->form_validation->run() == FALSE) {
                $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
                return;
            }

            $config['upload_path'] = './evidences';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|docx|doc';
            $config['max_size'] = 2000;

            $this->load->library('upload', $config);
            if ($_FILES && $_FILES['picture']['name']) {
                if (!$this->upload->do_upload('picture')) {
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                    $this->nl->view_loader('user', 'add', $data, TRUE, 'latest', 'rightbar');
                    return;
                } else {
                    $picture = $this->upload->data();
                    $picture_name = $picture['file_name'];
                }
            } else {
                $picture_name = '';
            }

            $tarnsport = array(
                'name' => $this->input->post('transport_name', TRUE),
                'bn_name' => $this->input->post('bn_name', TRUE),
                'owner_name' => $this->input->post('owner_name', TRUE),
                'total_vehicle' => $this->input->post('total_vehicle', TRUE),
                'picture' => $picture_name
            );
            $this->pm->insert_data('poribohons', $tarnsport);
            $this->session->set_flashdata('message', lang('save_success'));
            redirect_tr('transports');
        }

        $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
    }

    public function edit($id = NULL) {
        if (!empty($id) && ctype_digit($id)) {
            $transport = $this->pm->get_row('id', $id, 'poribohons');
        }
        $data = array(
            'title' => lang('edit_transport'),
            'transport' => $transport
        );
        $this->load->library('form_validation');

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('transport_name', lang('transport_name'), 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
                return;
            }

            $config['upload_path'] = './evidences';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|docx|doc';
            $config['max_size'] = 2000;

            $this->load->library('upload', $config);
            if ($_FILES && $_FILES['picture']['name']) {
                if (!$this->upload->do_upload('picture')) {
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                    $this->nl->view_loader('user', 'add', $data, TRUE, 'latest', 'rightbar');
                    return;
                } else {
                    $picture = $this->upload->data();
                    $picture_name = $picture['file_name'];
                }
            } else {
                $picture_name = '';
            }
            $update_id = $this->input->post('update_id');
            $tarnsport = array(
                'name' => $this->input->post('transport_name', TRUE),
                'bn_name' => $this->input->post('bn_name', TRUE),
                'owner_name' => $this->input->post('owner_name', TRUE),
                'total_vehicle' => $this->input->post('total_vehicle', TRUE),
                'picture' => $picture_name
            );
            $this->pm->updater('id', $update_id, 'poribohons', $tarnsport);
            $this->session->set_flashdata('message', lang('save_success'));
            redirect_tr('transports');
        }

        $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
    }

}
