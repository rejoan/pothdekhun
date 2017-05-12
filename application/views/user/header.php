<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="<?php echo $this->session->lang_code; ?>">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="keywords" content="<?php echo isset($meta_title) ? make_keywords($meta_title) : make_keywords($title); ?>" />
        <meta name="description" content="<?php echo isset($meta_title) ? $meta_title : $title; ?>">
        <meta name="author" content="Rejoanul Alam">
        <meta name="google-signin-scope" content="profile email">
        <meta name="google-signin-client_id" content="606528754739-mag1caviaal84rdm8uirn108fmlr8raa.apps.googleusercontent.com">
        <meta property="og:image" content="http://www.pothdekhun.com/assets/images/pothd.jpg" />
<!--        <script src="https://apis.google.com/js/platform.js" async defer></script>-->
        <link rel="icon" href="<?php echo base_url('assets/images') . '/favicon.ico'; ?>">

        <title><?php echo lang('pothdekhun') . ' : ' . $title; ?></title>
        <?php
        $f_class = $this->router->fetch_class();
        $f_method = $this->router->fetch_method();
        ?>
        <!-- Bootstrap core CSS -->
<!--        <link rel="preload" href="<?php //echo base_url('assets/css/bootstrap.min.css'); ?>" as="style" onload="this.rel = 'stylesheet'">-->
        <?php echo isset($load_css) ? $load_css : ''; ?>
        <script>
             !function(a){"use strict";var b=function(b,c,d){function j(a){if(e.body)return a();setTimeout(function(){j(a)})}function l(){f.addEventListener&&f.removeEventListener("load",l),f.media=d||"all"}var g,e=a.document,f=e.createElement("link");if(c)g=c;else{var h=(e.body||e.getElementsByTagName("head")[0]).childNodes;g=h[h.length-1]}var i=e.styleSheets;f.rel="stylesheet",f.href=b,f.media="only x",j(function(){g.parentNode.insertBefore(f,c?g:g.nextSibling)});var k=function(a){for(var b=f.href,c=i.length;c--;)if(i[c].href===b)return a();setTimeout(function(){k(a)})};return f.addEventListener&&f.addEventListener("load",l),f.onloadcssdefined=k,k(l),f};"undefined"!=typeof exports?exports.loadCSS=b:a.loadCSS=b}("undefined"!=typeof global?global:this);
        </script>
        <script>
            loadCSS('<?php echo base_url('assets/css/style.min.css?v=1.14'); ?>');
            loadCSS('<?php echo base_url('assets/css/bootstrap.min.css'); ?>');
        </script>
<!--        <link rel="preload" href="<?php //echo base_url('assets/css/style.min.css?v=1.14');  ?>" as="style" onload="this.rel='stylesheet'">-->

        <?php if ($this->ua->is_mobile()): ?>
            <style>
                #ploader {
                    position: fixed;
                    left: 0px;
                    top: 0px;
                    width: 100%;
                    height: 100%;
                    z-index: 9999;
                    background: url('<?php echo base_url('assets/images/loading.gif'); ?>') 50% 50% no-repeat rgb(249,249,249);
                }
            </style>
        <?php endif; ?>

<!--[if lt IE 9]><script async src="<?php echo base_url('assets/js/ie8-responsive-file-warning.js'); ?>"></script><![endif]-->
<!--    <script async src="<?php echo base_url('assets/js/ie-emulation-modes-warning.js'); ?>"></script>-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script async src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script async src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script  src="<?php echo base_url('assets/js/jquery-3.2.0.min.js'); ?>"></script>
        

    </head>

    <body>
        <div id="ploader"></div>

        <div class="container-fluid"><!-- container start here: ended in footer-->

            <div class="row">
                <?php $this->nl->breadcrumb(); ?>
                
