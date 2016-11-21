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
        <div class="box-body">
            <div class="row">
                <div class="col-xs-10 col-md-3">
                    <select name="fd" class="selectpicker districts" data-width="100%" data-thana="ft" data-live-search="true">
                        <?php foreach ($districts as $d): ?>
                            <option value="<?php echo $d['id']; ?>" <?php
                            echo $prev_route['from_district'] == $d['id'] ? 'selected="yes"' : '';
                            ?>>
                                        <?php echo $d[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-xs-10 col-md-3">
                    <div data-toggle="tooltip" data-placement="top" title="<?php echo lang('dhaka_message'); ?>" class="form-group">
                        <select id="ft" name="ft" class="selectpicker" data-width="100%" data-live-search="true" >
                            <?php foreach ($fthanas as $t): ?>
                                <option  value="<?php echo $t['id']; ?>" <?php
                                echo $prev_route['to_thana'] == $t['id'] ? 'selected="yes"' : '';
                                ?>>

                                    <?php echo $t[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-xs-10 col-md-5">
                    <input maxlength="200" type="text" class="form-control search_place" name="f" value="<?php echo $prev_route['from_place']; ?>" placeholder="<?php echo lang('device_from'); ?>">
                    <div id="suggestion" class="list-group">

                    </div>
                </div>
            </div>
            <?php echo form_error('from_place', '<div class="alert alert-danger">', '</div>'); ?>

            <div class="row">
                <div class="col-xs-10 col-md-3">
                    <select name="td" class="selectpicker districts" data-thana="th" data-width="100%" data-live-search="true">
                        <?php foreach ($districts as $d): ?>
                            <option  value="<?php echo $d['id']; ?>" <?php
                            echo $prev_route['to_district'] == $d['id'] ? 'selected="yes"' : '';
                            ?>>

                                <?php echo $d[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-xs-10 col-md-3">
                    <div data-toggle="tooltip" data-placement="top" title="<?php echo lang('dhaka_message'); ?>" class="form-group">
                        <select id="th" name="th" class="selectpicker" data-width="100%" data-live-search="true">
                            <?php foreach ($tthanas as $tt): ?>
                                <option  value="<?php echo $tt['id']; ?>" <?php echo $prev_route['to_thana'] == $tt['id'] ? 'selected="yes"' : ''; ?>>
                                    <?php echo $tt[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-xs-10 col-md-5">
                    <input maxlength="200" type="text" class="form-control search_place" name="t" value="<?php echo $prev_route['to_place']; ?>" placeholder="<?php echo lang('device_to'); ?>">
                    <div id="suggestion_to" class="list-group">

                    </div>
                </div>
            </div>
            <?php echo form_error('to_place', '<div class="alert alert-danger">', '</div>'); ?>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('main_rent'); ?> <span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                <div class="col-xs-10 col-md-6">
                    <input id="main_rent" maxlength="10" type="text" class="form-control rent" name="main_rent" value="<?php echo $prev_route['rent']; ?>" placeholder="<?php echo lang('rent_placeholder'); ?>" required title="কমপক্ষে আনুমানিক ভাড়া দিন">
                </div>
            </div>

            <?php echo form_error('main_rent', '<div class="alert alert-danger">', '</div>'); ?>

            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('transport_type'); ?></label>
                <div class="col-xs-10 col-md-6">
                    <select id="vehicle_type" name="transport_type" class="selectpicker" data-width="100%">
                        <option value="<?php echo lang('bus'); ?>" <?php echo $prev_route['transport_type'] == lang('bus') ? 'selected="yes"' : ''; ?>><?php echo lang('bus'); ?></option>
                        <option value="<?php echo lang('train'); ?>" <?php echo $prev_route['transport_type'] == lang('train') ? 'selected="yes"' : ''; ?>><?php echo lang('train'); ?></option>
                        <option value="<?php echo lang('leguna'); ?>" <?php echo $prev_route['transport_type'] == lang('leguna') ? 'selected="yes"' : ''; ?>><?php echo lang('leguna'); ?></option>
                        <option value="<?php echo lang('biman'); ?>" <?php echo $prev_route['transport_type'] == lang('biman') ? 'selected="yes"' : ''; ?>><?php echo lang('biman'); ?></option>
                        <option value="<?php echo lang('others'); ?>" <?php echo $prev_route['transport_type'] == lang('others') ? 'selected="yes"' : ''; ?>><?php echo lang('others'); ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('vehicle_name'); ?></label>
                <div class="col-xs-10 col-md-6">
                    <input id="vehicle_name" maxlength="200" type="text" class="form-control" name="vehicle_name" value="<?php echo $prev_route[$this->nl->lang_based_data('bn_name', 'name')]; ?>" placeholder="<?php echo lang('vehicle_placeholder'); ?>">
                </div>
            </div>

            <div id="departure_perticular" class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('departure_time'); ?></label>
                <div  class="col-xs-10 col-md-6">
                    <select id="departure_time" name="departure_time" class="selectpicker" data-width="100%">
                        <option value="<?php echo lang('after_while'); ?>" <?php echo $prev_route['departure_time'] == lang('after_while') ? 'selected="yes"' : ''; ?>><?php echo lang('after_while'); ?></option>
                        <option value="perticular" <?php echo $prev_route['departure_time'] != lang('after_while') ? 'selected="yes"' : ''; ?>><?php echo lang('perticular_time'); ?></option>
                    </select>
                </div>
            </div>

            <?php if ($prev_route['departure_time'] !== 'কিছুক্ষর পরপর'): ?>
                <div id="departure_dynamic" class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-xs-10 col-md-6">
                        <input maxlength="200" type="text" class="form-control"  name="departure_dynamic" value="<?php echo $prev_route['departure_time']; ?>">
                    </div>
                </div>
            <?php endif; ?>


            <div id="stoppage_section">
                <?php
                for ($i = 0; $i < count($prev_stoppages); $i++) {
                    $k = $i + 1;
                    echo '<div class="form-group"><div class="col-xs-10 col-md-2"><input id="position_' . $k . '" maxlength="2" type="text" class="form-control order_pos" name="position[]" value="' . $prev_stoppages[$i]['position'] . '"></div><div class="col-xs-10 col-md-3"><input id="place_' . $k . '" maxlength="150" type="text" class="form-control" name="place_name[]" value="' . $prev_stoppages[$i]['place_name'] . '" placeholder="' . lang('place_name') . '"></div><div class="col-xs-10 col-md-4"><textarea id="comment_' . $k . '" maxlength="1000" class="form-control" name="comments[]"  placeholder="' . lang('comment') . '">' . $prev_stoppages[$i]['comments'] . '</textarea></div><div class="col-xs-10 col-md-2"><input id="rent_' . $k . '" maxlength="10" type="text" class="form-control rent" name="rent[]" value="' . $prev_stoppages[$i]['rent'] . '"  placeholder="' . lang('main_rent') . '"></div></div>';
                }
                ?>
            </div>


            <?php if (!empty($prev_route['evidence'])): ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('prev_file'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <a id="prev_evidence" href="<?php echo base_url('evidences') . '/' . $prev_route['evidence']; ?>"><?php echo $prev_route['evidence']; ?></a>
                    </div>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('add_file'); ?></label>
                <div class="col-xs-10 col-md-6">
                    <input type="file" class="form-control btn-info" name="evidence">
                    <span class="help-block"><?php echo lang('add_file_help'); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
