<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo ($title) ? $title : $this->config->item('nama_sistem'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="<?php echo $this->security->get_csrf_hash(); ?>" />
    <meta name="csrf-name" content="<?php echo $this->security->get_csrf_token_name(); ?>" />
    <meta name="csrf-cookie" content="<?php echo $this->config->item('csrf_cookie_name'); ?>" />
    <?php echo $metadata; ?>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>sys-assets/images/favicon.ico" />
    <link href="<?php echo ((!empty($_SERVER['HTTPS_ENV']) && $_SERVER['HTTPS_ENV'] !== 'off') ? "https" : "http") . "://"; ?>fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,800,300&subset=latin" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>sys-assets/plugins/pace/css/black/pace-theme-minimal.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>sys-assets/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>sys-assets/css/jquery-ui-1.12.1.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>sys-assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />

    <!--[if !IE]> -->
    <script src="<?php echo base_url(); ?>sys-assets/js/jquery-2.2.0.min.js"></script>
    <!-- <![endif]-->
    <!--[if lte IE 9]>
            <script src="<?php echo base_url(); ?>sys-assets/js/jquery-1.12.0.min.js"></script>
        <![endif]-->

    <script>
        function _pxDemo_loadStylesheet(a, b, c) {
            var c = c || decodeURIComponent((new RegExp(";\\s*" + encodeURIComponent("px-demo-theme") + "\\s*=\\s*([^;]+)\\s*;", "g").exec(";" + document.cookie + ";") || [])[1] || "default"),
                d = "1" === decodeURIComponent((new RegExp(";\\s*" + encodeURIComponent("px-demo-rtl") + "\\s*=\\s*([^;]+)\\s*;", "g").exec(";" + document.cookie + ";") || [])[1] || "0");
            document.write(a.replace(/^(.*?)((?:\.min)?\.css)$/, '<link href="$1' + (c.indexOf("dark") !== -1 && a.indexOf("/css/") !== -1 && a.indexOf("/themes/") === -1 ? "-dark" : "") + (d && a.indexOf("assets/") === -1 ? ".rtl" : "") + '$2" rel="stylesheet" type="text/css"' + (b ? 'class="' + b + '"' : "") + ">"))
        }
    </script>

    <script>
        "1" === decodeURIComponent((new RegExp(";\\s*" + encodeURIComponent("px-demo-rtl") + "\\s*=\\s*([^;]+)\\s*;", "g").exec(";" + document.cookie + ";") || [])[1] || "0") && document.getElementsByTagName("html")[0].setAttribute("dir", "rtl");
    </script>
    <script>
        _pxDemo_loadStylesheet('<?php echo base_url(); ?>sys-assets/css/bootstrap.min.css', 'px-demo-stylesheet-core');
        _pxDemo_loadStylesheet('<?php echo base_url(); ?>sys-assets/css/pixeladmin.min.css', 'px-demo-stylesheet-bs');
        _pxDemo_loadStylesheet('<?php echo base_url(); ?>sys-assets/css/widgets.min.css', 'px-demo-stylesheet-widgets');
    </script>
    <script>
        function _pxDemo_loadTheme(a) {
            var b = decodeURIComponent((new RegExp(";\\s*" + encodeURIComponent("px-demo-theme") + "\\s*=\\s*([^;]+)\\s*;", "g").exec(";" + document.cookie + ";") || [])[1] || "default");
            _pxDemo_loadStylesheet(a + b + ".min.css", "px-demo-stylesheet-theme", b)
        }
        _pxDemo_loadTheme('<?php echo base_url(); ?>sys-assets/css/themes/');
    </script>

    <script>
        _pxDemo_loadStylesheet('<?php echo base_url(); ?>sys-assets/css/demo.css');
    </script>
</head>

<body>
    <script type="text/javascript">
        var pxInit = [];
        var checked = [];
        var url = '';
        var env = "<?php echo $_SERVER['CI_ENV']; ?>";
        var base = "<?php echo base_url(); ?>";
        localStorage['sysCache'] = '';
    </script>

    <nav class="px-nav px-nav-left px-script-content" id="px-demo-nav">
        <?php echo $this->menu(); ?>
    </nav>
    <nav class="navbar px-navbar px-script-content">
        <?php echo $this->header(); ?>
    </nav>
    <div class="busy-indicator modal-backdrop fade in" style='display:none;'>
        <div class="row">
            <div class='col-sm-12' style='text-align:center;margin-top:10%;'>
                <img style="width: 20%;" src="<?php echo base_url(); ?>sys-assets/images/hospital.png" /><br />
                <h3><?php echo $this->config->item('nama_sistem'); ?></h3><br />
                <img src="<?php echo base_url(); ?>sys-assets/images/load-baru.gif" />
            </div>
        </div>
    </div>
    <noscript>
        <style>
            .px-script-content {
                display: none
            }
        </style>
        <div class="page-header">
            <h1><i class="page-header-icon fa fa-unlink"></i>&nbsp;Error Occurred</h1>
        </div>
        <div class="note note-danger"><b>Sorry</b>, You don't have javascript enabled in your browser.</div>
    </noscript>
    <div class="px-content px-script-content" id="subcontent-element">
        <?php echo $content; ?>
    </div>

    <script src="<?php echo base_url(); ?>sys-assets/js/demo.js"></script>
    <script src="<?php echo base_url(); ?>sys-assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>sys-assets/js/pixeladmin.min.js"></script>
    <script src="<?php echo base_url(); ?>sys-assets/js/jquery-ui-1.12.1.min.js"></script>
    <script src="<?php echo base_url(); ?>sys-assets/js/holder.js"></script>
    <script src="<?php echo base_url(); ?>sys-assets/js/ajax.js"></script>
    <script src="<?php echo base_url(); ?>sys-assets/js/main.js"></script>
    <script src="<?php echo base_url(); ?>sys-assets/plugins/pace/js/pace.min.js"></script>
    <script src="<?php echo base_url(); ?>sys-assets/js/jquery.inputmask.min.js"></script>
    <script src="<?php echo base_url(); ?>sys-assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>sys-assets/js/jquery.serializejson.js"></script>
    <script src="<?php echo base_url(); ?>sys-assets/js/custom.js"></script>
    <?php echo $js; ?>
    <!--<i><?php $this->load->library('sys/Logview');
            echo substr($this->logview->get_ip(), -3); ?></i>-->
    <script>
        pxDemo.initializeDemoSidebar();
        pxInit.push(function() {
            $('#px-demo-sidebar').pxSidebar();
            pxDemo.initializeDemo();
        });
    </script>
    <script type="text/javascript">
        $(window).load(function() {
            menu_selected();
            if (url) {
                url_selected(url);
            }
        });
        pxInit.unshift(function() {
            var file = String(document.location).split('/').pop();
            file = file.replace(/(\.html).*/i, '$1');
            if (!/.html$/i.test(file)) {
                file = 'index.html';
            }

            $('#px-demo-nav')
                .find('.px-nav-item > a[href="' + file + '"]')
                .parent()
                .addClass('active');
            $('#px-demo-nav').pxNav();
            $('#px-demo-footer').pxFooter();
        });
        for (var i = 0, len = pxInit.length; i < len; i++) {
            pxInit[i].call(null);
        }
    </script>
</body>

</html>