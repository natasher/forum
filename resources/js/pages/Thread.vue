<script>
    import replies from '../components/RepliesComponent.vue'

    export default {

        name: 'thread-view',

        components: {
            replies,
        },

        props: [ 'initialRepliesCount' ],

        data() {
            return {
                repliesCount: this.initialRepliesCount,
            }
        },

    }
</script>
