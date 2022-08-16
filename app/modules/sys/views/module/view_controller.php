<div id="modal-data-basic">
    <style type="text/css">
        .btn{
            margin-left:3px;
            margin-top:3px;   
        }
    </style>
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">Daftar Controller [Module <?php echo $objModule['module_nama'] ?>]</span>
        </div>	
        <div class="panel-body">
            <div class="text-right">
                <a href="<?php echo site_url('sys/module/add_controller/' . $objModule['module_id']) ?>" class="btn btn-flat btn-sm btn-labeled btn-success xhrd dest_modal-data-basic">
                    <span class="icon fa fa-plus"></span> Tambah</a>
            </div>
            <br/>
            <div class="table-light table-primary" style="overflow: auto;">					
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>						
                            <th style="width:5%"><div align="center">No</div></th>
                            <th><div align="center">Nama Controller</div></th>
                            <th><div align="center">Function</div></th>					
                            <th style="width:15%"><div align="center">Aksi</div></th>
                        </tr>
                    </thead>
                    <tbody>							
                        <?php
                        if ($content) {
                            foreach ($content as $idx => $value) {
                                $no = $offset + $idx + 1;
                                echo "<tr>";
                                echo "<td align='center'>" . $no . "</td>";
                                echo "<td>" . $value['controller_nama'] . "</td>";
                                echo "<td align='center'><a href='" . site_url('sys/module/view_function/0/' . $value['controller_id']) . "' class='btn btn-info btn-sm xhrd dest_modal-data-basic' data-toggle='tooltip' data-placement='top' title='Detail Function'>Detail Function</a></td>";
                                echo "<td align='center'>";
                                echo "<a href='" . site_url('sys/module/update_controller/' . $value['controller_id']) . "' class='btn btn-warning btn-sm xhrd dest_modal-data-basic' data-toggle='tooltip' data-placement='top' title='ubah'><span class='icon fa fa-pencil'></span></a>";
                                if (!$value['objFunction']) {
                                    echo "<a href='" . site_url('sys/module/delete_controller/' . $value['controller_id']) . "' class='btn btn-danger btn-sm xhrs dest_modal-data-basic confirm-remove' data-toggle='tooltip' data-placement='top' title='hapus'><span class='icon fa fa-trash-o'></span></a>";
                                }
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'><div class='alert alert-danger'>Data Tidak Ditemukan</div></td></tr>";
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
