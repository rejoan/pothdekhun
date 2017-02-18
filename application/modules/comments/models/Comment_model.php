<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Comment_model extends CI_Model {

    public function get_comments() {
        $query = $this->db->select('c.id,c.comment,c.route_id,c.added,u.username,c.status')->from('comments c')->join('users u', 'c.user_id = u.id', 'left')->order_by('c.id', 'desc')->get();
        return $query->result_array();
    }

}