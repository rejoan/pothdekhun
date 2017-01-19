<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">All Users</h3>

            <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tbody><tr>
                        <th>SL#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Reg date</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($users as $u):$segment++ ?>
                        <tr>
                            <td><?php echo $segment;?></td>
                            <td><?php echo $u['username'];?></td>
                            <td><?php echo $u['email'];?></td>
                            <td><?php echo date('d M, Y',strtotime($u['reg_date']));?></td>
                            <td>
                                <a data-toggle="tooltip" data-placement="top" title="Edit" href="<?php echo site_url_tr('users/delete') . '/' . $u['id']; ?>"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <?php echo $links; ?>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>