<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Routes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Nut_bolts');
    }

    public function index() {
        $this->load->library('pagination');
        $config['base_url'] = site_url('routes/index');
        $config['total_rows'] = $this->db->get('routes')->num_rows();
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
        $query = $this->db->select('r.country,r.from_place,r.to_place,r.type,r.vehicle_name,r.is_verified,r.added,r.is_publish,u.username')->from('routes r')->join('users u', 'r.added_by = u.id', 'left')->get();
        $data = array(
            'title' => 'All Routes',
            'routes' => $query->result_array()
        );
        $this->nut_bolts->view_admin('routes', $data, TRUE, FALSE);
    }

}
