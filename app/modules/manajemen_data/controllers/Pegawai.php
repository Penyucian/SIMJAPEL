<?php

class Pegawai extends SYS_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_pegawai');
        $this->load->model('model_ref_group');
        $this->load->model('model_ref_jabatan');
        $this->load->model('model_ref_education');
        $this->load->model('model_ref_resiko');
        $this->load->model('model_ref_tugas_tambahan');
        $this->data['controller'] = 'manajemen_data/pegawai/';
        $this->data['tingkat_resiko'] = [
            1 => 'Resiko I',
            2 => 'Resiko II',
            3 => 'Resiko III',
            4 => 'Resiko IV',
        ];
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
        $r = json_decode($this->model_pegawai->get_data($this->data));
        $dt = [];
        foreach ($r->data as $key => $val) {
            $dt[$key] = $val;
            $dt[$key]->tgl_masuk = !empty($val->tgl_masuk) ? date('d-m-Y', strtotime($val->tgl_masuk)) : '';
            $dt[$key]->name_resiko = !empty($val->name_resiko) ? '[' . $this->data['tingkat_resiko'][$val->tingkat_resiko] . '] ' . $val->name_resiko : '';
            $dt[$key]->japel = !empty($val->japel) ? rupiah($val->japel) : 0;
        }
        $r->data = $dt;
        echo json_encode($r);
    }

    public function delete($id)
    {
        $response = $this->model_pegawai->delete_data(['id' => $this->encryption_lib->urldecode($id)]);
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
        $this->form_validation->set_rules('dt[nip]', 'NIP', 'required|trim');
        $this->form_validation->set_rules('dt[name]', 'Nama Pegawai', 'required|trim');
        $this->form_validation->set_rules('dt[tgl_masuk]', 'Tanggal Masuk', 'required|trim');
        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->form_validation->run($this) === TRUE) {
            $this->model_pegawai->dbSimrs->trans_begin();
            $data = $this->input->post();
            $data['dt']['tgl_masuk'] = !empty($data['dt']['tgl_masuk']) ? $data['dt']['tgl_masuk'] : null;
            $data['dt']['jabatan_id'] = !empty($data['dt']['jabatan_id']) ? $data['dt']['jabatan_id'] : null;
            $data['dt']['education_id'] = !empty($data['dt']['education_id']) ? $data['dt']['education_id'] : null;
            $data['dt']['resiko_id'] = !empty($data['dt']['resiko_id']) ? $data['dt']['resiko_id'] : null;
            $data['dt']['tugas_tambahan_id'] = !empty($data['dt']['tugas_tambahan_id']) ? $data['dt']['tugas_tambahan_id'] : null;
            $data['dt']['japel'] = !empty($data['dt']['japel']) ? str_replace('.', '', $data['dt']['japel']) : null;

            if ($id) {
                $type = 'Update ';
                $this->model_pegawai->update_data($data['dt'], ['id' => $this->encryption_lib->urldecode($id)]);
            } else {
                $type = 'Simpan ';
                $this->model_pegawai->insert_data($data['dt']);
            }
            if ($this->model_pegawai->dbSimrs->trans_status() === true) {
                $this->model_pegawai->dbSimrs->trans_commit();
                $this->ret_css_status = 'success';
                $this->ret_message = $type . 'Data Pegawai berhasil';
                $this->ret_url = site_url($this->data['controller'] . 'view');
            } else {
                $this->model_pegawai->dbSimrs->trans_rollback();
                $this->ret_css_status = 'danger';
                $this->ret_message = $type . 'Data Pegawai gagal';
                $this->ret_url = site_url($this->data['controller'] . 'add/' . $id);
            }
            echo json_encode(array('status' => $this->ret_css_status, 'msg' => $this->ret_message, 'url' => $this->ret_url, 'dest' => 'subcontent-element', 'is_modal' => 1));
        } else {
            if ($id) {
                $this->data['content'] = $this->model_pegawai->get_row(['a.id' => $this->encryption_lib->urldecode($id)])->row_array();
            }
            $this->data['ref_group'] = $this->model_ref_group->get_row()->result_array();
            $this->data['ref_jabatan'] = $this->model_ref_jabatan->get_row()->result_array();
            $this->data['ref_education'] = $this->model_ref_education->get_row()->result_array();
            $this->data['ref_resiko'] = $this->model_ref_resiko->get_row()->result_array();
            $this->data['ref_tugas_tambahan'] = $this->model_ref_tugas_tambahan->get_row()->result_array();
            $this->data['url_action'] = $this->data['controller'] . 'add/' . $id;
            $this->load->view($this->data['controller'] . 'add', $this->data);
        }
    }
}
