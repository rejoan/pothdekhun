<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$ln = $this->session->language;
?>
<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url_tr('route'); ?>"><?php echo $this->lang->line('home'); ?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php if ($this->session->user_id) { ?>
                    <li class="<?php echo $this->nl->is_selected('profile'); ?>"><a href="<?php echo site_url_tr('profile'); ?>"><?php echo $this->lang->line('profile'); ?></a></li>
                    <li class="<?php echo $this->nl->is_selected('route'); ?>"><a href="<?php echo site_url_tr('route/add'); ?>"><?php echo $this->lang->line('add_transport_button'); ?></a></li>
                <?php } else { ?>
                    <li class="<?php echo $this->nl->is_selected('users/login'); ?>"><a href="<?php echo site_url_tr('users/login'); ?>"><?php echo $this->lang->line('m_login'); ?></a></li>
                    <li class="<?php echo $this->nl->is_selected('users/register'); ?>"><a href="<?php echo site_url_tr('users/register'); ?>"><?php echo $this->lang->line('m_register'); ?></a></li>
                <?php } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if ($this->session->user_id): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->username; ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url_tr('profile'); ?>"><i class="fa fa-eye"></i> <?php echo $this->lang->line('profile'); ?></a></li>
                            <li><a href="<?php echo site_url_tr('users/logout'); ?>"><i class="fa fa-power-off"></i> <?php echo $this->lang->line('logout'); ?></a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php echo language_menu(); ?>
            </ul>
        </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
</nav><!-- /.navbar -->