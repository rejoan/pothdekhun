<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * geo locator helper by @rejoanul alam
 * Get Geo Location by Given/Current IP address
 *
 * @access    public
 * @param    string
 * @return    array
 */
include('ip2locationlite.class.php');
if (!function_exists('get_geolocation')) {

    function get_geolocation($ip) {
//Load the class
        $ipLite = new ip2location_lite;
        $ipLite->setKey('bd980d08b40324a47e67ff0f85da4e20d6d0e5afa05f495e424a2f7e80898a2b');

//Get errors and locations
        $locations = $ipLite->getCity($ip);
        //$errors = $ipLite->getError();

//Getting the result
//        echo "<p>\n";
//        echo "<strong>First result</strong><br />\n";
        if (!empty($locations) && is_array($locations)) {
            return $locations;
//            foreach ($locations as $field => $val) {
//                echo $field . ' : ' . $val . "<br />\n";
//            }
        } else {
            return 'down';
        }
//        echo "</p>\n";
//
////Show errors
//        echo "<p>\n";
//        echo "<strong>Dump of all errors</strong><br />\n";
//        if (!empty($errors) && is_array($errors)) {
//            foreach ($errors as $error) {
//                echo var_dump($error) . "<br /><br />\n";
//            }
//        } else {
//            echo "No errors" . "<br />\n";
//        }
//        echo "</p>\n";
    }

}