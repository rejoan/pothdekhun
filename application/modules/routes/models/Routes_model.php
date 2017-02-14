<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Routes_model extends CI_Model {

    public function get_all($per_page = 10, $segment = 3, $d = NULL, $t = NULL, $ttype = NULL, $i = NULL) {
        $this->db->select('r.id,r.from_place,r.to_place,r.transport_type,r.added,r.is_publish,u.username,rbn.from_place fp_bn,rbn.to_place tp_bn,rbn.departure_time,p.name,p.bn_name');
        $this->db->from('routes r')->join('users u', 'r.added_by = u.id', 'left');
        $this->db->join('route_bn rbn', 'rbn.route_id = r.id', 'left');
        $this->db->join('poribohons p', 'r.poribohon_id = p.id', 'left');
        $this->db->where('r.is_publish', 1);
        if (!empty($ttype)) {
            $this->db->where('r.transport_type', $ttype);
        }
        if (!empty($d)) {
            //$this->db->where('r.from_district', $d)->or_where('r.to_district', $d);
            $sql = '(r.from_district = ' . $d . ' OR ' . 'r.to_district = ' . $d . ')';
            if (!$i) {
                //$this->db->where('r.from_thana', $t)->or_where('r.to_thana', $t);
                $sql .= 'AND (r.from_thana = ' . $t . ' OR r.to_thana = ' . $t . ')';
            }
            $this->db->where($sql, NULL, FALSE);
        }

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

        $this->db->select('r.id r_id,r.from_district,r.to_district,r.from_thana,r.to_thana, r.rent,r.evidence,r.evidence2,r.added,r.transport_type,r.from_place,r.to_place,r.from_latlong,r.to_latlong,r.distance,r.amenities,r.duration,r.poribohon_id,p.name,p.bn_name,r.departure_time,u.username,u.id user_id,d.name district_name,d.bn_name district_name_bn,td.name td_name,td.bn_name td_bn_name,rt.from_place fp_bn,rt.to_place tp_bn,rt.departure_time dt_bn,rt.translation_status,t.name thana_name,t.bn_name thana_name_bn,th.name th_thana_name,th.bn_name th_thana_name_bn');
        $this->db->from('routes r');
        $this->db->join('users u', 'r.added_by = u.id', 'left');
        $this->db->join('route_bn rt', 'r.id = rt.route_id', 'left');
        $this->db->join('poribohons p', 'r.poribohon_id = p.id', 'left');
        $this->db->join('districts d', 'r.from_district = d.id', 'left');
        $this->db->join('districts td', 'r.to_district = td.id', 'left');
        $this->db->join('thanas t', 'r.from_thana = t.id', 'left');
        $this->db->join('thanas th', 'r.to_thana = th.id', 'left');
        $this->db->where('r.id', $route_id);
        if (!$this->nl->is_admin() && $this->router->fetch_method() == 'show') {//check if publish only when show/details and not admin
            $this->db->where('r.is_publish', 1);
        }

        $query = $this->db->get();
        //echo $this->db->last_query();return;
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

    public function get_comments($route_id) {
        $query = $this->db->select('c.*,u.username,u.avatar')->from('comments c')->join('users u', 'u.id = c.user_id', 'left')->where('c.route_id', $route_id)->get();
        return $query->result_array();
    }

    public function check_duplicate($from_place, $to_place, $vehicle_name, $edit = FALSE, $route_id = NULL) {
        $cond = array(
            'r.from_place' => $from_place,
            'r.to_place' => $to_place,
            'p.name' => $vehicle_name
        );

        $this->db->select('r.id');
        $this->db->from('routes r');
        $this->db->join('route_bn rt', 'rt.route_id = r.id', 'left');
        $this->db->join('poribohons p', 'p.id = r.poribohon_id', 'left');
        $sql = '';
        if ($edit) {
            $exclude = array($route_id);
            $this->db->where_not_in('r.id', $exclude);
            $sql .= 'r.id NOT IN(' . $route_id . ') AND ';
        }
        $this->db->where($cond);
        $this->db->where('(' . $sql . ' rt.from_place = "' . $from_place . '" AND rt.to_place = "' . $to_place . '" AND p.bn_name = "' . $vehicle_name . '")', NULL, FALSE);

        $query = $this->db->get();
        //echo $this->db->last_query();return;
        return $query->num_rows();
    }

    public function get_dthana($table, $col_name, $district_id = NULL) {
        $this->db->cache_on();
        $this->db->select('id,name,bn_name');
        $this->db->from($table);
        if (!empty($district_id)) {
            $this->db->where('district_id', $district_id);
        }
        $this->db->order_by($col_name, 'asc');
        $query = $this->db->get();
        $this->db->cache_off();
        return $query->result_array();
    }

}
