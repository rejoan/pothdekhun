<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Routes extends MX_Controller {

    private $user_id;

    public function __construct() {
        parent::__construct();
        $this->user_id = $this->session->user_id;
    }

    public function index() {

        $data = array(
            'title' => lang('index'),
            'name' => $this->nl->lang_based_data('bn_name', 'name'),
            'districts' => $this->pm->get_data('districts'),
            'thanas' => $this->pm->get_data('thanas', FALSE, 'district_id', 1),
            'action_transport' => site_url_tr('transports/index'),
            'search_action' => site_url_tr('search/index')
        );
        $this->nl->view_loader('user', 'index', NULL, $data, 'latest_routes', 'rightbar');
    }

    public function add() {
        $this->load->library('form_validation');
        $fd = trim($this->input->post('fd', TRUE));
        $td = trim($this->input->post('td', TRUE));
        $ft = trim($this->input->post('ft', TRUE));
        $th = trim($this->input->post('th', TRUE));
        $fdistrict = $tdistrict = 1;
        if ($fd) {
            $fdistrict = (int) $fd;
        }

        if ($td) {
            $tdistrict = (int) $td;
        }

        $data = array(
            'title' => lang('add_route'),
            'action' => site_url_tr('route/add'),
            'fd' => $fd,
            'td' => $td,
            'ft' => $ft,
            'th' => $th,
            'districts' => $this->pm->get_data('districts'),
            'fthanas' => $this->pm->get_data('thanas', FALSE, 'district_id', $fdistrict),
            'tthanas' => $this->pm->get_data('thanas', FALSE, 'district_id', $tdistrict),
            'name' => $this->nl->lang_based_data('bn_name', 'name')
        );

        if ($this->input->post('submit')) {
            $from = trim($this->input->post('f', TRUE));
            $to = trim($this->input->post('t', TRUE));
            $transport_type = $this->input->post('transport_type', TRUE);
            $transport_name = trim($this->input->post('vehicle_name', TRUE));
            $from_district = $fd;
            $from_thana = $ft;
            $to_district = $td;
            $to_thana = $th;
            $departure_time = $this->input->post('departure_time', TRUE);
            $main_rent = trim($this->input->post('main_rent', TRUE));

            if ($departure_time == 'perticular') {
                $departure_time = $this->input->post('departure_dynamic', TRUE);
            }

            $config['upload_path'] = './evidences';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|docx|doc';
            $config['max_size'] = 1000;

            $this->load->library('upload', $config);
            if ($_FILES && $_FILES['evidence']['name']) {
                if (!$this->upload->do_upload('evidence')) {
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                    $this->nl->view_loader('user', 'add_route', $data, TRUE, 'latest_routes', 'rightbar');
                    return;
                } else {
                    $evidence = $this->upload->data();
                    $evidence_name = $evidence['file_name'];
                }
            } else {
                $evidence_name = '';
            }
//route data process
            $this->form_validation->set_rules('f', lang('from_view'), 'required');
            $this->form_validation->set_rules('t', lang('to_view'), 'required');
            $this->form_validation->set_rules('main_rent', lang('main_rent'), 'required|integer');

            if ($this->form_validation->run() == FALSE) {
                $this->nl->view_loader('user', 'add', NULL, $data, 'latest_routes', 'rightbar');
                return;
            }

            $transport = $this->pm->get_row('name', $transport_name, 'poribohons', TRUE);

            if (empty($transport)) {
                $transport_data = array(
                    'name' => $transport_name,
                    'added_by' => $this->user_id
                );
                $this->db->set('added', 'NOW()', FALSE);
                $transport_id = $this->pm->insert_data('poribohons', $transport_data, TRUE);
            } else {
                $transport_id = $transport->id;
            }

            $route = array(
                'from_district' => $from_district,
                'from_thana' => $from_thana,
                'to_district' => $to_district,
                'to_thana' => $to_thana,
                'from_place' => $from,
                'to_place' => $to,
                'transport_type' => $transport_type,
                'poribohon_id' => $transport_id,
                'departure_time' => $departure_time,
                'rent' => $main_rent,
                'evidence' => $evidence_name,
                'added_by' => $this->user_id
            );
            $this->db->set('added', 'NOW()', FALSE);
            $this->db->insert('routes', $route);

            $route_id = $this->db->insert_id();
            $route_eng = array(
                'from_place' => $from,
                'to_place' => $to,
                'vehicle_name' => $transport_name,
                'departure_time' => $departure_time,
                'route_id' => $route_id
            );
            $this->db->insert('route_translation', $route_eng);

//stoppage data process
            $rent = $this->input->post('rent', TRUE);
            $place_name = $this->input->post('place_name', TRUE);
            $comment = $this->input->post('comments', TRUE);
            $position = $this->input->post('position', TRUE);
            //var_dump($place_name[0]);return;
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

            if ($stoppages) {
                $this->db->insert_batch('stoppages', $stoppages);
                $this->db->insert_batch('stoppage_translation', $stoppages);
            }
            $this->session->set_flashdata('message', lang('save_success'));
            redirect('routes');
        }
        $this->nl->view_loader('user', 'add', NULL, $data, 'latest_routes', 'rightbar');
    }

    public function edit($id) {
        if ($this->input->get('ln') == 'en') {
            $alias = 'rt';
            $stopage_table = 'stoppage_translation';
        } else {
            $alias = 'r';
            $stopage_table = 'stoppages';
        }
        if (!empty($id)) {
            $route_id = (int) $id;
            $query = $this->db->select('r.id,' . $alias . '.from_place,' . $alias . '.to_place,r.type,' . $alias . '.vehicle_name,' . $alias . '.departure_place,' . $alias . '.departure_time,r.rent,r.evidence,r.added,r.is_publish')->from('routes r')->join('route_translation rt', 'r.id = rt.route_id', 'left')->where('r.added_by', $this->user_id)->where('r.id', $route_id)->get();
            $q_edit = $this->db->where('route_id', $route_id)->get('edited_routes')->num_rows();
            if ($q_edit > 0) {
                $this->session->set_flashdata('message', lang('already_edit_submitted'));
                redirect('profile/my_routes?ln=' . $this->ln);
            }
            if ($query->num_rows() < 1) {
                $this->session->set_flashdata('message', 'Wrong Access');
                redirect('profile/my_routes');
            }
        } else {
            show_404();
        }

        $this->load->library('form_validation');
        $q_stoppage = $this->db->where('route_id', $route_id)->get($stopage_table);
        $data = array(
            'title' => lang('edit_route'),
            'action' => site_url('route/edit/' . $route_id),
            'countries' => $this->nl->get_countries(),
            'route' => $query->row_array(),
            'stoppages' => $q_stoppage->result_array()
        );

        if ($this->input->post('submit')) {
            $from = trim($this->input->post('from_place', TRUE));
            $to = trim($this->input->post('to_place', TRUE));
            $transport_type = $this->input->post('type', TRUE);
            $transport_name = $this->input->post('vehicle_name', TRUE);
            $departure_place = $this->input->post('departure_place', TRUE);
            $country = $this->input->post('country', TRUE);
            $departure_time = $this->input->post('departure_time', TRUE);
            $main_rent = $this->input->post('main_rent', TRUE);

            if ($departure_time == 'perticular') {
                $departure_time = $this->input->post('departure_dynamic', TRUE);
            }

            $config['upload_path'] = './evidences';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|docx|doc';
            $config['max_size'] = 1000;

            $this->load->library('upload', $config);
            if ($_FILES && $_FILES['evidence']['name']) {
                if (!$this->upload->do_upload('evidence')) {
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                    $this->nl->view_loader('user', 'add_route', $data, TRUE, 'latest_routes', 'rightbar');
                    return;
                } else {
                    $evidence = $this->upload->data();
                    $evidence_name = $evidence['file_name'];
                }
            } else {
                $evidence_name = '';
            }
//route data process
            $this->form_validation->set_rules('from_place', lang('from_view'), 'required');
            $this->form_validation->set_rules('to_place', lang('to_view'), 'required');
            $this->form_validation->set_rules('departure_place', lang('departure_place'), 'required|is_unique[routes.departure_place]');
            $this->form_validation->set_rules('main_rent', lang('main_rent'), 'required|integer');

            if ($this->form_validation->run() == FALSE) {
                $this->nl->view_loader('user', 'add_route', $data, TRUE, 'latest_routes', 'rightbar');
                return;
            }

            $route = array(
                'route_id' => $route_id,
                'country' => $country,
                'from_place' => $from,
                'to_place' => $to,
                'type' => $transport_type,
                'vehicle_name' => $transport_name,
                'departure_place' => $departure_place,
                'departure_time' => $departure_time,
                'rent' => $main_rent,
                'evidence' => $evidence_name,
                'edited_by' => $this->user_id,
                'language_e' => $this->ln
            );
            $this->db->set('submitted_at', 'NOW()', FALSE);
            $this->db->insert('edited_routes', $route);

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
                $this->db->insert_batch('edited_stoppages', $stoppages);
            }
            $this->session->set_flashdata('message', lang('edit_success_user'));
            redirect_tr('profile/my_routes');
        }
        $this->nl->view_loader('user', 'add_route', NULL, $data, 'latest_routes', 'rightbar');
    }

    public function show($id) {
        if (!empty($id)) {
            $route_id = (int) $id;
        } else {
            show_404();
        }
        if ($this->input->get('ln') == 'en') {
            $alias = 'rt';
            $stopage_table = 'stoppage_translation';
        } else {
            $alias = 'r';
            $stopage_table = 'stoppages';
        }

        $query = $this->db->select('r.id,' . $alias . '.from_place,' . $alias . '.to_place,r.type,' . $alias . '.vehicle_name,' . $alias . '.departure_place,' . $alias . '.departure_time,r.rent,r.evidence,r.added,u.username')->from('routes r')->join('users u', 'r.added_by = u.id', 'left')->join('route_translation rt', 'r.id = rt.route_id', 'left')->where('r.id', $route_id)->get();
        //echo $this->db->last_query();return;
        $exist = $query->num_rows();
        if ($exist < 1) {
            $this->session->set_flashdata('message', lang('no_route'));
            redirect('route?ln=' . $this->ln);
        }
        $result = $query->row_array();
        $q_stopage = $this->db->where('route_id', (int) $result['id'])->get($stopage_table);

        $data = array(
            'title' => $result['from_place'] . ' ' . lang('from_view') . ' ' . $result['to_place'] . ' ' . $result['vehicle_name'] . ' ' . lang('route_info'),
            'route' => $result,
            'stoppages' => $q_stopage->result_array(),
            'segment' => 0
        );
        $this->nl->view_loader('user', 'details', $data, TRUE, 'latest_routes', 'rightbar');
    }

    public function all() {
        $total_rows = $this->db->get('routes')->num_rows();
        $per_page = 10;
        $num_links = 5;
        if ($this->uri->segment(3)) {
            $segment = $this->uri->segment(3);
        } else {
            $segment = 0;
        }
        $links = $this->nl->generate_pagination('routes/index', $total_rows, $per_page, $num_links);
        $query = $this->db->select('r.id,r.from_place,r.to_place,r.transport_type,r.added,r.is_publish,u.username')->from('routes r')->join('users u', 'r.added_by = u.id', 'left')->order_by('r.id', 'desc')->get();
        $data = array(
            'title' => 'All Routes',
            'routes' => $query->result_array(),
            'links' => $links,
            'segment' => $segment
        );
        $this->nl->view_loader('user', 'routes', NULL, $data, 'latest_routes', 'rightbar');
    }

}
