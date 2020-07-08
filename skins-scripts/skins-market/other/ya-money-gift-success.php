<?php

session_start();

if(!isset($_SERVER['HTTP_REFERER'])) {
    exit('Нет доступа');
}
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
    let seconds = 50;

    function delay(seconds) {
        let text = 'Платёж прошёл успешно!<br /><br />Спасибо огромное Вам за ' +
            'поддержку игрового проекта Qukenon.<br /><br />Мы будем стараться обновлять контент чаще, добавляйте наш проект в ' +
            'избранное!<br /><br />Страница закроется через:';

        document.getElementById('timerText').innerHTML = text;
        document.getElementById('timerSeconds').innerHTML = seconds;

        seconds--;

        let timer = setTimeout(delay, 1000, seconds);

        if (seconds < 0) {
            clearTimeout(timer);
            window.close();
        }
    }

    delay(seconds);
</script>