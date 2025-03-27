<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

use Bitrix\Main\Loader;
use Bitrix\Crm\Service\Container;

if (!Loader::includeModule('crm')) {
    return;
}

$dealFields = [
    'TITLE' => 'Тестовая сделка Старое ядро',
];

$newDealModel = new \CCrmDeal();
//$newDealId = $newDealModel->Add($dealFields);

//echo 'ID новой сделки: ' . $newDealId . PHP_EOL;

//$result = \Bitrix\Crm\LeadTable::add($dealFields);

$dealFactory = Container::getInstance()->getFactory(\CCrmOwnerType::Deal);
$newDealItem = $dealFactory->createItem();
$newDealItem->set('TITLE', 'Тестовая сделка D7');
$newDealItem->set('OPPORTUNITY', 10000);
//$newDealItem->save(); # Выполнит сохранение сразу без проверки
$dealAddOperation = $dealFactory->getAddOperation($newDealItem);
$addResult = $dealAddOperation->launch();

echo 'ID новой сделки D7: ' . $addResult->getId() . PHP_EOL;

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
