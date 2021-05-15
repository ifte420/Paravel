@extends('layouts.tohoney')
@section('title')
    Verification Email
@endsection
@section('body')
@if (!Auth::user()->email_verified_at)
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 m-5">
                <div class="card">
                    <div class="card-header text-white" style="background-color: #EF4836;">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-danger"><u>{{ __('click here to request another') }}</u></button>.
                        </form>
                        <div class="btn" style="background-color: #EF4836; margin-left:315px;">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-white">
                            <i class="fa fa-power-off text-white"></i>&nbsp;&nbsp;Sign Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <script>window.location = "{{ route('tohoney_home') }}";</script>
    {{-- {{ return redirect('tohoney_home') }} --}}
@endif
@endsection
