@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route( 'profile', $thread->creator ) }}">{{ $thread->creator->name }}</a> posted:
                    {{ $thread->title }}
                </div>

                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">

                <div class="card-body">
                    <p>
                        This thread was published {{ $thread->created_at->diffForHumans() }} by
                        <a href="{{ route( 'profile', $thread->creator ) }}">{{ $thread->creator->name }}</a>, and currently has {{ $thread->replies_count }} {{ str_plural( 'comment', $thread->replies_count ) }}.
                    </p>
                </div>

            </div>
        </div>

    </div>

    <div class="row mt-4">
        <div class="col-md-8">

            @foreach ( $replies as $reply )
                @include ( 'threads.reply' )
            @endforeach

            <br>
            {{ $replies->links() }}

        </div>
    </div>

    @if ( auth()->check() )
        <div class="row mt-4">
            <div class="col-md-8">

                <form action="{{ $thread->path() . '/replies' }}" method="post">
                    @csrf

                    <div class="form-group">
                        <textarea name="body" id="body" class="form-control" placeholder="Have something to say?"></textarea>
                    </div>

                    <button type="submit" class="btn btn-default">Post</button>
                </form>

            </div>
        </div>
    @else
        <div class="row mt-4">
            <div class="col-md-8">
                You need to <a href="{{ route( 'login' ) }}">log in</a> to comment a thread.
            </div>
        </div>
    @endif

</div>
@endsection