<?php echo $this->breadcrump(); ?>
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Periode Japel</span>
    </div>
    <div class="panel-body">
        <form id="datatables_filter" class="form-horizontal">
            <div class="row form-group">
                <label class="col-sm-2 control-label" style="text-align:left;">Periode</label>
                <div class="col-sm-2">
                    <select class="form-control sel" name="periode" id="periode">
                        <option value="3">Periode Tahun</option>
                        <option value="2">Periode Bulan</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <div class="p2 hide">
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
                    <div class="p3">
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
                        <th class="text-center">Periode</th>
                        <th class="text-center">Japel Pegawai</th>
                        <th class="text-center">Pelayanan</th>
                        <th class="text-center">Japel Manajemen</th>
                        <th class="text-center">Japel Dokter</th>
                        <th class="text-center">Japel Index</th>
                        <th class="text-center" width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="content_detail">
                    <tr>
                        <td colspan="8">Data tidak ditemukan</td>
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

        $('#btn-export').click(function() {
            var param = $("#datatables_filter").serialize();
            var action = '<?php echo site_url($controller . 'export'); ?>?' + param;
            window.location.href = action;
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