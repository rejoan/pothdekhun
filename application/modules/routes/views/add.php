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
                    <?php echo lang('direct_add') ?>
                <?php } else { ?>
                    <strong><?php echo $from_push; ?></strong> <?php echo lang('from_view'); ?>  <strong><?php echo $to_push; ?></strong>&nbsp;<?php echo lang('direct_add'); ?>
                <?php } ?>
            </div>

            <?php if (strpos(current_url(), 'edit')): ?>
                <?php
                echo lang('edit_lang') . ' ';
                echo '<a class="btn btn-sm btn-info" href="' . site_url_tr() . '">' . $text_lang . '</a>';
                echo ' ' . lang('info_of');
                ?>
            <?php endif; ?>

        </div>
        <div class="box-body">
            <!-- route info push form -->
            <form id="add_route" class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">

                <label class="col-sm-3 control-label"><?php echo lang('from_view'); ?> <span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                <div class="row">
                    <div class="col-xs-10 col-md-2 margin-r-5">
                        <div class="form-group">
                            <select id="from_district" name="from_district" class="selectpicker" data-width="100%" data-live-search="true">
                                <?php foreach ($districts as $d): ?>
                                    <option value="<?php echo $d['id']; ?>" <?php
                                    if (isset($route['from_district'])) {
                                        echo $route['from_district'] == $d['id'] ? 'selected="yes"' : '';
                                    }
                                    ?>>

                                        <?php echo $d[$name]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-10 col-md-2">
                        <div class="form-group">
                            <select id="from_thana" name="from_thana" class="selectpicker" data-width="100%" data-live-search="true">
                                <?php foreach ($thanas as $t): ?>
                                    <option  value="<?php echo $t['id']; ?>" <?php
                                    if (isset($route['to_thana'])) {
                                        echo $route['to_thana'] == $t['id'] ? 'selected="yes"' : '';
                                    }
                                    ?>>

                                        <?php echo $t[$name]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-10 col-md-3">
                        <input id="from_place" maxlength="200" type="text" class="form-control" name="from_place" value="<?php
                        if ($this->input->post('submit')) {
                            echo set_value('from_place');
                        } elseif (isset($route['from_place'])) {
                            echo $route['from_place'];
                        } else {
                            echo (!empty($from_push)) ? $from_push : $this->session->from_login;
                        }
                        ?>" placeholder="<?php echo lang('device_from'); ?>">
                    </div>
                </div>
                <?php echo form_error('from_place', '<div class="alert alert-danger">', '</div>'); ?>

                <label class="col-sm-3 control-label"><?php echo lang('to_view'); ?> <span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                <div class="row">
                    <div class="col-xs-10 col-md-2 margin-r-5">
                        <div class="form-group">
                            <select id="to_district" name="to_district" class="selectpicker" data-width="100%" data-live-search="true">
                                <?php foreach ($districts as $d): ?>
                                    <option  value="<?php echo $d['id']; ?>" <?php
                                    if (isset($route['to_district'])) {
                                        echo $route['to_district'] == $d['id'] ? 'selected="yes"' : '';
                                    }
                                    ?>>
                                                 <?php echo $d[$name]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-10 col-md-2">
                        <div class="form-group">
                            <select id="to_thana" name="to_thana" class="selectpicker" data-width="100%" data-live-search="true">
                                <?php foreach ($thanas as $t): ?>
                                    <option  value="<?php echo $t['id']; ?>" <?php
                                    if (isset($route['to_thana'])) {
                                        echo $route['to_thana'] == $t['id'] ? 'selected="yes"' : '';
                                    }
                                    ?>>
                                                 <?php echo $t[$name]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-10 col-md-3">
                        <input id="to_place" maxlength="200" type="text" class="form-control" name="to_place" value="<?php
                        if ($this->input->post('submit')) {
                            echo set_value('to_place');
                        } elseif (isset($route['to_place'])) {
                            echo $route['to_place'];
                        } else {
                            echo (!empty($to_push)) ? $to_push : $this->session->to_login;
                        }
                        ?>" placeholder="<?php echo lang('device_to'); ?>">
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
                        <select id="vehicle_type" name="type" class="selectpicker" data-width="100%">
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
                        } elseif (isset($route['vehicle_name'])) {
                            echo $route['vehicle_name'];
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
                                echo $route['departure_time'] == lang('after_while') ? 'selected="yes"' : '';
                            }
                            ?>><?php echo lang('after_while'); ?></option>
                            <option value="perticular" <?php
                            if ($this->input->post('submit')) {
                                echo lang('after_while') != $this->input->post('type') ? 'selected="yes"' : '';
                            } elseif (isset($route['departure_time'])) {

                                echo $route['departure_time'] != lang('after_while') ? 'selected="yes"' : '';
                            }
                            ?>><?php echo lang('perticular_time'); ?></option>
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
                            echo '<div class="form-group"><div class="col-xs-10 col-md-2"><input id="position_' . $k . '" maxlength="2" type="text" class="form-control order_pos" name="position[]" value="' . $stoppages[$i]['position'] . '"></div><div class="col-xs-10 col-md-3"><input id="place_' . $k . '" maxlength="150" type="text" class="form-control" name="place_name[]" value="' . $stoppages[$i]['place_name'] . '" placeholder="' . lang('place_name') . '"></div><div class="col-xs-10 col-md-4"><textarea id="comment_' . $k . '" maxlength="1000" class="form-control" name="comments[]"  placeholder="' . lang('comment') . '">' . $stoppages[$i]['comments'] . '</textarea></div><div class="col-xs-10 col-md-2"><input id="rent_' . $k . '" maxlength="10" type="text" class="form-control rent" name="rent[]" value="' . $stoppages[$i]['rent'] . '"  placeholder="' . lang('main_rent') . '"></div><a class="btn btn-xs btn-danger" href="javascript:void(0)" class="cancel">' . lang('cancel_text') . '</a></div>';
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
                <input type="hidden" name="merger" value="merge"/>
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
                <input id="submit_route" type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo lang('add_button'); ?>"/>
            </form>
        </div>
    </div>
</div>
<?php //echo $this->uri->segment(1, 'en');?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#from_district,#to_district').change(function () {
            var to = 'from_thana';
            var district = $.trim($(this).val());
            var from = $.trim($(this).prop('id'));
            var site_url = $('#site_url').val();
            xhr = $.ajax({
                url: site_url + '/weapons/get_thanas',
                type: 'get',
                dataType: 'json',
                cache: true,
                data: {
                    district: district
                }
            }).done(function (response) {
                var th = '';
                for (var i = 0; i < Object.keys(response).length; i++) {
                    th += '<option value="' + response[i]['id'] + '">' + response[i]['thana'] + '</option>';
                }
                if (from === 'to_district') {
                    to = 'to_thana';
                }
                $('#' + to).html(th);
                $('#' + to).selectpicker('refresh');
            });
        });
    });
</script>