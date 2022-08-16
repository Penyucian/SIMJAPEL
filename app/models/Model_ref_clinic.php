<?php

/**
 * @author  : Hanif Burhanudin <dev.jogja@gmail.com>
 */
class Model_ref_clinic extends CI_Model
{
    public $dbSimrs;
    public function __construct()
    {
        parent::__construct();
        $this->dbSimrs = $this->load->database("simrs", true);
    }

    public function get_row($param = [])
    {
        $this->dbSimrs->select('a.id, a.name');
        $this->dbSimrs->from('ref_clinics a');
        $this->dbSimrs->where('a.active', 'yes');
        $this->dbSimrs->order_by('a.name');
        if (!empty($param['id'])) {
            $this->dbSimrs->where_in('id', $param['id']);
        }
        return $this->dbSimrs->get();
    }
}
