<?php echo $this->breadcrump(); ?>
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">&nbsp;</span>
    </div>
    <div class="panel-body">
        <div class="table-primary" style="overflow: auto;">
            <table class="table table-striped table-bordered" id="datatables">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th class="text-center">Sarana Umum</th>
                        <th class="text-center">Pelayanan Umum</th>
                        <th class="text-center">Sarana BPJS</th>
                        <th class="text-center">Pelayanan BPJS</th>
                        <th class="text-center">Operasi Umum</th>
                        <th class="text-center">Non Operasi Umum</th>
                        <th class="text-center">Operasi BPJS</th>
                        <th class="text-center">Non Operasi BPJS</th>
                        <th class="text-center">Manajemen Umum</th>
                        <th class="text-center">Manajemen BPJS</th>
                        <th class="text-center">Point PTT</th>
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
                    "data": "saranaUmum",
                    className: 'text-center'
                },
                {
                    "data": "pelayananUmum",
                    className: 'text-center'
                },
                {
                    "data": "saranaBPJS",
                    className: 'text-center'
                },
                {
                    "data": "pelayananBPJS",
                    className: 'text-center'
                },
                {
                    "data": "operasiUmum",
                    className: 'text-center'
                },
                {
                    "data": "nonOperasiUmum",
                    className: 'text-center'
                },
                {
                    "data": "operasiBPJS",
                    className: 'text-center'
                },
                {
                    "data": "nonOperasiBPJS",
                    className: 'text-center'
                },
                {
                    "data": "manajemen_umum",
                    className: 'text-center'
                },
                {
                    "data": "manajemen_bpjs",
                    className: 'text-center'
                },
                {
                    "data": "pointPTT",
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