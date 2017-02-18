<div id="compalin" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="verify_form" role="form" action="#" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?php echo lang('verify'); ?></h4>
                </div>
                <?php if ($this->session->user_id) { ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <select id="latest_status" name="ls" class="selectpicker" data-width="100%">
                                <option value="0"><?php echo lang('select'); ?></option>
                                <option value="1"><?php echo lang('route_closed'); ?></option>
                                <option value="2"><?php echo lang('transport_closed'); ?></option>
                                <option value="3"><?php echo lang('tempo_closed'); ?></option>
                                <option value="4"><?php echo lang('route_change'); ?></option>
                                <option value="5"><?php echo lang('complete_wrong'); ?></option>
                                <option value="6"><?php echo lang('partial_correct'); ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('proof'); ?></label>
                            <textarea id="note" name="note" class="form-control" rows="3" placeholder="<?php echo lang('proof_des');?>"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-info" name="submit" value="<?php echo lang('add_button'); ?>">
                    </div>
                <?php } else { ?>
                    <div class="modal-body">
                        <h4 class="alert alert-success header_linehight"><?php echo lang('plez_login'); ?></h4>
                        <a class="btn btn-info btn-lg" href="<?php echo site_url_tr('auth/login'); ?>"><?php echo lang('complain_login'); ?></a>
                    </div>
                <?php } ?>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->