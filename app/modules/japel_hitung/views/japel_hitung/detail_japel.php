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
                                <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['pendapatan_pasien_umum'], 0, ",", ".") ?></div>
                                <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box bg-success darken">
                            <div class="box-cell p-x-3 p-y-1">
                                <div class="font-weight-semibold font-size-12">Jasa Sarana</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['pendapatan_pasien_umum_sarana'], 0, ",", ".") ?></div>
                                <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box bg-success darken">
                            <div class="box-cell p-x-3 p-y-1">
                                <div class="font-weight-semibold font-size-12">Jasa Pelayanan</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['pendapatan_pasien_umum_pelayanan'], 0, ",", ".") ?></div>
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
                                <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['pendapatan_pasien_bpjs'], 0, ",", ".") ?></div>
                                <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box bg-success darken">
                            <div class="box-cell p-x-3 p-y-1">
                                <div class="font-weight-semibold font-size-12">Jasa Sarana</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['pendapatan_pasien_bpjs_sarana'], 0, ",", ".") ?></div>
                                <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box bg-success darken">
                            <div class="box-cell p-x-3 p-y-1">
                                <div class="font-weight-semibold font-size-12">Jasa Pelayanan</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['pendapatan_pasien_bpjs_pelayanan'], 0, ",", ".") ?></div>
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
                        <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['resep_umum']+$periode_japel['resep_bpjs'], 0, ",", ".") ?></div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                        <div class="row">
                            <div class="col-md-6" style="border: 1px solid; padding: 2px 4px;">
                                <div class="font-weight-semibold font-size-12">Umum</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['resep_umum'], 0, ",", ".") ?></div>
                            </div>
                            <div class="col-md-6" style="border: 1px solid; padding: 2px 4px;">
                                <div class="font-weight-semibold font-size-12">BPJS</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['resep_bpjs'], 0, ",", ".") ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box bg-primary darken">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="font-weight-semibold font-size-12">Japel PIO</div>
                        <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['pio_umum']+$periode_japel['pio_bpjs'], 0, ",", ".") ?> </div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                        <div class="row">
                            <div class="col-md-6" style="border: 1px solid; padding: 2px 4px;">
                                <div class="font-weight-semibold font-size-12">Umum</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['pio_umum'], 0, ",", ".") ?></div>
                            </div>
                            <div class="col-md-6" style="border: 1px solid; padding: 2px 4px;">
                                <div class="font-weight-semibold font-size-12">BPJS</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['pio_bpjs'], 0, ",", ".") ?></div>
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
                        <div class="font-weight-bold font-size-16"><?php echo rupiah($periode_japel['japel_minimal']) ?></div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box bg-warning darken">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="font-weight-semibold font-size-12">TPP BLUD</div>
                        <div class="font-weight-bold font-size-16"><?php echo rupiah($periode_japel['japel_minimal_nonpns']) ?></div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box bg-warning darken">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="font-weight-semibold font-size-12">Japel Manajemen</div>
                        <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['japel_manajemen_total'], 0, ",", ".") ?></div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                        <div class="row">
                            <div class="col-md-6" style="border: 1px solid; padding: 2px 4px;">
                                <div class="font-weight-semibold font-size-12">Umum</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['japel_manajemen'], 0, ",", ".") ?></div>
                            </div>
                            <div class="col-md-6" style="border: 1px solid; padding: 2px 4px;">
                                <div class="font-weight-semibold font-size-12">BPJS</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['japel_manajemen_bpjs'], 0, ",", ".") ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box bg-warning darken">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="font-weight-semibold font-size-12">Japel Dokter</div>
                        <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['japel_dokter']+$periode_japel['japel_dokter_bpjs'], 0, ",", ".") ?></div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                        <div class="row">
                            <div class="col-md-6" style="border: 1px solid; padding: 2px 4px;">
                                <div class="font-weight-semibold font-size-12">Umum</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['japel_dokter'], 0, ",", ".") ?></div>
                            </div>
                            <div class="col-md-6" style="border: 1px solid; padding: 2px 4px;">
                                <div class="font-weight-semibold font-size-12">BPJS</div>
                                <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['japel_dokter_bpjs'], 0, ",", ".") ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box bg-warning darken">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="font-weight-semibold font-size-12">PTT</div>
                        <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['japel_ptt'], 0, ",", "."); ?></div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box bg-warning darken">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="font-weight-semibold font-size-12">Japel Index</div>
                        <div class="font-weight-bold font-size-16"><?php echo number_format($periode_japel['japel_index'], 0, ",", "."); ?></div>
                        <i class="box-bg-icon middle right font-size-52 fa fa-money"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Rincian Japel Pegawai Periode <?php echo indonesian_date($periode_japel['periode'], 'F Y'); ?></span>
        <div class="panel-heading-controls">
            <a href='<?php echo site_url('japel_hitung/japel_hitung/export/' . $this->encryption_lib->urlencode($periode_japel['id'])); ?>' target='_blank' class="btn btn-success btn-sm"><span class="btn-label-icon left fa fa-table"></span> Cetak</a>
        </div>
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
                            <th class="text-center" rowspan="2">Japel Dokter</th>
                            <th class="text-center" rowspan="2">Japel Khusus</th>
                            <th class="text-center" rowspan="2">Jml Kunjungan RJ</th>
                            <th class="text-center" rowspan="2">Jml Kunjungan RI</th>
                            <th class="text-center" rowspan="2">Index</th>
                            <th class="text-center" rowspan="2">IKS</th>
                            <th class="text-center" rowspan="2">IKMKB</th>
                            <th class="text-center" colspan="2">IKP</th>
                            <th class="text-center" rowspan="2">PTT</th>
                            <th class="text-center" rowspan="2">Japel Index</th>
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
                            <?php $no = 1;
                            $j1 = $j11 = $j2 = $j3 = $j4 = $j5 = $j6 = $j61 = $j62 = $j7 = $j71 = 0;
                            foreach ($content as $key => $val) :
                                $ji = $val['japel_index'] > 0 ? $val['japel_index'] : 0;
                                $japel_total = $val['japel_minimal'] + $val['japel_tambahan'] + $val['japel_khusus'] + $val['japel_manajemen'] + $ji + $val['japel_dokter'] + $val['japel_dokter_bpjs'] + $val['ptt_nominal'];
                                $index = $val['jabatan_index'] + $val['education_index'] + $val['resiko_index'] + $val['tugas_tambahan_index'] + $val['masa_kerja_index'] + $val['ikpa_index'] + $val['ikpb_index'];
                                $j1 += $val['japel_minimal'];
                                $j11 += $val['japel_tambahan'];
                                $j2 += $val['japel_manajemen'];
                                $j21 += $val['japel_manajemen_bpjs'];
                                $j3 += $ji;
                                $j5 += $index;
                                $j6 += $val['japel_dokter'];
                                $j61 += $val['japel_dokter_bpjs'];
                                $j62 += $val['japel_khusus'];
                                $j4  += $japel_total;
                                $j7 += $val['ptt_nominal'];
                                $j71 += $val['ptt_index'];
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td><?php echo $val['nip']; ?></td>
                                    <td><?php echo $val['name']; ?></td>
                                    <td><?php echo $val['jabatan']; ?></td>
                                    <td class="text-right"><?php echo rupiah($val['japel_minimal']); ?></td>
