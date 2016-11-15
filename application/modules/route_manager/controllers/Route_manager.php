<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Route_manager extends CI_Controller {

    public function __construct() {
        parent::__construct();
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
    public function merge($id) {
        if ($this->ln == 'en') {
            $alias = 'rt';
            $alias_stopage = 'st';
            $route_table = 'route_translation';
            $stopage_table = 'stoppage_translation st';
            $update_id = 'route_id';
        } else {
            $route_table = 'routes';
            $stopage_table = 'stoppages s';
            $update_id = 'id';
            $alias = 'r';
            $alias_stopage = 's';
        }
        if (!empty($id)) {
            $route_id = (int) $id;
            $query = $this->db->select('r.id,r.country,' . $alias . '.from_place,' . $alias . '.to_place,r.type,' . $alias . '.vehicle_name,' . $alias . '.departure_place,' . $alias . '.departure_time,r.rent,r.evidence,r.added,r.is_publish')->from('routes r')->join('route_translation rt', 'r.id = rt.route_id', 'left')->where('r.id', $route_id)->get();
            //echo $this->db->last_query();return;
            if ($query->num_rows() < 1) {
                $this->session->set_flashdata('message', 'Wrong Access');
                redirect('routes');
            }
        } else {
            show_404();
        }

        $this->load->library('form_validation');
        $q_stoppage = $this->db->select($alias_stopage . '.place_name,' . $alias_stopage . '.comments,' . $alias_stopage . '.rent,' . $alias_stopage . '.position')->from($stopage_table)->where('route_id', $route_id)->order_by($alias_stopage . '.position', 'asc')->get();

        $q_edited = $this->db->where('route_id', $route_id)->get('edited_routes');
        $q_ed_stopage = $this->db->where('route_id', $route_id)->get('edited_stoppages');

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
                    $this->nl->view_loader('user', 'add_route', $data, TRUE, 'latest', 'rightbar');
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
            $this->form_validation->set_rules('vehicle_name', lang('vehicle_name'), 'required');
            $this->form_validation->set_rules('departure_place', lang('departure_place'), 'required');
            $this->form_validation->set_rules('main_rent', lang('main_rent'), 'required|integer');

            if ($this->form_validation->run() == FALSE) {
                $this->nl->view_loader('user', 'add_route', $data, TRUE, 'latest', 'rightbar');
                return;
            }


            if ($this->ln == 'en') {
                $route = array(
                    'from_place' => $from,
                    'to_place' => $to,
                    'vehicle_name' => $transport_name,
                    'departure_place' => $departure_place,
                    'departure_time' => $departure_time
                );
            } else {
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
            }


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
                $this->db->insert_batch($stopage_table, $stoppages);
            }

            $this->session->set_flashdata('message', lang('edit_success'));
            redirect('routes');
        }

        $data = array(
            'title' => lang('edit_route'),
            'action' => site_url('routes/edit/' . $route_id),
            'countries' => $this->nl->get_countries(),
            'route' => $query->row_array(),
            'stoppages' => $q_stoppage->result_array(),
            'edited_route' => $q_edited->row_array(),
            'edited_stopage' => $q_ed_stopage->result_array()
        );


        $this->nl->view_loader('user', 'add_route', $data, TRUE, NULL, 'merge');
    }

}
