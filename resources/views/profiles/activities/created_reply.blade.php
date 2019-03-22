<div class="card mt-2">
    <div class="card-header">
        <div class="level">
            <span class="flex">
                {{ $profileUser->name }} replied to "{{ $activity->subject->thread->title }}"
            </span>
        </div>
    </div>

    <div class="card-body">
        {{ $activity->subject->body }}
    </div>
</div>