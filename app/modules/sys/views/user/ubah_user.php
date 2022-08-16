<?php echo $this->breadcrump(); ?>
<div class="panel">
    <div class="panel-body">
        <form method="post" rel="ajax" action="<?php echo site_url('sys/user/update_user'); ?>" class="form-horizontal xhr dest_subcontent-element">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <input name="user_id" type="hidden" value='<?php echo $content->user_id; ?>' />
            <div class="form-group">
                <label class="col-sm-2 control-label" style='text-align:left;'>
                    Username
                    <span class="text-danger">*</span>
                </label>
                <div class="col-sm-5">
                    <input class="form-control" name="user_username" type="text" value='<?php echo $content->user_username; ?>' />
                    <p class="help-block" id='help-username'></p>
                    <?php echo form_error('user_username', '<p class="help-block" style="color:red;"><i>', '</i></p>'); ?>
                </div>
            </div>
            <div class="form-group form-hide">
                <label class="col-sm-2 control-label" style='text-align:left;'>
                    Nama Lengkap
                    <span class="text-danger">*</span>
                </label>
                <div class="col-sm-6">
                    <input class="form-control" name="user_nama_lengkap" type="text" value='<?php echo $content->user_nama_lengkap; ?>' />
                    <?php echo form_error('user_nama_lengkap', '<p class="help-block" style="color:red;"><i>', '</i></p>'); ?>
                </div>
            </div>
            <div class="form-group form-hide">
                <label class="col-sm-2 control-label" style='text-align:left;'>
                    Email
                </label>
                <div class="col-sm-4">
                    <input class="form-control" name="user_email" type="email" value='<?php echo $content->user_email; ?>' />
                    <?php echo form_error('user_email', '<p class="help-block" style="color:red;"><i>', '</i></p>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" style='text-align:left;'>
                    Status
                    <span class="text-danger">*</span>
                </label>
                <div class="col-sm-6">
                    <?php
                    $metode = array('Tidak Aktif', 'Aktif');
                    foreach ($metode as $key => $val) {
                        $isChecked = '';
                        if ($content->user_is_aktif == $key) {
                            $isChecked = "checked='checked'";
                        }

                        echo "
							<label class='radio-inline'>
								<input type='radio' name='is_aktif' value='" . $key . "' class='px' " . $isChecked . "/>
								<span class='lbl'>" . $val . "</span>
							</label>
						";
                    }
                    ?>
                    <?php echo form_error('is_aktif', '<p class="help-block" style="color:red;"><i>', '</i></p>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" style='text-align:left;'>
                    Group Menu
                    <span class="text-danger">*</span>
                </label>
                <div class="col-sm-7">
                    <div class="select2-primary">
                        <select multiple="multiple" class="form-control" id='select2-multiple' name="group[]">
                            <?php
                            $check = array();
                            if ($access != NULL) {
                                foreach ($access as $value_id) :
                                    $check[] = $value_id['group_menu_id'];
                                endforeach;
                            }
                            foreach ($group as $list) {
                                if (in_array($list['group_menu_id'], $check)) {
                                    echo "
										<option value='" . $list['group_menu_id'] . "' selected>" . $list['group_menu_nama'] . "</option>
									";
                                } else {
                                    echo "
										<option value='" . $list['group_menu_id'] . "'>" . $list['group_menu_nama'] . "</option>
									";
                                }
                            }
                            ?>
                        </select>
                        <?php echo form_error('group[]', '<p class="help-block" style="color:red;"><i>', '</i></p>'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group form-hide">
                <label class="col-sm-12 control-label" style='text-align:left;'>
                    <h3><i class="fa fa-lock"></i> Ganti Password</h3>
                </label>
            </div>

            <div class="form-group form-hide">
                <label class="col-sm-2 control-label" style='text-align:left;'>
                    Password Baru
                </label>
                <div class="col-sm-3">
                    <input class="form-control" name="user_password" type="password" />
                    <?php echo form_error('user_password', '<p class="help-block" style="color:red;"><i>', '</i></p>'); ?>
                </div>
            </div>
            <div class="form-group form-hide">
                <label class="col-sm-2 control-label" style='text-align:left;'>
                    Re-type Password Baru
                </label>
                <div class="col-sm-3">
                    <input class="form-control form-reset" name="retype_user_password" type="password" />
                    <?php echo form_error('retype_user_password', '<p class="help-block" style="color:red;"><i>', '</i></p>'); ?>
                </div>
            </div>
            <hr class="panel-wide" />
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <a href="<?php echo site_url('sys/user'); ?>" class="btn btn-labeled btn-warning xhr dest_subcontent-element">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
<link href="<?php echo base_url(); ?>sys-assets/stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css" />
<script>
    $(document).ready(function() {
        $("#select2-multiple").select2({
            allowClear: true
        });

        $("select[name='unit_kerja_kode']").select2({
            allowClear: true,
            placeholder: "Unit Kerja"
        });
        //on document load
        show_hide_element(0, false);
    });

    function show_hide_element(selected, sta) {
        if (selected == 0) {
            $('#help-username').text('');
            $('.form-hide').fadeIn();
        } else {
            $('.form-hide').hide();
        }
    }
</script>