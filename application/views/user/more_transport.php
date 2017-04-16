<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="box box-primary box-poth">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo lang('more_transport') ?></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?php echo count($more_transports) < 1 ? lang('no_transport') : ''; ?>
        <?php
        foreach ($more_transports as $latest):
            $url_title = $latest[$this->nl->lang_based_data('fp_bn', 'from_place')] . ' ' . lang('to_view') . ' ' . $latest[$this->nl->lang_based_data('tp_bn', 'to_place')] . ' ' . $latest[$this->nl->lang_based_data('bn_name', 'name')];
            ?>
            <div class="box-title">
                <p class="no-margin"><?php echo lang('main_route'); ?> : <a href="<?php echo site_url_tr('routes/show') . '/' . $latest['r_id'].'/'. unicode_title($url_title); ?>"><?php echo mb_convert_case($latest[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($latest[$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8') . ' <span class="label bg-yellow">' . lang('to_view') . '</span> ' . $latest[$this->nl->lang_based_data('tp_bn', 'to_place')] . ', ' . $latest[$this->nl->lang_based_data('td_bn_name', 'td_name')]; ?></a></p>
                <i class="fa fa-hand-o-right"></i> <?php echo $latest[$this->nl->lang_based_data('bn_name', 'name')]; ?>
            </div>
            <hr/>
<?php endforeach ?>
        <a href="<?php echo site_url_tr('search/routes?fd=' . $route['from_district'] . '&ft=' . $route['from_thana'] . '&f=' . $route['from_place'] . '&td=' . $route['to_district'] . '&th=' . $route['to_thana'] . '&t=' . $route['to_place']); ?>" class="btn btn-sm btn-info"><i class="fa fa-space-shuttle"></i>  <?php echo lang('more_deep'); ?></a>
    </div>

</div>