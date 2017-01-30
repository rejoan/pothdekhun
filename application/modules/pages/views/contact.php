<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xs-12 col-md-6">
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
            <form class="form-horizontal" action="<?php echo site_url('pages/contact_us'); ?>" method="POST" enctype="multipart/form-data">
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
                        <input name="submit" type="submit" class="btn btn-info" value="<?php echo lang('send'); ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>