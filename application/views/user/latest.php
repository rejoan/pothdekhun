<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="profile" class="col-sm-3 col-sm-pull-6">
    <div class="box box-primary box-poth">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo lang('recent_routes') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php foreach (latest_routes() as $latest): ?>
                <div class="box-title">
                    <p><a href="<?php echo site_url_tr('routes/show') . '/' . $latest['id']; ?>"><?php echo mb_convert_case($latest[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($latest[$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8') . ' ' . lang('to_view') . ' ' . $latest[$this->nl->lang_based_data('tp_bn', 'to_place')] . ', ' . $latest[$this->nl->lang_based_data('td_bn_name', 'td_name')]; ?></a></p>

<!--                    <span class="text-muted pull-right"><?php echo $this->nl->date_formation('Y-m-d H:i:s', $latest['added'], $settings->db_timezone, $settings->client_timezone, 'd M, Y'); ?></span>-->
                    <?php echo $latest[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                </div>
            <hr/>
            <?php endforeach ?>
            <a href="<?php echo site_url_tr('routes/all');?>" class="btn btn-sm btn-info"><?php echo lang('see_all_routes');?></a>
        </div>
        
    </div>
</div>