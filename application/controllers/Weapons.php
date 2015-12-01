<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Weapons extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
    }

    public function check_existence() {
        $field = trim($this->input->post('field_name', TRUE));
        $col = trim($this->input->post('col_name', TRUE));
        $table = trim($this->input->post('table_name', TRUE));
        $query = $this->db->select($col)->from($table)->where($col, $field)->get();
        if ($query->num_rows() > 0) {
            echo 'exist';
            return;
        }
    }

}
