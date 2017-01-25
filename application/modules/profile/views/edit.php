<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('leftbar');
?>

<div class="col-xs-12 col-md-6">
    <?php
    $message = $this->session->flashdata('message');
    if ($message) {
        echo '<div class="alert alert-info">' . $message . '</div>';
    }
    ?>
    <div class="box box-primary box-poth">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo lang('about_me') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" action="<?php echo site_url('profile/edit');?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label"><?php echo lang('first_name'); ?></label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="first_name" placeholder="<?php echo lang('first_name'); ?>" value="<?php echo ($this->input->post('first_name')) ? set_value('first_name') : $profile['first_name']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('last_name'); ?></label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="last_name" placeholder="<?php echo lang('last_name'); ?>" value="<?php echo $this->input->post('last_name') ? set_value('last_name') : $profile['last_name']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label"><?php echo lang('email'); ?></label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="email" placeholder="<?php echo lang('email'); ?>" value="<?php echo $this->input->post('email') ? set_value('email') : $profile['email']; ?>"> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputExperience" class="col-sm-3 control-label"><?php echo lang('username'); ?></label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="username" placeholder="<?php echo lang('username'); ?>" value="<?php echo $this->input->post('username') ? set_value('username') : $profile['username']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputExperience" class="col-sm-3 control-label"><?php echo lang('password'); ?></label>

                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="password" placeholder="<?php echo lang('password'); ?>">
                    </div>
                </div>


                <div class="form-group">
                    <label for="inputSkills" class="col-sm-3 control-label"><?php echo lang('mobile'); ?></label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="modile" placeholder="<?php echo lang('mobile'); ?>" value="<?php echo $this->input->post('mobile') ? set_value('mobile') : $profile['mobile']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSkills" class="col-sm-3 control-label"><?php echo lang('sex'); ?></label>
                    <div class="col-sm-9">
                        <select name="sex" class="selectpicker" data-width="100%">
                            <option value="Male"><?php echo lang('male'); ?></option>
                            <option value="Female"><?php echo lang('female'); ?></option>
                            <option value="Other"><?php echo lang('other'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSkills" class="col-sm-3 control-label"><?php echo lang('location'); ?></label>
                    <div class="col-xs-10 col-md-4">
                        <select name="fd" class="selectpicker districts" data-width="100%" data-thana="ft" data-live-search="true">
                            <?php foreach ($districts as $d): ?>
                                <option value="<?php echo $d['id']; ?>" <?php
                                if ($this->input->post('fd')) {
                                    echo $this->input->post('fd') == $d['id'] ? 'selected="yes"' : '';
                                } elseif (isset($profile['district'])) {
                                    echo $profile['district'] == $d['id'] ? 'selected="yes"' : '';
                                } else {
                                    echo $d['id'] == '1' ? 'selected="yes"' : '';
                                }
                                ?>>

                                    <?php echo $d[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-xs-10 col-md-4">
                        <select id="ft" name="ft" class="selectpicker" data-width="100%" data-live-search="true" >
                            <?php foreach ($thanas as $t): ?>
                                <option  value="<?php echo $t['id']; ?>" <?php
                                if ($this->input->post('ft')) {
                                    echo $this->input->post('ft') == $t['id'] ? 'selected="yes"' : '';
                                } elseif (isset($profile['thana'])) {
                                    echo $profile['thana'] == $t['id'] ? 'selected="yes"' : '';
                                } else {
                                    echo $t['id'] == '493' ? 'selected="yes"' : '';
                                }
                                ?>>

                                    <?php echo $t[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputSkills" class="col-sm-3 control-label"><?php echo lang('about_me'); ?></label>

                    <div class="col-sm-9">
                        <textarea class="form-control" name="about_me"><?php echo $this->input->post('about') ? set_value('about') : $profile['about']; ?></textarea>
                    </div>
                </div>
                <input type="hidden" name="pd_ps" value="<?php
                if ($this->input->post('submit')) {
                    echo set_value('pd_ps');
                } else{
                    echo $this->encryption->encrypt($profile['avatar']);
                }
                ?>"/>


                <?php if (isset($profile['avatar'])): ?>
                    <?php if (!empty($profile['avatar'])): ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo lang('prev_image'); ?></label>
                            <div class="col-xs-10 col-md-5">
                                <a class="fancybox" href="<?php echo base_url('avatars') . '/' . $profile['avatar']; ?>"><img class="img-responsive img-thumbnail" src="<?php echo base_url('avatars') . '/' . $profile['avatar']; ?>" alt="Profile Piture"/></a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('profile_image'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <input type="file" class="form-control btn-info" name="avatar">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input name="submit" type="submit" class="btn btn-info" value="<?php echo lang('edit_button'); ?>">
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
</div>
