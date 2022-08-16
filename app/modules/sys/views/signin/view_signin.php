<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $this->config->item('nama_sistem'); ?>: Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

        <link rel="shortcut icon" href="<?php echo base_url(); ?>sys-assets/images/favicon.ico" />
        <link href="<?php echo ((!empty($_SERVER['HTTPS_ENV']) && $_SERVER['HTTPS_ENV'] !== 'off') ? "https" : "http") . "://"; ?>fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,800,300&subset=latin" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>sys-assets/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <script>function _pxDemo_loadStylesheet(a, b, c){var c = c || decodeURIComponent((new RegExp(";\\s*" + encodeURIComponent("px-demo-theme") + "\\s*=\\s*([^;]+)\\s*;", "g").exec(";" + document.cookie + ";") || [])[1] || "default"), d = "1" === decodeURIComponent((new RegExp(";\\s*" + encodeURIComponent("px-demo-rtl") + "\\s*=\\s*([^;]+)\\s*;", "g").exec(";" + document.cookie + ";") || [])[1] || "0"); document.write(a.replace(/^(.*?)((?:\.min)?\.css)$/, '<link href="$1' + (c.indexOf("dark") !== - 1 && a.indexOf("/css/") !== - 1 && a.indexOf("/themes/") === - 1?"-dark":"") + (d && a.indexOf("assets/") === - 1?".rtl":"") + '$2" rel="stylesheet" type="text/css"' + (b?'class="' + b + '"':"") + ">"))}</script>
        <script>"1" === decodeURIComponent((new RegExp(";\\s*" + encodeURIComponent("px-demo-rtl") + "\\s*=\\s*([^;]+)\\s*;", "g").exec(";" + document.cookie + ";") || [])[1] || "0") && document.getElementsByTagName("html")[0].setAttribute("dir", "rtl");</script>
        <script>
            _pxDemo_loadStylesheet('<?php echo base_url(); ?>sys-assets/css/bootstrap.min.css', 'px-demo-stylesheet-core');
            _pxDemo_loadStylesheet('<?php echo base_url(); ?>sys-assets/css/pixeladmin.min.css', 'px-demo-stylesheet-bs');
        </script>
        <script>
            function _pxDemo_loadTheme(a){var b = decodeURIComponent((new RegExp(";\\s*" + encodeURIComponent("px-demo-theme") + "\\s*=\\s*([^;]+)\\s*;", "g").exec(";" + document.cookie + ";") || [])[1] || "default"); _pxDemo_loadStylesheet(a + b + ".min.css", "px-demo-stylesheet-theme", b)}
            _pxDemo_loadTheme('<?php echo base_url(); ?>sys-assets/css/themes/');
        </script>
        <script>_pxDemo_loadStylesheet('<?php echo base_url(); ?>sys-assets/css/demo.css');</script>

        <!--[if !IE]> -->
        <script src="<?php echo base_url(); ?>sys-assets/js/jquery-2.2.0.min.js"></script>
        <!-- <![endif]-->
        <!--[if lte IE 9]>
          <script src="<?php echo base_url(); ?>sys-assets/js/jquery-1.12.0.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <script type="text/javascript">
            var pxInit = [];
            var env = "<?php echo $_SERVER['CI_ENV']; ?>";
            var base = "<?php echo base_url(); ?>";
        </script>
        <style>
            .page-signin-modal {
                position: relative;
                top: auto;
                right: auto;
                bottom: auto;
                left: auto;
                z-index: 1;
                display: block;
            }

            .page-signin-form-group { position: relative; }

            .page-signin-icon {
                position: absolute;
                line-height: 21px;
                width: 36px;
                border-color: rgba(0, 0, 0, .14);
                border-right-width: 1px;
                border-right-style: solid;
                left: 1px;
                top: 9px;
                text-align: center;
                font-size: 15px;
            }

            html[dir="rtl"] .page-signin-icon {
                border-right: 0;
                border-left-width: 1px;
                border-left-style: solid;
                left: auto;
                right: 1px;
            }

            html:not([dir="rtl"]) .page-signin-icon + .page-signin-form-control { padding-left: 50px; }
            html[dir="rtl"] .page-signin-icon + .page-signin-form-control { padding-right: 50px; }

            #page-signin-forgot-form {
                display: none;
            }

            .page-signin-modal > .modal-dialog { margin: 30px 10px; }

            @media (min-width: 544px) {
                .page-signin-modal > .modal-dialog { margin: 60px auto; }
            }
        </style>
        <script>
            pxInit.push(function() {
            $(function() {
            pxDemo.initializeBgsDemo('body', 1, '#000', function(isBgSet) {
            $('#px-demo-signup-link, #px-demo-signup-link a')
                    .addClass(isBgSet ? 'text-white' : 'text-muted')
                    .removeClass(isBgSet ? 'text-muted' : 'text-white');
            });
            $('#page-signin-forgot-link').on('click', function(e) {
            e.preventDefault();
            $('#page-signin-form, #page-signin-social')
                    .css({ opacity: '1' })
                    .animate({ opacity: '0' }, 200, function() {
                    $(this).hide();
                    $('#page-signin-forgot-form')
                            .css({ opacity: '0', display: 'block' })
                            .animate({ opacity: '1' }, 200)
                            .find('.form-control').first().focus();
                    $(window).trigger('resize');
                    });
            });
            $('#page-signin-forgot-back').on('click', function(e) {
            e.preventDefault();
            $('#page-signin-forgot-form')
                    .animate({ opacity: '0' }, 200, function() {
                    $(this).css({ display: 'none' });
                    $('#page-signin-form, #page-signin-social')
                            .show()
                            .animate({ opacity: '1' }, 200)
                            .find('.form-control').first().focus();
                    $(window).trigger('resize');
                    });
            });
            });
            });
        </script>
        
        <noscript>
            <style> 
                .page-signin-modal { display: none }
            </style>
            <div class="page-header">
                <h1><i class="page-header-icon fa fa-unlink"></i>&nbsp;Error Occurred</h1>
            </div>
            <div class="note note-danger"><b>Sorry</b>, You don't have javascript enabled in your browser.</div>
        </noscript>
        
        <div class="page-signin-modal modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="box m-a-0">
                        <div class="box-row">
                            <div class="box-cell col-md-5 bg-primary p-a-4">
                                <div class="text-xs-center text-md-left">
                                    <div class="font-size-18 m-t-1 line-height-1">
                                        <strong><?php echo $this->config->item('nama_sistem'); ?></strong>
                                    </div>
                                    <div class="font-size-15 m-t-1 line-height-1">
                                        <?php echo $this->config->item('deskripsi_sistem'); ?><br />
                                    </div>
                                </div>
                            </div>
                            <div class="box-cell col-md-7">
                                <form class="p-a-4" id="page-signin-form" action="<?php echo $form_action; ?>" method="post">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                    <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold">
                                        Masukkan Username dan Password
                                    </h4>
                                    <?php if (validation_errors()): ?>
                                        <div class="">
                                            <strong>Error!</strong><?php echo validation_errors(); ?>
                                        </div>
                                    <?php endif; ?>
                                    <fieldset class="page-signin-form-group form-group form-group-lg">
                                        <div class="page-signin-icon text-muted"><i class="fa fa-user"></i></div>
                                        <input type="text" name="username" class="page-signin-form-control form-control" placeholder="Username" value="<?php echo set_value('username'); ?>">
                                    </fieldset>
                                    <fieldset class="page-signin-form-group form-group form-group-lg">
                                        <div class="page-signin-icon text-muted"><i class="fa fa-lock"></i></div>
                                        <input type="password" name="password" class="page-signin-form-control form-control" placeholder="Password" value="<?php echo set_value('password'); ?>">
                                    </fieldset>
                                    <div class="page-signin-form-group form-group from-group-lg clearfix">
                                        <span id="captcha-img" class="pull-xs-left"><?php echo $image; ?></span>
                                        <a class="pull-xs-right xhrd dest_captcha-img btn btn-lg bg-primary" href="<?php echo site_url('sys/signin/reload_captcha'); ?>"><span class="fa fa-refresh"></span></a>
                                    </div>
                                    <fieldset class="page-signin-form-group form-group form-group-lg">
                                        <div class="page-signin-icon text-muted"><i class="fa fa-barcode"></i></div>
                                        <input type="text" class="page-signin-form-control form-control" id="captcha" name="captcha" placeholder="Captcha" <?php
                                        if (ENVIRONMENT !== 'production') {
                                            echo 'value="' . $this->session->userdata('mycaptcha') . '"';
                                        }
                                        ?> />
                                    </fieldset>
                                    <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Sign In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-xs-center m-t-2 font-weight-bold font-size-14 text-white" id="px-demo-signup-link">
                    Copyright &#0169; SIMJapel <?php echo date('Y'); ?><br/>
                    <small><?php echo $this->config->item('version'); ?></small>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>sys-assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>sys-assets/js/pixeladmin.min.js"></script>
        <script src="<?php echo base_url(); ?>sys-assets/js/demo.js"></script>
        <script src="<?php echo base_url(); ?>sys-assets/js/ajax.js"></script>
        <script>
            function menu_selected() {}
            pxDemo.initializeDemoSidebar();
            pxInit.push(function() {
                $(function() {
                $('#px-demo-sidebar').pxSidebar();
                });
            });
        </script>
        <script type="text/javascript">
            pxInit.unshift(function() {
                $(function() {
                    pxDemo.initializeDemo();
                });
            });
            for (var i = 0, len = pxInit.length; i < len; i++) {
            pxInit[i].call(null);
            }
        </script>
    </body>
</html>