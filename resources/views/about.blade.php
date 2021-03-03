@extends('main')
@section('title', "About")
@section('body')

<div class="container">
    <div class="alert alert-danger">
        @foreach ($country as $name)
            <h3> {{$loop->index + 1}} {{$name}}</h3>
        @endforeach
    </div>
</div>

@endsection