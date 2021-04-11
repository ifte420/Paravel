@extends('layouts.tohoney')
@section('title')
    Cart Page
@endsection
@section('body')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Shopping Cart</h2>
                    <ul>
                        <li><a href="{{ route('tohoney_home') }}">Home</a></li>
                        <li><span>Shopping Cart</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- cart-area start -->
<div class="cart-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('update_cart') }}" method="POST">
                    @csrf
                    <table class="table-responsive cart-wrap">
                        <thead>
                            <tr>
                                <th class="images">Image</th>
                                <th class="product">Product</th>
                                <th class="ptice">Price</th>
                                <th class="quantity">Quantity</th>
                                <th class="total">Total</th>
                                <th class="remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $flag = false;
                                $sub_total = 0;
                            @endphp
                            @forelse ($carts as $cart)
                            <tr>
                                @if (isset(App\Models\Product::find($cart->product_id)->id))
                                    <td class="images"><img src="{{ asset('uploads/product')}}/{{$cart->relation_product->product_image}}" alt="not found"></td>
                                    <td class="product">
                                        <a href="{{route('product_details', $cart->relation_product->id)}}">
                                            {{ $cart->relation_product->product_name }}
                                        </a>
                                        @if (isset($_SESSION['quantity_'.$cart->id]))
                                            <small class="text-danger d-block">
                                                @php
                                                    echo $_SESSION['quantity_'.$cart->id];
                                                @endphp
                                            </small>
                                            @php
                                                unset($_SESSION['quantity_'.$cart->id])
                                            @endphp
                                        @endif
                                        @if ($cart->relation_product->product_quantity < $cart->quantity)
                                            <div class="badge badge-danger">Stock Available: {{ $cart->relation_product->product_quantity }}</div>
                                        @php
                                            $flag = true;
                                        @endphp
                                        @endif
                                    </td>
                                    <td class="price">${{ $cart->relation_product->product_price }}</td>
                                    <td class="quantity cart-plus-minus">
                                        <input type="text" value="{{ $cart->quantity }}" name="quantity[{{ $cart->id }}]"/>
                                    </td>
                                    <td class="total">
                                        ${{ $cart->relation_product->product_price * $cart->quantity }}
                                        @php
                                            $sub_total += $cart->relation_product->product_price * $cart->quantity;
                                        @endphp
                                    </td>
                                    <td class="remove">
                                        <a href="{{ route('cartdelete', $cart->id) }}">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                @else
                                    <td class="images">Stock Out</td>
                                    <td class="product">
                                        <p>
                                            Stock Out
                                        </p>
                                    </td>
                                    <td class="price">$0</td>
                                    <td class="quantity cart-plus-minus">
                                        <input type="text" value="{{ $cart->quantity }}"/>
                                    </td>
                                    <td class="total">
                                        $0
                                    </td>
                                    <td class="remove">
                                        <a href="{{ route('cartdelete', $cart->id) }}">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                            @empty
                            <tr class="text-danger flex-row">
                                <td colspan="100">
                                    No Product Show
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="row mt-60">
                        <div class="col-xl-4 col-lg-5 col-md-6 ">
                            <div class="cartcupon-wrap">
                                <ul class="d-flex">
                                    <li>
                                        <button>Update Cart</button>
                                    </li>
                                    <li><a href="{{ route('shop') }}">Continue Shopping</a></li>
                                </ul>
                                <h3>Cupon</h3>
                                <p>Enter Your Cupon Code if You Have One</p>
                                <div class="cupon-wrap">
                                    <input type="text" placeholder="Cupon Code" id="apply_add_input" value="{{ $cupon_name }}">
                                    <button id="apply_add_btn" type="button">Apply Cupon</button>
                                    @if (session('limit_finish'))
                                        <small class="text-danger">
                                            {{ session('limit_finish') }}
                                        </small>
                                    @endif
                                    @if (session('expire'))
                                        <small class="text-danger">
                                            {{ session('expire') }}
                                        </small>
                                    @endif
                                    @if (session('invalid'))
                                        <small class="text-danger">
                                            {{ session('invalid') }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                            <div class="cart-total text-right">
                                <h3>Cart Totals</h3>
                                <ul>
                                    <li><span class="pull-left">Subtotal </span>${{ $sub_total }}</li>
                                    <li><span class="pull-left">Discount% </span>{{ $cupon_discount }}%</li>
                                    <li><span class="pull-left">Total</span>${{ $sub_total - (($cupon_discount/100)*$sub_total) }}</li>
                                </ul>
                                @php
                                    session([
                                        'session_sub_total' => $sub_total,
                                        'session_cupon_name' => $cupon_name,
                                        'session_cupon_discount' => $cupon_discount,
                                        'session_total' => $sub_total - (($cupon_discount/100)*$sub_total),
                                    ]);
                                @endphp
                                @if ($flag)
                                    <a href="">There Are Some Problem</a>
                                @else
                                    <a href="{{ route('checkout') }}">Proceed to Checkout</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- cart-area end -->
@endsection

@section('tohoney_script')
    <script>
        $(document).ready(function(){
            $('#apply_add_btn').click(function(){
                var cupon_name = $('#apply_add_input').val();
                var link_to_go = "{{ route('cart') }}/" + cupon_name;
                window.location.href = link_to_go;
            });
        });
    </script>
@endsection