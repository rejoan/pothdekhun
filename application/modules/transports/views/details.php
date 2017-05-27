<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="route_detail" class="col-sm-6 col-sm-push-3">
    <form  class="form-horizontal" action="<?php echo $action; ?>" method="get">
        <div class="box box-poth">
            <div class="box-header with-border">
                <p><?php echo lang('poribohon_info') . ':</p> <h3><span class="label label-info">' . mb_convert_case($poribohon[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8'); ?></h3>
            </div>
            <div class="box-body">
                <p><?php echo lang('vehicle_name'); ?></p>
                <h3 class="margin_top"><?php echo mb_convert_case($poribohon[$this->nl->lang_based_data('bn_name', 'name')], MB_CASE_TITLE, 'UTF-8'); ?></h3>
                <hr/>
                <p><?php echo lang('available_route'); ?></p>
                <ul class="list-group">
                    <?php foreach ($routes as $route): ?>
                        <?php
                        $url_title = $route[$this->nl->lang_based_data('fp_bn', 'from_place')] . ' ' . lang('to_view') . ' ' . $route[$this->nl->lang_based_data('tp_bn', 'to_place')] . ' ' . $route[$this->nl->lang_based_data('bn_name', 'name')];
                        ?>
                        <li class="list-group-item"><?php echo mb_convert_case($route[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($route[$this->nl->lang_based_data('district_name_bn', 'district_name')], MB_CASE_TITLE, 'UTF-8') . ' <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> ' . mb_convert_case($route[$this->nl->lang_based_data('tp_bn', 'to_place')], MB_CASE_TITLE, 'UTF-8') . ', ' . mb_convert_case($route[$this->nl->lang_based_data('td_bn_name', 'td_name')], MB_CASE_TITLE, 'UTF-8'); ?> <a class="btn btn-xs btn-info" href="<?php echo site_url_tr('routes/show/') . $route['r_id'] . '/' . unicode_title($url_title); ?>"><?php echo lang('about_detail'); ?></a></li>

                    <?php endforeach; ?>
                </ul>
                <hr/>
                <div class="row custom_margin">
                    <div class="col-md-6">
                        <?php
                        echo lang('available_counter');
                        if (!empty($total_counter)) {
                            echo ' (' . $total_counter . ')';
                        }
                        ?>
                    </div>
                    <div class="col-md-6">
                        <select id="district_filt" class="form-control" name="d" data-width="100%" data-live-search="true">
                            <option value="0">Search Counter by District</option>
                            <?php foreach ($districts as $d): ?>
                                <option value="<?php echo $d['id']; ?>" <?php echo $this->input->get('d') == $d['id'] ? 'selected="yes"' : ''; ?>>
                                    <?php echo $d[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>


                <ul class="list-group">
                    <?php
                    if (empty($counters)) {
                        echo '<li class="list-group-item">No counter Added</li>';
                    }
                    ?>
                    <?php foreach ($counters as $counter): ?>
                        <li class="list-group-item"><?php echo $counter['address'] . ', ' . $counter[$this->nl->lang_based_data('thana_bn', 'thana')] . ', ' . $counter[$this->nl->lang_based_data('bn_name', 'name')]; ?></li>
                    <?php endforeach; ?>
                </ul>
                <p><?php echo lang('added_by'); ?></p>
                <h3 class="margin_top"><?php echo mb_convert_case($poribohon['username'], MB_CASE_TITLE, 'UTF-8'); ?></h3>
                <hr/>

            </div>
            <div class="box-footer">
                <?php if ($this->session->user_id): ?>
                    <a href="<?php echo site_url_tr('transports/edit') . '/' . $poribohon['id']; ?>" class="btn btn-block btn-info"><?php echo lang('edit'); ?></a>
                <?php endif; ?>
                <?php if ($this->nl->is_admin()): ?>
                    <a href="<?php echo site_url_tr('transports/accept') . '/' . $poribohon['id']; ?>" class="btn btn-block btn-info">Accept</a>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>
<input type="hidden" id="en_segment" value="<?php echo unicode_title($poribohon['name']); ?>"/>
<input type="hidden" id="bn_segment" value="<?php echo unicode_title($poribohon['bn_name']); ?>"/>
<script src="<?php echo base_url('assets/js/jquery-3.2.0.min.js'); ?>"></script>
<script>
    $(document).ready(function () {

<?php if ($counters > 4): ?>
            $('#district_filt').change(function () {
                $('form').submit();
            });
<?php endif; ?>
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
                    $(this).prop('href', new_href);
                }
            } else {
                if (lan_code == 'bn') {
                    var new_href = href.replace(segment, bn_segment);
                    $(this).prop('href', new_href);
                }
            }
        });
    });
</script>
