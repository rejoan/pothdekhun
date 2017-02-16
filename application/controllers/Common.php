<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Common extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
    }
    
    public function get_users(){
        $typing = trim($this->input->get('typing', TRUE));
        $query = $this->db->query('SELECT id,username FROM users WHERE username LIKE "%%'.$typing.'%$" OR email LIKE "%%'.$typing.'%%" ORDER BY CASE WHEN username LIKE "' . $typing . '%" THEN 0 WHEN username LIKE "% %' . $typing . '% %" THEN 1 WHEN username LIKE "%' . $typing . '%" THEN 2 ELSE 3 END LIMIT 7');
        //echo $this->db->last_query();return;
        $places = $query->result_array();
        echo json_encode($places);
    }

}
