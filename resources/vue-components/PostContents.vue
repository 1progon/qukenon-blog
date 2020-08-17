<template>
    <section v-if="postTitles && postTitles.length > 1" id="contents">
        <h4>Содержание</h4>
        <template v-for="title in postTitles">
            <div class="title-contents-h2">
                <a :href="'#' + title.id" v-if="title.tagName === 'H2'">{{ title.innerHTML }}</a>
            </div>
            <div class="title-contents-h3">
                <a :href="'#' + title.id" v-if="title.tagName === 'H3'">{{ title.innerHTML }}</a>
            </div>
        </template>
    </section>
</template>
<script>
export default {

    data() {
        return {
            postTitles: [],
        }
    },
    mounted() {
        this.getTitles();
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


}
</script>
<style lang="scss" scoped>
.from-component {
    color: yellowgreen;
}
</style>



