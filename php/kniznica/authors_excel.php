<?php
session_start();

/** PHPExcel */
require_once('vendor/autoload.php');

/** Includovanie funkcii */
include_once('inc/config.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/** Nastavenie zltej farby pre prvy riadok */
$styleArray = [
    'font' => [
        'bold' => true,
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'color' => [
            'argb' => 'FFFFFF00',
        ]
    ],
];

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

/** Vyplnenie buniek udajmi */

// Prvy riadok
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Meno');
$sheet->setCellValue('C1', 'Priezvisko');

// Dalsie riadky
$sql = "SELECT * FROM authors";
$result = $conn->query($sql);
if (mysqli_num_rows($result) > 0) {
    $i = 2;
    while ($row = mysqli_fetch_assoc($result)) {
        $sheet->setCellValue('A' . $i, $row['id']);
        $sheet->setCellValue('B' . $i, $row['first_name']);
        $sheet->setCellValue('C' . $i, $row['last_name']);
        $i++;
    }
    
}

// Redirect output to a client's web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats- officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="authors.xlsx"');
header('Cache-Control: max-age=0');

$writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;
