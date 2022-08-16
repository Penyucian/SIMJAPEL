<div id="modal-data-basic">
    <style type="text/css">
        .btn{
            margin-left:3px;
            margin-top:3px;   
        }
    </style>
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">Daftar Function [Controller <?php echo $objController['controller_nama'] ?>]</span>
        </div>	
        <div class="panel-body">
            <div class="text-right">
                <a href="<?php echo site_url('sys/module/add_function/' . $objController['controller_id']) ?>" class="btn btn-flat btn-sm btn-labeled btn-success xhrd dest_modal-data-basic">
                    <span class="icon fa fa-plus"></span> Tambah</a>
            </div>
            <br/>
            <div class="table-light table-primary" style="overflow: auto;">					
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>						
                            <th style="width:5%"><div align="center">No</div></th>
                            <th><div align="center">Nama Function</div></th>
                            <th><div align="center">Title</div></th>
                            <th><div align="center">Ikon</div></th>
                            <th><div align="center">Page Title</div></th>
                            <th><div align="center">Permissions</div></th>
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
                                echo "<td>" . $value['module_detail_function'] . "</td>";
                                echo "<td>" . $value['module_detail_title'] . "</td>";
                                echo "<td><div align='center'><i class='fa " . $value['module_detail_page_css_clip'] . "'></i></div></td>";
                                echo "<td>" . $value['module_detail_page_title'] . "</td>";
                                echo "<td align='center'>" . $value['module_detail_permissions'] . "</td>";
                                echo "<td align='center'>";
                                echo "<a href='" . site_url('sys/module/update_function/' . $value['module_detail_id']) . "' class='btn btn-warning btn-sm xhrd dest_modal-data-basic' data-toggle='tooltip' data-placement='top' title='ubah'><span class='icon fa fa-pencil'></span></a>";
                                echo "<a href='" . site_url('sys/module/delete_function/' . $value['module_detail_id']) . "' class='btn btn-danger btn-sm xhrs dest_modal-data-basic confirm-remove' data-toggle='tooltip' data-placement='top' title='hapus'><span class='icon fa fa-trash-o'></span></a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'><div class='alert alert-danger'>Data Tidak Ditemukan</div></td></tr>";
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
            <div class="panel-footer text-right">				
                <a href="<?php echo site_url('sys/module/view_controller/0/' . $objController['module_id']) ?>" class="btn btn-labeled btn-warning xhrd dest_modal-data-basic">
                    Kembali ke Controller
                </a>				
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
