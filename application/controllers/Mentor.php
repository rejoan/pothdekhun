<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Mentor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Nut_lib');
    }

    public function index() {
        $create_session = array(
		'is_logged' => true,
		'user_id' => 55
		);

	$this->session->set_userdata($create_session);
	$this->session->unset_userdata($create_session);
	var_dump($this->session->userdata('user_id'));
    }

    public function profile($id) {
        
    }

}
