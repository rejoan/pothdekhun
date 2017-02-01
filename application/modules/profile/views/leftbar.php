<div  class="col-sm-3 col-sm-pull-6">
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

            <?php if ($profile['user_id'] == $this->session->user_id): ?>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <a href="<?php echo site_url_tr('profile/my_routes'); ?>"><b><?php echo lang('route_added') ?></b> <?php echo $tot_added; ?></a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>