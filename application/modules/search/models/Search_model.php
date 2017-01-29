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
//Step 1: search direct from place and to place
        $query = $this->db->query('SELECT r.id r_id, r.from_district, r.to_district, r.from_thana, r.to_thana, r.rent, r.evidence, r.evidence2, r.added, r.transport_type, r.from_place, r.to_place, r.from_latlong, r.to_latlong, r.distance, r.duration, p.name, p.bn_name, r.departure_time, u.username, d.name district_name, d.bn_name district_name_bn, td.name td_name, td.bn_name td_bn_name, rt.from_place fp_bn, rt.to_place tp_bn, rt.departure_time dt_bn, rt.translation_status
                    FROM routes r
                    LEFT JOIN route_bn rt ON r.id = rt.route_id
                    LEFT JOIN poribohons p ON r.poribohon_id = p.id
                    LEFT JOIN districts d ON r.from_district = d.id
                    LEFT JOIN districts td ON r.to_district = td.id
                    LEFT JOIN users u ON r.added_by = u.id
WHERE r.is_publish = 1 AND ((r.from_district = ' . $district . ' AND LOWER(r.from_place) = "' . $place . '") OR (r.to_district = ' . $district . ' AND LOWER(r.to_place) = "' . $place . '")) AND ((r.to_district = ' . $to_district . ' AND (LOWER(r.to_place) = "' . $to_place . '"' . $sql_tothana . ')) OR (r.from_district = ' . $to_district . ' AND (LOWER(r.from_place) = "' . $to_place . '"' . $sql_thana . ')))');
        //echo $this->db->last_query();return;
        //var_dump($query->num_rows());return;
        if ($query->num_rows() > 0) {//if route found
            return array($query->result_array(), $found_in);
        }
        //Step 2: search in all including stoppages when not route direct
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
        //var_dump($from_route_id);return;
        if (!empty($from_route_id)) {//if found in stoppages
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
            if (!empty($all_routes_id)) {//found in stoppages
                $found_in = 'stoppage';
                return array($this->final_result($all_routes_id), $found_in);
            }
        }

        //Step 3: search for suggestions
        $suggestions = $this->get_suggestions($place, $stopage_table, $to_place);
        if (!empty($suggestions)) {//if even suggestion not found
            $found_in = 'suggestion';
            return array($suggestions, $found_in);
        }
        $found_in = 'possible';
        //var_dump($found_in);return;
        return array($this->possible_collections($place, $stopage_table, $to_place), $found_in);
    }

    /**
     * 
     * @param type $place
     * @param type $stopage_table
     * @param type $to_place
     * @return type
     */
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
        return $this->final_result($all_routes_id);
    }

    public function final_result($all_routes_id) {
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
    public function get_routes($district, $thana, $place_name, $pagination = FALSE, $per_page = 5, $segment = 3) {
        $sql_thana = $sql_tothana = $found_in = '';
        if (!empty($thana)) {
            $col_name = $this->nl->lang_based_data('bn_name', 'name');
            $thana_id = $this->sm->get_thana_id($col_name, $thana);
            //var_dump($thana_id);return;

            if ($district != 1) {//if not dhaka then filter thana
                $sql_thana .= ' AND r.from_thana = ' . $thana_id;
            }
            if ($district != 1) {
                $sql_tothana .= ' AND r.to_thana = ' . $thana_id;
            }
        }
        $stoppage_table = $this->nl->lang_based_data('stoppage_bn', 'stoppages', ' s');
        $this->db->select('r.id r_id, r.from_district, r.to_district, r.from_thana, r.to_thana, r.rent, r.evidence, r.evidence2, r.added, r.transport_type, r.from_place, r.to_place, r.from_latlong, r.to_latlong, r.distance, r.duration, p.name, p.bn_name, r.departure_time, u.username, d.name district_name, d.bn_name district_name_bn, td.name td_name, td.bn_name td_bn_name, rt.from_place fp_bn, rt.to_place tp_bn, rt.departure_time dt_bn, rt.translation_status');

        $this->db->from($stoppage_table);
        $this->db->join('routes r', 'r.id = s.route_id', 'left');
        $this->db->join('route_bn rt', 's.route_id = rt.route_id', 'left');
        $this->db->join('poribohons p', 'r.poribohon_id = p.id', 'left');
        $this->db->join('districts d', 'r.from_district = d.id', 'left');
        $this->db->join(' districts td', 'r.to_district = td.id', 'left');
        $this->db->join('users u', 'r.added_by = u.id', 'left');
        $this->db->where('r.is_publish = 1 AND  ((r.from_district = ' . $district . $sql_thana . ' AND LOWER(r.from_place) = "' . $place_name . '") OR (r.to_district = ' . $district . $sql_tothana . ' AND LOWER(r.to_place) = "' . $place_name . '")) OR s.place_name = "' . $place_name . '"', NULL, FALSE);
        $this->db->group_by('r.id');
        if (!$pagination) {
            $this->db->limit($per_page, $segment);
        }
        $query = $this->db->get();
        if ($pagination) {
            return $query->num_rows();
        }
        //echo $this->db->last_query();
        $found_in = 'places';
        return array($query->result_array(), $found_in);
    }

    public function get_thana_id($col_name, $col_val) {
        $query = $this->db->where($col_name, $col_val)->get('thanas');
        //echo $this->db->last_query();return;
        $result = $query->row_array();
        return $result['id'];
    }

    public function possible_collections($place, $stopage_table, $to_place) {
        $fquery = $this->db->query('SELECT *
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

        if ($fquery->num_rows() > 0) {// when from place exact found in places including stoppages
            $query = $this->db->query('SELECT *
                                    FROM (
                                    SELECT id route_id
                                    FROM routes
                                    WHERE to_place SOUNDS LIKE "' . $to_place . '" UNION DISTINCT
                                    SELECT id route_id
                                    FROM routes
                                    WHERE from_place SOUNDS LIKE "' . $to_place . '" UNION DISTINCT
                                    SELECT route_id
                                    FROM ' . $stopage_table . '
                                    WHERE place_name SOUNDS LIKE "' . $to_place . '"
                                    ) AS rtn');
            $all_routes_id = $this->nl->get_all_ids($query->result_array(), 'route_id');
            return $this->final_result($all_routes_id);
        }

        $tquery = $this->db->query('SELECT *
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
                                    ) AS rtn');

        if ($tquery->num_rows() > 0) {
            // when to place exact found in places including stoppages
            $query = $this->db->query('SELECT *
                                    FROM (
                                    SELECT id route_id
                                    FROM routes
                                    WHERE to_place SOUNDS LIKE "' . $place . '" UNION DISTINCT
                                    SELECT id route_id
                                    FROM routes
                                    WHERE from_place SOUNDS LIKE "' . $place . '" UNION DISTINCT
                                    SELECT route_id
                                    FROM ' . $stopage_table . '
                                    WHERE place_name SOUNDS LIKE "' . $place . '"
                                    ) AS rtn');
            $all_routes_id = $this->nl->get_all_ids($query->result_array(), 'route_id');
            return $this->final_result($all_routes_id);
        }

        $ftquery = $this->db->query('SELECT *
                                    FROM (
                                    SELECT id route_id, to_place place
                                    FROM routes
                                    WHERE to_place SOUNDS LIKE "' . $place . '" UNION DISTINCT
                                    SELECT id route_id, from_place place
                                    FROM routes
                                    WHERE from_place SOUNDS LIKE "' . $place . '" UNION DISTINCT
                                    SELECT route_id, place_name place
                                    FROM ' . $stopage_table . '
                                    WHERE place_name SOUNDS LIKE "' . $place . '"
                                    ) AS ftq ORDER BY place ASC LIMIT 12');
        //echo $this->db->last_query();return;
        $from_routes_id = $this->nl->get_all_ids($ftquery->result_array(), 'route_id');
        if (!empty($from_routes_id)) {
            // when not any exact match then both search for possible match
            $query = $this->db->query('SELECT *
                                    FROM (
                                    SELECT id route_id, to_place tplace
                                    FROM routes
                                    WHERE to_place SOUNDS LIKE "' . $to_place . '" UNION DISTINCT
                                    SELECT id route_id, from_place tplace
                                    FROM routes
                                    WHERE from_place SOUNDS LIKE "' . $to_place . '" UNION DISTINCT
                                    SELECT route_id, place_name tplace
                                    FROM ' . $stopage_table . '
                                    WHERE place_name SOUNDS LIKE "' . $to_place . '"
                                    ) AS rtn WHERE rtn.route_id IN (' . $from_routes_id . ') ORDER BY tplace ASC LIMIT 7');
            //echo $this->db->last_query();return;
            $all_routes_id = $this->nl->get_all_ids($query->result_array(), 'route_id');
            return $this->final_result($all_routes_id);
        }
        return array();
    }

}
