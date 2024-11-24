@extends('site.layouts.appWithoutFooter')
@section('style')
<style>
body{
  background-color: #F2F4FA;
}

</style>
@endsection
@section('content')

    <!--========================== Start user page ==========================-->
    <section class="user-page add-rate-page">
    <div class="container">
             <div class="cover" style="background-image:url('{{$user->cover!=null?url('/').'/public/storage/'.$user->cover:''}}')">
                <span id="prfile_options">
                    <span class="options_button settings">
                        <div id="options">
                            <a href="#" data-toggle="modal" data-target="#ModalQR"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="qrcode" class="svg-inline--fa fa-qrcode fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M0 224h192V32H0v192zM64 96h64v64H64V96zm192-64v192h192V32H256zm128 128h-64V96h64v64zM0 480h192V288H0v192zm64-128h64v64H64v-64zm352-64h32v128h-96v-32h-32v96h-64V288h96v32h64v-32zm0 160h32v32h-32v-32zm-64 0h32v32h-32v-32z"></path></svg>
                            @lang('site.Show QR')</a>
                            @if(Auth::check())
                            @if(auth::user()->id==$user->id)
                            <!--<span data-toggle="modal" data-target="#ModalSettings">-->
                            <!--    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cog" class="svg-inline--fa fa-cog fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M487.4 315.7l-42.6-24.6c4.3-23.2 4.3-47 0-70.2l42.6-24.6c4.9-2.8 7.1-8.6 5.5-14-11.1-35.6-30-67.8-54.7-94.6-3.8-4.1-10-5.1-14.8-2.3L380.8 110c-17.9-15.4-38.5-27.3-60.8-35.1V25.8c0-5.6-3.9-10.5-9.4-11.7-36.7-8.2-74.3-7.8-109.2 0-5.5 1.2-9.4 6.1-9.4 11.7V75c-22.2 7.9-42.8 19.8-60.8 35.1L88.7 85.5c-4.9-2.8-11-1.9-14.8 2.3-24.7 26.7-43.6 58.9-54.7 94.6-1.7 5.4.6 11.2 5.5 14L67.3 221c-4.3 23.2-4.3 47 0 70.2l-42.6 24.6c-4.9 2.8-7.1 8.6-5.5 14 11.1 35.6 30 67.8 54.7 94.6 3.8 4.1 10 5.1 14.8 2.3l42.6-24.6c17.9 15.4 38.5 27.3 60.8 35.1v49.2c0 5.6 3.9 10.5 9.4 11.7 36.7 8.2 74.3 7.8 109.2 0 5.5-1.2 9.4-6.1 9.4-11.7v-49.2c22.2-7.9 42.8-19.8 60.8-35.1l42.6 24.6c4.9 2.8 11 1.9 14.8-2.3 24.7-26.7 43.6-58.9 54.7-94.6 1.5-5.5-.7-11.3-5.6-14.1zM256 336c-44.1 0-80-35.9-80-80s35.9-80 80-80 80 35.9 80 80-35.9 80-80 80z"></path>-->
                            <!--    </svg>@lang('site.setting')-->
                            <!--</span>-->
                                @if(auth::user()->store_verify==0)
                                <a href="{{route('verify_store',$user->id)}}"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check-circle" class="svg-inline--fa fa-check-circle fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path></svg>
                                      @lang('site.verify store')</a>
                                @endif 
                            @else
                            <a href="{{url('/')}}/user/rates/{{$user->id}}"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" class="svg-inline--fa fa-star fa-w-18 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg>
                                  @lang('site.rate')</a>
                            @endif    
                            @endif  
                        </div>
            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="ellipsis-v" class="svg-inline--fa fa-ellipsis-v fa-w-2 fa-fw fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 512" color="white"><path fill="currentColor" d="M32 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32zM0 136c0 17.7 14.3 32 32 32s32-14.3 32-32-14.3-32-32-32-32 14.3-32 32zm0 240c0 17.7 14.3 32 32 32s32-14.3 32-32-14.3-32-32-32-32 14.3-32 32z"></path>
                        </svg>
            </span>
            <span class="share_wrapper options_button" data-toggle="modal" data-target="#shareModal">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="share-alt" class="svg-inline--fa fa-share-alt fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M352 320c-22.608 0-43.387 7.819-59.79 20.895l-102.486-64.054a96.551 96.551 0 0 0 0-41.683l102.486-64.054C308.613 184.181 329.392 192 352 192c53.019 0 96-42.981 96-96S405.019 0 352 0s-96 42.981-96 96c0 7.158.79 14.13 2.276 20.841L155.79 180.895C139.387 167.819 118.608 160 96 160c-53.019 0-96 42.981-96 96s42.981 96 96 96c22.608 0 43.387-7.819 59.79-20.895l102.486 64.054A96.301 96.301 0 0 0 256 416c0 53.019 42.981 96 96 96s96-42.981 96-96-42.981-96-96-96z"></path>
                        </svg>
                    </span>
            </span>
            <a id="header_back_button" href="{{ url()->previous() }}">
                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-fw fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path></svg>
            </a>
        </div>
        <div class="content">
            <div class="info-user">
                <div class="row">
                    <div class="col-4 right-content"></div>
                    <div class="col-4 center-content">
                        <div>
                        <div class="image">
                                <img src="{{url('/')}}/public/storage/{{$user->avatar??'users/avatar.png'}}" alt="img">
                                @if(Cache::has('user-is-online-' . $user->id))
                                    <span class="online-status"></span>
                                @else
                                    <span class="offline-status"></span>
                                @endif
                            </div>
                            <div class="details">
                                <span class="name">{{$user->name}}</span>
                                <span class="time">  @if($user->last_seen != null)
                                            {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }} 
                                        @endif</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 left-content"></div>
                </div>
            </div>
        </div>
        <div class="add_rate_wrapper">
            <form action="{{route('store_rate',$user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="feedback_wrapper">@lang('site.How was your experience?')
                <textarea name="notes" placeholder="@lang('site.Example: The goods arrived without delay and men are at the top of morals')" minlength="10" maxlength="1000"></textarea>
                <span class="red">0 / 1000</span>
            </div>
            @error('notes')
            <span class="alert alert-danger">{{$message}}</span>
            @enderror
            <div class="ask_wrapper">
                <span>@lang('site.Do you recommend to deal with it?')</span>
                <div class="options_wrapper">
                    <label for="yes-work">
                        <input type="radio" id="yes-work" name="advanced" value="yes" class="d-none">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="thumbs-up" class="svg-inline--fa fa-thumbs-up fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M104 224H24c-13.255 0-24 10.745-24 24v240c0 13.255 10.745 24 24 24h80c13.255 0 24-10.745 24-24V248c0-13.255-10.745-24-24-24zM64 472c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24zM384 81.452c0 42.416-25.97 66.208-33.277 94.548h101.723c33.397 0 59.397 27.746 59.553 58.098.084 17.938-7.546 37.249-19.439 49.197l-.11.11c9.836 23.337 8.237 56.037-9.308 79.469 8.681 25.895-.069 57.704-16.382 74.757 4.298 17.598 2.244 32.575-6.148 44.632C440.202 511.587 389.616 512 346.839 512l-2.845-.001c-48.287-.017-87.806-17.598-119.56-31.725-15.957-7.099-36.821-15.887-52.651-16.178-6.54-.12-11.783-5.457-11.783-11.998v-213.77c0-3.2 1.282-6.271 3.558-8.521 39.614-39.144 56.648-80.587 89.117-113.111 14.804-14.832 20.188-37.236 25.393-58.902C282.515 39.293 291.817 0 312 0c24 0 72 8 72 81.452z"></path>
                        </svg>
                        <span>@lang('site.I advise to deal with it')</span>
                    </label>
                    <label for="no-work">
                        <input type="radio" id="no-work" name="advanced" value="no" class="d-none">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="thumbs-down" class="svg-inline--fa fa-thumbs-down fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M0 56v240c0 13.255 10.745 24 24 24h80c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24H24C10.745 32 0 42.745 0 56zm40 200c0-13.255 10.745-24 24-24s24 10.745 24 24-10.745 24-24 24-24-10.745-24-24zm272 256c-20.183 0-29.485-39.293-33.931-57.795-5.206-21.666-10.589-44.07-25.393-58.902-32.469-32.524-49.503-73.967-89.117-113.111a11.98 11.98 0 0 1-3.558-8.521V59.901c0-6.541 5.243-11.878 11.783-11.998 15.831-.29 36.694-9.079 52.651-16.178C256.189 17.598 295.709.017 343.995 0h2.844c42.777 0 93.363.413 113.774 29.737 8.392 12.057 10.446 27.034 6.148 44.632 16.312 17.053 25.063 48.863 16.382 74.757 17.544 23.432 19.143 56.132 9.308 79.469l.11.11c11.893 11.949 19.523 31.259 19.439 49.197-.156 30.352-26.157 58.098-59.553 58.098H350.723C358.03 364.34 384 388.132 384 430.548 384 504 336 512 312 512z"></path>
                        </svg>
                        <span>@lang('site.I do not advise to deal with it')</span>
                    </label>
                </div>
                 @error('advanced')
                  <span class="alert alert-danger">{{$message}}</span>
                 @enderror
            </div>
            <div class="ask_wrapper">
                <span>@lang('site.Did you buy from the member?')</span>
                <div class="options_wrapper_type2">
                    <label for="yes" class="option "><input type="radio" name="answer" id="yes" value="yes">@lang('site.yes')</label>
                    <label for="no" class="option "><input type="radio" name="answer" id="no" value="no">@lang('site.no')</label>
                </div>
                 @error('answer')
                  <span class="alert alert-danger">{{$message}}</span>
                 @enderror
            </div>
            <div class="ask_wrapper">
                <span>@lang('site.image with rate')</span>
                <div class="options_wrapper_type2">
                    <input type="file" name="image" id="img">
                </div>
                 @error('image')
                  <span class="alert alert-danger">{{$message}}</span>
                 @enderror
            </div>
            <div class="submit_wrapper">
                <button  type='submit' class="submit">@lang('site.rate')</button>
            </div>
                            </form>
        </div>
        </div>
    </section>


    <!--========================== End user page ==========================-->

    <!--===================== start Modal QR ======================-->

    <div class="modal fade" id="ModalQR" tabindex="-1" role="dialog" aria-labelledby="ModalQRTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-header">
                <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-content">
                <div>
                    <div class="control-btns">
                        <button class="btn btn-primary active" data-content="layout-1">@lang('site.layout1')</button>
                        <button class="btn btn-primary" data-content="layout-2">@lang('site.layout2')</button>
                       
                    </div>
                    <div class="box-content active" id="layout-1" style="text-align: center;">
                        <div id="regular-view" class="qr-regular-view qrcode-wrapper qrcode-wrapper--ib">
                           <?php echo $user->QR?>
                            <div class="qr-regular-view__footer">
                                <div><strong class="qr-regular-view__title">{{$user->name}}</strong></div>
                                <div class="inline-ltr">H: @ {{$user->store_identify??''}}<span></span></div>
                                <div class="qr-regular-view__contact"></div>
                            </div>
                        </div>
                    </div>
                    <div class="box-content" id="layout-2">
                        <div id="sticker-view" class="qrcode-wrapper qr-sticker-view">
                            <div class="qr-sticker-view__header">
                                <div class="qr-sticker-view__header-content">
                                    <div class="qr-sticker-view__header-title">{{$user->name}}</div>
                                </div>
                            </div>
                            <div class="qr-sticker-view__body">
                                <div class="qr-sticker-view__body-brief">
                                    <div class="qr-sticker-view__body-contacts"></div>
                                </div>
                               <?php echo $user->QR?>
                            </div>
                            <div class="qr-sticker-view__footer">
                                <div class="qr-sticker-view__footer-handler">haraj.com.sa/@ {{$user->store_identify??''}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="qrcode-wrapper__btns">
                        <button class="btn btn-primary-alt" onclick={window.print()}>@lang('site.print')</button>
                        <button class="btn btn-primary-alt"><a href="assets/img/qr.png" download="">@lang('site.download as image')</a></button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--===================== End Modal QR ======================-->



    <!--===================== start Modal settings ======================-->

    <div class="modal fade customModal" id="ModalSettings" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal_content">
                    <div class="userLinksWrapper">
                        <h3>@lang('site.setting')</h3>
                        <a href="#"data-toggle="modal" data-target="#change_pass_Modal">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="lock" class="svg-inline--fa fa-lock fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z"></path>
                            </svg>@lang('site.update password')
                        </a>
                        <a href="{{route('update_user','name')}}">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-edit" class="svg-inline--fa fa-user-edit fa-w-20 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h274.9c-2.4-6.8-3.4-14-2.6-21.3l6.8-60.9 1.2-11.1 7.9-7.9 77.3-77.3c-24.5-27.7-60-45.5-99.9-45.5zm45.3 145.3l-6.8 61c-1.1 10.2 7.5 18.8 17.6 17.6l60.9-6.8 137.9-137.9-71.7-71.7-137.9 137.8zM633 268.9L595.1 231c-9.3-9.3-24.5-9.3-33.8 0l-37.8 37.8-4.1 4.1 71.8 71.7 41.8-41.8c9.3-9.4 9.3-24.5 0-33.9z"></path>
                            </svg>@lang('site.update username')
                        </a>
                        <a href="{{route('update_user','email')}}">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope" class="svg-inline--fa fa-envelope fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path>
                            </svg> @lang('site.update email')
                        </a>
                        <a href="{{route('update_user','mobile')}}">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone" class="svg-inline--fa fa-phone fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"></path>
                            </svg>@lang('site.update mobile')
                        </a>
                        <a href="{{route('pay_commission')}}">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="credit-card" class="svg-inline--fa fa-credit-card fa-w-18 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M0 432c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V256H0v176zm192-68c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H204c-6.6 0-12-5.4-12-12v-40zm-128 0c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM576 80v48H0V80c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48z"></path>
                            </svg>@lang('site.Pay the commission')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===================== End Modal settings ======================-->
      <!--============= start share modal ===============-->

    <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('site.share')</h5>
                </div>
                <div class="modal-body">
                    <div class="form">
                        <button class="btn" id="copy-btn">copy</button>
                        <input type="text" class="form-control" readonly value="{{url('/')}}/user/{{$user->id}}/profile" id="inputCopy">
                        <div class="clearfix"></div>
                    </div>
                    <p class="text-center"></p>

                </div>
                <div class="modal-footer">
                    <div class="sochial text-center">
                        <!--<div class="button share-button facebook-share-button">share</div> -->
                        <!--<a href="#"><i class="fab fa-whatsapp"></i></a>-->
                        <!--<a href="#"><i class="fab fa-twitter"></i></a>-->
                        <!--<a href="#"><i class="fab fa-linkedin-in"></i></a>-->
                        <!--<a href="#"><i class="fab fa-snapchat-ghost"></i></a>-->
                        <!--<a href="#"><i class="fab fa-instagram"></i></a>-->
                        <!--<a href="#" ><i class="fab fa-facebook-f"></i></a>-->
                        <!--<a href="#"><i class="fas fa-envelope"></i></a>-->
                    </div>
                    <!--<div class="sharethis-inline-share-buttons"  data-url="{{url('/')}}//user/{{$user->id}}/profile" data-title="{{$user->name}}" ></div>-->
<!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons"data-url="{{url('/')}}//user/{{$user->id}}/profile" data-title="{{$user->name}}"></div><!-- ShareThis END -->          
</div>
            </div>
        </div>
    </div>

    <!--============= End share modal ===============-->


    <!--============= start change password modal ===============-->

    <div id="change_pass_Modal" class="custom_popup modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
        <div class="inner modal-dialog" role="document">
            <div class="modal-content" style="border: 0;">
                <div class="modal-header">
                    <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('change_password')}}" method="post" >
                    @csrf
                    @csrf
                    <h5 class="text-center">@lang('site.change password')</h5>
                    <div class="form-group">
                        <input type="password" class="form-control" name="pass" />
                    </div>
                    <button class="btn btn-primary-alt btn-block"><span>@lang('site.confirm password') </span> </button>
                </form>
            </div>
        </div>
    </div>

    <!--============= End change password modal ===============-->



@endsection
@section('script')
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=605737e5ae08f9001144292a&product=sop' async='async'></script>
    <script>
        /* =============================== copy link =============================== */

        (function() {
            var copyButton = document.getElementById('copy-btn');
            var copyInput = document.getElementById('inputCopy');
            var modalFooter = document.querySelector('.modal-body p');
            copyButton.addEventListener('click', function(e) {
                e.preventDefault();
                var text = copyInput.select();
                document.execCommand('copy');
                modalFooter.innerHTML = "link is copied";
            });


        })();
    </script>
@endsection