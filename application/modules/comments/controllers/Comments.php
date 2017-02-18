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
        $this->nl->is_admin('errors', FALSE);
        $data = array(
            'title' => 'Comments GRID',
            'comments' => $this->cm->get_comments()
        );
        $this->nl->view_loader('admin', 'index', NULL, $data, NULL, NULL, NULL);
    }

    public function delete($id) {
        $this->nl->is_admin('errors', FALSE);
        $this->pm->deleter('id', $id, 'comments');
        $this->session->set_flashdata('message', 'Comments Deleted');
        redirect('comments');
    }

    public function add() {
        $this->load->library('form_validation');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('comment', 'Comment', 'required');

            $route_id = $this->nl->dec($this->input->post('pd_identity'));
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('message', lang('comment_required'));
                redirect_tr('routes/show/' . $route_id);
            }
            $total_comments = $this->pm->total_item('comments', 'route_id', $route_id);
            if ($total_comments == 0) {// if no comment then left
                $position = 'left';
            } elseif ($total_comments % 2 == 0) {// if even then right
                $position = 'left';
            } else {
                $position = 'right';
            }
            $comment_data = array(
                'route_id' => $route_id,
                'comment' => trim($this->input->post('comment', TRUE)),
                'user_id' => $this->session->user_id,
                'position' => $position
            );
            $this->db->set('added', 'NOW()', FALSE);
            $this->pm->insert_data('comments', $comment_data);
            $this->session->set_flashdata('message', lang('comment_added'));
            //var_dump($route_id);return;
            redirect_tr('routes/show/' . $route_id);
        }
        redirect_tr('routes');
    }

    /**
     * 
     * @param int $id
     */
    public function approval($id) {
        $this->nl->is_admin('errors', FALSE);
        $comment = $this->pm->get_row('id', $id, 'comments');
        if ($comment['status'] == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        $this->pm->updater('id', $id, 'comments', array('status' => $status));
        $this->session->set_flashdata('message', 'Comments Status Updated');
        redirect('comments');
    }

}
