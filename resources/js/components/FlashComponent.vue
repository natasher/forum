<template>
    <div class="alert alert-success alert-flash" role="alert" v-show="show">
        Success! {{ body }}
    </div>
</template>

<script>
    export default {

        name: 'flash',

        props: [ 'message' ],

        data() {
            return {
                body: '',
                show: false,
            }
        },

        created() {
            if ( this.message ) {
                this.body = this.message;
                this.show = true;
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