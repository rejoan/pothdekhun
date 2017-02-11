<?php
$text_lang = $this->session->lang_name == 'bengali' ? lang('english') : lang('bangla');
$lang_code = $this->session->lang_name == 'bengali' ? 'en' : 'bn';
?>
<div id="route_add_rule" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="verify_form" role="form" action="#" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?php echo lang('3_rules'); ?></h4>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
			<li class="list-group-item list-group-item-warning custom_margin"><i class="fa fa-pencil"></i> <?php echo sprintf(lang('first_rule'), mb_convert_case($this->session->lang_name,MB_CASE_TITLE, 'UTF-8'), $text_lang);?></li>
                        <li class="list-group-item list-group-item-warning custom_margin"><i class="fa fa-pencil"></i> <?php echo lang('second_rule');?></li>
                        <li class="list-group-item list-group-item-warning"><i class="fa fa-pencil"></i> <?php echo lang('third_rule');?></li>
                    </ul>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
                    <a class="btn btn-lg btn-info" href="<?php echo current_url_tr($lang_code);?>"><?php echo lang('switch').' '. $text_lang;?></a>
                </div>

            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->