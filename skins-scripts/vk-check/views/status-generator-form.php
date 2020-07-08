<script>
    $(document).ready(() => {
        function getStatusFrom(statuses = null, count = null, page = null) {
            $('#vk-status-get-btn').off('click');


            if (!page) {
                page = 1;
            }


            if (!count) {
                count = 0;
            }


            if (!statuses) {
                let url = '/vk-check/resources/vk-statuses/statuses_' + page + '.json';
                statuses = $.get(url, null, null, 'json');
            }


            statuses.then(
                res => {
                    if (count >= res.length) {
                        page++;
                        return getStatusFrom(null, null, page)
                    }

                    let item = res[count];
                    let status = item.textStatus;

                    $('#vk-status-text').text(status);
                    $('#vk-status-get-btn').css({backgroundColor: '#7fcaad'});
                    $('#vk-status-text-hidden').val(status);
                    $('#vk-status-get-btn').text('Ещё статус');
                    $('#vk-status-result-block').removeClass('hide');


                    count++;

                    $('#vk-status-get-btn').on('click', () => {
                        getStatusFrom(statuses, count, page);
                    });


                    $('#vk-status-copy-btn').on('click', () => {
                        document
                            .getElementById('vk-status-text-hidden')
                            .select();
                        document.execCommand('copy');
                    })


                },
                err => console.log(err))
        }

        $('#vk-status-get-btn').on('click', () => {
            getStatusFrom();
        });
    })
</script>

<style>

    #vk-status-generator-block {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap
    }

    #vk-status-result-block {
        display: flex;
        flex-wrap: wrap;
    }

    #vk-status-result-block > * {
        margin: 5px;
    }


    #vk-status-text {
        flex: 2;
        flex-basis: 350px;
        background-color: grey;
        color: white;
        padding: 10px;
        border-radius: 3px
    }

    #vk-status-copy-btn {
        padding: 10px 40px;
        background-color: #1cded3;
        color: #fbfbfb;
        border-radius: 3px;
    }

    #vk-status-get-btn {
        margin: 5px;
        max-width: 400px;
    }

    #vk-status-copy-btn:hover {
        cursor: pointer;
    }

    #vk-status-text-hidden {
        position: absolute;
        left: -100000px;
        bottom: -100000px;
        flex: 0;
    }


</style>

<div id="vk-status-generator-block">
    <button id="vk-status-get-btn" type="button">Генерировать статус ВКонтакте</button>
    <div id="vk-status-result-block" class="hide">
        <div id="vk-status-text" style=""></div>
        <div id="vk-status-copy-btn">Скопировать!</div>
        <input type="text" id="vk-status-text-hidden">
    </div>
</div>