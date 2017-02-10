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
            <?php $this->nl->generate_link('b_janina', 'b_janina', 'fa-dashboard', 'Dashboard'); ?>

            <li class="treeview <?php echo $this->nl->is_selected('route_manager,route_manager/latest'); ?>">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Route Manager</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php
                    $this->nl->generate_link('route_manager/index', 'route_manager', 'fa-circle-o', 'Edited Routes');
                    $this->nl->generate_link('route_manager/latest', 'route_manager/latest', 'fa-circle-o', 'Latest Added');
                     $this->nl->generate_link('route_manager/revise_required', 'route_manager/revise_required', 'fa-circle-o', 'Revise Required');
                    ?>
                </ul>
            </li>

            <li class="treeview <?php echo $this->nl->is_selected('b_janina/latest_poribohon,b_janina/edited_poribohon'); ?>">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Transport Manager</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php
                    $this->nl->generate_link('admin/edited_poribohon', 'b_janina/edited_poribohons', 'fa-circle-o', 'Edited Poribohons');
                    $this->nl->generate_link('admin/latest_poribohon', 'b_janina/latest_poribohon', 'fa-circle-o', 'Latest Poribohons');
                    ?>
                </ul>

            </li>

            <?php
            $this->nl->generate_link('users', 'users', 'fa-circle-o', 'User Manager');
            $this->nl->generate_link('comments', 'comments', 'fa-circle-o', 'Comment Manager');
            $this->nl->generate_link('contact', 'comments/contact', 'fa-circle-o', 'Contact Manager');
            ?>
            <li>
                <a href="<?php echo site_url('routes'); ?>" target="_blank">
                    <i class="fa fa-anchor"></i> <span>Front End</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>