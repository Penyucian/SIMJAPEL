<?php echo $this->breadcrump(); ?>

<div class="panel">
    <div class="panel-heading">
        <span class="panel-title"><b>Daftar</b> Grup</span>
        <div class="panel-heading-controls"></div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="clearfix">
                <?php if (!empty($access)): ?>
                    <?php foreach ($access as $aks): ?>
                        <div class="widget-products-item col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a class="btn btn-block btn-lg <?php
                            echo ($this->session->userdata('__group_menu_id') === $aks["group_menu_id"] &&
                                $this->session->userdata('__user_tipe_nomor') === $aks["user_tipe_nomor"]) ? "btn-primary" : ""; ?>"
                               href="<?php echo site_url("sys/change_group/change_group_proses?groupMenu=" .
                                   $this->encryption_lib->urlencode($aks["group_menu_id"]) . '&groupMenuNama=' .
                                   urlencode($aks["group_menu_nama"]) . '&userTipeNomor=' .
                                   urlencode($aks["user_tipe_nomor"]).'&nomor='.$this->encryption_lib->urlencode($aks["user_tipe_nomor"])); ?>">
                                <?php echo ucfirst(strtolower($aks["group_menu_nama"])); ?>

                                <?php if ($aks['user_tipe_nomor']): ?>
                                    <br /><i>(<?php echo $aks['user_tipe_nomor']; ?>)</i>
                                <?php endif; ?>
                                <i class="<?php echo ($this->session->userdata('__group_menu_id') === $aks["group_menu_id"] &&
                                    $this->session->userdata('__user_tipe_nomor') === $aks["user_tipe_nomor"]) ? "fa fa-check-square-o" : "fa fa-square-o";
                                ?>"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>

                <?php else: ?>
                    <div class='alert alert-danger'>Data Tidak Ditemukan</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>