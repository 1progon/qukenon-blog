<h2>"Живые бонусы"</h2>

<div class="infoBlock infoBlockRed">1 бонус = 1 рубль, бонусная программа для Вас. Регистрируйся</div>

<div id="loginBlock" class="flex flex-row">
    <div style="align-self: center;">Зарегистрированы?</div>
    <div id="loginBtn" class="btn-btn btn-green">Войти</div>
    <img class="hide"
         id="loaderLoginBtn" src="/vk-check/resources/assets/spinner.svg"
         alt="ожидаение загрузки материалов, нужно ждать"
         width="24" height="24">

</div>


<!--<div id="tester" style="color: red;cursor: pointer;font-size: 25px; padding: 10px">Заполнить</div>-->

<form id="user-form" name="user-form">
    <input type="hidden" name="type" id="type" value="register">


    <div class="row">
        <label class="required"> - обязательное поле</label>
    </div>

    <div class="row">
        <label for="login" class="required">Логин</label>
        <input type="text"
               name="login" id="login"
               placeholder="Пример: user_1970"
               pattern="\w{5,}"
               title="Допускаются только буквы и цифры латинского алфавита, а также нижнее подчеркивание '_'. Длина от 5 знаков"
               minlength="5"
               autocomplete="on"
               required>
    </div>

    <div class="row">
        <label for="password-1" class="required">Пароль</label>
        <input type="password" name="password" id="password-1" minlength="5" autocomplete="on" required>
    </div>

    <div class="row">
        <label for="password-2" class="required">Повторите пароль</label>
        <input type="password" name="password_2" id="password-2" autocomplete="on" minlength="5" required>
    </div>

    <div class="row">
        <label for="email" class="required">E-mail</label>
        <input id="email" name="email" type="text" inputmode="email"
               pattern="[\w.-]+@[\w-]+\.[\w-]+(\.[\w-]+)?"
               title="Пример: pochta@mail.com"
               placeholder="Пример: pochta@mail.com"
               autocomplete="on"
               required>
    </div>

    <div class="delimiter"></div>

    <div class="row">
        <label for="username" class="required">Ваше имя</label>
        <input id="username" type="text" name="username" required>
    </div>

    <div class="row">
        <label for="lastname" class="required">Ваша фамилия</label>
        <input id="lastname" type="text" name="lastname" required>
    </div>


    <div class="row">
        <label for="gender" class="required">Ваш пол</label>
        <select name="gender" id="gender" required>
            <option value="">Не установлен</option>
            <option value="1">Мужской</option>
            <option value="0">Женский</option>
        </select>
    </div>

    <div class="row">
        <label for="birthdate" class="required">Дата рождения</label>
        <input id="birthdate" type="date" name="birthdate" required>
    </div>

    <div class="delimiter"></div>

    <div class="row">
        <label for="country" class="required">Страна</label>
        <select name="country" id="country" required>
            <option value="0">Россия</option>
            <option value="1">Украина</option>
            <option value="2">Белоруссия</option>
            <option value="3">Казахстан</option>
            <option value="4">Армения</option>
            <option value="5">Азербайджан</option>
            <option value="6">Киргизия</option>
            <option value="7">Таджикистан</option>
            <option value="8">Узбекистан</option>
        </select>
    </div>

    <div class="row">
        <label for="region" class="required">Регион, район</label>
        <input id="region" type="text" name="region" required>
    </div>

    <div class="row">
        <label for="city" class="required">Город</label>
        <input id="city" type="text" name="city" required>
    </div>

    <div class="row">
        <label for="street" class="required">Улица</label>
        <input type="text" name="street" id="street" required>
    </div>

    <div class="row">
        <label for="house-number" class="required">Номер дома</label>
        <input type="text" name="house_number" id="house-number" required inputmode="numeric" pattern="\d+"
               title="Только цифры номера дома, например: 98">
    </div>

    <div class="row">
        <label for="house-letter">Буква (литер) дома</label>
        <input type="text" name="house_letter" id="house-letter">
    </div>

    <div id="apartment-number-block" class="row">
        <label for="apartment-number" class="required">Номер квартиры</label>
        <input type="text"
               name="apartment_number"
               id="apartment-number"
               inputmode="numeric"
               pattern="\d+"
               maxlength="5"
               title="Только цифры номера квартиры, например 125"
               required>


    </div>
    <div id="apartment-number-checkbox-block" class="checkbox-fields">
        <input type="checkbox"
               name="apartment_number_checkbox"
               id="apartment-number-checkbox"
               value="1">
        <label id="apartment-number-checkbox-label" for="apartment-number-checkbox">Без номера квартиры</label>
    </div>


    <!--    Старт: пасспорт-->
    <div class="delimiter"></div>


    <div class="row">
        <label for="passport-series" class="required">Серия паспорта</label>
        <input type="text" name="passport_series" id="passport-series" inputmode="text" required>
    </div>


    <div class="row">
        <label for="passport-number" class="required">Номер паспорта</label>
        <input type="text" name="passport_number" id="passport-number" inputmode="text" required>
    </div>

    <div class="row">
        <label for="passport-code">Код подразделения</label>
        <input type="text" name="passport_code" id="passport-code">
    </div>

    <div class="row">
        <label for="passport-date" class="required">Дата выдачи</label>
        <input type="date" name="passport_date" id="passport-date" required>
    </div>


    <div class="row">
        <label for="passport-issuer" class="required">Кем выдан</label>
        <input type="text" name="passport_issuer" id="passport-issuer" required>
    </div>
    <!--    Конец: пасспорт-->


    <div class="delimiter"></div>

    <div class="row">
        <label for="work-place">Место работы</label>
        <input type="text" name="work_place" id="work-place">
    </div>

    <div class="row">
        <label for="work-profession">Профессия</label>
        <input type="text" name="work_profession" id="work-profession">
    </div>

    <div class="row">
        <label for="work-years">Стаж по профессии</label>
        <input type="text" name="work_years" id="work-years">
    </div>

    <div class="delimiter"></div>


    <div class="row">
        <label>Вы любите шоколад? А какой?</label>

        <div class="flex flex-column">
            <div class="tech-select">
                <label for="liked-tech-mars">Mars</label>
                <input type="hidden" name="liked_chocolate[]" value="">
                <input type="checkbox" name="liked_chocolate[]" id="liked-tech-mars" value="mars">
            </div>

            <div class="tech-select">
                <label for="liked-tech-snickers">Snickers</label>
                <input type="checkbox" name="liked_chocolate[]" id="liked-tech-snickers" value="snickers">
            </div>

            <div class="tech-select">
                <label for="liked-tech-alpen-gold">Alpen Gold</label>
                <input type="checkbox" name="liked_chocolate[]" id="liked-tech-alpen-gold" value="alpen-gold">
            </div>

            <div class="tech-select">
                <label for="liked-tech-nestle">Nestle</label>
                <input type="checkbox" name="liked_chocolate[]" id="liked-tech-nestle" value="nestle">
            </div>


            <div class="tech-select">
                <label for="liked-tech-milka">Milka</label>
                <input type="checkbox" name="liked_chocolate[]" id="liked-tech-milka" value="milka">
            </div>

            <div class="tech-select">
                <label for="liked-tech-ritter-sport">Ritter Sport</label>
                <input type="checkbox" name="liked_chocolate[]" id="liked-tech-ritter-sport" value="ritter-sport">
            </div>

            <div class="tech-select">
                <!--                <label for="liked-tech-self-choice"></label>-->
                <input type="text" name="liked_chocolate[]" id="liked-tech-self-choice" placeholder="Свой вариант">
            </div>


        </div>


    </div>


    <div class="row">
        <label for="wishes">Ваши желания и пожелания</label>
        <textarea name="wishes" id="wishes" rows="10"></textarea>
    </div>

    <div class="row">
        <label for="vk-profile">Ваш профиль ВК</label>
        <input type="text" name="vk_profile" id="vk-profile">
    </div>

    <div class="row">
        <label for="klassniki-profile">Ваш профиль Одноклассники</label>
        <input type="text" name="klassniki_profile" id="klassniki-profile">
    </div>

    <div id="engagementBlock_0" class="row">
        <label for="engagement_0">Ссылка на профиль друга в соцсетях</label>
        <input type="text" name="engagement[]" id="engagement_0">
    </div>


    <div id="addMoreBlock" class="row">
        <label for="addMore"></label>
        <img id="addMore" src="/vk-check/resources/assets/plus.svg"
             alt="плюсик чтобы добавить ещё полей для друзей"
             width="30"
             height="30">
    </div>


    <div class="delimiter"></div>


    <div class="row">
        <label for="phone" class="required">Телефон</label>
        <input id="phone" name="phone" type="text" inputmode="tel" required pattern="\d+" title="Только цифры,
        например 79125559900" maxlength="20" placeholder="Пример: 79018887755">

    </div>
    <div class="row">
        <label for="phoneNumRes"></label>
        <div id="phoneNumRes">Начните вводить номер...</div>
    </div>


    <div class="delimiter"></div>

    <div class="checkbox-fields">
        <input type="checkbox" name="age18" id="age18" required checked value="1">
        <label for="age18" class="nonMaxWidth">
            Я подтверждаю, что мне уже есть 18 лет или более
        </label>
    </div>


    <div class="checkbox-fields">
        <input type="checkbox" name="agreement" id="agreement" checked required value="1">
        <label for="agreement" class="nonMaxWidth">
                <span>Я прочитал(а) <a id="agreement-link"
                                       href="#agreement-doc">соглашение</a> и даю согласие на обработку персональных данных</span>
        </label>
    </div>

    <div class="checkbox-fields">
        <input type="checkbox" name="adv" id="adv" value="1" checked>
        <label for="adv" class="nonMaxWidth">
            <span>Я даю согласие на получение важных уведомлений и рекламных материалов</span>
        </label>
    </div>

    <div class="row">
        <div id="loader" class="hide"><img src="/vk-check/resources/assets/spinner.svg" alt="ожидаение загрузки
        материалов, нужно ждать" width="24" height="24"></div>
    </div>

    <div class="row mt20">
        <input id="submitBtn" type="submit" class="btn-btn btn-green">

    </div>


</form>

