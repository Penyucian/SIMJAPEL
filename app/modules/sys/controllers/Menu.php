<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends SYS_Controller {

    private $ret_css_status;
    private $ret_message;
    private $ret_url;

    public function __construct() {
        parent::__construct();
        $this->load->library('sys/response');
        $this->load->model('model_menu');
    }

    public function index() {
        redirect('sys/menu/view_menu');
    }
    
    public function view_menu() { 
        $data['listMenu'] = $this->model_menu->select_menu();       
        $this->template->load_view('view_menu',$data);
    }

    public function get_controller_by_moduleId($moduleId=0){
        $view = "<option></option>";
        
        if($moduleId) {
            $listController = $this->model_menu->select_controller_by_moduleId($moduleId);
            if ($listController) {            
                foreach($listController as $objController){
                    $view .= "<option value='$objController[controller_id]'>$objController[controller_nama]</option>";
                }    
            }
        }
        
        echo $view;
    }

    public function get_function_by_controllerId($controllerId=0){
        $view = "<option></option>";
        
        if($controllerId) {
            $listFunction = $this->model_menu->select_function_by_controllerId($controllerId);
            if ($listFunction) {            
                foreach($listFunction as $objFunction){
                    $view .= "<option value='$objFunction[module_detail_id]'>$objFunction[module_detail_function]</option>";
                }    
            }
        }
        
        echo $view;
    }    

    public function add_menu() {
        
        $data['listMenuInduk'] = $this->model_menu->get_menu_induk();
        $data['listModule'] = $this->model_menu->select_module();

        if($this->input->server('REQUEST_METHOD') == 'POST'){
            extract($this->input->post());
            $data['listController'] = $this->model_menu->select_controller_by_moduleId($moduleId);
            $data['listFunction'] = $this->model_menu->select_function_by_controllerId($controllerId);
            $data = array_merge($data,$this->input->post());
        }

        $this->template->load_view('tambah_menu',$data);
    }

    public function add_menu_proses() {  
        
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('namaMenu','Nama Menu','callback_validasi_nama_menu');
        $this->form_validation->set_rules('controllerId','Target Controller','callback_validasi_input_controller');
        $this->form_validation->set_rules('tipeLabel','Tipe Label','callback_validasi_tipe_label');        

        if($this->form_validation->run($this) == FALSE){
            $this->add_menu(); 
        } else {
            extract($this->input->post());
            $data = array(
                        'menu_parent_id' => $menuIndukId
                        ,'menu_nama' => $namaMenu
                        ,'menu_sequence' => $this->model_menu->get_last_sequence_id_by_parentId($menuIndukId) + 1
                        ,'module_detail_id' => ($functionId ? $functionId : NULL)
                        ,'module_id' => ($moduleId ? $moduleId : NULL)
                        ,'controller_id' => ($controllerId ? $controllerId : NULL)
                        ,'menu_css_clip' => ($ikon ? $ikon : NULL)
                        ,'menu_label' => ($namaLabel ? $namaLabel : NULL)
                        ,'menu_css_label' => ($namaLabel ? $tipeLabel : NULL)
                        ,'menu_is_aktif'=>($is_aktif)
                        ,'created_by' => $this->user_id
                        ,'created_time' => $this->date_today
                        ,'updated_by' => $this->user_id
                        ,'updated_time' => $this->date_today
                    );

            $rs = $this->model_menu->insert_menu($data);
           
            if ($rs){
                $this->ret_css_status = 'success';
                $this->ret_message = 'Tambah data berhasil';
            } else {
                $this->ret_css_status = 'danger';
                $this->ret_message = 'Tambah data gagal';
            }

            $this->ret_url = site_url('sys/menu/view_menu');

            echo json_encode(array('status'=>$this->ret_css_status,'msg'=>$this->ret_message,'url'=>$this->ret_url,'dest'=>'subcontent-element'));
        }        
    }

    public function validasi_nama_menu(){
        $namaMenu = $this->input->post('namaMenu');
        if ($namaMenu){
            $checkMenu = $this->model_menu->select_menu_by_namaMenu($namaMenu);
            if ($checkMenu){
                $this->form_validation->set_message('validasi_nama_menu','Nama menu sudah digunakan');
                return false;
            }
        } else {
            $this->form_validation->set_message('validasi_nama_menu','Bidang ini harus diisi !');
            return false;
        }
        return true;
    }

    public function validasi_nama_menu_update(){
        $namaMenu = $this->input->post('namaMenu');
        $menuId = $this->input->post('menuId');
        $objMenu = $this->model_menu->select_menu_by_id($menuId);

        if ($namaMenu != $objMenu['menu_nama']){
            $checkMenu = $this->model_menu->select_menu_by_namaMenu($namaMenu);
            if ($checkMenu){
                $this->form_validation->set_message('validasi_nama_menu_update','Nama menu sudah digunakan');
                return false;
            }
        } 

        if (!$namaMenu) {
            $this->form_validation->set_message('validasi_nama_menu_update','Bidang ini harus diisi !');
            return false;
        }
        return true;
    }

    public function validasi_input_controller(){
        $moduleId = $this->input->post('moduleId');
        $controllerId = $this->input->post('controllerId');
        if ($moduleId && !$controllerId){
            $this->form_validation->set_message('validasi_input_controller','Target Controller harus diisi !');
            return false;
        }
        return true;        
    }

    public function validasi_tipe_label(){
        $namaLabel = $this->input->post('namaLabel');
        $tipeLabel = $this->input->post('tipeLabel');
        if ($namaLabel && !$tipeLabel){
            $this->form_validation->set_message('validasi_tipe_label','Tipe label harus dipilih !');
            return false;
        }
        return true; 
    }

    public function update_menu($id) {
        $data['objMenu'] = $this->model_menu->select_menu_by_id($id);
        $data['listMenuInduk'] = $this->model_menu->get_menu_induk();
        $data['listModule'] = $this->model_menu->select_module();

        if($this->input->server('REQUEST_METHOD') == 'POST'){
            extract($this->input->post());            
            $data['listController'] = $this->model_menu->select_controller_by_moduleId($moduleId);
            $data['listFunction'] = $this->model_menu->select_function_by_controllerId($controllerId);
            $data = array_merge($data,$this->input->post());
        } else {            
            $data['listController'] = $this->model_menu->select_controller_by_moduleId($data['objMenu']['module_id']);
            $data['listFunction'] = $this->model_menu->select_function_by_controllerId($data['objMenu']['controller_id']);
        }

        $this->template->load_view('ubah_menu',$data);
    }

    public function update_menu_proses() {
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('namaMenu','Nama Menu','callback_validasi_nama_menu_update');
        $this->form_validation->set_rules('controllerId','Target Controller','callback_validasi_input_controller');
        $this->form_validation->set_rules('tipeLabel','Tipe Label','callback_validasi_tipe_label');           

        if($this->form_validation->run($this) == FALSE){
            $this->update_menu($this->input->post('menuId')); 
        } else {
            extract($this->input->post());
            $data = array(
                        'menu_parent_id' => $menuIndukId
                        ,'menu_nama' => $namaMenu                        
                        ,'module_detail_id' => ($functionId ? $functionId : NULL)
                        ,'module_id' => ($moduleId ? $moduleId : NULL)
                        ,'controller_id' => ($controllerId ? $controllerId : NULL)
                        ,'menu_css_clip' => ($ikon ? $ikon : NULL)
                        ,'menu_label' => ($namaLabel ? $namaLabel : NULL)
                        ,'menu_css_label' => ($namaLabel ? $tipeLabel : NULL)  
                        ,'menu_is_aktif'=>($is_aktif)                      
                        ,'updated_by' => $this->user_id
                        ,'updated_time' => $this->date_today
                    );

            $rs = $this->model_menu->update_menu($menuId,$data);
           
            if ($rs){
                $this->ret_css_status = 'success';
                $this->ret_message = 'Tambah data berhasil';
            } else {
                $this->ret_css_status = 'danger';
                $this->ret_message = 'Tambah data gagal';
            }

            $this->ret_url = site_url('sys/menu/view_menu');

            echo json_encode(array('status'=>$this->ret_css_status,'msg'=>$this->ret_message,'url'=>$this->ret_url,'dest'=>'subcontent-element'));
        }        
    }

    public function update_urutan_menu(){
        $dataUrutan = json_decode($this->input->get('dataUrutan'));
        
        if ($dataUrutan){
            foreach ($dataUrutan as $idx => $value) {
                $data[] = array(
                        'menu_id' => $value
                        ,'menu_sequence' => ++$idx
                    );
            }
        }

        $rs = $this->model_menu->update_urutan_menu($data);

        if ($rs) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    public function delete_menu($id) {
        $rs = $this->model_menu->delete_menu($id);

        if ($rs){
            $this->ret_css_status   = 'success';
            $this->message  = 'Hapus data berhasil';                    
        } else {
            $this->ret_css_status   = 'danger';
            $this->message  = 'Hapus data gagal';                   
        }

        $this->ret_url = site_url('sys/menu/view_menu');
        echo json_encode(array('status'=>$this->ret_css_status,'msg'=>$this->message,'url'=>$this->ret_url));       
    }

}
