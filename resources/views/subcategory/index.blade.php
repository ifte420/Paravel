@extends('layouts.starlight')

@section('title')
    Sub Category Page
@endsection
@section('subcategory')
    active
@endsection

@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href=" {{route('home')}} ">Dashbroad</a>
        <a class="breadcrumb-item" href=" {{route('category')}} ">Category</a>
        <span class="breadcrumb-item active">Sub Category</span>
    </nav>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header text-white bg-secondary">
                    <div class="row">
                        <div class="col-lg-6 pt-1">Category List</div>
                        <div class="col-lg-6 text-right">
                            {{-- @if ($categories->count() != 0 )
                            <div id="delete_soft_all" class="btn btn-danger">Delete All</div>
                            @endif --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <div class="alert alert-success text-center">
                            Total Sub Category {{ $subcategorys->count() }}
                        </div>
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Sub Category Name</th>
                                <th>Sub Category Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subcategorys as $subcategory)
                            <tr>
                                <td> {{$loop->index+1}} </td>
                                <td> {{Str::title($subcategory->subcategory_name)}} </td>
                                <td>
                                    <div class="image">
                                        <img src="{{asset('uploads/sub_category')}}/{{$subcategory->subcategory_image}}" alt="Not Found" class="img-fluid">
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href=" {{route('categoryedit',$subcategory->id)}}" type="button" class="btn btn-info text-white">Edit</a>
                                        <a href=" {{route('subcategorydelete',$subcategory->id)}}" type="button" class="btn btn-danger">Delete</a>
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
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header text-white bg-secondary">Add Categroy</div>
                <div class="card-body">
                    <form action="{{ route('subcategory_post') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Category Name</label>
                            <select class="form-control" name="category_id">
                                <option>-Choose One-</option>
                                @foreach ($categorys as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger"> {{$message}} </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Sub Category Name</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Categroy Name" name="subcategory_name">
                            @error('subcategory_name')
                            <span class="text-danger"> {{$message}} </span>
                            @enderror
                            <label>Sub Category Image</label>
                            <input class="form-control form-control-sm" type="file" name="subcategory_image">
                            @error('subcategory_image')
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
                            Category List
                        </div>
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Sub Category Name</th>
                                <th>Sub Category Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                            <tbody>
                            @forelse ($subcategorys_trashed as $subcategory)
                            <tr>
                                <td> {{$loop->index+1}} </td>
                                <td> {{Str::title($subcategory->subcategory_name)}} </td>
                                <td>
                                    <div class="image">
                                        <img src="{{asset('uploads/sub_category')}}/{{$subcategory->subcategory_image}}" alt="Not Found" class="img-fluid">
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href=" {{route('subcategoryrestore',$subcategory->id)}}" type="button" class="btn btn-success">Restore</a>
                                        <a href=" {{route('subcategoryfocedelete',$subcategory->id)}}" type="button" class="btn btn-danger">Froce Delete</a>
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
                </div>
            </div>
        </div>
    </div>
</div>


@endsection