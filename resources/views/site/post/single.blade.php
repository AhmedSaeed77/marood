
@extends('site.layouts.app')
@section('title')
    <title>{{$post->title}}</title>
@endsection

@section('style')
    <style>
        .toast.show {
            display: block;
            opacity: 1;
            margin: 0 auto;
            position: fixed;
            z-index: 999;
            width: 300px;
            left: 50%;
            transform: translateX(-50%);
            top: 18px;
        }
        body{
            overflow-x:hidden;
        }
        
        .post-page .info .article {
            color: #525762;
            font-size: 20px;
            white-space: pre-line;
    
}
    </style>
    
    @if(app()->getLocale() == 'en')
        <style>
            .post-page .info .info-post {
                direction: ltr;
            }

            .post-page .info .article {
                direction: ltr;
            }
            
            body{
                  direction: ltr;
                
            }
        </style>
    @endif
@endsection

@section('content')
    <?php $mainPost=$post?>
        <!--========================== Start post page ==========================-->
    <input type="hidden" value="{{$mainPost->id}}" id="mainPostId" />
    <section class="post-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-8"></div>
                <div class="col-xl-3 col-lg-4 or-sm-2">
                    <h4 class="main-color similar-head">@lang('site.similar posts')</h4>
                </div>
                <div class="col-xl-9 col-lg-8 px-1">
                    <div class="main-box">
                        <div class="info">
                            <div class="info-post">
                                <h4>{{$post->title}}</h4>
                                <div class="row">
                                    <div class="col-6">
                                        @if($post->area_id !=null)
                                            <a href="{{url('/')}}/city/{{$post->area_id}}" class="location d-block"><i class="fas fa-map-marker-alt"></i> {{$post->area->name}}</a>
                                        @endif
                                        <span class="time row">
                                            <span class="col-md-12">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="clock" class="svg-inline--fa fa-clock fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm57.1 350.1L224.9 294c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h48c6.6 0 12 5.4 12 12v137.7l63.5 46.2c5.4 3.9 6.5 11.4 2.6 16.8l-28.2 38.8c-3.9 5.3-11.4 6.5-16.8 2.6z"></path>
                                                </svg>{{$post->created_at->diffForHumans()}}
                                            </span>
                                            <span class="col-md-12">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="clock" class="svg-inline--fa fa-clock fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm57.1 350.1L224.9 294c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h48c6.6 0 12 5.4 12 12v137.7l63.5 46.2c5.4 3.9 6.5 11.4 2.6 16.8l-28.2 38.8c-3.9 5.3-11.4 6.5-16.8 2.6z"></path>
                                                </svg>@lang('site.last update') {{$post->updated_at->diffForHumans()}}
                                            </span>
                                         </span>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{url('/')}}/user/{{$post->post_user->user->id}}/profile" class="user"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="user" class="svg-inline--fa fa-user fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M313.6 288c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4zM416 464c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16v-41.6C32 365.9 77.9 320 134.4 320c19.6 0 39.1 16 89.6 16 50.4 0 70-16 89.6-16 56.5 0 102.4 45.9 102.4 102.4V464zM224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm0-224c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"></path></svg> {{$post->post_user->user->name}}</a>

                                        <div class="next-item-h">
                                            <span class="code">#{{$post->id}}</span>
                                        </div>
                                        <!--@if(count($rating)>0)-->
                                        <!--<a href="#" class="rate d-block"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="thumbs-up" class="svg-inline--fa fa-thumbs-up fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M104 224H24c-13.255 0-24 10.745-24 24v240c0 13.255 10.745 24 24 24h80c13.255 0 24-10.745 24-24V248c0-13.255-10.745-24-24-24zM64 472c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24zM384 81.452c0 42.416-25.97 66.208-33.277 94.548h101.723c33.397 0 59.397 27.746 59.553 58.098.084 17.938-7.546 37.249-19.439 49.197l-.11.11c9.836 23.337 8.237 56.037-9.308 79.469 8.681 25.895-.069 57.704-16.382 74.757 4.298 17.598 2.244 32.575-6.148 44.632C440.202 511.587 389.616 512 346.839 512l-2.845-.001c-48.287-.017-87.806-17.598-119.56-31.725-15.957-7.099-36.821-15.887-52.651-16.178-6.54-.12-11.783-5.457-11.783-11.998v-213.77c0-3.2 1.282-6.271 3.558-8.521 39.614-39.144 56.648-80.587 89.117-113.111 14.804-14.832 20.188-37.236 25.393-58.902C282.515 39.293 291.817 0 312 0c24 0 72 8 72 81.452z"></path></svg> {{count($rating)}}</a>-->
                                        <!--@endif-->
                                    </div>
                                </div>
                            </div>
                            
                            {{--start real state----------------------------------------------------------------------------------- --}}
                            @if($post->Cat->type == 2 && $post->Cat->parent_id == 5)
                                <ul style="list-style-type: none">
                                    @if($post->street)<li>@lang('site.street') {{$street[$post->street]}}</li> @endif
                                    @if($post->space)<li>@lang('site.space') {{$post->space}}</li>@endif
                                    @if($post->age_of_state)<li>@lang('site.age_of_state') {{$post->age_of_state}}</li>@endif
                                    @if($post->destination)<li>@lang('site.destination') {{$destinations[$post->destination]}}</li>@endif
                                    @if($post->street_width)<li>@lang('site.street_width') {{$post->street_width}}</li>@endif
                                    @if($post->rooms_number)<li>@lang('site.rooms_number') {{$post->rooms_number}}</li>@endif
                                    @if($post->number_of_halls)<li>@lang('site.number_of_halls') {{$post->number_of_halls}}</li>@endif
                                    @if($post->number_of_bathrooms)<li>@lang('site.number_of_bathrooms') {{$post->number_of_bathrooms}}</li>@endif
                                    @if($post->villa_type)<li>@lang('site.villa_type') {{$villa_types[$post->villa_type]}}</li>@endif

                                        @if($post->additional_options != null && is_array($decodedOptions = json_decode($post->additional_options, true)))

                                        <li>@lang('site.additional_options')
                                            <ul style="list-style-type: none">
                                                @foreach ($decodedOptions as $item)
                                                    <li>{{$options[$item] ?? $item}}</li>
                                                @endforeach
                                            </ul>

                                        </li>
                                    @endif

                                </ul>

                            @endif
                            {{--end real state--------------------------------------------------------------------------------------------- --}}


                            <div class="custom-padding">
                                <div class="article">
                                        <?php echo $post->description;?>
                                </div>
                                <div class="images">
                                    @foreach($post->images as $img)

                                        @if($img->type==0)

                                            <img style="height:700px; width:700px " src="{{url('/')}}/public/storage/{{$img->image}}" alt="">
                                        @elseif($img->type==1)
                                            <div>
                                                <video  controls>
                                                    <source src="{{url('/')}}/public/storage/{{$img->image}}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                                <video>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                @if($post->contact==1 and $post->mobile!=null )
                                    <a href="tel:{{ $post->mobile}}" class="contact-user"><i class="fas fa-phone"></i>
                                        {{$post->mobile}}

                                        @else
                                            <a  class="contact-user"><i class="fas fa-phone"></i>
                                                @if($post->comment==1)
                                                    @lang('site.Communicate via private messages and responses')
                                                @else
                                                    @lang('site.Communicate via private messages')
                                                @endif
                                                @endif
                                            </a>
                            </div>

                        </div>
                    </div>
                    <div class="next-item">
                        @php
                            $previous = App\Models\Post::where('id', '<', $post->id)->min('id');
                        @endphp
                        @if(!is_null($previous))
                            <a href="{{url('single/post/'.$previous)}}" class="prev"><i class="fas fa-arrow-right"></i> @lang('site.previous post')</a>
                        @endif

                        @php
                            $next = App\Models\Post::where('id', '>', $post->id)->min('id');
                        @endphp
                        @if(!is_null($next))
                            <a href="{{url('single/post/'.$next)}}" class="next">@lang('site.next post')<i class="fas fa-arrow-left"></i></a>
                        @endif

                        <div class="clearfix"></div>
                    </div>
                    <!--------------------------------------- Start Area Map -------------------------------------->

                    @if(!is_null($post->lat) && !is_null($post->lng))
                        @if($post->Cat->parent_id == '4033' || $post->Cat->parent_id == '4034')
                            <div class="custom-padding">
                                <div id="mapid" style="width: 500px; height: 500px;"></div>
                            </div>
                        @endif
                    @endif

                    <!--------------------------------------- End Area Map -------------------------------------->
                    @if(auth::check() and auth::user()->id==$post->post_user->user_id)
                        <div class="actions_wrapper author_actions">
                            <a class="btn-borderless action_btn" href="{{route('edit_single_post',$mainPost->id)}}">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pencil" class="svg-inline--fa fa-pencil fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M497.9 142.1l-46.1 46.1c-4.7 4.7-12.3 4.7-17 0l-111-111c-4.7-4.7-4.7-12.3 0-17l46.1-46.1c18.7-18.7 49.1-18.7 67.9 0l60.1 60.1c18.8 18.7 18.8 49.1 0 67.9zM284.2 99.8L21.6 362.4.4 483.9c-2.9 16.4 11.4 30.6 27.8 27.8l121.5-21.3 262.6-262.6c4.7-4.7 4.7-12.3 0-17l-111-111c-4.8-4.7-12.4-4.7-17.1 0zM88 424h48v36.3l-64.5 11.3-31.1-31.1L51.7 376H88v48z"></path></svg>
                                <span>@lang('site.edit')</span>
                            </a>
                            <a href="{{route('single_post',$mainPost->id)}}">
                            <button class="btn-borderless action_btn update_btn">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sync-alt" class="svg-inline--fa fa-sync-alt fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M370.72 133.28C339.458 104.008 298.888 87.962 255.848 88c-77.458.068-144.328 53.178-162.791 126.85-1.344 5.363-6.122 9.15-11.651 9.15H24.103c-7.498 0-13.194-6.807-11.807-14.176C33.933 94.924 134.813 8 256 8c66.448 0 126.791 26.136 171.315 68.685L463.03 40.97C478.149 25.851 504 36.559 504 57.941V192c0 13.255-10.745 24-24 24H345.941c-21.382 0-32.09-25.851-16.971-40.971l41.75-41.749zM32 296h134.059c21.382 0 32.09 25.851 16.971 40.971l-41.75 41.75c31.262 29.273 71.835 45.319 114.876 45.28 77.418-.07 144.315-53.144 162.787-126.849 1.344-5.363 6.122-9.15 11.651-9.15h57.304c7.498 0 13.194 6.807 11.807 14.176C478.067 417.076 377.187 504 256 504c-66.448 0-126.791-26.136-171.315-68.685L48.97 471.03C33.851 486.149 8 475.441 8 454.059V320c0-13.255 10.745-24 24-24z"></path>
                                </svg>
                                <span>@lang('site.update')</span>
                            </button>
                            </a>
                            <button class="btn-borderless action_btn" data-toggle="modal" data-target="#deletePostModal">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path>
                                </svg>
                                <span>@lang('site.delete')</span>
                            </button>
                            <!--<a class="btn-borderless action_btn" href="{{route('edit_single_post',$mainPost->id)}}">-->
                            <!--    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="video-plus" class="svg-inline--fa fa-video-plus fa-w-18 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M336.2 64H47.8C21.4 64 0 85.4 0 111.8v288.4C0 426.6 21.4 448 47.8 448h288.4c26.4 0 47.8-21.4 47.8-47.8V111.8c0-26.4-21.4-47.8-47.8-47.8zM304 264c0 8.8-7.2 16-16 16h-72v72c0 8.8-7.2 16-16 16h-16c-8.8 0-16-7.2-16-16v-72H96c-8.8 0-16-7.2-16-16v-16c0-8.8 7.2-16 16-16h72v-72c0-8.8 7.2-16 16-16h16c8.8 0 16 7.2 16 16v72h72c8.8 0 16 7.2 16 16v16zm272-136.5v256.9c0 25.5-29.1 40.4-50.4 25.8L416 334.7V177.3l109.6-75.5c21.3-14.7 50.4.3 50.4 25.7z"></path></svg>-->
                            <!--    <span>@lang('site.update video')</span>-->
                            <!--</a>-->
                            <button class="btn-borderless action_btn add-chooses" id="more_actions_btn">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cogs" class="svg-inline--fa fa-cogs fa-w-20 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M512.1 191l-8.2 14.3c-3 5.3-9.4 7.5-15.1 5.4-11.8-4.4-22.6-10.7-32.1-18.6-4.6-3.8-5.8-10.5-2.8-15.7l8.2-14.3c-6.9-8-12.3-17.3-15.9-27.4h-16.5c-6 0-11.2-4.3-12.2-10.3-2-12-2.1-24.6 0-37.1 1-6 6.2-10.4 12.2-10.4h16.5c3.6-10.1 9-19.4 15.9-27.4l-8.2-14.3c-3-5.2-1.9-11.9 2.8-15.7 9.5-7.9 20.4-14.2 32.1-18.6 5.7-2.1 12.1.1 15.1 5.4l8.2 14.3c10.5-1.9 21.2-1.9 31.7 0L552 6.3c3-5.3 9.4-7.5 15.1-5.4 11.8 4.4 22.6 10.7 32.1 18.6 4.6 3.8 5.8 10.5 2.8 15.7l-8.2 14.3c6.9 8 12.3 17.3 15.9 27.4h16.5c6 0 11.2 4.3 12.2 10.3 2 12 2.1 24.6 0 37.1-1 6-6.2 10.4-12.2 10.4h-16.5c-3.6 10.1-9 19.4-15.9 27.4l8.2 14.3c3 5.2 1.9 11.9-2.8 15.7-9.5 7.9-20.4 14.2-32.1 18.6-5.7 2.1-12.1-.1-15.1-5.4l-8.2-14.3c-10.4 1.9-21.2 1.9-31.7 0zm-10.5-58.8c38.5 29.6 82.4-14.3 52.8-52.8-38.5-29.7-82.4 14.3-52.8 52.8zM386.3 286.1l33.7 16.8c10.1 5.8 14.5 18.1 10.5 29.1-8.9 24.2-26.4 46.4-42.6 65.8-7.4 8.9-20.2 11.1-30.3 5.3l-29.1-16.8c-16 13.7-34.6 24.6-54.9 31.7v33.6c0 11.6-8.3 21.6-19.7 23.6-24.6 4.2-50.4 4.4-75.9 0-11.5-2-20-11.9-20-23.6V418c-20.3-7.2-38.9-18-54.9-31.7L74 403c-10 5.8-22.9 3.6-30.3-5.3-16.2-19.4-33.3-41.6-42.2-65.7-4-10.9.4-23.2 10.5-29.1l33.3-16.8c-3.9-20.9-3.9-42.4 0-63.4L12 205.8c-10.1-5.8-14.6-18.1-10.5-29 8.9-24.2 26-46.4 42.2-65.8 7.4-8.9 20.2-11.1 30.3-5.3l29.1 16.8c16-13.7 34.6-24.6 54.9-31.7V57.1c0-11.5 8.2-21.5 19.6-23.5 24.6-4.2 50.5-4.4 76-.1 11.5 2 20 11.9 20 23.6v33.6c20.3 7.2 38.9 18 54.9 31.7l29.1-16.8c10-5.8 22.9-3.6 30.3 5.3 16.2 19.4 33.2 41.6 42.1 65.8 4 10.9.1 23.2-10 29.1l-33.7 16.8c3.9 21 3.9 42.5 0 63.5zm-117.6 21.1c59.2-77-28.7-164.9-105.7-105.7-59.2 77 28.7 164.9 105.7 105.7zm243.4 182.7l-8.2 14.3c-3 5.3-9.4 7.5-15.1 5.4-11.8-4.4-22.6-10.7-32.1-18.6-4.6-3.8-5.8-10.5-2.8-15.7l8.2-14.3c-6.9-8-12.3-17.3-15.9-27.4h-16.5c-6 0-11.2-4.3-12.2-10.3-2-12-2.1-24.6 0-37.1 1-6 6.2-10.4 12.2-10.4h16.5c3.6-10.1 9-19.4 15.9-27.4l-8.2-14.3c-3-5.2-1.9-11.9 2.8-15.7 9.5-7.9 20.4-14.2 32.1-18.6 5.7-2.1 12.1.1 15.1 5.4l8.2 14.3c10.5-1.9 21.2-1.9 31.7 0l8.2-14.3c3-5.3 9.4-7.5 15.1-5.4 11.8 4.4 22.6 10.7 32.1 18.6 4.6 3.8 5.8 10.5 2.8 15.7l-8.2 14.3c6.9 8 12.3 17.3 15.9 27.4h16.5c6 0 11.2 4.3 12.2 10.3 2 12 2.1 24.6 0 37.1-1 6-6.2 10.4-12.2 10.4h-16.5c-3.6 10.1-9 19.4-15.9 27.4l8.2 14.3c3 5.2 1.9 11.9-2.8 15.7-9.5 7.9-20.4 14.2-32.1 18.6-5.7 2.1-12.1-.1-15.1-5.4l-8.2-14.3c-10.4 1.9-21.2 1.9-31.7 0zM501.6 431c38.5 29.6 82.4-14.3 52.8-52.8-38.5-29.6-82.4 14.3-52.8 52.8z"></path>
                                </svg>
                                <div class="ddm_wrapper">
                                    <span class="ddm_option comment">@if($mainPost->comment ==1) @lang('site.turn off comments') @else @lang('site.turn on comments')@endif</span>
                                    {{--
                                    <span class="ddm_option map">@if($mainPost->show_on_map ==1) @lang('site.Hide off the map')@else @lang('site.Show on map')@endif</span>
                                    --}}
                                </div>
                                <span>@lang('site.Additional options')</span>
                            </button>
                            <!--@if($post->is_pay==0)-->
                            <!--<a class="btn-borderless action_btn" href="{{route('pay_commission')}}">-->
                            <!--    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="credit-card" class="svg-inline--fa fa-credit-card fa-w-18 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" color="#1DBA73"><path fill="currentColor" d="M0 432c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V256H0v176zm192-68c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H204c-6.6 0-12-5.4-12-12v-40zm-128 0c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM576 80v48H0V80c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48z"></path>-->
                            <!--    </svg>-->
                            <!--    <span>@lang('site.Pay the commission')</span>-->
                            <!--</a>-->
                            <!--@endif-->
                        </div>
                            <?php $fav=\App\Models\FavPosts::where('post_id',$post->id)->get()?>
                        <div class="actions_wrapper is_author">

                            <button class="btn-borderless action_btn fav-btn">

                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" color="#FF2121"><path fill="currentColor" d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path>
                                </svg>
                                <span style="margin-left: 5px;" class="num">{{$CountFav}}</span>
                                <span>@lang('site.Add to favourites')</span>

                            </button>

                            <button class="btn-borderless action_btn" data-toggle="modal" data-target="#shareModal" id="share_btn">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="share-alt" class="svg-inline--fa fa-share-alt fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M352 320c-22.608 0-43.387 7.819-59.79 20.895l-102.486-64.054a96.551 96.551 0 0 0 0-41.683l102.486-64.054C308.613 184.181 329.392 192 352 192c53.019 0 96-42.981 96-96S405.019 0 352 0s-96 42.981-96 96c0 7.158.79 14.13 2.276 20.841L155.79 180.895C139.387 167.819 118.608 160 96 160c-53.019 0-96 42.981-96 96s42.981 96 96 96c22.608 0 43.387-7.819 59.79-20.895l102.486 64.054A96.301 96.301 0 0 0 256 416c0 53.019 42.981 96 96 96s96-42.981 96-96-42.981-96-96-96z"></path>
                                </svg>
                                <span>@lang('site.share')</span>
                            </button>
                        </div>

                    @else
                        <div class="group">
                            <a href="#" data-toggle="modal" data-target="#senMsgModal"><i class="fas fa-envelope"></i><span>@lang('site.Correspondence')</span></a>
                            @if(auth::check())
                                @if(auth::user()->id != $post->post_user->User->id)
                                        <?php $fav=\App\Models\FavPosts::where('post_id',$post->id)->where('user_id',auth::user()->id)->first();?>
                                    <a href="{{route('fav_post_link',$post->id)}}"><i class="fas fa-heart" style="{{!empty($fav)?'color:red':''}}"></i> {{$CountFav}}<span> @lang('site.Add to favourites')</span></a>
                                @else

                                    <a href="#"><i class="fas fa-heart"></i> {{$CountFav}} <span>@lang('site.Add to favourites')</span></a>
                                @endif
                            @else

                                <a href="#"><i class="fas fa-heart"></i> {{$CountFav}}<span> @lang('site.Add to favourites')</span></a>
                            @endif
                            <a href="#" data-toggle="modal" data-target="#shareModal"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="share-alt" class="svg-nav svg-inline--fa fa-share-alt fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M352 320c-22.608 0-43.387 7.819-59.79 20.895l-102.486-64.054a96.551 96.551 0 0 0 0-41.683l102.486-64.054C308.613 184.181 329.392 192 352 192c53.019 0 96-42.981 96-96S405.019 0 352 0s-96 42.981-96 96c0 7.158.79 14.13 2.276 20.841L155.79 180.895C139.387 167.819 118.608 160 96 160c-53.019 0-96 42.981-96 96s42.981 96 96 96c22.608 0 43.387-7.819 59.79-20.895l102.486 64.054A96.301 96.301 0 0 0 256 416c0 53.019 42.981 96 96 96s96-42.981 96-96-42.981-96-96-96z"></path></svg><span>@lang('site.share')</span></a>
                            @if($post->contact==1)
                                <a href="#" data-toggle="modal" data-target="#whatsappModal"><i class="fab fa-whatsapp"></i><span>@lang('site.share with whatsapp')</span></a>
                            @endif
                            <a href="#" data-toggle="modal" data-target="#reportModal"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="flag" class="svg-nav svg-inline--fa fa-flag fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M349.565 98.783C295.978 98.783 251.721 64 184.348 64c-24.955 0-47.309 4.384-68.045 12.013a55.947 55.947 0 0 0 3.586-23.562C118.117 24.015 94.806 1.206 66.338.048 34.345-1.254 8 24.296 8 56c0 19.026 9.497 35.825 24 45.945V488c0 13.255 10.745 24 24 24h16c13.255 0 24-10.745 24-24v-94.4c28.311-12.064 63.582-22.122 114.435-22.122 53.588 0 97.844 34.783 165.217 34.783 48.169 0 86.667-16.294 122.505-40.858C506.84 359.452 512 349.571 512 339.045v-243.1c0-23.393-24.269-38.87-45.485-29.016-34.338 15.948-76.454 31.854-116.95 31.854z"></path></svg><span>@lang('site.report')</span></a>

                        </div>

                    @endif
                    <div class="tags_wrapper">
                        <a href="{{url('/')}}/tag/{{$post->cat_id}}">{{$post->cat->name}}</a>
                        <a href="{{url('/')}}/tag/{{$parent->id}}">{{$parent->name}}</a>
                        <a href="{{url('/')}}">@lang('site.all')</a>
                    </div>
                    <div class="random-help-message">
                        <span class="icon_wrapper">
                            <svg class="svg-inline--hi hi-fw icon" viewBox="0 0 66.014 44.964" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.874 25.418c.888-9.184 13.57-10.872 16.83-2.24l.136.36a4.427 4.427 0 01.276 1.25 13.989 13.989 0 0012.5 13.124 3.511 3.511 0 013.027 3.668v.068a3.509 3.509 0 01-3.747 3.308 20.4 20.4 0 01-17.6-12.264l-2.331 1.071a17.379 17.379 0 006.992 9.008v2.015H-.004zM14.739 0a7.936 7.936 0 107.936 7.936A7.937 7.937 0 0014.739 0zm37.542 0a7.936 7.936 0 107.936 7.936A7.937 7.937 0 0052.282 0zM48.06 42.77v2.015h17.953l-1.875-19.367c-.888-9.184-13.57-10.872-16.83-2.24l-.136.36a4.468 4.468 0 00-.277 1.25 14.465 14.465 0 01-3.37 8.344 14.3 14.3 0 01-8.374 4.656 5.355 5.355 0 011.359 3.893v.07a5.372 5.372 0 01-1.279 3.2 20.389 20.389 0 0017.494-12.256l2.331 1.071a17.379 17.379 0 01-6.992 9.008z" fill="currentColor">
                                </path>
                            </svg>
                        </span>
                        <p>@lang('site.Avoid accepting checks and cash and ensure local bank transfer.')</p>
                    </div>
                    @if($post->comment==0)
                        <div class="random-help-message comments_disabled">
                        <span class="icon_wrapper">
                            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times-circle" class="svg-inline--fa fa-times-circle fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 464c-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216 0 118.7-96.1 216-216 216zm94.8-285.3L281.5 256l69.3 69.3c4.7 4.7 4.7 12.3 0 17l-8.5 8.5c-4.7 4.7-12.3 4.7-17 0L256 281.5l-69.3 69.3c-4.7 4.7-12.3 4.7-17 0l-8.5-8.5c-4.7-4.7-4.7-12.3 0-17l69.3-69.3-69.3-69.3c-4.7-4.7-4.7-12.3 0-17l8.5-8.5c4.7-4.7 12.3-4.7 17 0l69.3 69.3 69.3-69.3c4.7-4.7 12.3-4.7 17 0l8.5 8.5c4.6 4.7 4.6 12.3 0 17z">
                                </path>
                            </svg>
                        </span>

                            <p>@lang('site.The advertiser has removed the replies feature.')</p>

                        </div>
                    @endif

                    @if($post->comment==1)
                        @foreach($post->comments->where('parent_id',null) as $i=>$comment)
                            <div class="comment_list_wrapper">
                                <div class="comment_wrapper" id="{{$comment->id}}">
                                    <div class="comment_meta">
                                <span class="main_meta">
                                    <span class="icon_wrapper_com" style="width: 2em; height: 2em; padding: 8px; background-color: rgb(228, 231, 245); border-radius: 50%;">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" class="svg-inline--fa fa-user fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path>
                                        </svg>
                                    </span>
                                <span class="username_wrapper">
                                    <span>
                                        <a href="{{url('/')}}/user/{{$comment->user_id}}/profile">{{$comment->user->name}}</a>
{{--                                        <span class="icon_wrapper_com clickable" style="width: 2em; height: 2em; padding: 8px; background-color: rgb(228, 231, 245); border-radius: 50%;">--}}
                                        {{--                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope" class="svg-inline--fa fa-envelope fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path></svg>--}}
                                        {{--                                        </span>--}}
                                        
                                 
                                </span>
                                <span class="comment_time">{{$comment->created_at->diffForhumans()}}</span>
                                </span>
                                </span>
                                        <span class="icon_wrapper_com" style="width: 2em; height: 2em; padding: 8px; background-color: rgb(228, 231, 245); border-radius: 50%;">
                                    <span>{{$i+1<10?'0':''}}{{$i+=1}}</span>
                                </span>
                                    </div>
                                    <div class="comment_body">
                                        <span>{{$comment->comment}}</span>
                                    </div>
                                    <div class="options_wrapper">
                                        <button class="reply_btn">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="comment" class="svg-inline--fa fa-comment fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 64c123.5 0 224 79 224 176S379.5 416 256 416c-28.3 0-56.3-4.3-83.2-12.8l-15.2-4.8-13 9.2c-23 16.3-58.5 35.3-102.6 39.6 12-15.1 29.8-40.4 40.8-69.6l7.1-18.7-13.7-14.6C47.3 313.7 32 277.6 32 240c0-97 100.5-176 224-176m0-32C114.6 32 0 125.1 0 240c0 47.6 19.9 91.2 52.9 126.3C38 405.7 7 439.1 6.5 439.5c-6.6 7-8.4 17.2-4.6 26 3.8 8.8 12.4 14.5 22 14.5 61.5 0 110-25.7 139.1-46.3 29 9.1 60.2 14.3 93 14.3 141.4 0 256-93.1 256-208S397.4 32 256 32z"></path>
                                            </svg>
                                            <span>@lang('site.Reply')</span>
                                        </button>

                                        {{--span bar--}}
{{--                                        <span class="comment_option_wrapper"><button  id="{{$i}}" class="btn-borderless more_btn">--}}
{{--                                                --}}
{{--                                        <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="bars" class="svg-inline--fa fa-bars fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M442 114H6a6 6 0 0 1-6-6V84a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6zm0 160H6a6 6 0 0 1-6-6v-24a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6zm0 160H6a6 6 0 0 1-6-6v-24a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6z"></path></svg></button>--}}
{{--                                        --}}
{{--                                        </span>--}}

                                     @if($post->post_user->user->id == auth()->id() && auth()->user()->member_id != null)
                                            <a href="{{route('delete.comment',$comment->id)}}"> <i class="fa fa-trash"></i></a>

                                        @endif

                                    </div>

                                </div>
                                <div class="row">
                                        <?php $x=0;?>
                                    @foreach($post->comments->where('parent_id',$comment->id) as $child)
                                            <?php $x++;?>
                                        <div class="comment_list_wrapper comment-child col-md-10">
                                            <div class="comment_wrapper" id="{{$child->id}}">
                                                <div class="comment_meta">
                                        <span class="main_meta">
                                            <span class="icon_wrapper_com" style="width: 2em; height: 2em; padding: 8px; background-color: rgb(228, 231, 245); border-radius: 50%;">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" class="svg-inline--fa fa-user fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                    <path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path>
                                                </svg>
                                                

                                            </span>
                                        <span class="username_wrapper">
                                            <span>
                                                <a href="{{url('/')}}/user/{{$child->user_id}}/profile">{{$child->user->name}}</a>
                                             
                                                
                                                   @if($post->post_user->user->id == auth()->id() && auth()->user()->member_id != null)
                                                    <a href="{{route('delete.comment',$child->id)}}"> <i class="fa fa-trash"></i></a>
                                                    @endif
                                                 
                                                 
{{--                                                <span class="icon_wrapper_com clickable" style="width: 2em; height: 2em; padding: 8px; background-color: rgb(228, 231, 245); border-radius: 50%;">--}}
                                                {{--                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope" class="svg-inline--fa fa-envelope fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path></svg>--}}
                                                {{--
                                                                                            </span>--}}

                                        </span>
                                        <span class="comment_time">{{$child->created_at->diffForhumans()}}</span>
                                        </span>
                                        </span>
                                                    <span class="icon_wrapper_com" style="width: 2em; height: 2em; padding: 8px; background-color: rgb(228, 231, 245); border-radius: 50%;">
                                            <span>{{$x<10?'0':''}}{{$x}}</span>
                                        </span>
                                                </div>
                                                <div class="comment_body">
                                                    <span>{{$child->comment}}</span>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                            </div>
                            <!--============= بداية موديل ابلاغ بخس السلعة ===============-->

                            <div class="modal fade customModal" id="reportOneModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal_content">
                                            <div class="confirm_wrapper">
                                                <span class="question">@lang('site.Confirm Report an Undervalue?')</span>
                                                <div class="btn_wrapper">
                                                    <form action="{{route('comment_infraction')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="post_id" value="{{$mainPost->id}}" />
                                                        <input type="hidden" name="comment_id" value="{{$comment->id}}" />
                                                        <input type="hidden" name="type_id" value="2" />
                                                        <button type="submit" class="btn-pramary-alt">@lang('site.confirm')</button>
                                                        <button  data-dismiss="modal" aria-label="Close" class="btn-danger-alt">@lang('site.cancel')</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--============= نهاية موديل ابلاغ بخس السلعة ===============-->

                            <!--============= بداية موديل ابلاغ رد غير لائق ===============-->

                            <div class="modal fade customModal" id="reportTwoModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal_content">
                                            <div class="confirm_wrapper">
                                                <span class="question">تأكيد إبلاغ عن رد غير لائق ؟</span>
                                                <div class="btn_wrapper">
                                                    <form action="{{route('comment_infraction')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="post_id" value="{{$mainPost->id}}" />
                                                        <input type="hidden" name="comment_id" value="{{$comment->id}}" />
                                                        <input type="hidden" name="type_id" value="3" />
                                                        <button type="submit" class="btn-pramary-alt">@lang('site.confirm')</button>
                                                        <button  data-dismiss="modal" aria-label="Close" class="btn-danger-alt">@lang('site.cancel')</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--============= نهاية موديل ابلاغ رد غير لائق ===============-->

                        @endforeach

                        <div class="follow_btn_wrapper">
                            <form action="{{route('follow_comment',$post->id)}}" method="post">
                                @csrf
                                <button type="submit" class="blue_btn">
                                    @if(empty($follow_commnet))
                                        <span>@lang('site.follow comment')</span>
                                    @else
                                        <span>@lang('site.unfollow comment')</span>
                                    @endif
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="rss" class="svg-inline--fa fa-rss fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M128.081 415.959c0 35.369-28.672 64.041-64.041 64.041S0 451.328 0 415.959s28.672-64.041 64.041-64.041 64.04 28.673 64.04 64.041zm175.66 47.25c-8.354-154.6-132.185-278.587-286.95-286.95C7.656 175.765 0 183.105 0 192.253v48.069c0 8.415 6.49 15.472 14.887 16.018 111.832 7.284 201.473 96.702 208.772 208.772.547 8.397 7.604 14.887 16.018 14.887h48.069c9.149.001 16.489-7.655 15.995-16.79zm144.249.288C439.596 229.677 251.465 40.445 16.503 32.01 7.473 31.686 0 38.981 0 48.016v48.068c0 8.625 6.835 15.645 15.453 15.999 191.179 7.839 344.627 161.316 352.465 352.465.353 8.618 7.373 15.453 15.999 15.453h48.068c9.034-.001 16.329-7.474 16.005-16.504z"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <form class="add_comment_wrapper" action="{{route('comment_post',$post->id)}}" method="POST">
                            @csrf
                            <input type="hidden" name="parent_id"/>
                            <textarea name="comment" placeholder="@lang('site.Write your question for the advertiser here')"></textarea>
                            <div class="btn_msg_wrapper">
                                <button type="submit" class="btn btn-primary blue_btn">
                                    <span>@lang('site.sent')</span>
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paper-plane" class="svg-inline--fa fa-paper-plane fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M476 3.2L12.5 270.6c-18.1 10.4-15.8 35.6 2.2 43.2L121 358.4l287.3-253.2c5.5-4.9 13.3 2.6 8.6 8.3L176 407v80.5c0 23.6 28.5 32.9 42.5 15.8L282 426l124.6 52.2c14.2 6 30.4-2.9 33-18.2l72-432C515 7.8 493.3-6.8 476 3.2z"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
                <div class="col-xl-3 col-lg-4 or-sm-3 px-1">
                    <div class="similar-items">
                        <div class="main-box">
                            <a href="{{url('/')}}/tag/{{$post->cat->id}}" class="head">{{$post->cat->name}}</a>
                            <ul class="images">
                                @foreach($similarPost as $post)
                                        <?php $img=\App\Models\PostImages::where('post_id',$post->id)->orderBy('sort')->first();?>
                                    @if(!empty($img))

                                        <li>
                                            <a href="{{url('/')}}/single/post/{{$post->id}}"><img src="{{url('/')}}/public/storage/{{$img->image}}" alt="img"></a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @if($similarPostArea->count()>0)
                        <div class="similar-items">
                            <div class="main-box">
                                @if($post->area_id !=null)
                                    <a href="{{url('/')}}/tag/{{$post->cat->id}}" class="head">{{$post->cat->name}} @lang('site.in') {{$post->area->name}}</a>
                                @endif
                                <ul class="images">
                                    @foreach($similarPostArea as $post)
                                            <?php $img=\App\Models\PostImages::where('post_id',$post->id)->orderBy('sort')->first();?>
                                        @if(!empty($img))
                                            <li>
                                                <a href="{{url('/')}}/single/post/{{$post->id}}"><img src="{{url('/')}}/public/storage/{{$img->image}}" alt="img"></a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif




                </div>
            </div>
        </div>
    </section>

    <!--========================== End post page ==========================-->





    <!--====================== Modals ========================-->

    <!--============= start share modal ===============-->

    <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLongTitle">شارك هذا المنتج</h5>
                </div>
                <div class="modal-body">
{{--                    <div class="form">--}}
{{--                        <button class="btn" id="copy-btn">copy</button>--}}
{{--                        <input type="text" class="form-control" readonly="" value="{{url('/')}}/single/post/{{$mainPost->id}}" id="inputCopy">--}}
{{--                        <div class="clearfix"></div>--}}
{{--                    </div>--}}

                    <div class="form">
                        <button class="btn" id="copyButton">copy</button>
                        <input type="text" class="form-control" readonly="" value="{{url('/')}}/single/post/{{$mainPost->id}}" id="linkInput">
                        <div class="clearfix"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="sochial text-center">
                        <!--<a href="#"><i class="fab fa-whatsapp"></i></a>-->
                        <!--<a href="#"><i class="fab fa-twitter"></i></a>-->
                        <!--<a href="#"><i class="fab fa-linkedin-in"></i></a>-->
                        <!--<a href="#"><i class="fab fa-snapchat-ghost"></i></a>-->
                        <!--<a href="#"><i class="fab fa-instagram"></i></a>-->
                        <!--<a href="#"><i class="fab fa-facebook-f"></i></a>-->
                        <!--<a href="#"><i class="fas fa-envelope"></i></a>-->
                        <!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons" data-url="{{url('/')}}/single/post/{{$mainPost->id}}" data-title="{{$mainPost->title}}"></div><!-- ShareThis END -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--============= End share modal ===============-->


    <!--============= start whatsapp modal ===============-->

    <div class="modal fade" id="whatsappModal" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="modal-title" id="exampleModalLongTitle">:@lang('site.Correspondence in') @lang('site.siteName')</h5>
                    <ul>
                        <li>@lang('site.More privacy and security')</li>
                        <li>@lang('site.Supports sending pictures and sound')</li>
                    </ul>

                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <a href="{{url('/')}}/new/conv/{{$mainPost->post_user->user->id}}" class="main-btn btn">@lang('site.Correspondence in') @lang('site.siteName')</a>
                        @if(!empty($post->mobile))
                            <!--<a href="https://wa.me/{{$post->post_user->user->phone}}?text=I'm%20interested%20in%20your%20car%20for%20sale" class="btn">@lang('site.whatsapp')</a>-->
                            <a href="https://api.whatsapp.com/send/?phone={{$mainPost->mobile}}/?text=I'm%20interested%20in%20your%20car%20for%20sale" class="btn">@lang('site.whatsapp')</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--============= End whatsapp modal ===============-->
    <!--============= start send msg modal ===============-->

    <div class="modal fade" id="senMsgModal" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body text-center">
                    

                    <span class="sent_to">رسالة سريعة إلى <p>{{$mainPost->post_user->user->name}}</p></span>

                    <form method="post" action="{{route('send_msg')}}">
                        @csrf

                        <input type="hidden" name="to" value="{{ $mainPost->post_user->user->id}}" >
                        <div class="form-group">
                            <textarea name="msg" required class="form-control" row='7'></textarea>
                        </div>
                        <div class="form-group">
                            <button class="form-control btn btn-primary" type="submit">@lang('site.sent')</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

    <!--============= End send msg modal ===============-->



    <!--============= start report modal ===============-->

    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="modal-title mb-3" id="exampleModalLongTitle">ابلاغ عن اعلان مخالف</h5>
                    <form action="{{route('post_infraction',$mainPost->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <select class="form-control" required name="infraction">
                                @foreach($infractions as $inf)
                                    <option value="{{$inf->id}}">{{$inf->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="notes" rows="5"></textarea>
                        </div>
                        <button type="submit" class="main-btn mt-3">@lang('site.Inform the supervisor')</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!--============= End report modal ===============-->
    <div class="modal fade" id="deletePostModal" tabindex="-1" role="dialog" aria-labelledby="deletePostModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="modal-title mb-3" id="exampleModalLongTitle">متأكد من حذف الأعلان</h5>
                    <form action="{{route('del_post_user',$mainPost->id)}}" method="get">



                        <button type="submit" class="main-btn mt-3">@lang('site.delete')</button>
                        <button type="button "  class="btn btn-danger" data-dismiss="modal" aria-label="Close" >@lang('site.close')</button>
                    </form>

                </div>
            </div>
        </div>
    </div>




    <!--============= بداية موديل ابلاغ رد غير لائق ===============-->

    <div class="modal fade customModal" id="reportTwoModal" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal_content">
                    <div class="confirm_wrapper">
                        <span class="question">تأكيد إبلاغ عن رد غير لائق ؟</span>
                        <div class="btn_wrapper">
                            <button class="btn-pramary-alt">تأكيد</button>
                            <button class="btn-danger-alt">الغاء</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--============= نهاية موديل ابلاغ رد غير لائق ===============-->

@endsection
@section('script')
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=605737e5ae08f9001144292a&product=sop' async='async'></script>
    <script src="{{url('/')}}/site/assets/js/toast.js"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            const copyButton = document.getElementById('copyButton');
            const linkInput = document.getElementById('linkInput');

            copyButton.addEventListener('click', function () {
                // Select the text inside the input element
                linkInput.select();
                linkInput.setSelectionRange(0, 99999); // For mobile devices

                // Copy the selected text
                document.execCommand('copy');

                // Show a message or perform any other action
                alert('Link copied to clipboard!');
            });
        });

        /*=========================== append reports ============================*/

        $(".reply_btn").on('click', function() {

            $(this).toggleClass('active');
            if ($(this).hasClass('active')) {
                $(this).parents(".comment_wrapper").append(`
                 <form class="reply_form_wrapper" action="{{route('comment_post',$mainPost->id)}}" method="post">
                @csrf
                <input type="hidden" name="parent_id" value="`+$(this).parents(".comment_wrapper").attr('id')+`"/>
                    <textarea name="comment"></textarea>
                    <button type="submit">@lang('site.sent')</button>
                </form>`)
            } else {
                $(this).parents(".comment_wrapper").find('.reply_form_wrapper').remove();
            }

        })
    </script>
    <script>
        $('.add-chooses .ddm_option.map').on('click', function(e) {
            e.stopPropagation();
            var post_id=$("#mainPostId").val();

            $.ajax({
                url:'{{ route('show_on_map') }}',
                type:'post',
                data: {
                    id : post_id,
                    _token: "{{ csrf_token() }}"
                },success:function(res){
                    window.location.reload();
                }

            });
        });
        $('.add-chooses .ddm_option.comment').on('click', function(e) {
            e.stopPropagation();
            var post_id=$("#mainPostId").val();
            $.ajax({
                url:'{{ route('change_comment_show') }}',
                type:'post',
                data: {
                    id : post_id,
                    _token: "{{ csrf_token() }}"
                },success:function(res){
                    window.location.reload();

                }

            });
        });
        $(".update_btn").on('click',function(){
            var post_id=$("#mainPostId").val();

            $.ajax({
                url:'{{ route('update_post_date') }}',
                type:'post',
                data: {
                    id : post_id,
                    _token: "{{ csrf_token() }}"
                },success:function(res){
                    console.log(res);
                    if(res == 0){
                        $.toast({
                            title: '@lang("site.updated successfully")',
                            type: 'success',
                            delay: 3000,
                            dismissible: true,
                        });
                    }else{
                        $.toast({
                            title: '@lang("site.updated error")',
                            type: 'error',
                            delay: 3000,
                            dismissible: true,
                        });
                    }
                }
            });
        });
    </script>
    <script>
        $('.comment_option_wrapper .more_btn').on('click', function() {
            $(this).toggleClass('active');
            var id=$(this).attr('id');
            if ($(this).hasClass('active')) {
                $(this).append(`<div class="ddm_wrapper">
                        <span class="ddm_option" data-toggle="modal" data-target="#reportOneModal`+id+`">إبلاغ: بخس السلعة</span>
                        <span class="ddm_option" data-toggle="modal" data-target="#reportTwoModal`+id+`">إبلاغ: رد غير لائق</span>
                    </div>`)
            } else {
                $(this).find('.ddm_wrapper').remove();
            }

        })
    </script>

    <script>

        /* =============================== copy link =============================== */




        (function() {
            var copyButton = document.getElementById('copy-btn');
            var modalFooter = document.querySelector('.modal-body p');
            copyButton.addEventListener('click', function(e) {
                e.preventDefault();
                var text = copyInput.select();
                console.log('text selected ==> ', text)
                document.execCommand('copy');
                modalFooter.innerHTML = "link is copied";
            });


        })();




        function initialize() {
            var e = new google.maps.LatLng({{ $post->lat }} , {{ $post->lng }}), t = {
                zoom: 5,
                center: e,
                panControl: !0,
                scrollwheel: 1,
                scaleControl: !0,
                overviewMapControl: !0,
                overviewMapControlOptions: {opened: !0},
                mapTypeId: google.maps.MapTypeId.terrain
            };
            map = new google.maps.Map(document.getElementById("mapid"), t), geocoder = new google.maps.Geocoder, marker = new google.maps.Marker({
                position: e,
                map: map
            }), map.streetViewControl = !1, infowindow = new google.maps.InfoWindow({content: "(24.701925,46.675415)"}), google.maps.event.addListener(map, "click", function (e) {
                marker.setPosition(e.latLng);
                var t = e.latLng, o = "(" + t.lat().toFixed(6) + ", " + t.lng().toFixed(6) + ")";
                infowindow.setContent(o),
                    document.getElementById("lat").value = t.lat().toFixed(6),
                    document.getElementById("lng").value = t.lng().toFixed(6)
            })
        }

    </script>
    {{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwqrlZASdsR2P-KqDBBaGQrVFb7Uom2Uk&language=ar&callback=initialize"></script>--}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAK34ZyoH4758BkVP05-GxKP0dSmBi4yTo&language=ar&callback=initialize"></script>

@endsection
