@extends('layouts.starlight')

@section('title')
    Dashbroad Page
@endsection
@section('dashboard')
    active
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <span class="breadcrumb-item active">Dashbroad</span>
    </nav>
@endsection

@section('content')
<div class="container">
    @if (Auth::user()->role == 1)
        <div class="row justify-content-center mb-5">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Payment Chart
                    </div>
                    <div class="card-body">
                        <div>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row justify-content-center">
        @if (Auth::user()->role == 1)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="alert alert-success text-center">
                            Total Users: {{$users->count()}}
                        </div>
                        <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Serial Number</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th> {{$loop->index+1}} </th>
                                    <td> {{Str::title($user->name)}}</td>
                                    <td> {{$user->email}} </td>
                                    <td> {{$user->created_at->diffForHumans()}} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        @else
            @include('customer.dashbroad')
        @endif
    </div>
</div>
@endsection

@section('footer_script')
<script>
  // === include 'setup' then 'config' above ===
    const labels = [
    'Cash On Delivery',
    'Credit Card',

    ];
    const data = {
    labels: labels,
    datasets: [{
        label: 'Total number of payments',
        backgroundColor:[
            '#ff7979',
            '#30336b'
        ],
        borderColor: '#ecf0f1',
        data: [{{ $credit_card }}, {{ $cod }}],
    }]
    };

    const config = {
    type: 'doughnut',
    data,
    options: {}
    };

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
@endsection