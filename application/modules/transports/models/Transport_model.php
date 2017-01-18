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
            if ($poribohon < 1) {
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

}
