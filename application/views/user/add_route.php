<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xs-12 col-md-6 col-md-offset-3">
    <?php
    $message = $this->session->flashdata('message');
    if ($message) {
        echo '<div class="alert alert-info">' . $message . '</div>';
    }
    ?>
    <div class="box box-poth">
        <div class="box-header">
            <div class="callout callout-info">
                <?php if ($from_place == '' || $to_place == '') { ?>
                    <?php echo $this->lang->line('direct_add') ?>
                <?php } else { ?>
                    <strong><?php echo $from_place; ?></strong> <?php echo $this->lang->line('from_view'); ?>  <strong><?php echo $to_place; ?></strong>&nbsp;<?php echo $this->lang->line('direct_add'); ?>
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
                                <option value="<?php echo $c; ?>" <?php echo $c == 'Bangladesh' ? 'selected="yes"' : ''; ?>><?php echo $c; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php if ($from_place == '' || $to_place == ''): ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ucfirst($this->lang->line('from_view')); ?> <span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                        <div class="col-xs-10 col-md-6">
                            <input maxlength="200" type="text" class="form-control" name="device_from" placeholder="<?php echo $this->lang->line('device_from'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ucfirst($this->lang->line('to_view')); ?> <span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                        <div class="col-xs-10 col-md-6">
                            <input maxlength="200" type="text" class="form-control" name="device_to" placeholder="<?php echo $this->lang->line('device_to'); ?>">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('transport_type'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <select name="type" class="selectpicker">
                            <option value="<?php echo $this->lang->line('bus'); ?>"><?php echo $this->lang->line('bus'); ?></option>
                            <option value="<?php echo $this->lang->line('train'); ?>"><?php echo $this->lang->line('train'); ?></option>
                            <option value="<?php echo $this->lang->line('leguna'); ?>"><?php echo $this->lang->line('leguna'); ?></option>
                            <option value="<?php echo $this->lang->line('biman'); ?>"><?php echo $this->lang->line('biman'); ?></option>
                            <option value="<?php echo $this->lang->line('others'); ?>"><?php echo $this->lang->line('others'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('vehicle_name'); ?><span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                    <div class="col-xs-10 col-md-6">
                        <input maxlength="200" type="text" class="form-control" name="vehicle_name" placeholder="<?php echo $this->lang->line('vehicle_placeholder'); ?>" required title="পরিবহনের নাম আবশ্যক">
                    </div>
                </div>
                <?php echo form_error('vehicle_name', '<div class="alert alert-danger">', '</div>'); ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('departure_place'); ?><span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                    <div class="col-xs-10 col-md-6">
                        <input maxlength="200" type="text" class="form-control"  name="departure_place" placeholder="<?php echo $this->lang->line('departure_placeholder'); ?>">
                    </div>
                </div>
                <?php echo form_error('departure_place', '<div class="alert alert-danger">', '</div>'); ?>

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
                        <input id="main_rent" maxlength="10" type="text" class="form-control rent" name="main_rent" placeholder="<?php echo $this->lang->line('rent_placeholder'); ?>" required title="কমপক্ষে আনুমানিক ভাড়া দিন">
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
                <input type="hidden" name="from_place" value="<?php echo $from_place; ?>"/>
                <input type="hidden" name="to_place" value="<?php echo $to_place; ?>"/>
                <input id="submit_route" type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo $this->lang->line('add_button'); ?>"/>
            </form>
        </div>

    </div>
</div>
