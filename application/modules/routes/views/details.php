<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="route_detail" class="col-xs-12 col-md-6">
    <div class="box box-poth">
        <div class="box-header with-border">
            <p><?php echo lang('route_info') . ':</p> <h3><span class="label label-info">' . ucfirst($route[$this->nl->lang_based_data('fp_bn', 'from_place')]) . ', '.ucfirst($route[$this->nl->lang_based_data('district_name_bn','district_name')]).'</span> ' . lang('to_view') . ' <span class="label label-info">' . ucfirst($route[$this->nl->lang_based_data('tp_bn', 'to_place')]) . ', '.ucfirst($route[$this->nl->lang_based_data('td_bn_name','td_name')]).'</span>'; ?></h3>
        </div>
        <div class="box-body">
            <p class="no-margin"><?php echo lang('transport_type'); ?></p>
            <h3 class="margin_top"><?php echo get_tr_type($route['transport_type']); ?></h3>
            <hr/>
            <p><?php echo lang('vehicle_name'); ?></p>
            <h3 class="margin_top"><?php echo ucfirst($route[$this->nl->lang_based_data('bn_name', 'name')]); ?></h3>
            <hr/>
            <p><?php echo lang('departure_place'); ?></p>
            <h3 class="margin_top"><?php echo ucfirst($route[$this->nl->lang_based_data('tp_bn', 'to_place')]); ?></h3>
            <hr/>
            <p><?php echo lang('destination_place'); ?></p>
            <h3 class="margin_top"><?php echo ucfirst($route[$this->nl->lang_based_data('fp_bn', 'from_place')]); ?></h3>
            <hr/>
            <p><?php echo lang('main_rent'); ?></p>
            <h3 class="margin_top"><?php echo $route['rent']; ?></h3>
            <hr/>
            <p><?php echo lang('departure_time'); ?></p>
            <h3 class="margin_top"><?php echo $route['departure_time'] == 1 ? lang('after_while'):$route['departure_time']; ?></h3>
            <hr/>
            <h4><?php echo lang('stoppages') .' '. lang('or') . ' '.lang('via'); ?></h4>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo lang('place_name'); ?></th>
                            <th><?php echo lang('comment'); ?></th>
                            <th><?php echo lang('main_rent'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stoppages as $s):$segment++; ?>
                            <tr>
                                <th><?php echo $segment; ?></th>
                                <td><?php echo $s['place_name']; ?></td>
                                <td><?php echo $s['comments']; ?></td>
                                <td><?php echo $s['rent']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <hr/>
            <p><?php echo lang('guess_distance'); ?></p>
            <h3 class="margin_top"><?php echo ($route['distance']/1000).' KM'; ?></h3>
            <hr/>
            <p><?php echo lang('guess_duration'); ?></p>
            <h3 class="margin_top"><?php echo $this->nl->seconds_to_time($route['duration']); ?></h3>
        </div>
        <div class="box-footer">
            <a href="javascript:void(0);" class="btn btn-info"><?php echo lang('verify_button'); ?></a>
            <a href="javascript:void(0);" class="btn btn-info"><?php echo lang('verify_button_non'); ?></a>
            <?php if($route['translation_status'] < 3):?>
             <a href="<?php echo site_url($lang_url.'routes/edit').'/'.$route['r_id'];?>" class="btn btn-info"><?php echo lang('translate'); ?></a>
             <?php endif;?>
            <hr/>
            <a href="<?php echo site_url_tr('routes/edit') . '/' . $route['r_id']; ?>" class="btn btn-block btn-info"><?php echo lang('edit_lang') . ' ' . lang('info_of'); ?></a>            <hr/>
            <?php if ($this->session->type > 1): ?>

            <?php endif; ?>
        </div>
    </div>
</div>
