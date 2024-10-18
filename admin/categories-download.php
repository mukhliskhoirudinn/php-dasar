<?php
require 'vendor/autoload.php';
require 'config/app.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Style;

$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();

// Mengatur header dan mengatur ukuran kolom otomatis
$activeWorksheet->setCellValue('A2', 'No')->getColumnDimension('A')->setAutoSize(true);
$activeWorksheet->setCellValue('B2', 'Title')->getColumnDimension('B')->setAutoSize(true);
$activeWorksheet->setCellValue('C2', 'Slug')->getColumnDimension('C')->setAutoSize(true);
$activeWorksheet->setCellValue('D2', 'Created At')->getColumnDimension('D')->setAutoSize(true);

$no = 1;
$loc = 3;

// Mengambil data kategori dari database
$categories = query("SELECT * FROM categories ORDER BY created_at DESC");

foreach ($categories as $category) {
    $activeWorksheet->setCellValue('A' . $loc, $no++);
    $activeWorksheet->setCellValue('B' . $loc, $category['title']);
    $activeWorksheet->setCellValue('C' . $loc, $category['slug']);
    $activeWorksheet->setCellValue('D' . $loc, $category['created_at']);
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

// Menerapkan gaya border pada range yang ditentukan (dari A2 sampai baris terakhir di kolom D)
$activeWorksheet->getStyle('A2:D' . ($loc - 1))->applyFromArray($styleArray);

$writer = new Xlsx($spreadsheet);
$file_name = 'categories List.xlsx';
$writer->save($file_name);

// Mengatur header untuk mendownload file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Length: ' . filesize($file_name));
header('Content-Disposition: attachment;filename="' . $file_name . '"');
readfile($file_name);
unlink($file_name); // Menghapus file setelah didownload untuk tidak tersimpan di server
