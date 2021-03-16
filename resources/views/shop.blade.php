@extends('layouts.tohoney')
@section('title')
    Shop Page
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
            <div class="col-sm-12 col-lg-12">
                <div class="product-menu">
                    <ul class="nav justify-content-center">
                        <li>
                            <a class="active" data-toggle="tab" href="#all">All product</a>
                        </li>
                        @foreach ($categories as $category)
                        <li>
                            <a data-toggle="tab" href="#dynamic_id{{ $category->id }}">{{ $category->category_name }}</a>
                        </li>
                        @endforeach
                    </ul>
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
                            There are no products!
                        </div>
                    </div>
                    @endforelse
                    <li class="col-12 text-center">
                        <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
                    </li>
                </ul>
            </div>
            @foreach ($categories as $category)
            <div class="tab-pane" id="dynamic_id{{ $category->id }}">
                <ul class="row">
                    @forelse (App\Models\Product::where('category_id' , $category->id)->get() as $product)
                        @include('little_part.product')
                    @empty
                    <div class="col-lg-12 col-sm-12 col-12 text-center" style="background: #EF4836; color:#ffffff; height:50px;">
                        <div class="alert">
                            There are no products in {{ $category->category_name }} Category!
                        </div>
                    </div>
                    @endforelse
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- product-area end -->
@endsection