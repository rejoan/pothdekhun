<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Complain_model extends CI_Model {

    public function get_complains($per_page, $segment) {
        $this->db->select('c.id,c.fare_upvote,c.fare_downvote,c.latest_status,c.added,c.proof,c.route_id,c.user_id,u.username');
        $this->db->from('route_complains c');
        $this->db->join('users u', 'c.user_id = u.id', 'left');
        $this->db->join('routes r', 'c.route_id = r.id', 'left');
        $this->db->order_by('c.added', 'desc');
        $query = $this->db->get();
        $this->db->limit($per_page, $segment);
        return $query->result_array();
    }

}
