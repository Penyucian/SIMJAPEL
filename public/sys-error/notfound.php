<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Page Not Found</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

        <link rel="shortcut icon" href="../sys-assets/images/favicon.ico" />
        <link href="<?php echo (!empty($_SERVER['HTTPS_ENV']) && $_SERVER['HTTPS_ENV'] !== 'off') ? "https" : "http" . "://"; ?>fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">
        <link href="../sys-assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="../sys-assets/css/pixel-admin.min.css" rel="stylesheet" type="text/css">
        <link href="../sys-assets/css/pages.min.css" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="../sys-assets/images/favicon.ico" />
    </head>
    <body class="page-404">
        <div class="header">
            <strong class="logo"><?php echo $this->config->item('version'); ?></strong>
        </div> 
        <div class="error-code"><img src="../sys-assets/images/notfound.png" /></div>
        <div class="error-text">
            <b>Sorry</b>, something went wrong, or that page doesn't exist,...yet.
        </div>
        <div class="search-form">	
            <a href="<?php echo ((isset($_SERVER['HTTPS_ENV']) && $_SERVER['HTTPS_ENV'] == "on") ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . str_replace('sys-error/' . basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']); ?>">
                <button class="search-btn">Homepage</button>
            </a>	
        </div>
        <script type="text/javascript">
            if (typeof ($) !== 'undefined') {
                $(document).ready(function () {
                    $("#subcontent-element").html('<div class="page-header"><div class="row">\n\
                    <h1 class="col-xs-12 col-sm-12 text-left-sm">\n\
                    <i class="fa fa-unlink" page-header-icon></i>&nbsp;Error Occured</h1>\n\
                    </div></div><div class="note note-danger"><b>Sorry</b>, We can\'t show your request yet, something went wrong, we will check it soon.</div>');
                    $(".modal-backdrop").remove();
                    $(".modal").remove();
                });
            }
        </script>
    </body>
</html>