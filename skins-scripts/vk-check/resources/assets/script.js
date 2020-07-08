$(document).ready(() => {

    let sendAjax = (data = {}, url = '', method = 'POST') => {
        return $.ajax({
            url: url,
            method: method,
            dataType: 'json',
            data: data
        });
    };

    function unfold() {
        $('.folded')
            .off('click')
            .css({display: 'none'})
            .slideDown(400, () => {
                $('#floor').removeAttr('style');
            })
            .removeClass('folded');
    }

    $('.folded').on('click', unfold);


    function checkStorage() {
        let logged = localStorage.getItem('logged');
        let loggedT = localStorage.getItem('loggedT');
        let loggedUs = localStorage.getItem('loggedUs');

        if (!logged || !loggedT || !loggedUs) {
            return removeToken();
        }
        unfold();
        return checkLoggedIn();

    }

    checkStorage();


    $('#phone').on('keyup', () => {
        let value = $('#phone').val();

        let res = value.replace(/(\d(?=\d?))(\d{0,3}(?=\d?))?(\d{0,3}(?=\d?))?(\d{0,4}(?=\d?))?(\d+)?/gi, '+ $1 $2 $3 $4 $5');

        if (value.length > 11) {
            res += ' <span style="color: red">Верный номер?</span>'
        }

        $('#phoneNumRes').html(res);

    });


    let firstInputFocus = $('#username');
    if (firstInputFocus.is(':focus')) {
        firstInputFocus.css('background-color', '#f7efff');
        firstInputFocus.focusout(() => firstInputFocus.css('background-color', ''));
    }

    $('#tester').on('click', () => {
        $('input').val('test text');
        $('select').val(1);
        $('input[type=date]').val('2010-10-29');
        $('input[type=checkbox]').val(1).attr('checked', 'checked');
    });

    $('#apartment-number-checkbox').click(() => {
        $('#apartment-number-block').slideToggle(250);
        $('#apartment-number').attr('disabled', (index, attr) => !attr);
    });


    $('.row').focusin((e) => {
        $(e.target)
            .css('background-color', '#f7efff')
            .focusout((e) => $(e.target).css('background-color', ''))
    });

    let number = 0;
    $('#addMoreBlock').on('click', () => {
        let block = $('#engagementBlock_' + number);

        block
            .after(`<div style="display: none" id="engagementBlock_${number + 1}" class="row">
        <label for="engagement_${number + 1}">Ещё ссылка</label>
        <input type="text" name="engagement[]" class="engagement_${number + 1}">
    </div>`)
            .next().slideDown(300);

        number++;
    });


    function removeToken() {
        localStorage.removeItem('logged');
        localStorage.removeItem('loggedUs');
        localStorage.removeItem('loggedT');
        localStorage.removeItem('loggedE');
    }

    function userExist(div, res) {
        $('#floor').html(div);

        location.hash = 'exist';
        let defaultText = 'Добро пожаловать <b>' + res.login + '</b>!<br />Всё отлично, Вы в программе!';

        if (res.infoStatusName !== undefined) {
            location.hash = res.infoStatusName;
            if (res.infoStatusName === 'success') {
                $('#pageTitleH2').html('Успешная регистрация');
            }
        }

        if (res.infoTextName !== undefined) {
            defaultText = res.infoTextName;
        }

        $('#returnedData').html(defaultText);

        if (res.blocked === '1') {
            $('#user-status')
                .addClass('infoBlockRed')
                .html('Ваш аккаунт заблокирован, Вам недоступно накопление' +
                    ' бонусов. К сожалению, аккаунт не подлежит разблокированию'
                )
                .after('<button type="button" style="max-width: 50%" class="btn-btn btn-grey m20">Отправить запрос на восстановление</button>');

            res.status = -1;
            res.bonuses = 0;
        }

        let userStatus = $('#user-status');

        switch (res.status) {
            case '0':
                userStatus.addClass('infoBlockRed').html('Вы только что зарегистрировались, Ваш аккаунт пока' +
                    ' заблокирован. Аккаунт будет проверен в ближайшее время, ожидайте уведомлений, следите за' +
                    ' изменением статуса в кабинете');
                break;
            case '1':
                userStatus.addClass('infoBlockYellow').html('Ваш аккаунт на проверке у модератора, в' +
                    ' ближайшее время Вы увидите изменения');
                break;
            case '2':
                userStatus.addClass('infoBlockGreen').html('Ваш аккаунт прошёл проверку и одобрен!' +
                    ' Поздравляем! Вы сможете наращивать бонусы "без остановки"!');
                break;


        }

        $('#user-bonuses').html(res.bonuses);

        localStorage.setItem('loggedT', res.token);
        localStorage.setItem('logged', true);
        localStorage.setItem('loggedUs', res.login);
        localStorage.setItem('loggedE', res.token_expire);

        $('#loggedOut').on('click', () => {
            removeToken();
        });


    }

    function onSubmit(e) {
        e.preventDefault();

        let userForm = $('#user-form');
        userForm.off('submit');


        loader();
        $('.infoBlock').html('').hide();

        let data = userForm.serializeArray();

        data.push({name: 'token', value: localStorage.getItem('loggedT')});

        data = $.param(data);

        setTimeout(() => {
            let formData = sendAjax(data, '/vk-check/partner.php');

            formData.then(res => {
                    if (res.jsonStatus === 'error') {
                        location.hash = 'error';
                        removeToken();
                        let infoBlock = $('.infoBlock');
                        infoBlock.show();
                        infoBlock.html(res.errorDetail);


                    } else if (res.exist === true) {
                        $.get('/vk-check/views/exist.php')
                            .then(div => userExist(div, res));
                    } else {
                        $.get('/vk-check/views/exist.php')
                            .then((div) => {
                                res.infoTextName = 'Добрый день <b>' + res.login + '</b>! Вы успешно зарегистрированы в программе. В ближайшее время Ваш аккаунт будет проверен, Вам станет доступна возможность увеличения баллов. Проверяйте свой статус аккаунта, или следите за уведомлениями на почту';

                                res.infoStatusName = 'success';
                                return userExist(div, res);
                            });
                    }
                },
                err => console.error(err, '\n', err.responseText)
            );

            document.getElementById('floor').scrollIntoView({behavior: "smooth"});

            loader(false);
            $('#user-form').submit(onSubmit);


        }, 2000);
    }

    function checkLoggedIn() {
        if (!localStorage.getItem('loggedT') || !localStorage.getItem('loggedUs') || !localStorage.getItem('logged')) {
            removeToken();

            return $.get('/vk-check/views/login.php')
                .then(div => {
                    location.hash = 'login';
                    $('#floor').html(div);

                    $('#user-form').submit(onSubmit)
                }, err => console.log(err));

        }

        return sendAjax(
            {
                type: 'loginToken',
                token: localStorage.getItem('loggedT'),
                login: localStorage.getItem('loggedUs'),
            },
            '/vk-check/partner.php'
        ).then(
            res => {
                if (res.tokenEqual) {
                    $.get('/vk-check/views/exist.php')
                        .then(div => userExist(div, res));
                }
            },
            err => console.error(err, '\n', err.responseText)
        );
    }


    $('#loginBtn').on('click', (e) => {
            e.preventDefault();
            $('#loaderLoginBtn').removeClass('hide');
            setTimeout(() => {
                checkLoggedIn();
                $('#loaderLoginBtn').addClass('hide');

            }, 1000);
        }
    );


    function loadAgreement() {
        $('#agreement-link').off('click');

        let agreement = $.get('/vk-check/views/agreement.php');

        agreement.then(
            res => {
                $('#floor').after(res).next().slideDown(300);

                document.getElementById('openedAgreement').scrollIntoView({behavior: "smooth"});

                $('#openedAgreement').on('click', () => {
                    $('#openedAgreement').slideUp(200, () => {
                        $('#agreement-link').on('click', loadAgreement);
                        document.getElementById('agreement-link').scrollIntoView({behavior: "smooth"});
                        $('#openedAgreement').remove();
                    });
                });
            }
        );
    }

    $('#agreement-link').on('click', loadAgreement);


    $('#user-form').submit(onSubmit);


    function loader(loading = true) {
        let loader = $('#loader');

        if (loading) {
            loader.removeClass('hide');
        } else {
            loader.slideUp(300, () => {
                loader.addClass('hide');
                loader.removeAttr('style');
            });
        }
    }
});


