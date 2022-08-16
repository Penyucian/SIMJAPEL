<?php echo $this->breadcrump(); ?>
<form rel='ajax' action="<?php echo site_url('sys/module/update_module_proses'); ?>" class="panel form-horizontal xhr dest_subcontent-element" method="post">
    <div class="panel-heading">
        <span class="panel-title">Ubah Module</span>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="row form-group">
                    <label class="col-sm-2 control-label" style="text-align:left;">Nama Module</label>
                    <div class="col-sm-8">
                        <input type="text" name="namaModule" class="form-control" placeholder="Nama Module" value="<?php echo (isset($namaModule) ? $namaModule : $objModule['module_nama']) ?>">
                        <?php echo form_error('namaModule', '<p class="help-block" style="color:red;"><i>', '</i></p>'); ?>
                    </div>		
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer text-right">
        <input type="hidden" name="moduleId" value="<?php echo $objModule['module_id'] ?>" />			
        <button id="btn-cari" class="btn btn-primary" value="">Simpan</button>
    </div>
</form>

<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Petunjuk!</h3>
    </div>
    <div class="panel-body">      
        Nama modul menggunakan <strong class="text-danger">huruf kecil</strong> atau menggunakan <strong class="text-danger">underscore</strong> untuk spasi (contoh : modul atau group_modul)     
    </div>
</div>
