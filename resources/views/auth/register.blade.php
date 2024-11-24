@extends('site.layouts.app')
@section('title')
<title>@lang('site.register') </title>
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
                
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('site.name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('site.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

{{--                         <div class="form-group row">--}}
{{--                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('site.phone') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">--}}

{{--                                @error('phone')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}



                        <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{__('site.phone')}}</label>

                        <div class="col-md-6">
                            <div class="row no-gutters">
                                <div class="col-md-9 col-sm-10">
                                    <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="02xxxxxxxxxxx">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 col-sm-2" style="padding-inline-start: 10px;">
                                    <select class="form-control @error('phone-code') is-invalid @enderror" name="phone-code" style="height: 34px;">
                                        <option value="966">+966 SAU</option>
                                        <!--<option value="20" selected>+20 EG</option>-->
                                        <!--<option value="973">+973 BHR</option>-->
                                        <!--<option value="213">+213 ALG</option>-->
                                        <!--<option value="971">+971 UAE</option>-->
                                        <!--<option value="968">+968 OMN</option>-->
                                    </select>
                                    @error('phone-code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('site.Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('site.confirm password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                         <div class="contentBox row">
                                <div class="col-md-4"></div>
                                <div class="box2 col-md-6">
                                    <input type="checkbox" id="terms_condition" required>
                                    <a href="{{url('/')}}/footer/11/page/terms_conditions">@lang('site.accept terms and condition')</a>
                                </div>
                         </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('site.register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
  </section>
@endsection
