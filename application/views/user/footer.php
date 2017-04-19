<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$f_class = $this->router->fetch_class();
$f_method = $this->router->fetch_method();
?>
<input type="hidden" id="pd_stu" value="<?php echo site_url_tr(); ?>" />
<input type="hidden" id="pd_btu" value="<?php echo base_url(); ?>"/>
<input type="hidden" id="mn_nm" value="<?php echo $f_method; ?>"/>
<input type="hidden" id="cl_nm" value="<?php echo $f_class; ?>"/>
<input type="hidden" id="email_text" value="<?php echo lang('email_text'); ?>"/>
<input type="hidden" id="email_exist" value="<?php echo lang('email_exist'); ?>"/>
<input type="hidden" id="find_fb" value="<?php echo lang('find_fb'); ?>"/>
<input type="hidden" id="find_tw" value="<?php echo lang('find_tw'); ?>"/>
<!--</div> col-xs-12 end-->


</div><!-- row-->
<footer class="footer">
    <div id="footer_section" class="row">
        <div class="col-md-6">
            <ul class="footer_nav" id="custom_margin">
                <li>&copy; Copyright PothDekhun <?php echo date('Y'); ?></li>
                <li><a href="<?php echo site_url_tr('pages/about-us'); ?>"><?php echo lang('about_us'); ?></a></li>
                <li><a href="<?php echo site_url_tr('pages/contact-us'); ?>"><?php echo lang('contact_us'); ?></a></li>
<!--                <li><a href="<?php //echo site_url_tr('pages/point-rules');          ?>"><?php //echo lang('point_rules');          ?></a></li>-->
                <li><a href="<?php echo site_url_tr('pages/privacy-policy'); ?>"><?php echo lang('privacy_policy'); ?></a></li>

            </ul>
        </div>
        <div class="col-md-6">
            <ul class="footer_nav">
                <li class="no-margin"><h4><?php echo lang('mobile_app'); ?></h4></li>
                <li><a target="_blank" href="https://play.google.com/store/apps/details?id=com.pothdekhun.android"><img class="img-responsive" alt="" src="<?php echo base_url('assets/images/google_play_badge_122_38.png'); ?>"/></a></li>
            </ul>
        </div>
    </div>
</footer>

</div><!--/.container-->

<a target="_blank" id="social_link1" href="https://www.facebook.com/PothDekhun"><img src="<?php echo base_url('assets/images/facebook.png'); ?>" alt="Facebook"/></a>
<a target="_blank" id="social_link2" href="https://www.twitter.com/PothDekhun"><img src="<?php echo base_url('assets/images/twitter.png'); ?>" alt="Twitter"/></a>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script async type="text/javascript" src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js'); ?>"></script>
<?php if (($f_class == 'routes' || $f_class == 'transports' || $f_class == 'profile') && ($f_method == 'add' || $f_method == 'edit') || $f_method == 'all' || $f_method == 'show'): ?>
    <script async type="text/javascript" src="<?php echo base_url('assets/plugins/jQueryUI/jquery-ui.min.js'); ?>"></script>
    <script async type="text/javascript" src="<?php echo base_url('assets/js/bootstrap/bootstrap.file-input.js'); ?>"></script>
    <script async type="text/javascript" src="<?php echo base_url('assets/bootstrap-sweetalert/dist/sweetalert.min.js'); ?>"></script>
    <script async type="text/javascript" src="<?php echo base_url('assets/plugins/fancybox/jquery.fancybox.pack.js'); ?>"></script>
<?php endif; ?>
<script async type="text/javascript" src="<?php echo base_url('assets/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script async type="text/javascript" src="<?php echo base_url('assets/js/bootstrap/bootstrap-select.min.js'); ?>"></script>
<script async type="text/javascript" src="<?php echo base_url('assets/js/val_lib.js'); ?>"></script>
<script async type="text/javascript" src="<?php echo base_url('assets/js/sturgon-slider-1.2.1.min.js?v=2.5'); ?>"></script>
<script async type="text/javascript" src="<?php echo base_url('assets/js/bootstrap/tooltip.min.js'); ?>"></script>
<?php if ($this->ua->is_mobile()): ?>
    <script type="text/javascript">
            $(window).on('load', function () {
                $('#ploader').fadeOut('slow');
            });
    </script>
<?php endif; ?>
<script async type="text/javascript" src="<?php echo base_url('assets/js/jquery-migrate-1.4.1.min.js'); ?>"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script async type="text/javascript" src="<?php echo base_url('assets/js/ie10-viewport-bug-workaround.js'); ?>"></script>
</body>
</html>