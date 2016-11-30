<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-4">
        <div class="login-box">
            <div class="login-box-body">
                <p class="login-box-msg">
                    <?php
                    if ($this->session->from_login) {
                        $f_login = '<strong>' . $this->session->from_login . '</strong> ' . lang('from_view') . ' <strong> ' . $this->session->to_login . ' </strong>';
                    } else {
                        $f_login = '';
                    }
                    echo $f_login . lang('login_first');
                    ?>

                </p>

                <form action="<?php echo $action; ?>" method="post">
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="<?php echo lang('email'); ?>" name="email" required title="আপনার ইমেইল ঠিকানা দিন">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="<?php echo lang('password'); ?>" name="password" required title="পাসওয়ার্ড দিন">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo lang('m_login'); ?>"/>
                    </div>

                </form>

                <div class="social-auth-links text-center">
                    <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> <?php echo lang('facebook_login'); ?></a>
                    <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> <?php echo lang('google_login'); ?></a>
                </div>
                <!-- /.social-auth-links -->

                <a href="#"><?php echo lang('forgot_pass'); ?></a><br>
                <a href="<?php echo site_url_tr('authentication/register'); ?>" class="text-center"><?php echo lang('register_link'); ?></a>

            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- route info pull form -->
    </div>
</div><!--/row-->
<script>
    function statusChangeCallback(response) {
        if (response.status === 'connected') {
            login_pothdekhun();
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            document.getElementById('status').innerHTML = 'Please log ' +
                    'into this app.';
        } else {
            document.getElementById('status').innerHTML = 'Please log ' +
                    'into Facebook.';
        }
    }

    function checkLoginState() {
        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        });
    }

    window.fbAsyncInit = function () {
        FB.init({
            appId: '913368875410866',
            cookie: true,
            xfbml: true,
            version: 'v2.8'
        });

        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        });

    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    function login_pothdekhun() {
        FB.api('/me', function (response) {
            var site_url = $('#site_url').val();
            $.ajax({
                url: site_url + '/weapons/register',
                type: 'get',
                dataType: 'json',
                data: {
                    username: response.name
                    email: response.email
                }
            }).done(function (result) {

            });
        });
    }
</script>