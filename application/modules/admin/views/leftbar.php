<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->username; ?></p>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="<?php echo site_url('admin'); ?>"><i class="fa fa fa-dashboard"></i> Dashboard</a>
            </li>

            <li class="<?php echo $this->nl->is_selected('route_manager'); ?>">
                <a href="<?php echo site_url('route_manager'); ?>"><i class="fa fa-navicon"></i> Edited Routes</a>
            </li>
            <li>
                <a href="<?php echo site_url('users'); ?>">
                    <i class="fa fa-users"></i> <span>User Manager</span>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('routes'); ?>" target="_blank">
                    <i class="fa fa-anchor"></i> <span>Front End</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>