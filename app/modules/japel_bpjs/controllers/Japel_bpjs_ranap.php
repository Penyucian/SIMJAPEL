<?php

class Japel_bpjs_ranap extends SYS_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_japel_bpjs_ranap');
        $this->load->model('model_ref_clinic');
        $this->data['controller'] = 'japel_bpjs/japel_bpjs_ranap/';
        if (!empty($this->session->userdata('__user_tipe_nomor'))) {
            $this->load->model('model_doctor_ref');
            $this->data['dokter'] = $this->model_doctor_ref->get_row(['id' => $this->session->userdata('__user_tipe_nomor')])->row_array();
        }
    }

    public function index()
    {
        redirect($this->data['controller'] . 'view');
    }

    public function view()
    {
        $this->data['ref_clinic'] = $this->model_ref_clinic->get_row()->result_array();
        $this->template->load_view($this->data['controller'] . 'view', $this->data);
    }

    public function get_data()
    {
        $this->data['content'] = $this->model_japel_bpjs_ranap->get_data_ranap($this->data)->result_array();
        $this->load->view($this->data['controller'] . 'detail', $this->data);
    }
}
