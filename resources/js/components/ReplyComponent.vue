<script>
    export default {

        name: 'reply',

        props: [ 'attributes' ],

        data() {
            return {
                editing: false,
                body   : this.attributes.body
            }
        },

        methods: {
            update() {
                axios.patch( '/replies/' + this.attributes.id, {
                    body: this.body,
                })
            }
        },

    }
</script>