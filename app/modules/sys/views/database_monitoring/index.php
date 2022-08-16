<?php echo $this->breadcrump(); ?>

<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Daftar Tabel</span>
        <div class="panel-heading-controls">
            <a href="<?php echo site_url('sys/database_monitoring/add_table') ?>" class="btn btn-flat btn-sm btn-labeled btn-success xhr dest_subcontent-element">
                <span class="icon fa fa-plus"></span> Tambah Tabel
            </a>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Tabel</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($tables as $t) {
                    echo "<tr>";
                    echo "<td>" . $t->monitored_table_id . "</td>";
                    echo "<td>" . $t->monitored_table_name . "</td>";
                    echo "<td>";
                    ?>
                <a rel='async' ajaxify='<?php
                echo
                modal('Edit Table', 'sys', 'database_monitoring', 'edit_table', $t->monitored_table_id, null);
                ?>' class='btn btn-primary btn-sm' data-toggle='tooltip'
                   data-placement='top' title='Edit'><i class="fa fa-pencil-square-o"></i></a>
                   <a onclick="return confirm('Anda yakin ingin mematikan monitoring pada tabel ini?');" href='<?php echo site_url("/sys/database_monitoring/delete_table/" . $t->monitored_table_id); ?>' class='btn btn-danger btn-sm' data-toggle='tooltip' data-placement='top' title='Matikan Monitoring'><i class="fa fa-power-off"></i></a>
                    <?php
                    echo "</td>";
                    echo "</tr>";
                }
                if (!$tables) {
                    echo "<tr>";
                    echo "<td colspan='3'>Tidak ada tabel yang di monitor</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
