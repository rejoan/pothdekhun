<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="route_detail" class="col-xs-12 col-md-6">
    <?php
    $message = $this->session->flashdata('message');
    if ($message) {
        echo '<div class="alert alert-warning">' . $message . '</div>';
    }
    ?>
    <div class="box box-poth">
        <div class="box-header with-border">
            <p><?php echo lang('route_info') . ':</p> <h4><span class="label label-info">' . mb_convert_case($route[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($route[$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8') . '</span> ' . lang('to_view') . ' <span class="label label-info">' . mb_convert_case($route[$this->nl->lang_based_data('tp_bn', 'to_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($route[$this->nl->lang_based_data('td_bn_name', 'td_name')], MB_CASE_TITLE, 'UTF-8') . '</span>'; ?></h4>
        </div>
        <div class="box-body">
            <div class="row">
                <?php if (!empty($route['evidence'])): ?>
                    <div class="col-md-4">
                        <a class="fancybox" href="<?php echo base_url('evidences') . '/' . $route['evidence']; ?>"><img class="img-responsive img-thumbnail" src="<?php echo base_url('evidences') . '/' . $route['evidence']; ?>" alt="<?php echo $route['evidence']; ?>"/></a>
                    </div>
                <?php endif; ?>
                <?php if (!empty($route['evidence2'])): ?>
                    <div class="col-md-4">
                        <a class="fancybox" href="<?php echo base_url('evidences') . '/' . $route['evidence2']; ?>"><img class="img-responsive img-thumbnail" src="<?php echo base_url('evidences') . '/' . $route['evidence2']; ?>" alt="<?php echo $route['evidence2']; ?>"/></a>
                    </div>
                <?php endif; ?>
            </div>
            <p class="no-margin"><?php echo lang('transport_type'); ?></p>
            <h3 class="margin_top"><?php echo get_tr_type($route['transport_type']); ?></h3>
            <hr/>
            <p><?php echo lang('vehicle_name'); ?></p>
            <h3 class="margin_top"><a href="<?php echo site_url_tr('transports/show') . '/' . $route['poribohon_id']; ?>"><?php echo mb_convert_case($route[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8'); ?></a></h3>
            <hr/>
            <p><?php echo lang('departure_place'); ?></p>
            <h3 class="margin_top"><?php echo mb_convert_case($route[$this->nl->lang_based_data('tp_bn', 'to_place')], MB_CASE_TITLE, 'UTF-8'); ?></h3>
            <hr/>
            <p><?php echo lang('destination_place'); ?></p>
            <h3 class="margin_top"><?php echo mb_convert_case($route[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8'); ?></h3>
            <hr/>
            <p><?php echo lang('main_rent'); ?></p>
            <h3 class="margin_top"><?php echo $route['rent']; ?></h3>
            <hr/>
            <p><?php echo lang('departure_time'); ?></p>
            <h3 class="margin_top"><?php echo $route['departure_time'] == 1 ? lang('after_while') : $route['departure_time']; ?></h3>
            <hr/>
            <h4><?php echo lang('stoppages') . ' ' . lang('or') . ' ' . lang('via'); ?></h4>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo lang('place_name'); ?></th>
                            <th><?php echo lang('comment'); ?></th>
                            <th><?php echo lang('main_rent'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stoppages as $s):$segment++; ?>
                            <tr>
                                <th><?php echo $segment; ?></th>
                                <td><?php echo $s['place_name']; ?></td>
                                <td><?php echo $s['comments']; ?></td>
                                <td><?php echo $s['rent']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <hr/>
            <p><?php echo lang('guess_distance'); ?></p>
            <h3 class="margin_top"><?php echo ($route['distance'] / 1000) . $this->nl->lang_based_data(' কি.মি', ' KM'); ?></h3>
            <hr/>
            <p><?php echo lang('guess_duration'); ?></p>
            <h3 class="margin_top"><?php echo $this->nl->seconds_to_time($route['duration']); ?></h3>
        </div>
        <div class="box-footer">
            <div class="row">

                <?php if ($route['translation_status'] < 3): ?>
                    <div class="col-xs-5">
                        <a href="<?php echo site_url($lang_url . 'routes/edit') . '/' . $route['r_id']; ?>" class="btn btn-info btn-block"><i class="fa fa-language"></i> <?php echo lang('translate'); ?></a>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->user_id): ?>
                <div class="col-xs-5">
                    <a href="<?php echo site_url_tr('routes/edit') . '/' . $route['r_id']; ?>" class="btn btn-info"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></a>  
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
                        <input type="hidden"  name="pd_identity" value="<?php echo $this->encryption->encrypt($this->uri->segment(3)); ?>"/>
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
