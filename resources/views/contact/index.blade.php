@extends('layouts.starlight')

@section('title')
    Contact Customer Message
@endsection

@section('contact')
    active
@endsection

@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href=" {{route('home')}} ">Dashbroad</a>
        <a class="breadcrumb-item" href=" {{route('category')}} ">Category</a>
        <a class="breadcrumb-item" href=" {{route('product')}} ">Product</a>
        <span class="breadcrumb-item active">Contact</span>
    </nav>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-white bg-secondary">
                    <div class="row">
                        <div class="col-lg-6 pt-1">Contact Messeage List</div>
                        <div class="col-lg-6 text-right">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        @if (session('contact_delete'))
                            <div class="alert alert-danger">
                                {{session('contact_delete')}}
                            </div>
                        @endif
                        <div class="alert alert-success text-center">
                            Total Customer Message {{$contacts->count()}}
                        </div>
                        <thead>
                            <tr>
                                <th>Serial NO</th>
                                <th>person_name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                @forelse ($contacts as $contact)
                                <tr>
                                    <td> {{$loop->index+1}} </td>
                                    <td> {{Str::title($contact->person_name)}} </td>
                                    <td> {{$contact->email}} </td>
                                    <td> {{$contact->subject}} </td>
                                    <td> {{$contact->message}} </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{route('contact_delete',$contact->id)}}" type="button" class="btn btn-danger">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-danger text-center" ><h6>You have not received any message</h6></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection