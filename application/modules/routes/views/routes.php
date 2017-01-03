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
            <h4><?php echo $title;?></h4>
        </div>
        <div class="box-body">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><?php echo lang('sl');?></th>
                            <th><?php echo lang('from_view');?></th>
                            <th><?php echo lang('to_view');?></th>
                            <th><?php echo lang('transport_type');?></th>
                            <th><?php echo lang('added_at');?></th>
<!--                            <th><?php echo lang('is_publish');?></th>-->
                            <th><?php echo lang('action');?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($routes as $r):$segment++; ?>
                            <tr>
                                <th><?php echo $segment; ?></th>
                                <td><?php echo $r[$this->nl->lang_based_data('fp_bn','from_place')]; ?></td>
                                <td><?php echo $r[$this->nl->lang_based_data('tp_bn','to_place')]; ?></td>
                                <td><?php echo $r['transport_type']; ?></td>
                                <td><?php echo $r['added']; ?></td>
<!--                                <td><?php echo $r['is_publish'] == '0' ? '<small class="label label-danger">No</small>' : '<small class="label label-success">Yes</small>'; ?></td>-->
                                <td><a data-toggle="tooltip" data-placement="top" title="Edit" href="<?php echo site_url_tr('routes/edit') . '/' . $r['id']; ?>"><i class="fa fa-edit"></i></a>
                                    <a data-toggle="tooltip" data-placement="top" title="View" href="<?php echo site_url_tr('routes/show') . '/' . $r['id']; ?>"><i class="fa fa-eye"></i></a>
                                    <?php if($this->nl->is_admin()):?>
                                    <a onclick="return confirm('are you sure?')" data-toggle="tooltip" data-placement="top" title="Delete" href="<?php echo site_url('routes/delete') . '/' . $r['id']; ?>"><i class="fa fa-trash"></i></a>
                                    <?php endif; ?>
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
