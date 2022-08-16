<form rel="ajax" action="<?php echo site_url('sys/module/update_controller_proses'); ?>" class="panel form-horizontal xhr dest_modal-data-basic" method="post">
    <div class="panel-heading">
        <span class="panel-title">Ubah Controller</span>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="row form-group">
                    <label class="col-sm-2 control-label" style="text-align:left;">Nama Controller</label>
                    <div class="col-sm-8">
                        <input type="text" name="namaController" class="form-control" placeholder="Nama Controller" value="<?php echo (isset($namaController) ? $namaController : $objController['controller_nama']) ?>">
                        <?php echo form_error('namaController', '<p class="help-block" style="color:red;"><i>', '</i></p>'); ?>
                    </div>		
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer text-right">
        <input type="hidden" name="controllerId" value="<?php echo $objController['controller_id'] ?>" />
        <a href="<?php echo site_url('sys/module/view_controller/0/' . $objController['module_id']) ?>" class="btn btn-labeled btn-warning xhrd dest_modal-data-basic">
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
