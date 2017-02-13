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
        <div class="col-xs-12">
            <ul id="footer_nav">
                <li>&copy; Copyright PothDekhun <?php echo date('Y'); ?></li>
                <li><a href="<?php echo site_url_tr('pages/about-us'); ?>"><?php echo lang('about_us'); ?></a></li>
                <li><a href="<?php echo site_url_tr('pages/contact-us'); ?>"><?php echo lang('contact_us'); ?></a></li>
                <li><a href="<?php echo site_url_tr('pages/point-rules'); ?>"><?php echo lang('point_rules'); ?></a></li>
                <li><a href="<?php echo site_url_tr('pages/privacy-policy'); ?>"><?php echo lang('privacy_policy'); ?></a></li>
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

<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js'); ?>"></script>
<?php if (($f_class == 'routes' || $f_class == 'transports' || $f_class == 'profile') && ($f_method == 'add' || $f_method == 'edit') || $f_method == 'all' || $f_method == 'show'): ?>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jQueryUI/jquery-ui.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap/bootstrap.file-input.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/bootstrap-sweetalert/dist/sweetalert.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/fancybox/jquery.fancybox.pack.js'); ?>"></script>
<?php endif; ?>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap/bootstrap-select.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/val_lib.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/sturgon-slider-1.2.1.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap/tooltip.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-migrate-1.4.1.min.js'); ?>"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script type="text/javascript" src="<?php echo base_url('assets/js/ie10-viewport-bug-workaround.js'); ?>"></script>
</body>
</html>