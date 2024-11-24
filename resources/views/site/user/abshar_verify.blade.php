@extends('site.layouts.appWithoutFooter')
@section('title')
<title>@lang('site.Membership verification via Absher')</title>
@endsection
@section('style')
<style>
body{
    background-color:#F2F4FA;
}
</style>
@endsection
@section('content')

    <!-- ===================== start verify absher ======================== -->
    <section class="verify">
        <div class="container">
            <div class="h-card">
                <a href="{{ url()->previous() }}">
                <button class="btn-borderless h-back-btn">
                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-circle-right" class="svg-inline--fa fa-arrow-circle-right fa-w-16 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" color="#dc9d1c"><path fill="currentColor" d="M8 256c0 137 111 248 248 248s248-111 248-248S393 8 256 8 8 119 8 256zM256 40c118.7 0 216 96.1 216 216 0 118.7-96.1 216-216 216-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216zm12.5 92.5l115.1 115c4.7 4.7 4.7 12.3 0 17l-115.1 115c-4.7 4.7-12.3 4.7-17 0l-6.9-6.9c-4.7-4.7-4.7-12.5.2-17.1l85.6-82.5H140c-6.6 0-12-5.4-12-12v-10c0-6.6 5.4-12 12-12h190.3l-85.6-82.5c-4.8-4.7-4.9-12.4-.2-17.1l6.9-6.9c4.8-4.7 12.4-4.7 17.1 0z"></path></svg>
                </button>
                </a>
                <div class="update_username">
                    <div class="title">
                        <h3>@lang('site.Membership verification via Absher')</h3>
                    </div>
                    <form action="{{route('store_verify_type')}}" method="post">
                        @csrf
                    <div class="h_input_wrapper">
                        <label>@lang('site.ID Number')</label>
                        <input type="hidden" value="1" name="type"/>
                        <input name="Id" class="h_input" placeholder="@lang('site.example') 1000000000" maxlength="10" minlength="10" value="" id="h_input">
                        <span class="red"></span>
                    </div>
                    <button type="submit" disabled="" class="h-btn h-btn-xl h-btn-primary" id="h_btn">@lang('site.Send a verification message')</button>
                    </form>
                </div>
            </div>
        </div>
    </section>




    <!-- ===================== End verify absher ======================== -->


@endsection
@section('script')
    <script>
        var h_input = document.getElementById('h_input');
        var h_btn = document.getElementById('h_btn');

        h_input.onkeyup = function() {
            console.log("uwi");
            var value = h_input.value;
            var length = value.length;
            if (length > 0) {
                h_btn.removeAttribute("disabled");
            } else {
                h_btn.setAttribute("disabled", "true");
            }
        }
    </script>




@endsection