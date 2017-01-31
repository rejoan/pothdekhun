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
                        <th>Comment</th>
                        <th>Email</th>
                        <th>Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $r): ?>
                        <tr>
                            <th><?php echo $r['id']; ?></th>
                            <td><?php echo $r['name']; ?></td>
                            <td><?php echo $r['email']; ?></td>
                            <td><?php echo $r['comment']; ?></td>

                            <td><?php echo $this->nl->date_formatter('Y-m-d H:i:s', $r['added'], 'd M, y'); ?></td>
                            <td>
                                <a onclick="return confirm('Delete this Comment?');" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" href="<?php echo site_url('comments/contact/delete') . '/' . $r['id']; ?>"><i class="fa fa-trash"></i></a>

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