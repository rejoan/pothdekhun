<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Return multilingual url depending on the current language
 * @param string $url
 * @return string
 * @author Rejoanul Alam
 */
function site_url_tr($url = '') {
    $CI = & get_instance();
    $lang = $CI->session->lang_code;
    //echo $lang;return;
    if (!$lang || ($lang == 'en')) {
        return site_url($url);
    } else {
        return site_url($lang . '/' . $url);
    }
}

/**
 * Return translated current url based on language passed
 * @param string $lang_code
 * @return string
 * @author Rejoanul Alam
 */
function current_url_tr($lang_code = '') {
    $CI = &get_instance();
    if ($CI->config->item('lang_code') == $lang_code) {
        $lang_code = '';
    }
    $uri_string = uri_string();
    $current_uri = '';
    $current_uri_seg = explode('/', $uri_string);
    if (strlen($current_uri_seg[0]) == 2) {
        $current_uri_seg[0] = $lang_code;
        $current_uri = implode('/', $current_uri_seg);
    } else {
        $current_uri = $lang_code . '/' . $uri_string;
    }
    if ($_SERVER['QUERY_STRING']) {
        $current_uri .= '?' . $_SERVER['QUERY_STRING'];
    }
    $current_uri = site_url($current_uri);
    return $current_uri;
}

/**
 * Modified redirect() function to direct user to url with proper language
 * @param string $url
 * @author Rejoanul Alam
 */
function redirect_tr($url = '') {
    redirect(site_url_tr($url));
}

/**
 * Helper function to get an array of avalable language stored in db
 * @return array eg: array('en'=>array('lang_code'=>'en','lang_name'=>'english','lang_flag'=>'gb'))
 * @author Rejoanul Alam
 */
function language_array() {

    $ci = & get_instance();
    $ci->load->database();

    $ci->db->select('lang_code, lang_name,lang_flag');
    $ci->db->where('lang_status', 1);
    $ci->db->order_by('id', 'desc');
    $query = $ci->db->get('languages');

    $languages = array();

    foreach ($query->result_array() as $row) {
        $languages[$row['lang_code']] = $row;
    }

    //$_SESSION['languages'] = $languages;

    return $languages;
}

/**
 * helper function to generate language select selector dropdown html (bootstrap compatible)
 * @return string html codes
 * @author Rejoanul Alam
 */
function language_menu() {
    $CI = & get_instance();
    $current_lang = ucfirst($CI->session->lang_name);
    $selector = '';
    $flag = 'United Kingdom(Great Britain)';
    if ($current_lang == 'Bengali') {
        $flag = 'Bangladesh';
    }
    $selector .= '<li id="lang_menu" class="dropdown"><a style="color:#fff;" href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"><img src="' . base_url('assets/flags/16') . '/' . $flag . '.png" alt="' . $flag . '"/> ' . $current_lang . '<span class="caret"></span></a>';
    $selector .= '<ul class="dropdown-menu dropdown-menu-default">';
    $languages = language_array();
    foreach ($languages as $lang) {
        $selector .= '<li><a class="padding_left" data-ln_code="' . $lang['lang_code'] . '" href="' . current_url_tr($lang['lang_code']) . '"><img src="' . base_url('assets/flags/16') . '/' . trim($lang['lang_flag']) . '.png" alt="' . $lang['lang_flag'] . '"/> ' . ucfirst($lang['lang_name']) . '</a></li>';
    }

    $selector .= '</li></ul>';
    return $selector;
}

function get_tr_type($type) {

    switch ($type) {
        case 'bus':
            $transport = lang('bus');
            break;
        case 'train':
            $transport = lang('train');
            break;
        case 'leguna':
            $transport = lang('leguna');
            break;
        case 'biman':
            $transport = lang('biman');
            break;
        case 'others':
            $transport = lang('others');
            break;
        default:
            $transport = lang('bus');
    }

    return $transport;
}

function notify($count = FALSE) {
    $CI = & get_instance();
    $user_id = $CI->session->user_id;
    $CI->load->model('notifications/Notification_model', 'nm');
    if ($count) {
        return $CI->nm->total_notifications($user_id);
    }
    $notifications = $CI->pm->get_data('notifications', 'id,notification_msg', 'is_read', 0, 'user_id', $user_id, 'and', 'id', 'desc', 5, 0);
    return $notifications;
}

