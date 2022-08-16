<div class="page-header">
    <h1><i class="page-header-icon fa <?php echo $function->module_detail_page_css_clip ?>"></i>&nbsp;<?php echo $function->module_detail_page_title ?></h1>
</div>
<script type="text/javascript">
    $(document).ajaxComplete(function(){
        document.title = '<?php echo $this->config->item('nama_sistem'); ?>: ' + '<?php echo $function->module_detail_title ?>';
    });
    $(document).ready(function(){
        document.title = '<?php echo $this->config->item('nama_sistem'); ?>: ' + '<?php echo $function->module_detail_title ?>';
    });
</script>
