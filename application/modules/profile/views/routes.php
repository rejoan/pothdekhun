<div class="col-xs-12 col-sm-6">
    <?php
    $message = $this->session->flashdata('message');
    if ($message) {
        echo '<div class="alert alert-info">' . $message . '</div>';
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
                        <th>Added</th>
                        <th>Published</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($routes as $r):$segment++; ?>
                        <tr>
                            <th><?php echo $segment; ?></th>
                            <td><?php echo $r['from_place']; ?></td>
                            <td><?php echo $r['to_place']; ?></td>
                            <td><?php echo $r['vehicle_name']; ?></td>
                            <td><?php echo $r['added']; ?></td>
                            <td><?php echo $r['is_publish'] == '0' ? '<small class="label label-danger">No</small>' : '<small class="label label-success">Yes</small>'; ?></td>
                            <td><a data-toggle="tooltip" data-placement="top" title="Edit" href="<?php echo site_url_tr('routes/edit') . '/' . $r['id']; ?>"><i class="fa fa-edit"></i></a>
                                <a data-toggle="tooltip" data-placement="top" title="View" href="<?php echo site_url_tr('route/show') . '/' . $r['id']; ?>"><i class="fa fa-eye"></i></a>
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