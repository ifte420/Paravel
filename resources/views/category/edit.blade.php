@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href=" {{url('category')}} ">Category</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$category_info->category_name}}</li>
                    </ol>
                </nav>
                <div class="card">
                    <div class="card-header text-white bg-secondary">Edit Categroy</div>
                    <div class="card-body">
                        <form action=" {{url('category/post/edit')}} " method="post">
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