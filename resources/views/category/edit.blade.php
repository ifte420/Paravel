@extends('layouts.starlight')

@section('title') Edit 
@endsection

@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href=" {{route('home')}} ">Dashbroad</a>
        <a class="breadcrumb-item" href=" {{route('category')}} ">Category</a>
        <span class="breadcrumb-item active">{{$category_info->category_name}}</span>
    </nav>
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card">
                    <div class="card-header text-white bg-secondary">Edit Categroy</div>
                    <div class="card-body">
                        <form action=" {{route('category_post_edit')}} " method="post">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" value="{{$category_info->id}}" name="category_id">
                                <label for="exampleInputPassword1">Category Name</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Categroy Name" name="category_name" value="{{$category_info->category_name}}">
                                @if ($errors->all())
                                    @foreach ($errors->all() as $error)
                                        <span class="text-danger"> {{$error}} </span>
                                    @endforeach
                                @endif
                            </div>
                            <button type="submit" class="btn btn-outline-secondary">Update Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection