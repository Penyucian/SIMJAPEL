<?php echo $this->breadcrump(); ?>
<form action="<?= site_url('sys/group/update_group_proses/') . '/' . $array->group_menu_id; ?>" method='POST' class="panel form-horizontal xhr dest_subcontent-element" rel="ajax" id="form_input">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    <input type="hidden" id="access" name="access" />
    <input type='hidden' name='id' value='<?php echo $array->group_menu_id; ?>'/>
    <div class="panel-body">
        <div class="note note-info">
            <h4 class="note-title">Petunjuk</h4>
            Klik menu untuk edit permission modul
        </div>
        <?php if (validation_errors()) { ?>
            <div class="alert alert-danger">
                <?php echo validation_errors(); ?>
            </div>
        <?php } ?>

        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php } ?>
        <div class="row form-group">
            <label class="col-sm-2 control-label" style='text-align:left;'>Nama Group</label>
            <div class="col-sm-6">
                <input type="text" id='nmGroup' name="nmGroup" class="form-control" value="<?php
                $cek = !EMPTY($array->group_menu_nama) ? $array->group_menu_nama : set_value('nmGroup');
                echo $cek;
                ?>"/>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-2 control-label" style='text-align:left;'>Modul</label>
            <div class="col-sm-5">
                <table>  
                    <td id="menu_list">
                        <?= $menu ?>
                    </td>
                </table>
            </div>
        </div>
    </div>
    <div class="panel-footer text-right">
        <a href="<?php echo site_url('sys/group'); ?>"><span class="btn btn-default">Kembali</span></a>
        <input type='submit' name='submit' class="btn btn-primary" value='Update'/>
    </div>
</form>

<script src="<?php echo base_url(); ?>sys-assets/plugins/jsTree/jquery.jstree.min.js"></script>
<script>
    $(document).ready(function () {
        $('.check_action').off('change');
        $('.check_action').on('change', function () {
            var ids = $(this).attr('id').split('_');
            console.log(ids);
            $('#label_' + ids[1] + '_' + ids[2]).toggleClass('label-disabled');
        });

        $("#menu_list").jstree({
            "plugins": ["themes", "html_data", "checkbox", "ui"],
            "themes": {"theme": "classic"}
        }).unbind('check_node.jstree').bind('check_node.jstree', function (e, data) {
            parent = $(data.args[0].parentElement.parentElement);
            parent.find('input[type="checkbox"]').attr('checked', 'checked');
            parent.find('[id^="label_"]').removeClass('label-disabled');

        }).unbind('uncheck_node.jstree').bind('uncheck_node.jstree', function (e, data) {
            parent = $(data.args[0].parentElement.parentElement);
            parent.find('input[type="checkbox"]').removeAttr('checked', 'checked');
            parent.find('[id^="label_"]').addClass('label-disabled');

        });

        $('#form_input').submit(function () {
            var checked_ids = [];
            $("#menu_list").find(".jstree-undetermined").each(function (i, element) {
                checked_ids.push($(element).attr("id"));

                if ($(this).find(".jstree-undetermined").length == 0) {
                    $(this).find(".jstree-checked").each(function (i, element) {
                        checked_ids.push($(element).attr("id"));
                    });
                }
            });

            $("#menu_list").find(".jstree-checked").each(function (i, element) {
                var id = $(element).attr("id");
                if (!inArray(id, checked_ids)) {
                    checked_ids.push(id);
                }
            });

            $('#access').val(checked_ids);
        });
    });

    function inArray(needle, haystack) {
        var length = haystack.length;
        for (var i = 0; i < length; i++) {
            if (haystack[i] == needle)
                return true;
        }
        return false;
    }
</script>


