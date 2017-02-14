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
        $query = $this->db->select('u.*,p.id profile_id')->from('users u')->join('profiles p', 'p.user_id = u.id', 'left')->limit($per_page, $segment)->order_by('u.id', 'desc')->get();
        return $query->result_array();
    }

    public function get_points($table, $u, $per_page, $segment) {
        $this->db->select('*');
        $this->db->from($table);
        if ($u) {
            $this->db->where('user_id', $u);
        }
        $this->db->limit($per_page, $segment);
        $query = $this->db->get();
        return $query->result_array();
    }

}
