<?php


require_once __DIR__ . '/headers.php';

$paymentType = 'account'; // or 'shop'
$paymentTo = '410013387397696';

$patternId = '';
$amount = null;
$label = 'myLabel';

$token = file_get_contents(dirname(__DIR__) . '/Resources/Users/anton.txt');


if ($paymentType === 'account') {
    $patternId = 'p2p';
}

$res = $client->post(
    '/api/request-payment',
    [
        'form_params' => [
            'pattern_id' => $patternId,
            'to' => $paymentTo,
            'amount' => $_GET['amount'],
            'comment' => $_GET['comment'],
            'message' => $_GET['message'],
            'label' => $label
        ],
        'headers' => [
            'Authorization' => 'Bearer ' . $token
        ]
    ]
);
print_r(($res->getBody()->getContents()));



