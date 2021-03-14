@extends('layouts.starlight')

@section('title')
    Header
@endsection
@section('header')
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
                <div class="card-header text-white bg-secondary">
                    <div class="row">
                        <div class="col-lg-6 pt-1">Header List</div>
                        <div class="col-lg-6 text-right">
                            {{-- @if ($categories->count() != 0 ) --}}
                            <a href="{{ route('header_soft_all')}}" type="button" class="btn btn-danger">Delete All</a>
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <div class="alert alert-success text-center">
                            Total Category {{$headers_normal->count()}}
                        </div>
                        @if (session('single_soft'))
                            <div class="alert alert-danger text-center">
                                {{ session('single_soft') }}
                            </div>
                        @endif
                        @if (session('all_soft'))
                            <div class="alert alert-danger text-center">
                                {{ session('all_soft') }}
                            </div>
                        @endif
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Header Title</th>
                                <th>Header description</th>
                                <th>Header Image</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($headers_normal as $header)
                            <tr>
                                <td> {{$loop->index+1}} </td>
                                <td> {{Str::title($header->header_title)}} </td>
                                <td>{{ $header->header_description }}</td>
                                <td>
                                    <div class="image">
                                        <img src="{{asset('uploads/header')}}/{{$header->header_image}}" alt="Not Found" class="img-fluid">
                                    </div>
                                </td>
                                <td> {{$header->created_at->format('d/m/Y h:i:s')}} </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        {{-- <a href="" type="button" class="btn btn-info text-white">Edit</a> --}}
                                        <a href="{{ route('header_soft', $header->id)}}" type="button" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-danger">No Data To Show</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header text-white bg-secondary">Add Header</div>
                <div class="card-body">
                    <form action=" {{route('header_post')}} " method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                        @if (session('header_insert'))
                            <div class="alert alert-success">
                                {{session('header_insert')}}
                            </div>
                        @endif
                            <label for="exampleInputPassword1">Header Title</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Header Title" name="header_title">
                            @error('header_title')
                            <span class="text-danger"> {{$message}} </span>
                            @enderror
                            <label for="exampleInputPassword1">Header Description</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter header description" name="header_description">
                            @error('header_description')
                            <span class="text-danger"> {{$message}} </span>
                            @enderror
                            <label for="exampleInputPassword1">Header Image</label>
                            <input class="form-control form-control-sm" type="file" name="header_image">
                            @error('header_image')
                            <span class="text-danger"> {{$message}} </span>
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
                <div class="card-header bg-warning">
                    <div class="row">
                        <div class="col-lg-6 pt-1 text-white">Total Soft Category List</div>
                        <div class="col-lg-6 text-right">
                            {{-- @if ($deleted_categories->count() != 0 )
                                <button class="btn btn-success" id="restore_all">Restore All</button>
                                <button class="btn btn-danger" id="delete_force_all">Delete All</button>
                            @endif --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <div class="alert alert-success text-center">
                            {{-- Category List{{$deleted_categories->count()}} --}}
                        </div>
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