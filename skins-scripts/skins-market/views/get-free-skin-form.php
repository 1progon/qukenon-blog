<div id="dataResult-free-skins">
    <form id="free-skins-form" method="post" action="">

        <div class="rows">
            <label for="">Регистрация заявки</label>
            <label for=""><span style="color: red">*</span> - обязательные поля</label>
        </div>

        <div class="delimiter"></div>

        <div class="rows">
            <label for="login" class="required">Логин</label>
            <input type="text" name="login" id="login" autofocus pattern="\w{4,}"
                   title="Минимум 4 знака. Допускается 'a-z','0-9','_'"
                   placeholder="Допускается 'a-z','0-9','_'. Мин.4 символа"
                   minlength="4"
                   autocomplete="on"
                   required>
        </div>


        <div class="rows">
            <label for="password" class="required">Пароль</label>
            <input type="password" name="password" id="password" required minlength="5" autocomplete="on">
        </div>

        <div class="rows">
            <label for="password2" class="required">Повтор пароля</label>
            <input type="password" name="password_2" id="password2" required minlength="5" autocomplete="off">
        </div>

        <div class="rows">
            <label for="email" class="required">Email</label>
            <input type="text" name="email" id="email" required inputmode="email" pattern=".*@.*\..*" title="Укажите
            полноценный адрес эл. почты, например pochta_1990@mail.ru"
                   placeholder="Пример: sasha_1980@mail.com" autocomplete="on">
        </div>


        <div class="rows">
            <label for="phone" class="required">Телефон</label>
            <input type="text" name="phone" id="phone" inputmode="tel" required pattern="\d{1,24}"
                   placeholder="Пример: 79008005577" title="Только цифры без пробелов" autocomplete="off">
        </div>

        <div class="delimiter"></div>

        <div class="rows">
            <label for="firstname" class="required">Ваше имя</label>
            <input type="text" name="firstname" id="firstname" required>
        </div>

        <div class="rows">
            <label for="lastname" class="required">Ваша фамилия</label>
            <input type="text" name="lastname" id="lastname" required>
        </div>

        <div class="rows">
            <label for="gender" class="required">Ваш пол</label>
            <select name="gender" id="gender" required>
                <option value="0">Женский</option>
                <option value="1">Мужской</option>
            </select>
        </div>

        <div class="rows">
            <label for="birthdate" class="required">Дата рождения</label>
            <input type="date" name="birthdate" id="birthdate" required>
        </div>

        <div class="delimiter"></div>

        <div class="rows">
            <label for="steam-login" class="required">Логин в Steam</label>
            <input type="text" name="steam_login" id="steam-login" required>
        </div>

        <div class="rows">
            <label for="steam-trade-link" class="required">Торговая ссылка в Steam</label>
            <input type="text" name="steam_trade_link" id="steam-trade-link" required>
        </div>

        <div class="delimiter"></div>

        <div class="rows">
            <label for="csgo-hours" class="required">Часов в КС ГО</label>
            <input type="text" name="csgo_hours" id="csgo-hours" placeholder="Пример: 125 часов наиграл" required>
        </div>

        <div class="rows">
            <label for="first-skin" class="required">Ваш первый скин</label>
            <input type="text" name="first_skin" id="first-skin" required>
        </div>

        <div class="rows">
            <label for="need-skin" class="required">Скин, который хотите получить</label>
            <input type="text" name="need_skin" id="need-skin" required>
        </div>


        <div class="rows">
            <label for="wish-skin" class="required">Скин, о котором мечтаете</label>
            <input type="text" name="wish_skin" id="wish-skin" required>
        </div>


        <div class="rows" style="justify-content: flex-end">
            <input type="submit" name="submit" id="submit-button" value="Отправить">
        </div>


    </form>

    <div id="errorResponseBlock" class="hide">
        <div id="errorResponse"></div>
        <div id="errorResponseClose">X</div>
    </div>
</div>