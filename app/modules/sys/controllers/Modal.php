<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Modal extends SYS_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('sys/response');
    }

    public function set_modal($title, $modul, $controller, $function, $prm1 = null, $prm2 = null, $prm3 = null, $prm4 = null, $prm5 = null)
    {
        $this->session->set_userdata('_controller', $controller);

        $title = str_replace('%20', ' ', $title);
        $this->response->dialog(array(
            'title' => urldecode($title),
            'body' => Modules::run($modul . '/' . $controller . '/' . $function, $prm1, $prm2, $prm3, $prm4, $prm5)
            //        ,'buttons' => array('ok' => 'Close')
        ));

        $this->response->send();
    }

    public function set_modal_full($title, $modul, $controller, $function, $prm1 = null, $prm2 = null, $prm3 = null, $prm4 = null, $prm5 = null)
    {
        $title = str_replace('%20', ' ', $title);
        $this->response->dialog_full(array(
            'title' => $title, 'body' => Modules::run($modul . '/' . $controller . '/' . $function, $prm1, $prm2, $prm3, $prm4, $prm5)
            //            ,'buttons'	=> array('ok' => 'Close')
        ));

        $this->response->send();
    }

    public function mod()
    {
        $this->template->load_view('modal/view_modal');
    }
}

/* End of file Modal.php */
/* Location: ./modules/modal/modal.php */
