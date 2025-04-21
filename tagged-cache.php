<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

use \Bitrix\Main\Data\Cache;
use \Bitrix\Main\Application;

$cache = Cache::createInstance(); // Служба кеширования
$taggedCache = Application::getInstance()->getTaggedCache(); // Служба пометки кеша тегами
//необходим одинаковый путь в $cache->initCache() и $taggedCache->startTagCache()
$cachePath = 'myCachePath';
$myTag = 'my_awesome_tag';
$cacheTime = 3600;
$cacheId = $_REQUEST['CACHE_ID'];
if ($cache->initCache($cacheTime, $cacheId, $cachePath)) {
    $vars = $cache->getVars();
    dump($vars);
} else {
    echo 'Происходит запись кэша';
}

if ($cache->startDataCache()) {
    $taggedCache->startTagCache($cachePath);
    $vars = [
        'date' => date('r'),
        'rand' => rand(0, 9999), // Если данные закешированы - число не будет меняться
    ];
    $taggedCache->registerTag($myTag); // Добавляем теги
    $cacheInvalid = false; // Если что-то пошло не так и решили кеш не записывать
    if ($cacheInvalid) {
        $taggedCache->abortTagCache();
        $cache->abortDataCache();
    }

    $taggedCache->endTagCache();
    $cache->endDataCache($vars);
}

//$taggedCache->clearByTag($myTag); //сброс
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
