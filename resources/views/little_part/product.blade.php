<li class="col-xl-3 col-lg-4 col-sm-6 col-12">
    <div class="product-wrap">
        <div class="product-img">
            <img src="{{asset('uploads/product')}}/{{ $product->product_image }}" alt="Not Found">
            <div class="product-icon flex-style">
                <ul>
                    <li><a data-toggle="modal" data-target="#exampleModalCenter_{{ $product->id }}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                    <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                    <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="product-content">
            <h3><a href="{{route('product_details', $product->id)}}">{{$product->product_name}}</a></h3>
            <p class="pull-left">${{$product->product_price}}</p>
            <ul class="pull-right d-flex">
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star-half-o"></i></li>
            </ul>
        </div>
    </div>
</li>

<!-- Modal area start -->
    <div class="modal fade" id="exampleModalCenter_{{ $product->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body d-flex">
                    <div class="product-single-img w-50">
                        <img src="{{asset('uploads/product')}}/{{ $product->product_image }}" alt="">
                    </div>
                    <div class="product-single-content w-50">
                        <h3><a href="{{route('product_details', $product->id)}}">{{$product->product_name}}</a></h3>
                        <div class="rating-wrap fix">
                            <span class="pull-left">${{$product->product_price}}</span>
                            <ul class="rating pull-right">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li>(05 Customar Review)</li>
                            </ul>
                        </div>
                        <p>{{$product->product_short_description}}</p>
                        <div class="badge badge-success">Avaliable Stock: {{$product->product_quantity}}</div>
                        <form action="{{ route('cartpost', $product->id) }}" method="POST">
                            @csrf
                            <ul class="input-style">
                                <li class="quantity cart-plus-minus">
                                    <input type="text" value="1" name="quantity"/>
                                </li>
                                <li>
                                  <input type="submit" class="text-white bg-danger border-0 addtocart" style="padding: 5.5px 10px; cursor: pointer;" value="Add to Cart" min="1" onclick="ShowDiv()">
                                    {{-- <button id="product_id" value="1" style="visibility: hidden"></button> --}}
                                </li>
                                @error('quantity')
                                <small class="alert text-danger">{{ $message }}</small>
                                @enderror
                            </ul>
                        </form>
                        <ul class="cetagory">
                            <li>Categories:</li>
                            <li>
                                <a href="{{ route('category_wise_shop',$product->category_id) }}">{{ App\Models\Category::find($product->category_id)->category_name }}</a>
                            </li>
                        </ul>
                        <ul class="socil-icon">
                            <li>Share :</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal area start -->