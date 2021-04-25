<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Your Invoice</title>
  </head>
    <style>
      .body-main {
          background: #ffffff;
          border-bottom: 10px solid #1E1F23;
          border-top: 10px solid #1E1F23;
          margin-top: 5px;
          margin-bottom: 5px;
          padding: 20px 10px !important;
          position: relative;
          box-shadow: 0 1px 21px #808080;
          font-size: 12px
      }

      .main thead {
          background: #1E1F23;
          color: #fff
      }

      .img {
          height: 100px;
      }

      h1 {
          text-align: center
      }
    </style>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 body-main">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4"> <img class="img" alt="Invoce Template" src="http://pngimg.com/uploads/shopping_cart/shopping_cart_PNG59.png"/> </div>
                        <div class="col-md-8 text-right">
                            <h4 style="color: #F81D2D;"><strong>Tohoney</strong></h4>
                            @if ( App\Models\Setting::where('setting_name','address')->first()->setting_value )
                                <p>{{ App\Models\Setting::where('setting_name','address')->first()->setting_value }}</p>
                            @endif
                            @if ( App\Models\Setting::where('setting_name','email_address')->first()->setting_value )
                                <p>{{ App\Models\Setting::where('setting_name','email_address')->first()->setting_value }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2>INVOICE</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Name: {{ $order_data->customer_name }}</h6>
                            <h6>Phone Number: {{ $order_data->customer_phone_number }}</h6>
                            <h6>Order Date time: {{ $order_data->created_at->format('M-d-Y h:i:s')}}</h6>
                        </div>
                        <br>
                    </div>
                     <br />
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <h5>Serial Id</h5>
                                    </th>
                                    <th>
                                        <h5>Product Name</h5>
                                    </th>
                                    <th>
                                        <h5>Product Image</h5>
                                    </th>
                                    <th>
                                        <h5>Price</h5>
                                    </th>
                                    <th>
                                        <h5>Quantity</h5>
                                    </th>
                                    <th>
                                        <h5>Unit price</h5>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $subtotal = 0;
                                @endphp
                                @foreach ($order_details as $order_detail)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $order_detail->relation_product->product_name }}</td>
                                        <td>
                                            <img src="uploads/product/{{ $order_detail->relation_product->product_image }}" alt="" width="80px" height="80px">
                                        </td>
                                        <td>{{ $order_detail->relation_product->product_price }} </td>
                                        <td>{{ $order_detail->quantity }}</td>
                                        <td>{{ $order_detail->relation_product->product_price * $order_detail->quantity}}
                                            @php
                                                $subtotal += $order_detail->relation_product->product_price * $order_detail->quantity
                                            @endphp
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2">
                                        <p> <strong>SubTotal: </strong> </p>
                                    </td>
                                    <td colspan="4" class="text-right">
                                        <p> <strong><i class="fas fa-rupee-sign" area-hidden="true"></i>{{ $subtotal }} </strong> </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <p> <strong>Discount: </strong> </p>
                                    </td>
                                    <td colspan="4" class="text-right">
                                        <p> <strong><i class="fas fa-rupee-sign" area-hidden="true"></i>{{ $order_data->discount }}</strong> </p>
                                    </td>
                                </tr>
                                <tr style="color: #F81D2D;">
                                    <td class="text-left" colspan="2">
                                        <h4><strong>Total:</strong></h4>
                                    </td>
                                    <td class="text-right" colspan="4">
                                        <h4><strong><i class="fas fa-rupee-sign" area-hidden="true"></i> {{ $subtotal - (($order_data->discount/100) * $subtotal) }} </strong></h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  </body>
</html>