<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Return multilingual url depending on the current language
 * @param string $url
 * @return string
 * @author Rejoanul Alam
 */

/**
 * get box HTML
 * @param controller/action $url
 * @param bg of box $bg
 * @param the data to output $data
 * @param text to display $main_text
 * @return html
 */
function create_box($bg, $data, $main_text, $url) {
    return '<div class="col-lg-3 col-xs-6">
        <div class="small-box ' . $bg . '">
            <div class="inner">
                <h3>' . $data . '</h3>

                <p>' . $main_text . '</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="' . site_url($url) . '" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>';
}

function get_status($publish_status) {
    if ($publish_status == 0) {
        $status = 'Pending';
        $class = 'label-danger';
    } elseif ($publish_status == 1) {
        $status = 'Published';
        $class = 'label-success';
    } else {
        $status = 'Revise Required';
        $class = 'label-warning';
    }
    return '<span data-toggle="tooltip" data-placement="top" title="'.$status.'" class="label ' . $class . '">' . strtok($status,' ') . '</span';
}
