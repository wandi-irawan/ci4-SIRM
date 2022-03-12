<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Download Laporan'
        ];

        return view('admin/laporan/index', $data);
    }

    public function download_all()
    {
        $data = $this->PasienModel->findAll();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(12);
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A3', 'No')->getColumnDimension('A')->setAutoSize(true);
        $sheet->setCellValue('B3', 'No RM')->getColumnDimension('B')->setAutoSize(true);
        $sheet->setCellValue('C3', 'NIK')->getColumnDimension('C')->setAutoSize(true);
        $sheet->setCellValue('D3', 'Nama')->getColumnDimension('D')->setAutoSize(true);
        $sheet->setCellValue('E3', 'Alamat')->getColumnDimension('E')->setAutoSize(true);
        $sheet->setCellValue('F3', 'Jenis Kelamin')->getColumnDimension('F')->setAutoSize(true);
        $sheet->setCellValue('G3', 'Agama')->getColumnDimension('G')->setAutoSize(true);
        $sheet->setCellValue('H3', 'Diagnosa')->getColumnDimension('H')->setAutoSize(true);
        $sheet->setCellValue('I3', 'Jenis Pelayanan')->getColumnDimension('I')->setAutoSize(true);
        $sheet->setCellValue('J3', 'Biaya')->getColumnDimension('J')->setAutoSize(true);
        $sheet->setCellValue('K3', 'Email')->getColumnDimension('K')->setAutoSize(true);
        $sheet->setCellValue('L3', 'No telepon')->getColumnDimension('L')->setAutoSize(true);
        $sheet->setCellValue('M3', 'Tanggal Input')->getColumnDimension('M')->setAutoSize(true);

        // tampil data
        $no = 1;
        $baris = 4; // mulai dari baris ke 4

        foreach ($data as $data) {
            $sheet->setCellValue('A' . $baris, $no++);
            $sheet->setCellValue('B' . $baris, $data->no_rm);
            $sheet->setCellValue('C' . $baris, $data->nik);
            $sheet->setCellValue('D' . $baris, $data->nama);
            $sheet->setCellValue('E' . $baris, $data->alamat);
            $sheet->setCellValue('F' . $baris, $data->jenis_kelamin);
            $sheet->setCellValue('G' . $baris, $data->agama);
            $sheet->setCellValue('H' . $baris, $data->diagnosa);
            $sheet->setCellValue('I' . $baris, $data->jenis_rawat);
            $sheet->setCellValue('J' . $baris, 'Rp' . number_format($data->biaya, 0, ',', '.'));
            $sheet->setCellValue('K' . $baris, $data->email);
            $sheet->setCellValue('L' . $baris, $data->no_telepon);
            $sheet->setCellValue('M' . $baris, date('d-m-Y', strtotime($data->tanggal_input)));

            $baris++;
        }

        // styling
        $style = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $baris = $baris - 1;
        $sheet->getStyle('A3:M' . $baris)->applyFromArray($style);

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Laporan Data Pasien.xlsx'; // nama file ketika di download
        $writer->save($fileName);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Length: ' . filesize($fileName));
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        readfile($fileName); // send file
        unlink($fileName); // delete file
        exit;
    }
}
