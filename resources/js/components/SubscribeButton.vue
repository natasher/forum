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

    data() {
        return {
            state: this.active,
        }
    },

    computed: {
        classes() {
            return [
                'btn',
                this.state
                    ? 'btn-primary'
                    : 'btn-default'
            ]
        },
    },

    methods: {
        subscribe() {
            axios[
                this.state ? 'delete' : 'post'
            ]( `${ location.pathname }/subscriptions` )
                .then(() => {
                    this.state = ! this.state
                })
                .catch(( e ) => {
                    console.error( 'something fucks up' )
                    console.error( e )
                })
        },
    },

}
</script>