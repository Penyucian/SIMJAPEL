<button type="button" class="px-nav-toggle" data-toggle="px-nav" id="px-demo-nav-collapse">
    <span class="px-nav-toggle-arrow"></span>
    <span class="navbar-toggle-icon"></span>
    <span class="px-nav-toggle-label font-size-11">HIDE MENU</span>
</button>
<ul class="px-nav-content">
    <?php if ($this->user_auth_lib->is_login()): ?>
        <li class="px-nav-box p-a-3 b-b-1" id="demo-px-nav-box">
            <img src="<?php echo $user_image; ?>" alt="" class="pull-xs-left m-r-2 border-round" style="width: 54px; height: 54px;">
            <div class="font-size-16">
                <span class="text-semibold"><?php echo $this->session->userdata('__group_menu_nama') ?></span>
                    <br /><i class="text-slim" id="user_tipe_nomor"><?php echo $this->session->userdata('__user_tipe_nomor'); ?></i>
            </div>
            <div class="btn-group" style="margin-top: 4px;">
                <a href="<?php echo site_url('sys/change_group/view_change_group'); ?>" class="btn btn-xs btn-primary btn-outline" title="Switch Group"><i class="fa fa-random"></i></a>
                <a href="<?php echo site_url('sys/signin/signout_proses'); ?>" class="btn btn-xs btn-danger btn-outline" title="Logout"><i class="fa fa-power-off"></i></a>
            </div>
        </li>
    <?php endif; ?>

    <?php foreach ($menu as $row) { if ($row->parent_id == 0) { ?>
        <?php
            $isParent = 0;
            foreach ($menu as $row1) {
                if ($row1->parent_id == $row->id){
                    $isParent = 1;
                    break;
                }
            }
        ?>

        <li class="<?php if ($isParent){ echo "px-nav-dropdown px-nav-item"; } else { echo "px-nav-item"; } ?>">
            <a href="<?php if (!$isParent) { echo site_url($row->module.'/'.$row->controller.'/'.$row->function); } else { echo '#'; } ?>" class="<?php if (!$isParent) { echo 'xhr dest_subcontent-element'; }; ?>">

                <?php if ($row->css_clip) { ?>
                <i class="px-nav-icon fa <?php echo "$row->css_clip" ?>"></i>
                <?php } ?>

                <span class="px-nav-label"><?php echo $row->menu ?></span>

                <?php if ($row->label) { ?>
                <span class="label <?php echo "$row->css_label" ?>"><?php echo $row->label ?></span>
                <?php } ?>

            </a>

            <?php if ($isParent) { ?>
            <ul class="px-nav-dropdown-menu">

                <?php foreach ($menu as $subRow) { if ($subRow->parent_id == $row->id) { ?>
                <?php 
                    $isSubParent = 0;
                    foreach ($menu as $sub_row1) {
                        if ($sub_row1->parent_id == $subRow->id){
                            $isSubParent = 1;
                            break;
                        }
                    }
                ?>

                <li class="<?php if ($isSubParent){ echo "px-nav-dropdown px-nav-item";} else { echo "px-nav-item"; } ?>">
                    <a href="<?php if (!$isSubParent) { echo site_url($subRow->module.'/'.$subRow->controller.'/'.$subRow->function); } else { echo '#'; } ?>" class="<?php if (!$isSubParent) { echo 'xhr dest_subcontent-element'; }; ?>">

                        <?php if ($subRow->css_clip) { ?>
                        <i class="px-nav-icon fa <?php echo "$subRow->css_clip" ?>"></i>
                        <?php } ?>

                        <span class="px-nav-label"><?php echo $subRow->menu ?></span>

                        <?php if ($subRow->label) { ?>
                        <span class="label <?php echo "$subRow->css_label" ?>"><?php echo $subRow->label ?></span>
                        <?php } ?>

                    </a>

                    <?php if ($isSubParent) { ?>
                    <ul class="px-nav-dropdown-menu">

                        <?php foreach ($menu as $subRow1) { if ($subRow1->parent_id == $subRow->id) { ?>
                        <li class="px-nav-item">
                            <a href="<?php echo site_url($subRow1->module.'/'.$subRow1->controller.'/'.$subRow1->function) ?>" class="xhr dest_subcontent-element">

                                <?php if ($subRow1->css_clip) { ?>
                                <i class="px-nav-icon fa <?php echo "$subRow1->css_clip" ?>"></i>
                                <?php } ?>

                                <span class="px-nav-label"><?php echo $subRow1->menu ?></span>

                                <?php if ($subRow1->label) { ?>
                                <span class="label <?php echo "$subRow1->css_label" ?>"><?php echo $subRow1->label ?></span>
                                <?php } ?>

                            </a>
                        </li>
                        <?php }} ?>

                    </ul>
                    <?php } ?>

                </li>
                <?php }} ?>

            </ul>
            <?php } ?>

        </li>
        <?php }} ?>
    <?php if ($this->user_auth_lib->is_login()): ?>    
        <li class="px-nav-item">
            <a href="<?php echo site_url('sys/change_group/'); ?>" class="xhr dest_subcontent-element">
                <i class="px-nav-icon fa fa-random"></i>
                <span class="px-nav-label">Ganti Group</span>
            </a>
        </li>
        <li class="px-nav-item">
            <a href="<?php echo site_url('sys/change_password/'); ?>" class="xhr dest_subcontent-element">
                <i class="px-nav-icon fa fa-lock"></i>
                <span class="px-nav-label">Ganti Password</span>
            </a>
        </li>
        <li class="px-nav-item">
            <a href="<?php echo site_url('sys/signin/signout_proses/'); ?>">
                <i class="px-nav-icon fa fa-power-off"></i>
                <span class="px-nav-label">Logout</span>
            </a>
        </li>  
        <li class="px-nav-box b-t-1 p-a-2">
            <a href="#" class="btn btn-primary btn-block btn-outline">
                <?php echo $this->config->item('version'); ?>
            </a>
        </li>
    <?php endif; ?>
