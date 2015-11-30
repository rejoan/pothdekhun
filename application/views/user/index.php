<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div style="margin-top: 20px;" class="alert alert-info">
    <p><?php echo $this->lang->line('see_transport'); ?></p>
</div>
<div class="row">
    <div class="col-xs-12 col-md-7 col-md-offset-4">
        <!-- route info pull form -->
        <form class="form-horizontal" action="<?php echo $action_pull; ?>" method="post">
            <div class="form-group">
                
                <div class="col-xs-10 col-md-6">
                    <input type="text" class="form-control" id="fromName" placeholder="গাবতলী, ঢাকা" required title="যেখান থেকে  যাবেন সেই জায়গার নাম দিন">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-10 col-md-6">
                    <label>
                        থেকে
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-10 col-md-6">
                    <input type="email" class="form-control" id="toName" placeholder="মতিঝিল, ঢাকা" required title="যেখানে যাবেন সেই জায়গার নাম দিন">
                </div>
            </div>
            <input type="submit" class="btn btn-primary btn-lg btn-warning" value="পরিবহন দেখুন"/>
        </form>
    </div>

</div><!--/row-->

<div style="margin-top: 20px;" class="alert alert-info">
    <h3>আপনার পরিচিত রুট যোগ করতে নিচের ফর্ম ব্যবহার করুন</h3>
</div>

<div class="row">
    <div class="col-xs-12 col-md-7 col-md-offset-4">

        <!-- get route info from user form -->
        <form id="provide_poth" class="form-horizontal" action="<?php echo $action_groute; ?>" method="post">
            <div class="form-group">
                <div class="col-xs-10 col-md-6">
                    <input id="from_push" type="text" class="form-control" name="from_push" placeholder="নাগেশ্বরী, কুড়িগ্রাম" required title="যেখান থেকে  যাবে সেই জায়গার নাম দিন">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-10 col-md-6">
                    <label>
                        থেকে
                    </label>
                </div>
            </div>
            <div id="lang_error" class="form-group">
                <div class="col-xs-10 col-md-6">
                    <input id="to_push" type="text" class="form-control" name="to_push" placeholder="চট্রগ্রাম" required title="যেখানে  যাবে সেই জায়গার নাম দিন">
                </div>
            </div>

            <input type="submit" name="push_route" class="btn btn-primary btn-lg btn-warning" value="পরিবহন তথ্য দিন"/>
        </form>
    </div>
</div><!--/row-->