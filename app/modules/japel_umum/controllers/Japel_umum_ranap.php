<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Japel_umum_ranap extends SYS_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_japel_umum_ranap');
        $this->load->model('model_ref_clinic');
        $this->load->model('model_doctor_ref');
        $this->data['controller'] = 'japel_umum/japel_umum_ranap/';
        if (!empty($this->session->userdata('__user_tipe_nomor'))) {
            $this->data['dokter'] = $this->model_doctor_ref->get_row(['id' => $this->session->userdata('__user_tipe_nomor')])->row_array();
        }
    }

    public function index()
    {
        redirect($this->data['controller'] . 'view');
    }

    public function view()
    {
        $this->data['ref_clinic'] = $this->model_ref_clinic->get_row()->result_array();
        $this->template->load_view($this->data['controller'] . 'view', $this->data);
    }

    public function get_data()
    {
        $this->data['content'] = $this->model_japel_umum_ranap->get_data_ranap($this->data)->result_array();
        $this->load->view($this->data['controller'] . 'detail', $this->data);
    }

    public function export()
    {
        $this->data['param'] = $this->input->get();
        $data = $this->model_japel_umum_ranap->get_data_ranap($this->data)->result_array();
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator("SMC")->setLastModifiedBy("SMC");
        $objset = $spreadsheet->setActiveSheetIndex(0);
        $dokter = $this->model_doctor_ref->get_row(['id' => $this->data['param']['doctor_id']])->row('name');
        if ($this->data['param']['periode'] == '2') {
            $bln = getbln();
            $p = 'Bulan ' . $bln[$this->data['param']['bln2']] . ' Tahun ' . $this->data['param']['thn2'];
        } else if ($this->data['param']['periode'] == '1') {
            $p = 'tanggal ' . $this->data['param']['tgl_mulai'] . ' s/d ' . $this->data['param']['tgl_selesai'];
        } else if ($this->data['param']['periode'] == '3') {
            $p = 'tahun ' . $this->data['param']['thn3'];
        }
        $klinik = '-';
        if (!empty($this->data['param']['clinic_id'])) {
            $k = $this->model_ref_clinic->get_row(['id' => $this->data['param']['clinic_id']])->result_array();
            $klinik = implode(';', array_column($k, 'name'));
        }
        $objset->setCellValue('A1', 'Japel Umum Rawat Inap');
        $objset->setCellValue('A3', 'Dokter: ' . $dokter);
        $objset->setCellValue('A4', 'Periode: ' . $p);
        $objset->setCellValue('A5', 'Klinik: ' . $klinik);
        $objset->setCellValue('A7', '#');
        $objset->setCellValue('B7', 'No.RM');
        $objset->setCellValue('C7', 'Nama Pasien');
        $objset->setCellValue('D7', 'Tgl Tindakan');
        $objset->setCellValue('E7', 'Nama Tindakan');
        $objset->setCellValue('F7', 'Layanan');
        $objset->setCellValue('G7', 'Nominal');

        if (isset($data)) {
            $i = 8;
            $n = 1;
            $total = 0;
            foreach ($data as $key => $val) {
                $objset->setCellValue('A' . $i, $n++);
                $objset->setCellValue('B' . $i, $val['patient_id']);
                $objset->setCellValue('C' . $i, $val['patient_name']);
                $objset->setCellValue('D' . $i, date('d-m-Y', strtotime($val['date'])));
                $objset->setCellValue('E' . $i, $val['tindakan']);
                $objset->setCellValue('F' . $i, $val['layanan']);
                $objset->setCellValue('G' . $i, rupiah($val['nominal']));
                $total += $val['nominal'];
                $i++;
            }
            $objset->setCellValue('A' . $i, 'Total');
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('A' . $i . ':F' . $i);
            $objset->setCellValue('G' . $i, rupiah($total));
        } else {
            $objset->setCellValue('A8', 'Data tidak ditemukan');
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('A8:G8');
        }

        $spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:G1');
        $spreadsheet->setActiveSheetIndex(0)->mergeCells('A3:G3');
        $spreadsheet->setActiveSheetIndex(0)->mergeCells('A4:G4');
        $spreadsheet->setActiveSheetIndex(0)->mergeCells('A5:G5');
        $sa = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ];
        $spreadsheet->getActiveSheet()->getStyle('A1:G1')->applyFromArray($sa);
        for ($i = 'A'; $i != $spreadsheet->getActiveSheet()->getHighestColumn(); $i++) {
            $spreadsheet->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
        }
        $spreadsheet->getActiveSheet()->setTitle('Japel Umum Rawat Inap');
        $spreadsheet->setActiveSheetIndex(0);
        $filename = 'Japel Umum Rawat Inap - ' . $dokter . '-' . date('dmYH');
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
