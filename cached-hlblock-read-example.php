<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;

if (!Loader::includeModule('highloadblock')) {
    return;
}
$connection = Application::getConnection();

$connection->startTracker();

$materialTypesHlBlock = HL\HighloadBlockTable::getList([
    'filter' => [
        'NAME' => 'MaterialTypes',
    ],
    'cache' => [
        'ttl' => 36000,
    ],
])->fetch();
$materialTypesEntity = HL\HighloadBlockTable::compileEntity($materialTypesHlBlock);
$materialTypesEntityClass = $materialTypesEntity->getDataClass();

$rawMaterialTypes = $materialTypesEntityClass::getList([
    'select' => [
        'UF_NAME',
        'ID',
        'UF_XML_ID',
    ],
    'cache' => [
        'ttl' => 36000,
    ],
])->fetchAll();
$connection->stopTracker();
$tracker = $connection->getTracker();
echo 'Выполненные запросы: <br>';
dump($tracker->getQueries());

echo 'Элементы HL-блока Типы материалов: <br>';
foreach ($rawMaterialTypes as $rawMaterialType) {
    dump($rawMaterialType);
}

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
