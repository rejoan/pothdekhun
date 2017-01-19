<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Users_model extends CI_Model {

    public function get_users($per_page = 10, $segment = 3) {
        $query = $this->db->select('*')->from('users u')->join('profiles p', 'p.user_id = u.id', 'left')->limit($per_page, $segment)->get();
        return $query->result_array();
    }

}
