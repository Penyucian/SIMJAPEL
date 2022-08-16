var hash_;
(function ($) {
    var load = function (url, dest, historyState) {
        if (typeof (historyState) === 'undefined')
            historyState = true;

        if (dest === '0') {
            dest = 'subcontent-element';
        }

        if (historyState) {
            if (url !== window.location) {
                window.history.pushState({path: url}, '', url);
            }
        }

        if ($.trim(url) !== '') {
            load_(url, dest);
        }

        return false;
    };

    window.addEventListener('popstate', function (event) {
        load_(window.location.href, 'subcontent-element');
    });

    function load_(url, dest) {
        $('#px-demo-footer').hide();
        $('#' + dest).fadeOut().load(url, function (data) {
            menu_selected();
            $(this).fadeIn();
            $('.busy-indicator').fadeOut();
            $('#px-demo-footer').show();
            if (data === '{"scripts":["location.reload(true);"]}') {
                location.reload(true);
            }
        });
    }

    jQuery(document).ready(function ($) {
        $.ajaxSetup({
            timeout: 50000,
            error: function (event, request, settings) {
                if (env === 'production') {
                    if (typeof (event.responseText) !== 'undefined') {
                        res = '';
                    } else {
                        res = '<div class="note note-danger"><b>Timeout.</b></div>';
                    }

                    $("#subcontent-element").html('<div class="page-header"><div class="row">\n\
                        <h1 class="col-xs-12 col-sm-12 text-left-sm">\n\
                        <i class="fa fa-unlink" page-header-icon></i>&nbsp;Error Occured</h1>\n\
                        </div></div><div class="note note-danger"><b>Sorry</b>, We can\'t show your request yet, something went wrong, we will check it soon.</div>' + res);
                } else {
                    if (typeof (event.responseText) !== 'undefined') {
                        res = event.responseText;
                    } else {
                        res = '<div class="note note-danger"><b>Timeout.</b></div>';
                    }

                    $("#subcontent-element").html('<div class="page-header"><div class="row">\n\
                        <h1 class="col-xs-12 col-sm-12 text-left-sm">\n\
                        <i class="fa fa-unlink" page-header-icon></i>&nbsp;Error Occured</h1>\n\
                        </div></div>\n\
                        <div class="note note-danger"><b>Sorry</b>, We can\'t show your request yet, something went wrong, we will check it soon.</div>' + res);
                }
            }
        });
        $('body').delegate('.paging a', 'click', function (e) {
            var dest = $(this).attr('id');
            var url = $(this).attr('href');
            var urlactive = $(this).parent().parent().hasClass('urlactive');

            if (urlactive) {
                window.history.pushState({path: url}, '', url);
            }

            $('.busy-indicator').fadeIn();
            $.ajax({
                type: "GET",
                url: $(this).attr('href'),
                success: function (table) {
                    $('#' + dest).html(table).fadeIn();
                    $('.busy-indicator').fadeOut();
                }
            });

            return false;
        });

        $('body').delegate('a', 'click', function (e) {
            var url = $(this).attr('href');
            var classHref = $(this).attr('class');

            if (typeof classHref !== 'undefined' && classHref !== null) {
                var patt_xhr = /\s*xhr\s+/i;
                var patt_xhrd = /\s*xhrd\s+/i;
                var patt_xhrs = /\s*xhrs\s+/i;
                var patt_xhrx = /\s*xhrx\s+/i;
                var patt_dest = /\s*dest\_[a-z\-\_0-9]*\s*/i;
                var xhr = classHref.match(patt_xhr);
                var xhrd = classHref.match(patt_xhrd);
                var xhrs = classHref.match(patt_xhrs);
                var xhrx = classHref.match(patt_xhrx);
                var dest = classHref.match(patt_dest);
                xhr = $.trim(xhr);
                xhrd = $.trim(xhrd);
                xhrs = $.trim(xhrs);
                xhrx = $.trim(xhrx);

                if ((xhr !== '' || xhrd !== '' || xhrs !== '' || xhrx !== '') && dest !== null) {
                    dest = $.trim(dest);
                    dest = dest.replace("dest_", "");
                    $(".busy-indicator").fadeIn();

                    //xhr : url browser berubah sesuai url ajax (mis : untuk link menu)
                    if (xhr === 'xhr') {
                        load(url, dest);
                        if (typeof $("#subcontent-element").offset() != "undefined") {
                            $('html, body').animate({
                                scrollTop: $("#subcontent-element").offset().top
                            }, 2000);
                        }
                    }

                    //xhrd : url browser tidak berubah (mis : untuk link reload captcha)
                    if (xhrd === 'xhrd') {
                        load(url, dest, false);
                    }

                    //xhrs : url dan message sesuai response ajax (mis : untuk link delete)
                    if (xhrs === 'xhrs') {
                        $.ajax({
                            type: 'GET',
                            url: url,
                            success: function (data) {
                                var obj = JSON.parse(data);
                                if (obj['scripts'] === 'location.reload(true);') {
                                    $(".busy-indicator").fadeOut();
                                    location.reload(true);
                                } else {
                                    if (obj['status'] === 'success') {
                                        load(obj['url'], dest);
                                        $.growl.notice({message: obj['msg'], size: 'large'});
                                    } else if (obj['status'] === 'danger') {
                                        load(obj['url'], dest);
                                        $.growl.error({message: obj['msg'], size: 'large'});
                                    } else if (obj['status'] === 'warning') {
                                        load(obj['url'], dest);
                                        $.growl.warning({message: obj['msg'], size: 'large'});
                                    }
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                $("#subcontent-element").html(jqXHR.responseText);
                                $(".busy-indicator").hide();
                            }
                        });
                    }
                    //xhrx : url browser tidak berubah reload sesuai response
                    if (xhrx === 'xhrx') {
                        $.ajax({
                            type: 'GET',
                            url: url,
                            success: function (data) {
                                var obj = JSON.parse(data);
                                if (obj['scripts'] === 'location.reload(true);') {
                                    $(".busy-indicator").fadeOut();
                                    location.reload(true);
                                } else {
                                    if (obj['status'] === 'success') {
                                        load(obj['url'], dest, false);
                                        $.growl.notice({message: obj['msg'], size: 'large'});
                                    } else if (obj['status'] === 'danger') {
                                        load(obj['url'], dest, false);
                                        $.growl.error({message: obj['msg'], size: 'large'});
                                    } else if (obj['status'] === 'warning') {
                                        load(obj['url'], dest, false);
                                        $.growl.warning({message: obj['msg'], size: 'large'});
                                    }
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                $("#subcontent-element").html(jqXHR.responseText);
                                $(".busy-indicator").hide();
                            }
                        });
                    }
                    return false;
                }
            }
        });

        $('body').delegate("form[rel='ajax']", 'submit', function (e) {
            if (this.beenSubmitted) {
                return false;
            } else {
                this.beenSubmitted = true;
            }
            var objForm = $(this);

            var classHref = $(this).attr('class');
            if (typeof classHref !== 'undefined' && classHref !== null) {
                var patt_xhr = /\s*xhr\s+/i;
                var patt_dest = /\s*dest\_[a-z\-\_0-9]*\s*/i;
                var patt_std = /\s*std\_[a-z\-_]*\s*/i;

                var std = classHref.match(patt_std);
                var xhr = classHref.match(patt_xhr);
                var dest = classHref.match(patt_dest);

                if ((xhr !== null && dest !== null) || (std !== null)) {
                    xhr = $.trim(xhr);
                    dest = $.trim(dest);
                    dest = dest.replace("dest_", "");
                    if ($.trim(dest) === '')
                        dest = 'subcontent-element';

                    if (objForm.attr('id') === 'file') {
                        $('.busy-indicator').fadeIn("slow");
                        e.preventDefault();
                        var file = '&userfile=' + $('#userfile').val();
                        var data = objForm.serializeAndEncode();
                        var datapost = data + file;
                        $.ajaxFileUpload({
                            url: objForm.attr('action'),
                            secureuri: false,
                            fileElementId: 'userfile',
                            dataType: 'JSON',
                            data: datapost,
                            cache: false,
                            contentType: false,
                            processData: false,
                            type: 'POST',
                            success: function (data)
                            {
                                var obj = JSON.parse(data);
                                var link = obj['url'];
                                if (obj['status'] === 'success') {
                                    $('#' + dest).load(link);
                                    $.growl.notice({message: obj['msg'], size: 'large'});
                                } else if (obj['status'] === 'danger') {
                                    $('#' + dest).load(link);
                                    $.growl.error({message: obj['msg'], size: 'large'});
                                } else if (obj['status'] === 'warning') {
                                    $('#' + dest).load(link);
                                    $.growl.warning({message: obj['msg'], size: 'large'});
                                }
                                $('.busy-indicator').fadeOut('slow');
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                $.growl.error({message: "Error " + jqXHR.responseText, size: 'large'});
                                $('.busy-indicator').hide();
                            }
                        });
                        return false;
                    } else {
                        $(".busy-indicator").fadeIn("slow");
                        $.ajax({
                            type: 'POST',
                            url: objForm.attr('action'),
                            data: objForm.serializeAndEncode(),
                            success: function (data) {
                                if (data === '{"scripts":["location.reload(true);"]}') {
                                    $(".busy-indicator").fadeOut();
                                    location.reload(true);
                                } else {
                                    if (isJsonString(data)) {
                                        var obj = JSON.parse(data);
                                        if (obj['scripts'] === 'location.reload(true);') {
                                            $(".busy-indicator").fadeOut();
                                            location.reload(true);
                                        } else {
                                            if (obj['is_modal'] === 1) {
                                                $('.modal').modal('hide');
                                                if (obj['status'] === 'success') {
                                                    load(obj['url'], obj['dest'], false);
                                                    $.growl.notice({message: obj['msg'], size: 'large'});
                                                } else if (obj['status'] === 'danger') {
                                                    load(obj['url'], obj['dest'], false);
                                                    $.growl.error({message: obj['msg'], size: 'large'});
                                                } else if (obj['status'] === 'warning') {
                                                    load(obj['url'], obj['dest'], false);
                                                    $.growl.warning({message: obj['msg'], size: 'large'});
                                                }
                                            } else {
                                                if (obj['status'] === 'success') {
                                                    load(obj['url'], dest, true);
                                                    $.growl.notice({message: obj['msg'], size: 'large'});
                                                } else if (obj['status'] === 'danger') {
                                                    load(obj['url'], dest, false);
                                                    $.growl.error({message: obj['msg'], size: 'large'});
                                                } else if (obj['status'] === 'warning') {
                                                    load(obj['url'], dest, false);
                                                    $.growl.warning({message: obj['msg'], size: 'large'});
                                                }
                                            }
                                        }
                                    } else if ($.trim(data) !== '') {
                                        $('#' + dest).fadeOut(200, function () {
                                            $('#' + dest).html(data);
                                            $('#' + dest).fadeIn(200);
                                            $(".busy-indicator").hide();
                                        });
                                    }
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                $.growl.error({message: "Error " + jqXHR.responseText, size: 'large'});
                                $(".busy-indicator").hide();
                            }
                        });
                    }
                    return false;
                }
            }
        });

        $('body').delegate("form[rel='ajax-file']", 'submit', function (e) {
            var classHref = $(this).attr('class');
            var objForm = $(this);

            if (typeof classHref != 'undefined' && classHref != null) {
                var patt_xhr = /\s*xhr\s+/i;
                var patt_dest = /\s*dest\_[a-z\-\_0-9]*\s*/i;

                var xhr = classHref.match(patt_xhr);
                var dest = classHref.match(patt_dest);

                dest = $.trim(dest);
                dest = dest.replace("dest_", "");

                if (xhr != null && dest != null) {

                    $('.busy-indicator').fadeIn("slow");
                    e.preventDefault();

                    var oReq = new XMLHttpRequest, fd = new FormData(objForm[0]);
                    oReq.open('post', objForm.attr('action'), true);
                    oReq.setRequestHeader("X-Requested-With", 'XMLHttpRequest');
                    oReq.onreadystatechange = function (oEvent) {
                        $("input[name=" + $('meta[name="csrf-name"]').attr('content') + ']').val(getCookie($('meta[name="csrf-cookie"]').attr('content')));
                        if (oReq.readyState === 4 && oReq.status === 200) {
                            if (isJsonString(oReq.responseText)) {
                                var j = JSON.parse(oReq.responseText);
                                if (j.is_modal == 1) {
                                    $('.modal').modal('hide');
                                    if (j.status == 'success') {
                                        load(j.url, j.dest, false);
                                        $.growl.notice({message: j.msg, size: 'large'});
                                    } else if (j.status == 'danger') {
                                        load(j.url, j.dest, false);
                                        $.growl.error({message: j.msg, size: 'large'});
                                    } else if (j.status == 'warning') {
                                        load(j.url, j.dest, false);
                                        $.growl.warning({message: j.msg, size: 'large'});
                                    }
                                } else {
                                    if (j.status == 'success') {
                                        load(j.url, dest, true);
                                        $.growl.notice({message: j.msg, size: 'large'});
                                    } else if (j.status == 'danger') {
                                        load(j.url, dest, true);
                                        $.growl.error({message: j.msg, size: 'large'});
                                    } else if (j.status == 'warning') {
                                        load(j.url, dest, true);
                                        $.growl.warning({message: j.msg, size: 'large'});
                                    }
                                }
                            } else if ($.trim(oReq.responseText) != '') {
                                $('#' + dest).fadeOut(200, function () {
                                    $('#' + dest).html(oReq.responseText);
                                    $('#' + dest).fadeIn(200);
                                    $(".busy-indicator").hide();
                                });
                            }
                        }

                        if (oReq.readyState === 4 && oReq.status !== 200) {
                            $.growl.error({message: "Error " + oReq.status, size: 'large'});
                            $(".busy-indicator").hide();
                        }
                    }
                    oReq.send(fd);
                }
            }
            return false;
        });
    });
})(jQuery);

$.fn.serializeAndEncode = function () {
    return $.map(this.serializeArray(), function (val) {
        return [val.name, encodeURIComponent(val.value)].join('=');
    }).join('&');
};

function dataTableGenerate(idTable, url) {
    $('#' + idTable).DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'print',
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        //"paging"			: false,
        //"scrollY"			: 300,
        //"info"			: false,
        //"searching"		: false,
        "autoWidth": false,
        "pageLength": 10,
        //"order"			: [[ 0, 'desc' ], [ 1, 'asc' ]],
        "pagingType": 'full_numbers',
        "language": {
            "info": "Menampilkan _START_ sampai _END_ dari total _TOTAL_",
            "emptyTable": "Mohon maaf, data tidak ditemukan.",
            "loadingRecords": "Please wait - loading...",
            "processing": "Loading..",
            "zeroRecords": "Mohon maaf, data tidak ditemukan.",
            "lengthMenu": "Jumlah Per Halaman _MENU_",
            "infoFiltered": "(filter dari _MAX_ data)",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": ">",
                "previous": "<"
            }
        },
        "ajax": {
            "url": url,
            "type": "post"
        }
    });
}

function isJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

if (env !== 'production') {
    customHandler = function (desc, page, line, chr) {
        $('.busy-indicator').hide();
        alert(
                'sys Error Reporting. \n'
                + 'error occurred! \n'
                + '\nError description: \t' + desc
                + '\nPage address:      \t' + page
                + '\nLine number:       \t' + line
                , 'Error Reporting');
        return true;
    };
    window.onerror = customHandler;
}

// Original JavaScript code by Chirp Internet: www.chirp.com.au
function getCookie(name)
{
    var re = new RegExp(name + "=([^;]+)");
    var value = re.exec(document.cookie);
    return (value !== null) ? decodeURIComponent(value[1]) : null;
}

$.ajaxPrefilter(function (options, originalOptions, jqXHR) {
    var csrf_name = $('meta[name="csrf-name"]').attr('content');
    var csrf_cookie = $('meta[name="csrf-cookie"]').attr('content');

    if (options.type.toLowerCase() === "post") {
        options.data = options.data || "";
        options.data += options.data ? "&" : "";
        options.data += csrf_name + '=' + getCookie(csrf_cookie);
    }
});