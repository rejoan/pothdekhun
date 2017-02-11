<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-sm-6 col-sm-push-3">
    <div class="box box-poth">
        <div class="box-header with-border">
            <p><?php echo $title; ?></p>
        </div>
        <div class="box-body">
            <?php foreach ($notifications as $n): ?>
                <div class="row custom_margin">
                    <p> <small class="text-muted"><?php echo $this->nl->date_formatter('Y-m-d H:i:s', $n['added'], 'd M, Y');?></small>: <?php echo $n['notification_msg']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="box-footer">
            <?php echo $links; ?>
        </div>
    </div>
</div>
