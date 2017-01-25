<?php defined('BASEPATH') OR exit('No direct script access allowed');
$message = $this->session->flashdata('message');
if ($message) {
    echo '<div class="alert alert-info">' . $message . '</div>';
}
?>
<div  class="col-xs-12 col-md-3">
    <div class="box box-primary box-poth">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo $profile['username']; ?></h3>
        </div>
        <div class="box-body box-profile">
            <?php
            if (empty($profile['avatar'])) {
                $src = base_url('assets/images') . '/no_image.png';
            } else {
                $src = base_url('avatars') . '/' . $profile['avatar'];
            }
            ?>
            <img class="profile-user-img img-responsive img-circle" src="<?php echo $src; ?>" alt="User profile picture">

            <h3 class="profile-username text-center"><?php echo $profile['first_name'] . ' ' . $profile['last_name']; ?></h3>


            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <a href="<?php echo site_url_tr('profile/my_routes');?>"><b><?php echo lang('route_added') ?></b> <?php echo $tot_added;?></a>
                </li>
            </ul>

        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
<div class="col-xs-12 col-md-6">
    <div class="box box-primary box-poth">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo lang('about_me') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
           

            <strong><i class="fa fa-map-marker margin-r-5"></i> <?php echo lang('location') ?></strong>
            <p class="text-muted"><?php echo $profile[$this->nl->lang_based_data('bn_name','name')] .', '. $profile[$this->nl->lang_based_data('thbn_name','th_name')]; ?></p>

            <hr>


            <strong><i class="fa fa-file-text-o margin-r-5"></i> <?php echo lang('about_detail') ?></strong>

            <p><?php echo $profile['about'];?></p>
            <a class="btn btn-info" href="<?php echo site_url_tr('profile/edit');?>"><?php echo lang('edit');?></a>
        </div>
        <!-- /.box-body -->
    </div>
</div>
