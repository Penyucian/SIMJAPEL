<?php

/**
 * @author  : Hanif Burhanudin <dev.jogja@gmail.com>
 */
class Model_doctor_ref extends CI_Model
{
    public $dbSimrs;
    public function __construct()
    {
        parent::__construct();
        $this->dbSimrs = $this->load->database("simrs", true);
    }

    public function get_row($param = [])
    {
        $this->dbSimrs->select('a.id, a.name, a.nip');
        $this->dbSimrs->from('ref_paramedics a');
        if (!empty($param['id'])) {
            $this->dbSimrs->where('a.id', $param['id']);
        }
        if (!empty($param['q'])) {
            $this->dbSimrs->like('a.name', urldecode($param['q']));
        }
        return $this->dbSimrs->get();
    }
}
