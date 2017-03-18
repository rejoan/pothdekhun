<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="suggestion_page" class="col-sm-6 col-sm-push-3">

    <div id="poth_features" class="ticker_block">
        <ul>
            <li><strong><?php echo lang('thana_not_required'); ?></strong></li>
            <li><strong><?php echo lang('thana_not_dhaka'); ?></strong></li>
            <li><strong><?php echo lang('inspire_info'); ?></strong></li>
        </ul>
    </div>

    <?php
    $message = $this->session->flashdata('message');
    if ($message) {
        echo '<div class="alert alert-warning">' . $message . '</div>';
    }
    ?>
    <div class="box box-poth">
        <div class="box-header">
            <h5 class="no-margin header_linehight"><?php echo lang('main_search'); ?></h5>
            <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#search_tips"><?php echo lang('search_tips'); ?></button>
        </div>
        <div class="box-body">

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
                            <div id="tft" class="form-group">
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
                            <input type="text" class="form-control search_place" placeholder="<?php echo lang('departure_place'); ?>" name="f" title="Type Place Name Ex: Mirpur-1 " autocomplete="off">
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
                            <div id="tth" class="form-group">
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
                            <input type="text" class="form-control search_place" placeholder="<?php echo lang('destination_place'); ?>" name="t" title="Type target place Ex: Motijheel" autocomplete="off">
                            <div class="list-group suggestion">

                            </div>
                        </div>
                    </div>
                </div>
                <div id="consider_thana" class="form-group">
                    <label>
                        <input type="checkbox" name="c"> <?php echo lang('ignore_thana'); ?>
                    </label>
                </div>

                <input id="see_transport" type="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo lang('see_transport_button'); ?>" name="xyz"/>
            </form>
        </div>
    </div>
    <div class="box box-poth">
        <div class="box-header">
            <?php echo lang('place_search'); ?>
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
                        <input id="search_place" type="text" class="form-control" placeholder="<?php echo lang('place_search'); ?>" name="f" title="Any Place name" autocomplete="off">
                        <div class="list-group suggestion">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-3">
                        <input id="show_transport" type="submit" class="btn btn-primary btn-info bottom_top_margin" name="abc" value="<?php echo lang('show_transport'); ?>"/>  
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('video_modal'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#search_tips').on('hidden.bs.modal', function (e) {
            $('#search_tips iframe').attr('src', $('#search_tips iframe').attr('src'));
        });
        var screenWidth = window.screen.width;
        //screenHeight = window.screen.height;
        if (screenWidth < 800) {
            $('#poth_features ul').css({
                'margin': '30px 0 0 0',
                'height': '70px'
            });
        } else {
            $('#poth_features ul').css('height', '28px');
        }
        var lis = $('.ticker_block li'),
                cur = lis.first().addClass('active'),
                next = cur.next().addClass('next');
        cur.fadeIn(1000);
        function show_div() {
            cur.fadeOut({duration: 1000, queue: false}).animate({marginLeft: -20}).removeClass('active');
            cur = next.removeClass('next').css({marginLeft: 20}).fadeIn({duration: 2000, queue: false}).animate({marginLeft: 0}).addClass('active');
            next = cur.next();
            if (!next.length) {
                next = lis.first();
            }
            next.addClass('next');
        }
        timer = setInterval(show_div, 3000);
        $('#poth_features').on('mouseleave', function (ev) {
            timer = setInterval(show_div, 3000);
        });

        $('#poth_features').on('mouseenter', function (ev) {
            clearInterval(timer);
        });
    });
</script>
