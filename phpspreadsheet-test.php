<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$spreadsheet = new Spreadsheet();
$writer = new Xlsx($spreadsheet);
dump($writer);
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
