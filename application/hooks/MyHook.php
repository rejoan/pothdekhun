<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class MyHook extends CI_Controller {

    private $CI;

    public function __construct() {
        parent::__construct();
        $this->CI = & get_instance();
    }

    public function language_set() {
        $language = $this->CI->config->item('language');
        if ($this->CI->input->get('ln') == 'en') {
            $this->CI->session->unset_userdata(array('language', 'ln'));
            $this->CI->session->set_userdata(array('language' => 'english', 'ln' => 'en'));
        } else {
            $this->CI->session->set_userdata(array('language' => $language, 'ln' => 'bn'));
        }
    }

}
