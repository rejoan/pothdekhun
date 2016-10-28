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
                        <input type="email" class="form-control" placeholder="<?php echo lang('email');?>" name="email" required title="আপনার ইমেইল ঠিকানা দিন">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="<?php echo lang('password');?>" name="password" required title="পাসওয়ার্ড দিন">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo lang('m_login');?>"/>
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