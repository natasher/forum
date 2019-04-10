<template>
    <ul class="pagination" v-if="shouldPaginate">

        <li class="page-item"
            v-show="prevUrl"
            @click.prevent="page--">
                <a class="page-link" href="#" aria-label="Previous" rel="prev">
                    <span aria-hidden="true">&laquo; Previous</span>
                </a>
        </li>
        <!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li> -->
        <li class="page-item"
            v-show="nextUrl"
            @click.prevent="page++">
                <a class="page-link" href="#" aria-label="Next" rel="next">
                    <span aria-hidden="true">Next &raquo;</span>
                </a>
        </li>

    </ul>
</template>

<script>
    export default {

        name: 'paginator',

        props: [ 'dataSet' ],

        data() {
            return {
                page: 1,
                prevUrl: false,
                nextUrl: false,
            }
        },

        watch: {
            dataSet() {
                this.page    = this.dataSet.current_page;
                this.prevUrl = this.dataSet.prev_page_url;
                this.nextUrl = this.dataSet.next_page_url;
            },
        },

        computed: {
            shouldPaginate() {
                return !!this.prevUrl || !!this.nextUrl;
            }
        },

    }
</script>