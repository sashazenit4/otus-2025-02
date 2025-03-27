<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

use Bitrix\Main\Loader;
use Bitrix\Crm\Service\Container;

if (!Loader::includeModule('crm')) {
    return;
}

$rawLeads = \Bitrix\Crm\LeadTable::getList([
    'select' => [
        'ID',
        'TITLE',
        'UF_CRM_LEAD_TEST_STRING',
    ],
])->fetchAll();

foreach ($rawLeads as $lead) {
    dump($lead);
}

echo 'Выше был пример работы с ORM версией CRM d7' . PHP_EOL;

$leadOrder = [
    'TITLE' => 'ASC',
];
$leadFilterFields = [];
$leadGroupBy = false;
$leadNavStartParams = false;
$leadSelectFields = [
    'ID',
    'TITLE',
    'UF_CRM_LEAD_TEST_STRING',
];
$rawleadList = \CCrmLead::GetListEx(
    $leadOrder,
    $leadFilterFields,
    $leadGroupBy,
    $leadNavStartParams,
    $leadSelectFields
);

while ($lead = $rawleadList->fetch()) {
    dump($lead);
}

echo 'Выше был пример работы со старой версией ядра CRM' . PHP_EOL;

$leadOrder = [
    'TITLE' => 'ASC',
];
$leadFilterFields = [];
$leadGroupBy = [];
$leadSelectFields = [
    'ID',
    'TITLE',
    'UF_CRM_LEAD_TEST_STRING',
];
$leadFactory = Container::getInstance()->getFactory(\CCrmOwnerType::Lead);

$leadItems = $leadFactory->getItems([
    'filter' => $leadFilterFields,
    'order' => $leadOrder,
    'select' => $leadSelectFields,
    'group' => $leadGroupBy,
]);

foreach ($leadItems as $leadItem) {
    dump($leadItem->getData());
}

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
