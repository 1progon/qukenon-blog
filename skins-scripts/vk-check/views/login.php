<h2>Войти в систему</h2>
<form id="user-form">
    <input type="hidden" name="type" id="type" value="login">

    <div class="row">
        <label for="login">Логин</label>
        <input type="text" name="login" id="login" autofocus>
    </div>

    <div class="row">
        <label for="password">Пароль</label>
        <input type="password" name="password" id="password">
    </div>

    <div class="row">
        <div class="infoBlock infoBlockRed" style="display:none;"></div>
    </div>

    <div class="row">
        <div id="loader" class="hide">
            <img src="/vk-check/resources/assets/spinner.svg"
                 alt="ожидаение загрузки материалов, нужно ждать"
                 width="24" height="24">
        </div>
    </div>

    <div class="row mt20">
        <input id="submitBtn" type="submit" class="btn-btn btn-green">
    </div>


    <div class="row mt40">
        <a href="" class="btn-btn btn-grey">Вернуться</a>
    </div>


</form>

