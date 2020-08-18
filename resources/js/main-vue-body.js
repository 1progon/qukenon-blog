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

});
