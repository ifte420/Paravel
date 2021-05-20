@extends('layouts.starlight')

@section('title')
    Client Says
@endsection

@section('client', 'active')

@section('breadcrumb')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href=" {{route('home')}} ">Dashbroad</a>
    <span class="breadcrumb-item active">Client Says</span>
</nav>
@endsection

@section('content')
<div class="row">
    {{-- <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6 pt-1">Category List</div>
                    <div class="col-lg-6 text-right">
                        @if ($cupons->count() != 0)
                            <a href="{{ route('cart.delete.all') }}" class="btn btn-danger">Delete All</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    @if (session('category_delete_status'))
                        <div class="alert alert-danger">
                            {{session('category_delete_status')}}
                        </div>
                    @endif
                    <div class="alert alert-success text-center">
                        Total Category {{ $cupons->count() }}
                    </div>
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Cupon Name</th>
                            <th>Discount Amount</th>
                            <th>Expire Date</th>
                            <th>Uses</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action=" {{route('category_check_delete')}} " method="POST">
                            @csrf
                            @forelse ($cupons as $cupon)
                            <tr>
                                <td> {{$loop->index+1}} </td>
                                <td> {{Str::title($cupon->cupon_name)}} </td>
                                <td> {{ $cupon->discount_amount }} %</td>
                                <td> {{ $cupon->expire_date }} </td>
                                <td> {{ $cupon->uses_limit }} </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('cupon.edit', $cupon->id) }}" type="button" class="btn btn-info text-white">Edit</a>
                                        <form action="{{ route('cupon.destroy', $cupon->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-danger">No Data To Show</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div> --}}
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">Add Cupon</div>
            <div class="card-body">
                @if (session('insert_success'))
                    <div class="alert alert-success">
                        {{session('insert_success')}}
                    </div>
                @endif
                <form action=" {{route('client.store')}} " method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Client Says</label>
                        <textarea name="client_says" class="form-control" cols="30" rows="10">{{ old('client_says') }}</textarea>
                        @error('client_says')
                        <span class="text-danger d-block"> {{$message}} </span>
                        @enderror

                        <label>Client Name</label>
                        <input type="text" class="form-control" name="client_name" value="{{ old('client_name') }}">
                        @error('client_name')
                        <span class="text-danger d-block"> {{$message}} </span>
                        @enderror
                        
                        <label>Client Title</label>
                        <input type="text" class="form-control" name="client_title" value="{{ old('client_title') }}">
                        @error('client_title')
                        <span class="text-danger d-block"> {{$message}} </span>
                        @enderror

                        <label>Client Image</label>
                        <input type="file" class="form-control" name="client_image" value="{{ old('client_image') }}">
                        @error('client_image')
                        <span class="text-danger d-block"> {{$message}} </span>
                        @enderror

                    </div>
                    <button type="submit" class="btn btn-outline-secondary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

