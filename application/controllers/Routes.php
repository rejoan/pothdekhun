<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Routes extends CI_Controller {

    private $ln;
    private $language;

    public function __construct() {
        parent::__construct();
        $this->load->library('Nuts_lib');
        $this->nuts_lib->is_logged('admin/login', 3);
        $this->ln = $this->input->get('ln');
        $this->language = $this->session->language;
        $this->lang->load(array('controller_lang', 'view_lang'), $this->language);
        $this->load->model('Prime_model');
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
        $query = $this->db->select('r.id,r.country,r.from_place,r.to_place,r.type,r.vehicle_name,r.added,r.is_publish,u.username')->from('routes r')->join('users u', 'r.added_by = u.id', 'left')->order_by('r.id', 'desc')->get();
        $data = array(
            'title' => 'All Routes',
            'routes' => $query->result_array(),
            'segment' => $segment
        );
        $this->nuts_lib->view_admin('routes', $data, TRUE, FALSE);
    }

    public function edit($id) {
        if ($this->input->get('ln') == 'en') {
            $route_table = 'route_translation';
            $stopage_table = 'stoppage_translation';
            $update_id = 'route_id';
        } else {
            $route_table = 'routes';
            $stopage_table = 'stoppages';
            $update_id = 'id';
        }
        if (!empty($id)) {
            $route_id = (int) $id;
            $query = $this->db->where('id', $route_id)->get($route_table);
        } else {
            show_404();
        }

        $this->load->library('form_validation');
        $q_stoppage = $this->db->where('route_id', $route_id)->get($stopage_table);
        $data = array(
            'title' => $this->lang->line('edit_route'),
            'action' => site_url('routes/edit/' . $route_id),
            'countries' => $this->nuts_lib->get_countries(),
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
                    $this->nuts_lib->view_loader('user', 'add_route', $data, TRUE, 'latest_routes', 'rightbar');
                    return;
                } else {
                    $evidence = $this->upload->data();
                    $evidence_name = $evidence['file_name'];
                }
            } else {
                $evidence_name = '';
            }
//route data process
            $this->form_validation->set_rules('from_place', $this->lang->line('from_view'), 'required');
            $this->form_validation->set_rules('to_place', $this->lang->line('to_view'), 'required');
            $this->form_validation->set_rules('vehicle_name', $this->lang->line('vehicle_name'), 'required');
            $this->form_validation->set_rules('departure_place', $this->lang->line('departure_place'), 'required');
            $this->form_validation->set_rules('main_rent', $this->lang->line('main_rent'), 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->nuts_lib->view_loader('user', 'add_route', $data, TRUE, 'latest_routes', 'rightbar');
                return;
            }

            $route = array(
                'country' => $country,
                'from_place' => $from,
                'to_place' => $to,
                'type' => $transport_type,
                'vehicle_name' => $transport_name,
                'departure_place' => $departure_place,
                'departure_time' => $departure_time,
                'rent' => $main_rent,
                'evidence' => $evidence_name
            );
            $this->db->where($update_id, $route_id)->update($route_table, $route);

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
            $this->db->where('route_id', $route_id)->delete($stopage_table);
            if (!empty($stoppages)) {
                $this->db->insert_batch('stoppages', $stoppages);
            }
            $this->session->set_flashdata('message', $this->lang->line('edit_success'));
            redirect('routes');
        }
        $this->nuts_lib->view_loader('user', 'add_route', $data, TRUE, 'latest_routes', 'rightbar');
    }

}
