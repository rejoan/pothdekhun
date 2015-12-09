<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
        </div>
      </div>
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active"><a href="<?php echo site_url('admin');?>"><i class="fa fa-circle-o"></i> Dashboard</a></li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Route Manager</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
            <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
          </ul>
        </li>
        <li>
            <a href="<?php echo site_url('mentor');?>">
            <i class="fa fa-calendar"></i> <span>User Manager</span>
            <small class="label pull-right bg-red">3</small>
          </a>
        </li>
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>