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
            <h3 class="box-title"><?php echo $title; ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
           In Progress
        </div>
        <!-- /.box-body -->
    </div>
</div>
