<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="route_detail" class="col-sm-6 col-sm-push-3">
    <?php
    $message = $this->session->flashdata('message');
    if ($message) {
        echo '<div class="alert alert-warning">' . $message . '</div>';
    }
    $fp = mb_convert_case($route[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8');
    $from_p = $this->nl->enc($route['from_place']);
    //echo 
    $ftn = mb_convert_case($route[$this->nl->lang_based_data('thana_name_bn', 'thana_name')], MB_CASE_TITLE, 'UTF-8');

    $fds = mb_convert_case($route[$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8');

    $tp = mb_convert_case($route[$this->nl->lang_based_data('tp_bn', 'to_place')], MB_CASE_TITLE, 'UTF-8');
    $thn = mb_convert_case($route[$this->nl->lang_based_data('th_thana_name_bn', 'th_thana_name')], MB_CASE_TITLE, 'UTF-8');

    $tdn = mb_convert_case($route[$this->nl->lang_based_data('td_bn_name', 'td_name')], MB_CASE_TITLE, 'UTF-8');
    ?>
    <div class="box box-poth">
        <div id="details_header" class="box-header with-border">
            <p><?php echo lang('route_info') . ': <a data-toggle="tooltip" data-placement="top" title="Google Map Direction" class="btn btn-sm bg-purple" href="' . site_url_tr('routes/map/?fp=' . $from_p . '&ftn=' . str_replace(' ', '+', trim($route['thana_name'])) . '&fds=' . str_replace(' ', '+', trim($route['district_name'])) . '&tp=' . str_replace(' ', '+', trim($route['to_place'])) . '&thn=' . str_replace(' ', '+', trim($route['th_thana_name'])) . '&tdn=' . str_replace(' ', '+', trim($route['td_name']))) . '"><span class="glyphicon glyphicon-map-marker"></span> Google Map</a></p> <div class="row no-margin"><div class="col-md-6 bg-orange">' . $fp . ', ' . $ftn . ', ' . $fds . '</div><div class="col-md-1">'.lang('to_view').'</div> <div class="col-md-5 bg-orange">' . $tp . ', ' . $thn . ', ' . $tdn . '</div>'; ?></div>
    </div>
    <div class="box-body">
        <div class="row custom_margin">
            <?php
            if (!empty($route['evidence'])):
                $path = base_url('evidences') . '/' . $route['evidence'];
                $path_thumb = base_url('thumbs') . '/' . $route['evidence'];
//                $type = pathinfo($path, PATHINFO_EXTENSION);
//                $evidence = file_get_contents($path);
//                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($evidence);
                ?>
                <div class="col-md-4">
                    <a class="fancybox" data-fancybox="group" data-caption="<?php echo $route['r_id']; ?>" href="<?php echo $path; ?>"><img class="img-responsive img-thumbnail" src="<?php echo $path_thumb; ?>" alt="<?php echo mb_convert_case($route[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8'); ?>"/></a>
                </div>
            <?php endif; ?>
            <?php
            if (!empty($route['evidence2'])):
                $path2 = base_url('evidences') . '/' . $route['evidence2'];
                $path_thumb2 = base_url('thumbs') . '/' . $route['evidence2'];
//                $type2 = pathinfo($path2, PATHINFO_EXTENSION);
//                $evidence2 = file_get_contents($path2);
//                $base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($evidence2);
                ?>
                <div class="col-md-4">
                    <a class="fancybox" data-fancybox="group" data-caption="<?php echo $route['r_id']; ?>" href="<?php echo $path2; ?>"><img class="img-responsive img-thumbnail" src="<?php echo $path_thumb2; ?>" alt="<?php echo mb_convert_case($route[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8'); ?>"/></a>
                </div>
            <?php endif; ?>
        </div>
        <div class="row custom_margin">
            <div class="col-md-3">
                <p class="no-margin"><?php echo lang('transport_type'); ?></p>
            </div>
            <div class="col-md-9">
                <h4 class="no-margin"><?php echo get_tr_type($route['transport_type']); ?></h4>
            </div>


        </div>
        <div class="row custom_margin">
            <div class="col-md-3">
                <p><?php echo lang('vehicle_name'); ?></p>
            </div>
            <div class="col-md-9">
                <h4 class="no-margin"><a href="<?php echo site_url_tr('transports/show') . '/' . $route['poribohon_id'] . '/' . unicode_title($route[$this->nl->lang_based_data('bn_name', 'name')]); ?>"><?php echo mb_convert_case($route[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8'); ?></a></h4>
            </div>
        </div>

        <div class="row custom_margin">
            <div class="col-md-3">
                <p><?php echo lang('feature'); ?></p>
            </div>
            <div class="col-md-9">
                <?php
                $amn = explode(',', $route['amenities']);
                $amenities = array(
                    'ac' => lang('ac'),
                    'normal_ac' => lang('normal'),
                    'scania' => lang('scania'),
                    'volvo' => lang('volvo'),
                    'hino_1j' => lang('hino_1j'),
                    'rm2' => lang('rm2'),
                    'mercedes_benz' => lang('mercedes_benz'),
                    'hyundai' => lang('hyundai'),
                    'non_ac' => lang('nac'),
                    'gate_lock' => lang('gatelock'),
                    'chair' => lang('chair'),
                    'semi' => lang('semi'),
                    'local' => lang('local'),
                    'acunknown' => lang('acunknown'),
                    'mail' => lang('mail')
                );
                foreach ($amn as $key => $am):
                    ?>
                    <span class="label label-default"><?php echo $amenities[$am]; ?></span>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="row custom_margin">
            <div class="col-md-3">
                <p><?php echo lang('departure_place'); ?></p>
            </div>
            <div class="col-md-9">
                <h4 class="no-margin"><?php echo mb_convert_case($route[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8'); ?></h4>
            </div>


        </div>
        <div class="row custom_margin">
            <div class="col-md-3">
                <p><?php echo lang('destination_place'); ?></p>
            </div>
            <div class="col-md-9">
                <h4 class="no-margin"><?php echo mb_convert_case($route[$this->nl->lang_based_data('tp_bn', 'to_place')], MB_CASE_TITLE, 'UTF-8'); ?></h4>
            </div>


        </div>

        <div class="row custom_margin">
            <div class="col-md-3">
                <p><?php echo lang('main_rent'); ?></p>

            </div>
            <div class="col-xs-4">
                <h4 class="no-margin"><?php echo $route['rent'] . ' ' . lang('tk'); ?></h4>
            </div>
            <?php if ($this->session->user_id) { ?>
                <div id="fare_verfication" class="col-xs-4">
                    <small id="pd_crc" class="text-muted text-success"><?php echo $route['fare_upvote']; ?></small>
                    <a data-pd_fp="pd_fpk" data-toggle="tooltip" data-placement="top" title="<?php echo lang('fare_ok'); ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-thumbs-up"></span></a>
                    <a data-pd_fp="pd_fpnk" data-toggle="tooltip" data-placement="top" title="<?php echo lang('fare_not_ok'); ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-thumbs-down"></span></a>
                    <small id="pd_wrn" class="text-muted text-danger"><?php echo $route['fare_downvote']; ?></small>
                </div>
            <?php } else { ?>
                <div class="col-xs-4">
                    <a data-toggle="modal" data-target="#compalin" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-thumbs-up"></span></a>
                    <a data-toggle="modal" data-target="#compalin" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-thumbs-down"></span></a>
                </div>
            <?php } ?>
        </div>


        <div class="row custom_margin">
            <div class="col-md-3">
                <p><?php echo lang('departure_time'); ?></p>
            </div>
            <div class="col-md-9">
                <h4 class="no-margin"><?php echo $route['departure_time'] == 1 ? lang('after_while') : $route['departure_time']; ?></h4>
            </div>
        </div>

        <div class="row custom_margin">
            <div class="col-xs-12">
                <h4><?php echo lang('stoppages') . ' ' . lang('or') . ' ' . lang('via'); ?></h4>
            </div>
            <div class="col-xs-12">
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo lang('place_name'); ?></th>
                                    <th><?php echo lang('comment'); ?></th>
                                    <th><?php echo lang('main_rent'); ?></th>
    <!--                                    <th><?php //echo lang('fare_verify');                                       ?></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stoppages as $s):$segment++; ?>
                                    <tr>
                                        <th><?php echo $segment; ?></th>
                                        <td><?php echo $s['place_name']; ?></td>
                                        <td><?php echo $s['comments']; ?></td>
                                        <td>
                                            <?php echo $s['rent'] . ' ' . lang('tk'); ?>
                                        </td>
        <!--                                        <td>
                                            <a data-toggle="tooltip" data-placement="top" title="<?php //echo lang('fare_ok');                                       ?>" class="btn btn-success btn-xs"><i class="fa fa-thumbs-up"></i></a>
                    <a data-toggle="tooltip" data-placement="top" title="<?php //echo lang('fare_not_ok');                                       ?>" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-down"></i></a>
                                        </td>-->
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row custom_margin">
            <div class="col-md-4">
                <p><?php echo lang('guess_distance'); ?></p>
            </div>
            <div class="col-md-8">
                <p class="no-margin"><?php echo ($route['distance'] / 1000) . $this->nl->lang_based_data(' কি.মি', ' KM'); ?> <small class="text-muted">[<?php echo lang('by_google'); ?>]</small></p>
            </div>
        </div>

        <div class="row custom_margin">
            <div class="col-md-4">
                <p><?php echo lang('guess_duration'); ?></p>
            </div>
            <div class="col-md-8">
                <p class="no-margin"><?php echo $this->nl->seconds_to_time($route['duration']); ?><small class="text-muted">[<?php echo lang('by_google'); ?>]</small></p>

            </div>
            <div class="col-xs-2">

            </div>
        </div>
        <div class="row custom_margin">
            <div class="col-xs-4">
                <p><?php echo lang('added_by'); ?></p>
            </div>
            <div class="col-xs-5">
                <h4 class="no-margin"><a href="<?php echo site_url_tr('profile/show/') . $route['user_id']; ?>"><?php echo $route['username']; ?></a></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php
                if (!empty($prev['id'])):
                    $url_title = $prev[$this->nl->lang_based_data('fp_bn', 'from_place')] . ' ' . lang('to_view') . ' ' . $prev[$this->nl->lang_based_data('tp_bn', 'to_place')] . ' ' . $prev[$this->nl->lang_based_data('bn_name', 'name')];
                    ?>
                    <a class="btn btn-sm btn-warning" href="<?php echo site_url_tr('routes/show/') . $prev['id'] . '/' . unicode_title($url_title); ?>"><span class="glyphicon glyphicon-arrow-left"></span> <?php echo lang('prev_route'); ?></a>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <?php
                if (!empty($next['id'])):
                    $url_title_next = $next[$this->nl->lang_based_data('fp_bn', 'from_place')] . ' ' . lang('to_view') . ' ' . $next[$this->nl->lang_based_data('tp_bn', 'to_place')] . ' ' . $next[$this->nl->lang_based_data('bn_name', 'name')];
                    ?>
                    <a class="btn btn-sm btn-warning <?php echo $this->ua->is_mobile() ? 'margin_top' : 'pull-right'; ?>" href="<?php echo site_url_tr('routes/show/') . $next['id'] . '/' . unicode_title($url_title_next); ?>"><?php echo lang('next_route'); ?> <span class="glyphicon glyphicon-arrow-right"></span></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="row">
            <?php if ($this->session->user_id): ?>
                <div class="col-xs-4">
                    <a href="<?php echo site_url_tr('routes/edit') . '/' . $route['r_id']; ?>" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span> <?php echo lang('edit'); ?></a>  
                </div>
            <?php endif; ?>
            <div class="col-xs-4">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#compalin"><span class="glyphicon glyphicon-pencil"></span> <?php echo lang('verify'); ?></button>
            </div>
            <?php if ($this->nl->is_admin()): ?>
                <div class="col-xs-4">
                    <a href="<?php echo site_url('route_manager/route_clone') . '/' . $route['r_id']; ?>" class="btn btn-info"><span class="glyphicon glyphicon-copy"></span> Clone</a>  
                </div>
            <?php endif; ?>
        </div>

    </div>

</div>
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo lang('comment'); ?></h3>
    </div>
    <!-- /.box-header -->
    <div id="comments" class="box-body direct-chat direct-chat-info">
        <div class="direct-chat-messages">
            <?php
            foreach ($comments as $c) {
                if (empty($c['avatar'])) {
                    $img = 'no_image.png';
                } else {
                    $img = $c['avatar'];
                }
                //var_dump($c['username']);return;
                if ($c['position'] == 'left') {
                    ?>
                    <div class="direct-chat-msg">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-left"><?php echo empty($c['username']) ? 'Social' : $c['username']; ?></span>
                            <span class="direct-chat-timestamp pull-right"><?php echo date('d M, y', strtotime($c['added'])); ?></span>
                        </div>
                        <!-- /.direct-chat-info -->
                        <img class="direct-chat-img" src="<?php echo base_url('avatars') . '/' . $img; ?>" alt="Message User Image"><!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                            <?php echo $c['comment']; ?>
                        </div>
                        <!-- /.direct-chat-text -->
                    </div>
                <?php } else { ?>
                    <div class="direct-chat-msg right">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-right"><?php echo empty($c['username']) ? 'Social' : $c['username']; ?></span>
                            <span class="direct-chat-timestamp pull-left"><?php echo date('d M, y', strtotime($c['added'])); ?></span>
                        </div>
                        <!-- /.direct-chat-info -->
                        <img class="direct-chat-img" src="<?php echo base_url('avatars') . '/' . $img; ?>" alt="Message User Image"><!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                            <?php echo $c['comment']; ?>
                        </div>
                        <!-- /.direct-chat-text -->
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <?php if ($this->session->user_id) { ?>
            <form role="form" action="<?php echo site_url_tr('comments/add'); ?>" method="POST">
                <!-- textarea -->
                <div class="form-group">
                    <label><?php echo lang('comment'); ?></label>
                    <textarea name="comment" class="form-control" rows="3" placeholder="Your Comment" required></textarea>
                </div>

                <div class="form-group">
                    <input id="pd_identity" type="hidden"  name="pd_identity" value="<?php echo $this->nl->enc($route['r_id']); ?>"/>
                    <input type="submit" class="btn btn-info" name="submit" value="<?php echo lang('add_button'); ?>">
                </div>
            </form>

        <?php } else { ?>
            <div class="col-xs-5">
                <a href="<?php echo site_url('auth/login'); ?>" class="btn btn-info btn-block"><?php echo lang('comment_login'); ?></a>
            </div>
        <?php } ?>
    </div>
    <!-- /.box-body -->
</div>
</div>
<?php $this->load->view('complain_modal'); ?>
<input type="hidden" id="en_segment" value="<?php echo unicode_title($route['from_place'] . ' to ' . $route['to_place'] . ' ' . $route['name']); ?>"/>
<input type="hidden" id="bn_segment" value="<?php echo unicode_title($route['fp_bn'] . ' থেকে ' . $route['tp_bn'] . ' ' . $route['bn_name']); ?>"/>
<script type="text/javascript">
    $(document).ready(function () {
        $('#lang_menu ul li a').hover(function () {
            var href = $(this).prop('href');
            var en_segment = $('#en_segment').val();
            var bn_segment = $('#bn_segment').val();
            var segment = href.substr(href.lastIndexOf('/') + 1);

            var cur_code = $('html').prop('lang');
            var lan_code = $(this).data('ln_code');
            if (cur_code == 'bn') {
                if (lan_code == 'en') {
                    var new_href = href.replace(segment, en_segment);
                    if ($.isNumeric(segment)) {
                        new_href = href;
                    }
                    $(this).prop('href', new_href);
                }
            } else {
                if (lan_code == 'bn') {
                    var new_href = href.replace(segment, bn_segment);
                    if ($.isNumeric(segment)) {
                        new_href = href;
                    }
                    $(this).prop('href', new_href);
                }
            }
        });
    });
</script>