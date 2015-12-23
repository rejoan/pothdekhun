<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xs-12 col-md-6">

    <div class="box box-poth">
        <div class="box-header">
            <div class="callout callout-info">
                <h4><?php echo $this->lang->line('edited_route'); ?></h4>
            </div>
            
        </div>
        <div class="box-body">
            <form class="form-horizontal" method="post" action="">
                <div class="form-group">
                    <label class="col-sm-10 col-md-3 control-label"><?php echo $this->lang->line('country'); ?></label>
                    <div class="col-xs-10 col-md-6 custom_margin">
                        <?php echo $edited_route['country']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-10 col-md-3 control-label"><?php echo $this->lang->line('from_view'); ?></label>
                    <div class="col-xs-10 col-md-6 custom_margin">
                        <?php echo $edited_route['from_place']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-10 col-md-3 control-label"><?php echo $this->lang->line('to_view'); ?></label>
                    <div class="col-xs-10 col-md-6 custom_margin">
                        <?php echo $edited_route['to_place']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-10 col-md-3 control-label"><?php echo $this->lang->line('departure_place'); ?></label>
                    <div class="col-xs-10 col-md-6 custom_margin">
                        <?php echo $edited_route['departure_place']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-10 col-md-3 control-label"><?php echo $this->lang->line('main_rent'); ?></label>
                    <div class="col-xs-10 col-md-6 custom_margin">
                        <?php echo $edited_route['rent']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-10 col-md-3 control-label"><?php echo $this->lang->line('transport_type'); ?></label>
                    <div class="col-xs-10 col-md-6 custom_margin">
                        <?php echo $edited_route['type']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-10 col-md-3 control-label"><?php echo $this->lang->line('vehicle_name'); ?></label>
                    <div class="col-xs-10 col-md-6 custom_margin">
                        <?php echo $edited_route['vehicle_name']; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
