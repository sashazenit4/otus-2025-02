<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Config\Option;

if (!Loader::includeModule('highloadblock')) {
    return;
}

$materialTypesHlBlockId = Option::get('otus.options', 'MATERIAL_TYPES_HLBLOCK_ID', 2);
$materialTypesHlBlock = HL\HighloadBlockTable::getList([
    'filter' => [
        'NAME' => 'MaterialTypes',
    ],
])->fetch();
$materialTypesEntity = HL\HighloadBlockTable::compileEntity($materialTypesHlBlock);
$materialTypesEntityClass = $materialTypesEntity->getDataClass();

$rawMaterialTypes = $materialTypesEntityClass::getList([
    'filter' => [
        '%UF_XML_ID' => 'steel',
    ],
    'select' => [
        'UF_NAME',
        'ID',
        'UF_XML_ID',
    ],
])->fetchAll();

foreach ($rawMaterialTypes as $rawMaterialType) {
    dump($rawMaterialType);
}

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
