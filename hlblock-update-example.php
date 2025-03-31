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
    'UF_NAME' => 'Золото',
    'UF_XML_ID' => 'gold',
];

$resultUpdate = $materialTypesEntityClass::update(4, $newMaterialTypeElementFields);

echo sprintf('Обновлен элемент HL блока Типы материалов с ID = %d', $resultUpdate->getId());

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
