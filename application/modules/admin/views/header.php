<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/font-awesome.min.css'); ?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/ionicons.min.css'); ?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-select.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/css/admin_style.css'); ?>" >
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css'); ?>">
        <!-- 
        <link rel="stylesheet" href="<?php //echo base_url('assets/plugins/iCheck/flat/blue.css'); ?>">
         Morris chart 
        <link rel="stylesheet" href="<?php //echo base_url('assets/plugins/morris/morris.css'); ?>">
         jvectormap 
        <link rel="stylesheet" href="<?php //echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css'); ?>">
         Date Picker 
        <link rel="stylesheet" href="<?php //echo base_url('assets/plugins/datepicker/datepicker3.css'); ?>">
         Daterange picker 
        <link rel="stylesheet" href="<?php //echo base_url('assets/plugins/daterangepicker/daterangepicker-bs3.css'); ?>">
         bootstrap wysihtml5 - text editor 
        <link rel="stylesheet" href="<?php //echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>">-->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini <?php echo (!isset($login)) ? '' : ' login-page'; ?>">
        <?php if (!isset($login)): ?>
            <div class="wrapper">
                <header class="main-header">
                    <!-- Logo -->
                    <a href="<?php echo site_url('b_janina'); ?>" class="logo">
                        <!-- mini logo for sidebar mini 50x50 pixels -->
                        <span class="logo-mini"><b>P</b>dk</span>
                        <!-- logo for regular state and mobile devices -->
                        <span class="logo-lg"><b>Poth</b>Dekhun</span>
                    </a>
                    <!-- Header Navbar: style can be found in header.less -->
                    <nav class="navbar navbar-static-top" role="navigation">
                        <!-- Sidebar toggle button-->
                        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                            <span class="sr-only">Toggle navigation</span>
                        </a>

                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">

                                <!-- User Account: style can be found in dropdown.less -->
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg'); ?>" class="user-image" alt="User Image">
                                        <span class="hidden-xs"><?php echo $this->session->username; ?></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- User image -->
                                        <li class="user-header">
                                            <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">

                                            <p>
                                                <?php echo $this->session->username; ?>
                                                <small>Member since Nov. 2012</small>
                                            </p>
                                        </li>

                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="<?php echo site_url('profile'); ?>" class="btn btn-default btn-flat">Profile</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>
                <?php $this->load->view('admin/leftbar'); ?>
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <h1>
                            Dashboard
                            <small>Control panel</small>
                        </h1>
                        <?php $this->nl->breadcrumb(); ?>
                    </section>

                    <!-- Main content -->
                    <section class="content">

                        <!-- Small boxes (Stat box) -->
                        <div class="row">
                        <?php endif; ?>
