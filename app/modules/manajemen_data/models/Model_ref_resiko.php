<?php
class Model_ref_resiko extends CI_Model
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
        $this->dbSimrs->from('ref_resiko a');
        return $this->dbSimrs->get();
    }

    public function get_data($param)
    {
        $this->datatables->set_database('simrs');
        $this->datatables->select('rr.id, rr.tingkat_resiko, rr.name, rr.index');
        $this->datatables->from('ref_resiko rr');
        $this->datatables->order_by('rr.tingkat_resiko');
        $this->datatables->action(
            [
                [
                    'action' => 'edit',
                    'url' => $param['controller'] . 'add',
                    'key' => 'id',
                    'title' => 'Edit Referensi Resiko',
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
        return $this->dbSimrs->insert('ref_resiko', $data);
    }

    public function update_data($data, $param = [])
    {
        if (!empty($param)) {
            $this->filter($param);
        }
        return $this->dbSimrs->update('ref_resiko', $data);
    }

    public function delete_data($param = [])
    {
        if (!empty($param)) {
            $this->filter($param);
        }
        return $this->dbSimrs->delete('ref_resiko');
    }
}
