<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * captcha library
 * @author Rejoanul Alam
 */
class Recaptcha {
    /**
     * CodeIgniter New Captcha Library
     * 
     */
//    protected $CI;
//
//    public function __construct() {
//        $this->CI = & get_instance();
//    }

    /**
     * generate captcha HTML
     * @return string
     */
    public function recaptcha_get_html() {
        $html = '<script src="https://www.google.com/recaptcha/api.js" async defer></script>
                <div class="g-recaptcha" data-sitekey="6LdBRhEUAAAAAN_xWz0vmfkF_nB155WbCl-QLs2M"></div>';
        return $html;
    }

    /**
     * validate captcha user entered
     * @param string $captcha
     * @return array
     */
    public function recaptcha_check_answer($captcha) {
        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LdBRhEUAAAAAKkvzi_1RLQSV6-ook_AfcLxfS7c&response=' . $captcha);
        $result = json_decode($response, TRUE);
        return $result;
    }

}
