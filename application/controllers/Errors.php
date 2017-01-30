<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Errors extends MX_Controller {

    public function index(){
        show_404();
    }

}
