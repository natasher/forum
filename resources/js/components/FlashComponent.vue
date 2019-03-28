<template>
    <div class="alert alert-success alert-flash" role="alert">
        {{ body }}
    </div>
</template>

<script>
    export default {

        name: 'flash',

        props: [ 'message' ],

        data() {
            return {
                body: this.message,
            }
        },

    }
</script>

<style>
    .alert-flash {
        position: fixed;
        right   : 25px;
        bottom  : 25px;
    }
</style>