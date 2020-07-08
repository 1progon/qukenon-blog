<?php

session_start();

$check = isset($_GET['username'], $_GET['order_id'], $_GET['formToken']);
if (!$check) {
    exit('Что-то пошло не так!');
}

if (!isset($_SERVER['HTTP_REFERER'])) {
    exit('Что-то пошло не так!');
}

$_GET['session_name'] = session_name();
$_GET['session_id'] = session_id();
$_GET['timestamp'] = time();

if (!isset($_SESSION['username'])) {
    $_GET['errors'][] = 'WARNING! Session not isset';
    $_SESSION['username'] = '';
}


if ($_SESSION['username'] !== $_GET['username']) {
    $_GET['errors'][] = 'DANGER! Session username not equal GET username';
}

if ($_GET['formToken'] !== $_SESSION['formToken']) {
    $_GET['errors'][] = 'DANGER! Form tokens not equal';
}


$_GET['yandexStatus'] = 'success';
$_GET['Referer'] = $_SERVER['HTTP_REFERER'];

$data = json_encode($_GET, JSON_UNESCAPED_UNICODE);

file_put_contents(
    dirname(
        __DIR__
    ) . '/Resources/Orders/success_order_' . $_GET['username'] . '_' . $_GET['order_id'] . '.json',
    $data,
    LOCK_EX
);

?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    #timerBlock {
        display: flex;
        flex-wrap: wrap;
        align-content: center;
        position: relative;
        background-color: #f5f5f5;
        border-radius: 3px;
        padding: 50px;
        max-width: 350px;
        height: auto;
        font-size: 20px;
        font-weight: 700;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        justify-content: center;
    }

    #timerText {
        color: #2a932a;
    }

    #timerSeconds {
        color: red;
        font-size: 25px;
    }
</style>
<div id="timerBlock">
    <div id="timerText"></div>
    <div id="timerSeconds"></div>
</div>


<script>
    let seconds = 5;

    function delay(seconds) {
        document.getElementById('timerText').textContent = 'Платёж прошёл успешно! Страница закроется через:';
        document.getElementById('timerSeconds').textContent = seconds;

        seconds--;

        let timer = setTimeout(delay, 1000, seconds);

        if (seconds < 0) {
            clearTimeout(timer);
            window.close();
        }
    }

    delay(seconds);
</script>