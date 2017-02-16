<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Complain_model extends CI_Model {

    public function get_complains() {
        $query = $this->db->select('c.id,c.fare_upvote,c.fare_downvote,c.latest_status,c.added,c.note')->from('route_complains c')->join('users u', 'c.user_id = u.id', 'left')->join('routes r', 'c.route_id = r.id', 'left')->order_by('c.id', 'desc')->get();
        return $query->result_array();
    }

}
