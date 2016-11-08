<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xs-12 col-md-6">
    <div class="box box-poth">
        <div class="box-header">
            <?php echo lang('see_transport'); ?>
        </div>
        <div class="box-body">
            <!-- route info pull form -->
            <form action="<?php echo $action_transport; ?>" method="get" accept-charset="UTF-8">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-10 col-md-3">
                            <div class="form-group">
                                <select name="fd" class="selectpicker districts" data-width="100%" data-thana="ft" data-live-search="true">
                                    <?php foreach ($districts as $d): ?>
                                        <option value="<?php echo $d['id']; ?>">
                                            <?php echo $d[$name]; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-10 col-md-3">
                            <div data-toggle="tooltip" data-placement="top" title="<?php echo lang('dhaka_message'); ?>" class="form-group">
                                <select id="ft" name="ft" class="selectpicker thanas" data-width="100%" data-live-search="true" >
                                    <?php foreach ($thanas as $t): ?>
                                        <option  value="<?php echo $t['id']; ?>" <?php echo $t['id'] == '493' ? 'selected="yes"' : ''; ?>>
                                            <?php echo $t[$name]; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-10 col-md-6">
                            <input type="text" class="form-control search_place" placeholder="<?php echo lang('from_push'); ?>" name="f" required title="যেখান থেকে  যাবেন সেই জায়গার নাম দিন" autocomplete="off">
                            <div id="suggestion" class="list-group">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>
                        <?php echo lang('from_view'); ?>
                    </label>
                </div>
                <div class="form-group">

                    <div class="row">
                        <div class="col-xs-10 col-md-3">
                            <div class="form-group">
                                <select name="td" class="selectpicker districts" data-width="100%" data-thana="th" data-live-search="true">
                                    <?php foreach ($districts as $d): ?>
                                        <option value="<?php echo $d['id']; ?>">
                                            <?php echo $d[$name]; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-10 col-md-3">
                            <div data-toggle="tooltip" data-placement="top" title="<?php echo lang('dhaka_message'); ?>" class="form-group">
                                <select id="th" name="th" class="selectpicker thanas" data-width="100%" data-live-search="true">
                                    <?php foreach ($thanas as $t): ?>
                                        <option  value="<?php echo $t['id']; ?>" <?php echo $t['id'] == '509' ? 'selected="yes"' : ''; ?>>
                                            <?php echo $t[$name]; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-10 col-md-6">
                            <input type="text" class="form-control search_place" placeholder="<?php echo lang('device_to'); ?>" name="t" required title="যেখানে যাবেন সেই জায়গার নাম দিন" autocomplete="off">
                            <div id="suggestion_to" class="list-group">

                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo lang('see_transport_button'); ?>"/>
            </form>
        </div>
    </div>
    <div class="box box-poth">
        <div class="box-header">
            <?php echo lang('other_search'); ?>
        </div>
        <div class="box-body">
            <!-- get route info from user form -->
            <form action="<?php echo $action_add; ?>" method="post" accept-charset="UTF-8">
                <div class="input-group margin">
                    <input name="ps" type="text" class="form-control" placeholder="<?php echo lang('place_search');?>">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat"><?php echo lang('place_search');?></button>
                    </span>
                </div>

                <div class="input-group margin">
                    <input type="text" class="form-control">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat">Go!</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.districts').change(function () {
            var district = $.trim($(this).val());
            var site_url = $('#site_url').val();
            var thana = $(this).data('thana');
            $.ajax({
                url: site_url + '/weapons/get_thanas',
                type: 'get',
                dataType: 'json',
                cache: true,
                data: {
                    district: district
                }
            }).done(function (response) {
                var th = '';
                for (var i = 0; i < response.length; i++) {
                    th += '<option value="' + response[i]['id'] + '">' + response[i]['thana'] + '</option>';
                }
                $('#' + thana).html(th);
                $('#' + thana).selectpicker('refresh');
            });
        });
    });
</script>