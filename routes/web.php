<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

Route::get('/', function () {
//    return view('welcome');

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
//    $sheet->getCell();

    $contents = [];
    $count = 30;
    for ($i = 0; $i < $count; ++$i) {
        $contents[$i] = 'Stewardess';
    }
    $data = [$contents];

    $sheet
        ->fromArray($data)
        ->setCellValue('A1', 'Hello World !')
        ->getPageSetup()
        ->setFitToWidth(1)
        ->setOrientation('landscape');

    $writer = new Xlsx($spreadsheet);
    $writer
        ->save('hello world.xlsx');

    $pdfwriter = new Dompdf($spreadsheet);
    $pdfwriter
//        ->setOrientation('landscape')
        ->save('hello world.pdf');

    return 1;
});
