@extends('site.layouts.appWithoutFooter')
@section('title')
<title>@lang('site.store identifier')</title>
@endsection
@section('style')
<style>
    body{
        background-color: #F2F4FA;
    }
</style>
@endsection
@section('content')
  <!-- ===================== start edit username ======================== -->
    <section class="edit-name">
        <div class="container">
            <div class="h-card">
                <a href="javascript:history.back()" class=" btn btn-borderless h-back-btn">
                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-circle-right" class="svg-inline--fa fa-arrow-circle-right fa-w-16 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" color="#0973C0"><path fill="currentColor" d="M8 256c0 137 111 248 248 248s248-111 248-248S393 8 256 8 8 119 8 256zM256 40c118.7 0 216 96.1 216 216 0 118.7-96.1 216-216 216-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216zm12.5 92.5l115.1 115c4.7 4.7 4.7 12.3 0 17l-115.1 115c-4.7 4.7-12.3 4.7-17 0l-6.9-6.9c-4.7-4.7-4.7-12.5.2-17.1l85.6-82.5H140c-6.6 0-12-5.4-12-12v-10c0-6.6 5.4-12 12-12h190.3l-85.6-82.5c-4.8-4.7-4.9-12.4-.2-17.1l6.9-6.9c4.8-4.7 12.4-4.7 17.1 0z"></path></svg>
                </a>
                <div class="update_username">
                    <div class="title">
                        <h3>@lang('site.store identifier')</h3>
                    </div>
                    <form method="post" action="{{route('add_identify')}}">
                        @csrf
                    <div class="card_preview">
                        <span class="user_logo_wrapper">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" class="svg-inline--fa fa-user fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path>
                            </svg>
                        </span>
                        <span class="usernames_wrapper">
                            <h5>{{auth::user()->store_identify??''}}</h5><small id="result_user">@lang('site.identidier')</small>
                        </span>
                    </div>
                    <div class="h_input_wrapper">
                        <label>@lang('site.identidier')</label>
                        <span class="addon_wrapper">
                            <input class="h_input"  name="store_identify" placeholder="@lang('site.example'): mohammed_store" maxlength="20" minlength="3" addonafter="@" value="" id="input_user">
                         
                            <span class="addon after">@</span>
                        </span>
                          @error('store_identify')
                                <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                        <span class="red"></span>
                    </div>
                    <div class="status_wrapper"></div>
                    <button disabled="" class="h-btn h-btn-xl h-btn-primary" id="btn_user">@lang('site.save')</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================== End edit username ======================== -->

@endsection
@section('script')

    <script>
        var input_user = document.getElementById('input_user'),
            result_user = document.getElementById('result_user'),
            btn_user = document.getElementById('btn_user');

        input_user.onkeyup = function() {
            result_user.innerHTML = '@' + input_user.value;
            if (input_user.value.length < 1) {
                result_user.innerHTML = '@ @lang("site.identidier")';
                btn_user.setAttribute('disabled', 'true');
            } else {
                btn_user.removeAttribute('disabled');
            }
        }
    </script>

@endsection