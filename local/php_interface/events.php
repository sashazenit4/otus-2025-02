<?php
$eventManager = \Bitrix\Main\EventManager::getInstance();

$eventManager->addEventHandler('', 'MaterialTypesOnBeforeAdd', [
    '\Otus\Hlblock\Handlers\Element',
    'onBeforeAddHandler',
]);
