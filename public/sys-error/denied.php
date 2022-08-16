<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Access Denied</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

        <link rel="shortcut icon" href="../sys-assets/images/favicon.ico" />
        <link href="<?php echo (!empty($_SERVER['HTTPS_ENV']) && $_SERVER['HTTPS_ENV'] !== 'off' ? "https" : "http") . "://"; ?>fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">
        <link href="../sys-assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="../sys-assets/css/pixel-admin.min.css" rel="stylesheet" type="text/css">
        <link href="../sys-assets/css/pages.min.css" rel="stylesheet" type="text/css">
    </head>
    <body class="page-404">
        <div class="header">
            <strong class="logo"><?php echo $this->config->item('version'); ?></strong>
        </div> 
        <div class="error-code"><img src="../sys-assets/images/denied.png"  /></div>
        <div class="error-text">
            <b>Sorry</b>, Your account is not allowed to log in system.
        </div>
    </body>
</html>