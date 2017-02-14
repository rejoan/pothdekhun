<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">All Users</h3>
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
                            <td><?php echo $this->nl->date_formatter('Y-m-d H:i:s',$u['reg_date'],'d M Y');?></td>
                            <td>
                                <a data-toggle="tooltip" data-placement="top" title="Points" href="<?php echo site_url_tr('users/points') . '?p=r&u=' . $u['id']; ?>"><i class="fa fa-viacoin"></i></a>
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