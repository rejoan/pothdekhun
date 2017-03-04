<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-sm-6 col-sm-push-3">
    <?php
    $message = $this->session->flashdata('message');
    if ($message) {
        echo '<div class="alert alert-warning">' . $message . '</div>';
    }
    ?>
    <div class="box box-poth">
        <div class="box-header">
            <h3 class="box-title"><?php echo lang('contact_us'); ?></h3>
        </div>
        <div class="box-body">
            <h3 class="custom_margin">We appreciate any suggestion. </h3>
            <form class="form-horizontal" method="post" action="<?php echo site_url_tr('pages/contact-us'); ?>">
                <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label"><?php echo lang('name'); ?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" placeholder="<?php echo lang('name'); ?>">
                    </div>
                </div>
                <?php echo form_error('name', '<div class="alert alert-danger">', '</div>'); ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('email'); ?></label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="email" placeholder="<?php echo lang('email'); ?>">
                    </div>
                </div>
                <?php echo form_error('email', '<div class="alert alert-danger">', '</div>'); ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('comment'); ?></label>

                    <div class="col-sm-9">
                        <textarea class="form-control" name="comment" placeholder="<?php echo lang('comment'); ?>"></textarea>
                    </div>
                </div>
                <?php echo form_error('comment', '<div class="alert alert-danger">', '</div>'); ?>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" name="submit" class="btn btn-info" value="<?php echo lang('send'); ?>">
                    </div>
                </div>
            </form>
            <p>You may also contact through our email owner@pothdekhun.com</p>
        </div>
    </div>
</div>