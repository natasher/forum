<template>
    <div class="dropdown" v-if="notifications.length">

        <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Notifications
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#" v-for="notification in notifications">
                <a :href="notification.data.link"
                    v-text="notification.data.message"
                    @click="markAsRead( notification )" />
            </a>
        </div>

    </div>
</template>

<script>
    export default {

        name: 'user-notifications',

        data() {
            return {
                notifications: false,
            }
        },

        created() {
            axios.get( '/profiles/' + window.App.user.name + '/notifications' )
                .then( resp => this.notifications = resp.data );
        },

        methods: {
            markAsRead( notification ) {
                axios.delete( '/profiles/' + window.App.user.name + '/notifications/' + notification.id )
            },
        },

    }
</script>