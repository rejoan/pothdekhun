<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Search_model extends CI_Model {

    /**
     * 
     * @param int $district
     * @param int $thana
     * @param string $place
     * @param int $to_district
     * @param int $to_thana
     * @param string $to_place
     * @return array
     */
    public function routes($district, $thana, $place, $to_district, $to_thana, $to_place, $stopage_table) {

        $sql_thana = $sql_tothana = '';
        $found_in = 'main';
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
WHERE r.is_publish = 1 AND ((r.from_district = ' . $district . ' AND LOWER(r.from_place) = "' . $place . '") OR (r.to_district = ' . $district . ' AND LOWER(r.to_place) = "' . $place . '")) AND ((r.to_district = ' . $to_district . ' AND (LOWER(r.to_place) = "' . $to_place . '"' . $sql_tothana . ')) OR (r.from_district = ' . $to_district . ' AND (LOWER(r.from_place) = "' . $to_place . '"' . $sql_thana . ')))');
        if ($query->num_rows() < 1) {// if no route found
            //$all_places = $this->pm->get_data($stopage_table, 'route_id', 'place_name', $place);
            $all_place_q = $this->db->query('SELECT *
                                            FROM (
                                            SELECT id route_id
                                            FROM routes
                                            WHERE to_place = "' . $place . '" UNION DISTINCT
                                            SELECT id route_id
                                            FROM routes
                                            WHERE from_place = "' . $place . '" UNION DISTINCT
                                            SELECT route_id
                                            FROM ' . $stopage_table . '
                                            WHERE place_name = "' . $place . '"
                                            ) AS rtn');
            //echo $this->db->last_query();return;
            $all_places = $all_place_q->result_array();
            $from_route_id = $this->nl->get_all_ids($all_places, 'route_id');

            if (empty($from_route_id)) {
                $found_in = 'suggestion';
                return array($this->get_suggestions($place, $stopage_table, $to_place), $found_in);
            }
            $to_place_q = $this->db->query('SELECT *
                                            FROM (
                                            SELECT id route_id
                                            FROM routes
                                            WHERE to_place = "' . $to_place . '" UNION DISTINCT
                                            SELECT id route_id
                                            FROM routes
                                            WHERE from_place = "' . $to_place . '" UNION DISTINCT
                                            SELECT route_id
                                            FROM ' . $stopage_table . '
                                            WHERE place_name = "' . $to_place . '"
                                            ) AS tm WHERE route_id IN (' . $from_route_id . ')');
            //echo $this->db->last_query();return;
            $to_places = $to_place_q->result_array();
            $all_routes_id = $this->nl->get_all_ids($to_places, 'route_id');
            if (empty($all_routes_id)) {
                $found_in = 'not_found';
                return array(array(), $found_in);
            }
            //var_dump($all_routes_id);return;
            $query = $this->db->query('SELECT r.id r_id, r.from_district, r.to_district, r.from_thana, r.to_thana, r.rent, r.evidence, r.evidence2, r.added, r.transport_type, r.from_place, r.to_place, r.from_latlong, r.to_latlong, r.distance, r.duration, p.name, p.bn_name, r.departure_time, u.username, d.name district_name, d.bn_name district_name_bn, td.name td_name, td.bn_name td_bn_name, rt.from_place fp_bn, rt.to_place tp_bn, rt.departure_time dt_bn, rt.translation_status 
                    FROM routes r 
                    LEFT JOIN route_bn rt ON rt.route_id = r.id 
                    LEFT JOIN poribohons p ON p.id = r.poribohon_id 
                    LEFT JOIN users u ON r.added_by = u.id 
                    LEFT JOIN districts d ON r.from_district = d.id 
                    LEFT JOIN districts td ON r.to_district = td.id 
                    WHERE r.is_publish = 1 AND  r.id IN(' . $all_routes_id . ')');
            $found_in = 'stoppage';
            //echo $this->db->last_query();
        }
        return array($query->result_array(), $found_in);
    }

    public function get_suggestions($place, $stopage_table, $to_place) {
        $all_place_q = $this->db->query('SELECT * FROM (SELECT id route_id,from_place Location
                        FROM routes
                        WHERE LOWER(REPLACE(from_place, " ", "")) LIKE LOWER(REPLACE("' . $place . '", " ", "")) UNION DISTINCT
                        SELECT id route_id,to_place
                        FROM routes
                        WHERE LOWER(REPLACE(to_place, " ", "")) LIKE LOWER(REPLACE("' . $place . '", " ", "")) UNION DISTINCT
                        SELECT s.route_id,s.place_name
                        FROM ' . $stopage_table . '
                        WHERE LOWER(REPLACE(s.place_name, " ", "")) LIKE LOWER(REPLACE("' . $place . '", " ", ""))
                        ) AS rtn');
        //echo $this->db->last_query();return;
        $all_places = $all_place_q->result_array();
        $from_route_id = $this->nl->get_all_ids($all_places, 'route_id');

        if (empty($from_route_id)) {
            return array();
        }
        $to_place_q = $this->db->query('SELECT * FROM (SELECT id route_id,from_place Location
                        FROM routes
                        WHERE LOWER(REPLACE(from_place, " ", "")) LIKE LOWER(REPLACE("' . $to_place . '", " ", "")) UNION DISTINCT
                        SELECT id route_id,to_place
                        FROM routes
                        WHERE LOWER(REPLACE(to_place, " ", "")) LIKE LOWER(REPLACE("' . $to_place . '", " ", "")) UNION DISTINCT
                        SELECT s.route_id,s.place_name
                        FROM ' . $stopage_table . '
                        WHERE LOWER(REPLACE(s.place_name, " ", "")) LIKE LOWER(REPLACE("' . $to_place . '", " ", ""))
                        ) AS fm WHERE route_id IN (' . $from_route_id . ')');
        //echo $this->db->last_query();return;
        $to_places = $to_place_q->result_array();
        $all_routes_id = $this->nl->get_all_ids($to_places, 'route_id');
        if (empty($all_routes_id)) {
            return array();
        }
        $query = $this->db->query('SELECT r.id r_id, r.from_district, r.to_district, r.from_thana, r.to_thana, r.rent, r.evidence, r.evidence2, r.added, r.transport_type, r.from_place, r.to_place, r.from_latlong, r.to_latlong, r.distance, r.duration, p.name, p.bn_name, r.departure_time, u.username, d.name district_name, d.bn_name district_name_bn, td.name td_name, td.bn_name td_bn_name, rt.from_place fp_bn, rt.to_place tp_bn, rt.departure_time dt_bn, rt.translation_status 
                    FROM routes r 
                    LEFT JOIN route_bn rt ON rt.route_id = r.id 
                    LEFT JOIN poribohons p ON p.id = r.poribohon_id 
                    LEFT JOIN users u ON r.added_by = u.id 
                    LEFT JOIN districts d ON r.from_district = d.id 
                    LEFT JOIN districts td ON r.to_district = td.id 
                    WHERE r.is_publish = 1 AND r.id IN(' . $all_routes_id . ')');
        return $query->result_array();
    }

    /**
     * 
     * @param type $district
     * @param type $thana
     * @param type $place_name
     * @return type
     */
    public function get_routes($district, $thana, $place_name) {
        $sql_thana = $sql_tothana = $found_in = '';
        if ($district != 1) {//if not dhaka then filter thana
            $sql_thana .= ' AND r.from_thana = ' . $thana;
        }
        if ($district != 1) {
            $sql_tothana .= ' AND r.to_thana = ' . $thana;
        }
        $query = $this->db->query('SELECT r.id r_id, r.from_district, r.to_district, r.from_thana, r.to_thana, r.rent, r.evidence, r.evidence2, r.added, r.transport_type, r.from_place, r.to_place, r.from_latlong, r.to_latlong, r.distance, r.duration, p.name, p.bn_name, r.departure_time, u.username, d.name district_name, d.bn_name district_name_bn, td.name td_name, td.bn_name td_bn_name, rt.from_place fp_bn, rt.to_place tp_bn, rt.departure_time dt_bn, rt.translation_status
                    FROM routes r
                    LEFT JOIN route_bn rt ON r.id = rt.route_id
                    LEFT JOIN poribohons p ON r.poribohon_id = p.id
                    LEFT JOIN districts d ON r.from_district = d.id
                    LEFT JOIN districts td ON r.to_district = td.id
                    LEFT JOIN users u ON r.added_by = u.id
WHERE r.is_publish = 1 AND  ((r.from_district = ' . $district . ' AND LOWER(r.from_place) = "' . $place_name . '") OR (r.to_district = ' . $district . ' AND LOWER(r.to_place) = "' . $place_name . '"))');
        //echo $this->db->last_query();
        $found_in = 'places';
        return array($query->result_array(), $found_in);
    }

    public function get_thana_id($col_name, $col_val) {
        $query = $this->db->where($col_name, $col_val)->get('thanas');
        $result = $query->row_array();
        return $result['id'];
    }

}
