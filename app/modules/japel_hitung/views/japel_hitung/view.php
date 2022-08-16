<?php echo $this->breadcrump(); ?>
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Rincian Jasa Pelayanan</span>
    </div>
    <div class="panel-body">
        <form id="datatables_filter" class="form-horizontal">
            <div class="row form-group">
                <label class="col-sm-2 control-label" style="text-align:left;">Periode Pelayanan Umum</label>
                <div class="col-sm-4">
                    <div class="p2">
                        <div class="row">
                            <div class="col-sm-6">
                                <select class="form-control sel" name="bln2">
                                    <?php
                                    $dbln = [
                                        1 => 'Januari',
                                        2 => 'Februari',
                                        3 => 'Maret',
                                        4 => 'April',
                                        5 => 'Mei',
                                        6 => 'Juni',
                                        7 => 'Juli',
                                        8 => 'Agustus',
                                        9 => 'September',
                                        10 => 'Oktober',
                                        11 => 'November',
                                        12 => 'Desember',
                                    ];
                                    foreach ($dbln as $key => $val) :
                                        $selected = date('m') == $key ? 'selected' : '';
                                    ?>
                                        <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $val; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select class="form-control sel" name="thn2">
                                    <?php for ($i = 2000; $i < date('Y') + 3; $i++) :
                                        $selected = date('Y') == $i ? 'selected' : '';
                                    ?>
                                        <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row form-group">
                <label class="col-sm-2 control-label" style="text-align:left;">Nominal PTT</label>
                <div class="col-sm-4">
                    <input type="text" name="nominal_ptt" class="form-control rpinput" value="" placeholder="Nominal PTT">
                </div>
            </div> -->
            <div class="row form-group">
                <label class="col-sm-2 control-label" style="text-align:left;"></label>
                <div class="col-sm-4">
                    <h5>Pembagian Umum</h5>
                </div>
                <div class="col-sm-4">
                    <h5>Pembagian BPJS</h5>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-2 control-label" style="text-align:left;">Persen pembagian</label>
                <div class="col-sm-4">
                    <label for="jasaDokterNonOPUmum">Japel Umum untuk Dokter Non OP</label>
                    <input type="text" name="jasaDokterNonOPUmum" class="form-control " value="<?php echo ($persen['nonOperasiUmum']*100) ?>" placeholder="Non Operasi Umum">
                </div>
                <div class="col-sm-4">
                    <label for="jasaDokterNonOPBPJS">BPJS</label>
                    <input type="text" name="jasaDokterNonOPBPJS" class="form-control " value="<?php echo ($persen['nonOperasiBPJS']*100) ?>" placeholder="Non Operasi BPJS">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-2 control-label" style="text-align:left;"></label>
                <div class="col-sm-4">
                    <label for="jasaDokterOPUmum">Japel Umum untuk Dokter OP</label>
                    <input type="text" name="jasaDokterOPUmum" class="form-control " value="<?php echo ($persen['operasiUmum']*100) ?>" placeholder="Operasi Umum">
                </div>
                <div class="col-sm-4">
                    <label for="jasaDokterOPBPJS">Japel BPJS untuk Dokter OP</label>
                    <input type="text" name="jasaDokterOPBPJS" class="form-control " value="<?php echo ($persen['operasiBPJS']*100) ?>" placeholder="Operasi BPJS">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-2 control-label" style="text-align:left;"></label>
                <div class="col-sm-4">
                    <div class="w-100 mb-2">
                        <label for="jasaManajemenUmum">Japel Umum untuk Manajemen</label>
                        <input type="text" name="jasaManajemenUmum" class="form-control" value="<?php echo ($persen['manajemen_umum']*100) ?>" placeholder="Jasa Manajemen Umum">
                    </div>
                    <!-- <div class="col-sm-12 mt-4">
                        <label for="jasaManajemenUmum">Japel Umum untuk Manajemen Non Struktural</label>
                        <input type="text" name="jasaManajemenUmum" class="form-control" value="<?php echo ($persen['manajemen_umum']*100) ?>" placeholder="Jasa Manajemen Umum">
                        <p>dikali dengan japel manajemen</p>
                    </div> -->
                </div>
                <div class="col-sm-4">
                    <div class="w-100 mb-2">
                        <label for="jasaManajemenBPJS">Japel BPJS untuk Manajemen</label>
                        <input type="text" name="jasaManajemenBPJS" class="form-control " value="<?php echo ($persen['manajemen_bpjs']*100) ?>" placeholder="Jasa Manajemen BPJS">
                    </div>
                    <!-- <div class="col-sm-12 mt-4">
                        <label for="jasaManajemenUmum">Japel BPJS untuk Manajemen Non Struktural</label>
                        <input type="text" name="jasaManajemenUmum" class="form-control" value="<?php echo ($persen['manajemen_bpjs']*100) ?>" placeholder="Jasa Manajemen Umum">
                        <p>dikali dengan japel manajemen</p>
                    </div> -->
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-2 control-label" style="text-align:left;"></label>
                <div class="col-sm-4">
                    <label for="saranaUmum">Sarana Umum</label>
                    <input type="text" name="saranaUmum" class="form-control" value="<?php echo ($persen['saranaUmum']*100) ?>" placeholder="Sarana Umum">
                </div>
                <div class="col-sm-4">
                    <label for="saranaBPJS">Sarana BPJS</label>
                    <input type="text" name="saranaBPJS" class="form-control" value="<?php echo ($persen['saranaBPJS']*100) ?>" placeholder="Sarana BPJS">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-2 control-label" style="text-align:left;"></label>
                <div class="col-sm-4">
                    <label for="pelayananUmum">Pelayanan Umum</label>
                    <input type="text" name="pelayananUmum" class="form-control" value="<?php echo ($persen['pelayananUmum']*100) ?>" placeholder="Pelayanan Umum">
                </div>
                <div class="col-sm-4">
                    <label for="pelayananBPJS">Pelayanan BPJS</label>
                    <input type="text" name="pelayananBPJS" class="form-control" value="<?php echo ($persen['pelayananBPJS']*100) ?>" placeholder="Pelayanan BPJS">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-2 control-label" style="text-align:left;"></label>
                <div class="col-sm-4">
                    <h5>Lain-Lain</h5>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-2 control-label" style="text-align:left;">Lain-lain</label>
                <div class="col-sm-4">
                    <label for="pointPTT">Per-Point PTT</label>
                    <input type="text" name="pointPTT" class="form-control rpinput"  value="<?php echo ($persen['pointPTT']) ?>" placeholder="Per-Point PTT">
                </div>
            </div>
            <div class="text-right">
                <button type="button" id="btn-generate" class="btn btn-success"><span class="btn-label-icon left fa fa-magic"></span>Next</button>
            </div>
        </form>
        <div class="content_detail"></div>
    </div>
    <div class="panel-footer text-danger">NB : Jasa Pelayanan BPJS M-1</div>

