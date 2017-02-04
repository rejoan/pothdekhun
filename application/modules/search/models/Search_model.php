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
    public function routes($district, $thana, $place, $to_district, $to_thana, $to_place, $per_page = 10, $segment = 3, $pagination = FALSE) {

        $sql_thana = $sql_tothana = $sqlt_thana = $sqlt_tothana = $sql_fthana = $sql_tthana = $f_place = $t_place = '';
        $consider_thana = $this->input->get('c', TRUE);
        if ($district != 1 || $district == $to_district || $consider_thana) {//if not dhaka then filter thana
            $sql_thana .= ' AND r.from_thana = ' . $thana;
            $sqlt_thana .= ' AND r.to_thana = ' . $thana;
        }
        if ($to_district != 1 || $district == $to_district || $consider_thana) {
            $sql_tothana .= ' AND r.to_thana = ' . $to_thana;
            $sqlt_tothana .= ' AND r.from_thana = ' . $to_thana;
        }

        $ft_place = $tt_place = '';
        if (!empty($place)) {
            $f_place .= ' AND LOWER(r.from_place) = "' . strtolower($place) . '"';
            $ft_place .= ' AND LOWER(r.to_place) = "' . strtolower($place) . '"';
        }
        if (!empty($to_place)) {
            $t_place .= ' AND LOWER(r.to_place) = "' . strtolower($to_place) . '"';
            $tt_place .= ' AND LOWER(r.from_place) = "' . strtolower($to_place) . '"';
        }
//Step 1: search direct from place and to place
        $this->db->select('r.id r_id, r.from_district, r.to_district, r.from_thana, r.to_thana, r.rent, r.evidence, r.evidence2, r.added, r.transport_type, r.from_place, r.to_place, r.from_latlong, r.to_latlong, r.distance, r.duration, p.name, p.bn_name, r.departure_time, u.username, rt.from_place fp_bn, rt.to_place tp_bn, rt.departure_time dt_bn, rt.translation_status');
        $this->db->from('routes r');
        $this->db->join('route_bn rt', 'r.id = rt.route_id', 'left');
        $this->db->join('poribohons p', 'r.poribohon_id = p.id', 'left');
        $this->db->join('districts d', 'r.from_district = d.id', 'left');
        $this->db->join('districts td', 'r.to_district = td.id', 'left');
        $this->db->join('thanas t', 'r.from_thana = t.id', 'left');
        $this->db->join('thanas th', 'r.to_thana = th.id', 'left');
        $this->db->join('users u', 'r.added_by = u.id', 'left');

        $this->db->where('r.is_publish = 1 AND 
(r.from_district = ' . $district . $sql_thana . $f_place . ' AND r.to_district = ' . $to_district . $sql_tothana . $t_place . ')
OR (r.to_district = ' . $district . $sqlt_thana . $ft_place . ' AND r.from_district = ' . $to_district . $sqlt_tothana . $tt_place . ')', NULL, FALSE);
        if (!$pagination) {
            $this->db->limit($per_page, $segment);
        }
        //$this->db->order_by('r.distance', 'asc');
        $query = $this->db->get();
        if ($pagination) {
            return $query->num_rows();
        }
        //echo $this->db->last_query();
        //var_dump($query->num_rows());return;

        return $query->result_array();
    }

    public function stoppage_routes($place, $stopage_table, $to_place, $per_page, $segment, $pagination, $district, $to_district) {
        //Step 2: search in all including stoppages when not route direct
        $ft = trim($this->input->get('ft', TRUE));
        $th = trim($this->input->get('th', TRUE));
        $from_empty = $to_empty = FALSE;
        $fthana = $this->pm->get_row('id', $ft, 'thanas');
        $tthana = $this->pm->get_row('id', $th, 'thanas');
        if (empty($place)) {
            $place = $fthana[$this->nl->lang_based_data('bn_name', 'name')];
            $from_empty = TRUE;
        }
        if (empty($to_place)) {
            $to_place = $tthana[$this->nl->lang_based_data('bn_name', 'name')];
            $to_empty = TRUE;
        }
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
        if (empty($from_route_id)) {
            return array();
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
        //var_dump($all_routes_id);return;
        if (empty($all_routes_id)) {
            return array();
        }
        $this->db->select('r.id r_id, r.from_district, r.to_district, r.from_thana, r.to_thana, r.rent, r.evidence, r.evidence2, r.added, r.transport_type, r.from_place, r.to_place, r.from_latlong, r.to_latlong, r.distance, r.duration, p.name, p.bn_name, r.departure_time, u.username,t.name thana_name,t.bn_name thana_name_bn,th.name th_thana_name,th.bn_name th_thana_name_bn, d.name district_name, d.bn_name district_name_bn, td.name td_name, td.bn_name td_bn_name, rt.from_place fp_bn, rt.to_place tp_bn, rt.departure_time dt_bn, rt.translation_status');
        $this->db->from('routes r');
        $this->db->join('route_bn rt', 'r.id = rt.route_id', 'left');
        $this->db->join('poribohons p', 'r.poribohon_id = p.id', 'left');
        $this->db->join('districts d', 'r.from_district = d.id', 'left');
        $this->db->join('districts td', 'r.to_district = td.id', 'left');
        $this->db->join('thanas t', 'r.from_thana = t.id', 'left');
        $this->db->join('thanas th', 'r.to_thana = th.id', 'left');
        $this->db->join('users u', 'r.added_by = u.id', 'left');
        $this->db->where('r.is_publish = 1 AND  r.id IN(' . $all_routes_id . ') AND
r.from_district = ' . $district . ' AND r.to_district = ' . $to_district, NULL, FALSE);
        if (!$pagination) {
            $this->db->limit($per_page, $segment);
        }
        //$this->db->order_by('r.distance', 'asc');
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * 
     * @param type $place
     * @param type $stopage_table
     * @param type $to_place
     * @return type
     */
    public function get_suggestions($place, $stopage_table, $to_place, $per_page, $segment, $pagination, $district, $to_district) {
        $ft = trim($this->input->get('ft', TRUE));
        $th = trim($this->input->get('th', TRUE));
        $from_empty = $to_empty = FALSE;
        $fthana = $this->pm->get_row('id', $ft, 'thanas');
        $tthana = $this->pm->get_row('id', $th, 'thanas');
        if (empty($place)) {
            $place = $fthana[$this->nl->lang_based_data('bn_name', 'name')];
            $from_empty = TRUE;
        }
        if (empty($to_place)) {
            $to_place = $tthana[$this->nl->lang_based_data('bn_name', 'name')];
            $to_empty = TRUE;
        }
        $all_place_q = $this->db->query('SELECT * FROM (SELECT id route_id,from_place Location
                        FROM routes
                        WHERE LOWER(REPLACE(from_place, " ", "")) LIKE LOWER(REPLACE("' . $place . '", " ", "")) OR from_place LIKE "%' . $place . '%" UNION DISTINCT
                        SELECT id route_id,to_place
                        FROM routes
                        WHERE LOWER(REPLACE(to_place, " ", "")) LIKE LOWER(REPLACE("' . $place . '", " ", "")) OR to_place LIKE "%' . $place . '%"  UNION DISTINCT
                        SELECT s.route_id,s.place_name
                        FROM ' . $stopage_table . '
                        WHERE LOWER(REPLACE(s.place_name, " ", "")) LIKE LOWER(REPLACE("' . $place . '", " ", "")) OR place_name LIKE "%' . $place . '%" 
                        ) AS rtn');
        //echo $this->db->last_query();return;
        $all_places = $all_place_q->result_array();
        $from_route_id = $this->nl->get_all_ids($all_places, 'route_id');
        //var_dump($from_route_id);return;
        if (empty($from_route_id)) {
            return array();
        }
        $to_place_q = $this->db->query('SELECT * FROM (SELECT id route_id,from_place Location
                        FROM routes
                        WHERE LOWER(REPLACE(from_place, " ", "")) LIKE LOWER(REPLACE("' . $to_place . '", " ", "")) OR from_place LIKE "%' . $to_place . '%"  UNION DISTINCT
                        SELECT id route_id,to_place
                        FROM routes
                        WHERE LOWER(REPLACE(to_place, " ", "")) LIKE LOWER(REPLACE("' . $to_place . '", " ", "")) OR to_place LIKE "%' . $to_place . '%"  UNION DISTINCT
                        SELECT s.route_id,s.place_name
                        FROM ' . $stopage_table . '
                        WHERE LOWER(REPLACE(s.place_name, " ", "")) LIKE LOWER(REPLACE("' . $to_place . '", " ", "")) OR place_name LIKE "%' . $to_place . '%" 
                        ) AS fm WHERE route_id IN (' . $from_route_id . ')');
        //echo $this->db->last_query();return;
        $to_places = $to_place_q->result_array();
        $all_routes_id = $this->nl->get_all_ids($to_places, 'route_id');
        //var_dump($all_routes_id);return;
        if (empty($all_routes_id)) {
            return array();
        }
        return $this->final_result($all_routes_id, $per_page, $segment, $pagination, $district, $to_district);
//        $suggestion_ids = $this->nl->get_all_ids($suggestions, 'r_id');
//        return explode(',', $suggestion_ids);
    }

    /**
     * 
     * @param type $place
     * @param type $stopage_table
     * @param type $per_page
     * @param type $segment
     * @param type $pagination
     * @param type $district
     * @return type
     */
    public function place_get_suggestions($place, $stopage_table, $district, $per_page, $segment, $pagination) {

        $all_place_q = $this->db->query('SELECT * FROM (SELECT id route_id,from_place Location
                        FROM routes
                        WHERE LOWER(REPLACE(from_place, " ", "")) LIKE LOWER(REPLACE("' . $place . '", " ", "")) OR from_place LIKE "%' . $place . '%" UNION DISTINCT
                        SELECT id route_id,to_place
                        FROM routes
                        WHERE LOWER(REPLACE(to_place, " ", "")) LIKE LOWER(REPLACE("' . $place . '", " ", "")) OR to_place LIKE "%' . $place . '%"  UNION DISTINCT
                        SELECT s.route_id,s.place_name
                        FROM ' . $stopage_table . '
                        WHERE LOWER(REPLACE(s.place_name, " ", "")) LIKE LOWER(REPLACE("' . $place . '", " ", "")) OR place_name LIKE "%' . $place . '%" 
                        ) AS rtn');
        //echo $this->db->last_query();return;
        $all_places = $all_place_q->result_array();
        $route_ids = $this->nl->get_all_ids($all_places, 'route_id');
        //var_dump($route_ids);return;
        if (empty($route_ids)) {
            return array();
        }

        return $this->final_result($route_ids, $per_page, $segment, $pagination, $district, $district);
//        $suggestion_ids = $this->nl->get_all_ids($suggestions, 'r_id');
//        return explode(',', $suggestion_ids);
    }

    /**
     * 
     * @param type $all_routes_id
     * @param type $per_page
     * @param type $segment
     * @param type $pagination
     * @return type
     */
    public function final_result($all_routes_id, $per_page, $segment, $pagination, $district, $to_district) {

        $this->db->select('r.id r_id, r.from_district, r.to_district, r.from_thana, r.to_thana, r.rent, r.evidence, r.evidence2, r.added, r.transport_type, r.from_place, r.to_place, r.from_latlong, r.to_latlong, r.distance, r.duration, p.name, p.bn_name, r.departure_time, u.username,t.name thana_name,t.bn_name thana_name_bn,th.name th_thana_name,th.bn_name th_thana_name_bn, d.name district_name, d.bn_name district_name_bn, td.name td_name, td.bn_name td_bn_name, rt.from_place fp_bn, rt.to_place tp_bn, rt.departure_time dt_bn, rt.translation_status');
        $this->db->from('routes r');
        $this->db->join('route_bn rt', 'r.id = rt.route_id', 'left');
        $this->db->join('poribohons p', 'r.poribohon_id = p.id', 'left');
        $this->db->join('districts d', 'r.from_district = d.id', 'left');
        $this->db->join('districts td', 'r.to_district = td.id', 'left');
        $this->db->join('thanas t', 'r.from_thana = t.id', 'left');
        $this->db->join('thanas th', 'r.to_thana = th.id', 'left');
        $this->db->join('users u', 'r.added_by = u.id', 'left');
        $this->db->where('r.is_publish = 1 AND  r.id IN(' . $all_routes_id . ') AND
(r.from_district = ' . $district . ' AND r.to_district = ' . $to_district . ')', NULL, FALSE);
        if (!$pagination) {
            $this->db->limit($per_page, $segment);
        }
        //$this->db->order_by('r.distance', 'asc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($pagination) {
            return $query->num_rows();
        }
        return $query->result_array();
    }

    /**
     * 
     * @param type $district
     * @param type $thana
     * @param type $place_name
     * @return type
     */
    public function get_routes($place_name, $district, $pagination = FALSE, $per_page = 5, $segment = 3) {
        $place_fsql = ' AND r.from_place = "' . $place_name.'"';
        $place_tsql = ' AND r.to_place = "' . $place_name.'"';

        if (empty($place_name)) {
            $place_fsql = $place_tsql = '';
        }

//Step 1: search direct from place and to place
        $this->db->select('r.id r_id, r.from_district, r.to_district, r.from_thana, r.to_thana, r.rent, r.evidence, r.evidence2, r.added, r.transport_type, r.from_place, r.to_place, r.from_latlong, r.to_latlong, r.distance, r.duration, p.name, p.bn_name, r.departure_time, u.username, rt.from_place fp_bn, rt.to_place tp_bn, rt.departure_time dt_bn, rt.translation_status');
        $this->db->from('routes r');
        $this->db->join('route_bn rt', 'r.id = rt.route_id', 'left');
        $this->db->join('poribohons p', 'r.poribohon_id = p.id', 'left');
        $this->db->join('districts d', 'r.from_district = d.id', 'left');
        $this->db->join('districts td', 'r.to_district = td.id', 'left');
        $this->db->join('thanas t', 'r.from_thana = t.id', 'left');
        $this->db->join('thanas th', 'r.to_thana = th.id', 'left');
        $this->db->join('users u', 'r.added_by = u.id', 'left');

        $this->db->where('r.is_publish = 1 AND (r.from_district = ' . $district . $place_fsql . ') OR (r.to_district = ' . $district . $place_tsql . ')', NULL, FALSE);
        if (!$pagination) {
            $this->db->limit($per_page, $segment);
        }
        //$this->db->order_by('r.distance', 'asc');
        $query = $this->db->get();
        if ($pagination) {
            return $query->num_rows();
        }
        //echo $this->db->last_query();return;
        //var_dump($query->num_rows());return;

        return $query->result_array();
    }

    public function get_thana_id($col_name, $col_val) {
        $query = $this->db->where($col_name, $col_val)->get('thanas');
        //echo $this->db->last_query();return;
        $result = $query->row_array();
        return $result['id'];
    }

    public function possible_collections($place, $stopage_table, $to_place, $per_page, $segment, $pagination, $district, $to_district) {
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
            if (empty($all_routes_id)) {
                return array();
            }
            return $this->final_result($all_routes_id, $per_page, $segment, $pagination, $district, $to_district);
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
            //var_dump($all_routes_id);return;
            if (empty($all_routes_id)) {
                return array();
            }
            return $this->final_result($all_routes_id, $per_page, $segment, $pagination, $district, $to_district);
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
            //var_dump($all_routes_id);return;
            if (empty($all_routes_id)) {
                return array();
            }
            return $this->final_result($all_routes_id, $per_page, $segment, $pagination, $district, $to_district);
        }
        return array();
    }

    public function place_possible_collections($place, $stopage_table, $district, $per_page, $segment, $pagination) {

        $query = $this->db->query('SELECT *
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
                                    ) AS ftq ORDER BY place ASC LIMIT 20');
        //echo $this->db->last_query();return;
        $routes_ids = $this->nl->get_all_ids($query->result_array(), 'route_id');
        if (!empty($routes_ids)) {

            return $this->final_result($routes_ids, $per_page, $segment, $pagination, $district, $district);
        }
        return array();
    }

    /**
     * 
     * @param type $place
     * @param type $stopage_table
     * @param type $district
     * @param type $per_page
     * @param type $segment
     * @param type $pagination
     * @return type
     */
    public function place_stoppage_routes($place, $stopage_table, $district, $per_page, $segment, $pagination) {
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
        $route_ids = $this->nl->get_all_ids($all_places, 'route_id');
        if (empty($route_ids)) {
            return array();
        }
        return $this->final_result($route_ids, $per_page, $segment, $pagination, $district, $district);
    }

}
