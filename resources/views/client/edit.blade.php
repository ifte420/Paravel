@extends('layouts.starlight')

@section('title')
    Client Says
@endsection

@section('client')
    active
@endsection

@section('breadcrumb')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href=" {{route('home')}} ">Dashbroad</a>
    <a class="breadcrumb-item" href=" {{route('client.index')}} ">Client</a>
    <span class="breadcrumb-item active">Client Edit</span>
</nav>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">Edit Client Says</div>
                <div class="card-body">
                    <form action=" {{route('client.update', $client->id)}} " method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Client Says</label>
                            <textarea name="client_says" class="form-control" cols="30" rows="10">{{ old('client_says') }} {{ $client->client_says }}</textarea>
                            @error('client_says')
                            <span class="text-danger d-block"> {{$message}} </span>
                            @enderror

                            <label>Client Name</label>
                            <input type="text" class="form-control" name="client_name" value="{{ old('client_name') }} {{ $client->client_name }}">
                            @error('client_name')
                            <span class="text-danger d-block"> {{$message}} </span>
                            @enderror
                            
                            <label>Client Title</label>
                            <input type="text" class="form-control" name="client_title" value="{{ old('client_title') }} {{ $client->client_title }}">
                            @error('client_title')
                            <span class="text-danger d-block"> {{$message}} </span>
                            @enderror

                            <label class="d-block">Now Client Photo</label>
                            <img src="{{ asset('uploads/client/'.$client->client_image) }}" alt="not found" class="rounded-circle d-block mb-1">

                            <label>Client Image</label>
                            <input type="file" class="form-control" name="client_image">
                            @error('client_image')
                            <span class="text-danger d-block"> {{$message}} </span>
                            @enderror

                        </div>
                        <button type="submit" class="btn btn-outline-secondary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection