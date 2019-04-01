<template>
    <button type="submit" class="btn btn-default"
        @click="toggle">
        <span>like!</span>
        <span v-text="favoritesCount"></span>
    </button>
</template>

<script>
    export default {

        name: 'favorite',

        props: [ 'reply' ],

        data() {
            return {
                favoritesCount: this.reply.favoritesCount,
            }
        },

        methods: {
            toggle() {
                if ( this.isFavorited ) {
                    axios.delete( `/replies/${ this.reply.id }/favorites` );
                } else {
                    axios.post( `/replies/${ this.reply.id }/favorites` );
                }
            }
        },

    }
</script>