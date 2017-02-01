<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="route_detail" class="col-sm-6 col-sm-push-3">
    <div class="box box-poth">
        <div class="box-header with-border">
            <p><?php echo lang('poribohon_info') . ':</p> <h3><span class="label label-info">' . mb_convert_case($poribohon[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8'); ?></h3>
        </div>
        <div class="box-body">
            <p><?php echo lang('vehicle_name'); ?></p>
            <h3 class="margin_top"><?php echo mb_convert_case($poribohon[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8'); ?></h3>
            <hr/>
            <p><?php echo lang('available_route'); ?></p>
            <ul class="list-group">
                <?php foreach ($routes as $route): ?>
                    <li class="list-group-item"><?php echo mb_convert_case($route[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($route[$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8') . ' <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> ' . mb_convert_case($route[$this->nl->lang_based_data('tp_bn', 'to_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($route[$this->nl->lang_based_data('td_bn_name', 'td_name')], MB_CASE_TITLE, 'UTF-8'); ?> <a class="btn btn-xs btn-info" href="<?php echo site_url_tr('routes/show/') . $route['r_id']; ?>"><?php echo lang('about_detail'); ?></a></li>

                <?php endforeach; ?>
            </ul>
            <hr/>
            <p><?php echo lang('available_counter'); ?></p>
            <ul class="list-group">
                <?php foreach ($counters as $counter): ?>
                    <li class="list-group-item"><?php echo $counter['address'] . ', ' . $counter[$this->nl->lang_based_data('thana_bn', 'thana')] . ', ' . $counter[$this->nl->lang_based_data('bn_name', 'name')]; ?></a></li>
                <?php endforeach; ?>
            </ul>
            <p><?php echo lang('added_by'); ?></p>
            <h3 class="margin_top"><?php echo mb_convert_case($poribohon['username'], MB_CASE_TITLE, 'UTF-8'); ?></h3>
            <hr/>

        </div>
        <div class="box-footer">
            <?php if ($this->session->user_id): ?>
                <a href="<?php echo site_url_tr('transports/edit') . '/' . $poribohon['id']; ?>" class="btn btn-block btn-info"><?php echo lang('edit'); ?></a>
            <?php endif; ?>
            <?php if ($this->nl->is_admin()): ?>
                <a href="<?php echo site_url_tr('transports/accept') . '/' . $poribohon['id']; ?>" class="btn btn-block btn-info">Accept</a>
            <?php endif; ?>
        </div>
    </div>
</div>
