@extends('layouts.app')

@section('content')
<div class="container">
    <div class="pb-2 mt-4 mb-2 border-bottom display-3">
        Forum Threads
    </div>

    @forelse ( $threads as $thread )
        <article class="card mb-4">
            <div class="level card-header">
                <h4 class="flex">
                    <a href="{{ $thread->path() }}">
                        @if ( $thread->hasUpdatesFor( auth()->user() ) )
                            <strong>
                                {{ $thread->title }}
                            </strong>
                        @else
                            {{ $thread->title }}
                        @endif
                    </a>
                </h4>

                <a href="{{ $thread->path() }}">
                    {{ $thread->replies_count }} {{ str_plural( 'reply', $thread->replies_count ) }}
                </a>
            </div>

            <div class="card-body">{{ $thread->body }}</div>
        </article>
    @empty
        <p>There are no relevant results at this time.</p>
    @endforelse
</div>
@endsection