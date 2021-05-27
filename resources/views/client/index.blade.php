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
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6 pt-1">Client Says List</div>
                    <div class="col-lg-6 text-right">
                        @if ($clients->count() != 0)
                            <a href="{{ route('client.soft') }}" class="btn btn-danger">Delete All</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    @if (session('soft_delete'))
                        <div class="alert alert-danger">
                            {{session('soft_delete')}}
                        </div>
                    @endif
                    @if (session('update'))
                        <div class="alert alert-success">
                            {{session('update')}}
                        </div>
                    @endif
                    @if (session('soft_all'))
                        <div class="alert alert-danger">
                            {{session('soft_all')}}
                        </div>
                    @endif
                    <div class="alert alert-success text-center">
                        Total Client {{ $clients->count() }}
                    </div>
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="select_all">
                            </th>
                            <th>Serial No</th>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Client Says</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('check_soft_delete') }}" method="POST">
                            @csrf
                            @forelse ($clients as $client)
                            <tr>
                                <td>
                                    <input type="checkbox" name="delete_checked_id[]" value="{{ $client->id }}">
                                </td>
                                <td> {{$loop->index+1}} </td>
                                <td> {{Str::title($client->client_name)}} </td>
                                <td> {{ $client->client_title }} </td>
                                <td> {{ $client->client_says }}</td>
                                <td> <img src="{{ asset('uploads/client/'.$client->client_image) }}" alt="not found" class="rounded-circle"></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        @php
                                            $crypt = Crypt::encryptString($client->id);
                                        @endphp
                                        <!-- <a href="{{ route('client_edit',$client->id) }}" type="button" class="btn btn-info text-white">Edit</a> -->
                                        <a href="{{ route('client.edit',$client->id) }}" type="button" class="btn btn-info text-white">Edit</a>
                                        {{-- <form action="{{ route('client.destroy', $client->id) }}" method="POST" id="from2">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" form="from2">
                                                Delete
                                            </button>
                                        </form> --}}
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
                    @if ($clients->count() != 0)
                        <button type="submit" class="btn btn-sm btn-danger">
                            Check Delete
                        </button>
                    @endif
                    </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">Add Client Says</div>
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

@section('footer_script')
<script>
    $(document).ready(function(){
        document.getElementById('select_all').onclick = function() {
            var checkboxes = document.getElementsByName('delete_checked_id[]');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        }
    });
</script>
@endsection
