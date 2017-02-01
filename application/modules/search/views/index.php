<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="route_detail" class="col-sm-6 col-sm-push-3">
    <div class="box box-poth">
        <div class="box-header with-border">
            <?php
            if ($found_in == 'main') {
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
                ?>
                <h3><?php echo $from_place . mb_convert_case($routes[0][$this->nl->lang_based_data('thana_name_bn', 'thana_name')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($routes[0][$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8') . ' <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> ' . $to_place . mb_convert_case($routes[0][$this->nl->lang_based_data('th_thana_name_bn', 'th_thana_name')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($routes[0][$this->nl->lang_based_data('td_bn_name', 'td_name')], MB_CASE_TITLE, 'UTF-8'); ?></h3>
            <?php } else if ($found_in == 'stoppage') { ?>
                <?php echo '<h4 style="line-height:1.5">' . lang('via_route') . '</h4><span id="gfrom" class="label label-info">' . mb_convert_case($this->input->get('f', TRUE), MB_CASE_TITLE, 'UTF-8') . '</span> ' . lang('and') . ' <span id="gto" class="label label-info">' . mb_convert_case($this->input->get('t', TRUE), MB_CASE_TITLE, 'UTF-8') . '</span>'; ?>
            <?php } elseif ($found_in == 'suggestion' || $found_in == 'possible') { ?>
                <?php echo '<h4 style="line-height:1.5">' . lang($found_in) . '</h4><span id="gfrom" class="label label-info">' . mb_convert_case($this->input->get('f', TRUE), MB_CASE_TITLE, 'UTF-8') . '</span> ' . lang('and') . ' <span id="gto" class="label label-info">' . mb_convert_case($this->input->get('t', TRUE), MB_CASE_TITLE, 'UTF-8') . '</span>'; ?>
            <?php } elseif ($found_in == 'places') { ?>
                <?php echo '<h4 style="line-height:1.5">' . lang('transports_of_place') . ' [' . lang('total_route') . ' ' . $total_route . ']</h4><span class="label label-info">' . mb_convert_case($this->input->get('f', TRUE), MB_CASE_TITLE, 'UTF-8') . '</span>'; ?>
            <?php } else { ?>
                <p>Nothing Found</p>
            <?php } ?>
        </div>
        <div class="box-body">
            <?php foreach ($routes as $key => $route): ?>
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><h4 class="no-margin"><a class="details" href="<?php echo site_url_tr('routes/show/') . $route['r_id']; ?>"><?php echo $route[$this->nl->lang_based_data('bn_name', 'name')]; ?></a>&nbsp;[<?php echo mb_convert_case($route['transport_type'], MB_CASE_TITLE, 'UTF-8'); ?>] <a class="btn btn-info btn-xs" href="<?php echo site_url_tr('routes/show/') . $route['r_id']; ?>"><i class="fa fa-eye"></i> <?php echo lang('about_detail'); ?></a></h4></div>
                    <div class="panel-body">
                        <?php
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

                        <?php if ($found_in != 'main'): ?>
                            <p><?php echo lang('main_route'); ?> : <strong><?php echo preg_replace($patterns, $replacements, mb_convert_case($route[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($route[$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8') . ' <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> ' . mb_convert_case($route[$this->nl->lang_based_data('tp_bn', 'to_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($route[$this->nl->lang_based_data('td_bn_name', 'td_name')], MB_CASE_TITLE, 'UTF-8')); ?></strong></p>
                        <?php endif; ?>
                        <p><?php echo lang('guess_distance') . ' <strong>' . ($route['distance'] / 1000) . $this->nl->lang_based_data(' কি.মি', ' KM'); ?></strong></p>

                        <p><?php echo lang('via') . ' ' . preg_replace($patterns, $replacements, $route['stoppages']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="box-footer">
            <?php echo isset($links) ? $links : ''; ?>
        </div>
    </div>
</div>
