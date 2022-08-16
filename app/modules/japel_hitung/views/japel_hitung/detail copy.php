<?php echo $this->breadcrump(); ?>
<div class="row">
    <div class="col-md-6">
        <div class="col-md-4">
            <div class="box bg-success darken">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="font-weight-semibold font-size-12">Pendapatan Pasien Umum</div>
                    <div class="font-weight-bold font-size-20"><?php echo rupiah($pendapatan_umum) ?></div>
                    <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box bg-success darken">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="font-weight-semibold font-size-12">Pendapatan Pasien BPJS</div>
                    <div class="font-weight-bold font-size-20"><?php echo rupiah($pendapatan_bpjs) ?></div>
                    <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box bg-success darken">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="font-weight-semibold font-size-12">Sarana</div>
                    <div class="font-weight-bold font-size-20"><?php echo rupiah($japel_sarana_total) ?></div>
                    <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box bg-success darken">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="font-weight-semibold font-size-12">Pelayanan</div>
                    <div class="font-weight-bold font-size-20"><?php echo rupiah($japel_manajemen_total) ?></div>
                    <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <div class="box bg-warning darken">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="font-weight-semibold font-size-12">TPP PNS 50%</div>
                        <div class="font-weight-bold font-size-20"><?php echo rupiah($japel_minimal) ?></div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box bg-warning darken">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="font-weight-semibold font-size-12">TPP BLUD</div>
                        <div class="font-weight-bold font-size-20"><?php echo rupiah($japel_minimal_nonpns) ?></div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box bg-warning darken">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="font-weight-semibold font-size-12">Japel Manajemen</div>
                        <div class="font-weight-bold font-size-20"><?php echo number_format($japel_manajemen, 2, ",", ".") ?></div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box bg-warning darken">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="font-weight-semibold font-size-12">Japel Dokter</div>
                        <div class="font-weight-bold font-size-20"><?php echo rupiah($japel_dokter) ?></div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box bg-warning darken">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="font-weight-semibold font-size-12">Japel Index</div>
                        <div class="font-weight-bold font-size-20"><?php echo number_format($japel_index, 2, ",", "."); ?></div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Rincian Japel Pegawai</span>
    </div>
    <div class="panel-body">
        <form method="post" rel="ajax" action="<?php echo site_url('japel_hitung/japel_hitung/submit'); ?>" class="form-horizontal xhr dest_subcontent-element">
            <input id="csrf" type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <div class="table-primary" style="overflow: auto;">
                <table class="table table-striped table-bordered" id="datatables">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">#</th>
                            <th class="text-center">NIP</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Jabatan</th>
                            <th class="text-center">Japel Pegawai</th>
                            <th class="text-center">Japel Tambahan</th>
                            <th class="text-center">Japel Jabatan</th>
                            <th class="text-center">Japel Dokter</th>
                            <th class="text-center">Jml Kunjungan RJ</th>
                            <th class="text-center">Jml Kunjungan RI</th>
                            <th class="text-center">Index</th>
                            <!-- <th class="text-center">Kinerja</th> -->
                            <th class="text-center">IKS</th>
                            <th class="text-center">IKP A</th>
                            <th class="text-center">IKP B</th>
                            <th class="text-center">Japel Index</th>
                            <th class="text-center">Japel Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $refkinerja = [
                            '1|1.00' => 'Kinerja Baik',
                            '2|0.90' => 'Kinerja Biasa',
                            '3|0.80' => 'Kinerja Kurang',
                        ];
                        if ($content) : ?>
                            <input type="hidden" name="periode" value="<?php echo $periode; ?>">
                            <input type="hidden" name="dp[pendapatan_pasien_umum]" value="<?php echo $pendapatan_umum; ?>">
                            <input type="hidden" name="dp[pendapatan_pasien_bpjs]" value="<?php echo $pendapatan_bpjs; ?>">
                            <input type="hidden" name="dp[japel_sarana]" value="<?php echo $japel_sarana_total; ?>">
                            <input type="hidden" name="dp[japel_manajemen_total]" value="<?php echo $japel_manajemen_total; ?>">
                            <input type="hidden" name="dp[japel_manajemen]" value="<?php echo $japel_manajemen; ?>">
                            <input type="hidden" name="dp[japel_minimal]" value="<?php echo $japel_minimal; ?>">
                            <input type="hidden" name="dp[japel_minimal_nonpns]" value="<?php echo $japel_minimal_nonpns; ?>">
                            <input type="hidden" name="dp[japel_dokter]" value="<?php echo $japel_dokter; ?>">
                            <input type="hidden" name="dp[japel_index]" value="<?php echo $japel_index; ?>">
                            <?php $no = 1;
                            $j1 = $j11 = $j2 = $j3 = $j4 = $j5 = $j6 = 0;
                            foreach ($content as $key => $val) :
                                $japel_total = $val['japel_minimal'] + $val['japel_tambahan'] + $val['japel_manajemen'] + $val['japel_index'] + $val['japel_dokter'];
                                $j1 += $val['japel_minimal'];
                                $j11 += $val['japel_tambahan'];
                                $j2 += $val['japel_manajemen'];
                                $j3 += $val['japel_index'];
                                $j5 += $val['index'];
                                $j6 += $val['japel_dokter'];
                                $j4  += $japel_total;
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?>
                                        <input type="hidden" name="dt[<?php echo $key ?>][employee_id]" value="<?php echo $key; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][periode_japel_id]" value="<?php echo $periode; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][jabatan_id]" value="<?php echo $val['jabatan_id']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][jabatan_index]" value="<?php echo empty($val['jabatan_index']) ? 0 : $val['jabatan_index']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][education_id]" value="<?php echo $val['education_id']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][education_index]" value="<?php echo empty($val['education_index']) ? 0 : $val['education_index']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][resiko_id]" value="<?php echo $val['resiko_id']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][resiko_index]" value="<?php echo empty($val['resiko_index']) ? 0 : $val['resiko_index']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][tugas_tambahan_id]" value="<?php echo $val['tugas_tambahan_id']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][tugas_tambahan_index]" value="<?php echo empty($val['tugas_tambahan_index']) ? 0 : $val['tugas_tambahan_index']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][masa_kerja_id]" value="<?php echo $val['masa_kerja_id']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][masa_kerja_index]" value="<?php echo empty($val['masa_kerja_index']) ? 0 : $val['masa_kerja_index']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][japel_kunjungan_rj]" value="<?php echo empty($val['jk12']) ? 0 : $val['jk12']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][japel_kunjungan_ri]" value="<?php echo empty($val['jk22']) ? 0 : $val['jk22']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][japel_minimal]" value="<?php echo $val['japel_minimal']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][japel_tambahan]" value="<?php echo $val['japel_tambahan']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][japel_manajemen]" value="<?php echo $val['japel_manajemen']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][japel_dokter]" value="<?php echo $val['japel_dokter']; ?>">
                                    </td>
                                    <td><?php echo $val['nip']; ?></td>
                                    <td><?php echo $val['name']; ?></td>
                                    <td><?php echo $val['jabatan']; ?></td>
                                    <td class="text-right"><?php echo rupiah($val['japel_minimal']); ?></td>
                                    <td class="text-right"><?php echo rupiah($val['japel_tambahan']); ?></td>
                                    <td class="text-right"><?php echo rupiah($val['japel_manajemen']); ?></td>
                                    <td class="text-right"><?php echo rupiah($val['japel_dokter']); ?></td>
                                    <td class="text-center">
                                        <a rel="async" ajaxify="<?php echo site_url('sys/modal/set_modal_full/Detail Kunjungan Pasien Rawat Jalan/japel_hitung/japel_hitung/get_detail_kunjungan/' . $bln2 . '_' . $thn2 . '_' . $val['paramedic_id']); ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Kunjungan Pasien Rawat Jalan">
                                            <?php echo $val['jk12']; ?>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a rel="async" ajaxify="<?php echo site_url('sys/modal/set_modal_full/Detail Kunjungan Pasien Rawat Inap/japel_hitung/japel_hitung/get_detail_kunjungan/' . $bln2 . '_' . $thn2 . '_' . $val['paramedic_id']); ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Kunjungan Pasien Rawat Inap">
                                            <?php echo $val['jk22']; ?>
                                        </a>
                                    </td>
                                    <td class="text-center"><?php echo $val['index']; ?></td>
                                    <td>
                                        <select class="form-control sel" name="dt[<?php echo $key ?>][kinerja]">
                                            <?php foreach ($refkinerja as $k => $v) :
                                                $selected = $val['indeks_kerja_id'] == $k ? 'selected' : '';
                                            ?>
                                                <option value="<?php echo $k; ?>" <?php echo $selected; ?>><?php echo $v; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td class="text-right"><?php echo rupiah($val['japel_index']); ?></td>
                                    <td class="text-right"><?php echo rupiah($japel_total); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th colspan="4" class="text-right">Total</th>
                                <th class="text-right"><?php echo rupiah($j1); ?></th>
                                <th class="text-right"><?php echo rupiah($j11); ?></th>
                                <th class="text-right"><?php echo rupiah($j2); ?></th>
                                <th class="text-right"><?php echo rupiah($j6); ?></th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th class="text-center"><?php echo $j5; ?></th>
                                <th>&nbsp;</th>
                                <th class="text-right"><?php echo rupiah($j3); ?></th>
                                <th class="text-right"><?php echo rupiah($j4); ?></th>
                            </tr>
                        <?php else : ?>
                            <tr>
                                <td colspan="14">Data tidak ditemukan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                <button id="btn-save" class="btn btn-success"><span class="btn-label-icon left fa fa-angle-right"></span>Next</button>
            </div>
            <input type="hidden" name="total_index" value="<?php echo $j5 ?>">
        </form>
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
    });
</script>