<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_database extends CI_Model
{
    public $table = 'sys_monitored_table';
    public $primary_key = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_table_list($field_only = "all")
    {
        $this->db->select("*");
        $this->db->from($this->table);

        $result = $this->db->get();

        if ($field_only == "all") {
            return $result->result_object();
        } else if ($field_only === 'field_only') {
            $temp = [];
            foreach ($result->result_object() as $r) {
                $temp[] = $r->monitored_table_name;
            }
            return $temp;
        }
    }

    public function get_table_list_from_server()
    {
        $tables = $this->db->query("SHOW TABLES;");
        return $tables->result_array();
    }

    public function get_field_list($table_id, $field_only = "all")
    {
        $this->db->select("*");
        $this->db->from("sys_monitored_table_detail");
        $this->db->where("monitored_table_id", $table_id);

        if ($field_only == "all") {
            return $this->db->get()->result_array();
        } else {
            $result = $this->db->get()->result_array();
            $temp = [];
            foreach ($result as $r) {
                $temp[] = $r['monitored_table_field'];
            }
            return $temp;
        }
    }

    public function get_field_list_from_server($table_name, $field_only = 'all')
    {
        $fields = $this->db->query("SHOW COLUMNS FROM " . $table_name);
        if ($field_only == "all") {
            return $fields->result_array();
        } else if ($field_only == 'field_only') {
            $temp = [];
            foreach ($fields->result_array() as $f) {
                $temp[] = $f['Field'];
            }
            return $temp;
        }
    }

    public function get_table_detail($id)
    {
        $this->db->select("*");
        $this->db->from("sys_monitored_table");
        $this->db->where("monitored_table_id", $id);

        $data['table'] = $this->db->get()->row();
        $data['fields'] = $this->get_field_list($data['table']->monitored_table_id, "field_only");

        return $data;
    }

    public function insert_data($table_name, $field_list, $user_info)
    {
        $data['monitored_table_name'] = $table_name;
        $data = array_merge($data, $user_info);
        $this->db->insert('sys_monitored_table', $data);
        $id = $this->db->insert_id();

        foreach ($field_list as $field) {
            unset($data);
            $data['monitored_table_id'] = $id;
            $data['monitored_table_field'] = $field;
            $data = array_merge($data, $user_info);
            $this->db->insert('sys_monitored_table_detail', $data);
        }
        return $id;
    }

    public function update_data($id, $field_list, $user_info)
    {
        $this->db->delete("sys_monitored_table_detail", array("monitored_table_id" => $id));

        foreach ($field_list as $field) {
            $data['monitored_table_id'] = $id;
            $data['monitored_table_field'] = $field;
            $data = array_merge($data, $user_info);
            $this->db->insert('sys_monitored_table_detail', $data);
            unset($data);
        }
        return $id;
    }
}
