<template>
    <button
        :class="classes"
        @click="subscribe">
            Subscribe
    </button>
</template>

<script>
export default {

    name: 'SubscribeButton',

    props: [ 'active', ],

    computed: {
        classes() {
            return [
                'btn',
                this.active
                    ? 'btn-primary'
                    : 'btn-default'
            ]
        },
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