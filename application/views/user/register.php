<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-md-offset-3">
        <!-- route info pull form -->

        <div class="login-box">
            <div class="login-box-body">
                <p class="login-box-msg">
                    <?php
                    if ($this->session->from_login) {
                        $f_login = '<strong>' . $this->session->from_login . '</strong> ' . $this->lang->line('from_view') . ' <strong> ' . $this->session->to_login . ' </strong>';
                    } else {
                        $f_login = '';
                    }
                    echo $f_login . $this->lang->line('login_first');
                    ?>

                </p>
                <form  action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <div id="userInfo" class="form-group has-feedback">
                        <input id="chkUsername" type="text" class="form-control" placeholder="<?php echo $this->lang->line('username');?>" name="username" required title="আপনার ইউজার নাম দিন">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <?php echo form_error('username', '<div class="alert alert-danger">', '</div>'); ?>

                    <div id="emailInfo" class="form-group has-feedback">
                        <input id="chkEmail" type="email" class="form-control" placeholder="<?php echo $this->lang->line('email');?>" name="email" required title="আপনার ইমেইল দিন">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <?php echo form_error('email', '<div class="alert alert-danger">', '</div>'); ?>

                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="mobile" placeholder="<?php echo $this->lang->line('mobile');?>">
                        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="<?php echo $this->lang->line('password');?>" name="password" required title="পাসওয়ার্ড দিন">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <?php echo form_error('password', '<div class="alert alert-danger">', '</div>'); ?>
                    <input type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo $this->lang->line('register_button');?>"/>
                </form>
                <a href="<?php echo site_url('users/login'); ?>" class="text-center"><?php echo $this->lang->line('login_link'); ?></a>

            </div>
            <!-- /.login-box-body -->
        </div>
    </div>
</div>
</div><!--/row-->