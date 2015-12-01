<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div style="margin-top: 20px;" class="alert alert-warning">
    <h3>
        <?php if ($from_place == '' || $to_place == '') { ?>
            <?php echo $this->lang->line('direct_add') ?>
        <?php } else { ?>
            <strong><?php echo $from_place; ?></strong> <?php echo $this->lang->line('to_view') ?>  <strong><?php echo $to_place; ?></strong><?php echo $this->lang->line('indirect_add') ?>
        <?php } ?>

    </h3>
</div>
<div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
        <?php
        $message = $this->session->flashdata('message');
        if ($message) {
            echo '<div class="alert alert-info">' . $message . '</div>';
        }
        ?>
        <!-- route info push form -->
        <form id="add_route" class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $this->lang->line('country'); ?></label>
                <div class="col-xs-10 col-md-6">
                    <select name="type" class="selectpicker">
                        <?php foreach ($countries as $key => $c): ?>
                            <option value="<?php echo $c; ?>"><?php echo $c; ?></option>
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
                    <input id="main_rent" maxlength="10" type="text" class="form-control" name="main_rent" placeholder="<?php echo $this->lang->line('rent_placeholder'); ?>" required title="কমপক্ষে আনুমানিক ভাড়া দিন">
                </div>
            </div>
            <?php echo form_error('main_rent', '<div class="alert alert-danger">', '</div>'); ?>

            <div style="display: none;" id="stoppage_section">

            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label"></label>
                <div class="col-xs-10 col-md-6">
                    <a href="javascript:void(0)" id="add_stoppage" class="btn btn-success"><?php echo $this->lang->line('add_stoppage'); ?></a>
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

            <?php if (!$this->session->user_id): ?>
                <div style="display:none;" id="user_reg">
                    <div id="userInfo" class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('username'); ?></label>
                        <div class="col-xs-10 col-md-6">
                            <input id="chkUsername" maxlength="100" type="text" class="form-control" name="username" placeholder="<?php echo $this->lang->line('username'); ?>">
                        </div>

                    </div>

                    <div id="emailInfo" class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('email'); ?></label>
                        <div class="col-xs-10 col-md-6">
                            <input id="chkEmail" maxlength="100" type="email" class="form-control" name="email" placeholder="<?php echo $this->lang->line('email'); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->lang->line('password'); ?></label>
                        <div class="col-xs-10 col-md-6">
                            <input maxlength="100" type="password" class="form-control" name="password" placeholder="<?php echo $this->lang->line('password'); ?>">
                            <span class="help-block"><?php echo $this->lang->line('password_help'); ?></span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <input type="hidden" id="cancel" value="<?php echo $this->lang->line('cancel_text'); ?>"/>
            <input type="hidden" id="place_name" value="<?php echo $this->lang->line('place_name'); ?>"/>
            <input type="hidden" id="comment" value="<?php echo $this->lang->line('comment'); ?>"/>
            <input type="hidden" id="rents" value="<?php echo $this->lang->line('main_rent'); ?>"/>
             <input type="hidden" id="email_text" value="<?php echo $this->lang->line('email_text'); ?>"/>
             <input type="hidden" id="email_exist" value="<?php echo $this->lang->line('email_exist'); ?>"/>
            <input type="hidden" name="from_place" value="<?php echo $from_place; ?>"/>
            <input type="hidden" name="to_place" value="<?php echo $to_place; ?>"/>
            <input id="submit_route" type="submit" name="submit" class="btn btn-primary btn-lg btn-warning" value="<?php echo $this->lang->line('add_button'); ?>"/>
        </form>
    </div>

</div><!--/row-->
