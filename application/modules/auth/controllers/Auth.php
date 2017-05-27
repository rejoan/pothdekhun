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
        $this->load->library('form_validation');
    }

//    public function index() {
//        if ($this->session->user_type) {
//            redirect('dashboard');
//        } else {
//            $this->login();
//        }
//    }

    public function register() {
        $this->load->library('recaptcha');
        $data = array(
            'title' => lang('register'),
            'action' => site_url_tr('auth/register'),
            'captcha' => $this->recaptcha->recaptcha_get_html(),
            'load_script' => load_script(array('js' => 'jquery-3.2.0.min.js'))
        );


        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('email', lang('email'), 'required|is_unique[users.email]|valid_email');
            $this->form_validation->set_rules('username', lang('username'), 'required|is_unique[users.username]');
            $this->form_validation->set_message('is_unique', lang('is_unique_msg'));
            $captcha_response = $this->recaptcha->recaptcha_check_answer($this->input->post('g-recaptcha-response'));
            if (!$captcha_response['success']) {
                $this->session->set_flashdata('message', lang('auth_invalid_captcha'));
                redirect_tr('auth/register');
            }

            if ($this->form_validation->run() == FALSE) {
                $this->nl->view_loader('user', 'register', NULL, $data);
                return;
            } else {
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
                $this->db->set('reg_date', 'NOW()', FALSE);
                $user_id = $this->pm->insert_data('users', $user, TRUE);
                $user_data = array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'email' => $email,
                    'user_type' => 'user'
                );
                $this->session->set_userdata($user_data);
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
            $this->session->set_flashdata('message', $e->getMessage());
            redirect_tr('auth/login');
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            $this->session->set_flashdata('message', $e->getMessage());
            redirect_tr('auth/login');
        }
        $guser = $response->getGraphUser();
        $email = $guser['email'];
        if (empty($email)) {
            $this->session->set_flashdata('message', 'Probably you not set any email so far');
            redirect_tr('auth/login');
        }
        //var_dump($email);return;
        $this->login_auth($email);
    }

    public function g_back_check() {
        require_once 'application/third_party/Google/src/Google/autoload.php';

        $redirect_uri = site_url_tr('auth/g_back_check');
        $client = new Google_Client();
        $client->setAuthConfig('{"web":{"client_id":"606528754739-mag1caviaal84rdm8uirn108fmlr8raa.apps.googleusercontent.com","project_id":"pothdekhun","auth_uri":"https://accounts.google.com/o/oauth2/auth","token_uri":"https://accounts.google.com/o/oauth2/token","auth_provider_x509_cert_url":"https://www.googleapis.com/oauth2/v1/certs","client_secret":"zUTpLr4DVuHXor60GRDkXk9r","javascript_origins":["http://localhost"]}}');
        $client->setRedirectUri($redirect_uri);
        $client->setScopes('email');
        if (isset($_REQUEST['logout'])) {
            unset($_SESSION['id_token_token']);
        }

        $client->authenticate($_GET['code']);

        $access_token = $client->getAccessToken();
        $access_token = json_decode($access_token);
//        if ($access_token) {
//            $token_data = $client->verifyIdToken();
//        }
        $userDetails = file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $access_token->access_token);
        $userData = json_decode($userDetails);

        $this->login_auth($userData->email);
    }

    public function login_auth($email) {
        $user = array(
            'email' => $email,
            'username' => $email
        );
        $u = $this->pm->total_item('users', 'email', $email);
        if ($u < 1) {
            $this->db->set('reg_date', 'NOW()', FALSE);
            $user_id = $this->pm->insert_data('users', $user, TRUE);
            //var_dump($user_id);return;
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
        //ar_dump($user_data,$u);return;
        $this->session->set_userdata($user_data);
        redirect_tr('profile');
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
        $data = array(
            'title' => lang('login'),
            'action' => site_url_tr('auth/login'),
            'load_script' => load_script(array('js' => 'jquery-3.2.0.min.js'))
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
                $next = 'b_janina';
                if ($check !== FALSE) {
                    $this->session->set_userdata($check);
                    $user_type = $this->session->user_type;
                    if ($user_type != 'admin') {
                        $next = 'profile';
                    }
                    $this->pm->updater('id', $this->session->user_id, 'users', array('last_logged' => date('Y-m-d H:i:s')));
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
     * Callback function for checking captcha
     * @author Rejoanul Alam
     */
    public function captcha_check() {
        $captcha = $this->input->post('g-recaptcha-response');
        $this->load->library('recaptcha');
        $result = $this->recaptcha->recaptcha_check_answer($captcha);
        $this->form_validation->set_message('captcha_check', lang('auth_invalid_captcha'));
        return $result['success'];
    }

    /**
     * destroy userdata session and logout
     */
    public function logout() {
        $this->session->sess_destroy();
        redirect_tr('routes');
    }

    /**
     * Password reset form
     */
    public function forgot_password() {
        //date_default_timezone_set('Asia/Dhaka');
        //timezone inactive for production
        $data = array(
            'title' => lang('forgot_password'),
            'action' => site_url_tr('auth/forgot_password'),
            'load_script' => load_script(array('js' => 'jquery-3.2.0.min.js'))
        );

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            if ($this->form_validation->run() == FALSE) {
                $this->nl->view_loader('user', 'forgot_password', NULL, $data);
                return;
            }
            $email = trim($this->input->post('email', TRUE));
            $check = $this->pm->get_row('email', $email, 'users');
            if (count($check) > 0) {
                $this->load->helper('string');
                $token = random_string('alnum');
                $subject = 'PothDekhun Account Password Recovery';
                $body = '<p>Please click the link  to reset your password. Please remember this link only valid for 2 hour: <a href="' . site_url('auth/reset_password/' . $this->nl->enc(($check['id'])) . '/' . md5($token)) . '">Reset Password</a></p>&nbsp;<p>Best Regards<br/> PothDekhun</p>';
                $this->load->library('email');
                $config['mailtype'] = 'html';
                $config['protocol'] = 'sendmail';
                $this->email->initialize($config);
                $this->email->from('owner@pothdekhun.com', 'PothDekhun');
                $this->email->to($email);
                $this->email->subject($subject);
                $this->email->message($body);

                if ($this->email->send()) {
                    $this->pm->deleter('user_id', $check['id'], 'reset_token');
                    $this->db->set('created_at', 'NOW()', FALSE);
                    $this->pm->insert_data('reset_token', array('token' => md5($token), 'user_id' => $check['id']));
                    $this->session->set_flashdata('message', lang('mail_sent_recover'));
                    redirect_tr('auth/login');
                } else {
                    //echo $this->email->print_debugger();
                }
            } else {
                $this->session->set_flashdata('message', lang('not_found'));
                redirect('auth/forgot_password');
            }
        }

        $this->nl->view_loader('user', 'forgot_password', NULL, $data);
    }

    public function reset_password($user_id, $token) {
        //date_default_timezone_set('Asia/Dhaka');
        //timezone inactive for production
        if (empty($token) || empty($user_id)) {
            $this->session->set_flashdata('message', 'Something wrong');
            redirect_tr('auth/reset_password');
        }
        $verify = $this->pm->get_row('user_id', $this->nl->dec($user_id), 'reset_token');
        //var_dump($verify);return;
        if (empty($verify)) {
            $this->session->set_flashdata('message', 'Wrong thing');
            redirect_tr('auth/forgot_password');
        }
        $date1 = new DateTime($verify['created_at']);
        $date2 = new DateTime();
        $interval = $date1->diff($date2);
        //var_dump($verify['token'],$interval);return;
        if ($verify['token'] == $token && $interval->y < 1 && $interval->m < 1 && $interval->d < 1 && $interval->h < 1 && $interval->i < 7200) {
            $data = array(
                'title' => 'Reset Password'
            );

            $this->nl->view_loader('user', 'reset_password', NULL, $data);
        } else {
            $this->session->set_flashdata('message', 'Token Expired or mismatch');
            redirect_tr('auth/forgot_password');
        }
    }

    public function reset_pass_submit() {
        //date_default_timezone_set('Asia/Dhaka');
        //timezone inactive for production
        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        $this->form_validation->set_rules('cpassword', 'Confrim Password', 'required|matches[new_password]');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Reset Password'
            );
            $this->nl->view_loader('user', 'reset_password', NULL, $data);
            return;
        }

        $user_id = $this->nl->dec($this->input->post('poth_identity'));
        $verify = $this->pm->get_row('user_id', $user_id, 'reset_token');
        //var_dump($user_id,$verify);        return;
        if (empty($verify)) {
            $this->session->set_flashdata('message', 'Wrong');
            redirect_tr('auth/reset_password/' . $this->input->post('poth_identity') . '/' . $this->input->post('token'));
        }
        $date1 = new DateTime($verify['created_at']);
        $date2 = new DateTime();
        $interval = $date1->diff($date2);
//        echo '<pre>';
//        var_dump($interval);
//        return;
        if ($interval->y < 1 && $interval->m < 1 && $interval->d < 1 && $interval->h < 1 && $interval->i < 7200) {
            $new_password = $this->input->post('new_password', TRUE);
            $this->pm->deleter('user_id', $user_id, 'reset_token');
            $this->pm->updater('id', $user_id, 'users', array('password' => md5($new_password)));
            $this->session->set_flashdata('message', 'Password succesfully Resetted');
            redirect('auth/login');
        } else {
            $this->session->set_flashdata('message', 'Token Expired or mismatch');
            redirect_tr('auth/forgot_password');
        }
    }

}
