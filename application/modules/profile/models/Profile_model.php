<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Routes Model
 *
 * @author Rejoanul Alam
 */
class Profile_model extends CI_Model {

    public function get_profile($user_id) {
        $query = $this->db->select('p.first_name,p.last_name,p.about,p.occupation,p.thana,p.district,p.country,u.username,u.email,u.reputation,u.avatar')->from('users u')->join('profiles p', 'u.id = p.user_id', 'left')->where('u.id', $user_id)->get();
        return $query->row_array();
    }

}
