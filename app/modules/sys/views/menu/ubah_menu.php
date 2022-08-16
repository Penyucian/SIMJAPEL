<?php echo $this->breadcrump(); ?>
<form rel='ajax' action="<?php echo site_url('sys/menu/update_menu_proses'); ?>" class="panel form-horizontal xhr dest_subcontent-element" method="post">  
    <div class="panel-heading">
        <span class="panel-title">Ubah Menu</span>        
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="row form-group">
                    <label class="col-sm-2 control-label" style="text-align:left;">Nama Menu</label>
                    <div class="col-sm-8">
                        <input type="text" name="namaMenu" class="form-control" placeholder="Nama Menu" value="<?php echo (isset($namaMenu) ? $namaMenu : $objMenu['menu_nama']) ?>" autocomplete="off">
                        <?php echo form_error('namaMenu', '<p class="help-block" style="color:red;"><i>', '</i></p>'); ?>
                    </div>      
                </div>

                <div class="row form-group">
                    <label class="col-sm-2 control-label" style="text-align:left;">Menu Induk</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="menuIndukId">
                            <option value=""></option>
                            <?php
                            foreach ($listMenuInduk[1] as $idx => $objMenuInduk) {
                                if (isset($menuIndukId)) {
                                    if ($objMenuInduk['id'] == $menuIndukId) {
                                        echo "<option value='" . $objMenuInduk['id'] . "' selected='selected'>" . $objMenuInduk['nama'] . "</option>";
                                    } else {
                                        echo "<option value='" . $objMenuInduk['id'] . "'>" . $objMenuInduk['nama'] . "</option>";
                                    }

                                    if (isset($listMenuInduk[2][$idx])) {
                                        foreach ($listMenuInduk[2][$idx] as $idx2 => $objMenuInduk2) {
                                            if ($objMenuInduk2['id'] == $menuIndukId) {
                                                echo "<option value='" . $objMenuInduk2['id'] . "' selected='selected'> - " . $objMenuInduk2['nama'] . "</option>";
                                            } else {
                                                echo "<option value='" . $objMenuInduk2['id'] . "'> - " . $objMenuInduk2['nama'] . "</option>";
                                            }
                                        }
                                    }
                                } else {
                                    if ($objMenuInduk['id'] == $objMenu['menu_parent_id']) {
                                        echo "<option value='" . $objMenuInduk['id'] . "' selected='selected'>" . $objMenuInduk['nama'] . "</option>";
                                    } else {
                                        echo "<option value='" . $objMenuInduk['id'] . "'>" . $objMenuInduk['nama'] . "</option>";
                                    }

                                    if (isset($listMenuInduk[2][$idx])) {
                                        foreach ($listMenuInduk[2][$idx] as $idx2 => $objMenuInduk2) {
                                            if ($objMenuInduk2['id'] == $objMenu['menu_parent_id']) {
                                                echo "<option value='" . $objMenuInduk2['id'] . "' selected='selected'> - " . $objMenuInduk2['nama'] . "</option>";
                                            } else {
                                                echo "<option value='" . $objMenuInduk2['id'] . "'> - " . $objMenuInduk2['nama'] . "</option>";
                                            }
                                        }
                                    }
                                }
                            }
                            ?>                          
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2 control-label" style="text-align:left;">Ikon Menu</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input type="text" name="ikon" class="form-control" value="<?php echo (isset($ikon) ? $ikon : $objMenu['menu_css_clip']) ?>" readonly><span class="input-group-addon"><i id="icon" class="fa <?php echo (isset($ikon) ? $ikon : $objMenu['menu_css_clip']) ?>"></i></span>
                        </div>
                    </div>
                    <div class="col-sm-2">                        
                        <a rel="async" href="" ajaxify="<?php echo modal('Daftar Ikon', 'sys', 'ikon', 'view_ikon') ?>" class="btn btn-warning">Pilih Ikon</a>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2 control-label" style="text-align:left;">Target Module</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="moduleId">
                            <option value=""></option>                      
                            <?php
                            foreach ($listModule as $objModule) {
                                if (isset($moduleId)) {
                                    if ($objModule['module_id'] == $moduleId) {
                                        echo "<option value='" . $objModule['module_id'] . "' selected='selected'>" . $objModule['module_nama'] . "</option>";
                                    } else {
                                        echo "<option value='" . $objModule['module_id'] . "'>" . $objModule['module_nama'] . "</option>";
                                    }
                                } else {
                                    if ($objModule['module_id'] == $objMenu['module_id']) {
                                        echo "<option value='" . $objModule['module_id'] . "' selected='selected'>" . $objModule['module_nama'] . "</option>";
                                    } else {
                                        echo "<option value='" . $objModule['module_id'] . "'>" . $objModule['module_nama'] . "</option>";
                                    }
                                }
                            }
                            ?>                          
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2 control-label" style="text-align:left;">Target Controller</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="controllerId">
                            <option value=""></option>
                            <?php
                            if ($listController) {
                                foreach ($listController as $objController) {
                                    if (isset($controllerId)) {
                                        if ($objController['controller_id'] == $controllerId) {
                                            echo "<option value='" . $objController['controller_id'] . "' selected='selected'>" . $objController['controller_nama'] . "</option>";
                                        } else {
                                            echo "<option value='" . $objController['controller_id'] . "'>" . $objController['controller_nama'] . "</option>";
                                        }
                                    } else {
                                        if ($objController['controller_id'] == $objMenu['controller_id']) {
                                            echo "<option value='" . $objController['controller_id'] . "' selected='selected'>" . $objController['controller_nama'] . "</option>";
                                        } else {
                                            echo "<option value='" . $objController['controller_id'] . "'>" . $objController['controller_nama'] . "</option>";
                                        }
                                    }
                                }
                            }
                            ?>                                                 
                        </select>
                        <?php echo form_error('controllerId', '<p class="help-block" style="color:red;"><i>', '</i></p>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2 control-label" style="text-align:left;">Target Fungsi</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="functionId">
                            <option value=""></option>
                            <?php
                            if ($listFunction) {
                                foreach ($listFunction as $objFunction) {
                                    if (isset($functionId)) {
                                        if ($objFunction['module_detail_id'] == $functionId) {
                                            echo "<option value='" . $objFunction['module_detail_id'] . "' selected='selected'>" . $objFunction['module_detail_function'] . "</option>";
                                        } else {
                                            echo "<option value='" . $objFunction['module_detail_id'] . "'>" . $objFunction['module_detail_function'] . "</option>";
                                        }
                                    } else {
                                        if ($objFunction['module_detail_id'] == $objMenu['module_detail_id']) {
                                            echo "<option value='" . $objFunction['module_detail_id'] . "' selected='selected'>" . $objFunction['module_detail_function'] . "</option>";
                                        } else {
                                            echo "<option value='" . $objFunction['module_detail_id'] . "'>" . $objFunction['module_detail_function'] . "</option>";
                                        }
                                    }
                                }
                            }
                            ?>                                                 
                        </select>
                        <?php echo form_error('functionId', '<p class="help-block" style="color:red;"><i>', '</i></p>'); ?>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-2 control-label" style="text-align:left;">Nama Label</label>
                    <div class="col-sm-8">
                        <input type="text" name="namaLabel" class="form-control" placeholder="Nama Label" value="<?php echo (isset($namaLabel) ? $namaLabel : $objMenu['menu_label']) ?>"autocomplete="off">
                    </div>      
                </div>

                <div class="row form-group">
                    <label class="col-sm-2 control-label" style="text-align:left;">Menu is Aktif</label>
                    <div class="col-sm-2">
                        <select class="form-control" name="is_aktif">
                            <?php
                            $select1= '';
                            $select0 = '';
                            if (isset($is_aktif)) {
                                if ($is_aktif == '1') {
                                    $select1 = 'selected';
                                } else {
                                    $select0 = 'selected';
                                }
                            } else {
                                if ($objMenu['menu_is_aktif'] == '1') {
                                    $select1 = 'selected';
                                } else {
                                    $select0 = 'selected';
                                }
                            }
                            ?>
                            <option value="1" <?php echo $select1 ?>>Ya</option>
                            <option value="0"  <?php echo$select0 ?>>Tidak</option>
                        </select>
                    </div>      
                </div>
                <div class="row form-group">
                    <label class="col-sm-2 control-label" style="text-align:left;">Tipe Label</label>
                    <div class="col-sm-8">
                        <?php
                        if (isset($tipeLabel)) {
                            $valueLabel = $tipeLabel;
                        } else {
                            $valueLabel = $objMenu['menu_css_label'];
                        }
                        ?>
                        <div class="radio" style="margin-top: 0;">
                            <label>
                                <input type="radio" name="tipeLabel" value="label-default" class="px" <?php echo ($valueLabel == 'label-default' ? 'checked="checked"' : '') ?>>                                
                                <span class="lbl"><i class="label label-default">Default</i></span>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="tipeLabel" value="label-primary" class="px" <?php echo ($valueLabel == 'label-primary' ? 'checked="checked"' : '') ?>>                                
                                <span class="lbl"><i class="label label-primary">Primary</i></span>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="tipeLabel" value="label-success" class="px" <?php echo ($valueLabel == 'label-success' ? 'checked="checked"' : '') ?>>
                                <span class="lbl"><i class="label label-success">Success</i></span>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="tipeLabel" value="label-warning" class="px" <?php echo ($valueLabel == 'label-warning' ? 'checked="checked"' : '') ?>>
                                <span class="lbl"><i class="label label-warning">Warning</i></span>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="tipeLabel" value="label-danger" class="px" <?php echo ($valueLabel == 'label-danger' ? 'checked="checked"' : '') ?>>
                                <span class="lbl"><i class="label label-danger">Danger</i></span>
                            </label>
                        </div>
                        <div class="radio" style="margin-bottom: 0;">
                            <label>
                                <input type="radio" name="tipeLabel" value="label-info" class="px" <?php echo ($valueLabel == 'label-info' ? 'checked="checked"' : '') ?>>
                                <span class="lbl"><i class="label label-info">Info</i></span>
                            </label>
                        </div>
                        <?php echo form_error('tipeLabel', '<p class="help-block" style="color:red;"><i>', '</i></p>'); ?>
                    </div>                  
                </div>  
            </div>
        </div>
    </div>
    <div class="panel-footer text-right">
        <input type="hidden" name="menuId" value="<?php echo $objMenu['menu_id'] ?>" />
        <button id="btn-cari" class="btn btn-primary" value="">Simpan</button>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        $("select[name='menuIndukId']").select2({
            allowClear: true,
            placeholder: "Menu Induk"
        });

        $("select[name='moduleId']").select2({
            allowClear: true,
            placeholder: "Target Module"
        });

        $("select[name='controllerId']").select2({
            allowClear: true,
            placeholder: "Target Controller"
        });

        $("select[name='functionId']").select2({
            allowClear: true,
            placeholder: "Target Fungsi [***diisi jika menu mengakses langsung ke fungsi***]"
        });

        $("select[name='moduleId']").change(function () {
            var moduleId = $("select[name='moduleId']").val();
            $.get("<?php echo site_url('sys/menu/get_controller_by_moduleId'); ?>" + '/' + moduleId,
                    function (data)
                    {
                        $("select[name='controllerId']").select2("val", "");
                        $("select[name='controllerId']").html(data);
                        $("select[name='functionId']").select2("val", "");
                        $("select[name='functionId']").html(data);
                    }
            );
        });

        $("select[name='controllerId']").change(function () {
            var controllerId = $("select[name='controllerId']").val();
            $.get("<?php echo site_url('sys/menu/get_function_by_controllerId'); ?>" + '/' + controllerId,
                    function (data)
                    {
                        $("select[name='functionId']").select2("val", "");
                        $("select[name='functionId']").html(data);
                    }
            );
        });

    });
</script>