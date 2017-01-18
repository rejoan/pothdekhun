<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="suggestion_page" class="col-xs-12 col-md-6">
    <div class="box box-poth">
        <div class="box-header">
            <h3 class="box-title"><?php echo $title; ?></h3>
        </div>
        <div class="box-body table-responsive no-padding">
            <form id="add_route" class="form-horizontal" action="<?php echo site_url_tr('transports/index'); ?>" method="get">
                <div class="input-group margin">
                    <input id="vehicle_name" type="text" class="form-control" name="t" value="<?php echo trim($this->input->get('t',TRUE));?>">
                    <div class="list-group suggestion">

                    </div>
                    <span class="input-group-btn">
                        <input  type="submit" class="btn btn-info btn-flat" value="Search"/>
                    </span>
                </div>
            </form>

            <table class="table table-hover table-bordered table-striped dataTable">
                <thead>
                    <tr>
                        <th><?php echo lang('sl'); ?></th>
                        <th><?php echo lang('vehicle_name'); ?></th>
                        <th><?php echo lang('total_vehicle'); ?></th>
                        <th><?php echo lang('added_at'); ?></th>
                        <th><?php echo lang('added_by'); ?></th>
                        <th><?php echo lang('action'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transports as $r):$segment++; ?>
                        <tr>
                            <td><?php echo $segment; ?></td>
                            <td><?php echo $r[$this->nl->lang_based_data('bn_name', 'name')]; ?></td>
                            <td><?php echo empty($r['total_vehicles']) ? 'Not Given' : $r['total_vehicles']; ?></td>
                            <td><?php echo date('d M, Y ', strtotime($r['added'])); ?></td>
                            <td><?php echo $r['username']; ?></td>
                            <td>
                                <a data-toggle="tooltip" data-placement="top" title="Edit" href="<?php echo site_url_tr('transports/edit') . '/' . $r['id']; ?>"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="View" href="<?php echo site_url_tr('transports/show') . '/' . $r['id']; ?>"><i class="fa fa-eye"></i></a>
                                <?php if ($this->nl->is_admin()): ?>
                                    <a onclick="return confirm('are you sure?')" data-toggle="tooltip" data-placement="top" title="Delete" href="<?php echo site_url_tr('transports/delete') . '/' . $r['id']; ?>"><i class="fa fa-trash"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
        <div class="box-header">
            <?php echo $links; ?>
        </div>
    </div>
</div>
