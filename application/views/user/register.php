<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">

    <div class="col-xs-12 col-sm-8 col-md-6 col-md-offset-3 well">
        <!-- route info pull form -->
        <form class="form-horizontal" action="<?php echo $action; ?>" method="post">
            <div class="form-group">
                <label class="col-xs-3">ইউজার নাম</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" placeholder="ইউজার নাম" name="username" required title="আপনার ইউজার নাম দিন">
                </div>
            </div>
            <?php echo form_error('username', '<div class="alert alert-danger">', '</div>'); ?>

            <div class="form-group">
                <label class="col-xs-3">ইমেইল</label>
                <div class="col-xs-7">
                    <input type="email" class="form-control" placeholder="ইমেইল" name="email" required title="আপনার ইমেইল দিন">
                </div>
            </div>
            <?php echo form_error('email', '<div class="alert alert-danger">', '</div>'); ?>

            <div class="form-group">
                <label class="col-xs-3">মোবাইল</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" name="mobile" placeholder="মোবাইল">
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-3">পাসওয়ার্ড</label>
                <div class="col-xs-7">
                    <input type="password" class="form-control" placeholder="পাসওয়ার্ড" name="password" required title="পাসওয়ার্ড দিন">
                </div>
            </div>
            <?php echo form_error('password', '<div class="alert alert-danger">', '</div>'); ?>

            <div class="form-group">
                <label class="col-xs-3">আপনার ছবি</label>
                <div class="col-xs-7">
                    <input type="file" class="btn btn-warning" name="avatar">
                </div>
            </div>
            <input type="submit" class="btn btn-primary btn-lg btn-info" value="নিবন্ধন করুন"/>
        </form>
    </div>

</div><!--/row-->