<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="route_detail" class="col-xs-12 col-md-6">
    <div class="box box-poth">
        <div class="box-header with-border">
            <?php if (isset($routes[0][$this->nl->lang_based_data('fp_bn', 'from_place')]) && isset($routes[0][$this->nl->lang_based_data('tp_bn', 'to_place')]) && $found_in == 'main') { ?>
                <h3><?php echo mb_convert_case($routes[0][$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($routes[0][$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8') . ' <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> ' . mb_convert_case($routes[0][$this->nl->lang_based_data('tp_bn', 'to_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($routes[0][$this->nl->lang_based_data('td_bn_name', 'td_name')], MB_CASE_TITLE, 'UTF-8'); ?></h3>
            <?php } else if ($found_in == 'stoppage') { ?>
                <?php echo '<p>' . lang('via_route') . '</p><span id="gfrom" class="label label-info">' . mb_convert_case($this->input->get('f', TRUE), MB_CASE_TITLE, 'UTF-8') . '</span> ' . lang('and') . ' <span id="gto" class="label label-info">' . mb_convert_case($this->input->get('t', TRUE), MB_CASE_TITLE, 'UTF-8') . '</span>'; ?>
            <?php } elseif ($found_in == 'suggestion') { ?>
                <?php echo '<p>' . lang('suggestions') . '</p><span id="gfrom" class="label label-info">' . mb_convert_case($this->input->get('f', TRUE), MB_CASE_TITLE, 'UTF-8') . '</span> ' . lang('and') . ' <span id="gto" class="label label-info">' . mb_convert_case($this->input->get('t', TRUE), MB_CASE_TITLE, 'UTF-8') . '</span>'; ?>
            <?php } elseif ($found_in == 'places') { ?>
                <?php echo '<p>' . lang('transports_of_place') . ' [' . lang('total_route') . ' ' . $total_route . ']</p><span class="label label-info">' . mb_convert_case($this->input->get('f', TRUE), MB_CASE_TITLE, 'UTF-8') . '</span>'; ?>
            <?php } else { ?>
                NOTHING FOUND
            <?php } ?>
        </div>
        <div class="box-body">
            <?php foreach ($routes as $key => $route): ?>
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><h4 class="no-margin"><a class="details" href="<?php echo site_url_tr('routes/show/') . $route['r_id']; ?>"><?php echo $route[$this->nl->lang_based_data('bn_name', 'name')]; ?></a>&nbsp;<a class="btn btn-info btn-xs" href="<?php echo site_url_tr('routes/show/') . $route['r_id']; ?>"><i class="fa fa-eye"></i> <?php echo lang('about_detail'); ?></a></h4></div>
                    <div class="panel-body">
                        <?php
                        $patterns = array();
                        $patterns[0] = '/(' . mb_convert_case($this->input->get('f', TRUE), MB_CASE_TITLE, 'UTF-8') . ')/i';
                        if ($this->input->get('t')) {
                            $patterns[1] = '/(' . mb_convert_case($this->input->get('t', TRUE), MB_CASE_TITLE, 'UTF-8') . ')/i';
                        }

                        $replacements = array();
                        $replacements[0] = '<span class="bg-orange">&nbsp;' . mb_convert_case($this->input->get('f', TRUE), MB_CASE_TITLE, 'UTF-8') . ' </span>';
                        if ($this->input->get('t')) {
                            $replacements[1] = '<span class="bg-orange">&nbsp;' . mb_convert_case($this->input->get('t', TRUE), MB_CASE_TITLE, 'UTF-8') . ' </span>';
                        }
                        ?>

                        <?php if ($found_in == 'stoppage' || $found_in == 'suggestion' || $found_in == 'places'): ?>
                            <p><?php echo lang('main_route'); ?> : <strong><?php echo preg_replace($patterns, $replacements, mb_convert_case($routes[0][$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($route[$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8') . ' <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> ' . mb_convert_case($route[$this->nl->lang_based_data('tp_bn', 'to_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($route[$this->nl->lang_based_data('td_bn_name', 'td_name')], MB_CASE_TITLE, 'UTF-8')); ?></strong></p>
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
