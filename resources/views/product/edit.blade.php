@extends('layouts.starlight')
@section('title')
    Product Edit
@endsection
@section('product')
    active
@endsection

@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href=" {{route('product')}} ">Category</a>
        <span class="breadcrumb-item active">Product Edit </span>
    </nav>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-8 m-left">
        <div class="card">
            <div class="card-header">Add Categroy</div>
            <div class="card-body">
                @if (session('product_added'))
                    <div class="alert alert-success">
                        {{session('product_added')}}
                    </div>
                @endif
                <form action=" {{route('producteditpost', $product_info->id)}} " method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="product_id" value="{{$product_info->id}}">
                        <label>Category Name</label>
                        <select class="form-control" name="category_id">
                            <option>-Choose One-</option>
                            @foreach ($categorys as $category)
                                <option value="{{$category->id}}" {{($product_info->category_id == $category->id)? 'selected': '' }}>
                                    {{$category->category_name}}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" class="form-control" placeholder="Enter product Name" name="product_name" value="{{$product_info->product_name}}">
                        @error('product_name')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product price</label>
                        <input type="number" class="form-control" placeholder="Enter product price" name="product_price" value="{{$product_info->product_price}}">
                        @error('product_price')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product quantity</label>
                        <input type="number" class="form-control" placeholder="Product quantity" name="product_quantity" value="{{$product_info->product_quantity}}">
                        @error('product_quantity')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product short description</label>
                        <input type="text" class="form-control" placeholder="product short_description" name="product_short_description" value="{{$product_info->product_short_description}}">
                        @error('product_short_description')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product long description</label>
                        <input type="text" class="form-control" placeholder="Enter Categroy Name" name="product_long_description" value="{{$product_info->product_long_description}}">
                        @error('product_long_description')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product alert quantity</label>
                        <input type="number" class="form-control" placeholder="Enter alert quantity" name="product_alert_quantity" value="{{$product_info->product_alert_quantity}}">
                        @error('product_alert_quantity')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="d-block">Currant Photo</label>
                        <img src="{{ asset('uploads/product/'. $product_info->product_image) }}" alt="not found" style="height: 200px; width:200px">
                    </div>
                    <div class="form-group">
                        <label>New Photo</label>
                        <input type="file" class="form-control" placeholder="Enter New Photo" name="product_new_file">
                        @error('product_new_file')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-secondary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4 m-left">
        <div class="card">
            <div class="card-header">Product Wise Feature Photo</div>
            <div class="card-body">
                <div class="row">
                    @foreach ($feature_photos as $feature_photo)
                    <div class="col-lg-6">
                        <form action="{{ route('update_feature_photo', $feature_photo->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group d-inline">
                                <p>Currant Photo</p>
                                <img src="{{ asset('uploads/product_feature/'. $feature_photo->feature_image) }}" alt="not found" class="img-fluid w-100 mb-1">
                                <input type="file" class="form-control" placeholder="Enter New Photo" name="feature_image">
                                @error('feature_image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="btn-group mt-1">
                                    <button type="submit" class="btn btn-info">Update Feature</button>
                                    <a href="{{ route('update_feature_delete', $feature_photo->id) }}" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endforeach
                </div>

                <form action="{{ route('add_feature_photo', $feature_photo->product_id) }}" method="post" enctype="multipart/form-data" class="mt-2">
                @csrf
                <div class="form-group d-inline">
                    <div class="form-group">
                        <label>Add Feature Product Image</label>
                        <input class="form-control form-control-sm" type="file" placeholder="Feature Product Image" name="add_feature_image[]" multiple>
                        @error('add_feature_image')
                        <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-secondary">Submit</button>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>


@endsection