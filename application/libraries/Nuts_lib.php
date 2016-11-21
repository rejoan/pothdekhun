<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * utility library
 */
class Nuts_lib {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
    }

    /**
     * 
     * @param string $dirn
     * @param type $view_name
     * @param string $view_from
     * @param type $data
     * @param type $leftbar
     * @param type $rightbar
     * @param type $menu
     */
    public function view_loader($dirn = NULL, $view_name = 'index', $view_from = NULL, $data = array(), $leftbar = NULL, $rightbar = NULL, $menu = 'menu') {
        if (!empty($dirn)) {
            $dirn = $dirn . '/';
        }
        if (!empty($view_from)) {
            $view_from = $view_from . '/';
        }

        $this->CI->load->view($dirn . 'header', $data);
        if ($menu) {
            $this->CI->load->view($dirn . $menu);
        }

        if (!empty($leftbar)) {
            $this->CI->load->view($dirn . $leftbar);
        }
        $this->CI->load->view($view_from . $view_name);

        if (!empty($rightbar)) {
            $this->CI->load->view($dirn . $rightbar);
        }

        $this->CI->load->view($dirn . 'footer');
    }

    public function get_greetings() {
        $settings = $this->get_config();
        date_default_timezone_set($settings->client_timezone);
        $time = date('H');
        if ($time < '12') {
            $gr = 'Good Morning ';
        } elseif ($time >= '12' && $time < '17') {
            $gr = 'Good Afternoon ';
        } elseif ($time >= '17' && $time < '19') {
            $gr = 'Good Evening ';
        } elseif ($time >= '19') {
            $gr = 'Good Night ';
        }
        return $gr;
    }

    /**
     * generate menu links
     * @param string $is_selected
     * @param string $contrler
     * @param string $icon_class
     * @param string $menu_text
     */
    public function generate_link($is_selected, $contrler, $icon_class = NULL, $menu_text = 'Menu') {
        if (empty($icon_class)) {
            $icon_class = '';
        }
        echo '<li class="' . $this->is_selected($is_selected) . '">
                        <a href="' . site_url_tr($contrler) . '">
                            <i class="fa ' . $icon_class . '"></i> <span>' . trim($menu_text) . '</span>
                        </a>
                    </li>';
    }

    /**
     * set site language
     */
    public function lang_manager() {
        $lange = $this->CI->config->item('language');
        if ($this->CI->input->get('ln') == 'en') {
            $this->CI->session->unset_userdata(array('language', 'ln'));
            $this->CI->session->set_userdata(array('language' => 'english', 'ln' => 'en'));
        } else {
            $this->CI->session->set_userdata(array('language' => $lange, 'ln' => 'bn'));
        }
    }

    /**
     * is menu will be selected
     * @param string $strngs
     * @return type
     */
    public function is_selected($strngs) {
        $chk_str = explode(',', $strngs);
        for ($s = 0; $s < count($chk_str); $s++) {
            if (strpos(current_url(), $chk_str[$s]) !== FALSE) {
                return 'active';
            }
        }
        //return FALSE;
    }

    /**
     * check is authorized user or logged in
     * @param string $redirect_url
     * @param int $user_type
     * @return boolean
     */
    public function is_logged($redirect_url = 'authentication/login') {
        if ($this->CI->session->user_type) {
            return TRUE;
        } else {
            $class = $this->CI->router->fetch_class();
            $method = $this->CI->router->fetch_method();
            $this->CI->session->set_userdata('next', $class . '/' . $method);
            redirect_tr($redirect_url . '?next=' . $this->CI->session->next);
        }
    }

    /**
     * check if super admin
     * @return boolean
     */
    public function is_admin($redirect_url = 'auth/login', $is_view = TRUE) {
        $level = $this->CI->session->user_type;
        if ($level == 'admin') {
            return TRUE;
        } else {
            if ($is_view) {
                return FALSE;
            }
            redirect($redirect_url);
        }
    }

    /**
     * generate breadcrumb based on controller & method
     */
    public function breadcrumb() {
        $controller = $this->CI->router->fetch_class();
        $method_name = $this->CI->router->fetch_method();
        $mn = str_replace('_', ' ', $method_name);

        if (!empty($controller)) {
            $action_name = '<li><a href="' . site_url_tr($controller . "/index") . '">' . ucfirst($controller) . '</a></li>';
        }
        if (!empty($mn)) {
            $method = '<li class="active">' . ucwords($mn) . '</li>';
        }

        if ($controller == 'routes' && $mn == 'index') {
            $action_name = $method = '';
        }
        $crumb = '<ol class="breadcrumb">
            <li><a href="' . site_url_tr() . '"><i class="fa fa-home"></i> Home </a></li>' . $action_name . $method . '</ol>';
        echo $crumb;
    }

    /**
     * get comma separated column name from array
     * @param array $results
     * @param string $id name of colum need comma separated data
     * @return string
     */
    public function get_all_ids($results, $id = 'id') {
        $all_id = '';
        foreach ($results as $key => $val) {
            if ($key == 0) {
                $all_id .= $val[$id];
            } else {
                $all_id .= ',' . $val[$id];
            }
        }
        return $all_id;
    }

    /**
     * get config object
     * @return \SimpleXMLElement
     */
    public function get_config() {
        $this->CI->load->helper('file');
        $xml = read_file('./application/config/bksh_config.xml');
        $obj = new SimpleXMLElement($xml);
        return $obj;
        //return json_decode(json_encode($obj), TRUE);
    }

    /**
     * check if a datetime valid
     * @param datetime $date
     * @param string $format
     * @return bool
     */
    public function valid_date($date, $format = 'd/m/Y g:i A') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    /**
     * check current time is between two datetime
     * @param datetime $from
     * @param datetime $to
     * @param datetime $date
     * @return bool
     */
    public function date_is_between($from, $to, $date = 'now') {
        $date = is_int($date) ? $date : strtotime($date);
        $from = is_int($from) ? $from : strtotime($from);
        $to = is_int($to) ? $to : strtotime($to);
        return ($date > $from) && ($date < $to);
    }

    /**
     * tab action
     */
    public function new_tab() {
        if ($this->CI->router->fetch_class() == 'routes') {
            return 'target="_blank"';
        }
    }

    /**
     * convert seconds to d:m:y:h:i:s
     * @param int $ss
     * @return string
     */
    public function seconds_to_time($ss) {
        $s = $ss % 60;
        $m = floor(($ss % 3600) / 60);
        $h = floor(($ss % 86400) / 3600);
        $d = floor(($ss % 2592000) / 86400);
        $M = floor($ss / 2592000);

        $s = $s < 10 ? '0' . $s : $s;
        $m = $m < 10 ? '0' . $m : $m;
        $h = $h < 10 ? '0' . $h : $h;
        $d = $d < 10 ? '0' . $d : $d;
        $M = $M < 10 ? '0' . $M : $M;
        $month = $M < 1 ? '' : $M . ' mon ';
        $day = $d < 1 ? '' : $d . ' day ';
        return $month . $day . $h . ':' . $m . ':' . $s;
    }

    /**
     * get duration of two datetime in H:m:s
     * @param datetime $start
     * @param datetime $end
     * @return string
     */
    public function duration($start, $end) {
        $date1 = new DateTime($start);
        $date2 = new DateTime($end);
        $interval = $date1->diff($date2);
        $duration = '';
        if ($interval->h > 0) {
            $duration .= $interval->h . ' Hour ';
        }
        if ($interval->i > 0) {
            $duration .= $interval->i . ' Min ';
        }
        $duration .= $interval->s . ' Sec';
        return $duration;
    }

    /**
     * encrypt data
     * @param string $string
     * @param magic $key
     * @return string
     */
    public function process_xor($string, $key = 'spbkxt') {
        $result = '';
        $str = (string) $string;
        for ($i = 0; $i < strlen($str); $i++) {
            $tmp = $str[$i];
            for ($j = 0; $j < strlen($key); $j++) {
                $tmp = chr(ord($tmp) ^ ord($key[$j]));
            }
            $result .= $tmp;
        }
        return $result;
    }

    /**
     * get start and endtime from url when search
     * @param string $redirect
     * @return array
     */
    public function start_end_time($redirect) {
        $settings = $this->get_config();
        $db_zone = $settings->db_timezone;
        $client_zone = $settings->client_timezone;
        if ($this->CI->input->get('ts')) {
            $time_span = $this->CI->input->get('ts');
            if ($time_span === '') {
                redirect($redirect);
            }
            $parsed = explode('-', $time_span);
            $start = trim($parsed[0]);

            if (!$this->valid_date($start) || !isset($parsed[1])) {
                redirect($redirect);
            }
            $end = trim($parsed[1]);
            if (!$this->valid_date($end)) {
                redirect($redirect);
            }

            $d_start = DateTime::createFromFormat('d/m/Y g:i A', $start, new DateTimeZone($client_zone));
            $d_start->setTimezone(new DateTimeZone($db_zone));
            $start_time = $d_start->format('Y-m-d H:i:s');
            $d_end = DateTime::createFromFormat('d/m/Y g:i A', $end, new DateTimeZone($client_zone));
            $d_end->setTimezone(new DateTimeZone($db_zone));
            $end_time = $d_end->format('Y-m-d H:i:s');
        } else {
            $d_start = new DateTime('today midnight', new DateTimeZone($client_zone));
            $d_start->setTimezone(new DateTimeZone($db_zone));
            $start_time = $d_start->format('Y-m-d H:i:s');
            $d_end = new DateTime('now', new DateTimeZone($client_zone));
            $d_end->setTimezone(new DateTimeZone($db_zone));
            $end_time = $d_end->format('Y-m-d H:i:s');
        }
        return array($start_time, $end_time);
    }

    /**
     * 
     * @param type $client_zone
     * @return type
     */
    public function date_ranger($client_zone) {
        $now = new DateTime('now', new DateTimeZone($client_zone));
        $curr_date = $now->format('d/m/Y g:i A');
        $prev_7 = new DateTime('today midnight', new DateTimeZone($client_zone));
        $last_7days = $prev_7->format('d/m/Y g:i A');
        return $last_7days . ' - ' . $curr_date;
    }

    /**
     * format datetime as client timezone
     * @param string $format_from from which format
     * @param string $d date to format
     * @param string $db_zone server/database timezone
     * @param string $client_zone client timezone
     * @param string $to_format expected format
     * @return string
     * @author rejoanul alam <rejoan.er@gmail.com>
     */
    public function date_formation($format_from, $d, $db_zone = 'America/New_York', $client_zone = 'Asia/Dhaka', $to_format = 'd M Y, h:i:s A') {
        $to_time = DateTime::createFromFormat(
                        $format_from, $d, new DateTimeZone($db_zone));
        $date = $to_time->setTimeZone(new DateTimeZone($client_zone));
        return $date->format($to_format);
    }

    /**
     * format a datetime from any another format
     * @param string $format
     * @param datetime $d
     * @param string $to_format
     * @return datetime
     */
    public function date_formatter($format, $d, $to_format = 'Y-m-d H:i:s') {
        //var_dump($format,$d,$to_format);return;
        $date = DateTime::createFromFormat(
                        $format, $d);
        $final_date = $date->format($to_format);
        return $final_date;
    }

    /**
     * get a string (column name from table) based on language
     * @param string $bengali
     * @param string $english
     * @param string $alias
     * @return string
     */
    public function lang_based_data($bengali, $english, $alias = FALSE) {
        $item = $english;
        if ($this->CI->session->lang_code == 'bn') {
            $item = $bengali;
        }
        if ($alias) {
            return $item . $alias;
        }
        return $item;
    }

    /**
     * generate pagination with query string
     * @param string $url
     * @param int $total_rows
     * @param int $per_page
     * @param int $num_link
     * @return resource
     */
    public function generate_pagination($url, $total_rows, $per_page = 10, $num_link = 5) {
        $this->CI->load->library('pagination');
        $config['base_url'] = site_url_tr($url);
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['num_links'] = $num_link;
        $config['enable_query_strings'] = TRUE;
        $config['use_page_numbers'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['page_query_string'] = TRUE;
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
        $this->CI->pagination->initialize($config);
        return $this->CI->pagination->create_links();
    }

    /**
     * get lat long by address
     * @param string $address
     * @param string $country
     * @return array
     */
    public function get_lat_long($address, $country) {
        $adds = str_replace(' ', '+', trim($address));
        $lat_long = array();
        $json = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $adds . '&sensor=false&region=' . $country);

        $json = json_decode($json);
        //var_dump($json->results);return;
        if (!empty($json) && !empty($json->results)) {
            $lat = $json->results[0]->geometry->location->lat;
            $long = $json->results[0]->geometry->location->lng;
            $lat_long['lat'] = $lat;
            $lat_long['long'] = $long;
        }
        return $lat_long;
    }

}
