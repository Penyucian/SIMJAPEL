<?php

class Model_group extends CI_Model {

    public $table = 'sys_group_menu';
    public $primary_key = 'group_menu_id';
    public $user_id;
    public $date_today;

    public function __construct() {
        parent::__construct();
        $this->user_id = $this->session->userdata('__user_id');
        $this->date_today = date("Y-m-d H:i:s");
    }

    public function num_rows_select_group() {
        return $this->db->get($this->table)->num_rows();
    }

    public function select_group($limit, $offset) {
        $this->db->select('group_menu_id,group_menu_nama');
        $this->db->order_by('group_menu_id', 'ASC');
        $this->db->limit($limit, $offset);
        return $this->db->get($this->table)->result_array();
    }

    public function select_menu_list() {
        $this->db->select('menu_id AS id,menu_parent_id AS parent_id,menu_nama AS label');
        $this->db->group_by("menu_id");
        $this->db->order_by('menu_parent_id', 'ASC');
        return $this->db->get('sys_menu')->result_array();
    }

    public function select_access_list($groupId) {
        $this->db->select('menu_id,group_menu_detail_module_permissions as actions');
        $this->db->where('group_menu_id', $groupId);
        $this->db->order_by('menu_id', 'ASC');
        return $this->db->get('sys_group_menu_detail')->result_array();
    }

    public function select_group_by_id($idgroup) {
        $query = $this->db->get_where($this->table, array($this->primary_key => $idgroup));
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function cek_user_access($groupId) {
        $this->db->where('group_menu_id', $groupId);
        $query = $this->db->get('sys_user_access');

        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return false;
        }
    }

    public function cek_permission($permission) {
        $create = 'x';
        $read = 'x';
        $update = 'x';
        $delete = 'x';
        foreach ($permission as $val) {
            if ($val == 'c') {
                $create = 'c';
            } elseif ($val == 'r') {
                $read = 'r';
            } elseif ($val == 'u') {
                $update = 'u';
            } elseif ($val == 'd') {
                $delete = 'd';
            }
        }
        return $create . $read . $update . $delete;
    }

    public function insert_group() {
        $nmGroup = $this->input->post('nmGroup');
        $accesspost = $this->input->post('access');
        $access = explode(',', $accesspost);

        $this->db->trans_start();

        $dataHeader = array(
            'group_menu_nama' => $nmGroup,
            'created_by' => $this->user_id,
            'created_time' => $this->date_today,
            'updated_by' => $this->user_id,
            'updated_time' => $this->date_today
        );

        $rsHeader = $this->db->insert($this->table, $dataHeader);

        if ($rsHeader) {
            $groupId = $this->db->insert_id();
            $actionpost = $this->input->post('action');

            foreach ($access as $val) {
                $action = !empty($actionpost[$val]) ? $this->cek_permission($actionpost[$val]) : '';
                $dataDetail[] = array(
                    'group_menu_id' => $groupId,
                    'menu_id' => $val,
                    'group_menu_detail_module_permissions' => $action,
                    'created_by' => $this->user_id,
                    'created_time' => $this->date_today,
                    'updated_by' => $this->user_id,
                    'updated_time' => $this->date_today
                );
            }
            $this->db->insert_batch('sys_group_menu_detail', $dataDetail);
        }

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function update_group() {
        $groupsId = $this->input->post('id');
        $nmGroup = $this->input->post('nmGroup');
        $accesspost = $this->input->post('access');
        $access = explode(',', $accesspost);

        $this->db->trans_start();

        $dataHeader = array(
            'group_menu_nama' => $nmGroup,
            'updated_by' => $this->user_id,
            'updated_time' => $this->date_today
        );

        $this->db->where($this->primary_key, $groupsId);
        $rsHeader = $this->db->update($this->table, $dataHeader);
        if ($rsHeader) {
            $this->db->delete('sys_group_menu_detail', array('group_menu_id' => $groupsId));
            $actionpost = $this->input->post('action');

            foreach ($access as $val) {
                $action = !empty($actionpost[$val]) ? $this->cek_permission($actionpost[$val]) : '';
                $dataDetail[] = array(
                    'group_menu_id' => $groupsId,
                    'menu_id' => $val,
                    'group_menu_detail_module_permissions' => $action,
                    'created_by' => $this->user_id,
                    'created_time' => $this->date_today,
                    'updated_by' => $this->user_id,
                    'updated_time' => $this->date_today
                );
            }
            $this->db->insert_batch('sys_group_menu_detail', $dataDetail);
        }

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function delete_group($groupId) {
        $this->db->trans_start();
        $this->db->delete('sys_group_menu', array('group_menu_id' => $groupId));
        $this->db->delete('sys_group_menu_detail', array('group_menu_id' => $groupId));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}

?>