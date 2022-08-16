<div id='modal-data-basic'>
    <div class="table-primary" style="overflow: auto; height: 720px;">
        <table class="table table-striped table-bordered" id="datatables">
            <thead>
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th class="text-center">No.Kwitansi</th>
                    <th class="text-center">No.RM</th>
                    <th class="text-center">Nama Pasien</th>
                    <th class="text-center">Cara Bayar</th>
                    <th class="text-center">Tgl Bayar</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Plafon</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($content) :
                    $no = 1;
                    $d1 = $d2 = 0;
                    foreach ($content as $key => $val) :
                        $d1 += $val['total'];
                        $d2 += $val['plafon'];
                ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $val['jenis'] . '-' . $val['no_kwitansi']; ?></td>
                            <td><?php echo $val['no_rm'] ?></td>
                            <td><?php echo $val['name_pasien'] ?></td>
                            <td><?php echo $val['payment_type_name'] ?></td>
                            <td><?php echo !empty($val['bayar_tgl']) ? date('d-m-Y H:i', strtotime($val['bayar_tgl'])) : ''; ?></td>
                            <td class="text-right"><?php echo rupiah($val['total']); ?></td>
                            <td class="text-right"><?php echo rupiah($val['plafon']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th colspan="6" class="text-right">Jumlah</th>
                        <th class="text-right"><?php echo number_format($d1, 2, ",", "."); ?></th>
                        <th class="text-right"><?php echo number_format($d2, 2, ",", "."); ?></th>
                    </tr>
                    <tr>
                        <th colspan="7" class="text-right">Selisih</th>
                        <th class="text-right"><?php echo number_format(($d1 - $d2), 2, ",", "."); ?></th>
                    </tr>
                <?php else : ?>
                    <tr>
                        <td colspan="8">Data tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>