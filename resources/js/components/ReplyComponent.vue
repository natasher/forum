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
                });

                this.editing = false;

                flash( 'Updated!' );
            },

            destroy() {
                axios.delete( '/replies/' + this.attributes.id );

<<<<<<< HEAD
                $( this.$el ).fadeOut( 300, () => {
                    flash( 'You reply has been deleted.' );
                });

=======
                $( this.$el ).fadeOut( 300 );

                flash( 'You reply has been deleted.' );
>>>>>>> 743e9fd... remove deleted reply from DOM tree
            },
        },

    }
</script>