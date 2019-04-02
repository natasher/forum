<script>
    import favorite from './FavoriteComponent.vue'

    export default {

        name: 'reply',

        components: { favorite },

        props: [ 'data' ],

        data() {
            return {
                editing: false,
                body   : this.data.body
            }
        },

        methods: {
            update() {
                axios.patch( '/replies/' + this.data.id, {
                    body: this.body,
                });

                this.editing = false;

                flash( 'Updated!' );
            },

            destroy() {
                axios.delete( '/replies/' + this.data.id );

                $( this.$el ).fadeOut( 300, () => {
                    flash( 'You reply has been deleted.' );
                });

            },
        },

    }
</script>