<template>
    <div class="alert alert-success" role="alert">
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