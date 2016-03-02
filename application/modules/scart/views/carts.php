<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$message = $this->session->flashdata('message');
if ($message) {
    echo '<div class="alert alert-info">' . $message . '</div>';
}
?>
<div  class="col-xs-12 col-md-3">
    <div class="box box-primary box-poth">
        <div class="box-header with-border">

        </div>
        <div class="box-body box-profile">
           
            <img class="profile-user-img img-responsive img-circle" src="" alt="User profile picture">

            <h3 class="profile-username text-center"></h3>

           
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
<div class="col-xs-12 col-md-6">
    <div class="box box-primary box-poth">
        <div class="box-header with-border">
            <h3 class="box-title">About</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <strong><i class="fa fa-book margin-r-5"></i> Occupation</strong>

            <p class="text-muted">
                SE
            </p>

            <hr>

            <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

            <hr>
            <strong><i class="fa fa-file-text-o margin-r-5"></i> Details</strong>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
        </div>
        <!-- /.box-body -->
    </div>
</div>
