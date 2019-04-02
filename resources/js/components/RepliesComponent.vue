<template>
    <div>
        <div v-for="( reply, index ) in items" :key="reply.id">
            <reply :data="reply" @deleted="remove( index )"></reply>
        </div>
    </div>
</template>

<script>
    import reply from './ReplyComponent.vue'

    export default {

        name: 'replies',

        components: {
            reply,
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
                items: this.data,
            }
        },

        computed: {

        },

        methods: {
            remove( index ) {
                this.items.splice( index, 1 );
            },
        },

    }
</script>