function latest_routes() {
    $CI = & get_instance();
    $query = $CI->db->select('r.id,r.from_place,r.to_place,r.transport_type,r.added,r.is_publish,r.from_district,r.to_district,r.from_thana,r.to_thana,u.username,rbn.from_place fp_bn,rbn.to_place tp_bn,rbn.departure_time,p.name,p.bn_name,d.name district_name,d.bn_name district_name_bn,td.name td_name,td.bn_name td_bn_name')->from('routes r')->join('users u', 'r.added_by = u.id', 'left')->join('route_bn rbn', 'rbn.route_id = r.id', 'left')->join('poribohons p', 'r.poribohon_id = p.id', 'left')->join('districts d', 'r.from_district = d.id', 'left')->join('districts td', 'r.to_district = td.id', 'left')->where('r.is_publish', 1)->order_by('r.id', 'desc')->limit(5)->get();
    //echo $CI->db->last_query();return;
    return $query->result_array();
}

function latest_transports() {
    $CI = & get_instance();
    $query = $CI->db->select('t.id,r.from_place,r.to_place,r.transport_type,r.added,r.is_publish,r.from_district,r.to_district,r.from_thana,r.to_thana,u.username,rbn.from_place fp_bn,rbn.to_place tp_bn,rbn.departure_time,p.name,p.bn_name,d.name district_name,d.bn_name district_name_bn,td.name td_name,td.bn_name td_bn_name')->from('routes r')->join('users u', 'r.added_by = u.id', 'left')->join('route_bn rbn', 'rbn.route_id = r.id', 'left')->join('poribohons p', 'r.poribohon_id = p.id', 'left')->join('districts d', 'r.from_district = d.id', 'left')->join('districts td', 'r.to_district = td.id', 'left')->where('r.is_publish', 1)->order_by('r.id', 'desc')->limit(5)->get();
    //echo $CI->db->last_query();return;
    return $query->result_array();
}

function make_keywords($str) {
    $mod_str = $str . lang('meta_str');
    $mod_str = str_replace(array(',', '.', '::', '-', '(', ')'), '', trim($mod_str));
    $mod_str = strtolower($mod_str);
    $word_arr = explode(' ', trim($mod_str));
    $remove = array('is', 'with', 'a', 'the', 'to', 'from', 'in', 'an', 'and', 'of', 'for', 'including', 'required', 'even', 'many', 'more');
    array_filter($word_arr);
    $final_arr = array_filter(array_diff($word_arr, $remove));
    return implode(',', array_unique($final_arr));
}

function unicode_title($str) {
    $str = str_replace(array('(', ')'), '', $str);
    $search = array(',', ' ');
    $string = str_replace($search, '-', $str);
    return mb_convert_case($string, MB_CASE_LOWER, 'UTF-8');
}

function load_css($resources) {
    $css = '';
    foreach ($resources as $dir => $file_name) {
        $css .= '<link rel="preload" href="' . base_url('assets/' . $dir . '/' . $file_name) . '" as="style" onload="this.rel=\'stylesheet\'">' . PHP_EOL;
    }
    return $css;
}

function load_script($resources) {
    $script = '';
    foreach ($resources as $dir => $file_name) {
        $dir = str_replace('#', '', $dir);
        $script .= '<script type="text/javascript" src="' . base_url('assets/' . $dir . '/' . $file_name) . '" async></script>' . PHP_EOL;
    }
    return $script;
}

function script_init($resources) {
    $script = '';
    foreach ($resources as $code) {
        $script .= $code . PHP_EOL;
    }
    return $script;
}

function gainers_point($arr, $user_id) {
    $filteredArray = array_filter($arr, function($elem) use($user_id) {
        return ($elem == $user_id);
    });
    $from_district = 1;
    $from_thana = 1;
    $from_place = 3;
    $to_district = 1;
    $to_thana = 1;
    $to_place = 3;
    $transport_type = 1;
    $poribohon = 3;
    $departure_time = 3;
    $rent = 3;
    $evidence = 3;
    $evidence2 = 3;
    $total_point = 0;
    foreach ($filteredArray as $key => $a) {
        $total_point += $$key;
    }
    return $total_point;
}

function real_ids($route_id) {
    $CI = & get_instance();
    $results = $CI->pm->get_data('edited_stoppages', FALSE, 'route_id', $route_id);
    $all_id = '';
    foreach ($results as $key => $val) {
        if ($key == 0) {
            $all_id .= $val['real_id'];
        } else {
            $all_id .= ',' . $val['real_id'];
        }
    }
    return explode(',', $all_id);
}
