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

    public function get_route($route_id, $num_rows = FALSE) {
        $query = $this->db->select('r.*,rt.*,p.*')->from('routes r')->join('route_bn rt', 'r.id = rt.route_id', 'left')->join('poribohons p', 'r.poribohon_id = p.id', 'left')->where('r.id', $route_id)->get();
        if ($num_rows) {
            return $query->num_rows();
        }
        return $query->row_array();
    }

    /**
     * get route_bn table data with main tables data
     * @param int $route_id
     * @return array
     */
    public function get_row($route_id) {
        $query = $this->db->select('rt.from_place,rt.to_place,rt.departure_time,r.from_district,r.to_district,r.from_thana,r.to_thana,r.transport_type,r.departure_time,r.rent,r.evidence,p.*')->from('route_bn rt')->where('rt.route_id', $route_id)->join('routes t', 'rt.route_id = r.id', 'left')->join('poribohons p', 'r.poribohon_id = p.id', 'left')->get();
        return $query->row_array();
    }

}
