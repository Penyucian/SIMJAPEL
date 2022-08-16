<?php if (!empty($content)) : ?>
    <?php $no = 1;
    $t1 = $t2 = $t3 = $t4 = $t5 = 0;
    foreach ($content as $key => $val) :
        $t1 += $val['japel_minimal'];
        $t2 += $val['japel_manajemen_total'];
        $t3 += $val['japel_manajemen'];
        $t4 += $val['japel_dokter'];
        $t5 += $val['japel_index'];
    ?>
        <tr>
            <td class="text-center"><?php echo $no++; ?></td>
            <td><?php echo indonesian_date($val['periode'], 'F Y'); ?></td>
            <td class="text-right"><?php echo rupiah($val['japel_minimal']); ?></td>
            <td class="text-right"><?php echo rupiah($val['japel_manajemen_total']); ?></td>
            <td class="text-right"><?php echo rupiah($val['japel_manajemen']); ?></td>
            <td class="text-right"><?php echo rupiah($val['japel_dokter']); ?></td>
            <td class="text-right">Rp <?php echo number_format($val['japel_index'], 2, ",", "."); ?></td>
            <td class=" text-center nowrap">
                <a href='<?php echo site_url('japel_hitung/japel_hitung/export/' . $this->encryption_lib->urlencode($val['id'])); ?>' target='_blank' class="btn btn-success btn-sm"><span class="fa fa-table"></span></a>
                <a href="<?php echo site_url('japel_hitung/japel_hitung/generate?bln2="' . date('m', strtotime($val['periode'])) . '"&thn2="' . date('Y', strtotime($val['periode'])) . '"'); ?>" class="btn btn-warning btn-sm xhrd dest_subcontent-element edit" data-toggle="tooltip" data-placement="top" title="Edit Japel Pegawai"><span class="fa fa-pencil"></span></a>
                <a href="<?php echo site_url($controller . 'delete/' . $this->encryption_lib->urlencode($val['id'])); ?>" class="btn btn-danger btn-sm xhrs dest_subcontent-element confirm-remove" data-toggle="tooltip" data-placement="top" title="Hapus"><span class="fa fa-trash-o"></span></a>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="2" class="text-right"></td>
        <td class="text-right"><b><?php echo rupiah($t1); ?></b></td>
        <td class="text-right"><b><?php echo rupiah($t2); ?></b></td>
        <td class="text-right"><b><?php echo rupiah($t3); ?></b></td>
        <td class="text-right"><b><?php echo rupiah($t4); ?></b></td>
        <td class="text-right"><b>Rp <?php echo number_format($t5, 2, ",", "."); ?></b></td>
        <td></td>
    </tr>
<?php else : ?>
    <tr>
        <td colspan="8">Data tidak ditemukan.</td>
    </tr>
<?php endif; ?>

<script type="text/javascript">
    $(document).ready(function() {
        $(".confirm-remove").click(function() {
            var self = $(this);
            bootbox.confirm({
                title: 'Konfirmasi',
                message: "Yakin data akan dihapus ?",
                buttons: {
                    'confirm': {
                        label: 'Ya',
                        className: 'btn-danger'
                    },
                    'cancel': {
                        label: 'Tidak',
                        className: 'btn-default'
                    }
                },
                callback: function(result) {
                    if (result) {
                        self.unbind("click");
                        self.get(0).click();
                    }
                },
                className: "bootbox-sm"
            });
            return false
        });
    });
</script>