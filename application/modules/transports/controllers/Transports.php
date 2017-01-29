<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Transports extends MX_Controller {

    private $user_id = 4;
    public $address = array();

    public function __construct() {
        parent::__construct();
        if ($this->session->user_id) {
            $this->user_id = $this->session->user_id;
        }
        $this->load->model('Transport_model', 'tm');
        //$this->load->library('security');
        $this->address = array(0 => array(
                'district' => 1,
                'thana' => 493,
                'address' => ''
            )
        );
    }

    /**
     * 
     */
    public function index() {
        $input = trim($this->input->get('t', TRUE));
        $poribohon_name = $this->nl->lang_based_data('bn_name', 'name');

        $total_rows = $this->tm->get_all($input, $poribohon_name, TRUE);
        $per_page = 10;
        $num_links = 5;
        if ($this->input->get('page')) {
            $sgm = (int) trim($this->input->get('page'));
            $segment = $per_page * ($sgm - 1);
        } else {
            $segment = 0;
        }
        $links = $this->nl->generate_pagination('transports/index', $total_rows, $per_page, $num_links);

        $data = array(
            'title' => lang('all_transport'),
            'transports' => $this->tm->get_all($input, $poribohon_name, FALSE, $per_page, $segment),
            'links' => $links,
            'segment' => $segment,
            'settings' => $this->nl->get_config()
        );
        $this->nl->view_loader('user', 'index', NULL, $data, 'latest', 'rightbar');
    }

    public function add() {
        $this->nl->is_logged();
        $col_name = $this->nl->lang_based_data('bn_name', 'name');
        $data = array(
            'title' => lang('add_transport'),
            'action' => site_url_tr('transports/add'),
            'counter_address' => $this->address,
            'action_button' => lang('add_button'),
            'settings' => $this->nl->get_config(),
            'districts' => $this->pm->get_data('districts', FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, $col_name, 'asc'),
            'thanas' => $this->pm->get_data('thanas', FALSE, 'district_id', 1, FALSE, FALSE, FALSE, $col_name, 'asc')
        );
        $this->load->library('form_validation');

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('transport_name', lang('transport_name'), 'required|is_unique[poribohons.name]');

            if ($this->form_validation->run() == FALSE) {
                $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
                return;
            }

//            $config['upload_path'] = './evidences';
//            $config['allowed_types'] = 'gif|jpg|png|jpeg';
//            $config['max_size'] = 2000;
//
//            $this->load->library('upload', $config);
//            if ($_FILES && $_FILES['picture']['name']) {
//                if (!$this->upload->do_upload('picture')) {
//                    $this->session->set_flashdata('message', $this->upload->display_errors());
//                    $this->nl->view_loader('user', 'add', $data, TRUE, 'latest', 'rightbar');
//                    return;
//                } else {
//                    $picture = $this->upload->data();
//                    $picture_name = $picture['file_name'];
//                }
//            } else {
//                $picture_name = '';
//            }

            $tarnsport = array(
                'name' => $this->input->post('transport_name', TRUE),
                'bn_name' => $this->input->post('bn_name', TRUE),
                'total_vehicles' => $this->input->post('total_vehicle', TRUE),
                'added_by' => $this->user_id
            );

            if ($this->nl->is_admin()) {
                $tarnsport['is_publish'] = 1;
            }
            $this->db->set('added', 'NOW()', FALSE);
            $poribohon_id = $this->pm->insert_data('poribohons', $tarnsport, TRUE);

            $district = $this->input->post('ad', TRUE);
            $thana = $this->input->post('thana', TRUE);
            $details = $this->input->post('details', TRUE);
            $counter_address = array();
            for ($p = 0; $p < count($district); $p++) {
                if (!empty($details[$p])) {
                    $counter_address[] = array(
                        'district' => $district[$p],
                        'thana' => $thana[$p],
                        'address' => $details[$p],
                        'poribohon_id' => $poribohon_id
                    );
                }
            }

            if (!empty($counter_address)) {
                $this->db->insert_batch('counter_address', $counter_address);
            }
            if ($this->nl->is_admin()) {
                $this->session->set_flashdata('message', lang('save_success'));
            } else {
                $this->session->set_flashdata('message', lang('edit_success_user'));
            }

            redirect_tr('transports');
        }

        $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
    }

    /**
     * edit a transport
     * @param int $id
     * @return type
     */
    public function edit($id = NULL) {
        $this->nl->is_logged();
        $this->load->library('encryption');
        $this->encryption->initialize(
                array(
                    'cipher' => 'des',
                    'mode' => 'ECB'
                )
        );
        $poribohon_id = 'id';
        $transport = '';
        $table = 'poribohons';
        $counter_table = 'counter_address';
        if ($this->input->get('pd_rev')) {
            $table = 'edited_poribohons';
            $counter_table = 'edited_counters';
            $poribohon_id = 'poribohon_id';
        }
        if (!empty($id) && ctype_digit($id)) {
            $transport = $this->pm->get_row($poribohon_id, $id, $table);
        }
        $col_name = $this->nl->lang_based_data('bn_name', 'name');
        $counter_address = $this->pm->get_data($counter_table, FALSE, 'poribohon_id', $id);
        if (empty($counter_address)) {
            $counter_address = $this->address;
        }
        $data = array(
            'title' => lang('edit_transport'),
            'transport' => $transport,
            'poribohon_id' => $poribohon_id,
            'counter_address' => $counter_address,
            'action' => site_url_tr('transports/edit'),
            'action_button' => lang('edit_button'),
            'settings' => $this->nl->get_config(),
            'districts' => $this->pm->get_data('districts', FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, $col_name, 'asc'),
            'thanas' => $this->pm->get_data('thanas', FALSE, 'district_id', 1, FALSE, FALSE, FALSE, $col_name, 'asc')
        );
        if ($this->nl->is_admin() && $this->input->get('pd_rev')) {
            $data['point'] = $this->calculate_point($id);
        }
        $this->load->library('form_validation');

        if ($this->input->post('submit')) {
            //var_dump($data['transport']);return;
            $this->form_validation->set_rules('transport_name', lang('transport_name'), 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
                return;
            }

            $update_id = $this->encryption->decrypt($this->input->post('pd_identity'));
            $tarnsport = array(
                'name' => $this->input->post('transport_name', TRUE),
                'bn_name' => $this->input->post('bn_name', TRUE),
                'total_vehicles' => $this->input->post('total_vehicle', TRUE)
            );

            $this->db->set('added', 'NOW()', FALSE);
            if ($this->nl->is_admin()) {
                $tarnsport['is_publish'] = 1;
                $this->pm->updater('id', $update_id, 'poribohons', $tarnsport);
            } else {
                $tarnsport['added_by'] = $this->user_id;
                $tarnsport['poribohon_id'] = $update_id;
                $this->pm->insert_data('edited_poribohons', $tarnsport);
            }

            $district = $this->input->post('ad', TRUE);
            $thana = $this->input->post('thana', TRUE);
            $details = $this->input->post('details', TRUE);

            $counter_address = array();
            for ($p = 0; $p < count($district); $p++) {
                if (!empty($details[$p])) {
                    $counter_address[] = array(
                        'district' => $district[$p],
                        'thana' => $thana[$p],
                        'address' => $details[$p],
                        'poribohon_id' => $update_id
                    );
                }
            }

            if (!empty($counter_address)) {
                if ($this->nl->is_admin()) {
                    $this->pm->deleter('poribohon_id', $update_id, 'counter_address');
                    $this->db->insert_batch('counter_address', $counter_address);
                    $this->session->set_flashdata('message', lang('edit_success'));
                } else {
                    $this->session->set_flashdata('message', lang('edit_success_user'));
                    $this->db->insert_batch('edited_counters', $counter_address);
                }
            }

            if ($this->input->post('point')) {
                $poribohon = $this->pm->get_row('id', $update_id, 'poribohons');
                modules::run('admin/create_points', $update_id, $poribohon['added_by'], $this->input->post('point'), $this->input->post('note'));
            }
            $this->pm->deleter('poribohon_id', $update_id, 'edited_poribohons');
            $this->pm->deleter('poribohon_id', $update_id, 'edited_counters');
            redirect_tr('transports');
        }

        $this->nl->view_loader('user', 'add', NULL, $data, 'latest', 'rightbar');
    }

    public function delete($id) {
        $this->nl->is_logged();
        $this->pm->deleter('id', $id, 'poribohons');
        $this->session->set_flashdata('message', lang('delete_success'));
        redirect_tr('transports');
    }

    public function show($id) {
        if (!empty($id)) {
            $poribohon_id = (int) $id;
        } else {
            show_404();
        }

        $exist = $this->tm->details($poribohon_id);
        if ($exist < 1) {
            $this->session->set_flashdata('message', lang('no_poribohon'));
            redirect_tr('transports');
        }
        $result = $this->tm->details($poribohon_id, FALSE);
        $data = array(
            'title' => mb_convert_case($result[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8') . ' ' . lang('poribohon_info'),
            'poribohon' => $result,
            'routes' => $this->tm->get_routes($poribohon_id),
            'counters' => $this->tm->get_counters($poribohon_id),
            'settings' => $this->nl->get_config()
        );
        //echo $this->db->last_query();return;
        $this->nl->view_loader('user', 'details', NULL, $data, 'latest', 'rightbar');
    }

    public function calculate_point($id) {
        $point = 3;

        $counters = $this->pm->total_item('counter_address', 'poribohon_id', $id);
        if ($counters > 0) {
            $point += $counters;
        }
        return $point;
    }

}
