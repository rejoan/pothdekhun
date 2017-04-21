<div id="how_search_work" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="verify_form" role="form" action="#" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?php echo lang('how_works'); ?></h4>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
			<li class="list-group-item list-group-item-warning custom_margin"><span class="glyphicon glyphicon-pencil"></span> <?php echo lang('search_rule1');?></li>
                        <li class="list-group-item list-group-item-warning custom_margin"><span class="glyphicon glyphicon-pencil"></span> <?php echo lang('second_rule');?></li>
                        <li class="list-group-item list-group-item-warning custom_margin"><span class="glyphicon glyphicon-pencil"></span> <?php echo lang('third_rule');?></li>
                         <li class="list-group-item list-group-item-warning"><span class="glyphicon glyphicon-asterisk"></span> <?php echo lang('final_rule');?></li>
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