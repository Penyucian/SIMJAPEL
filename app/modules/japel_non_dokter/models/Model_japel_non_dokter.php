<?php

/**
 * @author  : Hanif Burhanudin <dev.jogja@gmail.com>
 */
class Model_japel_non_dokter extends CI_Model
{
    public $dbSimrs;
    private $username;
    private $date;
    public function __construct()
    {
        parent::__construct();
        $this->dbSimrs = $this->load->database("simrs", true);
        $this->username = $this->session->userdata('__username');
        $this->date = date('Y-m-d H:i:s');
    }

    public function get_row($param = [])
    {
        $this->dbSimrs->select('
            e.id,    
            e.nip,
            e.name,
            e.tgl_masuk,
            ej.id AS ej,
            e.jabatan_id,
            rj.name AS jabatan,
            rj.index AS jabatan_index,
            e.education_id,
            re.name AS education,
            re.index AS education_index,
            e.resiko_id,
            rr.name AS resiko,
            rr.index AS resiko_index,
            e.tugas_tambahan_id,
            rtt.name AS tugas_tambahan,
            rtt.index AS tugas_tambahan_index,
            ej.japel_index');
        $this->dbSimrs->from('employee e');
        $this->dbSimrs->join('employee_japel ej', "e.id = ej.employee_id");
        $this->dbSimrs->join('japel_periode jp', "ej.periode_japel_id = jp.id AND jp.periode ='" . $param['periode'] . "'", 'left');
        $this->dbSimrs->join('ref_jabatan rj', 'e.jabatan_id = rj.id', 'left');
        $this->dbSimrs->join('ref_educations re', 'e.education_id = re.id', 'left');
        $this->dbSimrs->join('ref_resiko rr', 'e.resiko_id = rr.id', 'left');
        $this->dbSimrs->join('ref_tugas_tambahan rtt', 'e.tugas_tambahan_id = rtt.id', 'left');
        return $this->dbSimrs->get();
    }

    public function insert_japel($data)
    {
        $data['created_by'] = $this->username;
        $data['created_at'] = $this->date;
        $data['updated_by'] = $this->username;
        $data['updated_at'] = $this->date;
        return $this->dbSimrs->insert('employee_japel', $data);
    }
}
