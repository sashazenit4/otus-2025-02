<?php
if (file_exists(__DIR__ . '/../../vendor/autoload.php')) {
    require_once __DIR__ . '/../../vendor/autoload.php';
}
if (file_exists(__DIR__ . '/src/autoloader.php')) {
    require_once __DIR__ . '/src/autoloader.php';
}
if (file_exists(__DIR__ . '/events.php')) {
    require_once __DIR__ . '/events.php';
}
\Bitrix\Main\UI\Extension::load([
//    'aholin_crmcustomtab.useless_extensions.greeting-message',
//    'dev_helper.log_events',
//    'ajax.all_ajax_handler',
//    'otus_crm.negative_currency',
    'homework.begin_date_button',
]);
