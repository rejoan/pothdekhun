<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<input type="hidden" id="site_url" value="<?php echo site_url_tr(); ?>" />
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>"/>
<input type="hidden" id="email_text" value="<?php echo lang('email_text'); ?>"/>
<input type="hidden" id="email_exist" value="<?php echo lang('email_exist'); ?>"/>

</div><!-- col-->
<footer>
    <p>&copy; Pothdekhun <?php echo date('Y'); ?></p>
</footer>
</div><!-- row-->
</div><!--/.container-->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap/bootstrap-select.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap/bootstrap.file-input.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap-sweetalert/dist/sweetalert.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/val_lib.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/poth.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap/tooltip.js'); ?>"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script type="text/javascript" src="<?php echo base_url('assets/js/ie10-viewport-bug-workaround.js'); ?>"></script>
<script>
    $(document).ready(function () {

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
            login_pothdekhun();
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.

        } else {

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
        FB.api('/me?fields=first_name,email', function (response) {
            alert(response.email);
            var site_url = $('#site_url').val();
            $.ajax({
                url: site_url + 'weapons/register',
                type: 'post',
                data: {
                    username: response.name,
                    email: response.email,
<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'

                }
            }).done(function (result) {

                if (result == 'inserted') {
                    window.location.href = site_url + 'profile';
                }
            });
        });
    }
</script>
</body>
</html>