<script>
    import replies from '../components/RepliesComponent.vue'
    import SubscribeButton from '../components/SubscribeButton.vue'

    export default {

        name: 'thread-view',

        components: {
            replies,
            SubscribeButton,
        },

        props: [ 'initialRepliesCount' ],

        data() {
            return {
                repliesCount: this.initialRepliesCount,
            }
        },

    }
</script>
