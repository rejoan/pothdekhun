<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-4">
        <div class="login-box">
            <div class="login-box-body">
                <form action="<?php echo $action; ?>" method="post">
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="<?php echo lang('email'); ?>" name="email" required>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="form-group">
<!--                        <input type="hidden" name="<?php //echo $this->security->get_csrf_token_name();                                       ?>" value="<?php //echo $this->security->get_csrf_hash();                                       ?>" />-->
                        <input type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo lang('send'); ?>"/>
                    </div>

                </form>

                <a href="<?php echo site_url_tr('auth/register'); ?>" class="text-center"><?php echo lang('register_link'); ?></a>

            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- route info pull form -->
    </div>
</div><!--/row-->
