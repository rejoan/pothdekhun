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
                    <?php foreach ($comments as $r):$segment++; ?>
                        <tr>
                            <th><?php echo $segment; ?></th>
                            <td><?php echo empty($r['username']) ? $r['email'] : $r['username']; ?></td>
                            <td><?php echo $r['comment']; ?></td>
                            <td><a href="<?php echo site_url('routes/show/').$r['route_id'];?>"></a></td>
                            <td><?php echo $this->nl->date_formatter('Y-m-d H:i:s',$r['added'],'m D, y'); ?></td>
                            <td><?php echo $r['username']; ?></td>

                            <td>
                                <a class="btn btn-info" target="_blank" data-toggle="tooltip" data-placement="top" title="Update" href="<?php echo site_url('comments/delete') . '/' . $r['id']; ?>"><i class="fa fa-link"></i></a>
                                
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