<div id="compalin" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="verify_form" role="form" action="#" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?php echo lang('verify'); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select id="latest_status" name="ls" class="selectpicker" data-width="100%">
                            <option value="0"><?php echo lang('select'); ?></option>
                            <option value="1"><?php echo lang('route_closed'); ?></option>
                            <option value="2"><?php echo lang('transport_closed'); ?></option>
                            <option value="3"><?php echo lang('tempo_closed'); ?></option>
                            <option value="4"><?php echo lang('route_change'); ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php echo lang('note'); ?></label>
                        <textarea id="note" name="note" class="form-control" rows="3" placeholder="Your Comment" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default close" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-info" name="submit" value="<?php echo lang('add_button'); ?>">
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->