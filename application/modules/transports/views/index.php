<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xs-12 col-md-6">
    <div class="box box-poth">
        <div class="box-header">
            <h3 class="box-title"><?php echo $title;?></h3>
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered table-striped">
                <tr>
                    <th><?php echo lang('sl');?></th>
                    <th><?php echo lang('transport_name');?></th>
                    <th><?php echo lang('total_vehicle');?></th>
                    <th><?php echo lang('added_at');?></th>
                    <th><?php echo lang('added_by');?></th>
                    <th><?php echo lang('action');?></th>
                </tr>
                <?php foreach ($transports as $r):$segment++; ?>
                    <tr>
                        <td><?php echo $segment; ?></td>
                        <td><?php echo $r[$this->nl->lang_based_data('bn_name', 'name')]; ?></td>
                        <td><?php echo $r['total_vehicles']; ?></td>
                        <td><?php echo $r['added'];?></td>
                        <td><?php echo $r['username'];?></td>
                        <td>
                            <a data-toggle="tooltip" data-placement="top" title="Edit" href="<?php echo site_url_tr('transports/edit') . '/' . $r['id']; ?>"><i class="fa fa-edit"></i></a>
                                    <a data-toggle="tooltip" data-placement="top" title="View" href="<?php echo site_url('transports/show') . '/' . $r['id']; ?>"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
