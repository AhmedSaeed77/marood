@extends('site.layouts.appWithoutFooter')
@section('title')
<title>@lang('site.logout')</title>
@endsection
@section('content')
    <section class="login-page">
        <div class="container">
            <div class="singlePage">
                <a href="{{ url()->previous() }}" class=" btn backButton btn-link">
                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path>
                </svg>
                    <br>
                </a>
                <form method="post" action="{{route('logout')}}">
                @csrf
                <h2>@lang('site.Sure to log out')</h2>
                <button type="submit">@lang('site.logout')</button>
                </form>
            </div>
        </div>
    </section>
@endsection