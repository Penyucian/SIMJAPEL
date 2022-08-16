<?php

class Model_Log extends CI_Model {

    public $table = 'sys_log';
    public $primary_key = 'log_id';

    public function __construct() {
        parent::__construct();
    }

    public function get_log($before_id, $after_id, $limit = 0) {
        $this->db->select("L.*,UC.user_username, UC.user_nama_lengkap,UU.user_username, UU.user_nama_lengkap");
        $this->db->from($this->table . " L");
        $this->db->join("sys_user UC", "UC.user_id = L.created_by");
        $this->db->join("sys_user UU", "UU.user_id = L.updated_by");
        $this->db->order_by("log_id", "desc");

        if (!empty($after_id) && $after_id != 0) {
            $this->db->where("log_id >", $after_id);
        }

        if (!empty($before_id) && $before_id != 0) {
            $this->db->where("log_id <", $before_id);
            $this->db->order_by("log_id", "asc");
        }

        $this->db->limit($limit);

        $result = $this->db->get()->result_object();
        if (!empty($before_id) && $before_id != 0) {
            array_reverse($result);
        }

        return $result;
    }

    public function get_first_id() {
        $this->db->select("log_id");
        $this->db->from("sys_log");
        $this->db->order_by("log_id", "asc");
        $this->db->limit(1);
        $result = $this->db->get()->result_array();
        
        if (isset($result[0]['log_id'])) {
            return $result[0]['log_id'];
        } else {
            return 0;
        }
    }

    public function get_last_id() {
        $this->db->select("log_id");
        $this->db->from("sys_log");
        $this->db->order_by("log_id", "desc");
        $this->db->limit(1);
        $result = $this->db->get()->result_array();
        
        if (isset($result[0]['log_id'])) {
            return $result[0]['log_id'];
        } else {
            return 0;
        }
    }

}
