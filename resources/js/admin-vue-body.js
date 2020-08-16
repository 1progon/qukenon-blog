let body = document.querySelector('.wrapper');

let bodyApp = new Vue({
    el: body,
    data: {
        // test: 'test vue',
        notify: false,
        message: '',
        timeId: null,

    },

    created() {
        if (document.getElementById('group')) {
            this.removeRadio();
        }
    },

    methods: {
        // Получить теги с сервера после ввода в фильтр на странице всех тегов в админке
        async getTagsOnSearch(e) {
            if (e.target.value.length < 0) {
                return;
            }

            clearTimeout(this.timeId)


            let csrfToken = document.querySelector('meta[name="l_token"]')
                .attributes.getNamedItem('content').value;

            this.timeId = setTimeout(async () => {

                try {
                    let promise = await fetch('http://localhost:3000/admin123123/tag' + '?filter=' + e.target.value, {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });

                    let data = await promise.json();

                    console.log(data);

                    let table = await document.querySelector('table#tags-table tbody');
                    table.innerHTML = '';
                    await data.forEach(item => {
                        table.innerHTML = table.innerHTML + `<tr>
                        <td>${item.id}</td>
                        <td>${item.name}</td>
                        <td><a href="${document.location.href + '/' + item.slug}/edit">Редактировать</a></td>
                        <td>${item.group}</td>
                        <td>${item.created_at}</td>
                        <td>${item.updated_at}</td>
                        <td>${item.posts_count}</td>
                        <td>
                        <form id="form-${item.id}"
                              v-on:submit.prevent="showConfirmNotify"
                              action="${location.href + '/' + item.slug}"
                              method="post">

                            <input type="hidden" name="_token" value="${csrfToken}">
                            <input type="hidden" name="_method" value="DELETE">

                            <!--TODO Не работает notify, вынести в отдельный сервис Аякс-->
                            <div id="notify-${item.id}" style="display: none" class="notify">

                                <p class="text-row">Точно удалить?? Посты останутся, но будут привязаны к дефолтной
                                    категории.. .Если ее нет, она будет создана</p>


                                <div class="action-buttons">
                                    <span v-on:click="removePostOrCategory(${item.id})" class="remove btn-outline">Удалить</span>

                                    <span v-on:click="hideConfirmNotify(${item.id})"
                                          class="decline btn">Отменить</span>
                                </div>

                                <div class="response-message">@{{ message }}</div>
                            </div>

                            <input class="link" type="submit" value="Удалить">
                        </form>
                        </td>
                        </tr>`;
                    });
                } catch (err) {
                    clearTimeout(this.timeId)
                    this.timeId = setTimeout(() => {
                        location.reload();
                    }, 500)
                }
            }, 200);


        },
        filterGroups(e) {
            if (e.target.value.length < 0) {
                return;
            }
            let labels = document.querySelectorAll('form .tags-list .f-column label')
            labels = Array.from(labels);

            labels.map(label => {
                if (!label.innerText.match(e.target.value)) {
                    return label.parentElement.style.display = 'none';
                } else {
                    return label.parentElement.removeAttribute('style')
                }
            })


        },
        removeRadio() {
            if (document.getElementById('group').value.length > 0) {
                let inputs = document.querySelectorAll('form input[type=radio][name=group]');

                inputs.forEach(item => {
                    item.checked = false;
                    item.removeAttribute('checked');
                })

            }
        },
        removeChecked(event) {
            let check = event.target.attributes.getNamedItem('checked');
            let checkedBool = event.target.checked;

            if (check && checkedBool) {
                event.target.checked = false;
                event.target.removeAttribute('checked');
                return;
            }

            let inputs = document.querySelectorAll('form input[type=radio][name=group]');
            inputs.forEach(item => {
                item.removeAttribute('checked');
            })

            event.target.setAttribute('checked', 'checked')

        },
        showConfirmNotify(e) {
            let formId = e.target.id; //form-48
            let id = e.target.dataset.id; //48


            // let notifyBlock = document.getElementById('notify-' + catId);
            let notifyBlock = document.querySelector('#' + formId + ' .notify');

            notifyBlock.style.display = 'block';

        },

        hideConfirmNotify(catId) {
            let notifyBlock = document.getElementById('notify-' + catId);
            notifyBlock.style.display = 'none';
        },


        removePostOrCategory(catId) {


            let form = document.getElementById('form-' + catId);
            form.submit();

            this.message = 'Отлично, удалено!';

            setTimeout(() => {
                this.hideConfirmNotify(catId);

            }, 5000);


        },

        // Page images-error

        // Check all images to remove
        checkAll() {


            let images = document.getElementsByClassName('images-to-remove');


            for (i in images) {
                if (images[i].checked) {

                    images[i].checked = false;

                } else {

                    images[i].checked = true;
                }

            }


        }
    }
})
