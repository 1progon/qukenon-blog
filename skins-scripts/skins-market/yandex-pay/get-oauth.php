<?php

require_once './headers.php';


$scope = 'account-info money-source("wallet","card") payment.to-account("410013387397696")';

$paymentSum = 150;
$scope .= '.limit(30,' . $paymentSum . ')';

//получение временного кода и получение прав
$res = $client->post(
    '/oauth/authorize',
    [
        'form_params' => [
            'client_id' => $clientId,
            'response_type' => 'code',
            'redirect_uri' => $redirectUti,
            'scope' => $scope
        ],
        'headers' => [
            'Content-type' => 'application/x-www-form-urlencoded'
        ],
        'allow_redirects' => false
    ]
);


$locationRedirect = $res->getHeaderLine('Location');

//redirect to yandex for get Code (first check token)
header('Location: ' . $locationRedirect);

exit();