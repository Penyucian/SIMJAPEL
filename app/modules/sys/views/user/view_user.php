<?php echo $this->breadcrump(); ?>
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title"><b>Filter</b></span>
    </div>
    <div class="panel-body">
        <form method="post" rel='ajax' action="<?php echo $link_filter; ?>" class="form-horizontal xhr dest_subcontent-element" autocomplete='off'>
            <div class="form-group">
                <label class="col-sm-2 control-label" style='text-align:left;'>Kata Kunci</label>
                <div class="col-sm-8">
                    <input type="text" name="filter" class="form-control" value="<?php echo $filter; ?>" placeholder="Username | Email | Nama" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                    <input type="submit" class="btn btn-flat btn btn-primary" value="Cari" title="cari" />
                </div>
            </div>
        </form>
    </div>
</div>
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title"><b>Daftar User</b></span>
        <div class="panel-heading-controls">
            <a href="<?php echo site_url('sys/user/add_user') ?>" class="btn btn-flat btn-sm btn-labeled btn-success xhr dest_subcontent-element">
                <span class="icon fa fa-plus"></span> User</a>&nbsp;&nbsp;
        </div>
    </div>

    <div class="panel-body">
        <div class="table-light table-primary" style="overflow: auto;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Aksi</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Nama Lengkap</th>
                        <th class="text-center">Aktif</th>
                        <th class="text-center">Group</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = $offset + 1;
                    if (!empty($content)) {
                        foreach ($content as $row) {
                            $statusAktif = ($row['user_is_aktif'] == 1) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-ban"></i>';
                    ?>
                            <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td align="center">
                                    <a href="<?php echo site_url('sys/user/update_user/' . $row['user_id']); ?>" class="btn btn-warning btn-sm xhr dest_subcontent-element" data-toggle="tooltip" data-placement="top" title="ubah"><span class="icon fa fa-pencil"></span></a>
                                    <a href="<?php echo site_url('sys/user/delete_user/' . $row['user_id']); ?>" class="btn btn-danger btn-sm xhrs dest_subcontent-element confirm-remove" data-toggle="tooltip" data-placement="top" title="hapus"><span class="icon fa fa-trash-o"></span></a>
                                </td>
                                <td><?php echo $row['user_username']; ?></td>
                                <td><?php echo $row['user_nama_lengkap']; ?></td>
                                <td class="text-center"><?php echo $statusAktif; ?></td>
                                <td><?php echo str_replace(',', ', ', $row['group_menu_nama']); ?></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='6'><div class='alert alert-danger'>Data Tidak Ditemukan</div></td></tr>";
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
    $(document).ready(function() {

        $('[data-toggle="tooltip"]').tooltip();

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