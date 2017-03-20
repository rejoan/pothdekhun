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
        $privatekey = '6LdBRhEUAAAAAKkvzi_1RLQSV6-ook_AfcLxfS7c';
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => $privatekey,
            'response' => $captcha,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        );

        $curlConfig = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $data
        );

        $ch = curl_init();
        curl_setopt_array($ch, $curlConfig);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, TRUE);
    }

}
