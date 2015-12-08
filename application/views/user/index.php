<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xs-12 col-md-6">
    <div class="box box-poth">
        <div class="box-header">
            <?php echo $this->lang->line('see_transport'); ?>
        </div>
        <div class="box-body">
            <!-- route info pull form -->
            <form action="<?php echo $action_pull; ?>" method="get">
                <div class="form-group">
                    <input type="text" class="form-control" id="fromName" placeholder="<?php echo $this->lang->line('from_push'); ?>" name="f" required title="যেখান থেকে  যাবেন সেই জায়গার নাম দিন">
                </div>
                <div class="form-group">
                    <label>
                        <?php echo $this->lang->line('from_view'); ?>
                    </label>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="toName" placeholder="<?php echo $this->lang->line('to_push'); ?>" name="t" required title="যেখানে যাবেন সেই জায়গার নাম দিন">
                </div>
                <input type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo $this->lang->line('see_transport_button'); ?>"/>
            </form>
        </div>
    </div>
    <div class="box box-poth">
        <div class="box-header">
            <?php echo $this->lang->line('add_transport_text'); ?>
        </div>
        <div class="box-body">
            <!-- get route info from user form -->
            <form id="provide_poth" action="<?php echo $action_groute; ?>" method="post">
                <div class="form-group">
                    <input id="from_push" type="text" class="form-control" name="from_push" placeholder="<?php echo $this->lang->line('from_push'); ?>" required title="যেখান থেকে  যাবে সেই জায়গার নাম দিন">
                </div>
                <div class="form-group">
                    <label>
                        <?php echo $this->lang->line('from_view'); ?>
                    </label>
                </div>
                <div id="lang_error" class="form-group">
                    <input id="to_push" type="text" class="form-control" name="to_push" placeholder="<?php echo $this->lang->line('to_push'); ?>" required title="যেখানে  যাবে সেই জায়গার নাম দিন">
                </div>

                <input type="submit" name="push_route" class="btn btn-primary btn-lg btn-info" value="<?php echo $this->lang->line('add_transport_button'); ?>"/>
            </form>
        </div>
    </div>
</div>
