@extends('layouts.starlight')

@section('title')
    Edit {{$subcategor_info->category_id}}
@endsection
@section('subcategory')
    active
@endsection

@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href=" {{route('category')}} ">Sub Category</a>
        <span class="breadcrumb-item active">{{$subcategor_info->subcategory_name}}</span>
    </nav>
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card">
                    <div class="card-header text-white bg-secondary">Edit Sub Categroy</div>
                    <div class="card-body">
                        <form action=" {{route('subcategory_post_edit', $subcategor_info->id)}} " method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Category Name</label>
                                <select class="form-control" name="category_id">
                                    <option>-Choose One-</option>
                                    @foreach ($categorys as $category)
                                        <option value="{{$category->id}}" {{ ($subcategor_info->category_id == $category->id)? 'selected': ''}}> 
                                            {{$category->category_name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger"> {{$message}} </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword2">Sub Category Name</label>
                                <input type="text" class="form-control" id="exampleInputPassword2" placeholder="Enter Categroy Name" name="subcategory_name" value="{{$subcategor_info->subcategory_name}}">
                                @error('subcategory_name')
                                <span class="text-danger"> {{$message}} </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword3">Sub Category Current Image</label>
                                <img src="{{ asset('uploads/sub_category')}}/{{ $subcategor_info->subcategory_image }}" alt="not found">
                            </div>
                            <div class="form-group">
                                <label>Sub Category Image</label>
                                <input class="form-control form-control-sm" type="file" name="subcategory_image">
                                @error('subcategory_image')
                                <span class="text-danger"> {{$message}} </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-outline-secondary">Update Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection