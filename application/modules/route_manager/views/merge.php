<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xs-12 col-md-6">
    <div class="box box-poth">
        <div class="box-header">
            <h4>
                Previous Route
            </h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-10 col-md-3">
                    <select name="fd" class="form-control">
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
                    <div class="form-group">
                        <select name="ft" class="form-control">
                            <?php foreach ($fthanas as $t): ?>
                                <option  value="<?php echo $t['id']; ?>" <?php
                                echo $prev_route['from_thana'] == $t['id'] ? 'selected="yes"' : '';
                                ?>>

                                    <?php echo $t[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="input-group col-xs-10 col-md-5">
                    <input maxlength="200" type="text" class="form-control" name="f" data-sentto="from_place" value="<?php echo $prev_route['from_place']; ?>">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat keep_it">Keep it</button>
                    </span>
                </div>
            </div>
            <?php echo form_error('from_place', '<div class="alert alert-danger">', '</div>'); ?>

            <div class="row">
                <div class="col-xs-10 col-md-3">
                    <select name="td" class="form-control">
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
                    <div class="form-group">
                        <select name="th" class="form-control">
                            <?php foreach ($tthanas as $tt): ?>
                                <option  value="<?php echo $tt['id']; ?>" <?php echo $prev_route['to_thana'] == $tt['id'] ? 'selected="yes"' : ''; ?>>
                                    <?php echo $tt[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-xs-10 col-md-5 input-group">
                    <input maxlength="200" type="text" class="form-control search_place" name="t" data-sentto="to_place" value="<?php echo $prev_route['to_place']; ?>"> 
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat keep_it">Keep it</button>
                    </span>
                </div>
            </div>
            <?php echo form_error('to_place', '<div class="alert alert-danger">', '</div>'); ?>
            <div class="form-group">
                <label class="control-label"><?php echo lang('main_rent'); ?></label>
                <div class="input-group">
                    <input maxlength="10" type="text" class="form-control" name="main_rent" data-sentto="main_rent" value="<?php echo $prev_route['rent']; ?>">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat keep_it">Keep it</button>
                    </span>
                </div>

            </div>

            <?php echo form_error('main_rent', '<div class="alert alert-danger">', '</div>'); ?>

            <div class="form-group">
                <label class="control-label"><?php echo lang('transport_type'); ?></label>
                <select id="vehicle_type" name="transport_type" class="form-control">
                    <option value="<?php echo lang('bus'); ?>" <?php echo $prev_route['transport_type'] == lang('bus') ? 'selected="yes"' : ''; ?>><?php echo lang('bus'); ?></option>
                    <option value="<?php echo lang('train'); ?>" <?php echo $prev_route['transport_type'] == lang('train') ? 'selected="yes"' : ''; ?>><?php echo lang('train'); ?></option>
                    <option value="<?php echo lang('leguna'); ?>" <?php echo $prev_route['transport_type'] == lang('leguna') ? 'selected="yes"' : ''; ?>><?php echo lang('leguna'); ?></option>
                    <option value="<?php echo lang('biman'); ?>" <?php echo $prev_route['transport_type'] == lang('biman') ? 'selected="yes"' : ''; ?>><?php echo lang('biman'); ?></option>
                    <option value="<?php echo lang('others'); ?>" <?php echo $prev_route['transport_type'] == lang('others') ? 'selected="yes"' : ''; ?>><?php echo lang('others'); ?></option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label"><?php echo lang('vehicle_name'); ?></label>
                <div class="input-group">
                    <input maxlength="200" type="text" class="form-control" name="vehicle_name" data-sentto="vehicle_name" value="<?php echo $prev_route[$this->nl->lang_based_data('bn_name', 'name')]; ?>">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat keep_it">Keep it</button>
                    </span>
                </div>

            </div>

            <div class="form-group">
                <label class="control-label"><?php echo lang('departure_time'); ?></label>
                <select name="departure_time" class="form-control">
                    <option value="1" <?php echo $prev_route['departure_time'] == 1 ? 'selected="yes"' : ''; ?>><?php echo lang('after_while'); ?></option>
                    <option value="2" <?php echo $prev_route['departure_time'] != 1 ? 'selected="yes"' : ''; ?>><?php echo lang('perticular_time'); ?></option>
                </select>
            </div>

            <?php if ($prev_route['departure_time'] != 1): ?>
                <div class="form-group">
                    <label class="control-label"></label>
                    <div class="input-group">
                        <textarea class="form-control" name="departure_dynamic" data-sentto="departure"><?php echo $prev_route['departure_time']; ?></textarea>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-info btn-flat keep_it">Keep it</button>
                        </span>
                    </div>

                </div>
            <?php endif; ?>


            <div class="stoppages">
                <?php
                for ($i = 0; $i < count($prev_stoppages); $i++) {
                    $k = $i + 1;
                    echo '<div id="stoppage_' . $k . '" class="form-group"><div class="col-xs-10 col-md-4"><input maxlength="150" type="text" class="form-control place" name="place_name[]" value="' . $prev_stoppages[$i]['place_name'] . '"></div><div class="col-xs-10 col-md-4"><textarea maxlength="1000" class="form-control comment" name="comments[]">' . $prev_stoppages[$i]['comments'] . '</textarea></div><div class="col-xs-10 col-md-2"><input maxlength="10" type="text" class="form-control rent" name="rent[]" value="' . $prev_stoppages[$i]['rent'] . '" ></div><button data-stp_id="' . $k . '" class="btn btn-xs btn-info keep_stoppage" href="javascript:void(0)" class="cancel"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button></div>';
                }
                ?>
            </div>

            <div class="form-group">
                <label class="control-label"><?php echo lang('prev_file'); ?></label>
                <?php echo $prev_route['evidence']; ?>
                <button id="keep_file" data-file_name="<?php echo $prev_route['evidence']; ?>" class="btn btn-info">Keep File</button>
            </div>
            <div class="form-group">
                <label class="control-label"><?php echo lang('prev_file'); ?></label>
                <?php echo $prev_route['evidence2']; ?>
                <button id="keep_file2" data-file_name="<?php echo $prev_route['evidence2']; ?>" class="btn btn-info">Keep File</button>
            </div>
        </div>
    </div>
</div>

<!--suggested or edited route STARTED -->
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <div class="col-xs-12 col-md-6">
        <div class="box box-poth">
            <div class="box-header">
                <h4>
                    Suggested/Edited Route
                </h4>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class="col-xs-10 col-md-3">
                        <select name="fd" class="form-control districts">
                            <?php foreach ($districts as $d): ?>
                                <option value="<?php echo $d['id']; ?>" <?php
                                echo $edited_route['from_district'] == $d['id'] ? 'selected="yes"' : '';
                                ?>>
                                            <?php echo $d[$this->nl->lang_based_data('bn_name', 'name')]; ?>

                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-xs-10 col-md-3">
                        <div data-toggle="tooltip" data-placement="top" title="<?php echo lang('dhaka_message'); ?>" class="form-group">
                            <select id="ft" name="ft" class="form-control">
                                <?php foreach ($fthanas as $t): ?>
                                    <option  value="<?php echo $t['id']; ?>" <?php
                                    echo $edited_route['to_thana'] == $t['id'] ? 'selected="yes"' : '';
                                    ?>>

                                        <?php echo $t[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-10 col-md-5">
                        <input id="from_place" maxlength="200" type="text" class="form-control search_place" name="f" value="<?php echo $edited_route['from_place']; ?>" placeholder="<?php echo lang('device_from'); ?>">
                        <div id="suggestion" class="list-group">

                        </div>
                    </div>
                </div>
                <?php echo form_error('from_place', '<div class="alert alert-danger">', '</div>'); ?>

                <div class="row">
                    <div class="col-xs-10 col-md-3">
                        <select name="td" class="form-control districts">
                            <?php foreach ($districts as $d): ?>
                                <option  value="<?php echo $d['id']; ?>" <?php
                                echo $edited_route['to_district'] == $d['id'] ? 'selected="yes"' : '';
                                ?>>

                                    <?php echo $d[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-xs-10 col-md-3">
                        <div data-toggle="tooltip" data-placement="top" title="<?php echo lang('dhaka_message'); ?>" class="form-group">
                            <select id="th" name="th" class="form-control">
                                <?php foreach ($tthanas as $tt): ?>
                                    <option  value="<?php echo $tt['id']; ?>" <?php echo $edited_route['to_thana'] == $tt['id'] ? 'selected="yes"' : ''; ?>>
                                        <?php echo $tt[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-10 col-md-5">
                        <input id="to_place" maxlength="200" type="text" class="form-control search_place" name="t" value="<?php echo $edited_route['to_place']; ?>">
                        <div id="suggestion_to" class="list-group">

                        </div>
                    </div>
                </div>
                <?php echo form_error('to_place', '<div class="alert alert-danger">', '</div>'); ?>
                <div class="form-group">
                    <label class="control-label"><?php echo lang('main_rent'); ?> <span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                    <input id="main_rent" maxlength="10" type="text" class="form-control rent" name="main_rent" value="<?php echo $edited_route['rent']; ?>" placeholder="<?php echo lang('rent_placeholder'); ?>" required title="কমপক্ষে আনুমানিক ভাড়া দিন">
                </div>

                <?php echo form_error('main_rent', '<div class="alert alert-danger">', '</div>'); ?>

                <div class="form-group">
                    <label class="control-label"><?php echo lang('transport_type'); ?></label>
                    <select id="vehicle_type" name="transport_type" class="form-control">
                        <option value="bus" <?php echo $edited_route['transport_type'] == 'bus' ? 'selected="yes"' : ''; ?>><?php echo lang('bus'); ?></option>
                        <option value="train" <?php echo $edited_route['transport_type'] == 'train' ? 'selected="yes"' : ''; ?>><?php echo lang('train'); ?></option>
                        <option value="leguna" <?php echo $edited_route['transport_type'] == 'leguna' ? 'selected="yes"' : ''; ?>><?php echo lang('leguna'); ?></option>
                        <option value="biman" <?php echo $edited_route['transport_type'] == 'biman' ? 'selected="yes"' : ''; ?>><?php echo lang('biman'); ?></option>
                        <option value="others" <?php echo $edited_route['transport_type'] == 'others' ? 'selected="yes"' : ''; ?>><?php echo lang('others'); ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label"><?php echo lang('vehicle_name'); ?></label>
                    <input id="vehicle_name" maxlength="200" type="text" class="form-control" name="vehicle_name" value="<?php echo $edited_route[$this->nl->lang_based_data('bn_name', 'name', FALSE, $edited_route['lang_code'])]; ?>" placeholder="<?php echo lang('vehicle_placeholder'); ?>">
                </div>

                <div id="departure_perticular" class="form-group">
                    <label class="control-label"><?php echo lang('departure_time'); ?></label>
                    <select id="departure_time" name="departure_time" class="form-control">
                        <option value="1" <?php echo $edited_route['departure_time'] == 1 ? 'selected="yes"' : ''; ?>><?php echo lang('after_while'); ?></option>
                        <option value="2" <?php echo $edited_route['departure_time'] != 1 ? 'selected="yes"' : ''; ?>><?php echo lang('perticular_time'); ?></option>
                    </select>
                </div>

                <?php if ($edited_route['departure_time'] != 1): ?>
                    <div id="departure_dynamic" class="form-group">
                        <label class="control-label"></label>
                        <textarea id="departure" class="form-control"  name="departure_dynamic"><?php echo $edited_route['departure_time']; ?></textarea>

                    </div>
                <?php endif; ?>


                <div id="stoppage_section" class="stoppages">
                    <?php
                    for ($e = 0; $e < count($edited_stoppages); $e++) {
                        $m = $e + 1;
                        echo '<div class="form-group"><div class="col-xs-10 col-md-4"><input id="place_' . $m . '" maxlength="150" type="text" class="form-control place_name" name="place_name[]" value="' . $edited_stoppages[$e]['place_name'] . '" placeholder="' . lang('place_name') . '"></div><div class="col-xs-10 col-md-4"><textarea id="comment_' . $m . '" maxlength="1000" class="form-control" name="comments[]"  placeholder="' . lang('comment') . '">' . $edited_stoppages[$e]['comments'] . '</textarea></div><div class="col-xs-10 col-md-2"><input id="rent_' . $m . '" maxlength="10" type="text" class="form-control rent" name="rent[]" value="' . $edited_stoppages[$e]['rent'] . '"  placeholder="' . lang('main_rent') . '"></div><button class="btn btn-xs btn-danger" href="javascript:void(0)" class="cancel"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></div>';
                    }
                    ?>
                </div>

                <div class="form-group">
                    <label class="control-label"></label>
                    <a href="javascript:void(0)" id="add_stoppage" class="btn btn-info"><?php echo lang('add_stoppage'); ?></a>
                    <span class="help-block"><?php echo lang('add_stoppage_help'); ?></span>
                </div>
                <div class="form-group">
                    <label class="control-label">File</label>
                    <?php
                    if (empty($edited_route['evidence'])) {
                        $file = 'No file';
                        $href = 'javascript:void();';
                    } else {
                        $file = $edited_route['evidence'];
                        $href = base_url('evidences/') . $edited_route['evidence'];
                    }
                    ?>
                    <a id="edited_file" href="<?php echo $href; ?>"><?php echo $file; ?></a>
                    <button data-file_name="<?php echo $edited_route['evidence']; ?>" data-hidden_id="pd_pthmnx" class="btn btn-xs btn-danger remove_file" href="javascript:void(0)"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                </div>

                <div class="form-group">
                    <label class="control-label">File</label>
                    <?php
                    if (empty($edited_route['evidence2'])) {
                        $file = 'No file';
                        $href = 'javascript:void();';
                    } else {
                        $file = $edited_route['evidence2'];
                        $href = base_url('evidences/') . $edited_route['evidence2'];
                    }
                    ?>
                    <a id="edited_file2" href="<?php echo $href; ?>"><?php echo $file; ?></a>
                    <button data-file_name="<?php echo $edited_route['evidence2']; ?>" data-hidden_id="pd_pthmnx" class="btn btn-xs btn-danger remove_file" href="javascript:void(0)"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                </div>

                <?php
                if (isset($route['amenities'])) {
                    $amenities = explode(',', $route['amenities']);
                }
                ?>
                <div class="form-group">
                    <div id="ac_nonac" class="col-md-12">
                        <label class="radio-inline">
                            <input type="radio" name="ac_non" value="ac" <?php
                            if (isset($amenities)) {
                                echo in_array('ac', $amenities) ? 'checked="yes"' : '';
                            }
                            ?>> <?php echo lang('ac'); ?>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="ac_non" value="non_ac" <?php
                            if (isset($amenities)) {
                                echo in_array('nac', $amenities) ? 'checked="yes"' : '';
                            }
                            ?>> <?php echo lang('nac'); ?>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="ac_non" value="acunknown" <?php
                            if (isset($amenities)) {
                                echo in_array('acunknown', $amenities) ? 'checked="yes"' : '';
                            } else {
                                echo 'checked="yes"';
                            }
                            ?>> <?php echo lang('unknown'); ?>
                        </label>
                    </div>
                    <div id="ac_type" class="col-md-12" style="display:<?php
                    if (isset($amenities)) {
                        echo in_array('ac', $amenities) ? '' : 'none;';
                    } else {
                        echo 'none;';
                    }
                    ?>">
                        <div class="col-md-12">
                            <label class="radio-inline">
                                <input type="radio" name="ac_type" value="normal_ac" <?php
                                if (isset($amenities)) {
                                    echo in_array('normal_ac', $amenities) ? 'checked="yes"' : '';
                                } else {
                                    echo 'checked="yes"';
                                }
                                ?>> <?php echo lang('normal'); ?>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="ac_type" value="scania" <?php
                                if (isset($amenities)) {
                                    echo in_array('scania', $amenities) ? 'checked="yes"' : '';
                                }
                                ?>> <?php echo lang('scania'); ?>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="ac_type" value="hyundai" <?php
                                if (isset($amenities)) {
                                    echo in_array('hyundai', $amenities) ? 'checked="yes"' : '';
                                }
                                ?>> <?php echo lang('hyundai'); ?>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="ac_type" value="rm2" <?php
                                if (isset($amenities)) {
                                    echo in_array('rm2', $amenities) ? 'checked="yes"' : '';
                                }
                                ?>> <?php echo lang('rm2'); ?>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="ac_type" value="hino_1j" <?php
                                if (isset($amenities)) {
                                    echo in_array('hino_1j', $amenities) ? 'checked="yes"' : '';
                                }
                                ?>> <?php echo lang('hino_1j'); ?>
                            </label>
                            <label class="radio-inline custom_pad_left">
                                <input type="radio" name="ac_type" value="mercedes_benz" <?php
                                if (isset($amenities)) {
                                    echo in_array('mercedes_benz', $amenities) ? 'checked="yes"' : '';
                                }
                                ?>> <?php echo lang('mercedes_benz'); ?>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <label class="radio-inline">
                            <input type="radio" name="mail_local" value="local" <?php
                            if (isset($amenities)) {
                                echo in_array('local', $amenities) ? 'checked="yes"' : '';
                            }
                            ?>> <?php echo lang('local'); ?>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="mail_local" value="gate_lock" <?php
                            if (isset($amenities)) {
                                echo in_array('gate_lock', $amenities) ? 'checked="yes"' : '';
                            }
                            ?>> <?php echo lang('gatelock'); ?>
                        </label>
                        <label class="radio-inline">
                            <?php $target = array('local', 'gate_lock'); ?>
                            <input type="radio" name="mail_local" value="unknown" <?php
                            if (isset($amenities)) {
                                echo count(array_intersect($amenities, $target)) > 0 ? '' : 'checked="yes"';
                            } else {
                                echo 'checked="yes"';
                            }
                            ?>> <?php echo lang('unknown'); ?>
                        </label>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-12">
                        <label class="radio-inline">
                            <input type="radio" name="chair_semi" value="chair" <?php
                            if (isset($amenities)) {
                                echo in_array('chair', $amenities) ? 'checked="yes"' : '';
                            }
                            ?>> <?php echo lang('chair'); ?>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="chair_semi" value="semi" <?php
                            if (isset($amenities)) {
                                echo in_array('semi', $amenities) ? 'checked="yes"' : '';
                            }
                            ?>> <?php echo lang('semi'); ?>
                        </label>
                        <label class="radio-inline">
                            <?php $target2 = array('chair', 'semi'); ?>
                            <input type="radio" name="chair_semi" value="unknown" <?php
                            if (isset($amenities)) {
                                echo count(array_intersect($amenities, $target2)) > 0 ? '' : 'checked="yes"';
                            } else {
                                echo 'checked="yes"';
                            }
                            ?>> <?php echo lang('unknown'); ?>
                        </label>
                    </div>
                </div>

                <input type="hidden" id="cancel" value="<?php echo lang('cancel_text'); ?>"/>
                <input type="hidden" id="place_name" value="<?php echo lang('place_name'); ?>"/>
                <input type="hidden" id="comment" value="<?php echo lang('comment'); ?>"/>
                <input type="hidden" id="rents" value="<?php echo lang('main_rent'); ?>"/>
                <input type="hidden" id="custom_time" value="<?php echo lang('custom_time'); ?>"/>
                <input id="route_id" type="hidden" name="route_id" value="<?php echo $this->uri->segment(3); ?>"/>
                <input id="pd_pthm" type="hidden"  name="edited_file" value="<?php echo $edited_route['evidence']; ?>"/>
                <input id="pd_pthmnx" type="hidden"  name="edited_file2" value="<?php echo $edited_route['evidence2']; ?>"/>

                <input type="hidden"  name="janba" value="<?php echo $this->encryption->encrypt($edited_route['poribohon_id']); ?>"/>

                <div class="form-group">
                    <label class="control-label">Point</label>
                    <input id="point" type="text" class="form-control" name="point" value="<?php echo $point; ?>">

                </div>
                <div class="form-group">
                    <label class="control-label">Note</label>
                    <textarea class="form-control" name="note"></textarea>
                </div>

                <input type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="Approve"/>
                <a href="<?php echo site_url_tr('route_manager/decline/') . $this->uri->segment(3); ?>" class="btn btn-primary btn-lg btn-danger">Decline</a>
            </div>

        </div>
    </div>
</form>

<style>
    .stoppages .form-group{
        overflow:hidden;
    }
</style>
<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script>
    $(document).ready(function () {
        var base_url = $('#base_url').val();
        $('.keep_it').click(function () {
            var item = $.trim($(this).parent().prev().val());
            var sent_id = $.trim($(this).parent().prev().data('sentto'));
            $('#' + sent_id).val(item);
        });
        $('#ac_nonac input[type="radio"]').click(function () {
            if ($(this).val() == 'ac') {
                $('#ac_type').slideDown();
            } else {
                $('#ac_type').slideUp();
            }

        });

        $('#keep_file').click(function (e) {
            e.preventDefault();
            var file_name = $.trim($(this).data('file_name'));
            if (file_name == '') {
                swal('', 'No File', 'warning');
            }
            $('input[name="edited_file"]').val(file_name);
            $('#edited_file').text(file_name);
            $('#edited_file').prop('href', base_url + 'evidences/' + file_name);
        });
        $('#keep_file2').click(function (e) {
            e.preventDefault();
            var file_name = $.trim($(this).data('file_name'));
            if (file_name == '') {
                swal('', 'No File', 'warning');
            }
            $('input[name="edited_file2"]').val(file_name);
            $('#edited_file2').text(file_name);
            $('#edited_file2').prop('href', base_url + 'evidences/' + file_name);
        });
        $('.keep_stoppage').on('click', function () {
            var stp_id = $(this).data('stp_id');
            var place = $('#stoppage_' + stp_id + ' .place').val();
            var comment = $('#stoppage_' + stp_id + ' .comment').val();
            var rent = $('#stoppage_' + stp_id + ' .rent').val();
            $('#place_' + stp_id).val(place);
            $('#comment_' + stp_id).val(comment);
            $('#rent_' + stp_id).val(rent);
        });
        $('.remove_file').click(function (e) {
            e.preventDefault();
            var name = $(this).data('file_name');
            var hidden_id = $(this).data('hidden_id');
            var pd_stu = $('#pd_stu').val();
            $.ajax({
                context: this,
                url: pd_stu + 'route_manager/delete_file',
                type: 'POST',
                dataType: 'json',
                cache: true,
                data: {
                    file: name
                }
            }).done(function (response) {
                if (response.deleted == 'done') {
                    $(this).prev().text('');
                    $(this).prev().attr('href', '');
                    $('#' + hidden_id).val('');
                    var point = parseInt($('#point').val());
                    var new_pint = point - 5;
                    $('#point').val(new_pint);
                }
            });
        });
    });
</script>