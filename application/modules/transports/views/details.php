<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="route_detail" class="col-xs-12 col-md-6">
    <div class="box box-poth">
        <div class="box-header with-border">
            <p><?php echo lang('poribohon_info') . ':</p> <h3><span class="label label-info">' . mb_convert_case($poribohon[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8'); ?></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <?php if (!empty($poribohon['picture'])): ?>
                    <div class="col-md-4">
                        <a class="fancybox" href="<?php echo base_url('evidences') . '/' . $poribohon['picture']; ?>"><img class="img-responsive img-thumbnail" src="<?php echo base_url('evidences') . '/' . $poribohon['picture']; ?>" alt="<?php echo $poribohon['picture']; ?>"/></a>
                    </div>
                <?php endif; ?>

            </div>
            <p><?php echo lang('vehicle_name'); ?></p>
            <h3 class="margin_top"><?php echo mb_convert_case($poribohon[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8'); ?></h3>
            <hr/>
            <p><?php echo lang('owner_name'); ?></p>
            <h3 class="margin_top"><?php echo $poribohon['owner']; ?></h3>
            <hr/>
            <p><?php echo lang('added_by'); ?></p>
            <h3 class="margin_top"><?php echo mb_convert_case($poribohon['username'], MB_CASE_TITLE, 'UTF-8'); ?></h3>
            <hr/>

        </div>
        <div class="box-footer">
            <a href="<?php echo site_url_tr('transports/edit') . '/' . $poribohon['id']; ?>" class="btn btn-block btn-info"><?php echo lang('edit'); ?></a>
        </div>
    </div>
</div>
