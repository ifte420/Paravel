@extends('layouts.tohoney')
@section('title')
    Search Page
@endsection
@section('body')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Search Page</h2>
                    <ul>
                        <li><a href="{{ route('tohoney_home') }}">Home</a></li>
                        <li><span>Search</span></li>
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
        {{-- <div class="row">
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
        </div> --}}
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
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- product-area end -->
@endsection