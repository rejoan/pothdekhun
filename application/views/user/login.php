<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-4 well">
        <!-- route info pull form -->
        <form class="form-horizontal" action="<?php echo $action; ?>" method="post">
            <div class="form-group">
                <div class="col-xs-10">
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input type="email" class="form-control" placeholder="ইমেইল" required title="আপনার ইমেইল ঠিকানা দিন">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-10">
                     <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
                    <input type="password" class="form-control" placeholder="পাসওয়ার্ড" required title="পাসওয়ার্ড দিন">
                     </div>
                </div>
            </div>
            <input type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="প্রবেশ"/>
        </form>
    </div>

</div><!--/row-->