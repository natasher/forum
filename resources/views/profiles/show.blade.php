@extends( 'layouts.app' )

@section( 'content' )
    <div class="container">
        <div class="pb-2 mt-4 mb-2 border-bottom display-3">
            {{ $profileUser->name }}
            <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
        </div>

        @foreach ( $activities as $date => $activity )
            <h3 class="pb-2 mt-4 mb-2 border-bottom">{{ $date }}</h3>

            @foreach( $activity as $record )
                @include ( "profiles.activities.{$record->type}", [ 'activity' => $record ] )
            @endforeach
        @endforeach

        {{-- {{ $threads->links() }} --}}

    </div>
@endsection