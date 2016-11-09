<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xs-12 col-md-6">
    <?php
    $message = $this->session->flashdata('message');
    if ($message) {
        echo '<div class="alert alert-info">' . $message . '</div>';
    }
    ?>
    <div class="box box-poth">
        <div class="box-header">
            <h4><?php echo $title;?></h4>
        </div>
        <div class="box-body">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo lang('from_view');?></th>
                            <th><?php echo lang('to_view');?></th>
                            <th><?php echo lang('transport_type');?></th>
                            <th><?php echo lang('route_added');?></th>
                            <th><?php echo lang('is_publish');?></th>
                            <th><?php echo lang('others');?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($routes as $r):$segment++; ?>
                            <tr>
                                <th><?php echo $segment; ?></th>
                                <td><?php echo $r['from_place']; ?></td>
                                <td><?php echo $r['to_place']; ?></td>
                                <td><?php echo $r['transport_type']; ?></td>
                                <td><?php echo $r['added']; ?></td>
                                <td><?php echo $r['is_publish'] == '0' ? '<small class="label label-danger">No</small>' : '<small class="label label-success">Yes</small>'; ?></td>
                                <td><a data-toggle="tooltip" data-placement="top" title="Edit" href="<?php echo site_url_tr('routes/edit') . '/' . $r['id']; ?>"><i class="fa fa-edit"></i></a>
                                    <a data-toggle="tooltip" data-placement="top" title="View" href="<?php echo site_url('routes/show') . '/' . $r['id']; ?>"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo $links;?>
            </div>
        </div>
    </div>
</div>
