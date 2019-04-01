<template>
    <button type="submit" class="btn btn-default">
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
                favoritesCount: 0,
            }
        },

    }
</script>