<?php
defined("CONTENT_ACCESS") or die("У Вас нет доступа к этой странице");
?>
<link rel="stylesheet" href="/free-skins/freeSkinsGetFromDb.css">
<script src="/free-skins/freeSkins.js"></script>

<center id="topper">
    <div id="getFreeSkins" class="fs25 p20"><img alt="" src="/free-skins/tail-spin.svg" /> Смотреть скины, которые можно
        получить бесплатно, подождите пожалуйста......</div>
    <br />
    <div id="buttonBlock">
        <button id="getFreeSkinsButton" style="background-color: #676767" type="button" disabled="disabled">Показать скины!</button>
    </div>

    <div id="skinsForm" class="fs25 p20" data-skin-token></div>
    <div id="skinsFormImages" class="p20"></div>
</center>

<script>
    $.ajax({
            url: "/free-skins/csrf.php",
            data: {
                get: true
            },
            method: 'POST',
            dataType: 'json',
        })
        .done(token => document.getElementById("skinsForm").dataset.skinToken = token.tokenCsrf)
        .fail(err => console.error("Error: ", err.responseText, " ", err.statusText, " ", err.status))
</script>
