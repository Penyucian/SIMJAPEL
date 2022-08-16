<?php

if (!defined('BASEPATH')){
    exit('No direct script access allowed');
}

class Pdfjs {

    /**
     * Hanya bisa untuk PDF & Image
     *
     * How to use?
     *
     * #onmodal
     * button :
     * <a data-toggle="modal" data-target="#id_modal" data-pdf-title="judul di panel title modal" data-pdf="<?php echo base_url('sys/file/unduh/'.$this->encryption_lib->urlencode('config_upload_path').'/'.$this->encryption_lib->urlencode($filename)); ?>" class="btn btn-sm btn-info button_class"><span class="btn-label-icon left fa fa-eye"></span>Tampilkan</a>
     *
     * load library di view:
     * $this->load->library('sys/pdfjs');
     * echo $this->pdfjs->modal('id_modal', 'button_class');
     *
     * #onpage
     * <a data-pdf="<?php echo base_url('sys/file/unduh/'.$this->encryption_lib->urlencode('config_upload_path').'/'.$this->encryption_lib->urlencode($filename)); ?>" class="btn btn-sm btn-info class_button"><span class="btn-label-icon left fa fa-eye"></span>Tampilkan</a>
     * $this->load->library('sys/pdfjs');
     * echo $this->>pdfjs->page('class_button');
     */

    protected $CI = NULL;
    private $funcjs = "function base64MimeType(encoded) {
    if (typeof encoded !== 'string') {
        return null;
        }
        var mime = encoded.match(/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).*,.*/);
        
            if (mime && mime.length) {
                return mime;
            }else{
                return encoded;
            }
        }
        
        function getFile(url, callback) {
          var xhr = new XMLHttpRequest();
          xhr.open('GET', url, true);
          xhr.responseType = 'blob';
          xhr.onload = function() {
           callback(url, xhr.response);
          };
          xhr.onerror = function(data) {
            alert(data);
          };
          xhr.send();
        }
        var options = {
                    pdfOpenParams: {
                        pagemode: 'thumbs',
                        navpanes: 0,
                        toolbar: 0,
                        statusbar: 0,
                        view: 'FitV'
                    }
                };
        var mimes = ['image/png', 'image/jpeg', 'image/jpeg', 'image/gif'];
        function callback_(url, data){
            var mime = data.type;
            var file = '<object data=\"'+url+'\" type=\"'+mime+'\" width=\"100%\" height=\"100%\"><iframe src=\"'+url+'\" style=\"border: none;\" width=\"100%\" height=\"100%\"><a class=\"btn btn-info\" href=\"'+url+'\">Unduh Berkas</a></iframe></object>';
            if (mime == 'application/pdf'){
                $('#show_pdfjs').html(file).css('height', '600px');
            }else if ($.inArray(mime, mimes) != -1){
                var a = $('<a href=\"'+url+'\" class=\"btn btn-lg btn-primary\" target=\"_blank\"><span class=\"btn-label-icon left fa fa-download\"></span>Unduh</a><br><img src=\"'+url+'\" class=\"img-responsive\" />');
                $('#show_pdfjs').html(a).css('height', 'auto');
            }else{
                var a = $('<div class=\"alert alert-danger\">Berkas tidak dapat ditampilkan. Silakan unduh melalui tombol berikut. <a href=\"'+url+'\" class=\"btn btn-lg btn-primary\"><span class=\"btn-label-icon left fa fa-download\"></span>Unduh</a></div>');
                $('#show_pdfjs').html(a).css('height', '100px');
            }
        }
        ";

    public function __construct() {
        $this->CI = & get_instance();
    }
    function modal($id_modal, $class_button){
        $str = "";
        $str .= "<div class='modal fade' id='".$id_modal."' tabindex='-1'>
                <div class='modal-dialog modal-lg'>
                    <div class='modal-content'>
                            <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                <h4 class='modal-title' id='pdfjs_title'>Tampilkan Berkas</h4>
                            </div>
                        <div class='modal-body' id='show_pdfjs'>
                        </div>
                    </div>
                </div>
            </div>";

//        $str .= "<script src='".base_url()."sys-assets/plugins/pdfjs/pdfobject.min.js'></script>";
        $str .= "<script type='text/javascript'>
            $(document).ready(function () {
                $('.".$class_button."').on('click', function () {
                    $('#show_pdfjs').html();
                    $('#pdfjs_title').text($(this).data('pdf-title'));
                    var file = $(this).data('pdf');
                    //run callback
                    getFile(file, callback_);
                });
        
            });
            ".$this->funcjs."
        </script>";
        return $str;
    }
    function page($class_button){
        $str = "";
        $str .= "<div id='pdfjs_view' class='row m-t-1'>
                <div class='col-md-12'>
                    <div class='panel'>
                        <div class='panel-heading'>
                        <span class='panel-heading-title' id='pdfjs_title'><b>Tampilkan Berkas</b></span>
                        </div>
                        <div class='panel-body' id='show_pdfjs'>
                            
                        </div>
                    </div>
                </div>
            </div>";
        $str .= "<style>
            #show_pdfjs{
                height: 600px;
            }
        </style>";
        $str .= "<script src='".base_url()."sys-assets/plugins/pdfjs/pdfobject.min.js'></script>";
        $str .= "<script type='text/javascript'>
    $(document).ready(function () {
        $('#pdfjs_view').addClass('hidden');

        $('.".$class_button."').on('click', function () {
            $('#show_pdfjs').html();
            $('#pdfjs_view').removeClass('hidden');
            $('#pdfjs_title').text($(this).data('pdf-title'));
            var file = $(this).data('pdf');
            //run callback
            getFile(file, callback_);
            
        });
    });
    ".$this->funcjs."
</script>";
        return $str;
    }
}
