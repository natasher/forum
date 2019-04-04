<template>
    <div>
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

    <!-- @else -->
        <!-- <div class="row mt-4">
            <div class="col-md-8">
                You need to <a href="{{ route( 'login' ) }}">log in</a> to comment a thread.
            </div>
        </div> -->
    <!-- @endif -->
    </div>
</template>

<script>
    export default {

        name: 'new-reply',

        data() {
            return {
                body: '',
                endpoint: '/threads/dolor/16/replies',
            }
        },

        methods: {

            addReply() {
                axios.post( this.endpoint, { body: this.body })
                    .then( (data) => {
                        console.log( data );
                        this.body = '';

                        flash( 'Your reply has been posted.' );

                        this.$emit( 'created', data );
                    })
            },

        },

    }
</script>