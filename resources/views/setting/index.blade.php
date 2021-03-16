@extends('layouts.starlight')

@section('title')
    Web Setting
@endsection
@section('setting')
    active
@endsection

@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href=" {{route('home')}} ">Dashbroad</a>
        <a class="breadcrumb-item" href=" {{route('category')}}">Category</a>
        <a class="breadcrumb-item" href=" {{route('product')}} ">Product</a>
        <a class="breadcrumb-item" href=" {{route('contact_backend')}} ">Contact</a>
        <a class="breadcrumb-item" href=" {{route('faq')}} ">Faq</a>
        <a class="breadcrumb-item" href=" {{route('header')}} ">Header</a>
        <span class="breadcrumb-item active">Setting</span>
    </nav>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">Web Setting</div>
                <div class="card-body">
                    <form action=" {{route('header_post')}} " method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1">Header Title</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" value="{{ $setting->where('setting_name', 'phone_Number')->first()->setting_value }}" name="phone_number">
                            @error('header_title')
                            <span class="text-danger"> {{$message}} </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email Address</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" value="{{ $setting->where('setting_name', 'email_address')->first()->setting_value }}" name="email_address">
                            @error('header_title')
                            <span class="text-danger"> {{$message}} </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Update Setting</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection