<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="route_detail" class="col-xs-12 col-md-6">
    <div class="box box-poth">
        <div class="box-header">
            <div class="callout callout-info remove_bottom_margin">
                <h4><?php echo $this->lang->line('route_info') . ': <span class="label label-white">' . $route['from_place'] . '</span> ' . $this->lang->line('from_view') . ' <span class="label label-white">' . $route['to_place'] . '</span>'; ?></h4>
            </div>
        </div>
        <div class="box-body">
            <div class="list-group">
                <a href="javascript:void(0);" class="list-group-item list-group-item-info">
                    <strong><?php echo $this->lang->line('transport_type') . '</strong> : ' . $route['type']; ?>
                </a>
                <li class="list-group-item"><strong><?php echo $this->lang->line('vehicle_name') . '</strong> : ' . $route['vehicle_name']; ?></li>
                <li class="list-group-item"><strong><?php echo $this->lang->line('departure_place') . '</strong> : ' . $route['departure_place']; ?></li>
                <li class="list-group-item"><strong><?php echo $this->lang->line('vehicle_name') . '</strong> : ' . $route['vehicle_name']; ?></li>
                <li class="list-group-item"><strong><?php echo $this->lang->line('vehicle_name') . '</strong> : ' . $route['vehicle_name']; ?></li>
            </div>
        </div>
    </div>
</div>
