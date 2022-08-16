<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Change_password extends MY_Controller {

    private $ret_css_status;
    private $ret_message;
    private $ret_url;

    public function __construct() {
        parent::__construct();
        $this->load->model('model_change_password');
    }

    public function index() {
        redirect('sys/change_password/update_change_password');
    }

    public function update_change_password() {
        if ($this->model_change_password->check_is_sso($this->user_id) === 1 or $this->config->item('method_login') == 'cas') {
            $this->template->load_view('ubah_change_password_sso');
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('passwordLama', 'password lama', 'trim|callback_password_check');
            $this->form_validation->set_rules('passwordBaru', 'password baru', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('passwordBaruConfirm', 'konfirmasi password baru', 'trim|required|matches[passwordBaru]');

            $this->form_validation->set_message('required', 'Field %s tidak boleh kosong.');
            $this->form_validation->set_message('matches', 'Field konfirmasi password baru tidak sama dengan password baru.');
            $this->form_validation->set_message('min_length', 'Field %s minimal 6 karakter.');

            if ($this->form_validation->run($this) == FALSE) {
                $this->template->load_view('ubah_change_password');
            } else {
                $this->update_change_password_proses();
            }
        }
    }

    public function update_change_password_proses() {
        $passwordBaru = $this->input->post('passwordBaru');
        $passwordEncrypt = $this->user_auth_lib->pwd_encrypt($passwordBaru);

        $data = array(
            'user_password' => $passwordEncrypt
        );

        $dataUser = $this->update_data_user_information($data);

        $exec = $this->model_change_password->update_change_password($dataUser, $this->user_id);

        if ($exec) {
            $this->ret_css_status = 'success';
            $this->ret_message = 'Ubah password berhasil';
        } else {
            $this->ret_css_status = 'danger';
            $this->ret_message = 'Ubah password gagal';
        }

        $this->ret_url = site_url('sys/change_password/update_change_password');
        echo json_encode(array('status' => $this->ret_css_status, 'msg' => $this->ret_message, 'url' => $this->ret_url));
    }

    public function password_check($password) {
        if (empty($password)) {
            $this->form_validation->set_message('password_check', 'Field %s tidak boleh kosong');
            return FALSE;
        } elseif (!empty($password)) {
            $getPassword = $this->model_change_password->select_user_password_by_id($this->user_id);
            $passwordEncryptCurrentPassword = $getPassword->user_password;

            $passwordEncryptPost = $this->user_auth_lib->pwd_encrypt($password);
            if ($passwordEncryptCurrentPassword == $passwordEncryptPost) {
                return TRUE;
            } else {
                $this->form_validation->set_message('password_check', 'Password lama salah, silahkan coba lagi.');
                return FALSE;
            }
        }
    }

    public function insert_data_user_information($array) {
        $insertInformation = array(
            'created_by' => $this->user_id,
            'created_time' => $this->date_today,
            'updated_by' => $this->user_id,
            'updated_time' => $this->date_today
        );

        return array_merge($array, $insertInformation);
    }

    public function update_data_user_information($array) {
        $updateInformation = array(
            'updated_by' => $this->user_id,
            'updated_time' => $this->date_today
        );

        return array_merge($array, $updateInformation);
    }

}

/* End of file change_password.php */
/* Location: ./dash-app/modules/change_password/controllers/change_password.php */
