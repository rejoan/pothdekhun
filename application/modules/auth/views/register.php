<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-md-offset-3">
        <!-- route info pull form -->
        <?php
        $message = $this->session->flashdata('message');
        if ($message) {
            echo '<div class="alert alert-warning">' . $message . '</div>';
        }
        ?>
        <div class="login-box">
            <div class="login-box-body">
                <p class="login-box-msg">
                    <?php
                    echo lang('register');
                    ?>
                </p>
                <form  action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <div id="userInfo" class="form-group has-feedback">
                        <input id="chkUsername" type="text" class="form-control" placeholder="<?php echo lang('username'); ?>" name="username" required value="<?php echo set_value('username'); ?>">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <?php echo form_error('username', '<div class="alert alert-danger">', '</div>'); ?>

                    <div id="emailInfo" class="form-group has-feedback">
                        <input id="chkEmail" type="email" class="form-control" placeholder="<?php echo lang('email'); ?>" name="email" required value="<?php echo set_value('email'); ?>">
                        <span class="help-block"><?php echo lang('email_info');?></span>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <?php echo form_error('email', '<div class="alert alert-danger">', '</div>'); ?>

                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="mobile" placeholder="<?php echo lang('mobile'); ?>" autocomplete="off" value="<?php echo set_value('mobile'); ?>">
                        <span class="help-block"><?php echo lang('mobile_info');?></span>
                        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    </div>
                    

                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="<?php echo lang('password'); ?>" name="password" required autocomplete="off">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <?php echo form_error('password', '<div class="alert alert-danger">', '</div>'); ?>

                    <div class="form-group">
                        <?php echo $captcha; ?>
                    </div>

                    <input type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo lang('register_button'); ?>"/>
                </form>
                <a href="<?php echo site_url('auth/login'); ?>" class="text-center"><?php echo lang('login_link'); ?></a>

            </div>
            <!-- /.login-box-body -->
        </div>
    </div>
</div>
</div><!--/row-->