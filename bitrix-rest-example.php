<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Bitrix\Main\Web\Json;

$url = 'https://otus-b24-course.bitrix24.ru/rest/1/bf6q2wahx5k4g3i3/crm.deal.list.json';

$client = new Client([
    'base_uri' => 'https://otus-b24-course.bitrix24.ru/',
    'timeout' => 5.0,
    'verify' => true, // Проверка SSL
]);

try {
    $response = $client->post('rest/1/bf6q2wahx5k4g3i3/crm.deal.list.json', [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'filter' => [
                'OPPORTUNITY' => 100,
            ],
        ],
    ]);

    $body = $response->getBody();
    dump(Json::decode($body->getContents()));
} catch (RequestException $e) {
    echo 'Ошибка запроса: ' . $e->getMessage();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
