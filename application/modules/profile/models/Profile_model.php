<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Profile_model extends CI_Model {

    public function get_profile($user_id) {
        $query = $this->db->select('p.first_name,p.last_name,p.about,p.occupation,p.thana,p.district,p.about,u.username,u.id user_id,u.email,u.reputation,u.avatar,u.mobile,u.password,d.name,d.bn_name,t.name th_name,t.bn_name thbn_name')->from('users u')->join('profiles p', 'u.id = p.user_id', 'left')->join('districts d','d.id = p.district','left')->join('thanas t','t.id = p.thana','left')->where('u.id', $user_id)->get();
        return $query->row_array();
    }
    
    public function get_all($user_id, $per_page = 10, $segment = 3, $d = NULL, $t = NULL, $ttype = NULL) {
        $this->db->select('r.id,r.from_place,r.to_place,r.transport_type,r.added,r.is_publish,u.username,rbn.from_place fp_bn,rbn.to_place tp_bn,rbn.departure_time,p.name,p.bn_name');
        $this->db->from('routes r')->join('users u', 'r.added_by = u.id', 'left');
        $this->db->join('route_bn rbn', 'rbn.route_id = r.id', 'left');
        $this->db->join('poribohons p', 'r.poribohon_id = p.id', 'left');
        //$this->db->where('r.is_publish', 1);
        if (!empty($ttype)) {
            $this->db->where('r.transport_type', $ttype);
        }
        if (!empty($d)) {
            //$this->db->where('r.from_district', $d)->or_where('r.to_district', $d);
            $sql = '(r.from_district = ' . $d . ' OR ' . 'r.to_district)';
            if (!empty($t) && $d != 1) {
                //$this->db->where('r.from_thana', $t)->or_where('r.to_thana', $t);
                $sql .= 'AND (r.from_thana = ' . $t . ' OR r.to_thana = ' . $t . ')';
            }
            $this->db->where($sql, NULL, FALSE);
        }
        $this->db->where('r.added_by',$user_id);
        $this->db->order_by('r.id', 'desc');
        $this->db->limit($per_page, $segment);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

}
