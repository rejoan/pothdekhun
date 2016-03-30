<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Transports extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        //echo 'done';return;
        $from_place = trim($this->input->get('f'), TRUE);
        $to_place = trim($this->input->get('t'), TRUE);
        $table = 'routes';
       
        if ($language == 'en') {
            $table = 'route_translation';
        }
        $sql = 'SELECT * FROM (SELECT type,rent,to_place,from_place,departure_place,departure_time,to_place Location FROM '.$table.' UNION SELECT type,rent,to_place,from_place,departure_place,departure_time,CONCAT_WS(", ",departure_place,from_place) FROM '.$table.') r WHERE Location LIKE "%'.$from_place.'%" ORDER BY CASE WHEN Location LIKE "'.$from_place.'%" THEN 0 WHEN Location LIKE "% %'.$from_place.'% %" THEN 1 WHEN Location LIKE "%'.$from_place.'%" THEN 2 ELSE 3 END LIMIT 5';
        
        $query = $this->db->query($sql);
        //echo $this->db->last_query();return;
        $data = array(
            'title' => lang('transport'),
            'transports' => $query->result_array()
        );
        $this->nuts_lib->view_loader('user', 'transports', $data, TRUE, 'latest_routes', 'rightbar');
    }

}
