<?php

session_start();
if (!isset($_POST['formToken'])) {
    die('Нет доступа');
}

if (!isset($_SESSION['formToken'])) {
    die('Что-то пошло не так, попробуйте обновить страницу');
}

if ($_SESSION['formToken'] !== $_POST['formToken']) {
    die('Что-то пошло не так, попробуйте обновить страницу');
};

?>
<script>
    function yanPaymentSelector() {
        $('#payment-type-selector').children().on('click', (e) => {
            $('#payment-type-selector').children().removeClass('checked');

            $('#' + e.target.id).addClass('checked');

            let paymentType = $('#yan-payment-type');
            paymentType.val('');

            switch (e.target.id) {
                case 'yan-card':
                    paymentType.val('AC');
                    break;
                case 'yan-wallet':
                    paymentType.val('PC');
                    break;
                case 'yan-mobile':
                    paymentType.val('MC');
                    break;
            }
        })
    }

    yanPaymentSelector();


    function showSteamImage() {
        let steamImageBlock = $('#steam-image-block');
        let image = $('#steam-image-block img');

        image.attr('src', '/old-blog/skins-market/assets/images/steam-trade-link.png');

        steamImageBlock.removeClass('hide');

        document.getElementById('steam-image-block')
            .scrollIntoView({behavior: "smooth"});

        steamImageBlock.on('click', () => {
            image.attr('src', '').removeAttr('style');
            steamImageBlock.addClass('hide');

            document.getElementById('dataResult-payment-form')
                .scrollIntoView({behavior: "smooth"});
        });
    }

    $('#iBtn').on('click', showSteamImage);

</script>

<div id="dataResult-payment-form">

    <form id="yan-payment-form" action="https://money.yandex.ru/quickpay/confirm.xml" method="post" target="_blank">
        <input type="hidden" name="receiver" id="yan-receiver" required>
        <input type="hidden" name="quickpay-form" value="small" required>


        <input type="hidden" name="label" id="yan-item-label" required>
        <input type="hidden" name="comment" id="yan-item-comment" required>

        <input type="hidden" name="formcomment" id="yan-formcomment" required>
        <input type="hidden" name="short-dest" id="yan-short-dest" required>
        <input type="hidden" name="successURL" id="success-url" value="" required>

        <div class="rows">
            <label for="">Форма покупки</label>
            <label for=""><span style="color: red">*</span> - обязательные поля</label>
            <small>* Скины могут передаваться до 10 дней</small>
        </div>

        <div class="delimiter"></div>

        <div class="rows">
            <label id="payment-selector-label" for="payment-selector-label">Выберите оплату</label>

            <div id="payment-type-selector">
                <div id="yan-card" class="checked">Картой</div>
                <div id="yan-wallet">Я.Кошелёк</div>
                <div id="yan-mobile">С телефона</div>
            </div>
        </div>


        <input type="hidden" name="paymentType" id="yan-payment-type" value="AC" readonly required>


        <div class="rows">
            <label for="yan-sum">Сумма оплаты, руб.</label>
            <input type="text" name="sum" id="yan-sum" readonly required>
        </div>


        <div class="rows">
            <label for="yan-targets">Назначение платежа</label>
            <input type="text" name="targets" id="yan-targets" readonly required>
        </div>

        <div class="rows">
            <label for="buyer-email" class="required">Ваш Email</label>
            <input type="text"
                   name="buyer_email" id="buyer-email"
                   inputmode="email" pattern=".*@.*\..*"
                   placeholder="Пример: alex_1868@mail.ru"
                   title="Введите электронный адрес в формате pochta@mail.ru"
                   required>
        </div>

        <div class="rows">
            <label id="steam-change-link-label" for="steam-change-link" class="required">Steam ссылка для обмена</label>
            <div id="iBtn">i</div>
            <input type="text" name="steam_change_link" id="steam-change-link" required>
        </div>

        <div class="rows" style="justify-content: center">
            <button type="button" id="save-login-and-steam" class="btn-btn">Запомнить Email и Steam link</button>
        </div>


        <div class="rows" style="justify-content: flex-end">
            <input id="buyItemSubmitButton" type="submit" value="Оплатить">
        </div>
    </form>
</div>

<div id="steam-image-block" class="hide">
    <button type="button">Закрыть</button>
    <img src="" alt="">

</div>