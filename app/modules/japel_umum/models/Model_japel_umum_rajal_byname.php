<?php

/**
 * @author  : Hanif Burhanudin <dev.jogja@gmail.com>
 */
class Model_japel_umum_rajal_byname extends CI_Model
{
    public $dbSimrs;
    public function __construct()
    {
        parent::__construct();
        $this->dbSimrs = $this->load->database("simrs", true);
    }

    public function get_data_rajal($p = [])
    {
        $param = $p['param'];
        $this->dbSimrs->select("rp.nip,
        rp.name,
        SUM(kdj.harga_jasa) AS nominal");
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->join('kwitansi_detail kd', 'k.id = kd.kwitansi_id');
        $this->dbSimrs->join('kwitansi_detail_jasa kdj', 'kd.id = kdj.kwitansi_detail_id');
        $this->dbSimrs->join('ref_paramedics rp', 'kdj.doctor_id = rp.id');
        $this->dbSimrs->where('k.payment_type_id <> 64');
        $this->dbSimrs->where("k.jenis <> 'RI'");
        $this->dbSimrs->where("k.status", 'LUNAS');
        $this->dbSimrs->where_not_in('kdj.komponen_biaya_subject_id', [14, 54]);
        if ($param['periode'] == 1) {
            $this->dbSimrs->where("(DATE(k.bayar_tgl) BETWEEN STR_TO_DATE('" . $param['tgl_mulai'] . "', '%e %b %Y') AND STR_TO_DATE('" . $param['tgl_selesai'] . "', '%e %b %Y'))");
        } else if ($param['periode'] == 2) {
            $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        } else if ($param['periode'] == 3) {
            $this->dbSimrs->where("(YEAR(k.bayar_tgl)='" . $param['thn3'] . "')");
        }
        $this->dbSimrs->group_by('rp.id');
        $this->dbSimrs->order_by('k.bayar_tgl, kd.date');
        return $this->dbSimrs->get();
    }
}
