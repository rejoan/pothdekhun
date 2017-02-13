<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-sm-6 col-sm-push-3">
    <div class="box box-poth">
        <div class="box-header">
            <h4><?php echo $title; ?></h4>
        </div>


        <div class="box-body">
            <form action="<?php echo site_url_tr('reputation/index'); ?>" method="get" accept-charset="UTF-8">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <select id="t_filt" name="p" class="selectpicker" data-width="100%">
                                <option value="r" <?php echo trim($this->input->get('p')) == 'r' ? 'selected="selected"' : ''; ?>>
                                    Route Points
                                </option>
                                <option value="t" <?php echo trim($this->input->get('p')) == 't' ? 'selected="selected"' : ''; ?>>
                                    Transport Points
                                </option>
                            </select>
                        </div>
                    </div>

                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped dataTable small_font">
                    <thead>
                        <tr>
                            <th><?php echo lang('ID'); ?></th>
                            <th><?php echo lang('link'); ?></th>
                            <th><?php echo lang('note'); ?></th>
                            <th><?php echo lang('point'); ?></th>
                            <th><?php echo lang('earned'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($points as $r):$segment++; ?>
                            <tr>
                                <th><?php echo $r['id']; ?></th>
                                <td>
                                    <?php
                                    if (trim($this->input->get('p') == 't')) {
                                        echo '<a target="_blank" class="btn btn-xs btn-info" href="' . site_url_tr('transports/show/') . $r['transport_id'] . '">Tranasport</a>';
                                    } else {
                                        echo '<a target="_blank" class="btn btn-xs btn-info" href="' . site_url_tr('routes/show/') . $r['route_id'] . '">Route</a>';
                                    }
                                    ?>
                                </td>

                                <td><?php echo $r['note']; ?></td>

                                <td>
                                    <?php echo $r['point']; ?>
                                </td>
                                <td>
                                    <?php echo $this->nl->date_formatter('Y-m-d H:i:s', $r['happened_at'], 'd M, Y'); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="box-footer">
            <?php echo $links; ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#t_filt').change(function () {
            $('form').submit();
        });
    });
</script>