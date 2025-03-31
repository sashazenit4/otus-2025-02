<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Config\Option;

if (!Loader::includeModule('highloadblock')) {
    return;
}

$materialTypesHlBlock = HL\HighloadBlockTable::getList([
    'filter' => [
        'NAME' => 'MaterialTypes',
    ],
])->fetch();
$materialTypesEntity = HL\HighloadBlockTable::compileEntity($materialTypesHlBlock);
$materialTypesEntityClass = $materialTypesEntity->getDataClass();

$newMaterialTypeElementFields = [
    'UF_NAME' => 'Олово',
    'UF_XML_ID' => 'TIN',
];

$resultAdd = $materialTypesEntityClass::add($newMaterialTypeElementFields);

echo sprintf('Создан элемент HL блока Типы материалов с ID = %d', $resultAdd->getId());

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
