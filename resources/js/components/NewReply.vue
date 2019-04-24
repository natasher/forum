<template>
    <div>

        <div v-if="signedIn">
            <div class="form-group">
                <textarea
                    name="body"
                    id="body"
                    class="form-control"
                    v-model="body"
                    required
                    placeholder="Have something to say?">
                </textarea>
            </div>

            <button
                type="submit"
                @click="addReply"
                class="btn btn-default">
                    Post
            </button>
        </div>

        <div class="row mt-4" v-else>
            <div class="col-md-8">
                You need to <a href="/login">log in</a> to comment a thread.
            </div>
        </div>

    </div>
</template>

<script>
    export default {

        name: 'new-reply',

        data() {
            return {
                body: '',
            }
        },

        computed: {
            signedIn() {
                return window.App.signedIn;
            },
        },

        methods: {

            addReply() {
                axios.post( `${ location.pathname }/replies`, { body: this.body })
                    .catch( error => {
                        flash( error.response.data, 'danger' )
                    })
                    .then( ({ data }) => {
                        this.body = '';

                        flash( 'Your reply has been posted.' );

                        this.$emit( 'created', data );
                    })
            },

        },

    }
</script>