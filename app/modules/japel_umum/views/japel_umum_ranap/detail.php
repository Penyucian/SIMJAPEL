<?php if (!empty($content)) : ?>
    <?php $no = 1;
    $tnominal = 0;
    foreach ($content as $key => $val) :
        $tnominal += $val['nominal'];
    ?>
        <tr>
            <td class="text-center"><?php echo $no++; ?></td>
            <td class="text-center"><?php echo $val['patient_id']; ?></td>
            <td><?php echo $val['patient_name']; ?></td>
            <td class="text-center"><?php echo date('d-m-Y', strtotime($val['date'])); ?></td>
            <td><?php echo $val['tindakan']; ?></td>
            <td><?php echo $val['layanan']; ?></td>
            <td class="text-right"><?php echo rupiah($val['nominal']); ?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="6" class="text-right">Total</td>
        <td class="text-right"><b><?php echo rupiah($tnominal); ?></b></td>
    </tr>
<?php else : ?>
    <tr>
        <td colspan="7">Data tidak ditemukan.</td>
    </tr>
<?php endif; ?>