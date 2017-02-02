<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$f_place = trim($this->input->get('f', TRUE));
$t_place = trim($this->input->get('t', TRUE));
$from_place = mb_convert_case($f_place, MB_CASE_TITLE, 'UTF-8') . ', ';
if (empty($f_place)) {
    $from_place = '';
}

$to_place = mb_convert_case($t_place, MB_CASE_TITLE, 'UTF-8') . ', ';
if (empty($t_place)) {
    $to_place = '';
}
$patterns = array();
$replacements = array();
if (!empty($f_place)) {
    $patterns[0] = '/(' . mb_convert_case($f_place, MB_CASE_TITLE, 'UTF-8') . ')/i';
    $replacements[0] = '<span class="bg-orange">&nbsp;' . mb_convert_case($f_place, MB_CASE_TITLE, 'UTF-8') . ' </span>';
}

if (!empty($t_place)) {
    $patterns[1] = '/(' . mb_convert_case($t_place, MB_CASE_TITLE, 'UTF-8') . ')/i';
    $replacements[1] = '<span class="bg-orange">&nbsp;' . mb_convert_case($t_place, MB_CASE_TITLE, 'UTF-8') . ' </span>';
}
?>
<div id="route_detail" class="col-sm-6 col-sm-push-3">
    <div class="box box-poth">
        <div class="box-header with-border">
            <h3><?php echo $from_place . mb_convert_case($ft[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($fd[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8') . ' <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> ' . $to_place . mb_convert_case($th[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($td[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8'); ?></h3>
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
        </div>
        <div class="box-footer">
            <?php echo $links; ?>
        </div>
    </div>

    <div class="box box-poth">
        <div class="box-header with-border">
            <h3>sda</h3>
        </div>
        <div class="box-body">
            <?php foreach ($stoppage_routes as $sr): ?>
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><h4 class="no-margin"><a class="details" href="<?php echo site_url_tr('routes/show/') . $sr['r_id']; ?>"><?php echo $sr[$this->nl->lang_based_data('bn_name', 'name')]; ?></a>&nbsp;[<?php echo mb_convert_case($sr['transport_type'], MB_CASE_TITLE, 'UTF-8'); ?>] <a class="btn btn-info btn-xs" href="<?php echo site_url_tr('routes/show/') . $route['r_id']; ?>"><i class="fa fa-eye"></i> <?php echo lang('about_detail'); ?></a></h4></div>
                    <div class="panel-body">
                        <p><?php echo lang('main_route'); ?> : <strong><?php echo preg_replace($patterns, $replacements, mb_convert_case($sr[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($sr[$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8') . ' <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> ' . mb_convert_case($sr[$this->nl->lang_based_data('tp_bn', 'to_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($sr[$this->nl->lang_based_data('td_bn_name', 'td_name')], MB_CASE_TITLE, 'UTF-8')); ?></strong></p>

                        <p><?php echo lang('guess_distance') . ' <strong>' . ($sr['distance'] / 1000) . $this->nl->lang_based_data(' কি.মি', ' KM'); ?></strong></p>

                        <p><?php echo lang('via') . ' ' . preg_replace($patterns, $replacements, $sr['stoppages']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


</div>
