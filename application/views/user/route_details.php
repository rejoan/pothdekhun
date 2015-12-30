<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="route_detail" class="col-xs-12 col-md-6">
    <div class="box box-poth">
        <div class="box-header with-border">
            <h4><?php echo $this->lang->line('route_info') . ': <span class="label label-info">' . $route['from_place'] . '</span> ' . $this->lang->line('from_view') . ' <span class="label label-info">' . $route['to_place'] . '</span>'; ?></h4>
        </div>
        <div class="box-body">
            <h4><?php echo $this->lang->line('transport_type'); ?></h4>
            <strong><?php echo $route['type']; ?></strong>
            <hr/>
            <h4><?php echo $this->lang->line('vehicle_name'); ?></h4>
            <strong><?php echo $route['vehicle_name']; ?></strong>
            <hr/>
            <h4><?php echo $this->lang->line('departure_place'); ?></h4>
            <strong><?php echo $route['departure_place']; ?></strong>
            <hr/>
            <h4><?php echo $this->lang->line('main_rent'); ?></h4>
            <strong><?php echo $route['rent']; ?></strong>
            <hr/>
            <h4><?php echo $this->lang->line('departure_time'); ?></h4>
            <strong><?php echo $route['departure_time']; ?></strong>
            <hr/>
            <h4><?php echo $this->lang->line('stoppages'); ?></h4>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('place_name'); ?></th>
                            <th><?php echo $this->lang->line('comment'); ?></th>
                            <th><?php echo $this->lang->line('main_rent'); ?></th>

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
        </div>
        <div class="box-footer">
            <a href="javascript:void(0);" class="btn btn-info"><?php echo $this->lang->line('verify_button'); ?></a>
            <a href="javascript:void(0);" class="btn btn-info"><?php echo $this->lang->line('verify_button_non'); ?></a>
            <hr/>
            <a href="<?php echo site_url('route/edit').'/'.$route['id'];?>" class="btn btn-block btn-info"><?php echo $this->lang->line('edit_lang') . ' ' . $this->lang->line('info_of'); ?></a>            <hr/>
            <?php if ($this->session->type > 1): ?>
                
            <?php endif; ?>
        </div>
    </div>
</div>
