<?php echo $this->breadcrump(); ?>
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box bg-success darken">
                            <div class="box-cell p-x-3 p-y-1">
                                <div class="font-weight-semibold font-size-12">Pendapatan Pasien Umum</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($pendapatan_umum['sarana'] + $pendapatan_umum['pelayanan'], 0, ",", ".") ?></div>
                                <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box bg-success darken">
                            <div class="box-cell p-x-3 p-y-1">
                                <div class="font-weight-semibold font-size-12">Jasa Sarana</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($pendapatan_umum['sarana'], 0, ",", ".") ?></div>
                                <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box bg-success darken">
                            <div class="box-cell p-x-3 p-y-1">
                                <div class="font-weight-semibold font-size-12">Jasa Pelayanan</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($pendapatan_umum['pelayanan'], 0, ",", ".") ?></div>
                                <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box bg-success darken">
                            <div class="box-cell p-x-3 p-y-1">
                                <div class="font-weight-semibold font-size-12">Pendapatan Pasien BPJS</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($pendapatan_bpjs['sarana'] + $pendapatan_bpjs['pelayanan'], 0, ",", ".") ?></div>
                                <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box bg-success darken">
                            <div class="box-cell p-x-3 p-y-1">
                                <div class="font-weight-semibold font-size-12">Jasa Sarana</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($pendapatan_bpjs['sarana'], 0, ",", ".") ?></div>
                                <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box bg-success darken">
                            <div class="box-cell p-x-3 p-y-1">
                                <div class="font-weight-semibold font-size-12">Jasa Pelayanan</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($pendapatan_bpjs['pelayanan'], 0, ",", ".") ?></div>
                                <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box bg-primary darken">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="font-weight-semibold font-size-12">Japel resep Obat</div>
                        <div class="font-weight-bold font-size-16"><?php echo number_format($resep_umum+$resep_bpjs, 0, ",", ".") ?></div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                        <div class="row">
                            <div class="col-md-6" style="border: 1px solid; padding: 2px 4px;">
                                <div class="font-weight-semibold font-size-12">Umum</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($resep_umum, 0, ",", ".") ?></div>
                            </div>
                            <div class="col-md-6" style="border: 1px solid; padding: 2px 4px;">
                                <div class="font-weight-semibold font-size-12">BPJS</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($resep_bpjs, 0, ",", ".") ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box bg-primary darken">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="font-weight-semibold font-size-12">Japel PIO</div>
                        <div class="font-weight-bold font-size-16"><?php echo number_format($pio_umum+$pio_bpjs, 0, ",", ".") ?> </div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                        <div class="row">
                            <div class="col-md-6" style="border: 1px solid; padding: 2px 4px;">
                                <div class="font-weight-semibold font-size-12">Umum</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($pio_umum, 0, ",", ".") ?></div>
                            </div>
                            <div class="col-md-6" style="border: 1px solid; padding: 2px 4px;">
                                <div class="font-weight-semibold font-size-12">BPJS</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($pio_bpjs, 0, ",", ".") ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <div class="box bg-warning darken">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="font-weight-semibold font-size-12">TPP PNS 50%</div>
                        <div class="font-weight-bold font-size-16"><?php echo number_format($japel_minimal, 0, ",", ".") ?></div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box bg-warning darken">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="font-weight-semibold font-size-12">TPP BLUD</div>
                        <div class="font-weight-bold font-size-16"><?php echo number_format($japel_minimal_nonpns, 0, ",", ".") ?></div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box bg-warning darken">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="font-weight-semibold font-size-12">Japel Manajemen</div>
                        <div class="font-weight-bold font-size-16"><?php echo number_format($japel_manajemen_umum + $japel_manajemen_bpjs, 0, ",", ".") ?></div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                        <div class="row">
                            <div class="col-md-6" style="border: 1px solid; padding: 2px 4px;">
                                <div class="font-weight-semibold font-size-12">Umum</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($japel_manajemen_umum, 0, ",", ".") ?></div>
                            </div>
                            <div class="col-md-6" style="border: 1px solid; padding: 2px 4px;">
                                <div class="font-weight-semibold font-size-12">BPJS</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($japel_manajemen_bpjs, 0, ",", ".") ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box bg-warning darken">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="font-weight-semibold font-size-12">Japel Dokter</div>
                        <div class="font-weight-bold font-size-16"><?php echo number_format($japel_dokter['umum'] + $japel_dokter['bpjs'], 0, ",", ".") ?></div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                        <div class="row">
                            <div class="col-md-6" style="border: 1px solid; padding: 2px 4px;">
                                <div class="font-weight-semibold font-size-12">Umum</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($japel_dokter['umum'], 0, ",", ".") ?></div>
                            </div>
                            <div class="col-md-6" style="border: 1px solid; padding: 2px 4px;">
                                <div class="font-weight-semibold font-size-12">BPJS</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($japel_dokter['bpjs'], 0, ",", ".") ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box bg-warning darken">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="font-weight-semibold font-size-12">PTT</div>
                        <div class="font-weight-bold font-size-16"><?php echo number_format($nominal_ptt_final, 0, ",", "."); ?></div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box bg-warning darken">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="font-weight-semibold font-size-12">Japel Index</div>
                        <div class="font-weight-bold font-size-16"><?php echo number_format($japel_index, 0, ",", "."); ?></div>
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
                            <th class="text-center" width="5%" rowspan="2">#</th>
                            <th class="text-center" rowspan="2">NIP</th>
                            <th class="text-center" rowspan="2">Nama</th>
                            <th class="text-center" rowspan="2">Jabatan</th>
                            <th class="text-center" rowspan="2">TPP 50%</th>
                            <th class="text-center" colspan="2">Japel Jabatan</th>
                            <th class="text-center" colspan="2">Japel Dokter</th>
                            <th class="text-center" rowspan="2">Japel Khusus</th>
                            <th class="text-center" rowspan="2">PTT</th>
                            <th class="text-center" rowspan="2">Jml Kunjungan RJ</th>
                            <th class="text-center" rowspan="2">Jml Kunjungan RI</th>
                            <th class="text-center" rowspan="2">Index</th>
                            <th class="text-center" rowspan="2">IKS</th>
                            <th class="text-center" rowspan="2">IKMKB</th>
                            <th class="text-center" colspan="2">IKP</th>
                            <th class="text-center" rowspan="2">Japel Total</th>
                        </tr>
                        <tr>
                            <th class="text-center">Umum</th>
                            <th class="text-center">BPJS</th>
                            <th class="text-center">Umum</th>
                            <th class="text-center">BPJS</th>
                            <th class="text-center">IKP A</th>
                            <th class="text-center">IKP B</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($content) : ?>
                            <input type="hidden" name="periode" value="<?php echo $periode; ?>">
                            <input type="hidden" name="dp[pendapatan_pasien_umum]" value="<?php echo ($pendapatan_umum['sarana'] + $pendapatan_umum['pelayanan']); ?>">
                            <input type="hidden" name="dp[pendapatan_pasien_umum_sarana]" value="<?php echo $pendapatan_umum['sarana']; ?>">
                            <input type="hidden" name="dp[pendapatan_pasien_umum_pelayanan]" value="<?php echo $pendapatan_umum['pelayanan']; ?>">
                            <input type="hidden" name="dp[pendapatan_pasien_bpjs]" value="<?php echo ($pendapatan_bpjs['sarana'] + $pendapatan_bpjs['pelayanan']); ?>">
                            <input type="hidden" name="dp[pendapatan_pasien_bpjs_sarana]" value="<?php echo $pendapatan_bpjs['sarana']; ?>">
                            <input type="hidden" name="dp[pendapatan_pasien_bpjs_pelayanan]" value="<?php echo $pendapatan_bpjs['pelayanan']; ?>">
                            <input type="hidden" name="dp[japel_sarana]" value="<?php echo $japel_sarana_total; ?>">
                            <input type="hidden" name="dp[japel_manajemen_total]" value="<?php echo $japel_manajemen_umum + $japel_manajemen_bpjs; ?>">
                            <input type="hidden" name="dp[japel_manajemen]" value="<?php echo $japel_manajemen_umum; ?>">
                            <input type="hidden" name="dp[japel_manajemen_bpjs]" value="<?php echo $japel_manajemen_bpjs; ?>">
                            <input type="hidden" name="dp[japel_minimal]" value="<?php echo $japel_minimal; ?>">
                            <input type="hidden" name="dp[japel_minimal_nonpns]" value="<?php echo $japel_minimal_nonpns; ?>">
                            <input type="hidden" name="dp[japel_dokter]" value="<?php echo $japel_dokter['umum']; ?>">
                            <input type="hidden" name="dp[japel_dokter_bpjs]" value="<?php echo $japel_dokter['bpjs']; ?>">
                            <input type="hidden" name="dp[japel_index]" value="<?php echo $japel_index; ?>">
                            <input type="hidden" name="dp[japel_ptt]" value="<?php echo $nominal_ptt; ?>">
                            <input type="hidden" name="dp[resep_umum]" value="<?php echo $resep_umum; ?>">
                            <input type="hidden" name="dp[resep_bpjs]" value="<?php echo $resep_bpjs; ?>">
                            <input type="hidden" name="dp[pio_umum]" value="<?php echo $pio_umum; ?>">
                            <input type="hidden" name="dp[pio_bpjs]" value="<?php echo $pio_bpjs; ?>">
                            <?php $no = 1;
                            $j1 = $j11 = $j2 = $j21 = $j3 = $j4 = $j5 = $j6 = $j61 = $j62 = $j7 = $j71 = 0;
                            
                            
                            foreach ($content as $key => $val) :
                                $japel_total = $val['japel_minimal'] + $val['japel_tambahan'] + $val['japel_khusus'] + $val['japel_manajemen'] + $val['japel_manajemen_bpjs'] + $val['japel_dokter'] + $val['japel_dokter_bpjs'] + $val['ptt_nominal'];
                                $j1 += $val['japel_minimal'];
                                $j11 += $val['japel_tambahan'];
                                $j2 += $val['japel_manajemen'];
                                $j21 += $val['japel_manajemen_bpjs'];
                                $j5 += $val['index'];
                                $j6 += $val['japel_dokter'];
                                $j61 += $val['japel_dokter_bpjs'];
                                $j4  += $japel_total;
                                $j62 += $val['japel_khusus'];
                                $j7 += $val['ptt_nominal'];
                                $j71 += $val['ptt_index'];
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
                                        <input type="hidden" name="dt[<?php echo $key ?>][ptt_index]" value="<?php echo $val['ptt_index']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][ptt_nominal]" value="<?php echo $val['ptt_nominal']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][masa_kerja_index]" value="<?php echo empty($val['masa_kerja_index']) ? 0 : $val['masa_kerja_index']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][japel_kunjungan_rj]" value="<?php echo empty($val['jk12']) ? 0 : $val['jk12']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][japel_kunjungan_ri]" value="<?php echo empty($val['jk22']) ? 0 : $val['jk22']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][japel_minimal]" value="<?php echo $val['japel_minimal']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][japel_tambahan]" value="<?php echo $val['japel_tambahan']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][japel_khusus]" value="<?php echo $val['japel_khusus']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][japel_manajemen]" value="<?php echo $val['japel_manajemen']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][japel_manajemen_bpjs]" value="<?php echo $val['japel_manajemen_bpjs']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][japel_dokter]" value="<?php echo $val['japel_dokter']; ?>">
                                        <input type="hidden" name="dt[<?php echo $key ?>][japel_dokter_bpjs]" value="<?php echo $val['japel_dokter_bpjs']; ?>">
                                    </td>
                                    <td><?php echo $val['nip']; ?></td>
                                    <td><?php echo $val['name']; ?></td>
                                    <td><?php echo $val['jabatan']; ?></td>
                                    <td class="text-right"><?php echo number_format($val['japel_minimal'], 0, ",", "."); ?></td>
                                    <td class="text-right"><?php echo number_format($val['japel_manajemen'], 0, ",", "."); ?></td>
                                    <td class="text-right"><?php echo number_format($val['japel_manajemen_bpjs'], 0, ",", "."); ?></td>
                                    <td class="text-right"><?php echo number_format($val['japel_dokter'], 0, ",", "."); ?></td>
                                    <td class="text-right"><?php echo number_format($val['japel_dokter_bpjs'], 0, ",", "."); ?></td>
                                    <td class="text-right"><?php echo number_format($val['japel_khusus'], 0, ",", "."); ?></td>
                                    <td class="text-right"><span data-toggle="tooltip" data-placement="top" title="PTT Index: <?php echo number_format($val['ptt_index'], 0, ",", "."); ?>"><?php echo number_format($val['ptt_nominal'], 0, ",", "."); ?></span></td>
                                    <td class="text-center">
                                        <a rel="async" ajaxify="<?php echo site_url('sys/modal/set_modal_full/Detail Kunjungan Pasien Rawat Jalan/japel_hitung/japel_hitung/get_detail_kunjungan/' . $bln2 . '_' . $thn2 . '_' . $val['paramedic_id']); ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Kunjungan Pasien Rawat Jalan">
                                            <?php echo $val['jk12']; ?>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a rel="async" ajaxify="<?php echo site_url('sys/modal/set_modal_full/Detail Kunjungan Pasien Rawat Inap/japel_hitung/japel_hitung/get_detail_kunjungan_ranap/' . $bln2 . '_' . $thn2 . '_' . $val['paramedic_id']); ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Kunjungan Pasien Rawat Inap">
                                            <?php echo $val['jk22']; ?>
                                        </a>
                                    </td>
                                    <td class="text-center"><?php echo $val['index']; ?></td>
                                    <td>
                                        <?php if ($val['paramedic_id']) : ?>
                                            <select class="form-control sel" name="dt[<?php echo $key ?>][iks]" style="width: 45%;">
                                                <!-- <option value="">--Pilih--</option> -->
                                                <?php foreach ($ref_iks as $k => $v) :
                                                    $selected = $val['iks_id'] . '|' . $val['iks_index'] == $k ? 'selected' : '';
                                                ?>
                                                    <option value="<?php echo $k; ?>" <?php echo $selected; ?>><?php echo $v; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($val['paramedic_id']) : ?>
                                            <select class="form-control sel" name="dt[<?php echo $key ?>][ikmkb]" style="width: 45%;">
                                                <!-- <option value="">--Pilih--</option> -->
                                                <?php foreach ($ref_ikmkb as $k => $v) :
                                                    $selected = $val['ikmkb_id'] . '|' . $val['ikmkb_index'] == $k ? 'selected' : '';
                                                ?>
                                                    <option value="<?php echo $k; ?>" <?php echo $selected; ?>><?php echo $v; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <select class="form-control sel" name="dt[<?php echo $key ?>][ikpa]">
                                            <?php foreach ($ref_ikpa as $k => $v) :
                                                $selected = $val['ikpa_id'] . '|' . $val['ikpa_index'] == $k ? 'selected' : '';
                                            ?>
                                                <option value="<?php echo $k; ?>" <?php echo $selected; ?>><?php echo $v; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control sel" name="dt[<?php echo $key ?>][ikpb]">
                                            <!-- <option value="">--Pilih--</option> -->
                                            <?php foreach ($ref_ikpb as $k => $v) :
                                                $selected = $val['ikpb_id'] . '|' . $val['ikpb_index'] == $k ? 'selected' : '';
                                            ?>
                                                <option value="<?php echo $k; ?>" <?php echo $selected; ?>><?php echo $v; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td class="text-right"><?php echo number_format($japel_total, 0, ",", "."); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th colspan="4" class="text-right">Total</th>
                                <th class="text-right"><?php echo number_format($j1, 0, ",", "."); ?></th>
                                <th class="text-right"><?php echo number_format($j2, 0, ",", "."); ?></th>
                                <th class="text-right"><?php echo number_format($j21, 0, ",", "."); ?></th>
                                <th class="text-right"><?php echo number_format($j6, 0, ",", "."); ?></th>
                                <th class="text-right"><?php echo number_format($j61, 0, ",", "."); ?></th>
                                <th class="text-right"><?php echo number_format($j62, 0, ",", "."); ?></th>
                                <th class="text-right"><span data-toggle="tooltip" data-placement="top" title="Total PTT Index: <?php echo $j71; ?>"><?php echo number_format($j7, 0, ",", "."); ?></span></th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th class="text-center"><?php echo  number_format($j5, 0, ",", "."); ?></th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th></th>
                                <th class="text-right"><?php echo number_format($j4, 0, ",", "."); ?></th>
                            </tr>
                        <?php else : ?>
                            <tr>
                                <td colspan="19">Data tidak ditemukan</td>
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
