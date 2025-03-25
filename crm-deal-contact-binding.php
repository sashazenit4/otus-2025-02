<?php

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

use Bitrix\Main\Loader;

if (!Loader::includeModule('crm')) {
    return;
}

$deal = new \CCrmDeal;

$dealFields = [
//    'COMPANY_ID' => 1,
//    'CONTACT_ID' => 12, // Привязка одного контакта
//    'CONTACT_IDS' => [1, 2, 3], // Привязканескольких контактов . Первый контакт будет сохранен как основной    контактов . Позволяет в явном виде задать основной
//    'CONTACT_ID' => 1,
//    'SORT' => 10,
    'ROLE_ID' => 0,
    'IS_PRIMARY' => 'Y',
    'CONTACT_BINDINGS' => [ // Привязка нескольких
        [
            'CONTACT_ID' => 9,
            'SORT' => 10,
        ],
        [
            'CONTACT_ID' => 3,
            'SORT' => 20,
        ],
    ]
];

$newDealId = $deal->Add($dealFields);

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
