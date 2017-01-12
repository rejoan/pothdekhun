<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Search_model extends CI_Model {

    public function routes($district, $thana, $place, $to_district, $to_thana, $to_place) {
        $cond = array(
            'r.from_district' => $district,
            'LOWER(r.from_place)' => strtolower($place),
            'r.to_district' => $to_district,
            'LOWER(r.to_place)' => strtolower($to_place)
        );
        if($district != 1){//if not dhaka then filter thana
            $cond['r.from_thana'] = $thana;
        }
        if($to_district != 1){
            $cond['r.to_thana'] = $to_thana;
        }
        
        $query = $this->db->select('r.id r_id,r.from_district,r.to_district,r.from_thana,r.to_thana, r.rent,r.evidence,r.evidence2,r.added,r.transport_type,r.from_place,r.to_place,r.from_latlong,r.to_latlong,r.distance,r.duration,p.name,p.bn_name,r.departure_time,u.username,d.name district_name,d.bn_name district_name_bn,td.name td_name,td.bn_name td_bn_name,rt.from_place fp_bn,rt.to_place tp_bn,rt.departure_time dt_bn,rt.translation_status')->from('routes r')->join('route_bn rt', 'r.id = rt.route_id', 'left')->join('poribohons p', 'r.poribohon_id = p.id', 'left')->join('districts d', 'r.from_district = d.id', 'left')->join('districts td', 'r.to_district = td.id', 'left')->join('users u', 'r.added_by = u.id', 'left')->where($cond)->get();
        //echo $this->db->last_query();
        return $query->result_array();
        
    }

    public function get_routes() {
        
    }

}
