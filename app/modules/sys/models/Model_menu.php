<?php
class Model_menu extends CI_Model
{

    public $table = 'sys_menu';
    public $primary_key = 'menu_id';
    public $user_id;
    public $date_today;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('__user_id');
        $this->date_today = date("Y-m-d H:i:s");
    }

    public function select_menu()
    {
        $this->db->order_by('menu_parent_id');
        $this->db->order_by('menu_sequence');
        return $this->db->get($this->table)->result_array();
    }

    public function select_menu_by_id($id)
    {
        $this->db->where('menu_id', $id);
        $query = $this->db->get($this->table);
        $rs = array();
        if ($query->num_rows() > 0) {
            $rs = $query->row_array();
        }
        return $rs;
    }

    public function select_menu_induk_by_parentId($parentId)
    {
        $this->db->where('menu_parent_id', $parentId);
        $this->db->where('controller_id IS NULL', null, false);
        $this->db->where('module_detail_id IS NULL', null, false);
        $this->db->order_by('menu_sequence');
        return $this->db->get($this->table)->result_array();
    }

    public function select_menu_by_namaMenu($namaMenu)
    {
        $this->db->where('menu_nama', $namaMenu);
        $query = $this->db->get($this->table);
        $rs = array();
        if ($query->num_rows() > 0) {
            $rs = $query->row_array();
        }
        return $rs;
    }

    public function get_menu_induk()
    {
        $arrMenuInduk = array();
        $rootMenu = $this->select_menu_induk_by_parentId(0);
        if ($rootMenu) {
            foreach ($rootMenu as $idx => $objRootMenu) {
                $arrMenuInduk[1][$idx] = array('nama' => $objRootMenu['menu_nama'], 'id' => $objRootMenu['menu_id']);
                $rootMenu1 = $this->select_menu_induk_by_parentId($objRootMenu['menu_id']);
                if ($rootMenu1) {
                    foreach ($rootMenu1 as $idx1 => $objRootMenu1) {
                        $arrMenuInduk[2][$idx][$idx1] = array('nama' => $objRootMenu1['menu_nama'], 'id' => $objRootMenu1['menu_id']);
                    }
                }
            }
        }
        return $arrMenuInduk;
    }

    public function select_module()
    {
        $this->db->order_by('module_nama');
        return $this->db->get('sys_module')->result_array();
    }

    public function select_controller_by_moduleId($moduleId)
    {
        $this->db->where('module_id', $moduleId);
        $this->db->order_by('controller_nama');
        return $this->db->get('sys_controller')->result_array();
    }

    public function select_function_by_controllerId($controllerId)
    {
        $this->db->where('controller_id', $controllerId);
        $this->db->order_by('module_detail_function');
        return $this->db->get('sys_module_detail')->result_array();
    }

    public function get_last_sequence_id_by_parentId($parentId)
    {
        $this->db->select_max('menu_sequence');
        $this->db->where('menu_parent_id', $parentId);
        $query = $this->db->get($this->table);
        $rs = 0;
        if ($query->num_rows() > 0) {
            $rs = $query->row()->menu_sequence;
        }
        return $rs;
    }

    public function insert_menu($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_menu($id, $data)
    {
        $this->db->where('menu_id', $id);
        return $this->db->update($this->table, $data);
    }

    public function update_urutan_menu($data)
    {
        $this->db->trans_start();
        $this->db->update_batch($this->table, $data, $this->primary_key);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function delete_menu($id)
    {
        $this->db->where('menu_id', $id);
        return $this->db->delete($this->table);
    }
}
