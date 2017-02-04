<?php
//var_dump(count($stoppage_routes));
defined('BASEPATH') OR exit('No direct script access allowed');
$place = trim($this->input->get('f', TRUE));
$district_name = ', ' . mb_convert_case($d[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8');

if (empty($place)) {
    $district_name = mb_convert_case($d[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8');
}

$patterns = array();
$replacements = array();
if (!empty($place)) {
    $patterns[0] = '/(' . mb_convert_case($place, MB_CASE_TITLE, 'UTF-8') . ')/i';
    $replacements[0] = '<span class="bg-orange">&nbsp;' . mb_convert_case($place, MB_CASE_TITLE, 'UTF-8') . ' </span>';
}
?>
<div id="route_detail" class="col-sm-6 col-sm-push-3">
    <div class="box box-poth">
        <div class="box-header with-border">
            <h3 class="custom_margin"><?php echo $place . $district_name; ?></h3>
        </div>
        <div class="box-body">
            <?php foreach ($routes as $route): ?>
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><h4 class="no-margin"><a class="details" href="<?php echo site_url_tr('routes/show/') . $route['r_id']; ?>"><?php echo $route[$this->nl->lang_based_data('bn_name', 'name')]; ?></a>&nbsp;[<?php echo mb_convert_case($route['transport_type'], MB_CASE_TITLE, 'UTF-8'); ?>] <a class="btn btn-info btn-xs" href="<?php echo site_url_tr('routes/show/') . $route['r_id']; ?>"><i class="fa fa-eye"></i> <?php echo lang('about_detail'); ?></a></h4></div>
                    <div class="panel-body">
                        <p><?php echo lang('guess_distance') . ' <strong>' . ($route['distance'] / 1000) . $this->nl->lang_based_data(' কি.মি', ' KM'); ?></strong></p>

                        <p><?php echo lang('via') . ' ' . preg_replace($patterns, $replacements, $route['stoppages']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php
            if (empty($routes)) {
                echo '<p>' . lang('no_direct_route') . '</p>';
            }
            ?>
        </div>
        <div class="box-footer">
            <?php echo $links; ?>
        </div>
    </div>
    <?php if (count($routes) < 5): ?>
        <div class="box box-poth">
            <div class="box-header with-border">
                <h4 class="custom_margin"><?php echo lang('stoppage_route'); ?></h4>
            </div>
            <div class="box-body">
                <?php foreach ($stoppage_routes as $sr): ?>
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading"><h4 class="no-margin"><a class="details" href="<?php echo site_url_tr('routes/show/') . $sr['r_id']; ?>"><?php echo $sr[$this->nl->lang_based_data('bn_name', 'name')]; ?></a>&nbsp;[<?php echo mb_convert_case($sr['transport_type'], MB_CASE_TITLE, 'UTF-8'); ?>] <a class="btn btn-info btn-xs" href="<?php echo site_url_tr('routes/show/') . $sr['r_id']; ?>"><i class="fa fa-eye"></i> <?php echo lang('about_detail'); ?></a></h4></div>
                        <div class="panel-body">
                            <p><?php echo lang('main_route'); ?> : <strong><?php echo preg_replace($patterns, $replacements, mb_convert_case($sr[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($sr[$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8') . ' <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> ' . mb_convert_case($sr[$this->nl->lang_based_data('tp_bn', 'to_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($sr[$this->nl->lang_based_data('td_bn_name', 'td_name')], MB_CASE_TITLE, 'UTF-8')); ?></strong></p>

                            <p><?php echo lang('guess_distance') . ' <strong>' . ($sr['distance'] / 1000) . $this->nl->lang_based_data(' কি.মি', ' KM'); ?></strong></p>

                            <p><?php echo lang('via') . ' ' . preg_replace($patterns, $replacements, $sr['stoppages']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php
                if (empty($stoppage_routes)) {
                    echo '<p>' . lang('no_stoppage_route_found') . '</p>';
                }
                ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (count($routes) < 2 && count($stoppage_routes) < 2): ?>
        <div class="box box-poth">
            <div class="box-header with-border">
                <h4 class="custom_margin"><?php echo lang('suggested_route'); ?></h4>
            </div>
            <div class="box-body">
                <?php foreach ($suggested_routes as $sgr): ?>
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading"><h4 class="no-margin"><a class="details" href="<?php echo site_url_tr('routes/show/') . $sgr['r_id']; ?>"><?php echo $sgr[$this->nl->lang_based_data('bn_name', 'name')]; ?></a>&nbsp;[<?php echo mb_convert_case($sgr['transport_type'], MB_CASE_TITLE, 'UTF-8'); ?>] <a class="btn btn-info btn-xs" href="<?php echo site_url_tr('routes/show/') . $sgr['r_id']; ?>"><i class="fa fa-eye"></i> <?php echo lang('about_detail'); ?></a></h4></div>
                        <div class="panel-body">
                            <p><?php echo lang('main_route'); ?> : <strong><?php echo preg_replace($patterns, $replacements, mb_convert_case($sgr[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($sgr[$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8') . ' <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> ' . mb_convert_case($sgr[$this->nl->lang_based_data('tp_bn', 'to_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($sgr[$this->nl->lang_based_data('td_bn_name', 'td_name')], MB_CASE_TITLE, 'UTF-8')); ?></strong></p>

                            <p><?php echo lang('guess_distance') . ' <strong>' . ($sgr['distance'] / 1000) . $this->nl->lang_based_data(' কি.মি', ' KM'); ?></strong></p>

                            <p><?php echo lang('via') . ' ' . preg_replace($patterns, $replacements, $sgr['stoppages']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php
                if (empty($suggested_routes)) {
                    echo '<p>' . lang('no_suggested_route_found') . '</p>';
                }
                ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if (count($routes) < 1 && count($stoppage_routes) < 1 && count($suggested_routes) < 1): ?>
        <div class="box box-poth">
            <div class="box-header with-border">
                <h4 class="custom_margin"><?php echo lang('possible_route'); ?></h4>
            </div>
            <div class="box-body">
                <?php foreach ($possible_matches as $pr): ?>
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading"><h4 class="no-margin"><a class="details" href="<?php echo site_url_tr('routes/show/') . $pr['r_id']; ?>"><?php echo $pr[$this->nl->lang_based_data('bn_name', 'name')]; ?></a>&nbsp;[<?php echo mb_convert_case($pr['transport_type'], MB_CASE_TITLE, 'UTF-8'); ?>] <a class="btn btn-info btn-xs" href="<?php echo site_url_tr('routes/show/') . $pr['r_id']; ?>"><i class="fa fa-eye"></i> <?php echo lang('about_detail'); ?></a></h4></div>
                        <div class="panel-body">
                            <p><?php echo lang('main_route'); ?> : <strong><?php echo preg_replace($patterns, $replacements, mb_convert_case($pr[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($pr[$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8') . ' <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> ' . mb_convert_case($pr[$this->nl->lang_based_data('tp_bn', 'to_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($pr[$this->nl->lang_based_data('td_bn_name', 'td_name')], MB_CASE_TITLE, 'UTF-8')); ?></strong></p>

                            <p><?php echo lang('guess_distance') . ' <strong>' . ($pr['distance'] / 1000) . $this->nl->lang_based_data(' কি.মি', ' KM'); ?></strong></p>

                            <p><?php echo lang('via') . ' ' . preg_replace($patterns, $replacements, $pr['stoppages']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php
                if (empty($possible_matches)) {
                    echo '<p>' . lang('no_possible_found') . '</p>';
                }
                ?>
            </div>
        </div>
    <?php endif; ?>

</div>
