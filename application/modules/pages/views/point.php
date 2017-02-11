<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-sm-6 col-sm-push-3">
    <div class="box box-poth">
        <div class="box-header">
            <h3 class="box-title"><?php echo lang('point_rules');?></h3>
        </div>
        <div class="box-body" style="font-size:17px;">
            <ul id="point_rules" class="list-group">
			<li class="list-group-item list-group-item-info"><h4><?php echo lang('registration_first');?> <a class="text-danger" href="<?php echo site_url_tr('routes/add');?>"> <?php echo lang('add_route');?></a> <?php echo lang('and');?> <a class="text-danger" href="<?php echo site_url_tr('transports/add');?>"><?php echo lang('add_transport');?></a> <?php echo lang('check_first');?></h4></li>
			  <li class="list-group-item"><?php echo lang('pic_rule');?></li>
			  <li class="list-group-item"><?php echo lang('pic_rule2');?><span class="label label-info"><?php echo lang('six');?></span> <?php echo lang('point');?></li>
			  <li class="list-group-item"><?php echo lang('stoppage_rule');?> <span class="label label-info"> <?php echo lang('two');?></span> <?php echo lang('point');?></li>
			  <li class="list-group-item"><?php echo lang('stoppage_rule2');?></li>
			  <li class="list-group-item"><?php echo lang('fare_rule');?> <span class="label label-info"><?php echo lang('one');?></span> <?php echo lang('point');?></li>
			  <li class="list-group-item"><?php echo lang('translation_rule');?> <span class="label label-info"><?php echo lang('six');?></span> <?php echo lang('point');?></li>
			  <li class="list-group-item"><?php echo lang('transport_rule');?><span class="label label-info"><?php echo lang('five');?></span> <?php echo lang('point');?> <?php echo lang('counter_rule');?> <span class="label label-info"><?php echo lang('two');?></span> <?php echo lang('point');?></li>
			  <li class="list-group-item"><?php echo lang('counter_rule2');?>  <span class="label label-info"><?php echo lang('two');?></span> <?php echo lang('point');?></li>
			  <li class="list-group-item"><?php echo lang('long_range_rule');?> <span  class="label label-info"><?php echo lang('three');?></span> <?php echo lang('point').lang('long_range_cause');?></li>
			</ul>
        </div>
    </div>
</div>
<style>
#point_rules li span{
	font-size:20px;
}
#point_rules li a:hover{
	text-decoration:underline;
	font-weight:bolder;
}
</style>