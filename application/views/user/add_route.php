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

            <?php if (strpos(current_url(), 'edit')): ?>
                <?php
                $url = ($this->input->get('ln') == 'en') ? current_url() . '?ln=bn' : current_url() . '?ln=en';
                $text_lang = ($this->input->get('ln') == 'bn') ? 'English' : 'Bengali';
                echo $this->lang->line('edit_lang') . ' ';
                echo '<a class="btn btn-sm btn-info" href="' . $url . '">' . $text_lang . '</a>';
                echo ' ' . $this->lang->line('info_of');
                ?>
            <?php endif; ?>

        </div>
        <div class="box-body">
            <!-- route info push form -->
            <form id="add_route" class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('country'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <select id="country" name="country" class="selectpicker" data-width="100%">
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
                        <input id="from_place" maxlength="200" type="text" class="form-control" name="from_place" value="<?php
                        if ($this->input->post('submit')) {
                            echo set_value('from_place');
                        } elseif (isset($route['from_place'])) {
                            echo $route['from_place'];
                        } else {
                            echo (!empty($from_push)) ? $from_push : $this->session->from_login;
                        }
                        ?>" placeholder="<?php echo $this->lang->line('device_from'); ?>">
                    </div>
                </div>
                <?php echo form_error('from_place', '<div class="alert alert-danger">', '</div>'); ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('to_view'); ?> <span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                    <div class="col-xs-10 col-md-6">
                        <input id="to_place" maxlength="200" type="text" class="form-control" name="to_place" value="<?php
                        if ($this->input->post('submit')) {
                            echo set_value('to_place');
                        } elseif (isset($route['to_place'])) {
                            echo $route['to_place'];
                        } else {
                            echo (!empty($to_push)) ? $to_push : $this->session->to_login;
                        }
                        ?>" placeholder="<?php echo $this->lang->line('device_to'); ?>">
                    </div>
                </div>
                <?php echo form_error('to_place', '<div class="alert alert-danger">', '</div>'); ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('departure_place'); ?><span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                    <div class="col-xs-10 col-md-6">
                        <input id="departure_place" maxlength="200" type="text" class="form-control"  name="departure_place" value="<?php
                        if ($this->input->post('submit')) {
                            echo set_value('departure_place');
                        } elseif (isset($route['departure_place'])) {
                            echo $route['departure_place'];
                        }
                        ?>" placeholder="<?php echo $this->lang->line('departure_placeholder'); ?>">
                    </div>
                </div>

                <?php echo form_error('departure_place', '<div class="alert alert-danger">', '</div>'); ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('main_rent'); ?> <span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                    <div class="col-xs-10 col-md-6">
                        <input id="main_rent" maxlength="10" type="text" class="form-control rent" name="main_rent" value="<?php
                        if ($this->input->post('submit')) {
                            echo set_value('main_rent');
                        } elseif (isset($route['rent'])) {
                            echo $route['rent'];
                        }
                        ?>" placeholder="<?php echo $this->lang->line('rent_placeholder'); ?>" required title="কমপক্ষে আনুমানিক ভাড়া দিন">
                    </div>
                </div>

                <?php echo form_error('main_rent', '<div class="alert alert-danger">', '</div>'); ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('transport_type'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <select id="vehicle_type" name="type" class="selectpicker" data-width="100%">
                            <option value="<?php echo $this->lang->line('bus'); ?>" <?php
                            if ($this->input->post('submit')) {
                                echo $this->lang->line('bus') == $this->input->post('type') ? 'selected="yes"' : '';
                            } elseif (isset($route['type'])) {
                                echo $route['type'] == $this->lang->line('bus') ? 'selected="yes"' : '';
                            }
                            ?>><?php echo $this->lang->line('bus'); ?></option>
                            <option value="<?php echo $this->lang->line('train'); ?>" <?php
                            if ($this->input->post('submit')) {
                                echo $this->lang->line('train') == $this->input->post('type') ? 'selected="yes"' : '';
                            } elseif (isset($route['type'])) {
                                echo $route['type'] == $this->lang->line('train') ? 'selected="yes"' : '';
                            }
                            ?>><?php echo $this->lang->line('train'); ?></option>
                            <option value="<?php echo $this->lang->line('leguna'); ?>" <?php
                            if ($this->input->post('submit')) {
                                echo $this->lang->line('leguna') == $this->input->post('type') ? 'selected="yes"' : '';
                            } elseif (isset($route['type'])) {
                                echo $route['type'] == $this->lang->line('leguna') ? 'selected="yes"' : '';
                            }
                            ?>><?php echo $this->lang->line('leguna'); ?></option>
                            <option value="<?php echo $this->lang->line('biman'); ?>" <?php
                            if ($this->input->post('submit')) {
                                echo $this->lang->line('biman') == $this->input->post('type') ? 'selected="yes"' : '';
                            } elseif (isset($route['type'])) {
                                echo $route['type'] == $this->lang->line('biman') ? 'selected="yes"' : '';
                            }
                            ?>><?php echo $this->lang->line('biman'); ?></option>
                            <option value="<?php echo $this->lang->line('others'); ?>" <?php
                            if ($this->input->post('submit')) {
                                echo $this->lang->line('others') == $this->input->post('type') ? 'selected="yes"' : '';
                            } elseif (isset($route['type'])) {
                                echo $route['type'] == $this->lang->line('others') ? 'selected="yes"' : '';
                            }
                            ?>><?php echo $this->lang->line('others'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('vehicle_name'); ?><span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                    <div class="col-xs-10 col-md-6">
                        <input id="vehicle_name" maxlength="200" type="text" class="form-control" name="vehicle_name" value="<?php
                        if ($this->input->post('submit')) {
                            echo set_value('vehicle_name');
                        } elseif (isset($route['vehicle_name'])) {
                            echo $route['vehicle_name'];
                        }
                        ?>" placeholder="<?php echo $this->lang->line('vehicle_placeholder'); ?>" required title="পরিবহনের নাম আবশ্যক">
                    </div>
                </div>
                <?php echo form_error('vehicle_name', '<div class="alert alert-danger">', '</div>'); ?>

                <div id="departure_perticular" class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('departure_time'); ?></label>
                    <div  class="col-xs-10 col-md-6">
                        <select id="departure_time" name="departure_time" class="selectpicker" data-width="100%">
                            <option value="<?php echo $this->lang->line('after_while'); ?>" <?php
                            if ($this->input->post('submit')) {

                                echo $this->lang->line('after_while') == $this->input->post('type') ? 'selected="yes"' : '';
                            } elseif (isset($route['departure_time'])) {
                                echo $route['departure_time'] == $this->lang->line('after_while') ? 'selected="yes"' : '';
                            }
                            ?>><?php echo $this->lang->line('after_while'); ?></option>
                            <option value="perticular" <?php
                            if ($this->input->post('submit')) {
                                echo $this->lang->line('after_while') != $this->input->post('type') ? 'selected="yes"' : '';
                            } elseif (isset($route['departure_time'])) {

                                echo $route['departure_time'] != $this->lang->line('after_while') ? 'selected="yes"' : '';
                            }
                            ?>><?php echo $this->lang->line('perticular_time'); ?></option>
                        </select>
                    </div>
                </div>

                <?php if (isset($route['departure_time'])): ?>
                    <?php if ($route['departure_time'] !== 'কিছুক্ষর পরপর'): ?>

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
                            echo '<div class="form-group"><div class="col-xs-10 col-md-2"><input id="position_'. $k .'" maxlength="2" type="text" class="form-control order_pos" name="position[]" value="' . $stoppages[$i]['position'] . '"></div><div class="col-xs-10 col-md-3"><input id="place_'.$k.'" maxlength="150" type="text" class="form-control" name="place_name[]" value="' . $stoppages[$i]['place_name'] . '" placeholder="' . $this->lang->line('place_name') . '"></div><div class="col-xs-10 col-md-4"><textarea id="comment_'.$k.'" maxlength="1000" class="form-control" name="comments[]"  placeholder="' . $this->lang->line('comment') . '">' . $stoppages[$i]['comments'] . '</textarea></div><div class="col-xs-10 col-md-2"><input id="rent_'.$k.'" maxlength="10" type="text" class="form-control rent" name="rent[]" value="' . $stoppages[$i]['rent'] . '"  placeholder="' . $this->lang->line('main_rent') . '"></div><a class="btn btn-xs btn-danger" href="javascript:void(0)" class="cancel">' . $this->lang->line('cancel_text') . '</a></div>';
                        }
                        ?>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-xs-10 col-md-6">
                        <a href="javascript:void(0)" id="add_stoppage" class="btn btn-info"><?php echo $this->lang->line('add_stoppage'); ?></a>
                        <span class="help-block"><?php echo $this->lang->line('add_stoppage_help'); ?></span>
                    </div>
                </div>

                <?php if (isset($route['evidence'])): ?>
                    <?php if (!empty($route['evidence'])): ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('prev_file'); ?></label>
                            <div class="col-xs-10 col-md-6">
                                <a id="prev_evidence" href="<?php echo base_url('evidences') . '/' . $route['evidence']; ?>"><?php echo $route['evidence']; ?></a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

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
                <input id="submit_route" type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo $this->lang->line('add_button'); ?>"/>
            </form>
        </div>
    </div>
</div>
