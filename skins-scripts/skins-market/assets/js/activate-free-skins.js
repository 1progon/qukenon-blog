export function activateFreeSkins() {
    let form = $.get('/old-blog/skins-market/views/get-free-skin-form.php', null, null, 'html');

    form.then(
        res => {
            $('#dataResult').after(res);
            document
                .getElementById('dataResult-free-skins')
                .scrollIntoView({behavior: "smooth"});

            $('#free-skins-form').on('submit', (e) => {
                e.preventDefault();

                $('#errorResponseBlock').addClass('hide');

                let url = '/old-blog/skins-market/free-skins/save-user.php';
                let data = $('#free-skins-form').serialize();

                let saveUser = $.ajax({
                    url: url,
                    data: data,
                    method: 'POST',
                    dataType: 'json'
                });

                $('#submit-button').val('Подождите...');

                setTimeout(() => {
                    saveUser.then(
                        res => {
                            if (res.error) {
                                let errorBlock = $('#errorResponseBlock');

                                errorBlock.removeClass('hide');
                                $('#errorResponse')
                                    .text(res.errorDetail)
                                    .css({display: 'none'})
                                    .slideDown(300, () => {
                                        $('#submit-button').css({
                                            backgroundColor: 'red',
                                            color: 'white'
                                        }).val('Ошибка')
                                    });

                                errorBlock.on('click', () => {
                                    $('#errorResponse')
                                        .text('').removeAttr('style');
                                    errorBlock.addClass('hide');
                                });
                                return;
                            }


                            $('#submit-button').css({
                                backgroundColor: 'green',
                                color: 'white',
                            }).val('Сохранено');

                            $('#free-skins-form').text('Сохранено. Ожидайте уведомление на электронный адрес или' +
                                ' проверьте состояние Ваших заявок в личном кабинете.').css({
                                backgroundColor: 'green',
                                color: 'white',
                                padding: '10px',
                                fontSize: '14px'
                            });

                            document
                                .getElementById('dataResult-free-skins')
                                .scrollIntoView({behavior: "smooth"})

                        },
                        err => console.error(err)
                    )
                }, 1500);
            })
        },
        err => console.error(err)
    );
}
