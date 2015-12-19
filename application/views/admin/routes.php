<div class="col-xs-12">
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
                        <th>Verified</th>
                        <th>Added</th>
                        <th>Added by</th>
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
                            <td>6</td>
                            <td><?php echo $r['added']; ?></td>
                            <td><?php echo $r['username']; ?></td>
                            <td><a target="_blank" data-toggle="tooltip" data-placement="top" title="Edit" href="<?php echo site_url('road/edit_route') . '/' . $r['id'].'?ln=bn'; ?>"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>