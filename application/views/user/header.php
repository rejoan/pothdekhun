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
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
        <?php if (($f_class == 'routes' || $f_class == 'transports' || $f_class == 'profile') && ($f_method == 'add' || $f_method == 'edit') || $f_method == 'all' || $f_method == 'show'): ?>
            <link rel="stylesheet" href="<?php echo base_url('assets/plugins/jQueryUI/jquery-ui.min.css'); ?>">
            <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap-sweetalert/dist/sweetalert.css'); ?>">

            <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fancybox/jquery.fancybox.css'); ?>">
        <?php endif; ?>
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/media/css/jquery.dataTables.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css?v=1.12'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-select.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/font-awesome.min.css'); ?>">
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
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">

<!--[if lt IE 9]><script async src="<?php echo base_url('assets/js/ie8-responsive-file-warning.js'); ?>"></script><![endif]-->
<!--    <script async src="<?php echo base_url('assets/js/ie-emulation-modes-warning.js'); ?>"></script>-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script async src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script async src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script <?php echo $this->ua->is_mobile()? '':'async';?> type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>
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
                <?php if ($f_class != 'pages' && $f_class != 'auth' && ENVIRONMENT == 'production' && !$this->ua->is_mobile()) { ?>
                    <!-- G&R_970x90 -->
                    <script id="GNR43027">
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
                        gandrad({siteid: 14374, slot: 43027});
                    </script>
                    <!-- End of G&R_970x90 -->

                <?php } else { ?>
                    <!-- G&R_320x50 -->
                    <script id="GNR43025">
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
                        gandrad({siteid: 14374, slot: 43025});
                    </script>
                    <!-- End of G&R_320x50 -->
                <?php } ?>
