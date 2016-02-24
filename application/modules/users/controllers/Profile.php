<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Profile extends CI_Controller {

    private $language;
    private $user_id;

    public function __construct() {
        parent::__construct();
        $this->load->library('Nuts_lib');
        $this->nuts_lib->lang_manager();
        $this->nuts_lib->is_logged('users/login', 1);
        $this->language = $this->session->language;
        $this->user_id = (int) $this->session->user_id;
        $this->lang->load(array('controller', 'view'), $this->language);
        $this->load->model('Prime_model');
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
        $this->nuts_lib->view_loader('user', 'profile', $data, TRUE, NULL, 'rightbar');
    }

    public function my_routes() {
        $this->load->library('pagination');
        $config['base_url'] = site_url('profile/my_routes');
        $config['total_rows'] = $this->db->where('added_by', $this->user_id)->get('routes')->num_rows();
        $config['per_page'] = 10;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<ul class="pagination no-margin">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void();">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['next_link'] = 'Next >';
        $config['prev_link'] = '< Prev';
        if ($this->uri->segment(3)) {
            $segment = $this->uri->segment(3);
        } else {
            $segment = 0;
        }
        $this->pagination->initialize($config);

        if ($this->input->get('ln') == 'en') {
            $alias = 'rt';
            $stopage_table = 'stoppage_translation';
        } else {
            $alias = 'r';
            $stopage_table = 'stoppages';
        }

        $query = $this->db->select('r.id,' . $alias . '.from_place,' . $alias . '.to_place,r.type,' . $alias . '.vehicle_name,' . $alias . '.departure_place,' . $alias . '.departure_time,r.rent,r.evidence,r.added,r.is_publish')->from('routes r')->join('route_translation rt', 'r.id = rt.route_id', 'left')->where('r.added_by', $this->user_id)->get();

        $data = array(
            'title' => lang('my_routes'),
            'routes' => $query->result_array(),
            'route_added' => $query->num_rows(),
            'segment' => $segment
        );
        $this->nuts_lib->view_loader('user', 'routes', $data, TRUE, 'latest_routes', 'rightbar');
    }

}
