<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <?php
    $message = $this->session->flashdata('message');
    if ($message) {
        echo '<div class="alert alert-info">' . $message . '</div>';
    }
    ?>
    <div class="col-xs-12 col-md-3">
        
    </div>
    <div class="col-xs-12 col-md-5">

    </div>

</div><!--/row-->
