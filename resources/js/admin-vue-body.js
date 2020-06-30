let body = document.querySelector('.wrapper');

let bodyApp = new Vue({
    el: body,
    data: {

        test: 'test vue',
        notify: false,
        message: '',


    },

    methods: {
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
