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
    $query = $ci->db->get('languages');

    $languages = array();

    foreach ($query->result_array() as $row) {
        $languages[$row['lang_code']] = $row;
    }

    //$_SESSION['languages'] = $languages;

    return $languages;
}
