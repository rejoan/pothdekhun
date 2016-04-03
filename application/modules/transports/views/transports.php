<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xs-12 col-md-6">
    <div class="box box-poth">
        <div class="box-header">
            <div class="callout callout-info">
                <h4>I am a success callout!</h4>

                <p>This is a green callout.</p>
            </div>
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered table-striped">
                <tr>
                    <th>From</th>
                    <th>To</th>
                    <th>Transport</th>
                    <th>Rent</th>
                    <th>Stoppages</th>
                </tr>
                <?php foreach ($transports as $r): ?>
                    <tr>
                        <td><?php echo $r['from_place']; ?></td>
                        <td><?php echo $r['to_place']; ?></td>
                        <td><?php echo $r['transport_type']; ?></td>
                        <td><?php echo $r['rent']; ?></td>
                        <td>ds</td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
