<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-sm-6 col-sm-push-3">
    <div class="box box-poth">
        <div class="box-header with-border">
            <p><?php echo $title; ?></p>
        </div>
        <div class="box-body">
            <?php foreach ($route as $n): ?>
                <div class="row custom_margin">
                    <a href="<?php echo site_url_tr('routes/show') . '/' . $n['route_id']; ?>"><?php echo mb_convert_case($n[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($n[$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8') . ' ' . lang('to_view') . ' ' . $n[$this->nl->lang_based_data('tp_bn', 'to_place')] . ', ' . $n[$this->nl->lang_based_data('td_bn_name', 'td_name')]; ?></a>
                    <p>Details : <?php echo $n['notification_msg']; ?></p>
                </div>
            <?php endforeach; ?>

            <?php foreach ($transport as $tn): ?>
                <div class="row custom_margin">
                    <a href="<?php echo site_url_tr('transport/show') . '/' . $tn['transport_id']; ?>"><?php echo mb_convert_case($tn[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8'); ?></a>
                    <p>Details : <?php echo $tn['notification_msg']; ?></p>
                </div>
            <?php endforeach; ?>

            <?php foreach ($notifications as $rn): ?>
                <div class="row custom_margin">
                    <p>Details : <?php echo $rn['notification_msg']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
