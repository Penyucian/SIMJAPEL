<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Japel_hitung extends SYS_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_japel_hitung');
        $this->load->model('manajemen_data/model_pegawai');
        $this->load->model('manajemen_data/model_ref_persen_japel');
        $this->data['controller'] = 'japel_hitung/japel_hitung/';
    }

    public function index()
    {
        redirect($this->data['controller'] . 'view');
    }

    public function view()
    {
        $this->data['persen'] = $this->model_japel_hitung->get_data_persen($this->data);
        $this->template->load_view($this->data['controller'] . 'view', $this->data);
    }

    public function get_data()
    {
        $param = $this->input->post();
        $this->data['periode'] = $param['thn2'] . '-' . str_pad($param['bln2'], 2, "0", STR_PAD_LEFT) . '-01';
        $this->data['japel_pegawai'] = $this->model_japel_hitung->get_japel_pegawai($this->data);
        $this->load->view($this->data['controller'] . 'detail', $this->data);
    }

    public function generate()
    {
        $this->data = $this->input->get();
        $this->model_japel_hitung->update_persen_japel($this->data);
        $this->data['ref_iks'] = [
            '1|1.00' => 'Patuh terhadap semua standar',
            '2|0.90' => 'Tidak patuh terhadap 1 standar',
            '3|0.80' => 'Tidak patuh terhadap 2 atau lebih standar ',
        ];
        $this->data['ref_ikmkb'] = [
            '1|1.00' => '1.00',
            '2|0.95' => '0.95',
            '3|0.90' => '0.90',
            '4|0.85' => '0.85',
            '5|0.80' => '0.80',
            '6|0.75' => '0.75',
            '7|0.70' => '0.70',
        ];
        $this->data['ref_ikpa'] = [
            '1|4' => 'Telat 0 menit dlm 1 bulan',
            '2|2' => 'Telat 1-250 menit dlm 1 bulan',
            '3|0' => 'Telat lebih dari 250 menit dlm 1 bulan',
        ];
        $this->data['ref_ikpb'] = [
            '1|4' => 'Baik',
            '2|2' => 'Cukup',
            '3|0' => 'Kurang',
        ];
        
        $persen = $this->data['persen'] = $this->model_japel_hitung->get_data_persen($this->data);
        $this->data['hitung_bpjs'] = $this->model_japel_hitung->get_hitung_bpjs($this->data);
        $this->data['pendapatan_umum'] = $this->model_japel_hitung->get_pendapatan_umum($this->data);
        $this->data['pendapatan_bpjs'] = $this->model_japel_hitung->get_pendapatan_bpjs($this->data);
        $this->data['japel_minimal'] = $this->model_japel_hitung->get_japel_pegawai();
        $this->data['japel_minimal_nonpns'] = $this->model_japel_hitung->get_japel_pegawai_nonpns();
        $this->data['japel_manajemen_umum'] = $persen['manajemen_umum'] * $this->data['pendapatan_umum']['pelayanan'];
        $this->data['japel_manajemen_bpjs'] = $persen['manajemen_bpjs'] * $this->data['pendapatan_bpjs']['pelayanan'];
        $this->data['pio_umum'] = $this->model_japel_hitung->get_pio_pelayanan_umum($this->data);
        $this->data['pio_bpjs'] = $this->model_japel_hitung->get_pio_pelayanan_bpjs($this->data);
        $this->data['resep_umum'] = $this->model_japel_hitung->get_resep_pelayanan_umum($this->data);
        $this->data['resep_bpjs'] = $this->model_japel_hitung->get_resep_pelayanan_bpjs($this->data);
        $this->data['japel_dokter'] = $this->model_japel_hitung->get_japel_dokter($this->data);
        $this->data['saranaUmum'] = $this->data['saranaUmum'];
        $this->data['pelayananUmum'] = $this->data['pelayananUmum'];
        $this->data['saranaBPJS'] = $this->data['saranaBPJS'];
        $this->data['operasiUmum'] = $this->data['operasiUmum'];
        $this->data['nonOperasiUmum'] = $this->data['nonOperasiUmum'];
        $this->data['operasiBPJS'] = $this->data['operasiBPJS'];
        $this->data['nonOperasiBPJS'] = $this->data['nonOperasiBPJS'];
        $this->data['manajemen_umum'] = $this->data['manajemen_umum'];
        $this->data['manajemen_bpjs'] = $this->data['manajemen_bpjs'];
        $this->data['pointPTT'] = str_replace('.', '', $this->data['pointPTT']);
        $this->data['japel_index'] = ($this->data['pendapatan_umum']['pelayanan'] + $this->data['pendapatan_bpjs']['pelayanan']) - $this->data['japel_minimal'] - $this->data['japel_minimal_nonpns'] -  $this->data['japel_manajemen_umum'] - $this->data['japel_manajemen_bpjs'] - $this->data['japel_dokter']['umum'] - $this->data['japel_dokter']['bpjs'] - $this->data['nominal_ptt'];

        $this->data['employee'] = $this->model_pegawai->get_row()->result_array();

        $this->data['periode'] = $this->model_japel_hitung->get_periode($this->data);
        $this->data['employee_detail'] = $this->model_japel_hitung->get_employee_japel(['periode_japel_id' => $this->data['periode']])->result_array();
        $iki = [];
        foreach ($this->data['employee_detail'] as $k => $v) {
            $iki[$v['employee_id']] = $v['indeks_kerja_id'] . '|' . $v['indeks_kerja_index'];
        }
        $tptt = $this->model_japel_hitung->get_ptt();
        $this->data['nominal_ptt_final'] = $tptt * $persen['pointPTT'];
        $jk1 = $this->model_japel_hitung->get_jk1($this->data);
        $jk2 = $this->model_japel_hitung->get_jk2($this->data);
        $tjapel = $this->model_japel_hitung->get_japel_manajemen($this->data);
        $this->data['japel_manajemen_total'] = $tjapel['japel_manajemen_total'];
        $this->data['japel_sarana_total'] = $tjapel['japel_sarana_total'];
        $this->data['japel_dokter_satuan'] = $this->model_japel_hitung->get_japel_dokter_satuan($this->data);
        $this->data['japel_dokter_satuan_bpjs'] = $this->model_japel_hitung->get_japel_dokter_satuan_bpjs($this->data);
        $dt = [];
        foreach ($this->data['employee'] as $key => $val) {
            //japel dokter
            $japelDokterSatuan = 0;
            foreach ($this->data['japel_dokter_satuan'] as $key2 => $val2) {
                if ($key2 == $val['paramedic_id']) {
                    $japelDokterSatuan = $val2;
                    break;
                }
            }
            $japelDokterSatuanBpjs = 0;
            foreach ($this->data['japel_dokter_satuan_bpjs'] as $key21 => $val21) {
                if ($key21 == $val['paramedic_id']) {
                    $japelDokterSatuanBpjs = $val21;
                    break;
                }
            }

            $japelKhusus = 0;
            foreach ($this->data['employee'] as $key22 => $val22) {
                if ($key22 == $val['id']) {
                    $japelKhusus = ($this->data['pendapatan_bpjs']['pelayanan'] + $this->data['pendapatan_bpjs']['sarana']) * $val['jasa_bpjs'];
                    break;
                }
            }

            $masa_kerja = date_diff(date_create($val['tgl_masuk']), date_create(date('Y-m-d')))->format('%y');
            if ($masa_kerja > 10) {
                $mkid = 1;
                $nm = 10;
            } elseif (6 < $masa_kerja) {
                $mkid = 2;
                $nm = 8;
            } elseif (3 < $masa_kerja) {
                $mkid = 3;
                $nm = 6;
            } elseif (1 < $masa_kerja) {
                $mkid = 4;
                $nm = 4;
            } elseif (0 < $masa_kerja) {
                $mkid = 5;
                $nm = 2;
            } else{
                $mkid = 0;
                $nm = 0;
            }
            $p1 = $val['index_pendidikan'];
            $p2 = $val['index_resiko'];
            $p3 = $val['index_jabatan'];
            $p4 = $val['index_tugas_tambahan'];
            $p5 = $nm;
            $p6 = $val['ptt'];
            $index =  $p2 + $p3 + $p4 + $p5 + $p6;
            $ik2 = !empty($iki[$val['id']]) ? $iki[$val['id']] : '';
            $jk12 = !empty($jk1[$val['paramedic_id']]) ? $jk1[$val['paramedic_id']] : 0;
            $jk22 = !empty($jk2[$val['paramedic_id']]) ? $jk2[$val['paramedic_id']] : 0;
            $ptt_nominal = !empty($val['ptt']) ? ($val['ptt'] / $tptt) * $persen['pointPTT'] : 0;
            $dt[$val['id']] = [
                'paramedic_id' => $val['paramedic_id'],
                'nip' => $val['nip'],
                'name' => $val['name'],
                'jabatan' => $val['jabatan_name'],
                'jabatan_id' => $val['jabatan_id'],
                'jabatan_index' => $val['index_jabatan'],
                'education_id' => $val['education_id'],
                'education_index' => $val['index_pendidikan'],
                'resiko_id' => $val['resiko_id'],
                'resiko_index' => $val['index_resiko'],
                'tugas_tambahan_id' => $val['tugas_tambahan_id'],
                'tugas_tambahan_index' => $val['index_tugas_tambahan'],
                'masa_kerja_id' => $mkid,
                'masa_kerja_index' => $nm,
                'indeks_kerja_id' => $ik2,
                'ptt_index' => $val['ptt'],
                'ptt_nominal' => floor($val['ptt']*$persen['pointPTT']),
                'japel_minimal' => floor($val['japel']),
                'japel_tambahan' => floor($val['japel_tambahan']),
                'japel_manajemen' => floor(($val['index_persentase'] / 100) * $this->data['japel_manajemen_umum']),
                'japel_manajemen_bpjs' => floor(($val['index_persentase'] / 100) * $this->data['japel_manajemen_bpjs']),
                'japel_dokter' => floor($japelDokterSatuan),
                'japel_dokter_bpjs' => floor($japelDokterSatuanBpjs),
                'japel_khusus' => floor($japelKhusus),
                'index' => $index,
                'jk12' => $jk12,
                'jk22' => $jk22,
            ];
        }
        $this->data['content'] = $dt;
        $this->template->load_view('detail', $this->data);
    }

    public function get_detail_kunjungan($param)
    {
        $p = explode('_', $param);
        $this->data['bln2'] = $p[0];
        $this->data['thn2'] = $p[1];
        $this->data['doctor_id'] = $p[2];
        $this->data['content'] = $this->model_japel_hitung->get_detail_kunjungan_dokter($this->data)->result_array();
        $this->load->view($this->data['controller'] . 'detail_kunjungan', $this->data);
    }

    public function get_detail_kunjungan_ranap($param)
    {
        $p = explode('_', $param);
        $this->data['bln2'] = $p[0];
        $this->data['thn2'] = $p[1];
        $this->data['doctor_id'] = $p[2];
        $this->data['content'] = $this->model_japel_hitung->get_detail_kunjungan_dokter_ranap($this->data)->result_array();
        $this->load->view($this->data['controller'] . 'detail_kunjungan', $this->data);
    }

    public function submit()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->model_japel_hitung->dbSimrs->trans_begin();
            $data = $this->input->post();
            $this->model_japel_hitung->update_periode_japel($data['periode'], $data['dp']);
            foreach ($data['dt'] as $key => $val) {
                unset($val['index']);
                $d2[1] = $d3[1] = $d4[1] = $d5[1] = 0;
                if (!empty($val['iks'])) {
                    $d2 = explode('|', $val['iks']);
                    $val['iks_id'] = $d2[0];
                    $val['iks_index'] = $d2[1];
                }
                if (!empty($val['ikmkb'])) {
                    $d5 = explode('|', $val['ikmkb']);
                    $val['ikmkb_id'] = $d5[0];
                    $val['ikmkb_index'] = $d5[1];
                }
                if (!empty($val['ikpa'])) {
                    $d3 = explode('|', $val['ikpa']);
                    $val['ikpa_id'] = $d3[0];
                    $val['ikpa_index'] = $d3[1];
                }
                if (!empty($val['ikpb'])) {
                    $d4 = explode('|', $val['ikpb']);
                    $val['ikpb_id'] = $d4[0];
                    $val['ikpb_index'] = $d4[1];
                }
                unset($val['iks'], $val['ikmkb'], $val['ikpa'], $val['ikpb']);
                $index = $val['jabatan_index'] + $val['education_index'] + $val['resiko_index'] + $val['tugas_tambahan_index'] + $val['masa_kerja_index'] + $d3[1] + $d4[1] + $d5[1];
                $ji = ($index / $data['total_index']) * $data['dp']['japel_index'];
                $val['japel_index'] = $ji > 0 ? $ji : 0;
                $val['japel_total'] = $val['japel_minimal'] + $val['japel_manajemen'] + $val['japel_manajemen_bpjs'] + $val['japel_dokter'] + $val['japel_dokter_bpjs'] + $val['japel_tambahan'] + $val['japel_index'] + $val['ptt_nominal'] ;
                $cek = $this->model_japel_hitung->get_employe_japel(['employee_id' => $val['employee_id'], 'periode_japel_id' => $data['periode']])->row_array();
                if (empty($cek['id'])) {
                    $this->model_japel_hitung->insert_japel($val);
                } else {
                    $this->model_japel_hitung->update_japel(['id' => $cek['id']], $val);
                }
            }
            if ($this->model_japel_hitung->dbSimrs->trans_status() === true) {
                $this->model_japel_hitung->dbSimrs->trans_commit();
                $this->ret_css_status = 'success';
                $this->ret_message = 'Proses simpan data berhasil';
                $this->ret_url = site_url($this->data['controller'] . 'detail_japel/' . $data['periode']);
            } else {
                $this->model_japel_hitung->dbSimrs->trans_rollback();
                $this->ret_css_status = 'danger';
                $this->ret_message = 'Data gagal disimpan error';
                $this->ret_url = site_url($this->data['controller'] . 'add/');
           }
            echo json_encode(array('status' => $this->ret_css_status, 'msg' => $this->ret_message, 'url' => $this->ret_url, 'dest' => 'subcontent-element', 'is_modal' => 1));
        }
    }

    public function detail_japel($periode_id)
    {
        $this->data['ref_iks'] = [
            '1' => 'Patuh terhadap semua standar',
            '2' => 'Tidak patuh terhadap 1 standar',
            '3' => 'Tidak patuh terhadap 2 atau lebih standar ',
        ];
        $this->data['ref_ikmkb'] = [
            
            '1' => '1.00',
            '2' => '0.95',
            '3' => '0.90',
            '4' => '0.85',
            '5' => '0.80',
            '6' => '0.75',
            '7' => '0.70',
        ];
        $this->data['ref_ikpa'] = [
            '1' => 'Telat 0 menit dlm 1 bulan',
            '2' => 'Telat 1-250 menit dlm 1 bulan',
            '3' => 'Telat lebih dari 250 menit dlm 1 bulan',
        ];
        $this->data['ref_ikpb'] = [
            '1' => 'Baik',
            '2' => 'Cukup',
            '3' => 'Kurang',
        ];
        $this->data['periode_japel'] = $this->model_japel_hitung->get_periode_japel(['id' => $periode_id])->row_array();
        $this->data['content'] = $this->model_japel_hitung->get_employee_japel(['periode_japel_id' => $periode_id])->result_array();
        $this->template->load_view($this->data['controller'] . 'detail_japel', $this->data);
    }

    public function export($periode_japel_id)
    {
        $periode = $this->model_japel_hitung->get_periode_japel(['id' => $this->encryption_lib->urldecode($periode_japel_id)])->row_array();
        $data = $this->model_japel_hitung->get_employee_japel(['periode_japel_id' => $this->encryption_lib->urldecode($periode_japel_id)])->result_array();
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator("SMC")->setLastModifiedBy("SMC");
        $objset = $spreadsheet->setActiveSheetIndex(0);
        $objset->setCellValue('A1', 'Japel Periode ' . indonesian_date($periode['periode'], 'F Y'));
        $objset->setCellValue('A3', 'Japel Pegawai: ' . rupiah($periode['japel_minimal']));
        $objset->setCellValue('A4', 'Pelayanan: ' . rupiah($periode['japel_manajemen_total']));
        $objset->setCellValue('A5', 'Japel Manajemen: Rp ' . number_format($periode['japel_manajemen'], 2, ",", "."));
        $objset->setCellValue('A6', 'Japel Dokter: ' . rupiah($periode['japel_dokter']));
        $objset->setCellValue('A7', 'Japel Index: Rp ' . number_format($periode['japel_index'], 2, ",", "."));
        $objset->setCellValue('A9', '#');
        $objset->setCellValue('B9', 'NIP');
        $objset->setCellValue('C9', 'Nama');
        $objset->setCellValue('D9', 'Jabatan');
        $objset->setCellValue('E9', 'Japel Pegawai');
        $objset->setCellValue('F9', 'Japel Jabatan');
        $objset->setCellValue('G9', 'Japel Dokter');
        $objset->setCellValue('H9', 'Japel Index');
        $objset->setCellValue('I9', 'Total');

        if (isset($data)) {
            $i = 10;
            $n = 1;
            $j1 = $j2 = $j3 = $j4 = $j5 = 0;
            foreach ($data as $key => $val) {
                $objset->setCellValue('A' . $i, $n++);
                $objset->setCellValue('B' . $i, $val['nip']);
                $objset->setCellValue('C' . $i, $val['name']);
                $objset->setCellValue('D' . $i, $val['jabatan']);
                $objset->setCellValue('E' . $i, rupiah($val['japel_minimal']));
                $objset->setCellValue('F' . $i, rupiah($val['japel_manajemen']));
                $objset->setCellValue('G' . $i, rupiah($val['japel_dokter']));
                $objset->setCellValue('H' . $i, rupiah($val['japel_index']));
                $objset->setCellValue('I' . $i, rupiah($val['japel_total']));
                $j1 += $val['japel_minimal'];
                $j2 += $val['japel_manajemen'];
                $j3 += $val['japel_dokter'];
                $j4 += $val['japel_index'];
                $j5 += $val['japel_total'];
                $i++;
            }
            $objset->setCellValue('E' . $i, rupiah($j1));
            $objset->setCellValue('F' . $i, rupiah($j2));
            $objset->setCellValue('G' . $i, rupiah($j3));
            $objset->setCellValue('H' . $i, rupiah($j4));
            $objset->setCellValue('I' . $i, rupiah($j5));
        } else {
            $objset->setCellValue('A10', 'Data tidak ditemukan');
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('A10:I10');
        }

        $spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:I1');
        $spreadsheet->setActiveSheetIndex(0)->mergeCells('A3:I3');
        $spreadsheet->setActiveSheetIndex(0)->mergeCells('A4:I4');
        $spreadsheet->setActiveSheetIndex(0)->mergeCells('A5:I5');
        $spreadsheet->setActiveSheetIndex(0)->mergeCells('A6:I6');
        $spreadsheet->setActiveSheetIndex(0)->mergeCells('A7:I7');
        $sa = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ];
        $spreadsheet->getActiveSheet()->getStyle('A1:I1')->applyFromArray($sa);
        for ($i = 'A'; $i != $spreadsheet->getActiveSheet()->getHighestColumn(); $i++) {
            $spreadsheet->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }
        $spreadsheet->getActiveSheet()->setTitle('Japel Periode ' . indonesian_date($periode['periode'], 'F Y'));
        $spreadsheet->setActiveSheetIndex(0);
        $filename = 'Japel Periode - ' . indonesian_date($periode['periode'], 'F Y') . '-' . date('dmYH');
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
