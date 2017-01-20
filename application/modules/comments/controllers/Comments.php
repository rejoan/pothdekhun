<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Comments extends MX_Controller {

    private $user_id = 4;

    public function __construct() {
        parent::__construct();
        if ($this->session->user_id) {
            $this->user_id = $this->session->user_id;
        }
        $this->load->model('Comment_model', 'cm');
    }

    public function index() {

        $data = array(
            'title' => lang('index')
        );
        $this->nl->view_loader('user', 'index', NULL, $data, 'latest', 'rightbar');
    }

    public function add() {
        $data = array(
            'title' => lang('index')
        );
        if ($this->input->post('submit')) {
            $this->load->library('encryption');
            $this->encryption->initialize(
                    array(
                        'cipher' => 'des',
                        'mode' => 'ECB'
                    )
            );
            $route_id = $this->encryption->decrypt($this->input->post('pd_identity'));
            $total_comments = $this->pm->total_item('comments', 'route_id', $route_id);
            if ($total_comments == 0) {// if no comment then left
                $position = 'left';
            } elseif ($total_comments % 2 == 0) {// if even then right
                $position = 'right';
            } else {
                $position = 'left';
            }
            $comment_data = array(
                'route_id' => $route_id,
                'comment' => trim($this->input->post('comment', TRUE)),
                'user_id' => $this->session->user_id,
                'position' => $position
            );
            $this->pm->insert_data('comments', $comment_data);
            $this->session->set_flashdata('message', lang('comment_added'));
            redirect_tr('routes/show') . '/' . $route_id;
        }
        $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
    }

    public function hire() {
        $data = array(
            'title' => lang('index')
        );
        $this->nl->view_loader('user', 'hire', NULL, $data, 'latest', 'rightbar');
    }

}
