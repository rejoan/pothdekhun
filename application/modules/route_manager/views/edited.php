<div class="col-xs-12">
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
                        <th>Submitted</th>
                        <th>Edited by</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($routes as $r):$segment++; ?>
                        <tr>
                            <th><?php echo $segment; ?></th>
                            <td><?php echo $r['from_place']; ?></td>
                            <td><?php echo $r['to_place']; ?></td>
                            <td><?php echo $r['type']; ?></td>
                            <td><?php echo $r['submitted_at']; ?></td>
                            <td><?php echo $r['username']; ?></td>
                            
                            <td>
                                <a data-toggle="tooltip" data-placement="top" title="View to Merge" href="<?php echo site_url('routes/merge') . '/' . $r['route_id'] . '?ln=bn'; ?>"><i class="fa fa-tripadvisor"></i></a>
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