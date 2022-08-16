<?php echo $this->breadcrump(); ?>
<script type="text/javascript">
    function confirmSubmit() {
        var agree = confirm("Apakah Yakin akan Menghapus Data Group ini?");
        if (agree)
            return true;
        else
            return false;
    }
</script>
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title"><b>Daftar Group</b></span>
        <div class="panel-heading-controls">
            <a href="<?php echo site_url('sys/group/add_group') ?>" class="btn btn-flat btn-sm btn-labeled btn-success xhr dest_subcontent-element">
                <span class="icon fa fa-plus"></span> Group</a>&nbsp;&nbsp;
        </div>
    </div> 

    <div class="panel-body">
        <div class="table-light table-primary" style="overflow: auto;">     
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Aksi</th>
                        <th class="text-center">Nama Group</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = $offset + 1;
                    if (!empty($content)) {
                        foreach ($content as $row) {
                            ?>
                            <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td align="center">
                                    <a href="<?php echo site_url('sys/group/update_group/' . $row['group_menu_id']); ?>" class="btn btn-warning btn-sm xhr dest_subcontent-element" data-toggle='tooltip' data-placement='top' title='ubah'><span class="icon fa fa-pencil"></span></a>
                                    <a href="<?php echo site_url('sys/group/delete_group/' . $row['group_menu_id']); ?>" class="btn btn-danger btn-sm xhrs dest_subcontent-element confirm-remove" data-toggle='tooltip' data-placement='top' title='hapus'><span class="icon fa fa-trash-o"></span></a>
                                </td>
                                <td><?php echo $row['group_menu_nama']; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='3'><div class='alert alert-danger'>Data Tidak Ditemukan</div></td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="pull-right">
                <?php echo $halaman; ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();

        $(".confirm-remove").click(function () {
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
                callback: function (result) {
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