<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Profile extends MX_Controller {

    private $user_id;
    public $latest_routes;

    public function __construct() {
        parent::__construct();
        $this->nl->is_logged();
        $this->user_id = (int) $this->session->user_id;
        $this->load->model('Profile_model', 'prm');
        $this->latest_routes = $this->pm->latest_routes();
    }

    public function index() {
        $total_route = $this->pm->total_item('routes', 'added_by', $this->user_id);
        $data = array(
            'title' => lang('profile'),
            'profile' => $this->prm->get_profile($this->user_id),
            'latest_routes' => $this->latest_routes,
            'tot_added' => $total_route,
            'settings' => $this->nl->get_config()
        );
        $this->nl->view_loader('user', 'index', NULL, $data, NULL, 'latest');
    }
    
    public function show($id) {
        $total_route = $this->pm->total_item('routes', 'added_by', $id);
        $data = array(
            'title' => lang('profile'),
            'profile' => $this->prm->get_profile($id),
            'latest_routes' => $this->latest_routes,
            'tot_added' => $total_route,
            'settings' => $this->nl->get_config()
        );
        $this->nl->view_loader('user', 'index', NULL, $data, NULL, 'latest');
    }

    public function my_routes() {
        $total_rows = $this->pm->total_item('routes', 'added_by', $this->user_id);
        $this->nl->generate_pagination('profile/my_routes', $total_rows);
        if ($this->uri->segment(3)) {
            $segment = $this->uri->rsegment(3);
        } else {
            $segment = 0;
        }

        $alias = $this->nl->lang_based_data('rt', 'r');
        //$stopage_table = $this->nl->lang_based_data('stoppages', 'stoppage_translation');
        $name = $this->nl->lang_based_data('bn_name', 'name');
        //$thana =  $this->nl->lang_based_data('bn_name', 'name');

        $query = $this->db->select('fd.' . $name . ', td.' . $name . ', ft.' . $name . ', tt.' . $name . ', r.id,' . $alias . '.from_place,' . $alias . '.to_place,r.transport_type,' . $alias . '.vehicle_name,' . $alias . '.departure_time,r.rent,r.evidence,r.added,r.is_publish')->from('routes r')->join('route_translation rt', 'r.id = rt.route_id', 'left')->join('districts fd', 'fd.id = r.from_district')->join('districts td', 'td.id = r.to_district')->join('thanas ft', 'ft.id = r.from_thana')->join('thanas tt', 'tt.id = r.to_thana')->where('r.added_by', $this->user_id)->get();

        $data = array(
            'title' => lang('my_routes'),
            'routes' => $query->result_array(),
            'route_added' => $query->num_rows(),
            'segment' => $segment
        );
        $this->nl->view_loader('user', 'routes', NULL, $data, 'latest', 'rightbar');
    }

    public function edit() {
        $this->load->library('encryption');
        $this->encryption->initialize(
                array(
                    'cipher' => 'des',
                    'mode' => 'ECB'
                )
        );
        $total_route = $this->pm->total_item('routes', 'added_by', $this->user_id);
        $data = array(
            'title' => lang('my_profile_edit'),
            'latest_routes' => $this->latest_routes,
            'settings' => $this->nl->get_config(),
            'profile' => $this->prm->get_profile($this->user_id),
            'tot_added' => $total_route,
            'districts' => $this->pm->get_data('districts'),
            'thanas' => $this->pm->get_data('thanas', FALSE, 'district_id', 1)
        );
        if ($this->input->post('submit')) {
            $prev_pic = $this->encryption->decrypt($this->input->post('pd_ps', TRUE));
            $config['upload_path'] = './avatars';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2000;

            $this->load->library('upload', $config);
            if ($_FILES && $_FILES['avatar']['name']) {
                if (!$this->upload->do_upload('avatar')) {
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                    $this->nl->view_loader('user', 'edit', NULL, $data, NULL, 'rightbar');
                    return;
                } else {
                    $picture = $this->upload->data();
                    $picture_name = $picture['file_name'];
                    $file = 'avatars/' . $prev_pic;
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
            } else {
                $picture_name = $prev_pic;
            }
            $user = array(
                'email' => trim($this->input->post('email', TRUE)),
                'username' => trim($this->input->post('username', TRUE)),
                'password' => md5($this->input->post('password', TRUE)),
                'mobile' => trim($this->input->post('mobile', TRUE)),
                'avatar' => $picture_name
            );
            $this->pm->updater('id', $this->user_id, 'users', $user);
            $profile = array(
                'first_name' => trim($this->input->post('first_name', TRUE)),
                'last_name' => trim($this->input->post('last_name', TRUE)),
                'sex' => md5($this->input->post('sex', TRUE)),
                'about' => trim($this->input->post('about_me', TRUE)),
                'district' => $this->input->post('fd', TRUE),
                'thana' => $this->input->post('ft', TRUE)
            );
            $profile_exist = $this->pm->total_item('profiles', 'user_id', $this->user_id);
            if ($profile_exist > 0) {
                $this->pm->updater('user_id', $this->user_id, 'profiles', $profile);
            } else {
                $profile['user_id'] = $this->user_id;
                $this->pm->insert_data('profiles', $profile);
            }

            $this->session->set_flashdata('message', lang('profile_update_success'));
            redirect_tr('profile');
        }
        $this->nl->view_loader('user', 'edit', NULL, $data, NULL, 'rightbar');
    }

}
