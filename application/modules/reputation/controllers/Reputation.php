<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Reputation extends MX_Controller {

    private $user_id;

    public function __construct() {
        parent::__construct();
        $this->nl->is_logged();
        $this->user_id = (int) $this->session->user_id;
        $this->load->model('Reputation_model', 'rpm');
    }

    public function index() {
        $total_route = $this->pm->total_item('routes', 'added_by', $this->user_id);
        $data = array(
            'title' => lang('profile'),
            'profile' => $this->prm->get_profile($this->user_id),
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
            'tot_added' => $total_route,
            'settings' => $this->nl->get_config()
        );
        $this->nl->view_loader('user', 'index', NULL, $data, NULL, 'latest');
    }

    public function my_routes() {
        $total_rows = $this->db->where('is_publish', 1)->get('routes')->num_rows();
        $per_page = 10;
        $num_links = 5;

        if ($this->input->get('page')) {
            $sgm = (int) trim($this->input->get('page'));
            $segment = $per_page * ($sgm - 1);
        } else {
            $segment = 0;
        }

        $d = trim($this->input->get('fd', TRUE));
        $t = trim($this->input->get('ft', TRUE));
        $ttype = trim($this->input->get('t', TRUE));

        $url = 'profile/my_routes?fd=' . $d . '&ft=' . $t . '&t=' . $ttype;
        $links = $this->nl->generate_pagination($url, $total_rows, $per_page, $num_links);

        $district_id = $d;
        if (empty($d)) {
            $district_id = 1;
        }

        $data = array(
            'title' => lang('all_routes_your'),
            'routes' => $this->prm->get_all($this->user_id, $per_page, $segment, $d, $t, $ttype),
            'links' => $links,
            'segment' => $segment,
            'settings' => $this->nl->get_config(),
            'action' => site_url_tr('profile/my_routes'),
            'districts' => $this->pm->get_data('districts'),
            'thanas' => $this->pm->get_data('thanas', FALSE, 'district_id', $district_id)
        );
        $this->nl->view_loader('user', 'routes', 'routes', $data, 'latest', 'rightbar');
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
