<?php

/**
 * @author  : Hanif Burhanudin <dev.jogja@gmail.com>
 */
class Model_japel_bpjs_rajal extends CI_Model
{
    public $dbSimrs;
    public function __construct()
    {
        parent::__construct();
        $this->dbSimrs = $this->load->database("simrs", true);
    }

    public function get_data_rajal($param = [])
    {
        $param = $this->input->post();
        $this->dbSimrs->select("p.id AS patient_id,
            p.name AS patient_name,
            kd.date,
            kd.name AS tindakan,
            kd.layanan,
            ((kdj.harga_jasa / k.penyebut_profesi) * k.alokasi_profesi) AS nominal,
	    kdj.harga_jasa_klaim AS final,
            rp.name AS doctor_name");
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->join('visits v', 'k.id = v.kwitansi_id');
        $this->dbSimrs->join('patients p', 'v.patient_id = p.id');
        $this->dbSimrs->join('kwitansi_detail kd', 'k.id = kd.kwitansi_id');
        $this->dbSimrs->join('kwitansi_detail_jasa kdj', 'kd.id = kdj.kwitansi_detail_id');
        $this->dbSimrs->join('ref_paramedics rp', 'kdj.doctor_id = rp.id');
        $this->dbSimrs->where('k.payment_type_id = 64');
        $this->dbSimrs->where("k.jenis <> 'RI'");
        $this->dbSimrs->where("kdj.harga_jasa <> 0");
        $this->dbSimrs->where("k.status", 'LUNAS');
        $this->dbSimrs->where_not_in('kdj.komponen_biaya_subject_id', [14, 54]);
        $this->dbSimrs->where("rp.id", $param['doctor_id']);
        if ($param['periode'] == 1) {
            $this->dbSimrs->where("(DATE(k.bayar_tgl) BETWEEN STR_TO_DATE('" . $param['tgl_mulai'] . "', '%e %b %Y') AND STR_TO_DATE('" . $param['tgl_selesai'] . "', '%e %b %Y'))");
        } else if ($param['periode'] == 2) {
            $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        } else if ($param['periode'] == 3) {
            $this->dbSimrs->where("(YEAR(k.bayar_tgl)='" . $param['thn3'] . "')");
        }
        if (!empty($param['clinic_id'])) {
            $this->dbSimrs->where_in('v.clinic_id', $param['clinic_id']);
        }
        $this->dbSimrs->group_by('kd.id');
        $this->dbSimrs->order_by('k.bayar_tgl, kd.date');
        return $this->dbSimrs->get();
    }
}
