<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Muntakhab extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->nl->is_admin('errors', FALSE);
        //$this->user_id = $this->session->user_id;
        $this->load->model('Muntakhab_model', 'mm');
    }

    public function index() {
        $query = $this->db->query('SELECT s.id,r.from_district,r.to_district, s.place_name
FROM stoppages s
LEFT JOIN routes r ON r.id = s.route_id WHERE r.from_district = r.to_district');
        $result = $query->result_array();

        $ctx = stream_context_create(array('http' =>
            array(
                'timeout' => 60,
            )
        ));
//$json = @file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=darus+salam,Bangladesh' . '&key=AIzaSyBgyMl_G_cjNrVViifqYU2DSi0SOc2H8bg', false, $ctx);
//
//            $json = json_decode($json);
//            $district = $json->results[0]->address_components[2]->long_name;
//            $district_name = explode(' ', $district);
//            $dis_info = $this->pm->get_row('name',trim($district_name[0]),'districts');
//            var_dump($district_name[0]);return;



        foreach ($result as $r) {
            //if($r['from_district'] == $r['to_district']){
            $this->mm->update_district($r['id'], $r['to_district']);
            //}
//            $adds = str_replace(' ', '+', $place);
//            $json = @file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $adds . ',Bangladesh' . '&key=AIzaSyBgyMl_G_cjNrVViifqYU2DSi0SOc2H8bg', false, $ctx);
//
//            $json = json_decode($json);
//            if (empty($json) || empty($json->results)) {
//                $prediction_api = @file_get_contents('https://maps.googleapis.com/maps/api/place/autocomplete/json?input=' . $adds . '&key=AIzaSyBgyMl_G_cjNrVViifqYU2DSi0SOc2H8bg', false, $ctx);
//                $predictions = json_decode($prediction_api);
//                //var_dump($thana,$district);return;
//                if (empty($predictions->predictions)) {
//                    
//                } else {
//                    $place_id = $predictions->predictions[0]->place_id;
//
//                    //$first_prediction = $predictions->predictions[0]->description;
//
//                    $json = @file_get_contents('https://maps.googleapis.com/maps/api/place/details/json?placeid=' . $place_id . '&key=AIzaSyBgyMl_G_cjNrVViifqYU2DSi0SOc2H8bg', false, $ctx);
//
//                    $json = json_decode($json);
//                    $lat = $json->result->geometry->location->lat;
//                    $long = $json->result->geometry->location->lng;
//                    $lat_long['lat'] = $lat;
//                    $lat_long['long'] = $long;
//
//                    return $lat_long;
//                }
//            }
        }

        //var_dump($json);return;
        //var_dump($json->results[0]->geometry);return;
//        $lat = $json->results[0]->geometry->location->lat;
//        $long = $json->results[0]->geometry->location->lng;
//        $lat_long['lat'] = $lat;
//        $lat_long['long'] = $long;
//
//        return $lat_long;
    }

    /**
     * update stoppages with district which stoppage name same as district name
     */
    public function same_name() {
        $query = $this->db->query('SELECT s.id,s.place_name,s.route_id,r.from_place,r.to_place
FROM stoppages s
LEFT JOIN routes r ON r.id = s.route_id
WHERE s.district_id = 0');
        $result = $query->result_array();
        foreach ($result as $r) {
            $district = $this->pm->get_row('name', $r['place_name'], 'districts');
            if (count($district) > 0) {
                $this->pm->updater('id', $r['id'], 'stoppages', array('district_id' => $district['id']));
            }
        }
    }

    public function comma_process() {
        $query = $this->db->query('SELECT s.id,s.place_name,s.route_id,r.from_place,r.to_place
FROM stoppages s
LEFT JOIN routes r ON r.id = s.route_id
WHERE s.district_id = 0');
        $result = $query->result_array();
        foreach ($result as $r) {
            if (strpos($r['place_name'], ',') !== false) {
                $place = explode(',', $r['place_name']);
                $place_name = end($place);
                $district = $this->pm->get_row('name', trim($place_name), 'districts');
                if (count($district) > 0) {
                    $this->pm->updater('id', $r['id'], 'stoppages', array('district_id' => $district['id']));
                }
            }
        }
    }
    

}
