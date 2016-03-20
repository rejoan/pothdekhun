<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Profile extends MX_Controller {

    private $user_id;

    public function __construct() {
        parent::__construct();
        $this->user_id = (int) $this->session->user_id;
    }

    public function index() {
        $query = $this->db->select('p.first_name,p.last_name,p.about,p.occupation,p.thana,p.district,p.country,u.username,u.email,u.reputation,u.avatar')->from('users u')->join('profiles p', 'u.id = p.user_id', 'left')->where('u.id', $this->user_id)->get();
        //echo $this->db->last_query();return;
        $total_route = $this->db->where('added_by', $this->user_id)->get('routes')->num_rows();
        $data = array(
            'title' => lang('profile'),
            'profile' => $query->row_array(),
            'route_added' => $total_route
        );
        $this->nl->view_loader('user', 'profile', NULL, $data, NULL, 'rightbar');
    }

    public function my_routes() {
        $total_rows = $this->db->where('added_by', $this->user_id)->get('routes')->num_rows();
        $this->nl->generate_pagination('profile/my_routes', $total_rows);
        if ($this->uri->segment(3)) {
            $segment = $this->uri->rsegment(3);
        } else {
            $segment = 0;
        }

        $alias = $this->nl->lang_based_data('rt', 'r');
        //$stopage_table = $this->nl->lang_based_data('stoppages', 'stoppage_translation');
        $name =  $this->nl->lang_based_data('bn_name', 'name');
        //$thana =  $this->nl->lang_based_data('bn_name', 'name');

        $query = $this->db->select('fd.'.$name.', td.'.$name.', ft.'.$name.', tt.'.$name.', r.id,' . $alias . '.from_place,' . $alias . '.to_place,r.transport_type,' . $alias . '.vehicle_name,' . $alias . '.departure_time,r.rent,r.evidence,r.added,r.is_publish')->from('routes r')->join('route_translation rt', 'r.id = rt.route_id', 'left')->join('districts fd','fd.id = r.from_district')->join('districts td','td.id = r.to_district')->join('thanas ft','ft.id = r.from_thana')->join('thanas tt','tt.id = r.to_thana')->where('r.added_by', $this->user_id)->get();

        $data = array(
            'title' => lang('my_routes'),
            'routes' => $query->result_array(),
            'route_added' => $query->num_rows(),
            'segment' => $segment
        );
        $this->nl->view_loader('user', 'routes', NULL, $data, 'latest_routes', 'rightbar');
    }

}
