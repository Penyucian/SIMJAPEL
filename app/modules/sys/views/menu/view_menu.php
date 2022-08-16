<style type="text/css">
    .panel-controls {
        position:absolute;
        right:5px;
        top:8px;
    }

    .panel-group {
        margin-bottom: 0px
    }

    .panel-heading {
        position:relative;
    }

</style>

<?php echo $this->breadcrump(); ?>
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Daftar Menu</span>
        <div class="panel-heading-controls">
            <a href="<?php echo site_url('sys/menu/add_menu')?>" class="btn btn-flat btn-sm btn-labeled btn-success xhr dest_subcontent-element">
            <span class="icon fa fa-plus"></span> Menu</a>
        </div>
    </div>
    <div class="panel-body">
        <div class="panel-group sortable" id="root-menu">
        <?php 
            foreach ($listMenu as $idx => $row) { 
                if ($row['menu_parent_id'] == 0) {
                    $isParent = 0;
                    foreach ($listMenu as $row1) {
                        if ($row1['menu_parent_id'] == $row['menu_id']){
                            $isParent = 1;
                            break;
                        }
                    }
        ?>            
                    <div class="panel panel-default" data-parent-id="0" data-menu-id="<?php echo $row['menu_id'] ?>">
                        <div class="panel-heading">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#root-menu" href="#root-menu-<?php echo $idx ?>">
                                <?php echo $row['menu_nama'] ?>
                            </a>
                            <div class="panel-controls">
                                <?php 
                                    if ($isParent == 0){
                                        echo '
                                            <a href="'.site_url('sys/menu/delete_menu').'/'.$row['menu_id'].'" class="btn btn-danger btn-sm xhrs dest_subcontent-element confirm-remove" data-toggle="tooltip" data-placement="left" title="hapus"> 
                                                <span class="icon fa fa-trash-o"></span>
                                            </a>
                                        ';
                                    }
                                ?>
                               
                                <a class="btn btn-warning btn-sm xhr dest_subcontent-element" href="<?php echo site_url('sys/menu/update_menu').'/'.$row['menu_id'] ?>" data-toggle="tooltip" data-placement="left" title="ubah">
                                    <span class="icon fa fa-pencil"></span>
                                </a>                                
                            </div>
                        </div> 
                        <div id="root-menu-<?php echo $idx ?>" class="panel-collapse collapse">
                        <?php 
                            if ($isParent) {
                        ?>
                                <div class="panel-body">
                                    <div class="panel-group sortable" id="sub-menu1">
                        <?php
                                foreach ($listMenu as $idx1 => $subRow) { 
                                    if ($subRow['menu_parent_id'] == $row['menu_id']) {
                                        $isSubParent = 0;
                                        foreach ($listMenu as $subRow1) {
                                            if ($subRow1['menu_parent_id'] == $subRow['menu_id']){
                                                $isSubParent = 1;
                                                break;
                                            }
                                        }
                        ?>
                                        <div class="panel panel-warning" data-parent-id="<?php echo $subRow['menu_parent_id'] ?>" data-menu-id="<?php echo $subRow['menu_id'] ?>">
                                            <div class="panel-heading">
                                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#sub-menu1" href="#sub-menu1-<?php echo $idx1 ?>">
                                                     <?php echo $subRow['menu_nama'] ?>
                                                </a>
                                                <div class="panel-controls">
                                                    <?php 
                                                        if ($isSubParent == 0){
                                                            echo '
                                                                <a href="'.site_url('sys/menu/delete_menu').'/'.$subRow['menu_id'].'" class="btn btn-danger btn-sm xhrs dest_subcontent-element confirm-remove" data-toggle="tooltip" data-placement="left" title="hapus"> 
                                                                    <span class="icon fa fa-trash-o"></span>
                                                                </a>
                                                            ';
                                                        }
                                                    ?>
                                                   
                                                    <a class="btn btn-warning btn-sm xhr dest_subcontent-element" href="<?php echo site_url('sys/menu/update_menu').'/'.$subRow['menu_id'] ?>" data-toggle="tooltip" data-placement="left" title="ubah">
                                                        <span class="icon fa fa-pencil"></span>
                                                    </a>                                                    
                                                </div>
                                            </div> 
                                            <div id="sub-menu1-<?php echo $idx1 ?>" class="panel-collapse collapse">
                                            <?php 
                                                if ($isSubParent) { 
                                            ?>
                                                <div class="panel-body">
                                                    <div class="panel-group sortable" id="sub-menu2">
                                                    <?php 
                                                        foreach ($listMenu as $idx2 => $subRow2) { 
                                                            if ($subRow2['menu_parent_id'] == $subRow['menu_id']) {
                                                    ?>
                                                                <div class="panel panel-danger" data-parent-id="<?php echo $subRow2['menu_parent_id'] ?>" data-menu-id="<?php echo $subRow2['menu_id'] ?>">
                                                                    <div class="panel-heading">
                                                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#sub-menu2" href="#sub-menu2-<?php echo $idx2 ?>">
                                                                            <?php echo $subRow2['menu_nama'] ?>
                                                                        </a>

                                                                        <div class="panel-controls">
                                                                            <a href="<?php echo site_url('sys/menu/delete_menu').'/'.$subRow2['menu_id'] ?>" class="btn btn-danger btn-sm xhrs dest_subcontent-element confirm-remove" data-toggle="tooltip" data-placement="left" title="hapus">
                                                                                <span class="icon fa fa-trash-o"></span>
                                                                            </a>
                                                                           
                                                                            <a class="btn btn-warning btn-sm xhr dest_subcontent-element" href="<?php echo site_url('sys/menu/update_menu').'/'.$subRow2['menu_id'] ?>" data-toggle="tooltip" data-placement="left" title="ubah">
                                                                                <span class="icon fa fa-pencil"></span>
                                                                            </a>                                                                            
                                                                        </div>
                                                                    </div> 
                                                                    <div id="sub-menu2-<?php echo $idx1 ?>" class="panel-collapse collapse">                                                                        
                                                                    </div> 
                                                                </div> 
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                    </div>
                                                </div>
                                            <?php
                                                }
                                            ?>
                                            </div> 
                                        </div>
                        <?php
                                    }
                                }
                        ?>
                                    </div>
                                </div>
                        <?php
                            }                            
                        ?>
                               
                        </div> 
                    </div>
        <?php
                }
            }
        ?>
        </div>       
    </div>  
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
       
        $('.sortable').sortable().bind('sortupdate', function(event,ui) {
            event.stopPropagation();
            var sortUpdateMenu = $('[data-parent-id='+ui.item.data("parent-id")+']').map(function(){ return $(this).data("menu-id"); }).get();            
            
            $.get("<?php echo site_url('sys/menu/update_urutan_menu') ?>",
            {
              dataUrutan: JSON.stringify(sortUpdateMenu)
            },
            function(data,status){
                if (status == 'success'){
                    $.growl.notice({ message: 'Ubah urutan menu berhasil', size: 'large'});
                } else {
                    $.growl.error({ message: 'Ubah urutan menu gagal', size: 'large'});
                }
            });
        });

        $(".confirm-remove").click(function () {
            var self = $(this);         
            bootbox.confirm({
                title: 'Konfirmasi',
                message: "Yakin data akan dihapus ?",
                buttons: {
                    'confirm': {
                        label: 'Ya',
                        className: 'btn-danger'
                    },
                    'cancel': {
                        label: 'Tidak',
                        className: 'btn-default'
                    }               
                },
                callback: function(result) {
                    if (result){                        
                        self.unbind("click");
                        self.get(0).click();
                    }
                },
                className: "bootbox-sm"
            }); 
            return false
        });
    });
</script>