<!--                                    <td class="text-right"><?php echo rupiah($val['japel_tambahan']); ?></td> --> 
                                    <td class="text-right"><?php echo rupiah($val['japel_manajemen']); ?></td>
                                    <td class="text-right"><?php echo rupiah($val['japel_manajemen_bpjs']); ?></td>
                                    <td class="text-right"><?php echo rupiah($val['japel_dokter']); ?></td>
                                    <td class="text-right"><?php echo rupiah($val['japel_dokter_bpjs']); ?></td>
                                    <td class="text-right"><?php echo rupiah($val['japel_dokter'] + $val['japel_dokter_bpjs']); ?></td>
                                    <td class="text-right"><?php echo rupiah($val['japel_khusus']); ?></td>
                                    <td class="text-center"><?php echo $val['japel_kunjungan_rj'] ?></td>
                                    <td class="text-center"><?php echo $val['japel_kunjungan_ri'] ?></td>
                                    <td class="text-center"><?php echo $index; ?></td>
                                    <td class="text-center"><?php echo !empty($ref_iks[$val['iks_id']]) ? $ref_iks[$val['iks_id']] : ''; ?></td>
                                    <td class="text-center"><?php echo !empty($ref_ikmkb[$val['ikmkb_id']]) ? $ref_ikmkb[$val['ikmkb_id']] : ''; ?></td>
                                    <td class="text-center"><?php echo !empty($ref_ikpa[$val['ikpa_id']]) ? $ref_ikpa[$val['ikpa_id']] : ''; ?></td>
                                    <td class="text-center"><?php echo !empty($ref_ikpb[$val['ikpb_id']]) ? $ref_ikpb[$val['ikpb_id']] : ''; ?></td>
                                    <td class="text-right"><?php echo rupiah($val['ptt_nominal']); ?></td>
                                    <td class="text-right"><?php echo rupiah($ji); ?></td>
                                    <td class="text-right"><?php echo rupiah($val['japel_total']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th colspan="4" class="text-right">Total</th>
                                <th class="text-right"><?php echo rupiah($j1); ?></th>
                                <th class="text-right"><?php echo rupiah($j2); ?></th>
                                <th class="text-right"><?php echo rupiah($j21); ?></th>
                                <th class="text-right"><?php echo rupiah($j6); ?></th>
                                <th class="text-right"><?php echo rupiah($j61); ?></th>
                                <th class="text-right"><?php echo rupiah($j6+$j61); ?></th>
                                <th class="text-right"><?php echo rupiah($j62); ?></th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th class="text-center"><?php echo $j5; ?></th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th class="text-right"><span data-toggle="tooltip" data-placement="top" title="Total PTT Index: <?php echo $j71; ?>"><?php echo rupiah($j7); ?></span></th>
                                <th class="text-right"><?php echo rupiah($j3); ?></th>
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
        </form>
    </div>
</div>
