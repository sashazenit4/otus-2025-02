<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

use Bitrix\Main\Application;

$taggedCache = Application::getInstance()->getTaggedCache(); // Служба пометки кеша тегами
$myTag = 'my_awesome_tag';

$taggedCache->clearByTag($myTag);
echo 'Сброшен тег ' . $myTag;
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
