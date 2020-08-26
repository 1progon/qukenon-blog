import Vue from "vue/dist/vue.esm";
import PostContents from "../vue-components/PostContents";

let wrapper = document.querySelector('.wrapper');

new Vue({
    el: wrapper,
    data: {
        // mobile menu
        showMobileMenu: false,
    },

    components: {
        'post-contents': PostContents
    },

    created() {
        window.addEventListener('load', this.showToTopButton);
        window.addEventListener('scroll', this.showToTopButton);
    },

    methods: {
        showToTopButton() {
            let button = document.getElementsByClassName('to-top-button')[0];
            removeEventListener('load', this)

            let scrolledHeight = document.documentElement.scrollTop;

            if (scrolledHeight > 200) {
                button.classList.add('show');
            } else {
                button.classList.remove('show');
            }
        }
    }

});
