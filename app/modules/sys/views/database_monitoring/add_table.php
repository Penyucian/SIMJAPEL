<?php echo $this->breadcrump(); ?>
<style>
    .control-label{
        text-align: left;
    }
    #field-list{
        border: 1px solid #dfdfdf;
        background: #fdfdfd;
        padding: 8px;
        margin: 12px;
        border-radius: 2px;
    }
</style>
<div id="error-msg"></div>
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Tambah Tabel yang akan dimonitor</span>
    </div>
    <div class="panel-body">
        <form rel="ajax" action="<?php echo site_url('sys/database_monitoring/add_table_proses'); ?>" class="form-horizontal xhr dest_subcontent-element" id="form-add-table" method="post">  
            <div class="row">
                <div class="col-sm-12">
                    <div class="row form-group">
                        <label class="control-label col-sm-2">Nama Tabel</label>
                        <div class="col-sm-8">
                            <select name="table_name" class="form-control" required="">
                                <option value="0">-- pilih tabel --</option>
                                <?php
                                print_r($tables);
                                foreach ($tables_in_server as $key => $value) {
                                    foreach ($value as $iKey => $iValue) {
                                        if (!in_array($iValue, $tables)) {
                                            echo "<option value='" . $iValue . "'>" . $iValue . "</option>";
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-2">Fields</label>
                        <div class="col-sm-8" id="field-list">

                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-2"></label>
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<a href="<?php echo site_url('pengaturan/database_monitoring/') ?>" class="btn btn-flat btn-sm btn-labeled xhr dest_subcontent-element">
    <span class="icon fa fa-angle-double-left"></span> Kembali
</a><br>

<script>
    $("select[name='table_name']").change(function () {
        $.get("<?php echo site_url('sys/database_monitoring/get_field_list'); ?>" + '/' + $("select[name='table_name']").val(),
                function (data) {
                    data = JSON.parse(data)
                    $("#field-list").html("");
                    for (var i = 0; i < data.length; i++) {
                        $("#field-list").append("<input type='checkbox' id='field-of-table-" + i + "' name='field-list[]' value='" + data[i] + "'> <label for='field-of-table-" + i + "'>" + data[i] + "</label><br>");
                    }
                }
        );
    });
    $("#form-add-table").submit(function () {
        var checked = $("input[name='field-list[]']:checked").length;

        if (checked === 0) {
            $("#error-msg").html("");
            $("#error-msg").append("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>×</button> Minimal 1 field harus dipilih.</div>");
            return false;
        }
    });

</script>