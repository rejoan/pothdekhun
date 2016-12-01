<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="google-signin-scope" content="profile email">
        <meta name="google-signin-client_id" content="606528754739-mag1caviaal84rdm8uirn108fmlr8raa.apps.googleusercontent.com">
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <link rel="icon" href="<?php echo base_url('assets/images') . '/favicon.ico'; ?>">

        <title><?php echo $title; ?></title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-select.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/ionicons.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/flat/blue.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap-sweetalert/dist/sweetalert.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">
        <!--[if lt IE 9]><script src="<?php echo base_url('assets/js/ie8-responsive-file-warning.js'); ?>"></script><![endif]-->
    <!--    <script src="<?php echo base_url('assets/js/ie-emulation-modes-warning.js'); ?>"></script>-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>
    </head>

    <body>
        <div class="container-fluid"><!-- container start here: ended in footer-->
            <div class="row">
                <div class="col-xs-12">
                    <?php $this->nl->breadcrumb(); ?>