<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

use Bitrix\Main\Web\HttpClient;
use Bitrix\Main\Web\Json;
use Bitrix\Main\Web\Uri;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$token = $_ENV['DADATA_API_TOKEN'];

//$urlToParse = new Uri('https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address');
//dump([
//    'host' => $urlToParse->getHost(),
//    'path' => $urlToParse->getPath(),
//    'query' => $urlToParse->getQuery(),
//]);
//$urlToParse->addParams([
//    'q' => 'test',
//    'd' => 'test2',
//]);
//dump([
//    'query' => $urlToParse->getQuery(),
//]);

$query = 'Москва, Проспект мира';

$httpClient = new HttpClient([
    'socketTimeout' => 5, // Таймаут сокета
    'streamTimeout' => 5, // Таймаут потока
    'redirect' => true,   // Следовать за редиректами
    'disableSslVerification' => false, // Проверка SSL
]);

$httpClient->setHeader('Content-Type', 'application/json', true);
$httpClient->setHeader('Accept', 'application/json', true);
$httpClient->setHeader('Authorization', 'Token ' . $token, true);

$url = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address';
$response = $httpClient->post($url, Json::encode(['query' => $query]));

if ($httpClient->getStatus() == 200) {
    dump(Json::decode($response));
} else {
    echo 'Ошибка: ' . $httpClient->getStatus() . ' - ' . Json::encode($httpClient->getError());
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
