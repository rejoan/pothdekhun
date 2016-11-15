<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Route_manager_model extends CI_Model {

    public function get_all() {
        $query = $this->db->select('r.id,r.route_id,r.from_place,r.to_place,r.transport_type,p.*,r.added,u.username')->from('edited_routes r')->join('users u', 'r.added = u.id', 'left')->join('poribohons p', 'r.poribohon_id = p.id', 'left')->order_by('r.id', 'desc')->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

}
