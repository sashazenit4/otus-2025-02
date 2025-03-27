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

$materialTypesEntityClass::delete(4);

echo sprintf('Удален элемент HL блока Типы материалов с ID = %d', 4);

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
