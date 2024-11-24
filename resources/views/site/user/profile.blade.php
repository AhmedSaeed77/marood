@extends('site.layouts.app')
@section('style')
<style>
    body{
            background-color: rgb(242, 244, 250);
             overflow-x:hidden;
    }
    
    .stars {
        display: flex;
        flex-direction: row;
        justify-content: center; /* Optional: Adjust alignment */
        align-items: center; /* Optional: Center vertically */
    }

    .stars .fa-star {
        font-size: 10px; /* Adjust size as needed */
        margin: 0 5px; /* Optional: Adjust spacing between stars */
    }


</style>
@endsection
@section('content')

    <!--========================== Start user page ==========================-->
    <section class="user-page">
        <div class="container">
            <div class="cover" style="background-image:url('{{$user->cover!=null?url('/').'/public/storage/'.$user->cover:''}}')">
                <span id="prfile_options">
                    <span class="options_button settings">
                        <div id="options">
                            <a href="#" data-toggle="modal" data-target="#ModalQR"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="qrcode" class="svg-inline--fa fa-qrcode fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M0 224h192V32H0v192zM64 96h64v64H64V96zm192-64v192h192V32H256zm128 128h-64V96h64v64zM0 480h192V288H0v192zm64-128h64v64H64v-64zm352-64h32v128h-96v-32h-32v96h-64V288h96v32h64v-32zm0 160h32v32h-32v-32zm-64 0h32v32h-32v-32z"></path></svg>
                            @lang('site.Show QR')</a>
                            @if(Auth::check())
                            @if(auth::user()->id==$user->id)
                            <span data-toggle="modal" data-target="#ModalSettings">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cog" class="svg-inline--fa fa-cog fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M487.4 315.7l-42.6-24.6c4.3-23.2 4.3-47 0-70.2l42.6-24.6c4.9-2.8 7.1-8.6 5.5-14-11.1-35.6-30-67.8-54.7-94.6-3.8-4.1-10-5.1-14.8-2.3L380.8 110c-17.9-15.4-38.5-27.3-60.8-35.1V25.8c0-5.6-3.9-10.5-9.4-11.7-36.7-8.2-74.3-7.8-109.2 0-5.5 1.2-9.4 6.1-9.4 11.7V75c-22.2 7.9-42.8 19.8-60.8 35.1L88.7 85.5c-4.9-2.8-11-1.9-14.8 2.3-24.7 26.7-43.6 58.9-54.7 94.6-1.7 5.4.6 11.2 5.5 14L67.3 221c-4.3 23.2-4.3 47 0 70.2l-42.6 24.6c-4.9 2.8-7.1 8.6-5.5 14 11.1 35.6 30 67.8 54.7 94.6 3.8 4.1 10 5.1 14.8 2.3l42.6-24.6c17.9 15.4 38.5 27.3 60.8 35.1v49.2c0 5.6 3.9 10.5 9.4 11.7 36.7 8.2 74.3 7.8 109.2 0 5.5-1.2 9.4-6.1 9.4-11.7v-49.2c22.2-7.9 42.8-19.8 60.8-35.1l42.6 24.6c4.9 2.8 11 1.9 14.8-2.3 24.7-26.7 43.6-58.9 54.7-94.6 1.5-5.5-.7-11.3-5.6-14.1zM256 336c-44.1 0-80-35.9-80-80s35.9-80 80-80 80 35.9 80 80-35.9 80-80 80z"></path>
                                </svg>@lang('site.setting')
                            </span>
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
            <!--<a id="header_back_button" href="{{ url()->previous() }}">-->
            <!--    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-fw fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path></svg>-->
            <!--</a>-->
        </div>
        <div class="content">
            <div class="info-user">
                <div class="row">
                    <div class="col-4 right-content">
                        <div>@if(Auth::check())
                            @if(auth::user()->id != $user->id)
                            <a href="#" class="main-btn follow" id="{{$user->id}}">@if($f==0)@lang('site.follow')@else @lang('site.cancel follow') @endif</a>

                            @else
                            <a href="{{url('/')}}/user/{{$user->id}}/edit/store" class="main-btn">@lang('site.edit store')</a>
                            @endif
                            @endif

                            <span>{{count($user->follower)}} @lang('site.follower')</span>
                        </div>
                    </div>
                    <div class="col-4 center-content">
                        <div>
                            <div class="image">
                                <img src="{{url('/')}}/public/storage/{{$user->avatar??'users/avatar.png'}}" alt="img">

                                @if(Cache::has('user-is-online-' . $user->id))
                                    <span class="online-status"></span>
                                @else
                                    <span class="online-status off"></span>
                                @endif
                            </div>
                            <div class="details">
                                <span class="name">{{$user->name}}</span>
                                    <span class="handler">@ {{$user->store_identify ??''}}</span>
                        <br>
                                <span class="time">  @if($user->last_seen != null)
                                            {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                                        @endif</span>

                            </div>
                            <div class="more-details">
                                <div class="item">
                                    <span class="icon"><i class="far fa-calendar-alt"></i></span>
                                    <span>{{$user->created_at->diffForHumans()}}</span>
                                </div>
                              @if($is_pay==1)
                                <div class="item">
                                    <span class="icon active"><i class="fas fa-check"></i></span>
                                    <span>@lang('site.commission payed')</span>
                                </div>
                                @else
                                    <div class="item">
                                    <span class="icon">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="badge-check" class="svg-inline--fa fa-badge-check fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#dc9d1c" d="M512 256c0-37.7-23.7-69.9-57.1-82.4 14.7-32.4 8.8-71.9-17.9-98.6-26.7-26.7-66.2-32.6-98.6-17.9C325.9 23.7 293.7 0 256 0s-69.9 23.7-82.4 57.1c-32.4-14.7-72-8.8-98.6 17.9-26.7 26.7-32.6 66.2-17.9 98.6C23.7 186.1 0 218.3 0 256s23.7 69.9 57.1 82.4c-14.7 32.4-8.8 72 17.9 98.6 26.6 26.6 66.1 32.7 98.6 17.9 12.5 33.3 44.7 57.1 82.4 57.1s69.9-23.7 82.4-57.1c32.6 14.8 72 8.7 98.6-17.9 26.7-26.7 32.6-66.2 17.9-98.6 33.4-12.5 57.1-44.7 57.1-82.4zm-144.8-44.25L236.16 341.74c-4.31 4.28-11.28 4.25-15.55-.06l-75.72-76.33c-4.28-4.31-4.25-11.28.06-15.56l26.03-25.82c4.31-4.28 11.28-4.25 15.56.06l42.15 42.49 97.2-96.42c4.31-4.28 11.28-4.25 15.55.06l25.82 26.03c4.28 4.32 4.26 11.29-.06 15.56z"></path></svg>
                                    </span>
                                    <span class="badge_title"><a id="pay_com" href="{{route('commission')}}">@lang('site.pay commission')</a></span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-4 left-content">
                        <div>
                            <?php
                            $score=0;
                            foreach($user->userRate as $rate){
                                $score=$score+$rate->recommend;
                            }
                            $countPositeve=count($user->userRate->where('recommend',1) );
                            $countNegative=count($user->userRate->where('recommend',0) );
                            $rates=floor(($countPositeve*5+$countNegative*1)/5);

                            ?>
                            <div class="stars">
                            @if($rates <= 0)
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
    @elseif($rates == 1)
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star gold" aria-hidden="true"></i>
    @elseif($rates == 2)

        <i class="fa fa-star"  aria-hidden="true"></i>
        <i class="fa fa-star"  aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star gold" aria-hidden="true"></i>
        <i class="fa fa-star gold" aria-hidden="true"></i>
    @elseif($rates == 3)
        <i class="fa fa-star"  aria-hidden="true"></i>
        <i class="fa fa-star"  aria-hidden="true"></i>
        <i class="fa fa-star gold"  aria-hidden="true"></i>
        <i class="fa fa-star gold" aria-hidden="true"></i>
        <i class="fa fa-star gold" aria-hidden="true"></i>
    @elseif($rates == 4)
        <i class="fa fa-star"  aria-hidden="true"></i>
        <i class="fa fa-star gold"  aria-hidden="true"></i>
        <i class="fa fa-star gold"  aria-hidden="true"></i>
        <i class="fa fa-star gold"  aria-hidden="true"></i>
        <i class="fa fa-star gold" aria-hidden="true"></i>
    @elseif($rates >= 5)
        <i class="fa fa-star gold"   aria-hidden="true"></i>
        <i class="fa fa-star gold"   aria-hidden="true"></i>
        <i class="fa fa-star gold"   aria-hidden="true"></i>
        <i class="fa fa-star gold"   aria-hidden="true"></i>
        <i class="fa fa-star gold"   aria-hidden="true"></i>
    @endif
                            </div>
                            <a href="{{route('user_rates',$user->id)}}" class="rate main-color">{{$countPositeve!=null?$countPositeve .'تقييم إجابى ':'لا يوجد تقييم '}}</a>
                        </div>
                    </div>
                </div>
            </div>
            @if(Auth::check() and auth::user()->id != $user->id)
            <div class="contact-user text-center">
                <a href="{{route('new_conv',$user->id)}}" class="btn-chat main-color">
                    <svg class="svg-inline--hi " viewBox="0 0 39.657 39.656" xmlns="http://www.w3.org/2000/svg"><path d="M39.657 26.837a12.858 12.858 0 00-7.052-11.449 17.486 17.486 0 01-17.216 17.221 12.824 12.824 0 0017.972 5.269l6.24 1.726-1.727-6.24a12.772 12.772 0 001.783-6.527zm-9.372-11.7a15.142 15.142 0 10-28.185 7.7l-2.044 7.39 7.39-2.043a15.146 15.146 0 0022.839-13.043zm-19.723.246a1.715 1.715 0 11-1.715-1.716 1.715 1.715 0 011.715 1.721zm6.542 0a1.716 1.716 0 11-1.716-1.716 1.716 1.716 0 011.716 1.721zm6.542 0a1.716 1.716 0 11-1.716-1.716 1.716 1.716 0 011.719 1.721z" fill="currentColor"></path></svg>
                    <span>@lang('site.conversation')</span></a>
            </div>
            @endif
            @foreach($user->user_posts as $Upost)
            <?php $post=$Upost;?>
            <div class="single-product">
                <div class="postInfo">
                    <div class="postTitle">
                        <a href="{{url('/')}}/single/post/{{$post->id}}" style="width: 100%;">{{$post->title}}</a>

                    </div>
                    <div class="postExtraInfo">
                            <div class="postExtraInfoPart"></div>
                            <div class="postExtraInfoPart">
                                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="alarm-clock" class="svg-inline--fa fa-alarm-clock fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M32 112a80.09 80.09 0 0 1 80-80 79.23 79.23 0 0 1 50 18 253.22 253.22 0 0 1 34.44-10.8C175.89 15.42 145.86 0 112 0A112.14 112.14 0 0 0 0 112c0 25.86 9.17 49.41 24 68.39a255.93 255.93 0 0 1 17.4-31.64A78.94 78.94 0 0 1 32 112zM400 0c-33.86 0-63.89 15.42-84.44 39.25A253.22 253.22 0 0 1 350 50.05a79.23 79.23 0 0 1 50-18 80.09 80.09 0 0 1 80 80 78.94 78.94 0 0 1-9.36 36.75A255.93 255.93 0 0 1 488 180.39c14.79-19 24-42.53 24-68.39A112.14 112.14 0 0 0 400 0zM256 64C132.29 64 32 164.29 32 288a222.89 222.89 0 0 0 54.84 146.54L34.34 487a8 8 0 0 0 0 11.32l11.31 11.31a8 8 0 0 0 11.32 0l52.49-52.5a223.21 223.21 0 0 0 293.08 0L455 509.66a8 8 0 0 0 11.32 0l11.31-11.31a8 8 0 0 0 0-11.32l-52.5-52.49A222.89 222.89 0 0 0 480 288c0-123.71-100.29-224-224-224zm0 416c-105.87 0-192-86.13-192-192S150.13 96 256 96s192 86.13 192 192-86.13 192-192 192zm14.38-183.69V168a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v136a16 16 0 0 0 6 12.48l73.75 59a8 8 0 0 0 11.25-1.25l10-12.5a8 8 0 0 0-1.25-11.25z"></path>
                                </svg>
                                <span class="">{{$post->created_at->diffForHumans()}}</span>
                            </div>
                    </div>
                    <div class="postExtraInfo">
                        <div class="postExtraInfoPart">
                            @if($post->area_id != null)
                                <a href="{{url('/')}}/city/{{$post->area->id}}" class="location"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="map-marker" class="svg-inline--fa fa-map-marker fa-w-12 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M192 0C85.961 0 0 85.961 0 192c0 77.413 26.97 99.031 172.268 309.67 9.534 13.772 29.929 13.774 39.465 0C357.03 291.031 384 269.413 384 192 384 85.961 298.039 0 192 0zm0 473.931C52.705 272.488 32 256.494 32 192c0-42.738 16.643-82.917 46.863-113.137S149.262 32 192 32s82.917 16.643 113.137 46.863S352 149.262 352 192c0 64.49-20.692 80.47-160 281.931z"></path></svg> {{$post->area->name}}</a>
                            @endif
                        </div>
                        <div class="postExtraInfoPart">
                            <a href="{{url('/')}}/user/{{$post->post_user->user->id}}/profile">
                                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="user" class="svg-inline--fa fa-user fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M313.6 288c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4zM416 464c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16v-41.6C32 365.9 77.9 320 134.4 320c19.6 0 39.1 16 89.6 16 50.4 0 70-16 89.6-16 56.5 0 102.4 45.9 102.4 102.4V464zM224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm0-224c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"></path>
                                </svg> {{$post->post_user->user->name}}</a>
                        </div>
                    </div>
                </div>
                <div class="postImg">
                    <?php $img=$post->images->where('type',0)->first();
                    if($img==null){
                    $logo=\App\Models\setting::where('name','logo')->first()->value;
                    }else{
                        $logo=$img->image;
                    }
                    ?>
                    <img src="{{url('/')}}/public/storage/{{$logo}}" alt="{{$post->title}}">
                </div>
            </div>
            @endforeach
            @if(count($user->user_posts)<10)
            <div class="more-items text-center">
                <p>@lang('site.There are no more posts')</p>
            </div>
            @endif
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
                            <div id="qr_download">
                                <?php echo $user->QR?>
                            </div>
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
                                <div class="qr-sticker-view__footer-handler">@ {{$user->store_identify??''}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="qrcode-wrapper__btns">
                        <button class="btn btn-primary-alt" onclick={window.print()}>@lang('site.print')</button>
                        <button class="btn btn-primary-alt"><a href="javascript: downloadSVG();" download="">@lang('site.download as image')</a></button>
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
                        <a href="{{route('commission')}}">
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
<!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons"data-url="{{url('/')}}/user/{{$user->id}}/profile" data-title="{{$user->name}}"></div><!-- ShareThis END -->
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
<script>
$('.follow').on('click',function(){
    var id=$(this).attr('id');
    console.log(id);
    $.ajax({
        url:'{{ route('follow_user') }}',
        type:'post',
        data: {
            user_id : id,
            _token: "{{ csrf_token() }}"
         },success:function(res){
             console.log(res);
             window.location.reload();
            } ,  error:function(err){
                  console.log(err);
                    }
    });
});

</script>

@endsection
