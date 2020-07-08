<?php


require_once dirname(__DIR__) . '/vendor/autoload.php';

use GuzzleHttp\Client;

$host = 'https://money.yandex.ru';
$token = file_get_contents(ABS_PATH . 'Resources/Users/anton.txt');

$client = new Client(['base_uri' => $host]);

$res = $client->post(
    '/api/account-info',
    [
        'headers' => [
            'Content-type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Bearer ' . $token
        ]
    ]
);


$account = json_decode($res->getBody()->getContents(), true);

echo '<pre>';
var_dump($account);
echo '</pre>';
