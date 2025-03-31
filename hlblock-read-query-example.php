<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Entity\Query;

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

$q = new Query($materialTypesEntityClass);
$q->setSelect(['*']);
$q->setLimit(1);
$q->registerRuntimeField(
    'RAND', [
        'data_type' => 'float',
        'expression' => [
            'RAND()',
        ]
    ],
);
$q->setOrder('RAND', 'ASC');
$result = $q->exec();
while ($arItem = $result->Fetch()) {
    dump($arItem);
}

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
