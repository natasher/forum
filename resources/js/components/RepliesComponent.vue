<template>
    <div>
        <div class="row mt-4">
            <div class="col-md-8"
                v-for="( reply, index ) in items"
                :key="reply.id">
                <reply :data="reply" @deleted="remove( index )"></reply>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-8">
                <paginator
                    :dataSet="dataSet"
                    @changed="fetch" />

                <new-reply
                    @created="add" />
            </div>
        </div>
    </div>
</template>

<script>
    import reply      from './ReplyComponent.vue'
    import NewReply   from './NewReply.vue'
    import collection from '../mixins/collection.js'

    export default {

        name: 'replies',

        components: {
            reply,
            NewReply,
        },

        mixins: [
            collection
        ],

        data() {
            return {
                dataSet : false,
            }
        },

        created() {
            this.fetch();
        },

        computed: {

        },

        methods: {
            fetch( page ) {
                axios.get( this.url( page ) )
                    .then( this.refresh );
            },

            url( page = 1 ) {
                return `${ location.pathname }/replies?page=` + page;
            },

            refresh({ data }) {
                this.dataSet = data;
                this.items   = data.data;

                window.scrollTo( 0, 0 );
            },
        },

    }
</script>