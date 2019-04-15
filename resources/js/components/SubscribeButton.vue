<template>
    <button
        class="btn"
        :class="active ? 'btn-primary' : 'btn-default'"
        @click="subscribe">
            Subscribe
    </button>
</template>

<script>
export default {

    name: 'SubscribeButton',

    data() {
        return {
            active: false,
        }
    },

    methods: {
        subscribe() {
            axios.post( `${ location.pathname }/subscriptions` )
                .then(function () {
                    flash( 'Subscribed' )
                })
                .catch(function ( e ) {
                    console.error( 'something fucks up' )
                    console.error( e )
                })
        },
    },

}
</script>