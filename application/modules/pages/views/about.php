<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-sm-6 col-sm-push-3">
    <div class="box box-poth">
        <div class="box-header">
            <h3 class="box-title"><?php echo lang('about_us'); ?></h3>
        </div>
        <div class="box-body" style="font-size:16px;">
            <h1><?php echo lang('why_pothdekhun') ?></h1>
            <p><?php echo lang('descr1'); ?></p>
            <h3> <?php echo lang('descr2') ?></h3>
            <p><?php echo lang('descr4'); ?></p>
            <div class="callout callout-info">
                <h4><?php echo lang('descr3'); ?>  (<a target="_blank" href="<?php echo site_url_tr('routes/add'); ?>"><?php echo lang('add_here'); ?></a>) <?php echo lang('add_descr'); ?></h4>

                <p><?php echo lang('add_inspire').' <strong>'.$total.'</strong> '.lang('routes_more'); ?></p>
            </div>

            <div class="callout callout-success">
                <h4><?php echo lang('about_project'); ?></h4>

                <p><?php echo lang('tech_used'); ?>
                    <a target="_blank" href="https://en.wikipedia.org/wiki/PHP">PHP</a>
                    <a target="_blank" href="https://en.wikipedia.org/wiki/MySQL">MySQL</a>
                    <a target="_blank" href="https://en.wikipedia.org/wiki/CodeIgniter">CodeIgniter 3</a>
                    <a target="_blank" href="https://en.wikipedia.org/wiki/Hierarchical_model%E2%80%93view%E2%80%93controller">HMVC</a>
                    <a target="_blank" href="https://en.wikipedia.org/wiki/JQuery">jQuery</a>
                    <a target="_blank" href="https://en.wikipedia.org/wiki/Node.js">NodeJS</a>
                </p>
            </div>
<!--            <p>Developer Information</p>
            <div class="info-box" style="box-shadow:0px 0px 4px 1px #ddd">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Rejoanul Alam [refatju AT yahoo DOT com]</span>
                    <span class="info-box-number"><a target="_blank" href="http://www.zend.com/en/yellow-pages/ZEND029384">Zend Certified Engineer</a></span>
                    <span class="info-box-number">Administrator <a target="_blank" href="http://www.webcoachbd.com">Webcoachbd</a></span>
                </div>
                 /.info-box-content 
            </div>-->
        </div>
    </div>
</div>