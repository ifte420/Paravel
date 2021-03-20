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
                    <form action=" {{route('settingpost')}} " method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1">Header Title</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" value="{{$setting->where('setting_name', 'phone_number')->first()->setting_value }}" name="phone_number">
                            @error('phone_number')
                            <span class="text-danger"> {{$message}} </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword2">Email</label>
                            <input type="text" class="form-control" id="exampleInputPassword2" value="{{ $setting->where('setting_name', 'email_address')->first()->setting_value }}" name="email_address">
                            @error('email_address')
                            <span class="text-danger"> {{$message}} </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword3">Address</label>
                            <input type="text" class="form-control" id="exampleInputPassword3" value="{{ $setting->where('setting_name', 'address')->first()->setting_value }}" name="address">
                            @error('address')
                            <span class="text-danger"> {{$message}} </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword4">Footer Short description</label>
                            <input type="text" class="form-control" id="exampleInputPassword4" value="{{ $setting->where('setting_name', 'footer_short_description')->first()->setting_value }}" name="footer_short_description">
                            @error('footer_short_description')
                            <span class="text-danger"> {{$message}} </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword5">Facebook Link</label>
                            <input type="text" class="form-control" id="exampleInputPassword5" value="{{ $setting->where('setting_name', 'facebook_link')->first()->setting_value }}" name="facebook_link">
                            @error('facebook_link')
                            <span class="text-danger"> {{$message}} </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword6">Twitter Link</label>
                            <input type="text" class="form-control" id="exampleInputPassword6" value="{{ $setting->where('setting_name', 'twitter_link')->first()->setting_value }}" name="twitter_link">
                            @error('twitter_link')
                            <span class="text-danger"> {{$message}} </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword7">linkedin Link</label>
                            <input type="text" class="form-control" id="exampleInputPassword7" value="{{ $setting->where('setting_name', 'linkedin_link')->first()->setting_value }}" name="linkedin_link">
                            @error('linkedin_link')
                            <span class="text-danger"> {{$message}} </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword7">Offer Date</label>
                            <input type="date" class="form-control" id="exampleInputPassword7" value="{{ $setting->where('setting_name', 'offer_date')->first()->setting_value }}" name="offer_date">
                            @error('offer_date')
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