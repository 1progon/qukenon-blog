<?php

require_once __DIR__ . '/headers.php';

//получение токена
if (isset($_GET['code'])) {
    //yandex auth request


    $login = 'anton';
    $res = $client->post(
        '/oauth/token',
        [
            'form_params' => [
                'code' => $_GET['code'],
                'client_id' => $clientId,
                'grant_type' => 'authorization_code',
                'redirect_uri' => $redirectUti,
                'client_secret' => $clientSecret
            ],
            'headers' => [
                'Content-type' => 'application/x-www-form-urlencoded'
            ]
        ]
    );

    $token = json_decode($res->getBody()->getContents(), true);

    $isSaved = file_put_contents(
        dirname(__DIR__) . '/Resources/Users/' . $login . '.txt',
        $token['access_token'],
        LOCK_EX
    );

    if ($isSaved = false) {
        exit('Ошибка сохранения');
    }

    header('Location: oauth.php');
    exit();
}

exit();




//var_dump($locationRedirect);
//echo '<pre>';
//var_dump($res->getHeaderLine('Location'));
//echo '</pre>';








