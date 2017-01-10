<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Search_model extends CI_Model {

    public function get_routes($from_district, $from_place, $to_district, $to_place, $pagination = FALSE) {
		$sql = 'SELECT r.id,r.to_place,r.from_place,r.transport_type,r.rent,p.name,p.bn_name
                FROM routes r
				LEFT JOIN poribohons p ON p.id = r.poribohon_id
                WHERE r.from_district = ' . $from_district . ' AND (r.from_place = "' . $from_place . '" OR r.to_place = "' . $from_place . '") AND r.to_district = ' . $to_district . ' AND  (r.from_place = "' . $to_place . '" OR r.to_place = "' . $to_place . '")';
        


        if ($this->session->lang_code == 'bn') {
            $sql = 'SELECT r.id,rt.to_place,r.added,rt.from_place,r.transport_type,p.name,p.bn_name,r.rent
                FROM routes r LEFT JOIN route_bn rt ON r.id = rt.route_id
                LEFT JOIN poribohons p ON p.id = r.poribohon_id
                WHERE r.from_district = ' . $from_district . ' AND (rt.from_place = "' . $from_place . '" OR rt.to_place = "' . $from_place . '") AND r.to_district = ' . $to_district . ' AND  (rt.from_place = "' . $to_place . '" OR rt.to_place = "' . $to_place . '")';
        }
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if($pagination){
            return $query->num_rows();
        }
        return $query->result_array() ;
    }

}
