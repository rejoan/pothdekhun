<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Weapons extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->input->is_ajax_request()){
            show_404();
        }
    }
    
    public function check_username(){
        $username = trim($this->input->post('username',TRUE));
        $query = $this->db->select('username')->from('users')->where('username',$username)->get();
        if($query->num_rows() > 0){
            echo 'exist';
        }
    }
}