<div id='modal-data-basic'>
    <?php echo validation_errors(); ?>
    <form rel='ajax-datatable' id="form_modal" class="form-horizontal xhr dest_modal-data-basic" method="post" action="<?php echo site_url($url_action); ?>">
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Group <span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <select class="form-control selmod" name="dt[employee_group_id]">
                    <option value="">--Pilih--</option>
                    <?php foreach ($ref_group as $key => $val) :
                        $selected = !empty($content['employee_group_id']) && $content['employee_group_id'] == $val['id'] ? 'selected' : '';
                    ?>
                        <option value="<?php echo $val['id']; ?>" <?php echo $selected; ?>><?php echo $val['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">NIP <span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <input type="text" name="dt[nip]" class="form-control" value="<?php echo (!empty($content['nip'])) ? $content['nip'] : set_value('dt[nip]'); ?>" placeholder="NIP">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Nama Pegawai <span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <input type="text" name="dt[name]" class="form-control" value="<?php echo (!empty($content['name'])) ? $content['name'] : set_value('dt[name]'); ?>" placeholder="Nama Pegawai">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Tanggal Masuk <span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <input type="text" name="dt[tgl_masuk]" class="form-control bsdatepicker" value="<?php echo (!empty($content['tgl_masuk'])) ? $content['tgl_masuk'] : set_value('dt[tgl_masuk]'); ?>" placeholder="Tanggal Masuk">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Jabatan <span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <select class="form-control selmod" name="dt[jabatan_id]">
                    <option value="">--Pilih--</option>
                    <?php foreach ($ref_jabatan as $key => $val) :
                        $selected = !empty($content['jabatan_id']) && $content['jabatan_id'] == $val['id'] ? 'selected' : '';
                    ?>
                        <option value="<?php echo $val['id']; ?>" <?php echo $selected; ?>><?php echo $val['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Pendidikan <span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <select class="form-control selmod" name="dt[education_id]">
                    <option value="">--Pilih--</option>
                    <?php foreach ($ref_education as $key => $val) :
                        $selected = !empty($content['education_id']) && $content['education_id'] == $val['id'] ? 'selected' : '';
                    ?>
                        <option value="<?php echo $val['id']; ?>" <?php echo $selected; ?>><?php echo $val['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Resiko</label>
            <div class="col-sm-9">
                <select class="form-control selmod" name="dt[resiko_id]">
                    <option value="">--Pilih--</option>
                    <?php foreach ($ref_resiko as $key => $val) :
                        $selected = !empty($content['resiko_id']) && $content['resiko_id'] == $val['id'] ? 'selected' : '';
                    ?>
                        <option value="<?php echo $val['id']; ?>" <?php echo $selected; ?>><?php echo '[' . $tingkat_resiko[$val['tingkat_resiko']] . '] ' . $val['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Tugas Tambahan</label>
            <div class="col-sm-9">
                <select class="form-control selmod" name="dt[tugas_tambahan_id]">
                    <option value="">--Pilih--</option>
                    <?php foreach ($ref_tugas_tambahan as $key => $val) :
                        $selected = !empty($content['tugas_tambahan_id']) && $content['tugas_tambahan_id'] == $val['id'] ? 'selected' : '';
                    ?>
                        <option value="<?php echo $val['id']; ?>" <?php echo $selected; ?>><?php echo $val['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">PTT</label>
            <div class="col-sm-9">
                <select class="form-control selmod" name="dt[ptt]">
                    <option value="">--Pilih--</option>
                    <?php for ($i = 0; $i <= 20; $i++) :
                        $selected = !empty($content['ptt']) && $content['ptt'] == $i ? 'selected' : '';
                    ?>
                        <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">TPP 50% <span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <input type="text" name="dt[japel]" class="form-control rpinput" value="<?php echo (!empty($content['japel'])) ? $content['japel'] : set_value('dt[japel]'); ?>" placeholder="TPP 50%">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Japel Tambahan</label>
            <div class="col-sm-9">
                <input type="text" name="dt[japel_tambahan]" class="form-control rpinput" value="<?php echo (!empty($content['japel_tambahan'])) ? $content['japel_tambahan'] : set_value('dt[japel_tambahan]'); ?>" placeholder="Japel Tambahan">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-3 control-label" style="text-align:left;">Jasa BPJS <span style='color:red;'><b>*</b></span></label>
            <div class="col-sm-9">
                <input type="text" name="dt[jasa_bpjs]" class="form-control" value="<?php echo (!empty($content['jasa_bpjs'])) ? $content['jasa_bpjs'] : set_value('dt[jasa_bpjs]'); ?>" placeholder="jasa bpjs">
            </div>
        </div>
        <hr />
        <div class="text-right">
            <button type="submit" id="btn-save" class="btn btn-primary"><span class="btn-label-icon left icon fa fa-save"></span>Simpan</button>
        </div>
    </form>
</div>


<script type="text/javascript">
    $(function() {
        var options = {
            autoclose: true,
            todayBtn: "linked",
            orientation: 'bottom',
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        }
        $('.bsdatepicker').datepicker(options);

        $('.selmod').select2({
            placeholder: '--Pilih--',
            allowClear: true,
            closeOnSelect: true,
            width: '100%',
            dropdownParent: $('.modal')
        });

        $('.rpinput').inputmask({
            alias: "rupiah"
        });
    });
</script>