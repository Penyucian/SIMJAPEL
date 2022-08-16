<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * @author  : Hanif Burhanudin <dev.jogja@gmail.com>
 */
class Ref extends MY_Controller
{
    private $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_doctor_ref');
    }

    public function get_doctor()
    {
        $this->data['q'] = $_GET['q'];
        $dt = $this->model_doctor_ref->get_row($this->data)->result_array();
        echo json_encode($dt);
    }
}
