<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Notification_model extends CI_Model {

    public function get_notification($id, $table) {
        $cond = array(
            'n.id' => $id
        );
        if ($table == 'route_points') {
            $this->db->select('n.*,r.from_place,r.to_place,d.name district_name,d.bn_name district_name_bn,td.name td_name,td.bn_name td_bn_name,rt.from_place fp_bn,rt.to_place tp_bn');
            $this->db->from('route_points n');
            $this->db->join('routes r', 'r.id = n.route_id', 'left');
            $this->db->join('districts d', 'r.from_district = d.id', 'left');
            $this->db->join('districts td', 'r.to_district = td.id', 'left');
            $this->db->join('route_bn rt', 'rt.route_id = n.route_id', 'left');
        } else {
            $this->db->select('n.*,p.id transport_id,p.name,p.bn_name');
            $this->db->from('transport_points n');
            $this->db->join('poribohons p', 'p.id = n.transport_id', 'left');
        }

        $this->db->where($cond);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function total_notifications($user_id) {
        $cond = array(
            'user_id' => $user_id,
            'is_read' => 0
        );
        $query = $this->db->where($cond)->get('notifications');
        $total_unread = $query->num_rows();
        return $total_unread;
    }

}
