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
        $query = $this->db->select('r.*,p.name,p.bn_name,p.added_by poribohon_added,u.*')->from('edited_routes r')->join('poribohons p', 'r.poribohon_id = p.id', 'left')->join('users u', 'u.id = r.added_by', 'left')->where('r.id', $route_id)->get();
        return $query->row_array();
    }

    public function join_data($id) {
        $query = $this->db->select('*')->from('edited_routes r')->join('users u', 'u.id = r.added_by')->where('r.id', $id)->get();
        //echo $this->db->last_query();return;
        return $query->row_array();
    }

    public function total_points($user_id, $table = 'route_points') {
        $this->db->select_sum('point')->where('user_id', $user_id);
        $query = $this->db->get($table);
        $point = $query->row_array();
        return $point['point'];
    }

    public function update_gainer($route_id, $gainer_id, $table, $points) {
        $total = $this->pm->total_item($table);
        if ($total > 0) {
            $this->pm->insert_data($table, array('point' => $points));
        } else {
            $this->db->set('point', 'point + ' . (int) $points, FALSE);
            $this->db->where(array('route_id' => $route_id, 'user_id' => $gainer_id))->update($table);
        }
    }

    public function deduct_point($point, $cond, $what = 'earned') {
        $my_poits = $this->db->where($cond)->get('route_points');
        if ($my_poits->num_rows() > 0) {//deduct point for this user & route
            $this->db->set('point', 'point - ' . $point)->where($cond)->update('route_points', array('what', 'lost'));
        } else {
            $this->db->insert('route_points',array(''));
        }
    }

}
