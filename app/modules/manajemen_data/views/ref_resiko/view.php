<?php echo $this->breadcrump(); ?>
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">&nbsp;</span>
        <div class="panel-heading-controls">
            <?php echo "<a rel='async' ajaxify='" . modal('Tambah Referensi Resiko', 'manajemen_data', 'ref_resiko', 'add') . "' class='btn btn-sm btn-success' data-toggle='tooltip' data-placement='top' title='Tambah Referensi Resiko'><span class='btn-label-icon left icon fa fa-plus'></span>Tambah</a>"; ?>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-primary" style="overflow: auto;">
            <table class="table table-striped table-bordered" id="datatables">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th class="text-center">Tingkat Resiko</th>
                        <th class="text-center">Tempat Kerja</th>
                        <th class="text-center" width="10%">Index</th>
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
                    "data": "tingkat_resiko"
                },
                {
                    "data": "name"
                },
                {
                    "data": "index",
                    className: 'text-center'
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