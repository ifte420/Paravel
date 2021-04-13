@extends('layouts.tohoney')

@section('title')
    Checkout
@endsection

@section('body')
<!-- checkout-area start -->
@if (Auth::user()->role == 2)
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-form form-style">
                    <h3>Billing Details (Logged in as: {{ Auth::user()->name }})</h3>
                    <form action="" method="">
                        <div class="row">
                            <div class="col-12">
                                <p>Name *</p>
                                <input type="text" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Email Address *</p>
                                <input type="email" value="{{ Auth::user()->email  }}">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Phone No. *</p>
                                <input type="text">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Country *</p>
                                <select id="select_id">
                                    <option value="">-Select-</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>City *</p>
                                <select>
                                    <option value="">Dhaka</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <p>Your Address *</p>
                                <input type="text">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Postcode/ZIP</p>
                                <input type="email">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Town/City *</p>
                                <input type="text">
                            </div>                     
                            <div class="col-12">
                                <p>Order Notes </p>
                                <textarea name="massage" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="order-area">
                    <h3>Your Order</h3>
                    <ul class="total-cost">
                        <li>Subtotal <span class="pull-right"><strong>${{ session('session_sub_total') }}</strong></span></li>
                        <li>Cupon Name <span class="pull-right">{{ (session('session_cupon_name'))? session('session_cupon_name'):"Not Applicable" }}</span></li>
                        <li>Discount Cupon <span class="pull-right"><strong>{{ (session('session_cupon_discount'))?session('session_cupon_discount'):0 }}%</strong></span></li>
                        <li>Total<span class="pull-right">${{ session('session_total') }}</span></li>
                    </ul>
                    <ul class="payment-method">
                        <li>
                            <input id="card" type="radio" name="payment_option">
                            <label for="card">Credit Card</label>
                        </li>
                        <li>
                            <input id="delivery" type="radio" name="payment_option">
                            <label for="delivery">Cash on Delivery</label>
                        </li>
                    </ul>
                    <button>Place Order</button>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger">
                    You are an admin, You Can not Checkout!
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!-- checkout-area end -->
@endsection

@section('tohoney_script')
    <script>
    $(document).ready(function() {
        $('#select_id').select2();
    });
    </script>
@endsection