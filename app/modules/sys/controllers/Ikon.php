<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ikon extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('sys/response');
        $this->load->model('model_ikon');
    }

    public function index() {
        redirect('sys/ikon/view_ikon');
    }

    public function view_ikon() {
        $data['kategoriIkon'] = $this->model_ikon->select_kategori_ikon();
        $data['listIkon'] = $this->model_ikon->select_ikon();
        $this->load->view('daftar_ikon', $data);
    }

    public function set_ikon($cssIkon) {
        $cssIkon = urldecode($cssIkon);
        $this->response->script("
            $('input[name=\"ikon\"]').val('$cssIkon');
            $('#icon').removeAttr('class');                  
            $('#icon').attr('class','fa $cssIkon');
            $('.modal').last().modal('hide');   
        ");

        $this->response->send();
    }

}
