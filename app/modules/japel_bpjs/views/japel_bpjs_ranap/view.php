<?php echo $this->breadcrump(); ?>
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Rincian Jasa Pelayanan</span>
    </div>
    <div class="panel-body">
        <form id="datatables_filter" class="form-horizontal">
            <div class="row form-group">
                <label class="col-sm-2 control-label" style="text-align:left;">Dokter</label>
                <div class="col-sm-6">
                    <select class="form-control sel" name="doctor_id" id="doctor_id">
                        <?php if (!empty($dokter['id'])) : ?>
                            <option value="<?php echo $dokter['id'] ?>"><?php $nip = !empty($dokter['nip']) ? '(' . $dokter['nip'] . ') ' : '';
                                                                        echo $nip . $dokter['name']; ?></option>
                        <?php else : ?>
                            <option value="">--Pilih--</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-2 control-label" style="text-align:left;">Periode</label>
                <div class="col-sm-2">
                    <select class="form-control sel" name="periode" id="periode">
                        <option value="2">Periode Bulan</option>
                        <option value="1">Periode Hari</option>
                        <option value="3">Periode Tahun</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <div class="p1 hide">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" name="tgl_mulai" class="form-control bsdatepicker" value="<?php echo date('d M Y') ?>">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="tgl_selesai" class="form-control bsdatepicker" value="<?php echo date('d M Y') ?>">
                            </div>
                        </div>
                    </div>
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
                    <div class="p3 hide">
                        <select class="form-control sel" name="thn3">
                            <?php for ($i = 2000; $i < date('Y') + 3; $i++) :
                                $selected = date('Y') == $i ? 'selected' : '';
                            ?>
                                <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-2 control-label" style="text-align:left;">Klinik</label>
                <div class="col-sm-6">
                    <select class="form-control sel" name="clinic_id[]" id="clinic_id" multiple="multiple">
                        <?php foreach ($ref_clinic as $key => $val) : ?>
                            <option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="text-right">
                <button type="button" id="search" class="btn btn-primary"><span class="btn-label-icon left fa fa-search"></span>Tampilkan</button>
            </div>
        </form>
        <hr>
        <div class="table-primary" style="overflow: auto;">
            <table class="table table-striped table-bordered" id="datatables">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">#</th>
                        <th class="text-center">No. RM</th>
                        <th class="text-center">Nama Pasien</th>
                        <th class="text-center">Tgl Tindakan</th>
                        <th class="text-center">Nama Tindakan</th>
                        <th class="text-center">Layanan</th>
                        <th class="text-center">Nominal</th>
                    </tr>
                </thead>
                <tbody id="content_detail">
                    <tr>
                        <td colspan="7">Data tidak ditemukan</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('.sel').select2({
            placeholder: '--Pilih--',
            allowClear: true,
            closeOnSelect: true,
            width: '100%'
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

        var url = '<?php echo site_url("sys/ref/get_doctor"); ?>';
        $("#doctor_id").select2({
            placeholder: '--Nama Dokter--',
            minimumInputLength: 3,
            cache: true,
            allowClear: true,
            width: '100%',
            ajax: {
                url: url,
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            var nip = isset(item.nip) ? '(' + item.nip + ') ' : '';
                            return {
                                text: nip + item.name,
                                id: item.id
                            }
                        })
                    };
                },
                error: function(jqXHR, status, error) {
                    return {
                        results: []
                    };
                }
            }
        });
    });
</script>