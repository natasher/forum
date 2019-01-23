<div class="card mt-2">
    <div class="card-header">
        {{ $reply->owner->name }} said {{ $reply->created_at->diffForHumans() }}...
    </div>

    <div class="card-body">
        {{ $reply->body }}
    </div>
</div>