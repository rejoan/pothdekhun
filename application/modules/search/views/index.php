<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//var_dump($total_rows);return;
$patterns = array();
$replacements = array();
if (!empty($from_place)) {
    $patterns[0] = '/(' . mb_convert_case($from_place, MB_CASE_TITLE, 'UTF-8') . ')/i';
    $replacements[0] = '<span class="bg-orange">&nbsp;' . mb_convert_case($from_place, MB_CASE_TITLE, 'UTF-8') . ' </span>';
}

if (!empty($to_place)) {
    $patterns[1] = '/(' . mb_convert_case($to_place, MB_CASE_TITLE, 'UTF-8') . ')/i';
    $replacements[1] = '<span class="bg-orange">&nbsp;' . mb_convert_case($to_place, MB_CASE_TITLE, 'UTF-8') . ' </span>';
}
?>
<div id="route_detail" class="col-sm-6 col-sm-push-3">
    <div class="box box-poth">
        <div class="box-header with-border">
            <h3 class="custom_margin"><?php echo $from_place . $fthana . mb_convert_case($fd[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8') . ' <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> ' . $to_place . $tthana . mb_convert_case($td[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8'); ?></h3>
        </div>
        <div class="box-body">
            <?php foreach ($routes as $route): ?>
                <div class="panel panel-default">
                    <?php
                    $url_title = $route[$this->nl->lang_based_data('fp_bn', 'from_place')] . ' ' . lang('to_view') . ' ' . $route[$this->nl->lang_based_data('tp_bn', 'to_place')] . ' ' . $route[$this->nl->lang_based_data('bn_name', 'name')];
                    ?>
                    <div class="panel-heading"><h4 class="no-margin"><a class="details" href="<?php echo site_url_tr('routes/show/') . $route['r_id'] . '/' . unicode_title($url_title); ?>"><?php echo $route[$this->nl->lang_based_data('bn_name', 'name')]; ?></a>&nbsp;[<?php echo mb_convert_case($route['transport_type'], MB_CASE_TITLE, 'UTF-8'); ?>] <a class="btn btn-info btn-xs" href="<?php echo site_url_tr('routes/show/') . $route['r_id']. '/' . unicode_title($url_title); ?>"><i class="fa fa-eye"></i> <?php echo lang('about_detail'); ?></a></h4></div>
                    <div class="panel-body">
                        <p><?php echo lang('main_route'); ?> : <strong><?php echo preg_replace($patterns, $replacements, mb_convert_case($route[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($route[$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8') . ' <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> ' . mb_convert_case($route[$this->nl->lang_based_data('tp_bn', 'to_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($route[$this->nl->lang_based_data('td_bn_name', 'td_name')], MB_CASE_TITLE, 'UTF-8')); ?></strong></p>
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
        <?php if (count($routes) > 9): ?>
            <div class="box-footer">
                <?php echo $links; ?>
            </div>
        <?php endif; ?>
        <?php if (!$this->input->get('asg') && ((str_word_count($this->input->get('f')) > 1) || (str_word_count($this->input->get('t')) > 1))): ?>
        <h4 class="suggestion_title"><?php echo lang('search_instead'); ?> <a class="advanced_suggestion" href="<?php echo site_url_tr('search/routes?fd=' . $this->input->get('fd') . '&ft=' . $this->input->get('ft') . '&f=' . $density_from . '&td=' . $this->input->get('td') . '&th=' . $this->input->get('th') . '&t=' . $density_to . '&asg=1'); ?>"><?php echo '<strong>' . $density_from . '</strong> to <strong>' . $density_to . '</strong>'; ?>
                </a>
        </h4>
        <?php endif; ?>
    </div>
    <?php if (count($routes) < 5): ?>
        <div class="box box-poth">
            <div class="box-header with-border">
                <h4 class="custom_margin"><?php echo lang('stoppage_route'); ?></h4>
            </div>
            <div class="box-body">
                <?php foreach ($stoppage_routes as $sr): ?>
                    <div class="panel panel-default">
                        <?php
                        $url_title1 = $sr[$this->nl->lang_based_data('fp_bn', 'from_place')] . ' ' . lang('to_view') . ' ' . $sr[$this->nl->lang_based_data('tp_bn', 'to_place')] . ' ' . $sr[$this->nl->lang_based_data('bn_name', 'name')];
                        ?>
                        <div class="panel-heading"><h4 class="no-margin"><a class="details" href="<?php echo site_url_tr('routes/show/') . $sr['r_id'] . '/' . unicode_title($url_title1); ?>"><?php echo $sr[$this->nl->lang_based_data('bn_name', 'name')]; ?></a>&nbsp;[<?php echo mb_convert_case($sr['transport_type'], MB_CASE_TITLE, 'UTF-8'); ?>] <a class="btn btn-info btn-xs" href="<?php echo site_url_tr('routes/show/') . $sr['r_id']. '/' . unicode_title($url_title1); ?>"><i class="fa fa-eye"></i> <?php echo lang('about_detail'); ?></a></h4></div>
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
            <div class="box-footer">
                <?php echo $links; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (count($routes) < 10 && $total_rows < 10): ?>
        <div class="box box-poth">
            <div class="box-header with-border">
                <h4 class="custom_margin"><?php echo lang('suggested_route'); ?></h4>
            </div>
            <div class="box-body">
                <?php foreach ($suggested_routes as $sgr): ?>
                    <div class="panel panel-default">
                        <?php
                        $url_title2 = $sgr[$this->nl->lang_based_data('fp_bn', 'from_place')] . ' ' . lang('to_view') . ' ' . $sgr[$this->nl->lang_based_data('tp_bn', 'to_place')] . ' ' . $sgr[$this->nl->lang_based_data('bn_name', 'name')];
                        ?>
                        <div class="panel-heading"><h4 class="no-margin"><a class="details" href="<?php echo site_url_tr('routes/show/') . $sgr['r_id'] . '/' . unicode_title($url_title2); ?>"><?php echo $sgr[$this->nl->lang_based_data('bn_name', 'name')]; ?></a>&nbsp;[<?php echo mb_convert_case($sgr['transport_type'], MB_CASE_TITLE, 'UTF-8'); ?>] <a class="btn btn-info btn-xs" href="<?php echo site_url_tr('routes/show/') . $sgr['r_id']. '/' . unicode_title($url_title2); ?>"><i class="fa fa-eye"></i> <?php echo lang('about_detail'); ?></a></h4></div>
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
                        <?php
                        $url_title3 = $pr[$this->nl->lang_based_data('fp_bn', 'from_place')] . ' ' . lang('to_view') . ' ' . $pr[$this->nl->lang_based_data('tp_bn', 'to_place')] . ' ' . $pr[$this->nl->lang_based_data('bn_name', 'name')];
                        ?>
                        <div class="panel-heading"><h4 class="no-margin"><a class="details" href="<?php echo site_url_tr('routes/show/') . $pr['r_id'] . '/' . unicode_title($url_title3); ?>"><?php echo $pr[$this->nl->lang_based_data('bn_name', 'name')]; ?></a>&nbsp;[<?php echo mb_convert_case($pr['transport_type'], MB_CASE_TITLE, 'UTF-8'); ?>] <a class="btn btn-info btn-xs" href="<?php echo site_url_tr('routes/show/') . $pr['r_id']. '/' . unicode_title($url_title3); ?>"><i class="fa fa-eye"></i> <?php echo lang('about_detail'); ?></a></h4></div>
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
