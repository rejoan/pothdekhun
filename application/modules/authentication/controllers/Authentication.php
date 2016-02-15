<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This controller will handle user registration/login/forgot password etc
 * @author Ashikur Rahman
 */
class Authentication extends MX_Controller {

    public function __construct() {
        parent :: __construct();
        $this->load->model('authentication_model', 'authentication');
        $this->load->language('authentication');
    }

//    public function index() {
//        if ($this->session->userdata('userdata')['admin_type'] != '') {
//            redirect('dashboard');
//        } else {
//            $this->login();
//        }
//    }

    /**
     * Showing signup form
     * @todo starter kit will be implemented in future
     * @todo artdata pact and privacy policy needs to come from db
     * @todo ajax country/city dropdown list
     * @author Ashikur Rahman
     */
    public function signup() {
        $this->load->library('recaptcha');
        $data['body']['captcha'] = $this->recaptcha->recaptcha_get_html();
        $data['body']['page'] = "register";
        $data['body']['countries'] = $this->common_model->get_country_list();
        makeTemplate($data);
    }

    /**
     * Showing login form
     * @todo captcha integration for failed try
     * @author Ashikur Rahman
     */
    public function login() {
        $this->load->library('form_validation');
        $data['title'] = 'login';
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('USER_USERNAME', 'USERNAME', 'trim|required|valid_email');
            $this->form_validation->set_rules('USER_PASSWORD', 'PASSWORD', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $data['error'] = 'No user found';
                $this->load->view('login', $data);
                return;
            } else {
                $USER_USERNAME = $this->input->post('USER_USERNAME', TRUE);
                $USER_PASSWORD = $this->input->post('USER_PASSWORD', TRUE);
                //check validity
                $check = $this->authentication->check_credential($USER_USERNAME, $USER_PASSWORD);

                $redirectto = $this->session->redirectto;
                //var_dump($redirectto);return;
                if ($check !== FALSE) {
                    if ($redirectto) {
                        $redirectto = str_replace(base_url(), '', $redirectto);
                    } else {
                        $redirectto = 'import/add_preload';
                    }
                    $this->session->set_userdata($check);
                    $this->session->set_flashdata('message', lang('successfully_logged_in'));
                    redirect($redirectto);
                } else {
                    $this->session->set_flashdata('message', lang('enter_valid_user_password'));
                    redirect('authentication/login');
                }
            }
        }

