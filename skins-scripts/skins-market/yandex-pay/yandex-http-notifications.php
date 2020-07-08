<?php

//session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Нет доступа');
}

if (!isset($_POST['operation_id'])) {
    exit('Нет доступа');
}

$secret = 'Knqol4ebVzWKgYnqHv5bjZPW';

$shaString = 'notification_type&operation_id&amount&currency&datetime&sender&codepro&notification_secret&label';

$arrFields = explode('&', $shaString);

$checkString = [];
foreach ($arrFields as $value) {
    if ($value === 'notification_secret') {
        $checkString[] = $secret;
        continue;
    }
    $checkString[] = $_POST[$value];
}

$hash = sha1(implode('&', $checkString));

if ($hash !== $_POST['sha1_hash']) {
    exit('Ошибка проверки хеш данных');
}

$_POST['label_exploded'] = explode('::', $_POST['label']);


$filePath = dirname(__DIR__) . '/Resources/Notifications/' . $_POST['operation_id'] . '.json';


$data = json_encode($_POST);

$isSaved = file_put_contents($filePath, $data, LOCK_EX);
if ($isSaved === false) {
    //save error
    exit('Данные не сохранены');
}

exit('Данные сохранены');