<script type="text/javascript">
    $(function() {
        $('.sel').select2({
            placeholder: '--Pilih--',
            allowClear: true,
            closeOnSelect: true,
            width: '100%'
        });

        $('.rpinput').inputmask({
            alias: "rupiah"
        });
        $('.persen').inputmask({
            alias: "persen"
        });

        $('#btn-generate').click(function() {
            var param = $("#datatables_filter").serialize();
            var action = '<?php echo site_url($controller . 'generate'); ?>?' + param;
            window.location.href = action;
            $('.busy-indicator').fadeIn();
        });

        $('#search').click(function() {
            var url = '<?php echo site_url($controller . 'get_data'); ?>';
            var param = $("#datatables_filter").serializeJSON();
            $("#content_detail").addClass('form-loading');
            $('#content_detail').load(url, param, function() {
                $("#content_detail").removeClass('form-loading');
            });
            return false;
        });

        var options = {
            autoclose: true,
            todayBtn: "linked",
            orientation: 'bottom',
            todayHighlight: true,
            format: 'd M yyyy'
        }
        $('.bsdatepicker').datepicker(options);

        $('#periode').change(function() {
            var val = $(this).val();
            $('.p1, .p2, .p3').addClass('hide');
            if (val == 1) {
                $('.p1').removeClass('hide');
            } else if (val == 2) {
                $('.p2').removeClass('hide');
            } else if (val == 3) {
                $('.p3').removeClass('hide');
            }
        });
    });
</script>