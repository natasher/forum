<template>
    <div>
    <!-- @if ( auth()->check() ) -->
        <div class="row mt-4">
            <div class="col-md-8">

                <div class="form-group">
                    <textarea
                        name="body"
                        id="body"
                        class="form-control"
                        v-model="body"
                        placeholder="Have something to say?">
                    </textarea>
                </div>

                <button type="submit" class="btn btn-default">Post</button>

            </div>
        </div>
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
            }
        },

    }
</script>