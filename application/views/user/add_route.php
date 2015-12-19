<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xs-12 col-md-6">
    <?php
    $message = $this->session->flashdata('message');
    if ($message) {
        echo '<div class="alert alert-info">' . $message . '</div>';
    }
    ?>
    <div class="box box-poth">
        <div class="box-header">
            <div class="callout callout-info">
                <?php if (empty($from_push) || empty($to_push)) { ?>
                    <?php echo $this->lang->line('direct_add') ?>
                <?php } else { ?>
                    <strong><?php echo $from_push; ?></strong> <?php echo $this->lang->line('from_view'); ?>  <strong><?php echo $to_push; ?></strong>&nbsp;<?php echo $this->lang->line('direct_add'); ?>
                <?php } ?>
            </div>

        </div>
        <div class="box-body">
            <!-- route info push form -->
            <form id="add_route" class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('country'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <select name="country" class="selectpicker">
                            <?php foreach ($countries as $key => $c): ?>
                                <option value="<?php echo $c; ?>" <?php
                                if (isset($route['country'])) {
                                    echo $route['country'] == $c ? 'selected="yes"' : '';
                                } else {
                                    echo $c == 'Bangladesh' ? 'selected="yes"' : '';
                                }
                                ?>><?php echo $c; ?></option>
                                    <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('from_view'); ?> <span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                    <div class="col-xs-10 col-md-6">
                        <input maxlength="200" type="text" class="form-control" name="from_place" value="<?php
                        if ($this->input->post('from_place')) {
                            echo set_value('from_place');
                        } elseif (isset($route['from_place'])) {
                            echo $route['from_place'];
                        } else {
                            echo (!empty($from_push)) ? $from_push : '';
                        }
                        ?>" placeholder="<?php echo $this->lang->line('device_from'); ?>">
                    </div>
                </div>
<?php echo form_error('from_place', '<div class="alert alert-danger">', '</div>'); ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('to_view'); ?> <span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                    <div class="col-xs-10 col-md-6">
                        <input maxlength="200" type="text" class="form-control" name="to_place" value="<?php
                        if (isset($route['to_place'])) {
                            echo $route['to_place'];
                        } else {
                            echo (!empty($to_push)) ? $to_push : set_value('to_place');
                        }
                        ?>" placeholder="<?php echo $this->lang->line('device_to'); ?>">
                    </div>
                </div>
<?php echo form_error('to_place', '<div class="alert alert-danger">', '</div>'); ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('departure_place'); ?><span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                    <div class="col-xs-10 col-md-6">
                        <input maxlength="200" type="text" class="form-control"  name="departure_place" value="<?php
                        if (isset($route['departure_place'])) {
                            echo $route['departure_place'];
                        } else {
                            echo set_value('departure_place');
                        }
                        ?>" placeholder="<?php echo $this->lang->line('departure_placeholder'); ?>">
                    </div>
                </div>
<?php echo form_error('departure_place', '<div class="alert alert-danger">', '</div>'); ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('transport_type'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <select name="type" class="selectpicker">
                            <option value="<?php echo $this->lang->line('bus'); ?>" <?php
                            if (isset($route['type'])) {
                                echo $route['type'] == $this->lang->line('bus') ? 'selected="yes"' : '';
                            } else {
                                $this->lang->line('bus') == $this->input->post('type') ? 'selected="yes"' : '';
                            }
                            ?>><?php echo $this->lang->line('bus'); ?></option>
                            <option value="<?php echo $this->lang->line('train'); ?>" <?php
                            if (isset($route['type'])) {
                                echo $route['type'] == $this->lang->line('train') ? 'selected="yes"' : '';
                            } else {
                                $this->lang->line('train') == $this->input->post('type') ? 'selected="yes"' : '';
                            }
                            ?>><?php echo $this->lang->line('train'); ?></option>
                            <option value="<?php echo $this->lang->line('leguna'); ?>" <?php
                            if (isset($route['type'])) {
                                echo $route['type'] == $this->lang->line('leguna') ? 'selected="yes"' : '';
                            } else {
                                $this->lang->line('leguna') == $this->input->post('type') ? 'selected="yes"' : '';
                            }
                            ?>><?php echo $this->lang->line('leguna'); ?></option>
                            <option value="<?php echo $this->lang->line('biman'); ?>"><?php echo $this->lang->line('biman'); ?></option>
                            <option value="<?php echo $this->lang->line('others'); ?>"><?php echo $this->lang->line('others'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('vehicle_name'); ?><span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                    <div class="col-xs-10 col-md-6">
                        <input maxlength="200" type="text" class="form-control" name="vehicle_name" value="<?php echo isset($route['vehicle_name']) ? $route['vehicle_name'] : set_value('vehicle_name'); ?>" placeholder="<?php echo $this->lang->line('vehicle_placeholder'); ?>" required title="পরিবহনের নাম আবশ্যক">
                    </div>
                </div>
<?php echo form_error('vehicle_name', '<div class="alert alert-danger">', '</div>'); ?>

                <div id="departure_perticular" class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('departure_time'); ?></label>
                    <div  class="col-xs-10 col-md-6">
                        <select id="departure_time" name="departure_time" class="selectpicker">
                            <option value="<?php echo $this->lang->line('after_while'); ?>"><?php echo $this->lang->line('after_while'); ?></option>
                            <option value="perticular"><?php echo $this->lang->line('perticular_time'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('main_rent'); ?> <span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                    <div class="col-xs-10 col-md-6">
                        <input id="main_rent" maxlength="10" type="text" class="form-control rent" name="main_rent" value="<?php echo isset($route['rent']) ? $route['rent'] : set_value('main_rent'); ?>" placeholder="<?php echo $this->lang->line('rent_placeholder'); ?>" required title="কমপক্ষে আনুমানিক ভাড়া দিন">
                    </div>
                </div>
<?php echo form_error('main_rent', '<div class="alert alert-danger">', '</div>'); ?>

                <div style="display: none;" id="stoppage_section">

                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-xs-10 col-md-6">
                        <a href="javascript:void(0)" id="add_stoppage" class="btn btn-info"><?php echo $this->lang->line('add_stoppage'); ?></a>
                        <span class="help-block"><?php echo $this->lang->line('add_stoppage_help'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('add_file'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <input type="file" class="form-control btn-info" name="evidence">
                        <span class="help-block"><?php echo $this->lang->line('add_file_help'); ?></span>
                    </div>
                </div>

                <input type="hidden" id="cancel" value="<?php echo $this->lang->line('cancel_text'); ?>"/>
                <input type="hidden" id="place_name" value="<?php echo $this->lang->line('place_name'); ?>"/>
                <input type="hidden" id="comment" value="<?php echo $this->lang->line('comment'); ?>"/>
                <input type="hidden" id="rents" value="<?php echo $this->lang->line('main_rent'); ?>"/>

                <input type="hidden" id="custom_time" value="<?php echo $this->lang->line('custom_time'); ?>"/>
                <input type="hidden" id="route_id" name="route_id" value="<?php if($this->input->post('route_id')){echo set_value('route_id');}else{ echo isset($route['id']) ? $route['id'] : '';} ?>"/>
                <input id="submit_route" type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo $this->lang->line('add_button'); ?>"/>
            </form>
        </div>
    </div>
</div>
