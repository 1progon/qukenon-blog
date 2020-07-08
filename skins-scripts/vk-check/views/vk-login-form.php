<div style="display: flex; flex-direction: column; align-items: center">
    <h2>ВКонтакте вход</h2>
    <form id="vk-login-block-form">
        <div>
            <label for="vk-login"></label>
            <input type="text" name="vk_login" id="vk-login"
                   placeholder="Телефон или email"
                   autocomplete="on"
                   minlength="2"
                   required>
        </div>

        <div>
            <label for="vk-password"></label>
            <input type="password" name="vk_password" id="vk-password"
                   autocomplete="on"
                   placeholder="Пароль"
                   minlength="1"
                   required>
        </div>

        <div style="display:flex; align-items: baseline">
            <div>
                <label for="vk-submit"></label>
                <input type="submit" name="vk_submit" id="vk-submit" value="Войти">
            </div>
            <div>
                <a class="vk-link" href="">Забыли пароль?</a>
            </div>
        </div>

        <div id="vk-result-info-block" class="hide infoBlock"></div>
    </form>
</div>
