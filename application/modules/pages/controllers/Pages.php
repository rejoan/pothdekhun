<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Pages extends MX_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->model('Page_model', 'nm');
    }

    public function about_us() {
        $data = array(
            'title' => lang('about_us'),
            'settings' => $this->nl->get_config(),
        );
        $this->nl->view_loader('user', 'about', NULL, $data, 'latest', 'rightbar');
    }

    public function contact_us() {
        $data = array(
            'title' => lang('contact_us'),
            'settings' => $this->nl->get_config(),
        );
        $this->load->library('form_validation');

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('comment', 'Comment', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->nl->view_loader('user', 'contact', NULL, $data, 'latest', 'rightbar');
                return;
            }
            $from_mail = trim($this->input->post('email', TRUE));
            $comment = trim($this->input->post('comment', TRUE));
            $this->load->library('email');
            $subject = 'Pothdekhun contact';
            $body = '<p>Comment: ' . $comment . '</p>';
            $config['mailtype'] = 'html';
            $config['protocol'] = 'sendmail';
            $this->email->initialize($config);
            $this->email->from($from_mail, 'PothDekhun');
            $this->email->to('rejoan.er@gmail.com');
            $this->email->subject($subject);
            $this->email->message($body);

            if ($this->email->send()) {
                $this->session->set_flashdata('message', lang('mail_sent'));
                redirect_tr('pages/contact_us');
            } else {
                //echo $this->email->print_debugger();
            }
        }
        $this->nl->view_loader('user', 'contact', NULL, $data, 'latest', 'rightbar');
    }

}
