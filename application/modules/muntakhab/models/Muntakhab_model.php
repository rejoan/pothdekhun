<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Muntakhab_model extends CI_Model {

    public function update_district($id,$district_id) {
        $cond = array(
            'district_id' => '0',
            'id' => $id
        );
        $data = array(
            'district_id' => $district_id
        );
        $this->db->where($cond)->update('stoppages', $data);
    }

    public function update_thana($district_id, $data) {
        $this->db->where('thana_id', '0')->update('stoppages', $data);
    }

}
