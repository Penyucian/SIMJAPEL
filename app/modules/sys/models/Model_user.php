<?php

class Model_User extends CI_Model {

    public $table = 'sys_user';
    public $primary_key = 'user_id';

    public function __construct() {
        parent::__construct();
    }

    public function select_user($limit, $offset, $filter) {
        $this->db->select('U.user_id,U.user_username,U.user_nama_lengkap,U.user_is_sso,U.user_is_aktif,GROUP_CONCAT(G.group_menu_nama) as group_menu_nama');
        $this->db->from('sys_user U');
        $this->db->join('sys_user_access GU', 'U.user_id=GU.user_id', 'left');
        $this->db->join('sys_group_menu G', 'G.group_menu_id=GU.group_menu_id', 'left');

        if ($filter) {
            $this->db->like('user_username', $filter);
            $this->db->or_like('user_email', $filter);
            $this->db->or_like('user_nama_lengkap', $filter);
            $this->db->or_like('G.group_menu_nama', $filter);
        }

        $this->db->group_by('U.user_id');
        $this->db->limit($limit, $offset);
        $this->db->order_by('U.user_id', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    public function select_group() {
        $this->db->select('group_menu_id,group_menu_nama');
        $this->db->order_by('group_menu_nama', 'ASC');
        $query = $this->db->get('sys_group_menu');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function num_rows_select_user($filter) {
        $this->db->select('U.user_id,U.user_username,U.user_nama_lengkap,G.group_menu_nama');
        $this->db->from('sys_user U');
        $this->db->join('sys_user_access GU', 'U.user_id=GU.user_id', 'left');
        $this->db->join('sys_group_menu G', 'G.group_menu_id=GU.group_menu_id', 'left');

        if ($filter) {
            $this->db->like('user_username', $filter);
            $this->db->or_like('user_email', $filter);
            $this->db->or_like('user_nama_lengkap', $filter);
            $this->db->or_like('G.group_menu_nama', $filter);
        }

        $this->db->group_by('U.user_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    function select_user_access_by_user_id($userId) {
        $this->db->select('G.group_menu_id, G.group_menu_nama');
        $this->db->from('sys_user_access A');
        $this->db->join('sys_group_menu G', 'A.group_menu_id=G.group_menu_id');
        $this->db->where('user_id', $userId);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return NULL;
        }
    }

    function select_user_by_id($user_id) {
        $this->db->select('U.user_id,U.user_username,U.user_nama_lengkap,U.user_password,U.user_email,G.group_menu_id,U.user_is_aktif,U.user_is_sso, U.user_tipe_nomor');
        $this->db->from('sys_user U');
        $this->db->join('sys_user_access GU', 'U.user_id=GU.user_id', 'left');
        $this->db->join('sys_group_menu G', 'G.group_menu_id=GU.group_menu_id', 'left');
        $this->db->where('U.user_id', $user_id);
        $query = $this->db->get();
        return $query->row();
    }

    function select_user_is_sso_by_id($userId) {
        $this->db->select('user_is_sso');
        $this->db->where('user_id', $userId);
        return $this->db->get('sys_user')->row();
    }

    function select_compare_password($userId, $pwd) {
        $this->db->where('user_id', $userId);
        $this->db->where('user_password', $pwd);
        $query = $this->db->get('sys_user');
        return $query->num_rows();
    }

    function select_username_check_exist($username) {
        $this->db->select('user_id');
        $this->db->where('user_username', $username);
        $query = $this->db->get('sys_user');

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function insert_user($data) {
        return $this->db->insert($this->table, $data);
    }

    public function insert_user_access($data) {
        $this->db->insert('sys_user_access', $data);
    }

    public function update_user($user_id, $data) {
        $this->db->where($this->primary_key, $user_id);
        return $this->db->update($this->table, $data);
    }

    public function update_user_access($user_id, $data) {
        $this->db->where($this->primary_key, $user_id);
        return $this->db->update('sys_user_access', $data);
    }

    public function delete_user_access($userId) {
        return $this->db->delete('sys_user_access', array($this->primary_key => $userId));
    }

    public function delete_user($userId) {
        return $this->db->delete($this->table, array($this->primary_key => $userId));
    }

    public function check_user($username) {
        $this->db->select('*');
        $this->db->where('user_username', $username);
        $query = $this->db->get('sys_user');
        return $query->num_rows();
    }

    /*
     * custom keuangan (user tertentu bisa ganti unit kerja)
     */

    public function select_user_unit_kerja_by_userId($userId) {
        $this->db->where('user_id', $userId);
        return $this->db->get('user_unit_kerja')->result_array();
    }

}

?>