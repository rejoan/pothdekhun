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
            <a class="navbar-brand" href="<?php echo site_url('road?ln=') . $this->session->ln; ?>"><?php echo $this->lang->line('home'); ?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="<?php echo $this->nut_bolts->is_selected('users/login'); ?>"><a href="<?php echo site_url('users/login?ln=') . $this->session->ln; ?>"><?php echo $this->lang->line('m_login'); ?></a></li>
                <li class="<?php echo $this->nut_bolts->is_selected('users/register'); ?>"><a href="<?php echo site_url('users/register?ln=') . $this->session->ln; ?>"><?php echo $this->lang->line('m_register'); ?></a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if ($this->session->user_id): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->username;?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('profile?ln=') . $this->session->ln; ?>"><?php echo $this->lang->line('profile'); ?></a></li>
                            <li><a href="<?php echo site_url('users/logout'); ?>"><?php echo $this->lang->line('logout'); ?></a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li><a href="<?php echo $ln == 'english' ? current_url() . '?ln=bn' : current_url() . '?ln=en'; ?>"><?php echo $ln == 'english' ? 'Bengali' : 'English'; ?></a></li>
            </ul>
        </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
</nav><!-- /.navbar -->