<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="route_detail" class="col-xs-12 col-md-6">
    <div class="box box-poth">
        <div class="box-header with-border">
            <?php if (isset($routes[0][$this->nl->lang_based_data('fp_bn', 'from_place')]) && isset($routes[0][$this->nl->lang_based_data('tp_bn', 'to_place')]) && empty($found_in)) { ?>
                <h3><?php echo mb_convert_case($routes[0][$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($routes[0][$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8') . ' <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> ' . mb_convert_case($routes[0][$this->nl->lang_based_data('tp_bn', 'to_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($routes[0][$this->nl->lang_based_data('td_bn_name', 'td_name')], MB_CASE_TITLE, 'UTF-8'); ?></h3>
            <?php } else { ?>
                <?php echo '<p>'.lang('via_route').'</p><span class="label label-info">'. mb_convert_case($this->input->get('f',TRUE), MB_CASE_TITLE, 'UTF-8').'</span> '.lang('and').' <span class="label label-info">'.mb_convert_case($this->input->get('t',TRUE), MB_CASE_TITLE, 'UTF-8').'</span>';?>
            <?php } ?>
        </div>
        <div class="box-body">
            <?php foreach ($routes as $key => $route): ?>
                <div class="row">
                    <div class="col-xs-12">
                        <h3><a class="details" href="<?php echo site_url_tr('routes/show/') . $route['r_id']; ?>"><?php echo $route[$this->nl->lang_based_data('bn_name', 'name')]; ?></a>&nbsp;[<?php echo lang('main_fare') . ' ' . $route['rent'] . $this->nl->lang_based_data(' টাকা', ' Tk.'); ?>]<a class="btn btn-info" href="<?php echo site_url_tr('routes/show/') . $route['r_id']; ?>"><i class="fa fa-eye"></i> <?php echo lang('about_detail'); ?></a></h3>
                        <p><?php echo lang('guess_distance') . ' <strong>' . ($route['distance'] / 1000) . $this->nl->lang_based_data(' কি.মি', ' KM'); ?></strong></p>
                        <p><?php echo lang('via') . ' ' . $route['stoppages']; ?></p>
                        <small class="text-muted pull-right"><?php echo $this->nl->date_formation('Y-m-d H:i:s', $route['added'], $settings->db_timezone, $settings->client_timezone, 'd M, Y'); ?></small>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
