@extends('layouts.starlight')

@section('title')
    Faq
@endsection
@section('faq')
    active
@endsection

@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="  ">Dashbroad</a>
        <a class="breadcrumb-item" href="  ">Category</a>
        <span class="breadcrumb-item active">Faq</span>
    </nav>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 pt-1">Faq List</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="alert alert-success text-center">Total Faq {{$faqs->count()}}</div>
                        <table class="table table-bordered">
                            @if (session('soft_delete'))
                                <div class="alert alert-danger text-center">
                                    {{session('soft_delete')}}
                                </div>
                            @endif
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Faq Qustion</th>
                                    <th>Faq Answer</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                                <tbody>
                                @forelse ($faqs as $faq)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$faq->question}}</td>
                                    <td>{{$faq->answer}}</td>
                                    <td>
                                        <a type="button" class="btn btn-outline-danger" href="{{route('faq_soft_delete', $faq->id)}}">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-danger text-center" ><h6>You have no Faq</h6></td>
                                </tr>
                                @endforelse
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Add Faq</div>
                <div class="card-body">
                    @if (session('faq_added'))
                        <div class="alert alert-success">
                            {{session('faq_added')}}
                        </div>
                    @endif
                    <form action=" {{route('faq_insert')}} " method="post">
                        @csrf
                        <div class="form-group">
                            <label>Faq Qustion</label>
                            <textarea class="form-control" rows="3" placeholder="What is your question?" name="question"></textarea>
                            @error('question')
                            <span class="text-danger"> {{$message}} </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Answer the question</label>
                            <textarea class="form-control" rows="3" placeholder="Answer the question" name="answer"></textarea>
                            @error('answer')
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
                                {{-- @if ($product_trashed->count() != 0 ) --}}
                                    {{-- <button class="btn btn-success" id="restore_all">Restore All</button> --}}
                                    {{-- <button class="btn btn-danger" id="delete_force_all">Delete All</button> --}}
                                {{-- @endif --}}
                            </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <div class="alert alert-success text-center">
                            Category List 
                        </div>
                        @if (session('soft_delete'))
                            <div class="alert alert-success text-center">
                                {{session('soft_delete')}}
                            </div>
                        @endif
                        @if (session('force_delete'))
                            <div class="alert alert-danger text-center">
                                {{session('force_delete')}}
                            </div>
                        @endif
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Faq Qustion</th>
                                <th>Faq Answer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                            <tbody>
                              @forelse ($faqs_trashed as $faq)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$faq->question}}</td>
                                    <td>{{$faq->answer}}</td>
                                    <td>
                                        <div class="btn-group btn-group-toggle" >
                                            <a type="button" class="btn btn-outline-success btn-sm" href="{{route('faq_restore', $faq->id)}}">Restore</a>
                                            <a type="button" class="btn btn-outline-danger btn-sm" href="{{route('faq_force_delete', $faq->id)}}">Force Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-danger text-center" ><h6>You have no Faq</h6></td>
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