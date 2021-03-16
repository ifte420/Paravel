@extends('layouts.tohoney')
@section('title')
    {{ $one_category->category_name }} Category Wise Product
@endsection
@section('body')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Shop Page</h2>
                    <ul>
                        <li><a href="{{ route('tohoney_home') }}">Home</a></li>
                        <li><span>Shop</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- product-area start -->
<div class="product-area pt-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>{{ $one_category->category_name }} Category Wise Product</h2>
                    <img src="{{asset('tohoney_assets')}}/images/section-title.png" alt="">
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="all">
                <ul class="row">
                    @forelse ($products as $product)
                        @include('little_part.product')
                    @empty
                    <div class="col-lg-12 col-sm-12 col-12 text-center" style="background: #EF4836; color:#ffffff; height:50px;">
                        <div class="alert">
                            {{ $one_category->category_name }} category has no product
                        </div>
                    </div>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- product-area end -->
@endsection