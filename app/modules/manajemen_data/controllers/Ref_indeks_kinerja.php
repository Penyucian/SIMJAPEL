<?php

class Ref_indeks_kinerja extends SYS_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_ref_indeks_kinerja');
        $this->data['controller'] = 'manajemen_data/ref_indeks_kinerja/';
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
        echo $this->model_ref_indeks_kinerja->get_data($this->data);
    }

    public function delete($id)
    {
        $response = $this->model_ref_indeks_kinerja->delete_data(['id' => $this->encryption_lib->urldecode($id)]);
        if ($response) {
            $this->ret_css_status = true;
            $this->ret_message = 'Hapus data berhasil';
        } else {
            $this->ret_css_status = false;
            $this->ret_message = 'Hapus data gagal';
        }
        $this->ret_url = site_url($this->data['controller'] . 'view');
        echo json_encode(array('status' => $this->ret_css_status, 'msg' => $this->ret_message, 'url' => $this->ret_url));
    }

    public function add($id = '')
    {
        $this->form_validation->set_rules('dt[name]', 'Indeks Kinerja', 'required|trim');
        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->form_validation->run($this) === TRUE) {
            $this->model_ref_indeks_kinerja->dbSimrs->trans_begin();
            $data = $this->input->post();

            if ($id) {
                $type = 'Update ';
                $this->model_ref_indeks_kinerja->update_data($data['dt'], ['id' => $this->encryption_lib->urldecode($id)]);
            } else {
                $type = 'Simpan ';
                $this->model_ref_indeks_kinerja->insert_data($data['dt']);
            }
            if ($this->model_ref_indeks_kinerja->dbSimrs->trans_status() === true) {
                $this->model_ref_indeks_kinerja->dbSimrs->trans_commit();
                $this->ret_css_status = 'success';
                $this->ret_message = $type . 'Data Referensi Indeks Kinerja berhasil';
                $this->ret_url = site_url($this->data['controller'] . 'view');
            } else {
                $this->model_ref_indeks_kinerja->dbSimrs->trans_rollback();
                $this->ret_css_status = 'danger';
                $this->ret_message = $type . 'Data Referensi Indeks Kinerja gagal';
                $this->ret_url = site_url($this->data['controller'] . 'add/' . $id);
            }
            echo json_encode(array('status' => $this->ret_css_status, 'msg' => $this->ret_message, 'url' => $this->ret_url, 'dest' => 'subcontent-element', 'is_modal' => 1));
        } else {
            if ($id) {
                $this->data['content'] = $this->model_ref_indeks_kinerja->get_row(['id' => $this->encryption_lib->urldecode($id)])->row_array();
            }
            $this->data['url_action'] = $this->data['controller'] . 'add/' . $id;
            $this->load->view($this->data['controller'] . 'add', $this->data);
        }
    }
}