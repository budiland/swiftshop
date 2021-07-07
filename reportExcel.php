<?php

require 'vendor/autoload.php';
require 'backend/koneksi.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// header tabel games
$sheet->setCellValue('A1', 'ID_GAME');
$sheet->setCellValue('B1', 'NAMA_GAME');
$sheet->setCellValue('C1', 'POPULARITAS_GAME');
// header tabel items
$sheet->setCellValue('E1', 'ID_ITEM');
$sheet->setCellValue('F1', 'ID_METODE');
$sheet->setCellValue('G1', 'ID_GAME');
$sheet->setCellValue('H1', 'NAMA_ITEM');
$sheet->setCellValue('I1', 'VALUE_ITEM');
$sheet->setCellValue('J1', 'HARGA_ITEM');
// header tabel metode_pembayaran
$sheet->setCellValue('L1', 'ID_METODE');
$sheet->setCellValue('M1', 'NAMA_METODE');
// header tabel metode_pembayaran
$sheet->setCellValue('O1', 'ID_VOUCHER');
$sheet->setCellValue('P1', 'ID_ITEM');
$sheet->setCellValue('Q1', 'NAMA_VOUCHER');
$sheet->setCellValue('R1', 'DESKRIPSI_VOUCHER');

// Tabel Games
$queryGames = mysqli_query($conn, "select * from games");
$countGames = 2;
while ($row1 = mysqli_fetch_array($queryGames)) {
  $sheet->setCellValue('A' . $countGames, $row1['ID_GAME']);
  $sheet->setCellValue('B' . $countGames, $row1['NAMA_GAME']);
  $sheet->setCellValue('C' . $countGames, $row1['POPULARITAS_GAME']);
  $countGames++;
}

// Tabel Item
$queryItem = mysqli_query($conn, "select * from item");
$countItems = 2;
while ($row2 = mysqli_fetch_array($queryItem)) {
  $sheet->setCellValue('E' . $countItems, $row2['ID_ITEM']);
  $sheet->setCellValue('F' . $countItems, $row2['ID_METODE']);
  $sheet->setCellValue('G' . $countItems, $row2['ID_GAME']);
  $sheet->setCellValue('H' . $countItems, $row2['NAMA_ITEM']);
  $sheet->setCellValue('I' . $countItems, $row2['VALUE_ITEM']);
  $sheet->setCellValue('J' . $countItems, $row2['HARGA_ITEM']);
  $countItems++;
}

// Tabel metode_pembayaran
$queryMetodeBayar = mysqli_query($conn, "select * from metode_pembayaran");
$countMetodeBayar = 2;
while ($row3 = mysqli_fetch_array($queryItem)) {
  $sheet->setCellValue('L' . $countMetodeBayar, $row3['ID_METODE']);
  $sheet->setCellValue('M' . $countMetodeBayar, $row3['NAMA_METODE']);
  $countMetodeBayar++;
}

// Tabel VOUCHER
$queryVoucher = mysqli_query($conn, "select * from voucher");
$countVoucher = 2;
while ($row4 = mysqli_fetch_array($queryItem)) {
  $sheet->setCellValue('O' . $countVoucher, $row4['ID_VOUCHER']);
  $sheet->setCellValue('P' . $countVoucher, $row4['ID_ITEM']);
  $sheet->setCellValue('Q' . $countVoucher, $row4['NAMA_VOUCHER']);
  $sheet->setCellValue('R' . $countVoucher, $row4['DESKRIPSI_VOUCHER']);
  $countMetodeBayar++;
}

$writer = new Xlsx($spreadsheet);
$writer->save('Report Database.xlsx');
