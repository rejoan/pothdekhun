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
                    <div class="col-xs-4">
                        <div class="form-group">
                            <select name="d" class="selectpicker districts" data-width="100%" data-thana="ft" data-live-search="true">
                                <?php foreach ($districts as $d): ?>
                                    <option value="<?php echo $d['id']; ?>">
                                        <?php echo $d[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-4">
                        <div class="form-group">
                            <select id="ft" name="t" class="selectpicker thanas" data-width="100%" data-live-search="true" >
                                <?php foreach ($thanas as $t): ?>
                                    <option  value="<?php echo $t['id']; ?>" <?php echo $t['id'] == '493' ? 'selected="yes"' : ''; ?>>
                                        <?php echo $t[$this->nl->lang_based_data('bn_name', 'name')]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
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
                        <th><?php echo lang('transport_type'); ?></th>
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
                                <a data-toggle="tooltip" data-placement="top" title="Edit" href="<?php echo site_url_tr('routes/edit') . '/' . $r['id']; ?>"><i class="fa fa-edit"></i></a>
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
