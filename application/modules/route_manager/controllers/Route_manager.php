<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Route_manager extends CI_Controller {

    private $user_id;

    public function __construct() {
        parent::__construct();
        $this->user_id = $this->session->user_id;
        $this->load->model('Route_manager_model', 'rmn');
    }

    public function index() {
        $total_rows = $this->db->get('edited_routes')->num_rows();
        $per_page = 10;
        $num_links = 5;

        if ($this->input->get('page')) {
            $sgm = (int) trim($this->input->get('page'));
            $segment = $per_page * ($sgm - 1);
        } else {
            $segment = 0;
        }
        $links = $this->nl->generate_pagination('route_manager/index', $total_rows, $per_page, $num_links);
        $data = array(
            'title' => 'All Edited Routes',
            'routes' => $this->rmn->get_all(),
            'segment' => $segment,
            'links' => $links
        );
        $this->nl->view_loader('admin', 'index', 'route_manager', $data, 'leftbar', NULL, NULL);
    }

    /**
     * merge option with user edited things
     * @param int $id
     * @return type
     */
    public function merge($id = NULL) {
        if (!empty($id)) {
            $edited_route_id = (int) $id;
            
            $edited_route_exist = $this->pm->total_item('edited_routes', 'id', $edited_route_id);
            
            if ($edited_route_exist < 1) {
                $this->session->set_flashdata('message', 'Wrong Access');
                redirect('route_manager');
            }
            $edited_route = $this->rmn->edited_route($edited_route_id);
            $route_id = $edited_route['route_id'];//main route ID
        } else {
            show_404();
        }

        $route_table = 'routes';
        $stoppage_table = 'stoppages';
        $prev_route = $this->rmn->get_route($route_id);
        if ($edited_route['lang_code'] == 'bn') {
            $route_table = 'route_bn';
            $stoppage_table = 'stoppage_bn';

            //if edit in bengali then get translated data from route_bn table with main table
            $prev_route = $this->rmn->get_row($route_id);
        }
        $data = array(
            'title' => lang('edit_route'),
            'action' => site_url_tr('route_manager/merge/' . $route_id),
            'districts' => $this->pm->get_data('districts'),
            'fthanas' => $this->pm->get_data('thanas', FALSE, 'district_id', $prev_route['from_district']),
            'tthanas' => $this->pm->get_data('thanas', FALSE, 'district_id', $prev_route['to_district']),
            'prev_route' => $prev_route,
            'prev_stoppages' => $this->pm->get_data($stoppage_table, FALSE, 'route_id', $route_id),
            'edited_route' => $edited_route,
            'edited_stoppages' => $this->pm->get_data('edited_stoppages', FALSE, 'route_id', $edited_route_id),
        );

        $this->load->library('form_validation');

        if ($this->input->post('submit')) {
            $route_id = $this->input->post('route_id');
            $this->form_validation->set_rules('f', lang('from_view'), 'required');
            $this->form_validation->set_rules('t', lang('to_view'), 'required');
            $this->form_validation->set_rules('main_rent', lang('main_rent'), 'required|integer|greater_than[0]');

            if ($this->form_validation->run() == FALSE) {
                $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
                return;
            }

            $departure_time = $this->input->post('departure_time', TRUE);
            if ($departure_time == 'perticular') {
                $departure_time = $this->input->post('departure_dynamic', TRUE);
            }

            $transport_name = trim($this->input->post('vehicle_name', TRUE));
            $transport_id = $this->pm->get_transport_id($transport_name, $this->user_id);

//            $config['upload_path'] = './evidences';
//            $config['allowed_types'] = 'gif|jpg|png|jpeg|docx|doc';
//            $config['max_size'] = 1000;
//
//            $this->load->library('upload', $config);
//            if ($_FILES && $_FILES['evidence']['name']) {
//                if (!$this->upload->do_upload('evidence')) {
//                    $this->session->set_flashdata('message', $this->upload->display_errors());
//                    $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
//                    return;
//                } else {
//                    $evidence = $this->upload->data();
//                    $evidence_name = $evidence['file_name'];
//                }
//            } else {
//                $evidence_name = '';
//            }

            $route = array(
                'from_district' => trim($this->input->post('fd', TRUE)),
                'from_thana' => trim($this->input->post('ft', TRUE)),
                'to_district' => trim($this->input->post('td', TRUE)),
                'to_thana' => trim($this->input->post('th', TRUE)),
                'from_place' => trim($this->input->post('f', TRUE)),
                'to_place' => trim($this->input->post('t', TRUE)),
                'poribohon_id' => $transport_id,
                'transport_type' => $this->input->post('transport_type', TRUE),
                'departure_time' => $departure_time,
                'rent' => $this->input->post('main_rent', TRUE),
                'evidence' => $this->input->post('edited_file'),
                'added_by' => $this->user_id
            );
            $this->db->set('added', 'NOW()', FALSE);
            $this->pm->updater('id', $route_id, $route_table, $route);
            

            //stoppage data process
            $rent = $this->input->post('rent', TRUE);
            $place_name = $this->input->post('place_name', TRUE);
            $comment = $this->input->post('comments', TRUE);
            $position = $this->input->post('position', TRUE);
            $stoppages = array();
            for ($p = 0; $p < count($place_name); $p++) {
                if ($place_name[$p]) {
                    $stoppages[] = array(
                        'place_name' => $place_name[$p],
                        'comments' => $comment[$p],
                        'rent' => $rent[$p],
                        'route_id' => $route_id,
                        'position' => $position[$p]
                    );
                }
            }

            if (!empty($stoppages)) {
                $this->pm->deleter('route_id', $route_id, $stoppage_table);
                $this->db->insert_batch($stoppage_table, $stoppages);
            }
            $this->pm->deleter('route_id', $route_id, 'edited_routes');
            $this->session->set_flashdata('message', lang('edit_success'));
            redirect_tr('route_manager');
        }

        $this->nl->view_loader('user', 'merge', NULL, $data);
    }

}
