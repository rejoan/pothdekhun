<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xs-12 col-md-6">
    <?php
    $message = $this->session->flashdata('message');
    if ($message) {
        echo '<div class="alert alert-warning">' . $message . '</div>';
    }
    ?>
    <div class="box box-poth">
        <div class="box-header">
            <h4>
                <?php echo lang('direct_add') ?>
            </h4>

        </div>
        <form  class="form-horizontal" action="<?php echo site_url_tr('transports/add'); ?>" method="post" enctype="multipart/form-data">
            <div class="box-body">
                <!-- route info push form -->

                <div class="row">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('vehicle_name'); ?></label>
                        <div class="col-xs-10 col-md-6">
                            <input name="transport_name" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('bengali_name'); ?></label>
                        <div class="col-xs-10 col-md-6">
                            <input name="transport_name" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('owner_name'); ?></label>
                        <div class="col-xs-10 col-md-6">
                            <input name="owner_name" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('total_vehicles'); ?></label>
                        <div class="col-xs-10 col-md-6">
                            <input name="total_vehicle" class="form-control"/>
                        </div>
                    </div>

                    <input type="hidden" id="route_id" name="route_id" value="<?php
                    if ($this->input->post('submit')) {
                        echo set_value('route_id');
                    } elseif (isset($route['id'])) {
                        echo $route['id'];
                    }
                    ?>"/>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-xs-10 col-md-6">
                            <input type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo lang('add_button'); ?>"/>

                        </div>
                    </div>

                </div>

            </div>
        </form>
    </div>
</div>