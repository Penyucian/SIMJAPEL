<?php

class Ref_persen_japel extends SYS_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_ref_persen_japel');
        $this->data['controller'] = 'manajemen_data/ref_persen_japel/';
    }

    public function index()
    {
        redirect($this->data['controller'] . 'view');
    }

    public function view()
    {
        $this->template->load_view($this->data['controller'] . 'view', $this->data);
    }

    public function get_data()
    {
        echo $this->model_ref_persen_japel->get_data($this->data);
    }

    public function add($id = '')
    {
        $this->form_validation->set_rules('dt[saranaUmum]', 'Persen Sarana Umum', 'required|trim');
        $this->form_validation->set_rules('dt[pelayananUmum]', 'Persen pelayanan Umum', 'required|trim');
        $this->form_validation->set_rules('dt[saranaBPJS]', 'Persen Sarana BPJS', 'required|trim');
        $this->form_validation->set_rules('dt[pelayananBPJS]', 'Persen Pelayanan BPJS', 'required|trim');
        $this->form_validation->set_rules('dt[operasiUmum]', 'Persen Japel Operasi', 'required|trim');
        $this->form_validation->set_rules('dt[nonOperasiUmum]', 'Persen Japel Non Operasi', 'required|trim');
        $this->form_validation->set_rules('dt[operasiBPJS]', 'Persen Japel Operasi', 'required|trim');
        $this->form_validation->set_rules('dt[nonOperasiBPJS]', 'Persen Japel Non Operasi', 'required|trim');
        $this->form_validation->set_rules('dt[manajemen_umum]', 'Persen Japel Operasi', 'required|trim');
        $this->form_validation->set_rules('dt[manajemen_bpjs]', 'Persen Japel Non Operasi', 'required|trim');
        $this->form_validation->set_rules('dt[pointPTT]', 'Persen Japel Operasi', 'required|trim');
        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->form_validation->run($this) === TRUE) {
            $this->model_ref_persen_japel->dbSimrs->trans_begin();
            $data = $this->input->post();

            if ($id) {
                $type = 'Update ';
                $this->model_ref_persen_japel->update_data($data['dt'], ['id' => $this->encryption_lib->urldecode($id)]);
            } else {
                $type = 'Simpan ';
                $this->model_ref_persen_japel->insert_data($data['dt']);
            }
            if ($this->model_ref_persen_japel->dbSimrs->trans_status() === true) {
                $this->model_ref_persen_japel->dbSimrs->trans_commit();
                $this->ret_css_status = 'success';
                $this->ret_message = $type . 'Data Referensi Persen Japel berhasil';
                $this->ret_url = site_url($this->data['controller'] . 'view');
            } else {
                $this->model_ref_persen_japel->dbSimrs->trans_rollback();
                $this->ret_css_status = 'danger';
                $this->ret_message = $type . 'Data Referensi Persen Japel gagal';
                $this->ret_url = site_url($this->data['controller'] . 'add/' . $id);
            }
            echo json_encode(array('status' => $this->ret_css_status, 'msg' => $this->ret_message, 'url' => $this->ret_url, 'dest' => 'subcontent-element', 'is_modal' => 1));
        } else {
            if ($id) {
                $this->data['content'] = $this->model_ref_persen_japel->get_row(['id' => $this->encryption_lib->urldecode($id)])->row_array();
            }
            $this->data['url_action'] = $this->data['controller'] . 'add/' . $id;
            $this->load->view($this->data['controller'] . 'add', $this->data);
        }
    }
}
