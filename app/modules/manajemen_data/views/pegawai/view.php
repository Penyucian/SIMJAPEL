<?php echo $this->breadcrump(); ?>
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">&nbsp;</span>
        <div class="panel-heading-controls">
            <?php echo "<a rel='async' ajaxify='" . modal('Tambah Pegawai', 'manajemen_data', 'pegawai', 'add') . "' class='btn btn-sm btn-success' data-toggle='tooltip' data-placement='top' title='Tambah Pegawai'><span class='btn-label-icon left icon fa fa-plus'></span>Tambah</a>"; ?>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-primary" style="overflow: auto;">
            <table class="table table-striped table-bordered" id="datatables">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th class="text-center">Group</th>
                        <th class="text-center">NIP</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Tgl Masuk</th>
                        <th class="text-center">Jabatan</th>
                        <th class="text-center">Pendidikan</th>
                        <th class="text-center">Resiko</th>
                        <th class="text-center">Tugas Tambahan</th>
                        <th class="text-center">PTT</th>
                        <th class="text-center">TPP 50%</th>
                        <th class="text-center">Jasa BPJS</th>
                        <th class="text-center" width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        var p_table = {
            'id': 'datatables',
            'url': "<?php echo site_url($controller . 'get_data') ?>",
            'column': [{
                    "data": "no",
                    searchable: false,
                    orderable: false,
                    className: 'text-center'
                },
                {
                    "data": "employee_group_name",
                    className: 'nowrap'
                },
                {
                    "data": "nip",
                    className: 'nowrap'
                },
                {
                    "data": "name"
                },
                {
                    "data": "tgl_masuk"
                },
                {
                    "data": "name_jabatan"
                },
                {
                    "data": "name_pendidikan"
                },
                {
                    "data": "name_resiko"
                },
                {
                    "data": "name_tugas_tambahan"
                },
                {
                    "data": "ptt",
                    className: 'text-center'
                },
                {
                    "data": "japel",
                    className: 'text-right'
                },
                {
                    "data": "jasa_bpjs",
                    className: 'text-right'
                },
                {
                    "data": "action",
                    searchable: false,
                    orderable: false,
                    className: 'text-center nowrap'
                },
            ],
        }
        gen_datatable(p_table);
    });
</script>