<div class="card mt-2">
    <div class="card-header">
        <div class="level">
            <h5 class="flex">
                <a href="#">
                    {{ $reply->owner->name }}
                </a> said {{ $reply->created_at->diffForHumans() }}...
            </h5>

            <div>
                <form action="/replies/{{ $reply->id }}/favorites" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary">Favorite</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        {{ $reply->body }}
    </div>
</div>