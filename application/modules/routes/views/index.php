<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="suggestion_page" class="col-sm-6 col-sm-push-3">
    <?php
    $message = $this->session->flashdata('message');
    if ($message) {
        echo '<div class="alert alert-warning">' . $message . '</div>';
    }
    ?>
    <div class="box box-poth">
        <div class="box-header">
            <?php echo lang('see_transport'); ?>
        </div>
        <div class="box-body">
            <div id="place_mandatory" class="alert alert-danger err" >
                <h4 class="no-margin" style="line-height: 1.5;"><?php echo lang('place_mandatory'); ?></h4>
            </div>
            <!-- route info pull form -->
            <form id="main_search" action="<?php echo $action_transport; ?>" method="get" accept-charset="UTF-8">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-10 col-md-3">
                            <div class="form-group">
                                <select name="fd" class="selectpicker districts" data-width="100%" data-thana="ft" data-live-search="true">
                                    <?php foreach ($districts as $d): ?>
                                        <option value="<?php echo $d['id']; ?>" <?php echo $d['id'] == '1' ? 'selected="yes"' : ''; ?>>
                                            <?php echo $d[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-10 col-md-3">
                            <div id="tft" data-toggle="tooltip" data-placement="top" title="<?php echo lang('dhaka_message'); ?>" class="form-group">
                                <select id="ft" name="ft" class="selectpicker thanas" data-width="100%" data-live-search="true" >
                                    <?php foreach ($thanas as $t): ?>
                                        <option  value="<?php echo $t['id']; ?>" <?php echo $t['id'] == '493' ? 'selected="yes"' : ''; ?>>
                                            <?php echo $t[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-10 col-md-6 suggestion_sec">
                            <input type="text" class="form-control search_place" placeholder="<?php echo lang('departure_place'); ?>" name="f" title="যেখান থেকে  যাবেন সেই জায়গার নাম দিন" autocomplete="off">
                            <div class="list-group suggestion">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>
                        <?php echo lang('to_view'); ?>
                    </label>
                </div>
                <div class="form-group">

                    <div class="row">
                        <div class="col-xs-10 col-md-3">
                            <div class="form-group">
                                <select name="td" class="selectpicker districts" data-width="100%" data-thana="th" data-live-search="true">
                                    <?php foreach ($districts as $d): ?>
                                        <option value="<?php echo $d['id']; ?>" <?php echo $d['id'] == '1' ? 'selected="yes"' : ''; ?>>
                                            <?php echo $d[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-10 col-md-3">
                            <div id="tth" data-toggle="tooltip" data-placement="top" title="<?php echo lang('dhaka_message'); ?>" class="form-group">
                                <select id="th" name="th" class="selectpicker thanas" data-width="100%" data-live-search="true">
                                    <?php foreach ($thanas as $t): ?>
                                        <option  value="<?php echo $t['id']; ?>" <?php echo $t['id'] == '509' ? 'selected="yes"' : ''; ?>>
                                            <?php echo $t[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-10 col-md-6 suggestion_sec">
                            <input type="text" class="form-control search_place" placeholder="<?php echo lang('destination_place'); ?>" name="t" title="যেখানে যাবেন সেই জায়গার নাম দিন" autocomplete="off">
                            <div class="list-group suggestion">

                            </div>
                        </div>
                    </div>
                </div>
                <input id="see_transport" type="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo lang('see_transport_button'); ?>"/>
            </form>
        </div>
    </div>
    <div class="box box-poth">
        <div class="box-header">
            <?php echo lang('other_search'); ?>
        </div>
        <div class="box-body">
            <!-- get route info from user form -->
            <form action="<?php echo $search_action; ?>" method="get" accept-charset="UTF-8">
                <div class="row">
                    <div class="col-xs-10 col-md-3">
                        <div class="form-group">
                            <select id="district" name="ds" class="selectpicker" data-width="100%" data-thana="th" data-live-search="true">
                                <?php foreach ($districts as $d): ?>
                                    <option value="<?php echo $d['id']; ?>" <?php echo $d['id'] == '1' ? 'selected="yes"' : ''; ?>>
                                        <?php echo $d[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-10 col-md-6">
                        <input id="search_place" type="text" class="form-control" placeholder="<?php echo lang('place_search'); ?>" name="f" required title="যেখানে যাবেন সেই জায়গার নাম দিন" autocomplete="off">
                        <div class="list-group suggestion">
                        </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col-md-3">
                        <input type="submit" class="btn btn-primary btn-info" value="<?php echo lang('show_transport'); ?>"/>  
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#see_transport').click(function (e) {
            var fromd = $('#main_search select[name="fd"]').val();
            var fromp = $.trim($('#main_search input[name="f"]').val());
            var tod = $('#main_search select[name="td"]').val();
            var top = $.trim($('#main_search input[name="t"]').val());
            if (fromd == 1 && tod == 1 && (fromp.length < 1 || top.length < 1)) {
                $('#place_mandatory').show().effect('shake');
                if (fromp.length < 1) {
                    $('#main_search input[name="f"]').css('border', '1px solid #ff0000');
                }
                if (top.length < 1) {
                    $('#main_search input[name="t"]').css('border', '1px solid #ff0000');
                }

                return false;
            }
        });
    });
</script>