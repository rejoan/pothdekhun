<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="suggestion_page" class="col-sm-6 col-sm-push-3">
    <?php
    $message = $this->session->flashdata('message');
    if ($message) {
        echo '<div class="alert alert-warning">' . $message . '</div>';
    }
    $text_lang = $this->session->lang_name == 'bengali' ? lang('english') : lang('bangla');
    $lang_code = $this->session->lang_name == 'bengali' ? 'en' : 'bn';
    ?>
    <div class="box box-poth">
        <div class="box-header">
            <h4>
                <?php echo lang('direct_add') . ' <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#route_add_rule">' . lang('3_rules') . '</button>'; ?> 
            </h4>

            <?php if (strpos(current_url(), 'edit')): ?>
                <?php
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
                        <select name="fd" class="districts form-control" data-thana="ft">
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
                        <div id="tft" class="form-group">
                            <select id="ft" name="ft" class="form-control">
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
                        } elseif (isset($route[$this->nl->lang_based_data('fp_bn', 'from_place')])) {
                            echo $route[$this->nl->lang_based_data('fp_bn', 'from_place')];
                        } elseif ($this->input->post('f')) {
                            echo $this->input->post('f');
                        }
                        ?>" placeholder="<?php echo lang('departure_place'); ?>" autocomplete="off">
                        <div class="list-group suggestion">

                        </div>
                    </div>
                </div>
                <?php echo form_error('from_place', '<div class="alert alert-danger">', '</div>'); ?>
                <div class="row">
                    <div class="col-xs-10">
                        <label>
                            <?php echo lang('to_view'); ?>
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-10 col-md-3">
                        <select name="td" class="form-control districts" data-thana="th">
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
                        <div id="tth" data-toggle="tooltip" data-placement="top" title="<?php echo lang('dhaka_message'); ?>" class="form-group">
                            <select id="th" name="th" class="form-control">
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
                        } elseif (isset($route[$this->nl->lang_based_data('tp_bn', 'to_place')])) {
                            echo $route[$this->nl->lang_based_data('tp_bn', 'to_place')];
                        } elseif ($this->input->post('t')) {
                            echo $this->input->post('t');
                        }
                        ?>" placeholder="<?php echo lang('destination_place'); ?>" autocomplete="off">
                        <div class="list-group suggestion">

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
                        ?>" placeholder="<?php echo lang('rent_placeholder'); ?>" required title="At least provide approximate fare">
                    </div>
                </div>

                <?php echo form_error('main_rent', '<div class="alert alert-danger">', '</div>'); ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('transport_type'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <select id="vehicle_type" name="transport_type" class="form-control">
                            <option value="bus" <?php
                            if ($this->input->post('submit')) {
                                echo $this->input->post('type') == 'bus' ? 'selected="yes"' : '';
                            } elseif (isset($route['transport_type'])) {
                                echo $route['transport_type'] == 'bus' ? 'selected="yes"' : '';
                            }
                            ?>><?php echo lang('bus'); ?></option>
                            <option value="train" <?php
                            if ($this->input->post('submit')) {
                                echo $this->input->post('type') == 'train' ? 'selected="yes"' : '';
                            } elseif (isset($route['transport_type'])) {
                                echo $route['transport_type'] == 'train' ? 'selected="yes"' : '';
                            }
                            ?>><?php echo lang('train'); ?></option>
                            <option value="launch" <?php
                            if ($this->input->post('submit')) {
                                echo $this->input->post('type') == 'launch' ? 'selected="yes"' : '';
                            } elseif (isset($route['transport_type'])) {
                                echo $route['transport_type'] == 'launch' ? 'selected="yes"' : '';
                            }
                            ?>><?php echo lang('launch'); ?></option>
                            <option value="leguna" <?php
                            if ($this->input->post('submit')) {
                                echo $this->input->post('type') == 'leguna' ? 'selected="yes"' : '';
                            } elseif (isset($route['transport_type'])) {
                                echo $route['transport_type'] == 'leguna' ? 'selected="yes"' : '';
                            }
                            ?>><?php echo lang('leguna'); ?></option>
                            <option value="biman" <?php
                            if ($this->input->post('submit')) {
                                echo $this->input->post('type') == 'biman' ? 'selected="yes"' : '';
                            } elseif (isset($route['transport_type'])) {
                                echo $route['transport_type'] == 'biman' ? 'selected="yes"' : '';
                            }
                            ?>><?php echo lang('biman'); ?></option>
                            <option value="others" <?php
                            if ($this->input->post('submit')) {
                                echo $this->input->post('type') == 'others' ? 'selected="yes"' : '';
                            } elseif (isset($route['transport_type'])) {
                                echo $route['transport_type'] == 'others' ? 'selected="yes"' : '';
                            }
                            ?>><?php echo lang('others'); ?></option>
                        </select>
                    </div>
                </div>
                <div id="vehicle" class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('vehicle_name'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <input type="hidden"  name="janba" value="<?php
                        if ($this->input->post('submit')) {
                            echo set_value('poribohon_id');
                        } elseif (isset($route['poribohon_id'])) {
                            echo $this->nl->enc($route['poribohon_id']);
                        }
                        ?>"/>
                        <input id="pd_identity" type="hidden"  name="pd_identity" value="<?php
                        if ($this->input->post('submit')) {
                            echo set_value('pd_identity');
                        } elseif (isset($route['r_id'])) {
                            echo $this->nl->enc($route['r_id']);
                        }
                        ?>"/>
                        <input id="vehicle_name" maxlength="200" type="text" class="form-control" name="vehicle_name" value="<?php
                        if ($this->input->post('submit')) {
                            echo set_value('vehicle_name');
                        } elseif (isset($route[$this->nl->lang_based_data('bn_name', 'name')])) {
                            echo $route[$this->nl->lang_based_data('bn_name', 'name')];
                        }
                        ?>" placeholder="<?php echo lang('vehicle_placeholder'); ?>" autocomplete="off">
                        <div class="list-group suggestion">

                        </div>
                    </div>
                </div>

                <div id="departure_perticular" class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('departure_time'); ?></label>
                    <div  class="col-xs-10 col-md-6">
                        <select id="departure_time" name="departure_time" class="form-control">
                            <option value="1" <?php
                            if ($this->input->post('submit')) {

                                echo $this->input->post('departure_time') == 1 ? 'selected="yes"' : '';
                            } elseif (isset($route['departure_time'])) {
                                echo $route['departure_time'] == 1 ? 'selected="yes"' : '';
                            }
                            ?>><?php echo lang('after_while'); ?></option>
                            <option value="2" <?php
                            if ($this->input->post('submit')) {
                                echo $this->input->post('departure_time') != 1 ? 'selected="yes"' : '';
                            } elseif (isset($route['departure_time'])) {

                                echo $route['departure_time'] != 1 ? 'selected="yes"' : '';
                            }
                            ?>><?php echo lang('perticular_time'); ?></option>
                        </select>
                    </div>
                </div>

                <?php if (isset($route['departure_time'])): ?>
                    <?php if ($route['departure_time'] != 1): ?>
                        <div id="departure_dynamic" class="form-group">
                            <div class="col-md-12">
                                <textarea id="custom_area" name="departure_dynamic" class="form-control" rows="10">
                                    <?php
                                    if ($this->input->post('submit')) {
                                        echo set_value('departure_time');
                                    } elseif (isset($route['departure_time'])) {
                                        $breaks = array('<br />', '<br>', '<br/>');
                                        echo str_ireplace($breaks, "\r\n", $route['departure_time']);
                                    }
                                    ?>
                                </textarea>
                            </div>
                        </div>

                    <?php endif; ?>
                <?php endif; ?>

                <?php
                $overflow = $this->ua->is_browser('Firefox') ? 'overflow:auto;' : '';
                ?>
                <div style="display: <?php echo isset($stoppages) ? 'block;' . $overflow : 'none;' . $overflow; ?>" id="stoppage_section">
                    <?php if (isset($route['r_id'])): ?>
                        <?php
                        for ($i = 0; $i < count($stoppages); $i++) {
                            $k = $i + 1;
                            echo '<div class="form-group stoppage"><div class="col-xs-10 col-md-4"><input id="place_' . $k . '" maxlength="150" type="text" class="form-control place_name" name="place_name[]" value="' . $stoppages[$i]['place_name'] . '" placeholder="' . lang('place_name') . '" autocomplete="off"><div class="list-group suggestion"></div></div><div class="col-xs-10 col-md-5"><textarea id="comment_' . $k . '" maxlength="1000" class="form-control" name="comments[]"  placeholder="' . lang('comment') . '">' . $stoppages[$i]['comments'] . '</textarea></div><div class="col-xs-10 col-md-2"><input id="rent_' . $k . '" maxlength="10" type="text" class="form-control rent" name="rent[]" value="' . $stoppages[$i]['rent'] . '"  placeholder="' . lang('main_rent') . '"><input type="hidden" name="a[]" value="p"></div><button class="btn btn-xs btn-danger cancel" href="javascript:void(0)"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></div>';
                        }
                        ?>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-xs-10 col-md-6">
                        <a href="javascript:void(0)" id="add_stoppage" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> <?php echo lang('add_stoppage'); ?></a>
                        <span class="help-block"><?php echo lang('add_stoppage_help'); ?></span>
                    </div>
                </div>

                <?php if (isset($route['evidence'])): ?>
                    <?php if (!empty($route['evidence'])): ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo lang('prev_file'); ?></label>
                            <div class="col-xs-10 col-md-6">
                                <a class="fancybox" id="prev_evidence" href="<?php echo base_url('evidences') . '/' . $route['evidence']; ?>"><?php echo $route['evidence']; ?></a>
                                <?php if ($this->nl->is_admin()): ?>
                                    <button data-file_name="<?php echo $route['evidence2']; ?>" data-hidden_id="pd_pthm" class="btn btn-xs btn-danger remove_file" href="javascript:void(0)"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('add_file'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <input type="file" class="evidence" name="evidence1" multiple="">
                        <span class="help-block"><?php echo lang('add_file_help'); ?> [Max:2MB]</span>
                    </div>
                </div>

                <?php if (isset($route['evidence2'])): ?>
                    <?php if (!empty($route['evidence2'])): ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo lang('prev_file'); ?></label>
                            <div class="col-xs-10 col-md-6">
                                <a class="fancybox" id="prev_evidence2" href="<?php echo base_url('evidences') . '/' . $route['evidence2']; ?>"><?php echo $route['evidence2']; ?></a>
                                <?php if ($this->nl->is_admin()): ?>
                                    <button data-file_name="<?php echo $route['evidence2']; ?>" data-hidden_id="pd_pthmnx" class="btn btn-xs btn-danger remove_file" href="javascript:void(0)"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('another_file'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <input type="file" class="evidence" name="evidence2" multiple="">
                        <span class="help-block"><?php echo lang('more_help'); ?> [Max:2MB]</span>
                    </div>
                </div>
                <?php
                if (isset($route['amenities'])) {
                    $amenities = explode(',', $route['amenities']);
                }
                ?>
                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo lang('ac_nonac'); ?></label>
                    <div id="ac_nonac" class="col-md-9">
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
                        <label class="col-md-3 control-label"><?php echo lang('ac_type'); ?></label>
                        <div class="col-md-9 custom_pad_left">
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
                    <label class="col-md-3 control-label"><?php echo lang('mail_local'); ?></label>
                    <div class="col-md-9">
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
                    <label class="col-md-3 control-label"><?php echo lang('chair_semi'); ?>?</label>
                    <div class="col-md-9">
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
                <input id="pd_pthm" type="hidden"  name="pd_pthm" value="<?php
                if ($this->input->post('submit')) {
                    echo set_value('pd_pthm');
                } elseif (isset($route['evidence'])) {
                    echo $route['evidence'];
                }
                ?>"/>
                <input id="pd_pthmnx" type="hidden"  name="pd_pthmnx" value="<?php
                if ($this->input->post('submit')) {
                    echo set_value('pd_pthmnx');
                } elseif (isset($route['evidence2'])) {
                    echo $route['evidence2'];
                }
                ?>"/>

<?php if ($this->nl->is_admin() && $this->input->get('pd_rev')): ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Point</label>
                        <div class="col-xs-10 col-md-6">
                            <input id="point" type="text" class="form-control" name="point" value="<?php echo $point; ?>">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Note</label>
                        <div class="col-xs-10 col-md-6">
                            <textarea class="form-control" name="note"></textarea>
                        </div>
                    </div>
<?php endif; ?>
<?php if ($this->nl->is_admin() && isset($route)): ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <div class="col-sm-6">
                                <input type="radio" name="stoppage_update" value="yes">
                                Update stoppage
                            </div>
                        </label>

                        <label class="col-sm-3 control-label">
                            <div class="col-sm-6">
                                <input type="radio" name="stoppage_update" value="no" checked="yes">
                                Not Update stoppage
                            </div>
                        </label>

                    </div>
<?php endif; ?>
                <input id="submit_route" type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo $action_button; ?>"/>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('rules_modal'); ?>
<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script>
    $(document).ready(function () {
        $('#ac_nonac input[type="radio"]').click(function () {
            if ($(this).val() == 'ac') {
                $('#ac_type').slideDown();
            } else {
                $('#ac_type').slideUp();
            }

        });
<?php if ($this->nl->is_admin()): ?>

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
                        $(this).parent().parent().remove();
                        $('#' + hidden_id).val('');
                        var point = parseInt($('#point').val());
                        var new_pint = point - 5;
                        $('#point').val(new_pint);
                    }
                });
            });
<?php endif; ?>
    });
</script>