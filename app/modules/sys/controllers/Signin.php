<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Signin extends MY_Controller
{
    private $sesId;
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->user_auth_lib->is_login()) {
            $this->user_auth_lib->restrict();
        } else {
            $this->signin_proses();
        }
    }

    public function signout_proses($platform = 'browser')
    {
        if ($platform === 'app') {
            $_ = site_url('sys/signin/signin_proses?aId=' . $this->input->get('aId'));
        } else {
            $_ = base_url();
        }

        if ($this->config->item('method_login') === 'cas' || $this->config->item('method_login') === 'hybrid') {
            $this->load->library('sys/cas');

            if ($this->cas->is_authenticated()) {
                $this->cas->logout($_);
            }
        }

        $this->session->sess_destroy();
        redirect($_);
    }

    public function signin_proses($method_login = '')
    {
        if ($this->config->item('method_login') === 'cas' || $method_login === 'cas') {
            $this->cas_login();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Username', 'trim|required|strip_tags');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('captcha', 'Captcha', 'required|callback_basic_login');

            $this->form_validation->set_message('required', 'Field %s tidak boleh kosong.');

            if ($this->form_validation->run($this) === TRUE && $this->input->get('aId') && $this->session->userdata('__platform') === 'app' && $this->sesId !== 0) {
                $img = ($this->session->userdata('__img')) ?
                    $this->config->item('upload_simaster_user') . $this->session->userdata('__img') :
                    realpath('./sys-assets/images/user-icon.png');
                redirect(site_url('sys/service/landing?sesId=' . $this->encryption_lib->urlencode($this->sesId) .
                    '&namaLengkap=' . $this->session->userdata('__nama_lengkap') .
                    '&groupMenuNama=' . $this->session->userdata('__group_menu_nama') .
                    '&userTipeNomor=' . $this->session->userdata('__user_tipe_nomor') .
                    '&img=' . ($this->session->userdata('__img') ? $this->encryption_lib->urlencode($this->session->userdata('__img')) : '') .
                    '&groupMenu=' . $this->encryption_lib->urlencode($this->session->userdata('__group_menu_id'))));
            } else if ($this->form_validation->run($this) === TRUE) {
                    redirect();
            } else {
                $data['image'] = $this->captcha();
                $data['form_action'] = site_url('sys/signin/signin_proses' . (($this->input->get('aId')) ? '?aId=' . $this->input->get('aId') : ''));
                $data['cas_action'] = site_url('sys/signin/signin_proses/cas' . (($this->input->get('aId')) ? '?aId=' . $this->input->get('aId') : ''));
                $this->load->view('signin/view_signin', $data);
            }
        }
    }

    private function captcha()
    {
        $this->load->helper('captcha');

        $vals = array(
            'word' => rand(00, 9999),
            'img_path' => './sys-captcha/',
            'img_url' => base_url() . 'sys-captcha/',
            'img_width' => 220,
            'img_height' => 37,
            'border' => 0,
            'expiration' => 600
        );

        $cap = create_captcha($vals);

        $this->session->set_flashdata('mycaptcha', $cap['word']);
        return $cap['image'];
    }

    public function reload_captcha()
    {
        echo $this->captcha();
    }

    public function basic_login()
    {
        $this->load->library('form_validation');

        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        $captcha = $this->input->post('captcha', TRUE);

        if ($captcha === $this->session->flashdata('mycaptcha')) {
            $checkLogin = $this->user_auth_lib->do_login(array(
                'username' => $username, 'password' => $password,
                'date_today' => $this->date_today,
                'device_id' => $this->input->get('aId')
            ), $this->config->item('method_login'));

            $this->sesId = $checkLogin['sesId'];

            if ($checkLogin['resId'] === 2 || $checkLogin['sesId'] === 0) {
                $this->form_validation->set_message('basic_login', 'Mohon maaf, akun yang Anda gunakan tidak aktif.');
                return FALSE;
            } elseif ($checkLogin['resId'] === 1) {
                return TRUE;
            } else {
                $this->form_validation->set_message('basic_login', 'Mohon maaf, username atau password salah.');
                return FALSE;
            }
        } else {
            if (!empty($captcha)) {
                $this->form_validation->set_message('basic_login', 'Mohon maaf, captcha salah.');
                return FALSE;
            }
        }
    }
}
