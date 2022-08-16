<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Database_monitoring extends SYS_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("model_database");
    }

    public function index() {
        $data['tables'] = $this->model_database->get_table_list();

        $this->template->load_view("database_monitoring/index", $data);
    }

    public function get_field_list($table_name) {
        $fields = [];
        if ($table_name != "0") {
            $temp_fields = $this->model_database->get_field_list_from_server($table_name);
            foreach ($temp_fields as $key => $value) {
                if ($value['Field'] == "created_by") {
                    break;
                }
                $fields[] = $value['Field'];
            }
        }
        echo json_encode($fields);
    }

    public function add_table() {
        $data['tables'] = $this->model_database->get_table_list('field_only');
        $data['tables_in_server'] = $this->model_database->get_table_list_from_server();

        $this->template->load_view("database_monitoring/add_table", $data);
    }

    public function add_table_proses() {
        $table_name = $this->input->post("table_name");
        $field_list = $this->input->post("field-list");

        $query = $this->db->query("SHOW INDEX FROM $table_name WHERE Key_name = 'PRIMARY';");
        $result = $query->row();
        $primary_key = $result->Column_name;

        $queries = "";
        foreach ($field_list as $field) {
            if ($field != $primary_key) {
                $queries .= "IF OLD.$field <> NEW.$field THEN INSERT INTO sys_log (log_type, log_table, log_field, log_primary_key_field, log_primary_key_value, previous_value, new_value, created_by, created_time, updated_by, updated_time) VALUES (1, '$table_name','$field','$primary_key',OLD.$primary_key, OLD.$field, NEW.$field, NEW.created_by, NEW.created_time, NEW.updated_by, NEW.updated_time); END IF;\n";
            }
        }

        $this->db->query("DROP TRIGGER IF EXISTS `" . $table_name . "_update_log`;");
        $this->db->query("CREATE TRIGGER `" . $table_name . "_update_log` AFTER UPDATE ON `" . $table_name . "` FOR EACH ROW BEGIN " . $queries . " END;");

        $user_info = [];
        $user_info = $this->insert_data_user_information($user_info);

        $this->db->trans_begin();
        $id = $this->model_database->insert_data($table_name, $field_list, $user_info);
        if ($this->db->trans_status() === FALSE) {
            $this->ret_css_status = 'danger';
            $this->ret_message = 'Tambah data gagal';
            $this->db->trans_rollback();
        } else {
            $this->ret_css_status = 'success';
            $this->ret_message = 'Tambah data berhasil';
            $this->db->trans_commit();
        }

        $this->ret_url = site_url('sys/database_monitoring/index');
        echo json_encode(array('status' => $this->ret_css_status,
            'msg' => $this->ret_message,
            'url' => $this->ret_url,
            'dest' => 'subcontent-element'));
    }

    public function edit_table($id) {
        $data['from_db'] = $this->model_database->get_table_detail($id);
        $data['server_fields'] = isset($data['from_db']['table']->monitored_table_name) ? $this->model_database->get_field_list_from_server($data['from_db']['table']->monitored_table_name, 'field_only') : [];
        $data['tables_in_server'] = $this->model_database->get_table_list_from_server();
        $data['table_name'] = isset($data['from_db']['table']->monitored_table_name) ? $data['from_db']['table']->monitored_table_name : "";

        $this->load->view("edit_table", $data);
    }

    public function edit_table_proses() {
        $id = $this->input->post("id");
        $table_name = $this->input->post("table_name");
        $field_list = $this->input->post("field-list");

        $query = $this->db->query("SHOW INDEX FROM $table_name WHERE Key_name = 'PRIMARY';");
        $result = $query->row();
        $primary_key = $result->Column_name;

        $queries = "";
        foreach ($field_list as $field) {
            if ($field != $primary_key) {
                $queries .= "IF OLD.$field <> NEW.$field THEN INSERT INTO sys_log (log_type, log_table, log_field, log_primary_key_field, log_primary_key_value, previous_value, new_value, created_by, created_time, updated_by, updated_time) VALUES (1, '$table_name','$field','$primary_key',OLD.$primary_key, OLD.$field, NEW.$field, NEW.created_by, NEW.created_time, NEW.updated_by, NEW.updated_time); END IF;\n";
            }
        }

        $this->db->query("DROP TRIGGER IF EXISTS `" . $table_name . "_update_log`;");
        $this->db->query("CREATE TRIGGER `" . $table_name . "_update_log` AFTER UPDATE ON `" . $table_name . "` FOR EACH ROW BEGIN " . $queries . " END;");

        $user_info = [];
        $user_info = $this->insert_data_user_information($user_info);

        $this->db->trans_begin();

        $this->model_database->update_data($id, $field_list, $user_info);

        if ($this->db->trans_status() === FALSE) {
            $this->ret_css_status = 'danger';
            $this->ret_message = 'Update data gagal';
            $this->db->trans_rollback();
        } else {
            $this->ret_css_status = 'success';
            $this->ret_message = 'Update data berhasil';
            $this->db->trans_commit();
        }

        $this->ret_url = site_url('sys/database_monitoring/index');
        //echo json_encode(array('status' => $this->ret_css_status,
        //    'msg' => $this->ret_message,
        //    'url' => $this->ret_url,
        //    'dest' => 'subcontent-element'));
        redirect($this->ret_url);
    }

    public function delete_table($id) {
        $this->db->select("monitored_table_name");
        $this->db->from("sys_monitored_table");
        $this->db->where("monitored_table_id", $id);
        $abc = $this->db->get()->row();

        $this->db->query("DROP TRIGGER IF EXISTS `" . $abc->monitored_table_name . "_update_log`;");
        $this->db->query("DROP TRIGGER IF EXISTS `" . $abc->monitored_table_name . "_create_log`;");
        $this->db->query("DROP TRIGGER IF EXISTS `" . $abc->monitored_table_name . "_delete_log`;");

        $this->db->delete("sys_monitored_table", array("monitored_table_id" => $id));
        $this->session->set_flashdata('delete_monitored_table', true);
        $return_url = site_url("sys/database_monitoring/index");
        header("location:$return_url");
    }

    public function view_table() {
        
    }

    public function add_field() {
        
    }

    public function add_field_proses() {
        
    }

    public function edit_field() {
        
    }

    public function edit_field_proses() {
        
    }

    public function delete_field() {
        
    }

}
