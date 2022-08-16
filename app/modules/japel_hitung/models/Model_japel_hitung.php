<?php

/**
 * @author  : Hanif Burhanudin <dev.jogja@gmail.com>
 */
class Model_japel_hitung extends CI_Model
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

    public function get_data_persen(){
        $this->dbSimrs->from('ref_simjapel_persen');
        return $this->dbSimrs->get()->row_array();;
    }

    public function get_periode_row($param = [])
    {
        $this->dbSimrs->from('japel_periode jp');
        return $this->dbSimrs->get();
    }

    public function update_persen($param=[])
    {
        $this->dbSimrs->where('id', 1);
        return $this->dbSimrs->update('ref_simjapel_persen', $param);
    }

    public function get_periode($param = [])
    {
        $this->dbSimrs->select('jp.id');
        $this->dbSimrs->from('japel_periode jp');
        $this->dbSimrs->where("(MONTH(jp.periode)='" . $param['bln2'] . "' AND YEAR(jp.periode)='" . $param['thn2'] . "')");
        $a = $this->dbSimrs->get()->row_array();
        if (empty($a)) {
            $this->dbSimrs->insert('japel_periode', ['periode' => $param['thn2'] . '-' . str_pad($param['bln2'], 2, "0", STR_PAD_LEFT) . '-01']);
            $i1 = $this->dbSimrs->insert_id();
        } else {
            $i1 = $a['id'];
        }
        return $i1;
    }

    public function get_periode_japel($param = [])
    {
        if (!empty($param['id'])) {
            $this->dbSimrs->where('jp.id', $param['id']);
        }
        if (!empty($param['periode']) && $param['periode'] == 2) {
            $this->dbSimrs->where("(MONTH(jp.periode)='" . $param['bln2'] . "' AND YEAR(jp.periode)='" . $param['thn2'] . "')");
        }
        if (!empty($param['periode']) && $param['periode'] == 3) {
            $this->dbSimrs->where("(YEAR(jp.periode)='" . $param['thn3'] . "')");
        }
        $this->dbSimrs->from('japel_periode jp');
        return $this->dbSimrs->get();
    }

    public function get_ptt()
    {
        $this->dbSimrs->select('SUM(e.ptt) AS total_ptt');
        $this->dbSimrs->from('employee e');
        return $this->dbSimrs->get()->row('total_ptt');
    }

    public function get_japel_pegawai()
    {
        $this->dbSimrs->select('SUM(e.japel) AS japel_pegawai');
        $this->dbSimrs->from('employee e');
        $this->dbSimrs->where('e.employee_group_id', 1);
        $this->dbSimrs->where('e.is_aktif', 1);
        return $this->dbSimrs->get()->row('japel_pegawai');
    }

    public function get_japel_pegawai_nonpns()
    {
        $this->dbSimrs->select('SUM(e.japel) AS japel_pegawai');
        $this->dbSimrs->from('employee e');
        $this->dbSimrs->where('e.employee_group_id !=', 1);
        $this->dbSimrs->where('e.is_aktif', 1);
        return $this->dbSimrs->get()->row('japel_pegawai');
    }

    public function get_pendapatan_umum($param = [])
    {
        $this->dbSimrs->select("k.id, kdj.komponen_biaya_subject_id, kdj.harga_jasa");
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->join('kwitansi_detail kd', 'k.id = kd.kwitansi_id');
        $this->dbSimrs->join('kwitansi_detail_jasa kdj', 'kd.id = kdj.kwitansi_detail_id');
        $this->dbSimrs->where('k.status', 'LUNAS');
        $this->dbSimrs->where('k.payment_type_id <> 64');
        $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        $d = $this->dbSimrs->get()->result_array();
        $dt['sarana'] = $dt['pelayanan'] = 0;
        foreach ($d as $row) {
            if ($row['komponen_biaya_subject_id'] == 1) {
                $dt['sarana'] += $row['harga_jasa'];
            } else {
                $dt['pelayanan'] += $row['harga_jasa'];
            }
        }
        return $dt;
    }

    public function get_pendapatan_bpjs($param = [])
    {
        $this->dbSimrs->select('SUM(k.plafon) AS pendapatan_bpjs');
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->where('k.status', 'LUNAS');
        $this->dbSimrs->where('k.payment_type_id', 64);
        $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        $a = $this->dbSimrs->get()->row('pendapatan_bpjs');
        $data = $this->data["persen"] = $this->get_data_persen();
        $dt['sarana'] = $data['saranaBPJS'] * $a;
        $dt['pelayanan'] = $data['pelayananBPJS'] * $a;
        return $dt;
    }

    public function get_jk1($param = [])
    {
        $this->dbSimrs->select('v.paramedic_id, count(v.id) AS jml');
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->join('visits v', 'k.id = v.kwitansi_id');
        $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        $this->dbSimrs->where_not_in('v.continue_id', [2, 10]);
        $this->dbSimrs->group_by('v.paramedic_id');
        $a = $this->dbSimrs->get()->result_array();
        $d = [];
        foreach ($a as $row) {
            if (!empty($row['paramedic_id'])) {
                $d[$row['paramedic_id']] = $row['jml'];
            }
        }
        return $d;
    }

    public function get_jk2($param = [])
    {
        $this->dbSimrs->select('vid.doctor_id, count(vi.id) AS jml');
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->join('visits v', 'k.id = v.kwitansi_id');
        $this->dbSimrs->join('visits_inpatient vi', 'v.id = vi.visit_id');
        $this->dbSimrs->join('visits_inpatient_doctor vid', "vid.visit_inpatient_id = vi.id AND vid.jenis = 'DPJP 1'");
        $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        $this->dbSimrs->group_by('vid.doctor_id');
        $a = $this->dbSimrs->get()->result_array();
        $d = [];
        foreach ($a as $row) {
            if (!empty($row['doctor_id'])) {
                $d[$row['doctor_id']] = $row['jml'];
            }
        }
        return $d;
    }

    public function get_detail_kunjungan_dokter($param)
    {
        $this->dbSimrs->select('v.paramedic_id,
            k.jenis,
            k.no_kwitansi,
            p.id AS no_rm,
            p.name AS name_pasien,
            rpt.name AS payment_type_name,
            k.bayar_tgl,
            k.total,
            k.plafon');
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->join('visits v', 'k.id = v.kwitansi_id');
        $this->dbSimrs->join('patients p', 'v.patient_id = p.id');
        $this->dbSimrs->join('ref_payment_types rpt', 'k.payment_type_id = rpt.id');
        $this->dbSimrs->where('v.paramedic_id', $param['doctor_id']);
        $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        $this->dbSimrs->where_not_in('v.continue_id', [2, 10]);
        $this->dbSimrs->order_by('k.id');
        return $this->dbSimrs->get();
    }

    public function get_detail_kunjungan_dokter_ranap($param)
    {
        $this->dbSimrs->select('vid.doctor_id,
            k.jenis,
            k.no_kwitansi,
            p.id AS no_rm,
            p.name AS name_pasien,
            rpt.name AS payment_type_name,
            k.bayar_tgl,
            k.total,
            k.plafon');
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->join('visits v', 'k.id = v.kwitansi_id');
        $this->dbSimrs->join('ref_payment_types rpt', 'k.payment_type_id = rpt.id');
        $this->dbSimrs->join('visits_inpatient vi', 'v.id = vi.visit_id');
        $this->dbSimrs->join('patients p', 'vi.patient_id = p.id');
        $this->dbSimrs->join('visits_inpatient_doctor vid', "vid.visit_inpatient_id = vi.id AND vid.jenis = 'DPJP 1'");
        $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        $this->dbSimrs->where('vid.doctor_id', $param['doctor_id']);
        $this->dbSimrs->order_by('k.id');
        return $this->dbSimrs->get();
    }

    public function _get_detail_kunjungan_dokter($param)
    {
        $this->dbSimrs->select('
            kdj.doctor_id,
            k.jenis,
            k.no_kwitansi,
            p.id AS no_rm,
            p.name AS name_pasien,
            rpt.name AS payment_type_name,
            k.bayar_tgl,
            kd.date AS tgl_tindakan,
            kd.layanan,
            kd.name AS tindakan,
            rk.name AS name_kelas,
            kd.harga,
            kdj_sarana.harga_jasa AS harga_jasa_sarana,
            SUM(kdj_pelayanan.harga_jasa) AS harga_jasa_pelayanan
        ');
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->join('kwitansi_detail kd', 'kd.kwitansi_id = k.id');
        $this->dbSimrs->join('kwitansi_detail_jasa kdj', 'kd.id = kdj.kwitansi_detail_id', 'left');
        $this->dbSimrs->join('ref_payment_types rpt', 'k.payment_type_id = rpt.id');
        $this->dbSimrs->join('visits v', 'k.id = v.kwitansi_id');
        $this->dbSimrs->join('patients p', 'v.patient_id = p.id');
        $this->dbSimrs->join('ref_kelas rk', 'rk.id = kd.kelas_id', 'left');
        $this->dbSimrs->join('kwitansi_detail_jasa kdj_sarana', 'kdj_sarana.kwitansi_detail_id = kd.id AND kdj_sarana.komponen_biaya_subject_id = 1', 'left');
        $this->dbSimrs->join('kwitansi_detail_jasa kdj_pelayanan', 'kdj_pelayanan.kwitansi_detail_id = kd.id AND kdj_pelayanan.komponen_biaya_subject_id <> 1', 'left');
        $this->dbSimrs->where('v.paramedic_id', $param['doctor_id']);
        $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        $this->dbSimrs->group_by('kd.id');
        $this->dbSimrs->order_by('v.no_register');
        return $this->dbSimrs->get();
    }

    public function _get_detail_kunjungan_dokter_ranap($param)
    {
        $this->dbSimrs->select('
            kdj.doctor_id,
            k.jenis,
            k.no_kwitansi,
            p.id AS no_rm,
            p.name AS name_pasien,
            rpt.name AS payment_type_name,
            k.bayar_tgl,
            kd.date AS tgl_tindakan,
            kd.layanan,
            kd.name AS tindakan,
            rk.name AS name_kelas,
            kd.harga,
            kdj_sarana.harga_jasa AS harga_jasa_sarana,
            SUM(kdj_pelayanan.harga_jasa) AS harga_jasa_pelayanan
        ');
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->join('kwitansi_detail kd', 'kd.kwitansi_id = k.id');
        $this->dbSimrs->join('kwitansi_detail_jasa kdj', 'kd.id = kdj.kwitansi_detail_id', 'left');
        $this->dbSimrs->join('ref_payment_types rpt', 'k.payment_type_id = rpt.id');
        $this->dbSimrs->join('visits v', 'k.id = v.kwitansi_id');
        $this->dbSimrs->join('visits_inpatient vi', 'v.id = vi.visit_id');
        $this->dbSimrs->join('visits_inpatient_doctor vid', "vid.visit_inpatient_id = vi.id AND vid.jenis = 'DPJP 1'");
        $this->dbSimrs->join('patients p', 'v.patient_id = p.id');
        $this->dbSimrs->join('ref_kelas rk', 'rk.id = kd.kelas_id', 'left');
        $this->dbSimrs->join('kwitansi_detail_jasa kdj_sarana', 'kdj_sarana.kwitansi_detail_id = kd.id AND kdj_sarana.komponen_biaya_subject_id = 1', 'left');
        $this->dbSimrs->join('kwitansi_detail_jasa kdj_pelayanan', 'kdj_pelayanan.kwitansi_detail_id = kd.id AND kdj_pelayanan.komponen_biaya_subject_id <> 1', 'left');
        $this->dbSimrs->where('vid.doctor_id', $param['doctor_id']);
        $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        $this->dbSimrs->group_by('kd.id');
        $this->dbSimrs->order_by('v.no_register');
        return $this->dbSimrs->get();
    }

    public function get_japel_manajemen($param = [])
    {
        $this->dbSimrs->select('kdj.komponen_biaya_subject_id, kdj.harga_jasa');
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->join('kwitansi_detail kd', 'k.id = kd.kwitansi_id');
        $this->dbSimrs->join('kwitansi_detail_jasa kdj', 'kd.id = kdj.kwitansi_detail_id');
        $this->dbSimrs->where('k.status', 'LUNAS');
        $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        $d = $this->dbSimrs->get()->result_array();
        $dt['japel_manajemen_total'] = $dt['japel_sarana_total'] = 0;
        foreach ($d as $val) {
            if ($val['komponen_biaya_subject_id'] == 1) {
                $dt['japel_sarana_total'] += $val['harga_jasa'];
            } else {
                $dt['japel_manajemen_total'] += $val['harga_jasa'];
            }
        }
        return $dt;
    }


    public function get_japel_sarana($param = [])
    {
        $this->dbSimrs->select('SUM(kdj.harga_jasa) AS japel_sarana');
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->join('kwitansi_detail kd', 'k.id = kd.kwitansi_id');
        $this->dbSimrs->join('kwitansi_detail_jasa kdj', 'kd.id = kdj.kwitansi_detail_id');
        $this->dbSimrs->where('k.status', 'LUNAS');
        $this->dbSimrs->where('kdj.komponen_biaya_subject_id', 1);
        $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        return $this->dbSimrs->get()->row('japel_sarana');
    }

    public function get_japel_dokter($param = [])
    {
        $this->dbSimrs->select('k.payment_type_id, kdj.harga_jasa, 
        ((kdj.harga_jasa/k.penyebut_profesi)*k.alokasi_profesi) as harga_jasas, k.penyebut_profesi, k.alokasi_profesi,
        (SELECT CASE WHEN kd1.komponen_biaya_group_id in (267, 270, 287, 263,282,259,258,278,262,280,300,299,265,284,
        268,289,290,192,195,194,191,193,225,221,190,223,73,226,222,224,
        220,314,313)
        THEN 1 ELSE 0 END FROM kwitansi_detail kd1 WHERE kd1.kwitansi_id = k.id AND kd1.komponen_biaya_group_id = 270) AS is_operasi
        ');
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->join('kwitansi_detail kd', 'k.id = kd.kwitansi_id');
        $this->dbSimrs->join('kwitansi_detail_jasa kdj', 'kd.id = kdj.kwitansi_detail_id AND kdj.doctor_id IS NOT NULL');
        $this->dbSimrs->where('k.status', 'LUNAS');
        $this->dbSimrs->where('kdj.komponen_biaya_subject_id = 3');
        $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        $this->dbSimrs->where('kd.komponen_biaya_item_id not in ( 206673, 206677)');
        $a = $this->dbSimrs->get()->result_array();
        $dt['umum'] = $dt['bpjs'] = 0;
        foreach ($a as $key => $val) {
            $is_operasi = 0;
            $data = $this->data["persen"] = $this->get_data_persen();
            $operasi = $data['nonOperasiUmum'];
            if ($val['is_operasi'] == 1) {
                $is_operasi = 1;
                $operasi = $data['operasiUmum'];
            }
            if ($val['payment_type_id'] == '64') {
                $dt['bpjs'] += $val['harga_jasas'];
            } else {
                $dt['umum'] += floor($val['harga_jasa']*$operasi);
            }
        }
        return $dt;
    }


    public function get_japel_dokter_satuan($param = [])
    {
        $this->dbSimrs->select("kdj.doctor_id, kdj.harga_jasa AS japel_dokter, 0 as is_operasi");
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->join('kwitansi_detail kd', 'k.id = kd.kwitansi_id');
        $this->dbSimrs->join('kwitansi_detail_jasa kdj', 'kd.id = kdj.kwitansi_detail_id AND kdj.doctor_id IS NOT NULL');
        $this->dbSimrs->where('kdj.komponen_biaya_subject_id = 3');
        $this->dbSimrs->where('k.payment_type_id <> 64');
        $this->dbSimrs->where('k.status', 'LUNAS');
        $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        $this->dbSimrs->where('kd.komponen_biaya_item_id not in ( 206673, 206677)');
        $a = $this->dbSimrs->get()->result_array();
        $c = [];
        foreach ($a as $key => $val) {
            $is_operasi = 0;
            $data = $this->data["persen"] = $this->get_data_persen();
            $operasi = $data['nonOperasiUmum'];
            if ($val['is_operasi'] == 1) {
                $is_operasi = 1;
                $operasi = $data['operasiUmum'];
            };
            $japel = 0;
            if (empty($val['japel_dokter'])) {
                $japel = 0 ;
            } else{
                $japel = $val['japel_dokter'];
            };
            $c[$val['doctor_id']] += floor($japel*$operasi);
        }
        return $c;
    }


    public function get_japel_dokter_satuan_bpjs($param = [])
    {
        $this->dbSimrs->select('kdj.doctor_id, SUM(((kdj.harga_jasa / k.penyebut_profesi) * k.alokasi_profesi)) AS final');
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->join('kwitansi_detail kd', 'k.id = kd.kwitansi_id');
        $this->dbSimrs->join('kwitansi_detail_jasa kdj', 'kd.id = kdj.kwitansi_detail_id AND kdj.doctor_id IS NOT NULL');
        $this->dbSimrs->where('kdj.komponen_biaya_subject_id = 3');
        $this->dbSimrs->where('k.status', 'LUNAS');
        $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        $this->dbSimrs->where('k.payment_type_id', 64);
        $this->dbSimrs->where('kd.komponen_biaya_item_id not in ( 206673, 206677)');
        // $this->dbSimrs->group_by("kdj.doctor_id");
        $a = $this->dbSimrs->get()->result_array();
        $c = [];
        foreach ($a as $key => $val) {
            $c[$val['doctor_id']] += round($val['final']);
        }
        return $c;
    }

    
    public function get_pio_pelayanan_umum($param = [])
    {
        $this->dbSimrs->select('sum(kdj.harga_jasa) as pio_umum');
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->join('kwitansi_detail kd', 'k.id = kd.kwitansi_id');
        $this->dbSimrs->join('kwitansi_detail_jasa kdj', 'kd.id = kdj.kwitansi_detail_id');
        $this->dbSimrs->where('kdj.komponen_biaya_subject_id = 2');
        $this->dbSimrs->where('k.status', 'LUNAS');
        $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        $this->dbSimrs->where('k.payment_type_id != 64');
        $this->dbSimrs->where('kd.komponen_biaya_item_id', 206677);
        return $this->dbSimrs->get()->row('pio_umum');
    }
    
    public function get_pio_pelayanan_bpjs($param = [])
    {
        $this->dbSimrs->select('sum((kdj.harga_jasa/ k.penyebut_profesi)* k.alokasi_profesi) as pio_bpjs');
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->join('kwitansi_detail kd', 'k.id = kd.kwitansi_id');
        $this->dbSimrs->join('kwitansi_detail_jasa kdj', 'kd.id = kdj.kwitansi_detail_id');
        $this->dbSimrs->where('kdj.komponen_biaya_subject_id = 2');
        $this->dbSimrs->where('k.status', 'LUNAS');
        $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        $this->dbSimrs->where('k.payment_type_id = 64');
        $this->dbSimrs->where('kd.komponen_biaya_item_id', 206677);
        return $this->dbSimrs->get()->row('pio_bpjs');

    }
    
    
    public function get_resep_pelayanan_bpjs($param = [])
    {
        $this->dbSimrs->select('sum((kdj.harga_jasa/ k.penyebut_profesi)* k.alokasi_profesi) as resep_bpjs');
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->join('kwitansi_detail kd', 'k.id = kd.kwitansi_id');
        $this->dbSimrs->join('kwitansi_detail_jasa kdj', 'kd.id = kdj.kwitansi_detail_id');
        $this->dbSimrs->where('kdj.komponen_biaya_subject_id = 2');
        $this->dbSimrs->where('k.status', 'LUNAS');
        $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        $this->dbSimrs->where('k.payment_type_id', 64);
        $this->dbSimrs->where('kd.komponen_biaya_item_id', 206673);
        return $this->dbSimrs->get()->row('resep_bpjs');
    }
    
    public function get_resep_pelayanan_umum($param = [])
    {
        $this->dbSimrs->select('sum(kdj.harga_jasa) as resep_umum');
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->join('kwitansi_detail kd', 'k.id = kd.kwitansi_id');
        $this->dbSimrs->join('kwitansi_detail_jasa kdj', 'kd.id = kdj.kwitansi_detail_id');
        $this->dbSimrs->where('kdj.komponen_biaya_subject_id = 2');
        $this->dbSimrs->where('k.status', 'LUNAS');
        $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        $this->dbSimrs->where('k.payment_type_id <> 64');
        $this->dbSimrs->where('kd.komponen_biaya_item_id', 206673);
        return $this->dbSimrs->get()->row('resep_umum');
        
    }

    public function insert_japel($data)
    {
        $data['created_by'] = $this->username;
        $data['created_at'] = $this->date;
        $data['updated_by'] = $this->username;
        $data['updated_at'] = $this->date;
        $sql = $this->dbSimrs->insert('employee_japel', $data);
        $f = fopen('/var/www/html/log.txt', 'a');
        fwrite($f, $this->db->last_query());
        fclose($f);
        return $sql;
    }

    public function get_employee_japel($param = [])
    {
        $this->dbSimrs->select('ej.*, e.*, rj.name AS jabatan');
        $this->dbSimrs->from('employee e');
        $this->dbSimrs->join('employee_japel ej', 'e.id = ej.employee_id');
        $this->dbSimrs->join('ref_jabatan rj', 'e.jabatan_id = rj.id', 'left');
        $this->dbSimrs->where('ej.periode_japel_id', $param['periode_japel_id']);
        $this->dbSimrs->order_by('rj.id', 'asc');
        return $this->dbSimrs->get();
    }

    public function update_japel($param, $data)
    {
        $this->dbSimrs->where('id', $param['id']);
        return $this->dbSimrs->update('employee_japel', $data);
    }
    public function update_persen_japel($param)
    {
        $data = array(
            "manajemen_umum" => $param['jasaManajemenUmum']/100,
            "manajemen_bpjs" => $param['jasaManajemenBPJS']/100,
            "saranaUmum" => $param['saranaUmum']/100,
            "pelayananUmum" => $param['pelayananUmum']/100,
            "saranaBPJS" => $param['saranaBPJS']/100,
            "pelayananBPJS" => $param['pelayananBPJS']/100,
            "operasiUmum" => $param['jasaDokterOPUmum']/100,
            "nonOperasiUmum" => $param['jasaDokterNonOPUmum']/100,
            "operasiBPJS" => $param['jasaDokterBPJS']/100,
            "nonOperasiBPJS" => $param['jasaDokterNonOPBPJS']/100,
            "pointPTT" => str_replace('.','',$param['pointPTT']),
        );
        $this->dbSimrs->where('id', 1);
        return $this->dbSimrs->update('ref_simjapel_persen', $data);
    }

    public function get_employe_japel($param)
    {
        return $this->dbSimrs->select('id')->get_where('employee_japel', ['employee_id' => $param['employee_id'], 'periode_japel_id' => $param['periode_japel_id']]);
    }

    public function update_periode_japel($key, $val)
    {
        $this->dbSimrs->where('id', $key);
        $this->dbSimrs->update('japel_periode', $val);
    }

    public function get_row($param = [])
    {
        $this->dbSimrs->select('ej.employee_id, ej.id');
        $this->dbSimrs->from('employee_japel ej');
        $this->dbSimrs->where('ej.periode_japel_id', $param['periode_japel_id']);
        $a = $this->dbSimrs->get()->result_array();
        $dt = [];
        foreach ($a as $key => $val) {
            $dt[$val['employee_id']] = $val['id'];
        }
        return $dt;
    }

    public function delete_employee_japel($param = [])
    {
        $this->dbSimrs->where('periode_japel_id', $param['periode_japel_id']);
        return $this->dbSimrs->delete('employee_japel');
    }

    public function delete_periode_japel($param = [])
    {
        $this->dbSimrs->where('id', $param['id']);
        return $this->dbSimrs->delete('japel_periode');
    }

    public function get_hitung_bpjs($param = [])
    {
        $this->dbSimrs->select('k.id,
            k.plafon,
            kd.komponen_biaya_group_id,
            (SELECT CASE WHEN kd1.komponen_biaya_group_id in (267, 270, 287, 263,282,259,258,278,262,280,300,299,265,284,
            268,289,290,192,195,194,191,193,225,221,190,223,73,226,222,224,
            220,314,313) THEN 1 ELSE 0 END FROM kwitansi_detail kd1 WHERE kd1.kwitansi_id = k.id AND kd1.komponen_biaya_group_id = 270) AS is_operasi,
            SUM(kdj.harga_jasa) AS penyebut_profesi');
        $this->dbSimrs->from('kwitansi k');
        $this->dbSimrs->join('kwitansi_detail kd', 'k.id = kd.kwitansi_id');
        $this->dbSimrs->join('kwitansi_detail_jasa kdj', 'kd.id = kdj.kwitansi_detail_id');
        $this->dbSimrs->where('kdj.komponen_biaya_subject_id', 3);
        $this->dbSimrs->where('k.status', 'LUNAS');
        $this->dbSimrs->where('k.payment_type_id', '64');
        $this->dbSimrs->where("(MONTH(k.bayar_tgl)='" . $param['bln2'] . "' AND YEAR(k.bayar_tgl)='" . $param['thn2'] . "')");
        $this->dbSimrs->group_by('k.id');
        $d = $this->dbSimrs->get()->result_array();
        $d2 = [];
        foreach ($d as $key => $val) {
            $pelayanan = ($this->config->item('persen_pelayanan') * $val['plafon']);
            $is_operasi = 0;
            $data = $this->data["persen"] = $this->get_data_persen();
            $operasi = $data['nonOperasiBPJS'];
            if ($val['is_operasi'] == 1) {
                $is_operasi = 1;
                $operasi = $data['operasiBPJS'];
            };
            $d2['pelayanan'] = floor($pelayanan);
            $d2['is_operasi'] = $is_operasi;
            $d2['alokasi_profesi'] = floor($operasi * $pelayanan);
            $d2['penyebut_profesi'] = $val['penyebut_profesi'];
            $this->dbSimrs->where('id', $val['id']);
            $this->dbSimrs->update('kwitansi', $d2);
        }
    }
}