</ul>
<script>
    $('li.px-nav-item a').click(function(event){     
        menu_selected(this);
    });

    function menu_selected(object) {
        var url = typeof object !== 'undefined' ? object.getAttribute("href") : location.pathname;
        var split_url = url.split('/');
        var join_url = url;
        for (i = 0; i <= split_url.length; i++) {
            if (join_url !== "") {
                if ($('li.px-nav-item a[href$="' + join_url + '/"]').length > 0) {
                    $('.px-nav-item').removeClass("active");
                    $('.px-nav-dropdown').removeClass("active");
            
                    $('li.px-nav-item a[href$="' + join_url + '/"]').parents('li.px-nav-dropdown').addClass('px-open');
                    $('li.px-nav-item a[href$="' + join_url + '"]').parents('li.px-nav-dropdown').addClass('active');
                    $('li.px-nav-item a[href$="' + join_url + '/"]').parent().addClass('active');
                    return;
                }
            }
            split_url = join_url.split('/');
            split_url.pop();
            join_url = split_url.join('/');
        }
    }
    
    function url_selected(url) {
        var split_url = url.split('/');
        var join_url = url;
        for (i = 0; i <= split_url.length; i++) {
            if (join_url !== "") {
                if ($('li.px-nav-item a[href$="' + join_url + '/"]').length > 0) {
                    $('.px-nav-item').removeClass("active");
                    $('.px-nav-dropdown').removeClass("active");
            
                    $('li.px-nav-item a[href$="' + join_url + '/"]').parents('li.px-nav-dropdown').addClass('px-open');
                    $('li.px-nav-item a[href$="' + join_url + '"]').parents('li.px-nav-dropdown').addClass('active');
                    $('li.px-nav-item a[href$="' + join_url + '/"]').parent().addClass('active');
                    return;
                }
            }
            split_url = join_url.split('/');
            split_url.pop();
            join_url = split_url.join('/');
        }
    }
</script>