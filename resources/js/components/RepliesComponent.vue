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
                <new-reply
                    :endpoint="endpoint"
                    @created="add" />
            </div>
        </div>
    </div>
</template>

<script>
    import reply from './ReplyComponent.vue'
    import NewReply from './NewReply.vue'

    export default {

        name: 'replies',

        components: {
            reply,
            NewReply,
        },

        props: {
            data: {
                type    : Array,
                required: true,
                default : {},
            },
        },

        data() {
            return {
                items   : this.data,
                endpoint: `${ location.pathname }/replies`,
            }
        },

        computed: {

        },

        methods: {
            add( reply ) {
                this.items.push( reply );
            },

            remove( index ) {
                this.items.splice( index, 1 );

                this.$emit( 'removed' );

                flash( 'Reply was deleted!' );
            },
        },

    }
</script>