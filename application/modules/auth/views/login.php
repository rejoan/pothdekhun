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
<!--                        <input type="hidden" name="<?php //echo $this->security->get_csrf_token_name();                                ?>" value="<?php //echo $this->security->get_csrf_hash();                                ?>" />-->
                        <input type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo lang('m_login'); ?>"/>
                    </div>

                </form>

                <div class="social-auth-links">
                    <div class="form-group">
                        <a id="fb_login" href="javascript:void(0)" class="btn btn-block btn-social btn-facebook">
                            <i class="fa fa-facebook"></i> Sign in with Facebook
                        </a>
                    </div>

                    <div class="form-group">
                        <a class="btn btn-block btn-social btn-google">
                            <i class="fa fa-google-plus" style="left:2px;"></i> Sign in with Google
                        </a>
                    </div>

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
    $(document).ready(function () {
        $('#fb_login').click(function () {
            fb_login();
        });
    });
    function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
    }
    ;



    function statusChangeCallback(response) {
        if (response.status === 'connected') {
            testAPI();
        } else if (response.status === 'not_authorized') {

        } else {

        }
    }


//    FB.login(function (response) {
//        if (response.status === 'connected') {
//            FB.api('/me', function (response) {
//                var site_url = $('#site_url').val();
//                $.ajax({
//                    url: site_url + 'weapons/register',
//                    type: 'post',
//                    data: {
//                        email: response.email
//                    }
//                }).done(function (res) {
//                    window.location.href = '<?php //echo site_url_tr('profile');             ?>';
//                });
//            });
//
//        } else if (response.status === 'not_authorized') {
//            //login_pothdekhun();
//        } else {
//
//        }
//    }, {scope: 'public_profile,email'});




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

    function testAPI() {
        FB.api('/me', {fields: 'email'}, function (response) {
            var site_url = $('#site_url').val();
            $.ajax({
                url: site_url + 'weapons/register',
                type: 'post',
                data: {
                    email: response.email
                }
            }).done(function (res) {
                window.location.href = '<?php echo site_url_tr('profile'); ?>';
            });
        });
    }

    function fb_login() {
        FB.login(function (response) {
            if (response.status === 'connected') {
                testAPI();
            } else if (response.status === 'not_authorized') {
                // The person is logged into Facebook, but not your app.
            } else {
                // The person is not logged into Facebook, so we're not sure if
                // they are logged into this app or not.
            }
        });
    }

</script>