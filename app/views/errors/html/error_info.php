<?php if ($_SERVER['CI_ENV'] !== 'production'): ?>
	<div class="page-header">
	    <div class="row">
	        <h1 class="col-xs-12 col-sm-12 text-left-sm">
	            <i class="fa fa-unlink" page-header-icon></i>&nbsp;Error Occured
	        </h1>
	    </div>
	</div>
	<div id="info_" class="note note-danger">
	    <?php echo $content; ?>
	</div>
<?php else: ?>
    <?php header("Location: " . (!empty($_SERVER['HTTPS_ENV']) && $_SERVER['HTTPS_ENV'] !== 'off' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']) . 'sys-error/error.php'); ?>
<?php endif; ?>