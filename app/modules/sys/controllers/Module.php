<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Module extends SYS_Controller
{
    private $ret_css_status;
    private $ret_message;
    private $ret_url;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('sys/response');
        $this->load->model('model_module');
    }

    public function index()
    {
        redirect('sys/module/view_module');
    }

    public function view_module($offset = 0, $param = null)
    {
        $this->load->library('sys/jquery_pagination');

        $config['base_url'] = site_url('sys/module/view_module');
        $config['per_page'] = 10;
        $config['url_location'] = 'subcontent-element';
        $config['full_tag_open'] = '<ul class="pagination paging urlactive">';
        $config['uri_segment'] = 4;

        $filterCari = $this->input->post('namaModule', TRUE);
        $paramFilter = urldecode($filterCari ? $filterCari : $param);

        $config['base_filter'] = '/' . $paramFilter;
        $config['total_rows'] = $this->model_module->num_rows_select_module($paramFilter);
        $this->jquery_pagination->initialize($config);

        $data['halaman'] = $this->jquery_pagination->create_links();
        $data['content'] = $this->model_module->select_module($config['per_page'], $offset, $paramFilter);
        $data['offset'] = $offset;

        $this->template->load_view('view_module', $data);
    }

    public function view_controller($offset = 0, $paramModuleId)
    {
        $this->load->library('sys/jquery_pagination');

        $config['base_url'] = site_url('sys/module/view_controller');
        $config['per_page'] = 10;
        $config['url_location'] = 'modal-data-basic';
        $config['uri_segment'] = 4;

        $config['base_filter'] = '/' . $paramModuleId;
        $config['total_rows'] = $this->model_module->num_rows_select_controller($paramModuleId);

        $this->jquery_pagination->initialize($config);

        $data['halaman'] = $this->jquery_pagination->create_links();
        $data['content'] = $this->model_module->select_controller($config['per_page'], $offset, $paramModuleId);
        $data['offset'] = $offset;
        $data['objModule'] = $this->model_module->select_module_by_id($paramModuleId);

        $this->load->view('view_controller', $data);
    }

    public function view_function($offset = 0, $paramControllerId)
    {
        $this->load->library('sys/jquery_pagination');

        $config['base_url'] = site_url('sys/module/view_function');
        $config['per_page'] = 10;
        $config['url_location'] = 'modal-data-basic';
        $config['uri_segment'] = 4;

        $config['base_filter'] = '/' . $paramControllerId;
        $config['total_rows'] = $this->model_module->num_rows_select_function($paramControllerId);

        $this->jquery_pagination->initialize($config);

        $data['halaman'] = $this->jquery_pagination->create_links();
        $data['content'] = $this->model_module->select_function($config['per_page'], $offset, $paramControllerId);
        $data['offset'] = $offset;
        $data['objController'] = $this->model_module->select_controller_by_id($paramControllerId);

        $this->load->view('view_function', $data);
    }

    public function add_module()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->input->post();
        } else {
            $data = array();
        }
        $this->template->load_view('tambah_module', $data);
    }

    public function add_module_proses()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('namaModule', 'Nama Module', 'callback_validasi_nama_module');

        if ($this->form_validation->run($this) == FALSE) {
            $this->add_module();
        } else {
            $namaModule = str_replace(' ', '_', strtolower(trim($this->input->post('namaModule'))));
            $data = array(
                'module_nama' => $namaModule, 'created_by' => $this->user_id, 'created_time' => $this->date_today, 'updated_by' => $this->user_id, 'updated_time' => $this->date_today
            );

            $rs = $this->model_module->insert_module($data);

            if ($rs) {
                $this->ret_css_status = 'success';
                $this->ret_message = 'Tambah data berhasil';
            } else {
                $this->ret_css_status = 'danger';
                $this->ret_message = 'Tambah data gagal';
            }

            $this->ret_url = site_url('sys/module/view_module');

            echo json_encode(array('status' => $this->ret_css_status, 'msg' => $this->ret_message, 'url' => $this->ret_url, 'dest' => 'subcontent-element'));
        }
    }

    public function validasi_nama_module()
    {
        $namaModule = $this->input->post('namaModule');
        if ($namaModule) {
            $checkModule = $this->model_module->select_module_by_namaModule($namaModule);
            if ($checkModule) {
                $this->form_validation->set_message('validasi_nama_module', 'Nama module sudah digunakan');
                return false;
            }
        } else {
            $this->form_validation->set_message('validasi_nama_module', 'Bidang ini harus diisi !');
            return false;
        }
        return true;
    }

    public function add_controller($moduleId)
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->input->post();
        } else {
            $data['moduleId'] = $moduleId;
        }
        $this->load->view('tambah_controller', $data);
    }

    public function add_controller_proses()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('namaController', 'Nama Controller', 'callback_validasi_nama_controller');

        $moduleId = $this->input->post('moduleId');
        if ($this->form_validation->run($this) == FALSE) {
            $this->add_controller($moduleId);
        } else {
            $namaController = str_replace(' ', '_', strtolower(trim($this->input->post('namaController'))));
            $data = array(
                'module_id' => $moduleId, 'controller_nama' => $namaController, 'created_by' => $this->user_id, 'created_time' => $this->date_today, 'updated_by' => $this->user_id, 'updated_time' => $this->date_today
            );

            $rs = $this->model_module->insert_controller($data);

            if ($rs) {
                $this->ret_url = site_url('sys/module/view_controller/0/' . $moduleId);
                $this->ret_css_status = 'success';
                $this->ret_message = 'Tambah data berhasil';
            } else {
                $this->ret_url = site_url('sys/module/add_controller/' . $moduleId);
                $this->ret_css_status = 'danger';
                $this->ret_message = 'Tambah data gagal';
            }
            echo json_encode(array('status' => $this->ret_css_status, 'msg' => $this->ret_message, 'url' => $this->ret_url));
        }
    }

    public function validasi_nama_controller()
    {
        $namaController = $this->input->post('namaController');
        $moduleId = $this->input->post('moduleId');
        if ($namaController) {
            $checkController = $this->model_module->select_controller_by_namaController_moduleId($namaController, $moduleId);
            if ($checkController) {
                $this->form_validation->set_message('validasi_nama_controller', 'Nama controller sudah digunakan');
                return false;
            }
        } else {
            $this->form_validation->set_message('validasi_nama_controller', 'Nama controller harus diisi !');
            return false;
        }
        return true;
    }

    public function add_function($controllerId)
    {
        $data['controllerId'] = $controllerId;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = array_merge($data, $this->input->post());
        }
        $this->load->view('tambah_function', $data);
    }

    public function add_function_proses()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('namaFunction', 'Nama Function', 'callback_validasi_nama_function');
        $this->form_validation->set_rules('permission[]', 'Permission', 'required');

        $controllerId = $this->input->post('controllerId');
        if ($this->form_validation->run($this) == FALSE) {
            $this->add_function($controllerId);
        } else {
            extract($this->input->post());
            $namaFunction = str_replace(' ', '_', strtolower(trim($namaFunction)));
            $objController = $this->model_module->select_controller_by_id($controllerId);
            $permission = (isset($permission['create']) ? $permission['create'] : 'x')
                . (isset($permission['read']) ? $permission['read'] : 'x')
                . (isset($permission['update']) ? $permission['update'] : 'x')
                . (isset($permission['delete']) ? $permission['delete'] : 'x');

            $data = array(
                'module_id' => $objController['module_id'], 'controller_id' => $controllerId, 'module_detail_function' => $namaFunction, 'module_detail_title' => ($title ? $title : NULL), 'module_detail_page_css_clip' => ($ikon ? $ikon : NULL), 'module_detail_page_title' => ($pageTitle ? $pageTitle : NULL), 'module_detail_permissions' => strtolower($permission), 'created_by' => $this->user_id, 'created_time' => $this->date_today, 'updated_by' => $this->user_id, 'updated_time' => $this->date_today
            );

            $rs = $this->model_module->insert_function($data);

            if ($rs) {
                $this->ret_url = site_url('sys/module/view_function/0/' . $controllerId);
                $this->ret_css_status = 'success';
                $this->ret_message = 'Tambah data berhasil';
            } else {
                $this->ret_url = site_url('sys/module/add_function/' . $controllerId);
                $this->ret_css_status = 'danger';
                $this->ret_message = 'Tambah data gagal';
            }
            echo json_encode(array('status' => $this->ret_css_status, 'msg' => $this->ret_message, 'url' => $this->ret_url));
        }
    }

    public function validasi_nama_function()
    {
        $namaFunction = $this->input->post('namaFunction');
        $controllerId = $this->input->post('controllerId');

        if ($namaFunction) {
            $checkFunction = $this->model_module->select_function_by_namaFunction_controllerId($namaFunction, $controllerId);
            if ($checkFunction) {
                $this->form_validation->set_message('validasi_nama_function', 'Nama function sudah digunakan');
                return false;
            }
        } else {
            $this->form_validation->set_message('validasi_nama_function', 'Nama function harus diisi !');
            return false;
        }
        return true;
    }

    public function update_module($id = null)
    {
        $data['objModule'] = $this->model_module->select_module_by_id($id);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = array_merge($data, $this->input->post());
        }
        $this->template->load_view('ubah_module', $data);
    }

    public function update_module_proses()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('namaModule', 'Nama Module', 'callback_validasi_nama_module_update');

        $moduleId = $this->input->post('moduleId');
        if ($this->form_validation->run($this) == FALSE) {
            $this->update_module($moduleId);
        } else {
            $namaModule = str_replace(' ', '_', strtolower(trim($this->input->post('namaModule'))));
            $data = array(
                'module_nama' => $namaModule, 'updated_by' => $this->user_id, 'updated_time' => $this->date_today
            );

            $rs = $this->model_module->update_module($moduleId, $data);

            if ($rs) {
                $this->ret_css_status = 'success';
                $this->ret_message = 'Ubah data berhasil';
            } else {
                $this->ret_css_status = 'danger';
                $this->ret_message = 'Ubah data gagal';
            }

            $this->ret_url = site_url('sys/module/view_module');

            echo json_encode(array('status' => $this->ret_css_status, 'msg' => $this->ret_message, 'url' => $this->ret_url, 'dest' => 'subcontent-element'));
        }
    }

    public function validasi_nama_module_update()
    {
        $namaModule = $this->input->post('namaModule');
        $moduleId = $this->input->post('moduleId');

        if ($namaModule) {
            $checkModule = $this->model_module->select_module_by_namaModule($namaModule);
            if ($checkModule) {
                if ($checkModule['module_id'] != $moduleId) {
                    $this->form_validation->set_message('validasi_nama_module_update', 'Nama module sudah digunakan');
                    return false;
                }
            }
        } else {
            $this->form_validation->set_message('validasi_nama_module_update', 'Bidang ini harus diisi !');
            return false;
        }
        return true;
    }

    public function update_controller($id = null)
    {
        $data['objController'] = $this->model_module->select_controller_by_id($id);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = array_merge($data, $this->input->post());
        }
        $this->load->view('ubah_controller', $data);
    }

    public function update_controller_proses()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('namaController', 'Nama Controller', 'callback_validasi_nama_controller_update');

        $controllerId = $this->input->post('controllerId');
        if ($this->form_validation->run($this) == FALSE) {
            $this->update_controller($controllerId);
        } else {
            $namaController = str_replace(' ', '_', strtolower(trim($this->input->post('namaController'))));
            $data = array(
                'controller_nama' => $namaController, 'updated_by' => $this->user_id, 'updated_time' => $this->date_today
            );

            $rs = $this->model_module->update_controller($controllerId, $data);

            if ($rs) {
                $objController = $this->model_module->select_controller_by_id($controllerId);
                $this->ret_url = site_url('sys/module/view_controller/0/' . $objController['module_id']);
                $this->ret_css_status = 'success';
                $this->ret_message = 'Ubah data berhasil';
            } else {
                $this->ret_url = site_url('sys/module/update_controller/' . $controllerId);
                $this->ret_css_status = 'danger';
                $this->ret_message = 'Ubah data gagal';
            }
            echo json_encode(array('status' => $this->ret_css_status, 'msg' => $this->ret_message, 'url' => $this->ret_url));
        }
    }

    public function validasi_nama_controller_update()
    {
        extract($this->input->post());
        $objController = $this->model_module->select_controller_by_id($controllerId);

        if ($namaController) {
            $checkController = $this->model_module->select_controller_by_namaController_moduleId($namaController, $objController['module_id']);
            if ($checkController) {
                if ($checkController['controller_id'] != $controllerId) {
                    $this->form_validation->set_message('validasi_nama_controller_update', 'Nama controller sudah digunakan');
                    return false;
                }
            }
        } else {
            $this->form_validation->set_message('validasi_nama_controller_update', 'Nama controller harus diisi !');
            return false;
        }

        return true;
    }

    public function update_function($id = null)
    {
        $data['objFunction'] = $this->model_module->select_function_by_id($id);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = array_merge($data, $this->input->post());
        }
        $this->load->view('ubah_function', $data);
    }

    public function update_function_proses()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('namaFunction', 'Nama Function', 'callback_validasi_nama_function_update');
        $this->form_validation->set_rules('permission[]', 'Permission', 'required');

        extract($this->input->post());
        $objFunction = $this->model_module->select_function_by_id($functionId);

        if ($this->form_validation->run($this) == FALSE) {
            $this->update_function($functionId);
        } else {
            $namaFunction = str_replace(' ', '_', strtolower(trim($namaFunction)));
            $permission = (isset($permission['create']) ? $permission['create'] : 'x')
                . (isset($permission['read']) ? $permission['read'] : 'x')
                . (isset($permission['update']) ? $permission['update'] : 'x')
                . (isset($permission['delete']) ? $permission['delete'] : 'x');

            $data = array(
                'module_detail_function' => $namaFunction, 'module_detail_title' => ($title ? $title : NULL), 'module_detail_page_css_clip' => ($ikon ? $ikon : NULL), 'module_detail_page_title' => ($pageTitle ? $pageTitle : NULL), 'module_detail_permissions' => strtolower($permission), 'updated_by' => $this->user_id, 'updated_time' => $this->date_today
            );

            $rs = $this->model_module->update_function($functionId, $data);

            if ($rs) {
                $this->ret_url = site_url('sys/module/view_function/0/' . $objFunction['controller_id']);
                $this->ret_css_status = 'success';
                $this->ret_message = 'Ubah data berhasil';
            } else {
                $this->ret_url = site_url('sys/module/add_function/' . $objFunction['controller_id']);
                $this->ret_css_status = 'danger';
                $this->ret_message = 'Ubah data gagal';
            }
            echo json_encode(array('status' => $this->ret_css_status, 'msg' => $this->ret_message, 'url' => $this->ret_url));
        }
    }

    public function validasi_nama_function_update()
    {
        extract($this->input->post());
        $objFunction = $this->model_module->select_function_by_id($functionId);

        if ($namaFunction) {
            $checkFunction = $this->model_module->select_function_by_namaFunction_controllerId($namaFunction, $objFunction['controller_id']);
            if ($checkFunction) {
                if ($checkFunction['module_detail_id'] != $functionId) {
                    $this->form_validation->set_message('validasi_nama_function_update', 'Nama function sudah digunakan');
                    return false;
                }
            }
        } else {
            $this->form_validation->set_message('validasi_nama_function_update', 'Nama function harus diisi !');
            return false;
        }

        return true;
    }

    public function delete_module($id = null)
    {
        $rs = $this->model_module->delete_module($id);

        if ($rs) {
            $this->ret_css_status = 'success';
            $this->ret_message = 'Hapus data berhasil';
        } else {
            $this->ret_css_status = 'danger';
            $this->ret_message = 'Hapus data gagal';
        }

        $this->ret_url = site_url('sys/module/view_module');
        echo json_encode(array('status' => $this->ret_css_status, 'msg' => $this->ret_message, 'url' => $this->ret_url));
    }

    public function delete_controller($id = null)
    {
        $objController = $this->model_module->select_controller_by_id($id);
        $rs = $this->model_module->delete_controller($id);

        if ($rs) {
            $this->ret_css_status = 'success';
            $this->ret_message = 'Hapus data berhasil';
        } else {
            $this->ret_css_status = 'danger';
            $this->ret_message = 'Hapus data gagal';
        }

        $this->ret_url = site_url('sys/module/view_controller/0/' . $objController['module_id']);
        echo json_encode(array('status' => $this->ret_css_status, 'msg' => $this->ret_message, 'url' => $this->ret_url));
    }

    public function delete_function($id = null)
    {
        $objFunction = $this->model_module->select_function_by_id($id);
        $rs = $this->model_module->delete_function($id);

        if ($rs) {
            $this->ret_css_status = 'success';
            $this->ret_message = 'Hapus data berhasil';
        } else {
            $this->ret_css_status = 'danger';
            $this->ret_message = 'Hapus data gagal';
        }

        $this->ret_url = site_url('sys/module/view_function/0/' . $objFunction['controller_id']);
        echo json_encode(array('status' => $this->ret_css_status, 'msg' => $this->ret_message, 'url' => $this->ret_url));
    }
}

/* End of file sys.php */
/* Location: ./sys-app/modules/sys/controllers/Module.php */
