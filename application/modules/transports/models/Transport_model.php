<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Transport_model extends CI_Model {

    public function get_all() {
        $query = $this->db->select('p.*,u.username')->from('poribohons p')->join('users u', 'p.added_by = u.id', 'left')->order_by('p.id', 'desc')->get();
        return $query->result_array();
    }

}
