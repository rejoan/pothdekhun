<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$message = $this->session->flashdata('message');
if ($message) {
    echo '<div class="alert alert-info">' . $message . '</div>';
}
?>
<?php $this->load->view('leftbar'); ?>
<div class="col-xs-12 col-md-6">
    <div class="box box-primary box-poth">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo lang('about_me') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" action="profile/edit" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label"><?php echo lang('first_name'); ?></label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="first_name" placeholder="<?php echo lang('first_name'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label"><?php echo lang('last_name'); ?></label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="last_name" placeholder="<?php echo lang('last_name'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label"><?php echo lang('email'); ?></label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="email" placeholder="<?php echo lang('last_name'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputExperience" class="col-sm-3 control-label"><?php echo lang('username'); ?></label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="username" placeholder="<?php echo lang('username'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSkills" class="col-sm-3 control-label"><?php echo lang('mobile'); ?></label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="modile" placeholder="<?php echo lang('mobile'); ?>">
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
                        <textarea class="form-control" name="about_me"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
</div>
