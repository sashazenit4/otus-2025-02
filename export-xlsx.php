<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
/**
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle('Пример экспорта в эксель');
$APPLICATION->IncludeComponent('otus:book.grid', '');

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
