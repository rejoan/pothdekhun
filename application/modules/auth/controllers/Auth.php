<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This controller will handle user registration/login/forgot password etc
 * @author Rejoanul Alam
 */
class Auth extends MX_Controller {

    public function __construct() {
        parent :: __construct();
        $this->load->model('auth_model', 'auth');
    }

//    public function index() {
//        if ($this->session->user_type) {
//            redirect('dashboard');
//        } else {
//            $this->login();
//        }
//    }

    public function register() {
        $data = array(
            'title' => lang('register'),
            'action' => site_url_tr('auth/register')
        );
        $this->load->library('form_validation');

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('email', lang('email'), 'required|is_unique[users.email]|valid_email');
            $this->form_validation->set_rules('username', lang('username'), 'is_unique[users.username]');
            $this->form_validation->set_message('is_unique', lang('is_unique_msg'));

            $username = trim($this->input->post('username', TRUE));
            $email = trim($this->input->post('email', TRUE));
            $mobile = trim($this->input->post('mobile', TRUE));
            $password = trim($this->input->post('password', TRUE));
            $user = array(
                'username' => $username,
                'email' => $email,
                'mobile' => $mobile,
                'password' => md5($password)
            );

            if ($this->form_validation->run() == FALSE) {
                $this->nl->view_loader('user', 'register', $data);
                return;
            } else {
                $this->db->insert('users', $user);
//send email for verification
                $this->session->set_flashdata('message', lang('register_user'));
                redirect_tr('profile');
            }
        }
        $this->nl->view_loader('user', 'register', NULL, $data);
    }

    public function back_check() {
        include 'application/third_party/Facebook/autoload.php';
        $fb = new Facebook\Facebook([
            'app_id' => '913368875410866',
            'app_secret' => '8d22aa1e325197ba9a766dc63f313210',
            'default_graph_version' => 'v2.2',
        ]);
        $helper = $fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (!isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
//                echo "Error: " . $helper->getError() . "\n";
//                echo "Error Code: " . $helper->getErrorCode() . "\n";
//                echo "Error Reason: " . $helper->getErrorReason() . "\n";
//                echo "Error Description: " . $helper->getErrorDescription() . "\n";
                $this->session->set_flashdata('message', $helper->getErrorReason());
                redirect_tr('auth/login');
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

// Logged in

        $token = $accessToken->getValue();

        try {
            $response = $fb->get('/me?fields=id,email', $token);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        $guser = $response->getGraphUser();
        $email = $guser->getEmail();
        $user = array(
            'email' => $email
        );
        $u = $this->pm->total_item('users', 'email', $email);
        if ($u < 1) {
            $this->db->set('reg_date', 'NOW()', FALSE);
            $user_id = $this->pm->insert_data('users', $user, TRUE);
        } else {
            $user = $this->pm->get_row('email', $email, 'users');
            $user_id = $user['id'];
        }
        $user_data = array(
            'user_id' => $user_id,
            'username' => $email,
            'email' => $email,
            'user_type' => 'user'
        );
        $this->session->set_userdata($user_data);
        
    }

    /**
     * Showing login form
     * @todo captcha integration for failed try
     * @author Rejoanul Alam
     */
    public function login() {

        if ($this->session->user_id) {
            redirect_tr('profile');
        }
        $this->load->library('form_validation');
        $data = array(
            'title' => lang('login'),
            'action' => site_url_tr('auth/login')
        );

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['error'] = 'No user found';
                $this->nl->view_loader('user', 'login', NULL, $data);
                return;
            } else {
                $USER_USERNAME = $this->input->post('email', TRUE);
                $USER_PASSWORD = $this->input->post('password', TRUE);
                //check validity
                $check = $this->auth->check_credential($USER_USERNAME, $USER_PASSWORD);
                $next = 'admin';
                if ($check !== FALSE) {
                    $this->session->set_userdata($check);
                    $user_type = $this->session->user_type;
                    if ($user_type != 'admin') {
                        $next = 'profile';
                    }
                    $this->session->set_flashdata('message', lang('successfully_logged_in'));
                    redirect_tr($next);
                } else {
                    $this->session->set_flashdata('message', lang('enter_valid_user_password'));
                    redirect('auth/login');
                }
            }
        }

        $this->nl->view_loader('user', 'login', NULL, $data);
    }

    /**
     * Callback function for checking if email exists
     * @author Rejoanul Alam
     */
    public function email_check($email) {
        if ($this->auth->check_email($email)) {

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
        redirect_tr('routes');
    }

    public function account_activation() {
        $this->session->unset_userdata('userdata');
        $token = $this->input->get('token');
        $id = $this->input->get('id');
        if ($token & $id) {
            $user = getUser($id);
            $token_compare = md5($user->user_id . $user->user_email . $user->user_type);
            if ($token_compare == $token) {
                $this->auth->activate_account($user->user_id);
                redirectAlert("auth/login", lang('auth_account_activation_success'));
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
            $token = $this->auth->forgot_pw_token($user_email);
            if ($token != FALSE) {
                $this->adataemail->forgot_password_request_email($user_email, $token);
                redirectAlert('auth/login', "Password reset link has been sent. Please check your email.", 'success');
            } else {
                redirectAlert("auth/forgot_password", "An error occured. Please try again.", 'error');
            }
        }
    }

    public function password_reset() {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $check = $this->auth->chk_forgot_pw_token($email, $token);
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
            if ($this->auth->reset_pw($email, $token)) {
                redirectAlert('auth/login', "Password has been reset successfully. You can now login.", 'success');
            } else {
                //$this->session->set_flashdata("alertmsg","Error occured. Please try again.");
                redirectAlert('auth/login', "Error occured. Please try again.");
            }
        }
    }

}
