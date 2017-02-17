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
                        <th>Route</th>
                        <th>ID</th>
                        <th>Note</th>
                        <th>Status</th>
                        <th>Added By</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($complains as $r): ?>
                        <tr>
                            <th><a target="_blank" class="btn btn-github" href="<?php echo site_url('routes/show/') . $r['route_id']; ?>">Route</a></th>
                            <td>
                                <?php echo $r['id']; ?>
                            </td>

                            <td><?php echo $r['note']; ?></td>
                            <td><?php echo get_latest_status($r['latest_status']); ?></td>
                            <td><a target="_blank" class="btn link-black" href="<?php echo site_url('profile/show/') . $r['id']; ?>"><?php echo $r['username']; ?></a></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>