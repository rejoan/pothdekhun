<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Transport_model extends CI_Model {

    /**
     * get data based on search term
     * @param string $input
     * @param string $col_name
     * @param bool $pagination
     * @return mixed
     */
    public function get_all($input, $col_name, $pagination = FALSE, $per_page = 10, $segment = 3) {
        if (!empty($input)) {
            $poribohon = $this->pm->total_item('poribohons c', 'c.' . $col_name, $input);
            if ($poribohon < 1) {// if not found
                $this->db->select('p.*,u.username');
                $this->db->from('poribohons p');
                $this->db->join('users u', 'p.added_by = u.id', 'left');
                $this->db->like('p.' . $col_name, $input);
            } else {
                $this->db->select('p.*,u.username');
                $this->db->from('poribohons p');
                $this->db->join('users u', 'p.added_by = u.id', 'left');
                $this->db->where('p.' . $col_name, $input);
            }
        } else {
            $this->db->select('p.*,u.username');
            $this->db->from('poribohons p');
            $this->db->join('users u', 'p.added_by = u.id', 'left');
        }
        $this->db->where('p.is_publish', 1);
        $this->db->order_by('p.id', 'desc');
        if (!$pagination) {
            $this->db->limit($per_page, $segment);
        }
        $query = $this->db->get();
        //echo $this->db->last_query();return;
        if ($pagination) {
            return $query->num_rows();
        }
        return $query->result_array();
    }

    public function details($poribohon_id, $num_rows = TRUE) {
        $this->db->select('p.*,u.username');
        $this->db->from('poribohons p');
        $this->db->join('users u', 'p.added_by = u.id', 'left');
        $this->db->where('p.id', $poribohon_id);
        $this->db->order_by('p.id', 'desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($num_rows) {
            return $query->num_rows();
        }
        return $query->row_array();
    }

    public function get_routes($poribohon_id) {
        $query = $this->db->select('r.id r_id,r.poribohon_id,r.from_district,r.to_district,r.from_thana,r.to_thana,r.from_place,r.to_place,rt.from_place fp_bn,rt.to_place tp_bn,d.name district_name, d.bn_name district_name_bn, td.name td_name, td.bn_name td_bn_name')->from('routes r')->join('route_bn rt', 'r.id = rt.route_id', 'left')->join('districts d', 'd.id = r.from_district', 'left')->join('districts td', 'td.id = r.to_district', 'left')->where('r.poribohon_id', $poribohon_id)->get();
        return $query->result_array();
    }

    public function get_counters($poribohon_id) {
        $query = $this->db->select('c.address,d.name, d.bn_name,t.name thana,t.bn_name thana_bn')->from('counter_address c')->join('districts d', 'd.id = c.district', 'left')->join('thanas t', 't.id = c.thana', 'left')->where('c.poribohon_id', $poribohon_id)->get();
        return $query->result_array();
    }

}
