<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

use Bitrix\Main\Loader;

if (!Loader::includeModule('crm')) {
    return;
}

$phone = '+79999999999';
$contactFields = [
    'NAME' => 'Александр',
    'LAST_NAME' => 'Холин',
];
$contactsModel = new \CCrmContact;
$newContactId = $contactsModel->Add($contactFields);

$cont = [
    'ENTITY_ID' => 'CONTACT', // Тип сущности - контакт
    'ELEMENT_ID' => $newContactId, // ID Контакта
    'TYPE_ID' => 'PHONE',
    'VALUE_TYPE' => 'WORK',
    'VALUE' => $phone // Номер телефона
];
$multi = new \CCrmFieldMulti();
$multi->Add($cont);
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
