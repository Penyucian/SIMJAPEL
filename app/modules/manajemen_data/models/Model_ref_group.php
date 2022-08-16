<?php
class Model_ref_group extends CI_Model
{
    public $dbSimrs;
    public function __construct()
    {
        parent::__construct();
        $this->dbSimrs = $this->load->database("simrs", true);
    }

    private function filter($param)
    {
        foreach ($param as $key => $val) {
            $this->dbSimrs->where($key, $val);
        }
    }

    public function get_row($param = [])
    {
        if (!empty($param)) {
            $this->filter($param);
        }
        $this->dbSimrs->from('employee_group_ref a');
        return $this->dbSimrs->get();
    }

    public function get_data($param)
    {
        $this->datatables->set_database('simrs');
        $this->datatables->select('rj.id, rj.name');
        $this->datatables->from('employee_group_ref rj');
        $this->datatables->action(
            [
                [
                    'action' => 'edit',
                    'url' => $param['controller'] . 'add',
                    'key' => 'id',
                    'title' => 'Edit Referensi Group',
                ],
                [
                    'action' => 'delete',
                    'url' => $param['controller'] . 'delete',
                    'key' => 'id',
                ],
            ]
        );
        return $this->datatables->generate();
    }

    public function insert_data($data)
    {
        return $this->dbSimrs->insert('employee_group_ref', $data);
    }

    public function update_data($data, $param = [])
    {
        if (!empty($param)) {
            $this->filter($param);
        }
        return $this->dbSimrs->update('employee_group_ref', $data);
    }

    public function delete_data($param = [])
    {
        if (!empty($param)) {
            $this->filter($param);
        }
        return $this->dbSimrs->delete('employee_group_ref');
    }
}
