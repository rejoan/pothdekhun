<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<input type="hidden" id="site_url" value="<?php echo site_url(); ?>" />
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>"/>
<input type="hidden" id="email_text" value="<?php echo $this->lang->line('email_text'); ?>"/>
<input type="hidden" id="email_exist" value="<?php echo $this->lang->line('email_exist'); ?>"/>

</div><!-- col-->
<footer>
    <p>&copy; Company 2014</p>
</footer>
</div><!-- row-->
</div><!--/.container-->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url('assets/js/jquery-2.1.4.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap/bootstrap-select.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap/bootstrap.file-input.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/val_lib.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/poth.js'); ?>"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo base_url('assets/js/ie10-viewport-bug-workaround.js'); ?>"></script>
</body>
</html>