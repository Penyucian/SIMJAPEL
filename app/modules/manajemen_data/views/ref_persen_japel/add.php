<div id='modal-data-basic'>
    <?php echo validation_errors(); ?>
    <form rel='ajax-datatable' id="form_modal" class="form-horizontal xhr dest_modal-data-basic" method="post" action="<?php echo site_url($url_action); ?>">
    
    <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Sarana Umum<span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <input type="text" name="dt[saranaUmum]" class="form-control" value="<?php echo (!empty($content['saranaUmum'])) ? $content['saranaUmum'] : set_value('dt[saranaUmum]'); ?>" placeholder="Sarana Umum">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Pelayanan Umum <span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <input type="text" name="dt[pelayananUmum]" class="form-control" value="<?php echo (!empty($content['pelayananUmum'])) ? $content['pelayananUmum'] : set_value('dt[pelayananUmum]'); ?>" placeholder="Pelayanan Umum">
            </div>
        </div>
        
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Sarana BPJS<span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <input type="text" name="dt[saranaBPJS]" class="form-control" value="<?php echo (!empty($content['saranaBPJS'])) ? $content['saranaBPJS'] : set_value('dt[saranaBPJS]'); ?>" placeholder="Sarana BPJS">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Pelayanan BPJS<span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <input type="text" name="dt[pelayananBPJS]" class="form-control" value="<?php echo (!empty($content['pelayananBPJS'])) ? $content['pelayananBPJS'] : set_value('dt[pelayananBPJS]'); ?>" placeholder="Pelayanan BPJS">
            </div>
        </div>

        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Operasi Umum<span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <input type="text" name="dt[operasiUmum]" class="form-control" value="<?php echo (!empty($content['operasiUmum'])) ? $content['operasiUmum'] : set_value('dt[operasiUmum]'); ?>" placeholder="Operasi Umum">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Non Operasi Umum <span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <input type="text" name="dt[nonOperasiUmum]" class="form-control" value="<?php echo (!empty($content['nonOperasiUmum'])) ? $content['nonOperasiUmum'] : set_value('dt[nonOperasiUmum]'); ?>" placeholder="Non Operasi Umum">
            </div>
        </div>
        
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Operasi BPJS<span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <input type="text" name="dt[operasiBPJS]" class="form-control" value="<?php echo (!empty($content['operasiBPJS'])) ? $content['operasiBPJS'] : set_value('dt[operasiBPJS]'); ?>" placeholder="Operasi BPJS">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Non Operasi BPJS<span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <input type="text" name="dt[nonOperasiBPJS]" class="form-control" value="<?php echo (!empty($content['nonOperasiBPJS'])) ? $content['nonOperasiBPJS'] : set_value('dt[nonOperasiBPJS]'); ?>" placeholder="Non Operasi BPJS">
            </div>
        </div>
        
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Manajemen Umum <span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <input type="text" name="dt[manajemen_umum]" class="form-control" value="<?php echo (!empty($content['manajemen_umum'])) ? $content['manajemen_umum'] : set_value('dt[manajemen_umum]'); ?>" placeholder="manajemen umum">
            </div>
        </div>
        
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Manajemen BPJS <span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <input type="text" name="dt[manajemen_bpjs]" class="form-control" value="<?php echo (!empty($content['manajemen_bpjs'])) ? $content['manajemen_bpjs'] : set_value('dt[manajemen_bpjs]'); ?>" placeholder="manajemen bpjs">
            </div>
        </div>

        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Per-Point PTT <span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <input type="text" name="dt[pointPTT]" class="form-control" value="<?php echo (!empty($content['pointPTT'])) ? $content['pointPTT'] : set_value('dt[pointPTT]'); ?>" placeholder="Per Point PTT">
            </div>
        </div>
        
        <hr />
        <div class="text-right">
            <button type="submit" id="btn-save" class="btn btn-primary"><span class="btn-label-icon left icon fa fa-save"></span>Simpan</button>
        </div>
    </form>
</div>
