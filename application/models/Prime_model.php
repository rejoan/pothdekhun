<?php

/**
 * master model by rejoanul alam
 */
class Prime_model extends CI_Model {

    /**
     * insert data to any table
     * @param string $table
     * @param array $data
     */
    public function insert_data($table, $data) {
        $data = preg_replace('%[<>\/"\%$\^\'!]%', '', $data);
        $this->db->insert($table, $data);
    }

    /**
     * get data form table based on one/two where conditon
     * @param string $table_name
     * @param mixed $id_name
     * @param mixed $id
     * @param mixed $last_field
     * @param mixed $field_val
     * @param string $logical
     * @param string $order_by
     * @param string $sorter
     * @param int $start
     * @param int $how_many
     * @return array
     */
    public function get_data($table_name, $id_name = FALSE, $id = FALSE, $last_field = FALSE, $field_val = FALSE, $logical = FALSE, $order_by = FALSE, $sorter = FALSE, $start = FALSE, $how_many = FALSE) {

        if ($id_name) {
            $query = $this->db->where($id_name, $id);
        }

        if ($last_field && $logical == 'or') {
            $query = $this->db->or_where($last_field, $field_val);
        } else if ($last_field && $logical == 'and') {
            $query = $this->db->where($last_field, $field_val);
        }

        if ($order_by) {
            $query = $this->db->order_by($order_by, $sorter);
        }
        if ($start) {
            $query = $this->db->limit($start, $how_many);
        }

        $query = $this->db->get($table_name);
        //echo $this->db->last_query();return;
        return $query->result_array();
    }

    /**
     * update data to specific table
     * @param mixed $id_name
     * @param mixed $id
     * @param string $tbl_name
     * @param array $data
     */
    public function updater($id_name, $id, $tbl_name, $data) {
        $data = preg_replace('%[<>\/"\%$\^\'!]%', '', $data);
        $this->db->where($id_name, $id);
        $this->db->update($tbl_name, $data);
        //echo $this->db->last_query();return;
    }

    /**
     * delete table
     * @param string $id_name
     * @param mixed $id
     * @param string $table
     */
    public function deleter($id_name, $id, $table) {
        $this->db->where($id_name, $id)->delete($table);
    }

}
