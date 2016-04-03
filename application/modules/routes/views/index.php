<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xs-12 col-md-6">
    <div class="box box-poth">
        <div class="box-header">
            <?php echo lang('see_transport'); ?>
        </div>
        <div class="box-body">
            <!-- route info pull form -->
            <form action="<?php echo $action_pull; ?>" method="get" accept-charset="UTF-8">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-10 col-md-3">
                            <div class="form-group">
                                <select name="fd" class="selectpicker districts" data-width="100%" data-live-search="true">
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
                                <select name="ft" class="selectpicker thanas" data-width="100%" data-live-search="true" >
                                    <?php foreach ($thanas as $t): ?>
                                        <option  value="<?php echo $t['id']; ?>" <?php echo $t['id'] == '493' ? 'selected="yes"' : ''; ?>>
                                            <?php echo $t[$name]; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-10 col-md-6">
                            <input type="text" class="form-control" id="from_place" placeholder="<?php echo lang('from_push'); ?>" name="f" required title="যেখান থেকে  যাবেন সেই জায়গার নাম দিন" autocomplete="off">
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
                                <select name="td" class="selectpicker districts" data-width="100%" data-live-search="true">
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
                                <select name="th" class="selectpicker thanas" data-width="100%" data-live-search="true">
                                    <?php foreach ($thanas as $t): ?>
                                        <option  value="<?php echo $t['id']; ?>" <?php echo $t['id'] == '509' ? 'selected="yes"' : ''; ?>>
                                            <?php echo $t[$name]; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-10 col-md-6">
                            <input type="text" class="form-control" id="to_place" placeholder="<?php echo lang('device_to'); ?>" name="t" required title="যেখানে যাবেন সেই জায়গার নাম দিন" autocomplete="off">
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
            <?php echo lang('add_transport_text'); ?>
        </div>
        <div class="box-body">
            <!-- get route info from user form -->
            <form id="provide_poth" action="<?php echo $action_groute; ?>" method="post" accept-charset="UTF-8">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-10 col-md-3">
                            <div class="form-group">
                                <select name="fd" class="selectpicker districts" data-width="100%" data-live-search="true">
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
                                <select name="ft" class="selectpicker thanas" data-width="100%" data-live-search="true" >
                                    <?php foreach ($thanas as $t): ?>
                                        <option  value="<?php echo $t['id']; ?>" <?php echo $t['id'] == '493' ? 'selected="yes"' : ''; ?>>
                                            <?php echo $t[$name]; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-10 col-md-6">
                            <input type="text" class="form-control" id="from_place" placeholder="<?php echo lang('from_push'); ?>" name="f" required title="যেখান থেকে  যাবেন সেই জায়গার নাম দিন" autocomplete="off">
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
                <div id="lang_error" class="form-group">
                    <div class="row">
                        <div class="col-xs-10 col-md-3">
                            <div class="form-group">
                                <select name="td" class="selectpicker districts" data-width="100%" data-live-search="true">
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
                                <select name="th" class="selectpicker thanas" data-width="100%" data-live-search="true">
                                    <?php foreach ($thanas as $t): ?>
                                        <option  value="<?php echo $t['id']; ?>" <?php echo $t['id'] == '509' ? 'selected="yes"' : ''; ?>>
                                            <?php echo $t[$name]; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-10 col-md-6">
                            <input type="text" class="form-control" id="to_place" placeholder="<?php echo lang('device_to'); ?>" name="t" required title="যেখানে যাবেন সেই জায়গার নাম দিন" autocomplete="off">
                            <div id="suggestion_to" class="list-group">

                            </div>
                        </div>
                    </div>
                </div>

                <input type="submit" name="push_route" class="btn btn-primary btn-lg btn-info" value="<?php echo lang('add_transport_button'); ?>"/>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.districts').change(function () {
            var district = $.trim($(this).val());
            var site_url = $('#site_url').val();
            xhr = $.ajax({
                context: this,
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
                $(this).closest('select').html(th);
                var see = $(this).parent().parent().siblings().find('.thanas').html();
                alert(see);
                //return false;
                $(this).next().closest('select').selectpicker('refresh');
            });
        });
    });
</script>