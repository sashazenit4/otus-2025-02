<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

use Bitrix\Main\Loader;
use Bitrix\Crm\Service\Container;

if (!Loader::includeModule('crm')) {
    return;
}

$dealFields = [
    'TITLE' => 'Обновленная Тестовая сделка Старое ядро',
];

$newDealModel = new \CCrmDeal();
$newDealId = $newDealModel->Update(13, $dealFields);

echo 'ID обновленной сделки: ' . 13 . '<br>';

$dealFactory = Container::getInstance()->getFactory(\CCrmOwnerType::Deal);
$existedDealId = 14;
$dealItem = $dealFactory->getItem($existedDealId);
$dealItem->set('TITLE', 'Обновленная тестовая сделка D7');
$dealItem->set('OPPORTUNITY', 2);
//$newDealItem->save(); # Выполнит сохранение сразу без проверки
$dealUpdateOperation = $dealFactory->getUpdateOperation($dealItem);
$updateResult = $dealUpdateOperation->launch();

echo 'ID обновленной сделки D7: ' . $updateResult->getId() . '<br>';

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
