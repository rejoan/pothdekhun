<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div class="login-box">
        <div class="login-box-body">
            <p class="login-box-msg">
                Admin Login
            </p>

            <form action="<?php echo $action; ?>" method="post">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="Login"/>
                </div>
            </form>

            <a href="#"><?php echo lang('forgot_pass'); ?></a><br>

        </div>
        <!-- /.login-box-body -->
    </div>
