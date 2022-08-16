<?php if (!empty($content)) : ?>
    <?php $no = 1;
    foreach ($content as $key => $val) :
    ?>
        <tr>
            <td class="text-center"><?php echo $no++; ?></td>
            <td><?php echo $val['nip']; ?></td>
            <td><?php echo $val['name']; ?></td>
            <td class="text-right"><?php echo rupiah($val['nominal']); ?></td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="4">Data tidak ditemukan.</td>
    </tr>
<?php endif; ?>