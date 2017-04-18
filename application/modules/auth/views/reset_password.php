<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-4">
        <?php
        $message = $this->session->flashdata('message');
        if ($message) {
            echo '<div class="alert alert-warning">' . $message . '</div>';
        }
        ?>
        <div class="login-box">
            <div class="login-box-body">
                <form action="<?php echo site_url_tr('auth/reset_pass_submit'); ?>" method="post">
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="<?php echo lang('new_password'); ?>" name="new_password" required>
                    </div>
                    <?php echo form_error('password', '<div class="alert alert-danger">', '</div>'); ?>

                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="<?php echo lang('cpassword'); ?>" name="cpassword" required>
                    </div>
                    <?php echo form_error('cpassword', '<div class="alert alert-danger">', '</div>'); ?>

                    <div class="form-group">
                        <input  type="hidden" name="poth_identity" value="<?php if ($this->input->post('poth_identity')) {
            echo $this->input->post('poth_identity');
        } else {
            echo strlen($this->uri->segment(1)) == 2 ? $this->uri->segment(4) : $this->uri->segment(3);
        } ?>" />
                        <input  type="hidden" name="token" value="<?php if ($this->input->post('token')) {
            echo $this->input->post('token');
        } else {
            echo strlen($this->uri->segment(1)) == 2 ? $this->uri->segment(5) : $this->uri->segment(4);
        } ?>" />
                        <input type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo lang('reset_pass'); ?>"/>
                    </div>

                </form>

            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- route info pull form -->
    </div>
</div><!--/row-->
