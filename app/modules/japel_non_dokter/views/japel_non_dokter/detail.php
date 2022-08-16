<?php if (!empty($content)) : ?>
    <?php $no = 1;
    foreach ($content as $key => $val) :
    ?>
        <tr>
            <td class="text-center"><?php echo $no++; ?></td>
            <td><?php echo $val['nip']; ?></td>
            <td><?php echo $val['name']; ?></td>
            <td><?php echo $val['jabatan'] . ' (' . $val['jabatan_index'] . ')'; ?></td>
            <td><?php echo $val['education'] . ' (' . $val['education_index'] . ')'; ?></td>
            <td><?php echo $val['resiko'] . ' (' . $val['resiko_index'] . ')'; ?></td>
            <td><?php echo $val['tugas_tambahan'] . ' (' . $val['tugas_tambahan_index'] . ')'; ?></td>
            <td class="text-right"><?php echo rupiah($val['japel_index']); ?></td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="8">Data tidak ditemukan.</td>
    </tr>
<?php endif; ?>