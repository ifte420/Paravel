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
                    <form action="{{ route('checkout_post') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <p>Name *</p>
                                <input type="text" value="{{ Auth::user()->name }}" name="customer_name">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Email Address *</p>
                                <input type="email" value="{{ Auth::user()->email  }}" name="customer_email">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Phone No. *</p>
                                <input type="text" name="customer_phone_number">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Country *</p>
                                <select id="country_list" name="customer_country_id">
                                    <option value="">-Select-</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>City *</p>
                                <select id="city_list" name="customer_city_id">
                                    <option value="">-Select-</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Your Address *</p>
                                <input type="text" name="customer_address">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Postcode/ZIP *</p>
                                <input type="number" name="customer_postcode">
                            </div>
                            <div class="col-12">
                                <p>Order Notes </p>
                                <textarea name="customer_message" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                            </div>
                        </div>
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
                                <input id="card" type="radio" name="payment_option" value="1" checked>
                                <label for="card">Credit Card</label>
                            </li>
                            <li>
                                <input id="delivery" type="radio" name="payment_option" value="2">
                                <label for="delivery">Cash on Delivery</label>
                            </li>
                        </ul>
                        <button type="submit">Place Order</button>
                    </form>
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
        $('#country_list').select2();
        $('#city_list').select2();

        $('#country_list').change(function(){
            var country_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: 'get/city/list',
                data: {country_id:country_id},
                success: function(data){
                    $('#city_list').html(data);
                }
            });
        });
    });
    </script>
@endsection