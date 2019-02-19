@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a New Thread</div>

                <div class="card-body">
                    <form action="/threads" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" class="form-control" value="{{ old( 'title' ) }}">
                        </div>

                        <div class="form-group">
                            <label for="body">Body:</label>
                            <textarea name="body" cols="30" rows="10" class="form-control">{{ old( 'body' ) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Publish</button>

                        @if ( count( $errors ) )
                            <ul class="alert alert-danger">
                                @foreach( $errors->all() as $error )
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection