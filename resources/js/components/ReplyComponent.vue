<template>
    <div :id="`reply-${ id }`" class="card mt-2">
        <div class="card-header">
            <div class="level">
                <h5 class="flex">
                    <a :href="`/profiles/${ data.owner.name }`"
                        v-text="data.owner.name">
                    </a> said <span v-text="ago"></span>...
                </h5>

                <div v-if="signedIn">
                    <favorite :reply="data"></favorite>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control"
                        v-model="body">
                    </textarea>
                </div>

                <button class="btn btn-xs btn-primary"
                    @click="update">
                    Update
                </button>
                <button class="btn btn-xs btn-link"
                    @click="editing = false">
                    Cancel
                </button>
            </div>

            <div v-else v-text="body"></div>
        </div>

        <div class="card-footer level" v-if="canUpdate">

            <button class="btn btn-xs mr-1"
                @click="editing = true">
                Edit
            </button>

            <button class="btn btn-xs btn-danger mr-1"
                @click="destroy">
                Delete
            </button>

        </div>

    </div>
</template>

<script>
    import favorite from './FavoriteComponent.vue'
    import * as moment from 'moment';

    export default {

        name: 'reply',

        components: { favorite },

        props: [ 'data' ],

        data() {
            return {
                id: this.data.id,
                editing: false,
                body   : this.data.body
            }
        },

        computed: {
            signedIn: () => {
                return window.App.signedIn;
            },

            canUpdate: function () {
                return this.authorize( user => this.data.user_id == user.id );
            },

            ago() {
                return moment( this.data.created_at ).fromNow() + '...';
            },
        },

        methods: {
            update() {
                axios.patch(
                    '/replies/' + this.data.id,
                    {
                        body: this.body,
                    })
                    .then(() => {

                        this.editing = false;

                        flash( 'Updated!' );

                    })
                    .catch( error => {
                        flash( error.response.data, 'danger' )
                    })
            },

            destroy() {
                axios.delete( '/replies/' + this.data.id );

                this.$emit( 'deleted', this.data.id );
            },
        },

    }
</script>