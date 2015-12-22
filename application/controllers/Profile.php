<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Profile extends CI_Controller {

    private $language;
    private $user_id;

    public function __construct() {
        parent::__construct();
        $this->load->library('Nuts_lib');
        $this->nuts_lib->lang_manager();
        $this->nuts_lib->is_logged('users/login',1);
        $this->language = $this->session->language;
        $this->user_id = (int) $this->session->user_id;
        $this->lang->load(array('controller', 'view'), $this->language);
        $this->load->model('Prime_model');
    }

    public function index() {
        $query = $this->db->select('p.first_name,p.last_name,p.about,p.occupation,p.thana,p.district,p.country,u.username,u.email,u.reputation,u.avatar')->from('users u')->join('profiles p', 'u.id = p.user_id', 'left')->where('u.id', $this->user_id)->get();
        //echo $this->db->last_query();return;
        $data = array(
            'title' => $this->lang->line('profile'),
            'profile' => $query->row_array()
        );
        $this->nuts_lib->view_loader('user', 'profile', $data, TRUE, NULL, 'rightbar');
    }

}
