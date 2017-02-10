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
                        <th>From</th>
                        <th>To</th>
                        <th>Transport</th>
                        <th>Status</th>
                        <th>Submitted by</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($routes as $r):$segment++; ?>
                        <tr>
                            <th><?php echo $segment; ?></th>
                            <td><?php echo $r['from_place']; ?></td>
                            <td><?php echo $r['to_place']; ?></td>
                            <td><?php echo $r['transport_type']; ?></td>
                            <td><?php echo $r['is_publish'] == 0 ? 'Unpublished' : 'Publish'; ?></td>
                            <td><?php echo $r['username']; ?></td>

                            <td>
                                <a class="btn btn-info" target="_blank" data-toggle="tooltip" data-placement="top" title="Update" href="<?php echo site_url('routes/edit') . '/' . $r['r_id'] . '?pd_rev=yes'; ?>"><i class="fa fa-link"></i></a>
                                <a class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Revise Again" href="<?php echo site_url('route_manager/revise') . '/' . $r['r_id'] . '?tb=routes'; ?>"><i class="fa fa-hand-lizard-o"></i></a>
                                <a class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Decline" href="<?php echo site_url('route_manager/reject') . '/' . $r['r_id']; ?>"><i class="fa fa-close"></i></a>
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