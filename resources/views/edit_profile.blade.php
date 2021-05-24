@extends('layouts.starlight')

@section('title')
    Edit Profile
@endsection
@section('dashboard')
    active
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href=" {{route('home')}}">Dashbroad</a>
        <span class="breadcrumb-item active">Edit Profile</span>
    </nav>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6 pt-1">Edit Name</div>
                </div>
            </div>
            <div class="card-body">
                @if (session('name_succ'))
                    <div class="alert alert-success">
                        {{ session('name_succ') }}
                    </div>
                @endif
                <form action="{{ route('name_update') }}" method="POST">
                    @csrf
                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="name" placeholder="Edit Your Name">
                    <button type="submit" class="btn btn-info mt-2">Update</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6 pt-1">Password Change</div>
                </div>
            </div>
            <div class="card-body">
                @if (session('pass_wrg'))
                    <div class="alert alert-danger">
                        {{ session('pass_wrg') }}
                    </div>
                @endif
                @if (session('pass_succ'))
                    <div class="alert alert-success">
                        {{ session('pass_succ') }}
                    </div>
                @endif
                <form action="{{ route('password_update') }}" method="POST">
                    @csrf
                    <input type="password" class="form-control mb-3" name="current_password" placeholder="Current Password">
                    @error('current_password')
                        <span class="text-danger"> {{$message}} </span>
                    @enderror
                    <input type="password" class="form-control mb-3" name="password" placeholder="New Password">
                    @error('password')
                        <span class="text-danger d-block"> {{$message}} </span>
                    @enderror
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm New Password">
                    @error('password_confirmation')
                        <span class="text-danger d-block"> {{$message}} </span>
                    @enderror
                    <button type="submit" class="btn btn-info mt-2">Update</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6 pt-1">Change Profile Picture</div>
                </div>
            </div>
            <div class="card-body">
                @if (session('picture_update'))
                    <div class="alert alert-success">
                        {{ session('picture_update') }}
                    </div>
                @endif
                <form action="{{ route('profile_image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="text-center mb-2">
                        <img src="{{ asset('uploads/profile/'. Auth::user()->profile_image) }}" alt="not found" class="rounded-circle" height="250px">
                    </div>
                    <input type="file" class="form-control mb-3" name="profile_image" placeholder="Current Password">
                    @error('profile_image')
                        <span class="text-danger d-block"> {{$message}} </span>
                    @enderror
                    <button type="submit" class="btn btn-info mt-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
