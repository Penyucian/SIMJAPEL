<?php echo $this->breadcrump(); ?>

<?php if (validation_errors()) { ?>
    <?php echo validation_errors(); ?>
<?php } ?>

<script>
    $(document).ready(function ()
    {
        $("#validasi").validate({
            rules: {
                passwordBaru: {required: true, minlength: 6},
                passwordBaruConfirm: {required: true, equalTo: "#passwordBaru"}
            },
            messages: {
                passwordBaru: {required: 'Password harus diisi', minlength: 'Password minimal 6 karakter'},
                passwordBaruConfirm: {required: 'Ulangi Password tidak cocok', equalTo: 'Isi harus sama dengan Password'}
            },
            success: function (label)
            {
                label.text('OK!').addClass('valid');
            }
        });
    });
</script>

<div class="panel">
    <div class="panel-body">
        <form method="post" rel="ajax" action="<?php echo site_url('sys/change_password/update_change_password'); ?>" class="form-horizontal xhr dest_subcontent-element" autocomplete="off" id="validasi">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <div class="form-group">
                <label class="col-sm-2 control-label" style='text-align:left;'>
                    Password Lama
                    <span class="text-danger">*</span>
                </label>
                <div class="col-sm-3">
                    <input class="form-control" type="password" name='passwordLama' value="<?php echo set_value('passwordLama'); ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" style='text-align:left;'>
                    Password Baru
                    <span class="text-danger">*</span>
                </label>
                <div class="col-sm-3">
                    <input class="form-control" type="password" name='passwordBaru' id="passwordBaru" value="<?php echo set_value('passwordBaru'); ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" style='text-align:left;'>
                    Re-type Password Baru
                    <span class="text-danger">*</span>
                </label>
                <div class="col-sm-3">
                    <input class="form-control" type="password" name='passwordBaruConfirm' id="passwordBaruConfirm" />
                    <p class="help-block">
                        <i class="fa fa-info-circle"></i> <i>isikan ulang password baru anda.</i>
                    </p>
                </div>
            </div>

            <hr class="panel-wide"/>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </div>
        </form>
    </div>
</div>

