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
    
    public function add(){
        $data = array(
            'title' => lang('index')
        );
        $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
    }
    
    
    public function hire(){
        $data = array(
            'title' => lang('index')
        );
        $this->nl->view_loader('user', 'hire', NULL, $data, 'latest', 'rightbar');
    }
    
    

}
