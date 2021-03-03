@extends('main')
@section('title', 'Dashbroad')
@endsection
@section('body')
    <div class="container">
        <h4 class="text-success text-center">Hello Shohan {{$shohan}} </h4>
        @for ($i = 1; $i <= 10; $i++)
            {{$i}}
        @endfor
    </div>

@endsection