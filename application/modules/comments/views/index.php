<div class="col-xs-12">
    <?php
    $message = $this->session->flashdata('message');
    if ($message) {
        echo '<div class="alert alert-warning">' . $message . '</div>';
    }
    ?>
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title"><?php echo $title; ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Comment</th>
                        <th>Route</th>
                        <th>Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $r): ?>
                        <tr>
                            <th><?php echo $r['id']; ?></th>
                            <td><?php echo empty($r['username']) ? $r['email'] : $r['username']; ?></td>
                            <td><?php echo $r['comment']; ?></td>
                            <td><a target="_blank" href="<?php echo site_url('routes/show/').$r['route_id'];?>">Route</a></td>
                            <td><?php echo $this->nl->date_formatter('Y-m-d H:i:s',$r['added'],'d M, y'); ?></td>
                            <td><?php echo $r['username']; ?></td>

                            <td>
                                <a onclick="return confirm('Delete this Comment?');" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" href="<?php echo site_url('comments/delete') . '/' . $r['id']; ?>"><i class="fa fa-trash"></i></a>
                                <a onclick="return confirm('Are you sure');" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="<?php echo $r['status'] == 0 ? 'Approve':'Deactivate'; ?>" href="<?php echo site_url('comments/approval') . '/' . $r['id']; ?>"><i class="fa fa-<?php echo $r['status'] == 0 ? 'unlock':'lock'; ?>"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>