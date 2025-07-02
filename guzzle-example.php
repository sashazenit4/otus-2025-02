<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Bitrix\Main\Web\Json;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$token = $_ENV['DADATA_API_TOKEN'];

$query = 'Москва, Болотниковская улица';

$client = new Client([
    'base_uri' => 'https://suggestions.dadata.ru/',
    'timeout' => 5.0,
    'verify' => true, // Проверка SSL
]);

try {
    $response = $client->post('suggestions/api/4_1/rs/suggest/address', [
        'headers' => [
            'Authorization' => "Token $token",
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'query' => $query
        ],
    ]);

    $body = $response->getBody();
    dump(Json::decode($body->getContents()));
} catch (RequestException $e) {
    echo 'Ошибка запроса: ' . $e->getMessage();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
