<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$message = $this->session->flashdata('message');
if ($message) {
    echo '<div class="alert alert-info">' . $message . '</div>';
}
?>
<div class="col-sm-6 col-sm-push-3">
    <div class="box box-primary box-poth">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo lang('about') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php if ($profile['user_id'] == $this->session->user_id): ?>
                <strong><span class="glyphicon glyphicon-envelope"></span> <?php echo lang('email') ?></strong>
                <p class="text-muted"><?php echo $profile['email']; ?></p>
                <hr>
                <strong><span class="glyphicon glyphicon-phone"></span> <?php echo lang('mobile') ?></strong>
                <p class="text-muted"><?php echo $profile['mobile']; ?></p>
                <hr>
            <?php endif; ?>
            <strong><span class="glyphicon glyphicon-signal"></span> <?php echo lang('reputation') ?></strong>
            <p><label class="label label-success"><?php echo $profile['reputation']; ?></label></p>
            <hr>

            <strong><span class="glyphicon glyphicon-map-marker"></span> <?php echo lang('location') ?></strong>
            <p class="text-muted"><?php echo $profile[$this->nl->lang_based_data('bn_name', 'name')] . ', ' . $profile[$this->nl->lang_based_data('thbn_name', 'th_name')]; ?></p>

            <hr>


            <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo lang('about_detail') ?></strong>

            <p><?php echo $profile['about']; ?></p>

            <?php if ($this->session->user_id == $profile['user_id']): ?>
                <a class="btn btn-info" href="<?php echo site_url_tr('profile/edit'); ?>"><?php echo lang('edit'); ?></a>

            <?php endif; ?>
        </div>
        <!-- /.box-body -->
    </div>
</div>

