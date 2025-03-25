<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

use Bitrix\Main\Loader;
use Bitrix\Crm\Service\Container;
use Bitrix\Crm\DealTable;

if (!Loader::includeModule('crm')) {
    return;
}

//$existedDealId = 13;
//$newDealModel = new \CCrmDeal();
//$newDealModel->Delete($existedDealId);
//
//echo 'Сделка удалена<br>';
//
//$dealFactory = Container::getInstance()->getFactory(\CCrmOwnerType::Deal);
//$existedDealId = 14;
//$dealItem = $dealFactory->getItem($existedDealId);
//# $dealItem->delete();
//# $newDealItem->save(); Выполнит сохранение сразу без проверки прав доступа и без запуска обработчиков событий
//$dealUpdateOperation =
//    $dealFactory->getDeleteOperation($dealItem);
//$deleteResult = $dealUpdateOperation->launch();
//
//echo 'Сделка удалена: ' . $existedDealId . '<br>';

$existedDealId = 6;
DealTable::delete($existedDealId);

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
