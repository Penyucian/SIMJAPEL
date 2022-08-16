<?php
class Model_pegawai extends CI_Model
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
        $this->dbSimrs->select('a.*, rj.name AS jabatan_name, rj.index_persentase,
        re.index AS index_pendidikan,
        rr.index AS index_resiko,
        rj.index AS index_jabatan,
        rtt.index AS index_tugas_tambahan,
        a.jasa_bpjs
        ');
        $this->dbSimrs->from('employee a');
        $this->dbSimrs->join('ref_jabatan rj', 'a.jabatan_id = rj.id', 'left');
        $this->dbSimrs->join('ref_educations re', 'a.education_id = re.id', 'left');
        $this->dbSimrs->join('ref_resiko rr', 'a.resiko_id = rr.id', 'left');
        $this->dbSimrs->join('ref_tugas_tambahan rtt', 'a.tugas_tambahan_id = rtt.id', 'left');
        $this->dbSimrs->order_by('rj.id', 'asc');
        return $this->dbSimrs->get();
    }

    public function get_data($param)
    {
        $this->datatables->set_database('simrs');
        $this->datatables->select('e.id, e.paramedic_id, e.nip, e.name, rj.name AS name_jabatan, re.name AS name_pendidikan, r1.name AS name_resiko, r1.tingkat_resiko, r2.name AS name_tugas_tambahan, e.tgl_masuk, e.japel, e.japel_tambahan, r3.name AS employee_group_name, e.ptt, e.jasa_bpjs');
        $this->datatables->from('employee e');
        $this->datatables->join('ref_jabatan rj', 'e.jabatan_id = rj.id', 'left');
        $this->datatables->join('ref_educations re', 'e.education_id = re.id', 'left');
        $this->datatables->join('ref_resiko r1', 'e.resiko_id = r1.id', 'left');
        $this->datatables->join('ref_tugas_tambahan r2', 'e.tugas_tambahan_id = r2.id', 'left');
        $this->datatables->join('employee_group_ref r3', 'e.employee_group_id = r3.id', 'left');
        $this->datatables->order_by("e.jabatan_id");
        $this->datatables->action(
            [
                [
                    'action' => 'edit',
                    'url' => $param['controller'] . 'add',
                    'key' => 'id',
                    'title' => 'Edit Pegawai',
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
        return $this->dbSimrs->insert('employee', $data);
    }

    public function update_data($data, $param = [])
    {
        if (!empty($param)) {
            $this->filter($param);
        }
        return $this->dbSimrs->update('employee', $data);
    }

    public function delete_data($param = [])
    {
        if (!empty($param)) {
            $this->filter($param);
        }
        return $this->dbSimrs->delete('employee');
    }
}
