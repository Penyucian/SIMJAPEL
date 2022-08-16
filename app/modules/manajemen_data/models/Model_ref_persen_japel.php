<?php
class Model_ref_persen_japel extends CI_Model
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
        $this->dbSimrs->from('ref_simjapel_persen a');
        return $this->dbSimrs->get();
    }

    public function get_data($param)
    {
        $this->datatables->set_database('simrs');
        $this->datatables->select('*');
        $this->datatables->from('ref_simjapel_persen rj');
        $this->datatables->action(
            [
                [
                    'action' => 'edit',
                    'url' => $param['controller'] . 'add',
                    'key' => 'id',
                    'title' => 'Edit Referensi Persen Japel',
                ]
            ]
        );
        return $this->datatables->generate();
    }

    public function update_data($data, $param = [])
    {
        if (!empty($param)) {
            $this->filter($param);
        }
        return $this->dbSimrs->update('ref_simjapel_persen', $data);
    }

}
