<?php

require_once './vendor/autoload.php';

use App\Models\User\Classes\Database;
use App\Models\User\Classes\UsersController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userData = $_POST;
    $infoErrors = [];
    $userCtrl = new UsersController(new Database());


    function exitError(string $error, string $errorDetail)
    {
        $res = json_encode(
            [
                'jsonStatus' => 'error',
                'error' => $error,
                'errorDetail' => $errorDetail
            ]
        );
        exit($res);
    }


    if (!isset($userData['type'])) {
        exitError('Обработчик', 'Ошибка в форме ввода данных, попробуйте ещё раз');
    }


    if (!isset($userData['login'])) {
        exitError('Логин', 'Проверьте введённый логин');
    }


    if ((!isset($userData['token']) || empty($userData['token'])) && $userData['type'] === 'loginToken') {
        $userCtrl->invalidateToken($userData['login']);
        exitError('Токен', 'Ошибка, попробуйте перезайти в аккаунт');
    }


    $login = htmlspecialchars($userData['login']);
    $handleType = $userData['type'];
    unset($userData['type']);
    $isUserExist = $userCtrl->isExistLogin($login);


    if (isset($userData['password'])) {
        $password = $userData['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }

    if (!$isUserExist) {
        if ($handleType === 'login' || $handleType === 'loginToken') {
            exitError('Вход', 'Чтобы войти, нужно сначала зарегистрироваться');
        }


        $isEqualPasswords = $password === $userData['password_2'];

        if (!$isEqualPasswords) {
            exitError('Пароль', 'Пароли не сходятся');
        }

        unset($userData['password_2']);

        $userData['password'] = $hashedPassword;

        $userData['liked_tech'] = implode(', ', $userData['liked_tech']);
        $userData['engagement'] = implode(', ', $userData['engagement']);


        $userData['phone'] = preg_replace('/\D/i', '', $userData['phone']);

        if (empty($userData['phone'])) {
            exitError('Телефон', 'Введенный номер телефона ' . $userData['phone'] . ', ошибка формата');
        }


        $token = $userCtrl->generateToken();

        $userData['token'] = $token['token'];
        $userData['token_expire'] = $token['expire'];


        if ($userCtrl->saveUser($userData)) {
            $infoErrors[] = 'Saved user success';


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
    <title>Message vk-check</title>
</head>
<body>

<div>
    <div>
        Регистрация пользователя в программе Vk-check Qukenon.ru
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
                'Регистрация пользователя vk-check ' . $userData['login'],
                messageTemplate($userData),
                [
                    'From' => 'vk_check_bot@qukenon.ru',
                    'Content-type' => 'text/html; charset=utf-8',
                ]
            );
        };
    }

    $infoErrors[] = 'User Exist, go to load';

    $userFromDb = $userCtrl->getUserByLogin($login);

    $infoErrors[] = 'Пользователь из базы данных';

    if ($handleType !== 'loginToken') {
        $checkPass =
            password_verify($password, $userFromDb['password']);

        if (!$checkPass) {
            $userCtrl->invalidateToken($login);
            exitError('Пароль', 'Ошибка в пароле');
        }
    }


    $isTokenEquals = $userData['token'] === $userFromDb['token'];

    if (
        !isset($userFromDb['token'])
        || empty($userFromDb['token'])
        || ($userFromDb['token_expire'] <= time())
        || !$isTokenEquals
    ) {
        $userCtrl->invalidateToken($login);

        if ($handleType !== 'login') {
            exitError('Токен', 'Нужно перезайти в аккаунт, токен истёк');
        }

        $nextToken = $userCtrl->generateToken();

        $isSaved = $userCtrl->saveToken($login, $nextToken['token'], $nextToken['expire']);

        if ($isSaved) {
            $userFromDb = $userCtrl->getUserByLogin($login);
        }
    }


    $infoErrors[] = 'User loaded from db';

    unset($userFromDb['password']);

    $userFromDb['infoErrors'] = $infoErrors;
    $userFromDb['exist'] = $isUserExist;
    $userFromDb['tokenEqual'] = $isTokenEquals;
    $userFromDb['jsonStatus'] = 'success';


    echo json_encode($userFromDb);
    exit();
}

exit('Нет доступа');
