<div class="navbar-header">
    <a class="navbar-brand px-demo-brand" href="#_"><?php echo $this->config->item('nama_sistem'); ?></a>
</div>
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#px-demo-navbar-collapse" aria-expanded="false"><i class="navbar-toggle-icon"></i></button>
<div class="collapse navbar-collapse" id="px-demo-navbar-collapse">
    <ul class="nav navbar-nav"></ul>
    <ul class="nav navbar-nav navbar-right">
        <?php if (!$this->user_auth_lib->is_login()): ?>
        <li>
            <a href="<?php echo site_url('sys/signin') ?>">
                <img src="<?php echo $user_image; ?>" alt="" class="px-navbar-image">
                <span class="hidden-md">Login</span>
            </a>
        </li>
        <?php else: ?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="<?php echo $user_image; ?>" alt="" class="px-navbar-image">
            <span class="hidden-md">
                <?php echo $this->session->userdata('__nama_lengkap'); ?> 
                <i> (<?php echo $this->session->userdata('__group_menu_nama') ?>) </i>
            </span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="<?php echo site_url('sys/change_group/'); ?>" class="xhr dest_subcontent-element"><i class="dropdown-icon fa fa-random"></i>&nbsp;&nbsp;Ganti Group</a></li>
                <li><a href="<?php echo site_url('sys/change_password/'); ?>" class="xhr dest_subcontent-element"><i class="dropdown-icon fa fa-unlock-alt"></i>&nbsp;&nbsp;&nbsp;Ganti Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo site_url('sys/signin/signout_proses') ?>"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>         
            </ul>
        </li>
        <?php endif; ?>
    </ul>
</div>