<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-4">
        <div class="login-box">
            <div class="login-box-body">
                <p class="login-box-msg">
                    <?php
                    include 'application/third_party/Facebook/autoload.php';
                    $fb = new Facebook\Facebook([
                        'app_id' => '913368875410866',
                        'app_secret' => '8d22aa1e325197ba9a766dc63f313210',
                        'default_graph_version' => 'v2.2',
                    ]);

                    $helper = $fb->getRedirectLoginHelper();

                    $permissions = ['email']; // Optional permissions
                    $loginUrl = $helper->getLoginUrl('http://www.pothdekhun.com/auth/back_check', $permissions);

                    require_once 'application/third_party/Google/src/Google/autoload.php';

                    $redirect_uri = 'http://www.pothdekhun.com/auth/g_back_check';
                    $client = new Google_Client();
                    $client->setAuthConfig('{"web":{"client_id":"606528754739-mag1caviaal84rdm8uirn108fmlr8raa.apps.googleusercontent.com","project_id":"pothdekhun","auth_uri":"https://accounts.google.com/o/oauth2/auth","token_uri":"https://accounts.google.com/o/oauth2/token","auth_provider_x509_cert_url":"https://www.googleapis.com/oauth2/v1/certs","client_secret":"zUTpLr4DVuHXor60GRDkXk9r","javascript_origins":["http://www.pothdekhun.com"]}}');
                    $client->setRedirectUri($redirect_uri);
                    $client->setScopes('email');
                    $auth_url = $client->createAuthUrl();

                    //$client->setDeveloperKey('AIzaSyDUqpNBK-QljTLbv99d7W__0ZDCrgR9HNE');
                    $message = $this->session->flashdata('message');
                    if ($message) {
                        echo '<div class="alert alert-info">' . $message . '</div>';
                    }
                    ?>

                </p>

                <form action="<?php echo $action; ?>" method="post">
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="<?php echo lang('email'); ?>" name="email" required title="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="<?php echo lang('password'); ?>" name="password" required title="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group">
<!--                        <input type="hidden" name="<?php //echo $this->security->get_csrf_token_name();                                     ?>" value="<?php //echo $this->security->get_csrf_hash();                                     ?>" />-->
                        <input type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo lang('m_login'); ?>"/>
                    </div>

                </form>

                <div class="social-auth-links">
                    <div class="form-group">
                        <a id="fb_login" href="<?php echo $loginUrl; ?>" class="btn btn-block btn-social btn-facebook">
                            <img src="http://localhost/pothdekhun/assets/images/fb.png?<?php echo time();?>" alt="Facebook"> Sign in with Facebook
                        </a>
                    </div>

                    <div class="form-group">
                        <a class="btn btn-block btn-social btn-google" href="<?php echo $auth_url; ?>">
                            <img src="http://localhost/pothdekhun/assets/images/gp.png?<?php echo time();?>" alt="Google"> Sign in with Google
                        </a>
                    </div>

                </div>
                <!-- /.social-auth-links -->

                <a href="<?php echo site_url_tr('auth/forgot_password'); ?>"><?php echo lang('forgot_pass'); ?></a><br>
                <a href="<?php echo site_url_tr('auth/register'); ?>" class="text-center"><?php echo lang('register_link'); ?></a>

            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- route info pull form -->
    </div>
</div><!--/row-->
