<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-4">
        <div class="login-box">
            <div class="login-box-body">
                <form action="<?php echo site_url_tr('auth/reset_pass_submit'); ?>" method="post">
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="<?php echo lang('password'); ?>" name="new_password" required>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="<?php echo lang('cpassword'); ?>" name="cpassword" required>
                    </div>

                    <div class="form-group">
                        <input  type="hidden" name="poth_identity" value="<?php echo strlen($this->uri->segment(1)) == 2 ? $this->uri->segment(4) : $this->uri->segment(3); ?>" />
                        <input type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo lang('reset_pass'); ?>"/>
                    </div>

                </form>

            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- route info pull form -->
    </div>
</div><!--/row-->
