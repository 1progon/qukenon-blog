let wrapper = document.querySelector('.wrapper');

let app = new Vue({
    el: wrapper,
    data: {
        // mobile menu
        showMobileMenu: false,

        // posts contents
        postTitles: [],
    },

    methods: {
        getTitles() {
            let titles = document.querySelectorAll('article h2, article h3');
            titles.forEach((item, i) => {
                item.id = 'contents-id-' + i;
                this.postTitles.push(item);
            });
        }
    },

    created() {
        this.getTitles();
    }
});
