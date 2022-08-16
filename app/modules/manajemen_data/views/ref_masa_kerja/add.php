<div id='modal-data-basic'>
    <?php echo validation_errors(); ?>
    <form rel='ajax-datatable' id="form_modal" class="form-horizontal xhr dest_modal-data-basic" method="post" action="<?php echo site_url($url_action); ?>">
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Masa Kerja <span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <input type="text" name="dt[name]" class="form-control" value="<?php echo (!empty($content['name'])) ? $content['name'] : set_value('dt[name]'); ?>" placeholder="Masa Kerja">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Index <span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <input type="text" name="dt[index]" class="form-control" value="<?php echo (!empty($content['index'])) ? $content['index'] : set_value('dt[index]'); ?>" placeholder="Index">
            </div>
        </div>
        <hr />
        <div class="text-right">
            <button type="submit" id="btn-save" class="btn btn-primary"><span class="btn-label-icon left icon fa fa-save"></span>Simpan</button>
        </div>
    </form>
</div>
