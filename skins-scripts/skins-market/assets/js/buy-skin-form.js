export function buySkinForm(data, eachNum, price) {
    let paymentTo = '41001212675103'; //scom
    // let paymentTo = '410013387397696'; //gvi


    let buySkinBtn = $('#buySkin');

    buySkinBtn.off('click');
    $('#dataResult-free-skins').remove();

    let item = data.items[eachNum];
    let token = data.formToken;

    let buyItemDiv = $.post('/old-blog/skins-market/views/payment-form.php', {
        formToken: token
    }, null, 'html');

    buyItemDiv.then(
        div => {
            $('#dataResult').after(div);

            if ($(window).width() <= 1365) {
                document.getElementById('dataResult-payment-form')
                    .scrollIntoView({behavior: "smooth"});
            }


            $('#yan-payment-form').on('submit', (e) => {
                let orderId = Date.now();

                if (+price >= 15000) {
                    e.preventDefault();

                    $('#buyItemSubmitButton')
                        .before('<div class="flashJsMessage">Больше 15000 рублей только через личный кабинет пользователя</div>')
                        .prev().on('click', () => {
                        $('.flashJsMessage').remove();
                    });

                    setTimeout(() => {
                        $('.flashJsMessage').fadeOut(300, () => {
                            $('.flashJsMessage').remove()
                        });
                    }, 3000);
                    return;
                }

                if (+$('#yan-sum').val() !== price) {
                    e.preventDefault();
                    alert('Вы изменили стоимость!');
                    return;
                }

                let buyerEmail = $('#buyer-email').val().trim();

                let steamChangeLink = $('#steam-change-link').val().trim();

                let label = buyerEmail + '::' + orderId;

                let comment = buyerEmail + '_' + steamChangeLink;

                $('#yan-item-label').val(label);
                $('#yan-item-comment').val(comment);


                let inBuyerInfo = 'qukenon.ru, skin ' + item.market_hash_name;
                $('#yan-formcomment').val(inBuyerInfo);
                $('#yan-short-dest').val(inBuyerInfo);
                $('#yan-targets').val('Оплата за: ' + item.market_hash_name + ', id: ' + orderId);

                let query = {
                    username: buyerEmail,
                    order_id: orderId,
                    item_id: item.item_id,
                    asset_id: item.asset_id,
                    instance_id: item.instance_id,
                    formToken: token
                };

                query = $.param(query);


                let successUrl = $('#success-url');

                successUrl.val('https://qukenon.ru/old-blog/skins-market/views/payment-success.php?' + query);

                $('#yan-receiver').val(paymentTo);

                let url = '/old-blog/skins-market/yandex-pay/save-user.php';
                let data = {
                    username: buyerEmail,
                    steam_link: steamChangeLink,
                    order_id: orderId,
                    item_id: item.item_id,
                    asset_id: item.asset_id,
                    instance_id: item.instance_id
                };

                $.ajax({
                    url: url,
                    data: data,
                    method: 'POST',
                    dataType: 'json'
                })
                    .then(res => res, err => console.error(err));

            });

            $('#yan-targets').val('Оплата за: ' + item.market_hash_name);
            $('#yan-sum').val(price);

            if (localStorage.getItem('steamLinkBuyer')) {
                $('#steam-change-link')
                    .val(localStorage.getItem('steamLinkBuyer'));
            } else {
                localStorage.removeItem('steamLinkBuyer');
            }

            if (localStorage.getItem('emailBuyer')) {
                $('#buyer-email')
                    .val(localStorage.getItem('emailBuyer'));
            } else {
                localStorage.removeItem('emailBuyer');
            }

            $('#save-login-and-steam').on('click', () => {
                localStorage
                    .setItem('steamLinkBuyer', $('#steam-change-link').val().trim());
                localStorage
                    .setItem('emailBuyer', $('#buyer-email').val().trim());
            })
        },
        err => console.log(err)
    );
}
