@extends('layouts.tohoney')

@section('title')
  contact Page
@endsection

@section('body')

    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Contact Us</h2>
                        <ul>
                            <li><a href="{{route('tohoney_home')}}">Home</a></li>
                            <li><span>Contact</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- contact-area start -->
    {{-- <div class="google-map">
        <div class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.9147703055!2d-74.11976314309273!3d40.69740344223377!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sbd!4v1547528325671" allowfullscreen></iframe>
        </div>
    </div> --}}
    <div class="contact-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="contact-form form-style">
                        <div class="cf-msg"></div>
                        <form action="{{route('contact_insert')}}" method="post">
                            @csrf
                            <div class="row">
                                <form action="lkfj" method="POST">
                                    <div class="col-12 col-sm-6">
                                        @error('person_name')
                                            <span class="text-danger"> {{$message}} </span>
                                        @enderror
                                        <input type="text" placeholder="Name" id="name" name="person_name">
                                    </div>
                                    <div class="col-12  col-sm-6">
                                        @error('email')
                                            <span class="text-danger"> {{$message}} </span>
                                        @enderror
                                        <input type="text" placeholder="Email" id="email" name="email">
                                    </div>
                                    <div class="col-12">
                                        @error('subject')
                                            <span class="text-danger"> {{$message}} </span>
                                        @enderror
                                        <input type="text" placeholder="Subject" id="subject" name="subject">
                                    </div>
                                    <div class="col-12">
                                        @error('message')
                                            <span class="text-danger"> {{$message}} </span>
                                        @enderror
                                        <textarea class="contact-textarea" placeholder="Message" id="msg" name="message"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button id="submit">SEND MESSAGE</button>
                                    </div>
                                </form>
                            </div>
                        </form>
                        @if (session('contact_send_success'))
                        <div class="alert alert-success mt-2" role="alert">
                            {{session('contact_send_success')}}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="contact-wrap">
                        <ul>
                            <li>
                                <i class="fa fa-home"></i> Address:
                                <p>1234, Contrary to popular Sed ut perspiciatis unde 1234</p>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i> Email address:
                                <p>
                                    <span>info@yoursite.com </span>
                                    <span>info@yoursite.com </span>
                                </p>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i> phone number:
                                <p>
                                    <span>+0123456789</span>
                                    <span>+1234567890</span>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact-area end -->
@endsection