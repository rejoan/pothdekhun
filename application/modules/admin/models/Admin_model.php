<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Admin_model extends CI_Model {

    public function get_poribohons() {
        $query = $this->db->select('p.*,u.username')->from('poribohons p')->join('users u', 'u.id = p.added_by', 'left')->where('p.is_publish', 0)->get();
        return $query->result_array();
    }

}
