<div class="col-xs-12">
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title"><?php echo $title;?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered table-striped">
                <tr>
                    <th>From</th>
                    <th>To</th>
                    <th>Transport</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php foreach($routes as $r):?>
                <tr>
                    <td><?php echo $r['from_place'];?></td>
                    <td><?php echo $r['to_place'];?></td>
                    <td><?php echo $r['type'];?></td>
                    <td><span class="label label-success">Approved</span></td>
                    <td><a target="_blank" data-toggle="tooltip" data-placement="top" title="Edit" href="<?php echo site_url('road/edit_route').'/'.$r['id'];?>"><i class="fa fa-edit"></i></a></td>
                </tr>
                <?php endforeach;?>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>