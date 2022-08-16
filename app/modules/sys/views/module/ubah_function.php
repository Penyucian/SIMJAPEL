<form rel="ajax" action="<?php echo site_url('sys/module/update_function_proses'); ?>" class="panel form-horizontal xhr dest_modal-data-basic" method="post">
    <div class="panel-heading">
        <span class="panel-title">Tambah Function</span>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="row form-group">
                    <label class="col-sm-2 control-label" style="text-align:left;">Nama Function</label>
                    <div class="col-sm-8">
                        <input type="text" name="namaFunction" class="form-control" placeholder="Nama Function" value="<?php echo (isset($namaFunction) ? $namaFunction : $objFunction['module_detail_function']) ?>">
                        <?php echo form_error('namaFunction', '<p class="help-block" style="color:red;"><i>', '</i></p>'); ?>
                    </div>		
                </div>
                <div class="row form-group">
                    <label class="col-sm-2 control-label" style="text-align:left;">Title</label>
                    <div class="col-sm-8">
                        <input type="text" name="title" class="form-control" placeholder="Title" value="<?php echo (isset($title) ? $title : $objFunction['module_detail_title']) ?>">						
                    </div>		
                </div>
                <div class="row form-group">
                    <label class="col-sm-2 control-label" style="text-align:left;">Ikon</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input type="text" name="ikon" class="form-control" value="<?php echo (isset($ikon) ? $ikon : $objFunction['module_detail_page_css_clip']) ?>" readonly><span class="input-group-addon"><i id="icon" class="fa <?php echo (isset($ikon) ? $ikon : $objFunction['module_detail_page_css_clip']) ?>"></i></span>
                        </div>
                    </div>
                    <div class="col-sm-2">                        
                        <a rel="async" href="" ajaxify="<?php echo modal('Daftar Ikon', 'sys', 'ikon', 'view_ikon') ?>" class="btn btn-warning">Pilih Ikon</a>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-2 control-label" style="text-align:left;">Page Title</label>
                    <div class="col-sm-8">
                        <input type="text" name="pageTitle" class="form-control" placeholder="Page Title" value="<?php echo (isset($pageTitle) ? $pageTitle : $objFunction['module_detail_page_title']) ?>">						
                    </div>		
                </div>
                <div class="row form-group">
                    <label class="col-sm-2 control-label" style="text-align:left;">Permissions</label>
                    <div class="col-sm-8">						
                        <label class="checkbox-inline">
                            <input name="permission[create]" value="c" class="px" type="checkbox" <?php echo (isset($permission['create']) ? 'checked="checked"' : (strpos($objFunction['module_detail_permissions'], 'c') !== false ? 'checked="checked"' : '')) ?> > <span class="lbl">Create</span>
                        </label>
                        <label class="checkbox-inline">
                            <input name="permission[read]" value="r" class="px" type="checkbox" <?php echo (isset($permission['read']) ? 'checked="checked"' : (strpos($objFunction['module_detail_permissions'], 'r') !== false ? 'checked="checked"' : '')) ?> > <span class="lbl">Read</span>
                        </label>
                        <label class="checkbox-inline">
                            <input name="permission[update]" value="u" class="px" type="checkbox" <?php echo (isset($permission['update']) ? 'checked="checked"' : (strpos($objFunction['module_detail_permissions'], 'u') !== false ? 'checked="checked"' : '')) ?> > <span class="lbl">Update</span>
                        </label>
                        <label class="checkbox-inline">
                            <input name="permission[delete]" value="d" class="px" type="checkbox" <?php echo (isset($permission['delete']) ? 'checked="checked"' : (strpos($objFunction['module_detail_permissions'], 'd') !== false ? 'checked="checked"' : '')) ?> > <span class="lbl">Delete</span>
                        </label>
                        <?php echo form_error('permission[]', '<p class="help-block" style="color:red;"><i>', '</i></p>'); ?>
                    </div>		
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer text-right">
        <input type="hidden" name="functionId" value="<?php echo $objFunction['module_detail_id'] ?>" />
        <a href="<?php echo site_url('sys/module/view_function/0/' . $objFunction['controller_id']) ?>" class="btn btn-labeled btn-warning xhrd dest_modal-data-basic">
            Kembali
        </a>			
        <button id="btn-cari" class="btn btn-primary" value="">Simpan</button>
    </div>
</form>

<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Petunjuk!</h3>
    </div>
    <div class="panel-body">      
        Nama controller menggunakan <strong class="text-danger">huruf kecil</strong> atau menggunakan <strong class="text-danger">underscore</strong> untuk spasi (contoh : modul atau group_modul)     
    </div>
</div>
