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
                        <th>Name</th>
                        <th>Bengali Name</th>
                        <th>Submitted by</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($poribohons as $r):$segment++; ?>
                        <tr>
                            <th><?php echo $segment; ?></th>
                            <td><?php echo $r['name']; ?></td>
                            <td><?php echo $r['bn_name']; ?></td>
                           
                            <td><?php echo $r['username']; ?></td>

                            <td>
                                <a class="btn btn-info" target="_blank" data-toggle="tooltip" data-placement="top" title="Review" href="<?php echo site_url('transports/edit') . '/' . $r['poribohon_id'] . '?pd_rev=yes'; ?>"><i class="fa fa-link"></i></a>

                                <a class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Decline" href="<?php echo site_url('transports/reject') . '/' . $r['id']; ?>"><i class="fa fa-close"></i></a>
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