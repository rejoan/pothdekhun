<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xs-12 col-md-6">
    <?php
    $message = $this->session->flashdata('message');
    if ($message) {
        echo '<div class="alert alert-warning">' . $message . '</div>';
    }
    ?>
    <div class="box box-poth">
        <div class="box-header">
            <h4><?php echo $title; ?></h4>
        </div>


        <div class="box-body table-responsive">
            <form action="<?php echo site_url_tr('routes/all'); ?>" method="get" accept-charset="UTF-8">
                <div class="row">
                    <div class="col-xs-3">
                        <div class="form-group">
                            <select name="fd" class="selectpicker districts" data-width="100%" data-thana="ft" data-live-search="true">
                                <?php foreach ($districts as $d): ?>
                                    <option value="<?php echo $d['id']; ?>" <?php echo trim($this->input->get('fd')) == $d['id'] ? 'selected="selected"' : ''; ?>>
                                        <?php echo $d[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-3">
                        <div id="tft" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang('dhaka_message'); ?>" class="form-group">
                            <select id="ft" name="ft" class="selectpicker thanas" data-width="100%" data-live-search="true" >
                                <?php foreach ($thanas as $t): ?>
                                    <option  value="<?php echo $t['id']; ?>" <?php echo trim($this->input->get('ft')) == $t['id'] ? 'selected="selected"' : ''; ?>>
                                        <?php echo $t[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-3">

                        <select name="t" class="selectpicker" data-width="100%" data-live-search="true" >
                            <option value="bus" <?php echo trim($this->input->get('t', TRUE)) == 'bus' ? 'selected="yes"' : ''; ?>>
                                <?php echo lang('bus'); ?>
                            </option>
                            <option value="train" <?php echo trim($this->input->get('t', TRUE)) == 'train' ? 'selected="yes"' : ''; ?>>
                                <?php echo lang('train'); ?>
                            </option>
                            <option value="launch" <?php echo trim($this->input->get('t', TRUE)) == 'launch' ? 'selected="yes"' : ''; ?>>
                                <?php echo lang('launch'); ?>
                            </option>
                            <option value="leguna" <?php echo trim($this->input->get('t', TRUE)) == 'leguna' ? 'selected="yes"' : ''; ?>>
                                <?php echo lang('leguna'); ?>
                            </option>
                            <option value="biman" <?php echo trim($this->input->get('t', TRUE)) == 'biman' ? 'selected="yes"' : ''; ?>>
                                <?php echo lang('biman'); ?>
                            </option>
                            <option value="others" <?php echo trim($this->input->get('t', TRUE)) == 'others' ? 'selected="yes"' : ''; ?>>
                                <?php echo lang('others'); ?>
                            </option>
                        </select>
                    </div>
                    <div class="col-xs-2">
                        <input type="submit" class="btn btn--sm btn-info" value="<?php echo lang('see_transport_button'); ?>"/>
                    </div>
                </div>
            </form>

            <table class="table table-hover table-bordered table-striped dataTable">
                <thead>
                    <tr>
                        <th><?php echo lang('ID'); ?></th>
                        <th><?php echo lang('from_view'); ?></th>
                        <th><?php echo lang('to_view'); ?></th>
                        <th><?php echo lang('type'); ?></th>
                        <th><?php echo lang('vehicle_name'); ?></th>
                        <th><?php echo lang('action'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($routes as $r):$segment++; ?>
                        <tr>
                            <th><?php echo $r['id']; ?></th>
                            <td><?php echo mb_convert_case($r[$this->nl->lang_based_data('fp_bn', 'from_place')], MB_CASE_TITLE, 'UTF-8'); ?></td>
                            <td><?php echo mb_convert_case($r[$this->nl->lang_based_data('tp_bn', 'to_place')], MB_CASE_TITLE, 'UTF-8'); ?></td>
                            <td><?php echo get_tr_type($r['transport_type']); ?></td>
                            <td><?php echo $r[$this->nl->lang_based_data('bn_name', 'name')]; ?></td>
                            <td>
                                <?php if ($this->session->user_id): ?>
                                    <a data-toggle="tooltip" data-placement="top" title="Edit" href="<?php echo site_url_tr('routes/edit') . '/' . $r['id']; ?>"><i class="fa fa-edit"></i></a>
                                <?php endif; ?>
                                &nbsp;
                                <a class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="View" href="<?php echo site_url_tr('routes/show') . '/' . $r['id']; ?>"><i class="fa fa-eye"></i></a>
                                &nbsp;
                                <?php if ($this->nl->is_admin()): ?>
                                    <a onclick="return confirm('are you sure?')" data-toggle="tooltip" data-placement="top" title="Delete" href="<?php echo site_url('routes/delete') . '/' . $r['id']; ?>"><i class="fa fa-trash"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <?php echo $links; ?>
        </div>
    </div>
</div>
