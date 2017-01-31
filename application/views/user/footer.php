<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<input type="hidden" id="pd_stu" value="<?php echo site_url_tr(); ?>" />
<input type="hidden" id="pd_btu" value="<?php echo base_url(); ?>"/>
<input type="hidden" id="email_text" value="<?php echo lang('email_text'); ?>"/>
<input type="hidden" id="email_exist" value="<?php echo lang('email_exist'); ?>"/>

</div><!-- col-->


</div><!-- row-->
<footer class="footer">
    <div id="footer_section" class="row">
        <div class="col-xs-12">
            <ul id="footer_nav">
                <li>&copy; Copyright PothDekhun <?php echo date('Y');?></li>
                <li><a href="<?php echo site_url_tr('pages/about_us'); ?>"><?php echo lang('about_us'); ?></a></li>
                <li><a href="<?php echo site_url_tr('pages/contact_us'); ?>"><?php echo lang('contact_us'); ?></a></li>
                <li><a href="<?php echo site_url_tr('pages/point_rules'); ?>"><?php echo lang('point_rules'); ?></a></li>
            </ul>
        </div>
    </div>
</footer>

</div><!--/.container-->

<a target="_blank" id="social_link1" href="https://www.facebook.com/PothDekhun"><img src="http://www.webcoachbd.com/templates/protostar/images/facebook.png" alt="ফেইসবুক"/></a>
        <a target="_blank" id="social_link2" href="https://www.twitter.com/PothDekhun"><img src="http://www.webcoachbd.com/templates/protostar/images/twitter.png" alt="টুইটার"/></a>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jQueryUI/jquery-ui.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap/bootstrap-select.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap/bootstrap.file-input.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap-sweetalert/dist/sweetalert.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/val_lib.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/poth.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap/tooltip.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/fancybox/jquery.fancybox.pack.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-migrate-1.4.1.min.js'); ?>"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script type="text/javascript" src="<?php echo base_url('assets/js/ie10-viewport-bug-workaround.js'); ?>"></script>
</body>
</html>