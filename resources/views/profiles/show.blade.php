@extends( 'layouts.app' )

@section( 'content' )
    <div class="container">
        <div class="pb-2 mt-4 mb-2 border-bottom display-3">
            {{ $profileUser->name }}
            <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
        </div>

        @foreach ( $activities as $activity )
            @include ( "profiles.activities.{$activity->type}" )
        @endforeach

        {{-- {{ $threads->links() }} --}}

    </div>
@endsection