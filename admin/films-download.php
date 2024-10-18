<?php
require 'vendor/autoload.php';
require 'config/app.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;

// Membuat objek spreadsheet baru
$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();

// Mengatur header kolom dan ukuran kolom otomatis
$activeWorksheet->setCellValue('A2', 'No')->getColumnDimension('A')->setAutoSize(true);
$activeWorksheet->setCellValue('B2', 'Title')->getColumnDimension('B')->setAutoSize(true);
$activeWorksheet->setCellValue('C2', 'Studio')->getColumnDimension('C')->setAutoSize(true);
$activeWorksheet->setCellValue('D2', 'Category')->getColumnDimension('D')->setAutoSize(true);
$activeWorksheet->setCellValue('E2', 'Status')->getColumnDimension('E')->setAutoSize(true);
$activeWorksheet->setCellValue('F2', 'Created At')->getColumnDimension('F')->setAutoSize(true);

$no = 1;
$loc = 3;

// Mengambil data film dari database
$films = query("SELECT f.id_film, f.title, f.studio, f.is_private, f.created_at, c.title AS category_title FROM films f JOIN categories c ON f.category_id = c.id_category ORDER BY f.created_at DESC");

foreach ($films as $film) {
    $status = $film['is_private'] ? 'Private' : 'Public';
    $activeWorksheet->setCellValue('A' . $loc, $no++);
    $activeWorksheet->setCellValue('B' . $loc, $film['title']);
    $activeWorksheet->setCellValue('C' . $loc, $film['studio']);
    $activeWorksheet->setCellValue('D' . $loc, $film['category_title']);
    $activeWorksheet->setCellValue('E' . $loc, $status);
    $activeWorksheet->setCellValue('F' . $loc, $film['created_at']);
    $loc++;
}

// Mendefinisikan array style border
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => '000000'], // Warna border hitam
        ],
    ],
];

// Menerapkan gaya border pada range yang ditentukan (dari A2 sampai baris terakhir di kolom F)
$activeWorksheet->getStyle('A2:F' . ($loc - 1))->applyFromArray($styleArray);

// Membuat objek writer dan menyimpan file Excel
$writer = new Xlsx($spreadsheet);
$file_name = 'films List.xlsx';
$writer->save($file_name);

// Mengatur header untuk mendownload file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Length: ' . filesize($file_name));
header('Content-Disposition: attachment;filename="' . $file_name . '"');
readfile($file_name);

// Menghapus file setelah didownload agar tidak tersimpan di server
unlink($file_name);
