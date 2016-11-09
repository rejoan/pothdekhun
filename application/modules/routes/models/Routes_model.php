<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Routes_model extends CI_Model {

    public function get_all() {
        $query = $this->db->select('r.id,r.from_place,r.to_place,r.transport_type,r.added,r.is_publish,u.username')->from('routes r')->join('users u', 'r.added_by = u.id', 'left')->order_by('r.id', 'desc')->get();
        return $query->result_array();
    }

}
