<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Coderthemes">
<?php $setting=\App\Models\setting::get();?>
        <link rel="shortcut icon" href="{{url('/')}}/public/storage/{{$setting->where('name','favicon')->first()->value}}">

        <title>@lang('site.siteName') admin</title>
        
        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="{{url('/')}}/public/admin/assets/plugins/morris/morris.css">
        <!-- <link href="{{url('/')}}/public/admin/assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css"> -->
        @yield('style')
        <style>
            .swal2-content .input-group {
                   display: none !important;
               }
        </style>
        <link href="{{url('/')}}/public/admin/assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('/')}}/public/admin/assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="{{url('/')}}/public/admin/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="{{url('/')}}/public/admin/assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="{{url('/')}}/public/admin/assets/css/responsive.css" rel="stylesheet" type="text/css" />
      @yield('after_style')
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="{{url('/')}}/public/admin/assets/js/modernizr.min.js"></script>
        
        
        @if(app()->getLocale() == 'en')
            <link href="{{url('/')}}/public/admin/assets/css/coreEn.css" rel="stylesheet" type="text/css" />

        @else
            <link href="{{url('/')}}/public/admin/assets/css/core.css" rel="stylesheet" type="text/css" />

        @endif
        
        <style>
            @media (max-width: 767px) {
        .navbar-nav .open .dropdown-menu {
            background-color: #ffffff;
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
            /* left: auto; */
            position: absolute;
            right: auto;
            left: 0;
        }
        </style>
    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">
        
            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="{{url('/admin/index')}}" class="logo"><i class="icon-magnet icon-c-logo"></i><span>Marood</span></a>
                        <!-- Image Logo here -->
                        <!--<a href="index.html" class="logo">-->
                            <!--<i class="icon-c-logo"> <img src="{{url('/')}}/public/admin/assets/images/logo_sm.png" height="42"/> </i>-->
                            <!--<span><img src="{{url('/')}}/public/admin/assets/images/logo_light.png" height="20"/></span>-->
                        <!--</a>-->
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

                          {{--  <ul class="nav navbar-nav hidden-xs">
                                <li><a href="#" class="waves-effect waves-light">Files</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown"
                                       role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span
                                            class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </li>
                            </ul>

                            <form role="search" class="navbar-left app-search pull-left hidden-xs">
			                     <input type="text" placeholder="Search..." class="form-control">
			                     <a href=""><i class="fa fa-search"></i></a>
			                </form>--}}


                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="dropdown top-menu-item-xs">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                        <i class="icon-bell"></i>
                                        <?php $nots=Auth::user()->unreadnotifications->whereIn('type',["App\Notifications\commentNotification","App\Notifications\addPostNotfication","App\Notifications\contactNotfication","App\Notifications\InfractionNotfication","App\Notifications\newUserNotifications"]);?>
                                         @if(count($nots)>0)
                                        <span class="badge badge-xs badge-danger">{{count($nots)}}</span>
                                        @endif
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="notifi-title"><span class="label label-default pull-right"></span>Notification</li>
                                        <li class="list-group slimscroll-noti notification-list">
                                           <!-- list item-->
                                           
                                         @foreach($nots as $not)
                                         @if($not->type=="App\Notifications\commentNotification"||$not->type=="App\Notifications\addPostNotfication")
                                            <?php $post=\App\Models\Post::find($not->data['post_id']);?>
                                           @if($post)
                                           <a href="{{url('/')}}/admin/posts/show/{{$not->id}}/#{{$post->id}}" class="list-group-item">
                                               @else
                                               <a href="javascript:void(0);" class="list-group-item"> 
                                               @endif
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                     @if($not->type=="App\Notifications\commentNotification")
                                                    <em class=" ti-comment-alt noti-custom"></em>
                                                    @else
                                                       <em class="ti-wand noti-warning"></em>
                                                    @endif
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">
                                                        @if($not->type=="App\Notifications\addPostNotfication" && $post)
                                                        لقد قام {{$post->post_user->User->name}} بإضافة إعلان جديد
                                                        @else
                                                        يوجد تعليق جديد 
                                                        @endif
                                                        </h5>
                                                    <p class="m-0">
                                                        <small>{{$post?$post->title:$not->data['post_title']??'تم حذف الاعلان'}}</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>
                                           @elseif($not->type=="App\Notifications\contactNotfication")
                                               
                                                   <a href="{{url('/')}}/admin/contact/show/{{$not->id}}/#{{$not->data['contact_id']}}" class="list-group-item">
                                             
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                  
                                                    <em class=" fa  fa-headphones noti-primary"></em>
                                              
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">{{$not->data['title']}}</h5>
                                                    <p class="m-0">
                                                        <small>{{$not->data['msg']}}</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>
                                           @elseif($not->type=="App\Notifications\InfractionNotfication")
                                                  
                                                   <a href="{{url('/')}}/admin/infraction/show/{{$not->id}}/#{{$not->data['infraction_id']}}" class="list-group-item">
                                             
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                  
                                                    <em class=" fa   fa-frown-o noti-danger"></em>
                                              
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">{{$not->data['title']}}</h5>
                                                    <p class="m-0">
                                                        <small>{{$not->data['user']}}</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>
                                        @else
                                                  @if($not->type =="App\Notifications\newUserNotifications" )
                                                   <a href="{{url('/')}}/admin/users/show/{{$not->id}}/#{{$not->data['user_id']}}" class="list-group-item">
                                             
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                  
                                                    <em class=" fa    fa-smile-o noti-custom"></em>
                                              
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">{{$not->data['title']}}</h5>
                                                    <p class="m-0">
                                                        <small>{{$not->data['username']}}</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>
                                             @endif
                                         @endif
                                           @endforeach
                                        </li>
                                        <li>
                                            <a href="{{url('/')}}/admin/all/notifications" class="list-group-item text-right">
                                                <small class="font-600">@lang('site.all')</small>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                                </li>
                                
                                   {{-- start language--}}
                                <li class="dropdown top-menu-item-xs">
                                    <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="{{url('/')}}/public/admin/assets/images/users/lang.png" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">


                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                <li class="dropdown-item">
                                                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                        {{ $properties['native'] }}
                                                    </a>
                                                </li>
                                        @endforeach

                                    </ul>
                                </li>

                                {{-- end language--}}
                                
                               {{-- <li class="hidden-xs">
                                    <a href="#" class="right-bar-toggle waves-effect waves-light"><i class="icon-settings"></i></a>
                                </li>--}}
                                <li class="dropdown top-menu-item-xs">
                                    <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="{{url('/')}}/public/admin/assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{url('/')}}"><i class="ti-user m-r-10 text-custom"></i> {{__('auth.website')}}</a></li>
                                       
                                        <li><a href="{{route('logoutView')}}"><i class="ti-power-off m-r-10 text-danger"></i> {{__('auth.logout')}}</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->
            