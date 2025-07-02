<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

use Bitrix\Main\Web\Json;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$token = $_ENV['DADATA_API_TOKEN'];

if (empty($token)) {
    return;
}

$query = 'Москва, Болотная площадь';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json',
    "Authorization: Token $token"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, Json::encode([
    'query' => $query,
    'count' => 20,
]));

curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Таймаут в секундах
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Проверка SSL

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Ошибка запроса: ' . curl_error($ch);
} else {
    dump(Json::decode($response));
}

curl_close($ch);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
