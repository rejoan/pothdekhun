<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xs-12 col-md-6">
    <?php
    $message = $this->session->flashdata('message');
    if ($message) {
        echo '<div class="alert alert-warning">' . $message . '</div>';
    }
    echo validation_errors('<div class="alert alert-danger">', '</div>');
    ?>
    <div class="box box-poth">
        <div class="box-header">
            <h4>
                <?php echo lang('direct_add') ?>
            </h4>

        </div>
        <form  class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <div class="box-body">
                <!-- route info push form -->

                <div class="row">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('vehicle_name'); ?></label>
                        <div class="col-xs-10 col-md-6">
                            <input name="transport_name" class="form-control" value="<?php
                            if ($this->input->post('transport_name')) {
                                echo set_value('transport_name');
                            } elseif (isset($transport['name'])) {
                                echo $transport['name'];
                            }
                            ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('bengali_name'); ?></label>
                        <div class="col-xs-10 col-md-6">
                            <input name="bn_name" class="form-control" value="<?php
                            if ($this->input->post('bn_name')) {
                                echo set_value('bn_name');
                            } elseif (isset($transport['bn_name'])) {
                                echo $transport['bn_name'];
                            }
                            ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('owner_name'); ?></label>
                        <div class="col-xs-10 col-md-6">
                            <input name="owner_name" class="form-control" value="<?php
                            if ($this->input->post('owner_name')) {
                                echo set_value('owner_name');
                            } elseif (isset($transport['owner'])) {
                                echo $transport['owner'];
                            }
                            ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('total_vehicle'); ?></label>
                        <div class="col-xs-10 col-md-6">
                            <input name="total_vehicle" class="form-control rent" value="<?php
                            if ($this->input->post('total_vehicle')) {
                                echo set_value('total_vehicle');
                            } elseif (isset($transport['total_vehicles'])) {
                                echo $transport['total_vehicles'];
                            }
                            ?>"/>
                        </div>
                    </div>

                    <input type="hidden" name="update_id" value="<?php
                    if ($this->input->post('submit')) {
                        echo set_value('update_id');
                    } elseif (isset($transport['id'])) {
                        echo $transport['id'];
                    }
                    ?>"/>
                    
                    <input type="hidden" name="prev_picture" value="<?php
                    if ($this->input->post('submit')) {
                        echo set_value('prev_picture');
                    } elseif (isset($transport['picture'])) {
                        echo $transport['picture'];
                    }
                    ?>"/>

                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />


                    <?php if (isset($transport['picture'])): ?>
                        <?php if (!empty($transport['picture'])): ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo lang('prev_file'); ?></label>
                                <div class="col-xs-10 col-md-6">
                                    <a  href="<?php echo base_url('evidences') . '/' . $transport['picture']; ?>"><?php echo $transport['picture']; ?></a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('tarnsport_picture'); ?></label>
                        <div class="col-xs-10 col-md-6">
                            <input type="file" class="form-control btn-info" name="picture">
                            <span class="help-block"><?php echo lang('piture_help'); ?></span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-xs-10 col-md-6">
                            <input type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo $action_button; ?>"/>

                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>