<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Notification_model extends CI_Model {

    public function get_notification($id, $user_id) {
        $cond = array(
            'n.id' => $id,
            'n.user_id' => $user_id
        );
        $query = $this->db->select('n.*,r.from_place,r.to_place,d.name district_name,d.bn_name district_name_bn,td.name td_name,td.bn_name td_bn_name,rt.from_place fp_bn,rt.to_place tp_bn')->from('route_points n')->join('routes r', 'r.id = n.route_id', 'left')->join('districts d', 'r.from_district = d.id', 'left')->join('districts td', 'r.to_district = td.id', 'left')->join('route_bn rt', 'rt.route_id = n.route_id', 'left')->where($cond)->get();
        return $query->row_array();
    }

    public function all_notification($user_id) {
        $cond = array(
            'n.user_id' => $user_id
        );
        $query = $this->db->select('n.*,r.from_place,r.to_place,d.name district_name,d.bn_name district_name_bn,td.name td_name,td.bn_name td_bn_name,rt.from_place fp_bn,rt.to_place tp_bn')->from('route_points n')->join('routes r', 'r.id = n.route_id', 'left')->join('districts d', 'r.from_district = d.id', 'left')->join('districts td', 'r.to_district = td.id', 'left')->join('route_bn rt', 'rt.route_id = n.route_id', 'left')->where($cond)->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    public function total_notifications($user_id) {
        $cond = array(
            'user_id' => $user_id,
            'read' => 0
        );
        $query1 = $this->db->where($cond)->get('route_points');
        $query2 = $this->db->where($cond)->get('transport_points');
        $total_unread = $query1->num_rows() + $query2->num_rows();
        return $total_unread;
    }

}
