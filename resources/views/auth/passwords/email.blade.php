@extends('site.layouts.app')
@section('title')
<title>@lang('site.reset password')</title>
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
                <a href="javascript:history.back()" class="backButton btn-link">
                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path>
                </svg>
                    <br>
                </a>   
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="singleContent">
                        <h3>@lang('site.reset password')</h3>
                        <hr>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <input type="text" name="email" placeholder="{{ __('site.E-Mail Address') }}" value="{{ old('email') }}" style=" height: 38px;" class="@error('email') is-invalid @enderror">
                           <button name="submit" class="button  btn-success btn-large" type="submit" >{{ __('site.Send Password Reset Link') }}</button>
                     @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </form>
                        <br>
                    </div>

                    <!--<form method="POST" action="{{ route('password.email') }}">-->
                    <!--    @csrf-->

                    <!--    <div class="form-group row">-->
                    <!--        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('site.E-Mail Address') }}</label>-->

                    <!--        <div class="col-md-6">-->
                    <!--            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>-->

                    <!--            @error('email')-->
                    <!--                <span class="invalid-feedback" role="alert">-->
                    <!--                    <strong>{{ $message }}</strong>-->
                    <!--                </span>-->
                    <!--            @enderror-->
                    <!--        </div>-->
                    <!--    </div>-->

                    <!--    <div class="form-group row mb-0">-->
                    <!--        <div class="col-md-6 offset-md-4">-->
                    <!--            <button type="submit" class="btn btn-primary">-->
                    <!--                {{ __('site.Send Password Reset Link') }}-->
                    <!--            </button>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</form>-->
                </div>
            </div>

</section>
@endsection
