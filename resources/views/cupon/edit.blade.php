@extends('layouts.starlight')

@section('title')
    Cupon
@endsection

@section('cupon')
    active
@endsection

@section('breadcrumb')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href=" {{route('home')}} ">Dashbroad</a>
    <a class="breadcrumb-item" href=" {{route('cupon.index')}} ">Cupon</a>
    <span class="breadcrumb-item active">Cupon Edit</span>
</nav>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">Edit Cupon</div>
                <div class="card-body">
                    <form action=" {{route('cupon.update', $cupon->id)}} " method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Cupon Name</label>
                            <input type="text" class="form-control @error('cupon_name') is-invalid @enderror" name="cupon_name" value=" {{ $cupon->cupon_name }}">
                            @error('cupon_name')
                            <span class="text-danger d-block"> {{$message}} </span>
                            @enderror

                            <label>discount amount</label>
                            <input type="number" class="form-control @error('discount_amount') is-invalid @enderror" name="discount_amount" value="{{ $cupon->discount_amount }}">
                            @error('discount_amount')
                            <span class="text-danger d-block"> {{$message}} </span>
                            @enderror
                            
                            <label>expire_date</label>
                            <input type="date" class="form-control @error('expire_date') is-invalid @enderror" name="expire_date" value="{{ $cupon->expire_date }}">
                            @error('expire_date')
                            <span class="text-danger d-block"> {{$message}} </span>
                            @enderror
                            
                            <label>uses_limit</label>
                            <input type="number" class="form-control @error('uses_limit') is-invalid @enderror" name="uses_limit" value="{{ $cupon->uses_limit }}">
                            @error('uses_limit')
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

