<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Scart extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($id) {

        $all_items = array();
        //echo count($all_items);return;
        if ($this->session->items) {
            if (!in_array($id, $this->session->items)) {
                $new_item = array(
                    'img_id' => $id,
                    'dimension' => '1,2',
                    'qty' => '2,4',
                    'name' => 'title1'
                );
                $prev = $this->session->items;
                array_push($prev,$new_item);
                $this->session->set_userdata($prev);
                echo '<pre>';
                print_r($this->session->items);
            }
        } else {
            $items = array(
                'img_id' => $id,
                'dimension' => '1,2',
                'qty' => '2,4',
                'name' => 'title1'
            );
            array_push($all_items, $items);
            $this->session->set_userdata(array('items' => $all_items));
            
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('admin/login');
    }

}
