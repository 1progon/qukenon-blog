<?php

session_start();
if (isset($_POST['username']) && isset($_POST['steam_link'])) {
    $_POST['status'] = 'local_created';
    $_POST['timestamp'] = time();
    $_POST['timezone'] = date_default_timezone_get();
    $_POST['date'] = date(DATE_RFC822);

    $_SESSION['username'] = $_POST['username'];

    $userFilePath = dirname(__DIR__) . '/Resources/Users/' . $_POST['username'] . '.json';

    $info = [];

    $userData = json_encode(
        [
            'username' => $_POST['username'],
            'steam_link' => $_POST['steam_link'],

        ]
        ,
        JSON_UNESCAPED_UNICODE
    );

    $res = file_put_contents($userFilePath, $userData, LOCK_EX);

    if ($res) {
        $info['infoErrors'][] = 'User saved (updated)';
    }

    $orderFilePath = dirname(
            __DIR__
        ) . '/Resources/Orders/order_' . $_POST['username'] . '_' . $_POST['order_id'] . '.json';


    $res = file_put_contents($orderFilePath, json_encode($_POST), LOCK_EX);

    if ($res) {
        $info['infoErrors'][] = 'Order saved';
    }


    $info = json_encode($info);

    exit($info);
};