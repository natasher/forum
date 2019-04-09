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
                <paginator :dataSet="dataSet"></paginator>

                <new-reply
                    :endpoint="url"
                    @created="add" />
            </div>
        </div>
    </div>
</template>

<script>
    import reply      from './ReplyComponent.vue'
    import NewReply   from './NewReply.vue'
    import paginator  from './Paginator.vue'
    import collection from '../mixins/collection.js'

    export default {

        name: 'replies',

        components: {
            reply,
            NewReply,
            paginator,
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
            fetch() {
                axios.get( this.url() )
                    .then( this.refresh );
            },

            url() {
                return `${ location.pathname }/replies`;
            },

            refresh({ data }) {
                this.dataSet = data;
                this.items   = data.data;
            },
        },

    }
</script>