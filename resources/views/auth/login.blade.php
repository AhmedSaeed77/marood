@extends('site.layouts.app')
@section('title')
    <title>@lang('site.login') </title>
@endsection
@section('style')

    @if(app()->getLocale() == 'en')
        <style>
           .container{

               direction: ltr;
           }
        </style>
    @endif
@endsection
@section('style')

    @if(app()->getLocale() == 'en')
        <style>
            .container{

                direction: ltr;
            }
        </style>
    @endif
@endsection
@section('content')
    <section class="login-page">
        <div class="container">
            <div class="singlePage">
                <a href="javascript:history.back()"class="backButton btn-link">
                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path>
                    </svg>
                    <br>
                </a>
                <form method="POST" action="{{ route('logincustome') }}">
                    @csrf

                    <h2>  {{ __('site.login') }}</h2>
                    <hr>
                    <div class="contentBox">
                        <div class="box1"></div>
                        <div class="box2">
                            <input id="phone" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('site.email') }}" name="email" value="{{ old('email') }}" required autocomplete="phone" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <div><span> &nbsp;</span></div>
                        </div>
                    </div>
                    <div class="contentBox">
                        <div class="box1"></div>
                        <div class="box2">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('site.Password') }}" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <div>
                                <span> &nbsp;</span>
                            </div>
                            <input type="checkbox" id="showpass">
                            <span>@lang('site.show password')</span>
                            <br>
                            <span class="red"></span>
                            <br>
                            <button name="login" class="button  btn-lg btn-success" type="submit" value="login">
                                <span> {{ __('site.login') }} </span>
                            </button>
                        </div>
                    </div>
                    <p><a href="{{route('register')}}">@lang('site.Create a new account')</a></p>
                    <p>     @if (Route::has('password.request'))
                            <a  href="{{ route('password.request') }}">
                                {{ __('site.Forgot Your Password?') }}
                            </a>
                            @endif</a></p>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('script')

    <script>
        var showpass = document.getElementById('showpass'),
            input_pass = document.getElementById('password');

        showpass.onclick = function() {
            if (input_pass.getAttribute("type") == "password") {
                input_pass.setAttribute("type", "text");
            } else {
                input_pass.setAttribute("type", "password");
            }
        }
    </script>

@endsection
