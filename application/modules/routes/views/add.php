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

            <?php if (strpos(current_url(), 'edit')): ?>
                <?php
                $text_lang = $this->session->lang_name == 'bengali' ? lang('english') : lang('bangla');
                $lang_code = $this->session->lang_name == 'bengali' ? 'en' : 'bn';
                echo lang('edit_lang') . ' ';
                echo '<a class="btn btn-sm btn-info" href="' . current_url_tr($lang_code) . '">' . $text_lang . '</a>';
                echo ' ' . lang('info_of');
                ?>
            <?php endif; ?>

        </div>
        <div class="box-body">
            <!-- route info push form -->
            <form id="add_route" class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-10 col-md-3">
                        <select name="fd" class="selectpicker districts" data-width="100%" data-thana="ft" data-live-search="true">
                            <?php foreach ($districts as $d): ?>
                                <option value="<?php echo $d['id']; ?>" <?php
                                if ($this->input->post('fd')) {
                                    echo $this->input->post('fd') == $d['id'] ? 'selected="yes"' : '';
                                } elseif (isset($route['from_district'])) {
                                    echo $route['from_district'] == $d['id'] ? 'selected="yes"' : '';
                                } else {
                                    echo $d['id'] == '1' ? 'selected="yes"' : '';
                                }
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
                                    if ($this->input->post('ft')) {
                                        echo $this->input->post('ft') == $t['id'] ? 'selected="yes"' : '';
                                    } elseif (isset($route['from_thana'])) {
                                        echo $route['from_thana'] == $t['id'] ? 'selected="yes"' : '';
                                    } else {
                                        echo $t['id'] == '493' ? 'selected="yes"' : '';
                                    }
                                    ?>>

                                        <?php echo $t[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-10 col-md-5">
                        <input maxlength="200" type="text" class="form-control search_place" name="f" value="<?php
                        if ($this->input->post('submit')) {
                            echo set_value('f');
                        } elseif (isset($route['from_place'])) {
                            echo $route['from_place'];
                        } elseif ($this->input->post('f')) {
                            echo $this->input->post('f');
                        }
                        ?>" placeholder="<?php echo lang('device_from'); ?>">
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
                                if (isset($route['to_district'])) {
                                    echo $route['to_district'] == $d['id'] ? 'selected="yes"' : '';
                                } elseif (isset($route['to_district'])) {
                                    echo $route['to_district'] == $d['id'] ? 'selected="yes"' : '';
                                } else {
                                    echo $d['id'] == '1' ? 'selected="yes"' : '';
                                }
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
                                    <option  value="<?php echo $tt['id']; ?>" <?php
                                    if ($this->input->post('th')) {
                                        echo $this->input->post('th') == $tt['id'] ? 'selected="yes"' : '';
                                    } elseif (isset($route['to_thana'])) {
                                        echo $route['to_thana'] == $tt['id'] ? 'selected="yes"' : '';
                                    } else {
                                        echo $tt['id'] == '509' ? 'selected="yes"' : '';
                                    }
                                    ?>>
                                                 <?php echo $tt[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-10 col-md-5">
                        <input maxlength="200" type="text" class="form-control search_place" name="t" value="<?php
                        if ($this->input->post('submit')) {
                            echo set_value('t');
                        } elseif (isset($route['to_place'])) {
                            echo $route['to_place'];
                        } elseif ($this->input->post('t')) {
                            echo $this->input->post('t');
                        }
                        ?>" placeholder="<?php echo lang('device_to'); ?>">
                        <div id="suggestion_to" class="list-group">

                        </div>
                    </div>
                </div>
                <?php echo form_error('to_place', '<div class="alert alert-danger">', '</div>'); ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('main_rent'); ?> <span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                    <div class="col-xs-10 col-md-6">
                        <input id="main_rent" maxlength="10" type="text" class="form-control rent" name="main_rent" value="<?php
                        if ($this->input->post('submit')) {
                            echo set_value('main_rent');
                        } elseif (isset($route['rent'])) {
                            echo $route['rent'];
                        }
                        ?>" placeholder="<?php echo lang('rent_placeholder'); ?>" required title="কমপক্ষে আনুমানিক ভাড়া দিন">
                    </div>
                </div>

                <?php echo form_error('main_rent', '<div class="alert alert-danger">', '</div>'); ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('transport_type'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <select id="vehicle_type" name="transport_type" class="selectpicker" data-width="100%">
                            <option value="<?php echo lang('bus'); ?>" <?php
                            if ($this->input->post('submit')) {
                                echo lang('bus') == $this->input->post('type') ? 'selected="yes"' : '';
                            } elseif (isset($route['type'])) {
                                echo $route['type'] == lang('bus') ? 'selected="yes"' : '';
                            }
                            ?>><?php echo lang('bus'); ?></option>
                            <option value="<?php echo lang('train'); ?>" <?php
                            if ($this->input->post('submit')) {
                                echo lang('train') == $this->input->post('type') ? 'selected="yes"' : '';
                            } elseif (isset($route['type'])) {
                                echo $route['type'] == lang('train') ? 'selected="yes"' : '';
                            }
                            ?>><?php echo lang('train'); ?></option>
                            <option value="<?php echo lang('leguna'); ?>" <?php
                            if ($this->input->post('submit')) {
                                echo lang('leguna') == $this->input->post('type') ? 'selected="yes"' : '';
                            } elseif (isset($route['type'])) {
                                echo $route['type'] == lang('leguna') ? 'selected="yes"' : '';
                            }
                            ?>><?php echo lang('leguna'); ?></option>
                            <option value="<?php echo lang('biman'); ?>" <?php
                            if ($this->input->post('submit')) {
                                echo lang('biman') == $this->input->post('type') ? 'selected="yes"' : '';
                            } elseif (isset($route['type'])) {
                                echo $route['type'] == lang('biman') ? 'selected="yes"' : '';
                            }
                            ?>><?php echo lang('biman'); ?></option>
                            <option value="<?php echo lang('others'); ?>" <?php
                            if ($this->input->post('submit')) {
                                echo lang('others') == $this->input->post('type') ? 'selected="yes"' : '';
                            } elseif (isset($route['type'])) {
                                echo $route['type'] == lang('others') ? 'selected="yes"' : '';
                            }
                            ?>><?php echo lang('others'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('vehicle_name'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <input id="vehicle_name" maxlength="200" type="text" class="form-control" name="vehicle_name" value="<?php
                        if ($this->input->post('submit')) {
                            echo set_value('vehicle_name');
                        } elseif (isset($route[$this->nl->lang_based_data('bn_name', 'name')])) {
                            echo $route[$this->nl->lang_based_data('bn_name', 'name')];
                        }
                        ?>" placeholder="<?php echo lang('vehicle_placeholder'); ?>">
                    </div>
                </div>

                <div id="departure_perticular" class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('departure_time'); ?></label>
                    <div  class="col-xs-10 col-md-6">
                        <select id="departure_time" name="departure_time" class="selectpicker" data-width="100%">
                            <option value="<?php echo lang('after_while'); ?>" <?php
                            if ($this->input->post('submit')) {

                                echo lang('after_while') == $this->input->post('type') ? 'selected="yes"' : '';
                            } elseif (isset($route['departure_time'])) {
                                echo $route['departure_time'] == 1 ? 'selected="yes"' : '';
                            }
                            ?>><?php echo lang('after_while'); ?></option>
                            <option value="perticular" <?php
                            if ($this->input->post('submit')) {
                                echo lang('after_while') != $this->input->post('type') ? 'selected="yes"' : '';
                            } elseif (isset($route['departure_time'])) {

                                echo $route['departure_time'] == 2 ? 'selected="yes"' : '';
                            }
                            ?>><?php echo lang('perticular_time'); ?></option>
                        </select>
                    </div>
                </div>

                <?php if (isset($route['departure_time'])): ?>
                    <?php if ($route['departure_time'] == 2): ?>

                        <div id="departure_dynamic" class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-xs-10 col-md-6">
                                <input maxlength="200" type="text" class="form-control"  name="departure_dynamic" value="<?php
                                if ($this->input->post('submit')) {
                                    echo set_value('departure_time');
                                } elseif (isset($route['departure_time'])) {
                                    echo $route['departure_time'];
                                }
                                ?>">
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>


                <div style="display: <?php echo isset($stoppages) ? 'block' : 'none'; ?>;" id="stoppage_section">
                    <?php if (isset($route['id'])): ?>
                        <?php
                        for ($i = 0; $i < count($stoppages); $i++) {
                            $k = $i + 1;
                            echo '<div class="form-group"><div class="col-xs-10 col-md-2"><input id="position_' . $k . '" maxlength="2" type="text" class="form-control order_pos" name="position[]" value="' . $stoppages[$i]['position'] . '"></div><div class="col-xs-10 col-md-3"><input id="place_' . $k . '" maxlength="150" type="text" class="form-control" name="place_name[]" value="' . $stoppages[$i]['place_name'] . '" placeholder="' . lang('place_name') . '"></div><div class="col-xs-10 col-md-4"><textarea id="comment_' . $k . '" maxlength="1000" class="form-control" name="comments[]"  placeholder="' . lang('comment') . '">' . $stoppages[$i]['comments'] . '</textarea></div><div class="col-xs-10 col-md-2"><input id="rent_' . $k . '" maxlength="10" type="text" class="form-control rent" name="rent[]" value="' . $stoppages[$i]['rent'] . '"  placeholder="' . lang('main_rent') . '"></div><button class="btn btn-xs btn-danger" href="javascript:void(0)" class="cancel"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></div>';
                        }
                        ?>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-xs-10 col-md-6">
                        <a href="javascript:void(0)" id="add_stoppage" class="btn btn-info"><?php echo lang('add_stoppage'); ?></a>
                        <span class="help-block"><?php echo lang('add_stoppage_help'); ?></span>
                    </div>
                </div>

                <?php if (isset($route['evidence'])): ?>
                    <?php if (!empty($route['evidence'])): ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo lang('prev_file'); ?></label>
                            <div class="col-xs-10 col-md-6">
                                <a id="prev_evidence" href="<?php echo base_url('evidences') . '/' . $route['evidence']; ?>"><?php echo $route['evidence']; ?></a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('add_file'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <input type="file" class="form-control btn-info" name="evidence">
                        <span class="help-block"><?php echo lang('add_file_help'); ?></span>
                    </div>
                </div>

                <input type="hidden" id="cancel" value="<?php echo lang('cancel_text'); ?>"/>
                <input type="hidden" id="place_name" value="<?php echo lang('place_name'); ?>"/>
                <input type="hidden" id="comment" value="<?php echo lang('comment'); ?>"/>
                <input type="hidden" id="rents" value="<?php echo lang('main_rent'); ?>"/>
                <input type="hidden" id="custom_time" value="<?php echo lang('custom_time'); ?>"/>
                <input type="hidden" id="route_id" name="route_id" value="<?php
                if ($this->input->post('submit')) {
                    echo set_value('route_id');
                } elseif (isset($route['id'])) {
                    echo $route['id'];
                }
                ?>"/>
                <input id="prev_file" type="hidden"  name="prev_file" value="<?php
                if ($this->input->post('submit')) {
                    echo set_value('prev_file');
                } elseif (isset($route['evidence'])) {
                    echo $route['evidence'];
                }
                ?>"/>
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                <input id="submit_route" type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo lang('add_button'); ?>"/>
            </form>
        </div>
    </div>
</div>
