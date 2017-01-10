<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Comment_model extends CI_Model {

    public function get_all() {
        $query = $this->db->select('d.*,u.username')->from('drivers d')->join('users u', 'r.added_by = u.id', 'left')->order_by('r.id', 'desc')->get();
        return $query->result_array();
    }

}