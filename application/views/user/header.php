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
        <meta property="og:image" content="<?php echo base_url('assets/images/pothd.jpg'); ?>" />
        <link rel="icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>">

        <title><?php echo lang('pothdekhun') . ' : ' . $title; ?></title>
        <?php echo isset($load_css) ? $load_css : ''; ?>
        <script>
            !function(a){"use strict";var b=function(b,c,d){function e(a){if(h.body)return a();setTimeout(function(){e(a)})}function f(){i.addEventListener&&i.removeEventListener("load",f),i.media=d||"all"}var g,h=a.document,i=h.createElement("link");if(c)g=c;else{var j=(h.body||h.getElementsByTagName("head")[0]).childNodes;g=j[j.length-1]}var k=h.styleSheets;i.rel="stylesheet",i.href=b,i.media="only x",e(function(){g.parentNode.insertBefore(i,c?g:g.nextSibling)});var l=function(a){for(var b=i.href,c=k.length;c--;)if(k[c].href===b)return a();setTimeout(function(){l(a)})};return i.addEventListener&&i.addEventListener("load",f),i.onloadcssdefined=l,l(f),i};"undefined"!=typeof exports?exports.loadCSS=b:a.loadCSS=b}("undefined"!=typeof global?global:this);
        </script>
        <script>
            loadCSS("<?php echo base_url('assets/css/style.min.css?v=1.19'); ?>");
            loadCSS("<?php echo base_url('assets/css/bootstrap.min.css'); ?>");
        </script>

<!--[if lt IE 9]><script async src="<?php echo base_url('assets/js/ie8-responsive-file-warning.js'); ?>"></script><![endif]-->
<!--    <script async src="<?php echo base_url('assets/js/ie-emulation-modes-warning.js'); ?>"></script>-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script async src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script async src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <?php if (ENVIRONMENT == 'production'): ?>
            <script>
                (function (i, s, o, g, r, a, m) {
                    i['GoogleAnalyticsObject'] = r;
                    i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                    a = s.createElement(o),
                            m = s.getElementsByTagName(o)[0];
                    a.async = 1;
                    a.src = g;
                    m.parentNode.insertBefore(a, m)
                })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
                ga('create', 'UA-91403655-1', 'auto');
                ga('send', 'pageview');
            </script>
        <?php endif; ?>
    </head>

    <body>
        <div id="ploader"></div>

        <div class="container-fluid"><!-- container start here: ended in footer-->

            <div class="row">
                <?php $this->nl->breadcrumb(); ?>
                
