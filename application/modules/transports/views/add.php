<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="transport" class="col-xs-12 col-md-6">
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
                            <input name="transport_name" class="form-control transport_name" value="<?php
                            if ($this->input->post('transport_name')) {
                                echo set_value('transport_name');
                            } elseif (isset($transport['name'])) {
                                echo $transport['name'];
                            }
                            ?>" placeholder="Name in English" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo lang('bengali_name'); ?></label>
                        <div class="col-xs-10 col-md-6">
                            <input name="bn_name" class="form-control transport_name" value="<?php
                            if ($this->input->post('bn_name')) {
                                echo set_value('bn_name');
                            } elseif (isset($transport['bn_name'])) {
                                echo $transport['bn_name'];
                            }
                            ?>" placeholder="Name in Bengali"/>
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

                    <input type="hidden" name="pd_identity" value="<?php
                    if ($this->input->post('submit')) {
                        echo set_value('pd_identity');
                    } elseif (isset($transport['id'])) {
                        echo $this->encryption->encrypt($transport[$poribohon_id]);
                    }
                    ?>"/>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Counter Addresses</label>
                    </div>
                    <?php if (isset($counter_address)): ?>
                        <?php for ($i = 0; $i < count($counter_address); $i++) { ?>
                            <div id="address" class="row form-group">
                                <div class="col-xs-12">
                                    <div class="col-xs-10 col-md-3">
                                        <select name="ad[]" class="add_district" data-width="100%" data-thana="ft" data-live-search="true">
                                            <?php foreach ($districts as $d): ?>
                                                <option value="<?php echo $d['id']; ?>" <?php
                                                echo $counter_address[$i]['district'] == $d['id'] ? 'selected="yes"' : '';
                                                ?>>

                                                    <?php echo $d[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-10 col-md-4">
                                        <select id="ft" class="thana" name="thana[]" data-width="100%">
                                            <?php foreach ($thanas as $t): ?>
                                                <option  value="<?php echo $t['id']; ?>" <?php echo $counter_address[$i]['thana'] == $t['id'] ? 'selected="yes"' : ''; ?>>

                                                    <?php echo $t[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-10 col-md-4 add_details">
                                        <textarea class="form-control" name="details[]" placeholder="<?php echo lang('address_details'); ?>"><?php echo $counter_address[$i]['address']; ?></textarea>
                                    </div>
                                    <?php
                                    if ($i > 0) {
                                        echo '<button class="btn btn-xs btn-danger remove_address"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    <?php endif; ?>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-xs-10 col-md-6">
                            <a href="javascript:void(0)" id="add_address" class="btn btn-info"><i class="fa fa-plus"></i> <?php echo lang('add_address'); ?></a>
                        </div>
                    </div>

                    <?php if ($this->nl->is_admin() && $this->input->get('pd_rev')): ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Point</label>
                            <div class="col-xs-10 col-md-6">
                                <input id="point" type="text" class="form-control" name="point" value="<?php echo $point; ?>">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Note</label>
                            <div class="col-xs-10 col-md-6">
                                <textarea class="form-control" name="note"></textarea>
                            </div>
                        </div>
                    <?php endif; ?>


                    <div class="form-group">
                        <label class="col-sm-1 control-label"></label>
                        <div class="col-xs-10 col-md-3">
                            <input type="submit" name="submit" class="btn btn-primary btn-lg btn-info" value="<?php echo $action_button; ?>"/>

                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
<?php if ($this->nl->is_admin()): ?>
    <script>
        $(document).ready(function () {
            
        });
    </script>
<?php endif; ?>