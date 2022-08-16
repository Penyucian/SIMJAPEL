<?php
class Japel_list extends SYS_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_japel_hitung');
        $this->load->model('manajemen_data/model_pegawai');
        $this->data['controller'] = 'japel_hitung/japel_list/';
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
        $param = $this->input->post();
        $this->data['content'] = $this->model_japel_hitung->get_periode_japel($param)->result_array();
        $this->load->view($this->data['controller'] . 'detail', $this->data);
    }

    public function delete($id)
    {
        $this->model_japel_hitung->dbSimrs->trans_begin();
        $this->model_japel_hitung->delete_employee_japel(['periode_japel_id' => $this->encryption_lib->urldecode($id)]);
        $this->model_japel_hitung->delete_periode_japel(['id' => $this->encryption_lib->urldecode($id)]);
        if ($this->model_japel_hitung->dbSimrs->trans_status() === true) {
            $this->model_japel_hitung->dbSimrs->trans_commit();
            $this->ret_css_status = 'success';
            $this->ret_message = 'Hapus data berhasil';
        } else {
            $this->model_japel_hitung->dbSimrs->trans_rollback();
            $this->ret_css_status = 'danger';
            $this->ret_message = 'Hapus data gagal';
        }
        $this->ret_url = site_url($this->data['controller'] . 'view');
        echo json_encode(array('status' => $this->ret_css_status, 'msg' => $this->ret_message, 'url' => $this->ret_url));
    }
}
