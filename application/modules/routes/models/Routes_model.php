<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Routes_model extends CI_Model {

    public function get_all($per_page = 10, $segment = 3, $d = NULL, $t = NULL) {
        $this->db->select('r.id,r.from_place,r.to_place,r.transport_type,r.added,r.is_publish,u.username,rbn.from_place fp_bn,rbn.to_place tp_bn,rbn.departure_time,p.name,p.bn_name');
        $this->db->from('routes r')->join('users u', 'r.added_by = u.id', 'left');
        $this->db->join('route_bn rbn', 'rbn.route_id = r.id', 'left');
        $this->db->join('poribohons p', 'r.poribohon_id = p.id', 'left');
        $this->db->order_by('r.id', 'desc');
        $this->db->limit($per_page, $segment);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    /**
     * get route details and no of rows
     * @param int $route_id ID of route
     * @param bool $num_rows whether to return no of rows
     * @return int or array
     */
    public function details($route_id, $num_rows = FALSE) {
        $query = $this->db->select('r.id r_id,r.from_district,r.to_district,r.from_thana,r.to_thana, r.rent,r.evidence,r.evidence2,r.added,r.transport_type,r.from_place,r.to_place,r.from_latlong,r.to_latlong,r.distance,r.duration,r.poribohon_id,p.name,p.bn_name,r.departure_time,u.username,d.name district_name,d.bn_name district_name_bn,td.name td_name,td.bn_name td_bn_name,rt.from_place fp_bn,rt.to_place tp_bn,rt.departure_time dt_bn,rt.translation_status')->from('routes r')->join('users u', 'r.added_by = u.id', 'left')->join('route_bn rt', 'r.id = rt.route_id', 'left')->join('poribohons p', 'r.poribohon_id = p.id', 'left')->join('districts d', 'r.from_district = d.id', 'left')->join('districts td', 'r.to_district = td.id', 'left')->where('r.id', $route_id)->get();
        //echo $this->db->last_query();
        if ($num_rows) {
            return $query->num_rows();
        }
        return $query->row_array();
    }

    /**
     * 
     * @param type $route_id
     * @param type $table
     * @return type
     */
    public function get_last_position($route_id, $table) {
        $query = $this->db->where('route_id', $route_id)->order_by('position', 'desc')->limit(1)->get($table);
        if ($query->num_rows() < 1) {
            $position = 1;
        } else {
            $result = $query->row_array();
            $position = (int) $result['position'];
        }

        return $position;
    }

}
