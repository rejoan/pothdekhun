<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="profile" class="col-sm-3">
    <div class="box box-primary box-poth">
        <!--        <div class="box-header with-border">
                    <h3 class="box-title"><?php //echo lang('rightbar')       ?></h3>
                </div>-->

       

        <?php
        $f_class = $this->router->fetch_class();
        $f_method = $this->router->fetch_method();
        if ($f_class != 'pages' && $f_class != 'auth' && ENVIRONMENT == 'production' && !$this->ua->is_mobile()):
            ?>
            <div class="box-body">
                <!-- G&R_250x250 -->
                <script id="GNR43257">
                    (function (i, g, b, d, c) {
                        i[g] = i[g] || function () {
                            (i[g].q = i[g].q || []).push(arguments)
                        };
                        var s = d.createElement(b);
                        s.async = true;
                        s.src = c;
                        var x = d.getElementsByTagName(b)[0];
                        x.parentNode.insertBefore(s, x);
                    })(window, 'gandrad', 'script', document, '//content.green-red.com/lib/display.js');
                    gandrad({siteid: 14374, slot: 43257});
                </script>
                <!-- End of G&R_250x250 -->
            </div>
        <?php endif; ?>


        <hr/>
        <div class="box-body">
            <div class="box-footer box-comments">
                <div class="box-comment">
                    <div class="comment-text">
                        <a  target="_blank" href="http://www.webcoachbd.com" rel="nofollow">Webcoachbd</a>
                        Largest Bengali tutorial site in this planet
                    </div>
                    <!-- /.comment-text -->
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</div>