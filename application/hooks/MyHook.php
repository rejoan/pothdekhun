<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This hook class will be loaded on post_controller_constructor event
 * @author Rejoanul Alam
 */
class MyHook {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
    }

    /**
     * This function is called on post-controller-constructor event to decide the language
     * 
     */
    public function language_set() {
        $lang = language_array(); //calling helper function to load all languages in an array
        $lang_code = $this->CI->uri->segment(1, 'en');
        if ($lang_code) {
            if (array_key_exists($lang_code, $lang)) {
                $language = array(
                    'lang_code' => $lang_code,
                    'lang_name' => $lang[strtolower($lang_code)]['lang_name'],
                    'lang_flag' => $lang[strtolower($lang_code)]['lang_flag']
                );
            } else {
                $language = array(
                    'lang_code' => $this->CI->config->item('lang_code'),
                    'lang_name' => $this->CI->config->item('language'),
                    'lang_flag' => $this->CI->config->item('lang_flag')
                );
            }
            $this->CI->session->set_userdata($language);
            $lang_name = $this->CI->session->lang_name;
            $this->CI->lang->load('common', $lang_name);
            $class = $this->CI->router->fetch_class();
            $file_name = APPPATH . 'language/' . $this->CI->session->lang_name . '/' . $class . '_lang.php';
            //var_dump(file_exists($file_name));
            if (file_exists($file_name)) {
                $this->CI->lang->load($class, $lang_name);
            }
        }
    }

    public function process_acl() {
        $class = $this->CI->router->fetch_class();
        if ($class == 'auth') {
            if (count($_COOKIE) < 1) {
                $this->CI->session->set_flashdata('message', 'Cookies are disabled.Please enable first');
                redirect_tr('routes');
            }
        }
    }

}
