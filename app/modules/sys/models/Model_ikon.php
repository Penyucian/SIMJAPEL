<?php

class Model_ikon extends CI_Model
{
    public $table = 'sys_css_icon';
    public $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('__user_id');
        $this->date_today = date("Y-m-d H:i:s");
    }

    public function select_kategori_ikon()
    {
        $this->db->select('css_icon_kategori');
        $this->db->group_by('css_icon_kategori');
        return $this->db->get($this->table)->result_array();
    }

    public function select_ikon()
    {
        return $this->db->get($this->table)->result_array();
    }
}
