@extends('layouts.starlight')

@section('title')
    Dashbroad Page
@endsection
@section('dashboard')
    active
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <span class="breadcrumb-item active">Dashbroad</span>
    </nav>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (Auth::user()->role == 1)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                        <div class="alert alert-success text-center">
                            Total Users: {{$users->count()}}
                        </div>
                        <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Serial Number</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th> {{$loop->index+1}} </th>
                                    <td> {{Str::title($user->name)}}</td>
                                    <td> {{$user->email}} </td>
                                    <td> {{$user->created_at->diffForHumans()}} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        @else
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">I am Customer</div>
            </div>
            <div class="card-body">
                Hello world
            </div>
        </div>
        {{-- @include('cupon.index') --}}
        @endif
    </div>
</div>
@endsection
