<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-sm-6 col-sm-push-3">
    <div class="box box-poth">
        <div class="box-header with-border">
            <p><a href="<?php echo site_url_tr('routes/show') . '/' . $notification['route_id']; ?>"><?php echo mb_convert_case($notification[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($notification[$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8') . ' ' . lang('to_view') . ' ' . $notification[$this->nl->lang_based_data('tp_bn', 'to_place')] . ', ' . $notification[$this->nl->lang_based_data('td_bn_name', 'td_name')]; ?></a></p>
        </div>
        <div class="box-body">
            <div class="row custom_margin">
                <div class="col-xs-3">
                    <p class="no-margin"><?php echo lang('point_earned'); ?></p>
                </div>
                <div class="col-xs-6">
                    <h4 class="no-margin"><?php echo $notification['point']; ?></h4>
                </div>
            </div>
            <div class="row custom_margin">
                <div class="col-xs-3">
                    <p class="no-margin"><?php echo lang('note'); ?></p>
                </div>
                <div class="col-xs-6">
                    <h4 class="no-margin"><?php echo $notification['notification_msg']; ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>
