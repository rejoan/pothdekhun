<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="box box-primary box-poth">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo lang('more_transport') ?></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?php foreach ($more_transports as $latest): ?>
            <div class="box-title">
                <p class="no-margin"><a href="<?php echo site_url_tr('routes/show') . '/' . $latest['r_id']; ?>"><?php echo $latest[$this->nl->lang_based_data('bn_name', 'name')]; ?></a></p>
            </div>
            <hr/>
        <?php endforeach ?>
        <a href="<?php echo site_url_tr('routes/all'); ?>" class="btn btn-sm btn-info"><i class="fa fa-list"></i>  <?php echo lang('see_all_routes'); ?></a>
    </div>

</div>