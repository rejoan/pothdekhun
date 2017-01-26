<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url_tr('routes'); ?>"><?php echo lang('home'); ?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php
                if ($this->session->user_type == 'admin') {
                    $this->nl->generate_link('admin', 'admin', NULL, 'Admin');
                }
                if ($this->session->user_id) {
                    $this->nl->generate_link('profile', 'profile', NULL, lang('profile'));
                } else {
                    $this->nl->generate_link('auth/login', 'auth/login', NULL, lang('m_login'));
                    $this->nl->generate_link('auth/register', 'auth/register', NULL, lang('m_register'));
                }
                ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo lang('routes'); ?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                        $this->nl->generate_link('routes/all', 'routes/all', 'fa-list', lang('all_routes'));
                        $this->nl->generate_link('routes/add', 'routes/add', 'fa-plus', lang('add_route'));
                        ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo lang('transports'); ?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                        $this->nl->generate_link('transports', 'transports', 'fa-list', lang('all_transport'));
                        $this->nl->generate_link('transports/add', 'transports/add', 'fa-plus', lang('add_transport'));
                        ?>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo lang('drivers'); ?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                        $this->nl->generate_link('drivers', 'drivers', 'fa-list', lang('drivers'));
                        $this->nl->generate_link('drivers/add', 'drivers/add', 'fa-plus', lang('add_driver'));
                        $this->nl->generate_link('drivers/hire', 'drivers/hire', 'fa-binoculars', lang('need_driver'));
                        ?>
                    </ul>
                </li>


            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if ($this->session->user_id): ?>
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                            page and may cause design problems
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-red"></i> 5 new members joined
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user text-red"></i> You changed your username
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->username; ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url_tr('profile'); ?>"><i class="fa fa-eye"></i> <?php echo lang('profile'); ?></a></li>
                            <li><a href="<?php echo site_url_tr('auth/logout'); ?>"><i class="fa fa-power-off"></i> <?php echo lang('logout'); ?></a></li>
                        </ul>
                    </li>

                <?php endif; ?>

                <?php echo language_menu(); ?>
            </ul>
        </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
</nav><!-- /.navbar -->