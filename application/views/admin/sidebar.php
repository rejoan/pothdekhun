<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->username;?></p>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="<?php echo site_url('admin'); ?>"><i class="fa fa fa-dashboard"></i> Dashboard</a></li>

            <li class="treeview <?php echo $this->nuts_lib->is_selected('routes');?>">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Route Manager</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo $this->nuts_lib->is_selected('routes');?>"><a href="<?php echo site_url('routes'); ?>"><i class="fa fa-navicon"></i> All Route</a></li>
                    <li class="<?php echo $this->nuts_lib->is_selected('newly_edited');?>"><a href="<?php echo site_url('routes/newly_edited'); ?>"><i class="fa fa-plus"></i> Newly Edited</a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo site_url('mentor'); ?>">
                    <i class="fa fa-users"></i> <span>User Manager</span>
                </a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>