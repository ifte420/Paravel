@extends('layouts.starlight')

@section('title')
    Category Page
@endsection
@section('category')
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
                        <div class="col-lg-6 pt-1">Category List</div>
                        <div class="col-lg-6 text-right">
                            @if ($categories->count() != 0 )
                            <div id="delete_soft_all" class="btn btn-danger">Delete All</div>
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
                        @if (session('Category_all_delete_status'))
                            <div class="alert alert-danger">
                                {{session('Category_all_delete_status')}}
                            </div>
                        @endif
                        @if (session('check_no_data'))
                            <div class="alert alert-danger">
                                {{session('check_no_data')}}
                            </div>
                        @endif
                        @if (session('category_edit'))
                            <div class="alert alert-success">
                                {{session('category_edit')}}
                            </div>
                        @endif
                        @if (session('check_soft_delete'))
                            <div class="alert alert-success">
                                {{session('check_soft_delete')}}
                            </div>
                        @endif
                        <div class="alert alert-success text-center">
                            Total Category {{$categories->count()}}
                        </div>
                        <thead>
                            <tr>
                                <th>checked</th>
                                <th>Serial No</th>
                                <th>Category Name</th>
                                <th>Created at</th>
                                <th>Category Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action=" {{route('category_check_delete')}} " method="POST">
                                @csrf
                                @forelse ($categories as $category)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="delete_checkbox" name="category_id[]" value=" {{$category->id}} ">
                                    </td>
                                    <td> {{$loop->index+1}} </td>
                                    <td> {{Str::title($category->category_name)}} </td>
                                    <td> {{$category->created_at->format('d/m/Y h:i:s')}} </td>
                                    <td>
                                        <div class="image">
                                            <img src="{{asset('uploads/category')}}/{{$category->category_image}}" alt="Not Found" class="img-fluid">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href=" {{route('categoryedit',$category->id)}}" type="button" class="btn btn-info text-white">Edit</a>
                                            <a href=" {{route('categorydelete',$category->id)}}" type="button" class="btn btn-danger">Delete</a>
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
                        @if ($categories->count() != 0 )
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <div type="button" class="btn btn-sm bg-info text-white" id="all_check_btn">Check All</div>
                            <div type="button" class="btn btn-sm bg-success text-white" id="all_uncheck_btn">UnCheck All</div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-danger">Check Delete</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header text-white bg-secondary">Add Categroy</div>
                <div class="card-body">
                    <form action=" {{route('categorypost')}} " method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                        @if (session('category_insert_status'))
                            <div class="alert alert-success">
                                {{session('category_insert_status')}}
                            </div>
                        @endif
                            <label for="exampleInputPassword1">Category Name</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Categroy Name" name="category_name">
                            @error('category_name')
                            <span class="text-danger"> {{$message}} </span>
                            @enderror
                            <label>Category Image</label>
                            <input class="form-control form-control-sm" type="file" name="category_image">
                            @error('category_image')
                            <span class="text-danger"> {{$message}} </span>
                            @enderror
                            <label >Sub Category Name</label>
                            <input type="text" class="form-control" placeholder="Enter Categroy Name" name="subcategory_name">
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
                            @if ($deleted_categories->count() != 0 )
                                <button class="btn btn-success" id="restore_all">Restore All</button>
                                <button class="btn btn-danger" id="delete_force_all">Delete All</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <div class="alert alert-success text-center">
                            Category List{{$deleted_categories->count()}}
                        </div>
                        @if (session('category_restore'))
                            <div class="alert alert-success text-center">
                                {{session('category_restore')}}
                            </div>
                        @endif
                        @if (session('restore_all'))
                        <div class="alert alert-success text-center">
                            {{session('restore_all')}}
                        </div>
                        @endif
                        @if (session('force_delete'))
                        <div class="alert alert-danger text-center">
                            {{session('force_delete')}}
                        </div>
                        @endif
                        @if (session('force_all_delete'))
                        <div class="alert alert-danger text-center">
                            {{session('force_all_delete')}}
                        </div>
                        @endif
                        @if (session('check_restore'))
                        <div class="alert alert-success text-center">
                            {{session('check_restore')}}
                        </div>
                        @endif
                        @if (session('check_force_delete'))
                        <div class="alert alert-danger text-center">
                            {{session('check_force_delete')}}
                        </div>
                        @endif
                        @if (session('check_no_select_data'))
                        <div class="alert alert-danger text-center">
                            {{session('check_no_select_data')}}
                        </div>
                        @endif
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
                                @forelse ($deleted_categories as $deleted_category)
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
                                @endforelse
                            </tbody>
                    </table>
                            @if ($deleted_categories->count() != 0 )
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <div type="button" class="btn btn-sm bg-info text-white" id="all_checked">Check All</div>
                                    <div type="button" class="btn btn-sm bg-success text-white" id="all_unchecked">UnCheck All</div>
                                </div>
                                <div class="btn-group d-block mt-2" role="group" aria-label="Basic example">
                                    <button type="submit" class="btn btn-sm btn-success" name="restore" value="1">Check Restore</button>
                                    <button type="submit" class="btn btn-sm btn-danger" name="force_delete" value="2">Check Delete</button> 
                                </div>
                            @endif
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>


@section('footer_script')
    <script>
        $(document).ready(function(){
            $('#delete_soft_all').click(function(){
                Swal.fire({
                    title: 'Are you sure you want to soft delete?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href ="{{route('categoryalldelete')}}";
                    }
                })
            });

            $('#delete_force_all').click(function(){
                Swal.fire({
                title: 'Are you sure you want to delete by force?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{route('category_force_delete_all')}}";
                    }
                })
            });

            $('#restore_all').click(function(){
                Swal.fire({
                title: 'Are you sure you want to Restore All?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{route('category_restore_all')}}";
                    }
                })
            });

            $('#all_check_btn').click(function(){
                $('.delete_checkbox').attr('checked', 'checked');
            });

            $('#all_uncheck_btn').click(function(){
                $('.delete_checkbox').removeAttr('checked');
            });

            $('#all_checked').click(function(){
                $('.checked_button').attr('checked', 'checked');
            });

            $('#all_unchecked').click(function(){
                $('.checked_button').removeAttr('checked');
            });
        });
    </script>
@endsection

@endsection