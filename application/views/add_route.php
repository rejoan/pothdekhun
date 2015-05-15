<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div style="margin-top: 20px;" class="alert alert-warning">
    <h3>
        <?php if ($from == '' || $to == '') { ?>
            রুট তথ্য দিতে অনুগ্রহ করে নিচের তারকা চিহ্নিত ফিল্ডগুলি পূরন করুন
        <?php } else { ?>
            <strong><?php echo $from; ?></strong> থেকে  <strong><?php echo $to; ?></strong> এর রুট তথ্য দিতে অনুগ্রহ করে নিচের তারকা চিহ্নিত ফিল্ডগুলি পূরন করুন
        <?php } ?>

    </h3>
</div>
<div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
        <!-- route info push form -->
        <form id="add_route" class="form-horizontal" action="<?php echo $action; ?>" method="post">
            <?php if ($from == '' || $to == ''): ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label">থেকে <span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                    <div class="col-xs-10 col-md-6">
                        <input maxlength="200" type="text" class="form-control" name="device_from" placeholder="যেমন: খুলনা">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">পর্যন্ত <span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                    <div class="col-xs-10 col-md-6">
                        <input maxlength="200" type="text" class="form-control" name="device_to" placeholder="যেমন: সিলেট">
                    </div>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label class="col-sm-3 control-label">পরিবহনের ধরন <span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                <div class="col-xs-10 col-md-6">
                    <select name="type" class="selectpicker">
                        <option value="বাস">বাস</option>
                        <option value="ট্রেন">ট্রেন</option>
                        <option value="লেগুনা">লেগুনা</option>
                        <option value="বিমান">বিমান</option>
                        <option value="অন্য">অন্যকিছু</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">পরিবহনের নাম <span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                <div class="col-xs-10 col-md-6">
                    <input maxlength="200" type="text" class="form-control" name="transport_name" placeholder="যেমন: হানিফ এন্টারপ্রাইজ" required title="পরিবহনের নাম আবশ্যক">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">ছাড়ার স্থান</label>
                <div class="col-xs-10 col-md-6">
                    <input maxlength="200" type="text" class="form-control"  name="departure_place" placeholder="যেমন:  জাহাজ কোম্পানী মোড়">
                </div>
            </div>
            <div id="departure_perticular" class="form-group">
                <label class="col-sm-3 control-label">ছাড়ার সময় <span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span> </label>
                <div  class="col-xs-10 col-md-6">
                    <select id="departure_time" name="departure_time" class="selectpicker">
                        <option value="কিছুক্ষন পরপর">কিছুক্ষন পরপর</option>
                        <option value="perticular">নির্দিষ্ট সময়ে</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">ভাড়া <span class="glyphicon glyphicon-asterisk custom_c" aria-hidden="true"></span></label>
                <div class="col-xs-10 col-md-6">
                    <input maxlength="10" type="text" class="form-control" name="main_rent" placeholder="যেমন: ৪৫০" required title="কমপক্ষে আনুমানিক ভাড়া দিন">
                </div>
            </div>

            <div style="display: none;" id="stoppage_section">

            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label"></label>
                <div class="col-xs-10 col-md-6">
                    <a href="javascript:void(0)" id="add_stoppage" class="btn btn-success">স্টপেজ যোগ</a>
                    <span class="help-block">পথিমধ্যে যেসব স্টেশনে থামে সেসবের তথ্য দিতে পারেন</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">ফাইল/ছবি নির্বাচন</label>
                <div class="col-xs-10 col-md-6">
                    <input type="file" class="form-control btn-info" name="eveidence">
                    <span class="help-block">চালান ফর্ম, বাসের ছবি বা যেকোন ফাইল আপলোড করুন। যেটা দেখে আরো নিশ্চিত হওয়া যাবে</span>
                </div>
            </div>

            <?php if (!$this->session->user_id): ?>
                <div style="display:none;" id="user_reg">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">ইউজার নাম</label>
                        <div class="col-xs-10 col-md-6">
                            <input maxlength="100" type="text" class="form-control" name="username" placeholder="ইউজার নাম">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">ইমেইল</label>
                        <div class="col-xs-10 col-md-6">
                            <input maxlength="100" type="email" class="form-control" name="email" placeholder="আপনার ইমেইল">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">পাসওয়ার্ড</label>
                        <div class="col-xs-10 col-md-6">
                            <input maxlength="100" type="password" class="form-control" name="password" placeholder="পাসওয়ার্ড">
                            <span class="help-block">এই ইমেইল এবং পাসওয়ার্ড দিয়ে পরে লগিন করতে পারবেন</span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <input type="hidden" name="from_place" value="<?php echo $from; ?>"/>
            <input type="hidden" name="to_place" value="<?php echo $to; ?>"/>
            <input type="submit" name="submit" class="btn btn-primary btn-lg btn-warning" value="যোগ করুন"/>
        </form>
    </div>

</div><!--/row-->