        $this->load->view('login', $data);
    }

    /**
     * This function will handle the singup submission
     * @todo implementing all frontend validations
     * @todo implementing email sending
     * @todo need to create function for generating license code
     * @author Ashikur Rahman
     */
    public function signup_process() {
        $this->load->library('recaptcha'); //loading captcha library
        $this->load->library('form_validation'); //loading form validation library

        $this->form_validation->set_rules('user_displayName', 'Name', 'trim|required');
        $this->form_validation->set_rules('user_address', 'Address', 'trim|required');
        $this->form_validation->set_rules('country_id', 'Country', 'trim|required');
        $this->form_validation->set_rules('city_id', 'City', 'trim|required');
        $this->form_validation->set_rules('user_zip_code', 'Zip Code', 'trim|required');
        $this->form_validation->set_rules('user_regType', 'Registration Type', 'trim|required');
        if ($this->input->post('user_regType') == "company") {
            $this->form_validation->set_rules('user_company', 'Company', 'trim|required'); //required if reg type is company
        }
        if ($this->input->post('islicensee')) {
            $this->form_validation->set_rules('user_type', 'user_type', 'trim|required|callback_userType_exist'); //required if user is licensee
            $this->form_validation->set_rules('licensee_business_since', 'licensee_business_since', 'trim|required'); //required if user is licensee
        }
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|is_unique[user.user_email]');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('user_password_confirm', 'Password Confirm', 'trim|required|matches[user_password]');
        $this->form_validation->set_rules('recaptcha_response_field', 'Security Code', 'trim|required|callback_captcha_check');

        if ($this->form_validation->run() == FALSE) {
            //Handle form validation failure
            $this->signup();
        } else {
            $user_id = $this->authentication->signup_save();
            if ($user_id) {
                $this->adataemail->registration_successful($user_id);
                redirectAlert("authentication/login", lang('auth_signup_success'));
            } else {
                redirectAlert("authentication/signup", lang('auth_signup_error'), 'error');
            }
        }
    }

    /**
     * Callback function for checking if email exists
     * @author Ashikur Rahman
     */
    public function email_check($email) {
        if ($this->authentication->check_email($email)) {

            return TRUE;
        } else {
            $this->form_validation->set_message('email_check', lang('auth_invalid_email'));
            return FALSE;
        }
    }

    /**
     * Function to check if user type is defined in configuration file
     * @param string $type
     * @return boolean
     */
    public function userType_exist($type) {
        $uTypeLicense = $this->config->item('uTypeLicense');
        if (array_key_exists($type, $uTypeLicense)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('userType_exist', lang('auth_invalid_captcha'));
            return FALSE;
        }
    }

    /**
     * destroy userdata session and logout
     */
    public function logout() {
        $this->session->sess_destroy();
        redirect('authentication/login');
    }

    public function account_activation() {
        $this->session->unset_userdata('userdata');
        $token = $this->input->get('token');
        $id = $this->input->get('id');
        if ($token & $id) {
            $user = getUser($id);
            $token_compare = md5($user->user_id . $user->user_email . $user->user_type);
            if ($token_compare == $token) {
                $this->authentication->activate_account($user->user_id);
                redirectAlert("authentication/login", lang('auth_account_activation_success'));
            } else {
                echo "Invalid Token";
                die;
            }
        } else {
            echo "Invalid Request";
            die;
        }
    }

    /**
     * Password reset form
     */
    public function forgot_password() {
        if ($this->session->userdata('userdata')) {
            $this->logout();
        }
        $this->load->library('recaptcha');
        $data['body']['captcha'] = $this->recaptcha->recaptcha_get_html();
        $data['body']['page'] = "login_forgot_password_view";
        makeTemplate($data);
    }

    /**
     * Submit email and captcha from forgot password form
     */
    public function forgot_password_submit() {
        $this->load->library('form_validation');
        $this->load->library('recaptcha'); //loading captcha library

        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|email|callback_email_check');
        $this->form_validation->set_rules('recaptcha_response_field', 'Security Code', 'trim|required|callback_captcha_check');

        if ($this->form_validation->run() == FALSE) {
            //Handle form validation failure
            $this->session->keep_flashdata('logincaptcha');
            $this->forgot_password();
        } else {
            //captcha was valid. now check login credentials
            $user_email = $this->input->post('user_email');
            $token = $this->authentication->forgot_pw_token($user_email);
            if ($token != FALSE) {
                $this->adataemail->forgot_password_request_email($user_email, $token);
                redirectAlert('authentication/login', "Password reset link has been sent. Please check your email.", 'success');
            } else {
                redirectAlert("authentication/forgot_password", "An error occured. Please try again.", 'error');
            }
        }
    }

    public function password_reset() {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $check = $this->authentication->chk_forgot_pw_token($email, $token);
        if ($check) {
            $this->password_reset_form($email, $token);
        } else {
            $data['body']['msg'] = "Password reset request invalid or expired";
            $data['body']['page'] = "msg_view";
            makeTemplate($data);
        }
    }

    public function password_reset_form($email, $token) {
        if ($this->session->userdata('userdata')) {
            $this->logout();
        }
        $this->load->library('recaptcha');
        $data['body']['captcha'] = $this->recaptcha->recaptcha_get_html();
        $data['body']['email'] = $email;
        $data['body']['token'] = $token;
        $data['body']['page'] = "login_password_reset_form_view";
        makeTemplate($data);
    }

    public function password_reset_submit() {
        $this->load->library('form_validation');
        $this->load->library('recaptcha'); //loading captcha library
        $email = $this->input->post('email');
        $token = $this->input->post('token');
        if (!($email && $token)) {
            redirect_tr();
        }
        $this->form_validation->set_rules('user_pw', 'Password', 'trim|required');
        $this->form_validation->set_rules('user_pw_retype', 'Retype Password', 'trim|required|matches[user_pw]');
        $this->form_validation->set_rules('recaptcha_response_field', 'Security Code', 'trim|required|callback_captcha_check');
        if ($this->form_validation->run() == FALSE) {
            $this->password_reset_form($email, $token);
        } else {
            if ($this->authentication->reset_pw($email, $token)) {
                redirectAlert('authentication/login', "Password has been reset successfully. You can now login.", 'success');
            } else {
                //$this->session->set_flashdata("alertmsg","Error occured. Please try again.");
                redirectAlert('authentication/login', "Error occured. Please try again.");
            }
        }
    }

}
