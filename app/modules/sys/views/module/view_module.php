<style type="text/css">
    .btn{
        margin-left:3px;
        margin-top:3px;   
    }
</style>
<?php echo $this->breadcrump(); ?>
<form id="form-filter" rel='ajax' action="<?php echo site_url('sys/module/view_module'); ?>" class="panel form-horizontal xhr dest_subcontent-element" method="post">
    <div class="panel-heading">
        <span class="panel-title">Filter</span>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="row form-group">
                    <label class="col-sm-2 control-label" style="text-align:left;">Nama Module</label>
                    <div class="col-sm-8">
                        <input type="text" name="namaModule" class="form-control" placeholder="Nama Module" >
                    </div>		
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer text-right">			
        <button id="btn-cari" class="btn btn-primary" value="">Tampilkan</button>
    </div>
</form>
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Daftar sys</span>
        <div class="panel-heading-controls">
            <a href="<?php echo site_url('sys/module/add_module') ?>" class="btn btn-flat btn-sm btn-labeled btn-success xhr dest_subcontent-element">
                <span class="icon fa fa-plus"></span> Tambah</a>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-light table-primary" style="overflow: auto;">					
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>						
                        <th style="width:5%"><div align="center">No</div></th>
                        <th><div align="center">Nama Module</div></th>
                        <th><div align="center">Controller</div></th>					
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
                            echo "<td>" . $value['module_nama'] . "</td>";
                            echo "<td align='center'><a rel='async' ajaxify='" . modal('Modal', 'sys', 'module', 'view_controller', '0', $value['module_id']) . "' class='btn btn-info btn-sm' data-toggle='tooltip' data-placement='top' title='Detail Controller'>Detail Controller</a></td>";
                            echo "<td align='center'>";
                            echo "<a href='" . site_url('sys/module/update_module/' . $value['module_id']) . "' class='btn btn-warning btn-sm xhr dest_subcontent-element' data-toggle='tooltip' data-placement='top' title='ubah'><span class='icon fa fa-pencil'></span></a>";
                            if (!$value['objController']) {
                                echo "<a href='" . site_url('sys/module/delete_module/' . $value['module_id']) . "' class='btn btn-danger btn-sm xhrs dest_subcontent-element confirm-remove' data-toggle='tooltip' data-placement='top' title='hapus'><span class='icon fa fa-trash-o'></span></a>";
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
