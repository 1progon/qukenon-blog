<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Нет доступа');
}

function errorInfo($err, $detail)
{
    echo json_encode(
        [
            'error' => $err,
            'errorDetail' => $detail
        ]
    );

    exit();
}

$isset = isset($_POST['login'], $_POST['email'], $_POST['phone'], $_POST['password'], $_POST['password_2'], $_POST['birthdate'], $_POST['steam_login'], $_POST['steam_trade_link']);

if (!$isset) {
    exit('Не все параметры переданы с формой');
}

if ($_POST['password'] !== $_POST['password_2']) {
    errorInfo('Пароли', 'Пароли не сходятся');
}

$filePath = dirname(__DIR__) . '/Resources/Free-users/' . $_POST['email'] . '.json';

if (file_exists($filePath)) {
    errorInfo('Регистрация', 'Пользователь уже зарегистрирован. Попробуйте войти');
}

$data = json_encode($_POST, JSON_UNESCAPED_UNICODE);


//save user
$isSaved = file_put_contents($filePath, $data, LOCK_EX);

if (!$isSaved) {
    errorInfo('Сохранение', 'Проблемы сохранения пользователя');
}


function messageTemplate($userData)
{
    $printR = print_r($userData, true);
    return <<<EOD
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Message free-skins</title>
</head>
<body>

<div>
    <div>
        Регистрация пользователя в программе free skins Qukenon.ru
    </div>
    <div>
        <pre>
        {$printR}
        </pre>
    </div>
</div>
</body>
</html>
EOD;
}

mail(
    'asbo@mail.ru',
    'Регистрация пользователя free-skins ' . $_POST['login'],
    messageTemplate($_POST),
    [
        'From' => 'free_skins_bot@qukenon.ru',
        'Content-type' => 'text/html; charset=utf-8',
    ]
);


$res = file_get_contents($filePath);

exit($res);