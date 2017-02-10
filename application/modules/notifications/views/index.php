<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-sm-6 col-sm-push-3">
    <div class="box box-poth">
        <div class="box-header with-border">
            <p><?php echo $title; ?></p>
        </div>
        <div class="box-body">
            <?php foreach ($notifications as $n): ?>
                <div class="row custom_margin">
                    <p>Details : <?php echo $n['notification_msg']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
