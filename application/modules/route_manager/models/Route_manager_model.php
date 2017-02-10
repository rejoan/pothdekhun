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
        $query = $this->db->select('r.id edited_route_id,r.from_place,r.to_place,r.transport_type,p.*,r.added,u.username')->from('edited_routes r')->join('users u', 'r.added = u.id', 'left')->join('poribohons p', 'r.poribohon_id = p.id', 'left')->order_by('r.id', 'desc')->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    public function newly_added() {
        $query = $this->db->select('r.id r_id,r.is_publish,r.from_place,r.to_place,r.transport_type,p.*,r.added,u.username')->from('routes r')->join('users u', 'r.added = u.id', 'left')->join('poribohons p', 'r.poribohon_id = p.id', 'left')->where('r.is_publish', 0)->order_by('r.id', 'desc')->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    public function revise_required() {
        $query = $this->db->select('r.id r_id,r.is_publish,r.from_place,r.to_place,r.transport_type,p.*,r.added,u.username')->from('routes r')->join('users u', 'r.added = u.id', 'left')->join('poribohons p', 'r.poribohon_id = p.id', 'left')->where('r.is_publish', 2)->order_by('r.id', 'desc')->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    /**
     * get route_bn table data with main tables data
     * @param int $route_id
     * @return array
     */
    public function get_row($route_id) {
        $query = $this->db->select('rt.from_place fp_bn,rt.to_place tp_bn,rt.departure_time dp_bn,r.from_place,r.to_place,r.from_district,r.to_district,r.from_thana,r.to_thana,r.transport_type,r.departure_time,r.rent,r.evidence,r.evidence2,p.*')->from('route_bn rt')->where('rt.route_id', $route_id)->join('routes r', 'rt.route_id = r.id', 'left')->join('poribohons p', 'r.poribohon_id = p.id', 'left')->get();
        return $query->row_array();
    }

    public function edited_route($route_id) {
        $query = $this->db->select('r.*,p.*')->from('edited_routes r')->join('poribohons p', 'r.poribohon_id = p.id', 'left')->where('r.id', $route_id)->get();
        return $query->row_array();
    }

}
