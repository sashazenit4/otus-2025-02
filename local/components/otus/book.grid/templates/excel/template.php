<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

// Установка лимитов памяти и времени выполнения
ini_set('memory_limit', '2048M');
set_time_limit(0);

// Отключение буферизации вывода
while (ob_get_level()) {
    ob_end_clean();
}

// Создание документа
$spreadSheet = new Spreadsheet();

// Оптимизация производительности
$spreadSheet->getProperties()
    ->setCreator("Your System")
    ->setLastModifiedBy("Your System");
$spreadSheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);
$spreadSheet->setActiveSheetIndex(0);
$activeSheet = $spreadSheet->getActiveSheet();

// Отключение автоматических расчетов
$spreadSheet->getCalculationEngine()->disableCalculationCache();
$spreadSheet->getCalculationEngine()->clearCalculationCache();

// Заголовки
$column = 'A';
foreach ($arResult['HEADERS'] as $value) {
    $activeSheet->setCellValueExplicit($column.'1', $value['name'], DataType::TYPE_STRING);
    $column++;
}

// Стили для заголовков
$headersStyleArray = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => '444444'],
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
        'wrapText' => true,
    ],
];
$activeSheet->getStyle('A1:' . $column . '1')->applyFromArray($headersStyleArray);

// Обработка данных по чанкам
$chunkSize = 5000; // Размер чанка
$row = 2;
$totalRows = count($arResult['GRID_LIST']);
$processed = 0;

while ($processed < $totalRows) {
    $chunk = array_slice($arResult['GRID_LIST'], $processed, $chunkSize);

    foreach ($chunk as $value) {
        $column = 'A';
        foreach ($value['data'] as $itemText) {
            // Используем setCellValueExplicit для оптимизации
            $activeSheet->setCellValueExplicit($column.$row, $itemText, DataType::TYPE_STRING);
            $column++;
        }
        $row++;
    }

    $processed += count($chunk);
    // Освобождаем память после обработки каждого чанка
    unset($chunk);
    gc_collect_cycles();
}

// Автоподбор ширины столбцов только для первых 100 строк (для примера)
for ($col = 'A'; $col <= $column; $col++) {
    $activeSheet->getColumnDimension($col)->setAutoSize(true);
    // Или фиксированная ширина для очень больших файлов
    // $activeSheet->getColumnDimension($col)->setWidth(20);
}

// Отправка заголовков
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="report_'.date('Y-m-d').'.xlsx"');
header('Cache-Control: max-age=0');

// Потоковая запись в вывод
$writer = new Xlsx($spreadSheet);
$writer->save('php://output');

// Освобождение памяти
unset($spreadSheet, $writer);
die();
