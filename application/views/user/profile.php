<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <?php
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

                <p class="text-muted text-center"><?php echo $profile['occupation']; ?></p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b><?php echo $this->lang->line('route_added') ?></b> <a class="pull-right">1,322</a>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo $this->lang->line('route_edited') ?></b> <a class="pull-right">1,322</a>
                    </li>
                </ul>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-xs-12 col-md-5">
        <div class="box box-primary box-poth">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $this->lang->line('about_me') ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <strong><i class="fa fa-book margin-r-5"></i> <?php echo $this->lang->line('occupation') ?></strong>

                <p class="text-muted">
                    <?php echo $profile['occupation']; ?>
                </p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> <?php echo $this->lang->line('location') ?></strong>
                <?php
                $district = $thana = $country = '';
                if (!empty($profile['district'])) {
                    $district = ', ' . $profile['district'];
                }
                if (!empty($profile['country'])) {
                    $country = ', ' . $profile['country'];
                }
                ?>
                <p class="text-muted"><?php echo $profile['thana'] . $district . $country; ?></p>

                <hr>


                <strong><i class="fa fa-file-text-o margin-r-5"></i> <?php echo $this->lang->line('about_detail') ?></strong>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div id="profile" class="col-xs-12 col-md-4">
        <!-- PRODUCT LIST -->
        <div class="box box-primary box-poth">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $this->lang->line('recent_routes') ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="box-footer box-comments">
                    <div class="box-comment">
                        <div class="comment-text">
                            <span class="username">
                                Maria Gonzales
                                <span class="text-muted pull-right">8:03 PM Today</span>
                            </span><!-- /.username -->
                            It is a long established fact that a reader will be distracted
                            by the readable content of a page when looking at its layout.
                        </div>
                        <!-- /.comment-text -->
                    </div>
                    <!-- /.box-comment -->
                    <div class="box-comment">
                        <div class="comment-text">
                            <span class="username">
                                Luna Stark
                                <span class="text-muted pull-right">8:03 PM Today</span>
                            </span><!-- /.username -->
                            It is a long established fact that a reader will be distracted
                            by the readable content of a page when looking at its layout.
                        </div>
                        <!-- /.comment-text -->
                    </div>
                    <!-- /.box-comment -->
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <a href="javascript::;" class="uppercase">View All Products</a>
            </div>
            <!-- /.box-footer -->
        </div>
    </div>

</div><!--/row-->
