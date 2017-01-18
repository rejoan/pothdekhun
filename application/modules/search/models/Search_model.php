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
        $sql_thana = $sql_tothana = '';
        if ($district != 1) {//if not dhaka then filter thana
            $sql_thana .= ' AND r.from_thana = ' . $thana;
        }
        if ($to_district != 1) {
            $sql_tothana .= ' AND r.to_thana = ' . $to_thana;
        }


        $query = $this->db->query('SELECT r.id r_id, r.from_district, r.to_district, r.from_thana, r.to_thana, r.rent, r.evidence, r.evidence2, r.added, r.transport_type, r.from_place, r.to_place, r.from_latlong, r.to_latlong, r.distance, r.duration, p.name, p.bn_name, r.departure_time, u.username, d.name district_name, d.bn_name district_name_bn, td.name td_name, td.bn_name td_bn_name, rt.from_place fp_bn, rt.to_place tp_bn, rt.departure_time dt_bn, rt.translation_status
FROM routes r
LEFT JOIN route_bn rt ON r.id = rt.route_id
LEFT JOIN poribohons p ON r.poribohon_id = p.id
LEFT JOIN districts d ON r.from_district = d.id
LEFT JOIN districts td ON r.to_district = td.id
LEFT JOIN users u ON r.added_by = u.id
WHERE ((r.from_district = ' . $district . ' AND LOWER(r.from_place) = "' . $place . '") OR (r.to_district = ' . $district . ' AND LOWER(r.to_place) = "' . $place . '")) AND ((r.to_district = ' . $to_district . ' AND (LOWER(r.to_place) = "' . $to_place . '"' . $sql_tothana . ')) OR (r.from_district = ' . $to_district . ' AND (LOWER(r.from_place) = "' . $to_place . '"' . $sql_thana . ')))');
        //echo $this->db->last_query();
        return $query->result_array();
    }

    public function get_routes() {
        
    }

}
