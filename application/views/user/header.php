<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="<?php echo $this->session->lang_code; ?>">
    <head>
        <?php if (ENVIRONMENT == 'production'): ?>
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({
                    google_ad_client: "ca-pub-8715007142406485",
                    enable_page_level_ads: true
                });
            </script>
        <?php endif; ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="keywords" content="<?php echo isset($meta_title) ? make_keywords($meta_title) : make_keywords($title); ?>" />
        <meta name="description" content="<?php echo isset($meta_title) ? $meta_title : $title; ?>">
        <meta name="author" content="Rejoanul Alam">
        <meta name="google-signin-scope" content="profile email">
        <meta name="google-signin-client_id" content="606528754739-mag1caviaal84rdm8uirn108fmlr8raa.apps.googleusercontent.com">
<!--        <script src="https://apis.google.com/js/platform.js" async defer></script>-->
        <link rel="icon" href="<?php echo base_url('assets/images') . '/favicon.ico'; ?>">

        <title><?php echo $title; ?> | PothDekhun</title>
        <?php
        $f_class = $this->router->fetch_class();
        $f_method = $this->router->fetch_method();
        ?>
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" >
        <?php if (($f_class == 'routes' || $f_class == 'transports' || $f_class == 'profile') && ($f_method == 'add' || $f_method == 'edit') || $f_method == 'all' || $f_method == 'show'): ?>
            <link rel="stylesheet" href="<?php echo base_url('assets/plugins/jQueryUI/jquery-ui.min.css'); ?>" >
            <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap-sweetalert/dist/sweetalert.css'); ?>">

            <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fancybox/jquery.fancybox.css'); ?>">
        <?php endif; ?>
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/media/css/jquery.dataTables.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css?v=1.7'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-select.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/ionicons.min.css'); ?>">


        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">

<!--[if lt IE 9]><script src="<?php echo base_url('assets/js/ie8-responsive-file-warning.js'); ?>"></script><![endif]-->
<!--    <script src="<?php echo base_url('assets/js/ie-emulation-modes-warning.js'); ?>"></script>-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>
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

        <div class="container-fluid"><!-- container start here: ended in footer-->

            <div class="row">
                <?php $this->nl->breadcrumb(); ?>