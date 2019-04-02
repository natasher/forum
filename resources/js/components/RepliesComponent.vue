<template>
    <div>
        <div v-for="reply in items" :key="reply.id">
            <reply></reply>
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

        },

    }
</script>