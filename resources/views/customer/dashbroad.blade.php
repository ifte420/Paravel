<div class="col-lg-12">
    <div class="card">
        <div class="card-header">Customer Dashbroad</div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Serial Number</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>subtotal</th>
                        <th>Discount</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th> {{$loop->index+1}} </th>
                            <td> {{Str::title($order->customer_name)}}</td>
                            <td>{{ $order->customer_phone_number }}</td>
                            <td>{{ $order->subtotal }}</td>
                            <td>{{ $order->discount }}</td>
                            <td>{{ $order->total }}</td>
                            <td>
                                <a href="{{ route('download_invoice', $order->id) }}"><i class="fa fa-download"></i>Download Invoice</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
