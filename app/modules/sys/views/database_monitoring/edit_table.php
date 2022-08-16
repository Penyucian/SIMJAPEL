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
        <span class="panel-title">Edit Field pada tabel: <Strong><?php echo $table_name; ?></Strong></span>
    </div>
    <div class="panel-body">
        <form action="<?php echo site_url('sys/database_monitoring/edit_table_proses'); ?>" class="form-horizontal xhr dest_modal-data-basic" id="form-add-table" method="post">
            <input type="hidden" name="id" value="<?php echo $from_db['table']->monitored_table_id; ?>">
            <input type="hidden" name="table_name" value="<?php echo $table_name; ?>">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row form-group">
                        <label class="control-label col-sm-2">Fields</label>
                        <div class="col-sm-8" id="field-list">
                            <?php
                            $i = 0;
                            foreach ($server_fields as $field) {
                                if ($field == "created_by") {
                                    break;
                                }

                                if (in_array($field, $from_db['fields'])) {
                                    echo "<input type='checkbox' id='field-of-table-" . $i . "' name='field-list[]' checked='checked' value='" . $field . "'> <label for='field-of-table-" . $i . "'>" . $field . "</label><br>";
                                } else {
                                    echo "<input type='checkbox' id='field-of-table-" . $i . "' name='field-list[]' value='" . $field . "'> <label for='field-of-table-" . $i . "'>" . $field . "</label><br>";
                                }
                                $i++;
                            }
                            ?>
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
