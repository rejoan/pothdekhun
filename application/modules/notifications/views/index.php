<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xs-12 col-md-6">
    <div class="box box-poth">
        <div class="box-header with-border">
            <p></p>
        </div>
        <div class="box-body">
            <?php foreach ($notifications as $n): ?>
                <div class="row custom_margin">
                    <a href="<?php echo site_url_tr('routes/show') . '/' . $n['route_id']; ?>"><?php echo mb_convert_case($n[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($n[$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8') . ' ' . lang('to_view') . ' ' . $n[$this->nl->lang_based_data('tp_bn', 'to_place')] . ', ' . $n[$this->nl->lang_based_data('td_bn_name', 'td_name')]; ?></a>
                    <h4 class="no-margin"><?php echo $n['point']; ?></h4>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
