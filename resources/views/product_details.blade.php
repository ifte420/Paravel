@extends('layouts.tohoney')
@section('title')
    Product Details
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

<!-- single-product-area start-->
<div class="single-product-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product-single-img">
                    <div class="product-active owl-carousel">
                        <div class="item">
                            <img src="{{asset('uploads/product')}}/{{ $products->product_image }}" alt="">
                        </div>
                        @foreach (App\Models\Feature_photo::where('product_id', $products->id)->get() as $feateure_photo)
                        <div class="item">
                            <img src="{{asset('uploads/product_feature')}}/{{ $feateure_photo->feature_image }}" alt="not found">
                        </div>
                        @endforeach
                    </div>
                    <div class="product-thumbnil-active owl-carousel">
                        <div class="item">
                            <img src="{{asset('uploads/product')}}/{{ $products->product_image }}" alt="">
                        </div>
                        @foreach (App\Models\Feature_photo::where('product_id', $products->id)->get() as $feateure_photo)
                        <div class="item">
                            <img src="{{asset('uploads/product_feature')}}/{{ $feateure_photo->feature_image }}" alt="not found">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product-single-content">
                    <h3>{{$products->product_name}}</h3>
                    <div class="rating-wrap fix">
                        <span class="pull-left">${{$products->product_price}}</span>
                        <ul class="rating pull-right">
                            @for ($i = 1; $i <= floor($overall_review); $i++)
                                <li><i class="fa fa-star"></i></li>
                            @endfor
                            @if (is_float($overall_review))
                                <li><i class="fa fa-star-half-o"></i></li>
                            @endif
                            <li>({{ $reviews->count() }} Customar Review)</li>
                        </ul>
                    </div>
                    <p>{{$products->product_short_description}}</p>
                    <div class="badge badge-success">Avaliable Stock: {{$products->product_quantity}}</div>
                    <form action="{{ route('cartpost', $products->id) }}" method="POST">
                        @csrf
                        <ul class="input-style">
                            <li class="quantity cart-plus-minus">
                                <input type="text" value="1" name="quantity"/>
                            </li>
                            <li>
                                <button style="background: #EF4836;" class="btn text-white ml-2">Add to Cart</button>
                            </li>
                            @error('quantity')
                                <small class="alert text-danger">{{ $message }}</small>
                            @enderror
                        </ul>
                    </form>
                    <ul class="cetagory">
                        <li>Categories:</li>
                        <li><a href="#">{{App\Models\Category::find($products->category_id)->category_name}}</a></li>
                    </ul>
                    <ul class="socil-icon">
                        <li>Share :</li>
                        <li>
                            <a href="http://www.facebook.com/sharer.php?u={{ url()->full() }}" target="_blank"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="http://twitter.com/share?url={{ url()->full() }} Share Buttons&hashtags=simplesharebuttons" target="_blank"><i class="fa fa-twitter"></i></a>
                        </li>
                    </ul>
                    @if (session('stock_not'))
                        <small class="text-danger">
                            {{ session('stock_not') }}
                        </small>
                    @endif
                    @if (session('quantity_error'))
                        <div class="alert alert-danger">
                            {{ session('quantity_error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row mt-60">
            <div class="col-12">
                <div class="single-product-menu">
                    <ul class="nav">
                        <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                        <li><a data-toggle="tab" href="#tag">Faq</a></li>
                        <li><a data-toggle="tab" href="#review">Review</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="tab-content">
                    <div class="tab-pane active" id="description">
                        <div class="description-wrap">
                            <p>{{$products->product_long_description}}</p>
                        </div>
                    </div>
                    <div class="tab-pane" id="tag">
                        <div class="faq-wrap" id="accordion">
                            @foreach ($faqs as $faq)
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5><button class="{{($loop->index==0?'':'collapsed')}}" data-toggle="collapse" data-target="#collapseOne{{$faq->id}}" aria-expanded="true" aria-controls="collapseOne">{{$faq->question}}</button></h5>
                                </div>
                                <div id="collapseOne{{$faq->id}}" class="collapse {{($loop->index==0?'show':'')}}" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        {{$faq->answer}}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane" id="review">
                        <div class="review-wrap">
                            <ul>
                                @foreach ($reviews as $review)
                                    <li class="review-items">
                                        <div class="review-img">
                                            <img src="{{asset('uploads/profile/'.$review->relation_user->profile_image)}}" alt="not found" class="rounded-circle" width="130px" height="130px">
                                        </div>
                                        <div class="review-content">
                                            <h3><a href="#">{{ $review->relation_user->name }}</a></h3>
                                            <span>{{ $review->created_at->format('d M, Y') }} AT {{ $review->created_at->format('h:i A') }}</span>
                                            <p>{{ $review->review_text }}</p>
                                            <ul class="rating">
                                                @for ($i = 1; $i <= $review->stars; $i++)
                                                    <li><i class="fa fa-star"></i></li>
                                                @endfor
                                            </ul>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- single-product-area end-->

<!-- featured-product-area start -->
<div class="featured-product-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center">
                    <h2>Related Product</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse ($related_product as $related_product)
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="featured-product-wrap">
                    <div class="featured-product-img">
                        <img src="{{asset('uploads/product')}}/{{ $related_product->product_image }}" alt="Not Found">
                    </div>
                    <div class="featured-product-content">
                        <div class="row">
                            <div class="col-7">
                                <h3><a href="{{route('product_details', $related_product->id)}}">{{ $related_product->product_name }}</a></h3>
                                <p>${{ $related_product->product_price }}</p>
                            </div>
                            <div class="col-5 text-right">
                                <ul>
                                    <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                    <li><a href="cart.html"><i class="fa fa-heart"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-12 col-sm-12 col-12 text-center" style="background: #EF4836; color:#ffffff; height:50px;">
                <div class="alert">
                    There are no related products
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
    <!-- featured-product-area end -->
@endsection