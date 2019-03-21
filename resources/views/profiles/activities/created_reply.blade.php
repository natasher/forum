<div class="card mt-2">
    <div class="card-header">
        <div class="level">
            <span class="flex">
                {{ $profileUser->name }} replied to thread
            </span>
        </div>
    </div>

    <div class="card-body">
        {{ $activity->subject->body }}
    </div>
</div>