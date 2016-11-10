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

    public function details($alias, $route_id, $num_rows = FALSE) {
        $query = $this->db->select('r.id,' . $alias . '.from_place,' . $alias . '.to_place,r.transport_type,' . 'p.*,' . $alias . '.departure_time,r.rent,r.evidence,r.added,u.username')->from('routes r')->join('users u', 'r.added_by = u.id', 'left')->join('route_translation rt', 'r.id = rt.route_id', 'left')->join('poribohons p', 'r.poribohon_id = p.id', 'left')->where('r.id', $route_id)->get();
        //echo $this->db->last_query();
        if ($num_rows) {
            return $query->num_rows();
        }
        return $query->row_array();
    }

}
