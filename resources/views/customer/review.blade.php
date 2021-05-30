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
    <span class="breadcrumb-item active">Review</span>
</nav>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">Give Review</div>
                <div class="card-body">
                    @foreach ($order_details as $order_detail)
                        <div class="card">
                            <div class="card-header">
                                {{ App\Models\Product::find($order_detail->product_id)->product_name }}
                            </div>
                            <div class="card-body">
                                <form action="{{ route('review_post', $order_detail->id) }}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" name="review_text">
                                    <input type="range" id="points" name="star" min="1" max="5" value="1">
                                    <button class="btn btn-info d-block">Give Review</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

