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
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Route Manager</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo $this->nl->is_selected('route_manager/index'); ?>">
                        <a href="<?php echo site_url('route_manager'); ?>"><i class="fa fa-circle-o"></i> Edited Routes</a>
                    </li>
                    <li class="<?php echo $this->nl->is_selected('route_manager/latest'); ?>">
                        <a href="<?php echo site_url('route_manager/latest'); ?>"><i class="fa fa-circle-o"></i> Latest Added</a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Transport Manager</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo $this->nl->is_selected('admin/latest_poribohon'); ?>">
                        <a href="<?php echo site_url('admin/latest_poribohon'); ?>"><i class="fa fa-circle-o"></i> Latest Poribohons</a>
                    </li>
                    <li class="<?php echo $this->nl->is_selected('admin/edited_poribohon'); ?>">
                        <a href="<?php echo site_url('admin/edited_poribohons'); ?>"><i class="fa fa-circle-o"></i> Edited Poribohons</a>
                    </li>
                </ul>

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