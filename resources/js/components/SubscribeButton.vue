<template>
    <button
        class="btn btn-default"
        @click="subscribe">
            Subscribe
    </button>
</template>

<script>
export default {

    name: 'SubscribeButton',

    methods: {
        subscribe() {
            axios.post( `${ location.pathname }/subscriptions` )
                .then(function () {
                    flash( 'Subscribed' )
                })
                .catch(function ( e ) {
                    console.error( 'something fucks up' )
                })
        },
    },

}
</script>