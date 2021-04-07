@extends('layouts.starlight')

@section('title')
    Cupon
@endsection

@section('cupon')
    active
@endsection

@section('breadcrumb')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href=" {{route('home')}} ">Dashbroad</a>
    <span class="breadcrumb-item active">Category Page</span>
</nav>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 pt-1">Category List</div>
                        <div class="col-lg-6 text-right">

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
                            Total Category 
                        </div>
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Cupon Name</th>
                                <th>Discount Amount</th>
                                <th>Expire Date</th>
                                <th>Uses</th>
                                <th>Created at</th>
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
                                    <td> {{ $cupon->discount_amount }} </td>
                                    <td> {{ $cupon->expire_date }} </td>
                                    <td> {{ $cupon->uses_limit }} </td>
                                    <td> {{$cupon->created_at->format('d/m/Y h:i:s')}} </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            {{-- <a href="" type="button" class="btn btn-info text-white">Edit</a> --}}
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
                                    <td colspan="5" class="text-center text-danger">No Data To Show</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Add Cupon</div>
                <div class="card-body">
                    <form action=" {{route('cupon.store')}} " method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Cupon Name</label>
                            <input type="text" class="form-control @error('cupon_name') is-invalid @enderror" name="cupon_name" value="{{ old('cupon_name') }}">
                            @error('cupon_name')
                            <span class="text-danger d-block"> {{$message}} </span>
                            @enderror

                            <label>discount amount</label>
                            <input type="number" class="form-control @error('discount_amount') is-invalid @enderror" name="discount_amount" value="{{ old('discount_amount') }}">
                            @error('discount_amount')
                            <span class="text-danger d-block"> {{$message}} </span>
                            @enderror
                            
                            <label>expire_date</label>
                            <input type="date" class="form-control @error('expire_date') is-invalid @enderror" name="expire_date" value="{{ old('expire_date') }}">
                            @error('expire_date')
                            <span class="text-danger d-block"> {{$message}} </span>
                            @enderror
                            
                            <label>uses_limit</label>
                            <input type="number" class="form-control @error('uses_limit') is-invalid @enderror" name="uses_limit" value="{{ old('uses_limit') }}">
                            @error('uses_limit')
                            <span class="text-danger d-block"> {{$message}} </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-secondary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 pt-1">Total Soft Category List</div>
                        <div class="col-lg-6 text-right">
                            {{-- @if ($deleted_categories->count() != 0 ) --}}
                                <button class="btn btn-success" id="restore_all">Restore All</button>
                                <button class="btn btn-danger" id="delete_force_all">Delete All</button>
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Checked</th>
                                <th>Serial No</th>
                                <th>Category Name</th>
                                <th>Created at</th>
                                <th>Category Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <form action=" {{route('category_soft_check')}} " method="POST">
                            @csrf
                            <tbody>
                                {{-- @forelse ($deleted_categories as $deleted_category)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checked_button" name="delete_id[]" value="{{$deleted_category->id}}">
                                    </td>
                                    <td> {{$loop->index+1}} </td>
                                    <td> {{Str::title($deleted_category->category_name)}} </td>
                                    <td> {{$deleted_category->created_at->format('d/m/Y h:i:s')}} </td>
                                    <td>
                                        <div class="image">
                                            <img src="{{asset('uploads/category')}}/{{$deleted_category->category_image}}" alt="Not Found" class="img-fluid">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href=" {{route('category_restore',$deleted_category->id)}}" type="button" class="btn btn-success text-white">Restore</a>
                                            <a href=" {{route('categoryforce',$deleted_category->id)}}" type="button" class="btn btn-danger">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-danger">No Data To Show</td>
                                </tr>
                                @endforelse --}}
                            </tbody>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

