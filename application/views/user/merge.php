<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'application/libraries/finediff.php';
?>
<div class="col-xs-12 col-md-6">
    <div class="box box-poth">
        <div class="box-header">
            <div class="callout callout-info">
                <h4><?php echo $this->lang->line('edited_route'); ?></h4>
            </div>

        </div>
        <div class="box-body">
            <form id="merge_sec" class="form-horizontal" method="post" action="">
                <div class="form-group custom_margin">
                    <label class="col-sm-10 col-md-3 control-label"><?php echo $this->lang->line('country'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <?php
                        $country = $route['country'];
                        $country_edited = trim($edited_route['country']);
                        echo $country != $country_edited ? '<p id="country_edited" class="text-red"><span>' . $country_edited . '</span> <button class="btn btn-xs btn-success">Accept</button></p>' :  '<p class="text-green">' .$country_edited.'</p>';
                        ?>
                    </div>
                </div>
                <div class="form-group custom_margin">
                    <label class="col-sm-10 col-md-3 control-label"><?php echo $this->lang->line('from_view'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <?php
                        $from_place_text = $route['from_place'];
                        $from_place_edited = trim($edited_route['from_place']);
                        echo $from_place_text != $from_place_edited ? '<p id="place_edited" class="text-red"><span>' . $from_place_edited . '</span> <button  class="btn btn-xs btn-success">Accept</button></p>' : '<p class="text-green">' . $from_place_edited . '</p>';
                        ?>
                    </div>
                </div>
                <div class="form-group custom_margin">
                    <label class="col-sm-10 col-md-3 control-label"><?php echo $this->lang->line('to_view'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <?php
                        $to_place_text = $route['to_place'];
                        $to_place_edited = trim($edited_route['to_place']);
                        echo $to_place_text != $to_place_edited ? '<p id="to_edited" class="text-red"><span>' . $to_place_edited . '</span> <button class="btn btn-xs btn-success">Accept</button></p>' : '<p class="text-green">' . $to_place_edited . '</p>';
                        ?>
                    </div>
                </div>
                <div class="form-group custom_margin">
                    <label class="col-sm-10 col-md-3 control-label"><?php echo $this->lang->line('departure_place'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <?php
                        $departure_place = $route['departure_place'];
                        $departure_place_edited = trim($edited_route['departure_place']);
                        echo $departure_place != $departure_place_edited ? '<p id="departure_place_edited" class="text-red"><span>' . $departure_place_edited . '</span> <button class="btn btn-xs btn-success">Accept</button></p>' : '<p class="text-green">' . $departure_place_edited . '</p>';
                        ?>
                    </div>
                </div>
                <div class="form-group custom_margin">
                    <label class="col-sm-10 col-md-3 control-label"><?php echo $this->lang->line('main_rent'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <?php
                        $rent = $route['rent'];
                        $rent_edited = trim($edited_route['rent']);
                        echo $rent != $rent_edited ? '<p id="rent_edited" class="text-red"><span>' . $rent_edited . '</span> <button class="btn btn-xs btn-success">Accept</button></p>' : '<p class="text-green">' . $rent_edited . '</p>';
                        ?>
                    </div>
                </div>
                <div class="form-group custom_margin">
                    <label class="col-sm-10 col-md-3 control-label"><?php echo $this->lang->line('transport_type'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <?php
                        $type = $route['type'];
                        $type_edited = trim($edited_route['type']);
                        echo $type != $type_edited ? '<p id="type_edited" class="text-red"><span>' . $type_edited . '</span> <button class="btn btn-xs btn-success">Accept</button></p>' : '<p class="text-green">' . $type_edited . '</p>';
                        ?>
                    </div>
                </div>
                <div class="form-group custom_margin">
                    <label class="col-sm-10 col-md-3 control-label"><?php echo $this->lang->line('vehicle_name'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <?php
                        $vehicle_name = $route['vehicle_name'];
                        $vehicle_name_edited = trim($edited_route['vehicle_name']);
                        echo $vehicle_name != $vehicle_name_edited ? '<p id="name_edited" class="text-red"><span>' . $vehicle_name_edited . '</span> <button class="btn btn-xs btn-success">Accept</button></p>' : '<p class="text-green">' . $vehicle_name_edited . '</p>';
                        ?>
                    </div>
                </div>
                <div class="form-group custom_margin">
                    <label class="col-sm-10 col-md-3 control-label"><?php echo $this->lang->line('departure_time'); ?></label>
                    <div class="col-xs-10 col-md-6">
                        <?php
                        $departure_time = $route['departure_time'];
                        $departure_time_edited = trim($edited_route['departure_time']);
                        echo $departure_time != $departure_time_edited ? '<p id="time_edited" class="text-red"><span>' . $departure_time_edited . '</span> <button class="btn btn-xs btn-success">Accept</button></p>' : '<p class="text-green">' . $departure_time_edited . '</p>';
                        ?>
                    </div>
                </div>

                <?php
                for ($i = 0; $i < count($edited_stopage); $i++) {
                    $k = $i + 1;
                    $position = $stoppages[$i]['position'];
                    $position_edited = trim($edited_stopage[$i]['position']);
                    if ($position != $position_edited) {
                        $final_position = '<p id="edited_position" class="text-red">' . $position_edited . '</p>';
                    } else {
                        $final_position = '<p class="text-green">' . $position_edited . '</p>';
                    }

                    $place_name = $stoppages[$i]['place_name'];
                    $place_name_edited = trim($edited_stopage[$i]['place_name']);
                    if ($place_name != $place_name_edited) {
                        $final_place = '<p id="edited_place" class="text-red">' . $place_name_edited . '</p>';
                    } else {
                        $final_place = '<p class="text-green">' . $place_name_edited . '</p>';
                    }

                    $comments = $stoppages[$i]['comments'];
                    $comments_edited = trim($edited_stopage[$i]['comments']);
                    if ($comments != $comments_edited) {
                        $final_comment = '<p id="edited_comment" class="text-red">' . $comments_edited . '</p>';
                    } else {
                        $final_comment = '<p class="text-green">' . $comments_edited . '</p>';
                    }

                    $rent = $stoppages[$i]['rent'];
                    $rent_edited = trim($edited_stopage[$i]['rent']);
                    if ($rent != $rent_edited) {
                        $final_rent = '<p id="edited_rent" class="text-red">' . $rent_edited . '</p>';
                    } else {
                        $final_rent = '<p class="text-green">' . $rent_edited . '</p>';
                    }
                    
                    if ($position != $position_edited || $rent != $rent_edited || $comments != $comments_edited || $place_name != $place_name_edited) {
                        $accept_button = ' <button data-iden="'.$k.'" class="btn btn-xs btn-success stopage_edited">Accept</button>';
                    }else{
                        $accept_button = '';
                    }

                    echo '<div class="form-group custom_margin"><div class="col-xs-10 col-md-2">' . $final_position . '</div><div class="col-xs-10 col-md-3">' . $final_place . '</div><div class="col-xs-10 col-md-4">' . $final_comment . '</div><div class="col-xs-10 col-md-2">' . $final_rent . '</div>'.$accept_button.'</div>';
                }
                ?>

                <?php if (isset($edited_route['evidence'])): ?>
                    <?php if (!empty($edited_route['evidence'])): ?>
                        <?php
                        $evidence = $route['evidence'];
                        $evidence_edited = trim($edited_route['evidence']);
                        if ($evidence != $evidence_edited) {
                            $final_evidence = '<p id="evidence_edited" class="text-red"><span>' . $evidence_edited . '</span><button class="btn btn-xs btn-success">Accept</button></p>';
                        } else {
                            $final_evidence = '<p class="text-green">' . $evidence_edited . '</p>';
                        }
                        ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">File</label>
                            <div class="col-xs-10 col-md-6">
                                <a id="evidence_file" href="<?php echo base_url('evidences') . '/' . $evidence_edited; ?>"><?php echo $final_evidence; ?></a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
