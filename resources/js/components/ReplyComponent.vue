<script>
    export default {

        name: 'reply',

        props: [ 'attributes' ],

        data() {
            return {
                editing: false,
                body   : this.attributes.body
            }
        }

    }
</script>