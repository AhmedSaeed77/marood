<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<?php $setting=\App\Models\setting::get(); ?>
<head>
    <meta charset="UTF-8">
     
       <meta name="google-site-verification" content="ac5Z0juyp8q4fkz6953_YkU7vQ80SN4OlmHsPdi3tXs" />

    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!--<link rel="icon" href="{{url('/')}}/public/storage/{{$setting->where('name','favicon')->first()->value}}" sizes="16x16" type="image/png"> -->
 <meta name="description" content="{{$setting->where('name','metaDesc')->first()->value}}">
  <!--<meta name="description" content="{{$setting->where('name','siteDesc')->first()->value}}">-->
  <!--fb & Whatsapp-->
  <meta property="og:site_name" content="{{$setting->where('name','SiteName')->first()->value}}">
<!--<meta property="og:description" content="{{$setting->where('name','siteDesc')->first()->value}}">-->
<meta property="og:type" content="website" />
    @yield('title')
    <!--<title>{{$setting->where('name','SiteName')->first()->value}}</title>-->
    


    <!-- vendor styles -->
    <link rel="stylesheet" href="{{url('/')}}/public/site/assets/vendor/FontAwesome/all.css">
    <link rel="stylesheet" href="{{url('/')}}/public/site/assets/vendor/bootstrap/css/bootstrap.css">
     <link rel="stylesheet" href="{{url('/')}}/public/site/assets/vendor/owl.carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/site/assets/vendor/owl.carousel/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/site/assets/vendor/venobox.css">


    <!--<link href="https://fonts.cdnfonts.com/css/falling-sky" rel="stylesheet">-->
                

    <!-- main style -->
    <link rel="stylesheet" href="{{url('/')}}/public/site/assets/css/style.css">

  @yield('style')
  <meta property="og:image" content="{{url('/')}}/public/storage/{{$setting->where('name','favicon')->first()->value}}">
<link rel="apple-touch-icon" sizes="57x57" href="{{url('/')}}/public/storage/{{$setting->where('name','favicon')->first()->value}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{url('/')}}/public/storage/{{$setting->where('name','favicon')->first()->value}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{url('/')}}/public/storage/{{$setting->where('name','favicon')->first()->value}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('/')}}/public/storage/{{$setting->where('name','favicon')->first()->value}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{url('/')}}/public/storage/{{$setting->where('name','favicon')->first()->value}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{url('/')}}/public/storage/{{$setting->where('name','favicon')->first()->value}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{url('/')}}/public/storage/{{$setting->where('name','favicon')->first()->value}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{url('/')}}/public/storage/{{$setting->where('name','favicon')->first()->value}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{url('/')}}/public/storage/{{$setting->where('name','favicon')->first()->value}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{url('/')}}/public/storage/{{$setting->where('name','favicon')->first()->value}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('/')}}/public/storage/{{$setting->where('name','favicon')->first()->value}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{url('/')}}/public/storage/{{$setting->where('name','favicon')->first()->value}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('/')}}/public/storage/{{$setting->where('name','favicon')->first()->value}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{url('/')}}/public/storage/{{$setting->where('name','favicon')->first()->value}}">
    <meta name="theme-color" content="#ffffff">
<!--    <meta name="google-site-verification" content="03YcNFDeAGcthXeQw-y2GA1e0MrA5QCQlNGTXVvUUQU" />-->
    <!--======================== remove comment to make the site (ltr) ======================-->
     @if(App::getLocale()=='en')
      <!-- <link rel="stylesheet" href="{{url('/')}}/public/site/assets/css/style-ltr.css"> -->
    @endif 
    
    <style>
    
        /*@import url('https://fonts.cdnfonts.com/css/falling-sky');*/
        body{
            font-family: 'Falling Sky', sans-serif;

        }
        .header-login .mainNavbar {
           background-color: #eeeeee;
           padding: 17px 0;
    }

    .nav-bottom {
     background-color: #eeeeee;
    position: sticky;
    top: 0;
    z-index: 99999;
     }


     .home-content .tagMain .react-autosuggest__container .form-input-group .btn {

         background-color: #22767b;

     }
     
     .home-content .tagMain .add-btn {
           background-color: #22767b;

    }

     
   .header-login .headContent .headLogo a img {
        height: 70px;
       max-width: 100%;
        border-radius: 25px;
    }
        
    .home-content .tagSide .tagSelect button {
    background-color: #22767b !important;

    }
        
    .home-content .tagMain .add-btn {
    
       background: #22767b !important;
      }
      
     .home-content .tagMain .settings button {
    
    background: #22767b;
   }
   
   
    
   .header-login .userMenu a {
    color: #432A0A;
 
    }
    
    .nav-bottom .setting-site .login-btn {
   color: #432A0A;
   
    }
    
    .header-login .user-actions .toggle-user-action-handle {
       color: #432A0A;

   }


    </style>

 @if(app()->getLocale() == 'en')
        <style>
            .dropdown li {
                text-align: left;
            }
        </style>
    @endif
</head>
<?php $logo='public/storage/'.$setting->where('name','logo')->first()->value;?>
<body>
    <input type="hidden" value="{{$setting->where('name','MainColor')->first()->value}}" name="color1" id="mainColor">
        <input type="hidden" value="{{$setting->where('name','SecondColor')->first()->value}}" name="color2" id="secColor">
    <script>
        let root = document.querySelector(':root');
        let mainColor = document.getElementById('mainColor').value;
        let secColor = document.getElementById('secColor').value;
        root.style.setProperty('--mainColor', mainColor);
        root.style.setProperty('--secColor', secColor);
    </script>
    
    
    <!--========================== Start Navbar ==========================-->
    <?php $nav_menue=\App\Models\menues::find(1);?>
    @if($nav_menue->show==1)
    <nav class="nav-menu">
        <div class="container">
            <ul class="list-nav">
                <li><a href="{{url('/')}}">@lang('site.main')</a></li>
                @foreach($nav_menue->items as $item)
                <li >
                    
                    
                <a href="{{ route('cat-tag', ['id' => $item->cat->id, 'meta_title' => $item->cat->meta_title]) }}"class="mainFilter mainF{{$item->cat->id}} {{isset($mainCat)?$mainCat->id==$item->cat->id?'active':'':''}}" data-id="{{$item->cat->id}}">

                    <!--<a href="{{url('/')}}/tag/{{$item->cat->id}}"class="mainFilter mainF{{$item->cat->id}} {{isset($mainCat)?$mainCat->id==$item->cat->id?'active':'':''}}" data-id="{{$item->cat->id}}">-->
                        <!-- <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="car" class="svg-inline--fa fa-car fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M120.81 248c-25.96 0-44.8 16.8-44.8 39.95 0 23.15 18.84 39.95 44.8 39.95l10.14.1c39.21 0 45.06-20.1 45.06-32.08-.01-24.68-31.1-47.92-55.2-47.92zm10.14 56c-3.51 0-7.02-.1-10.14-.1-12.48 0-20.8-6.38-20.8-15.95s8.32-15.95 20.8-15.95 31.2 14.36 31.2 23.93c0 7.17-10.54 8.07-21.06 8.07zm260.24-56c-24.1 0-55.19 23.24-55.19 47.93 0 11.98 5.85 32.08 45.06 32.08l10.14-.1c25.96 0 44.8-16.8 44.8-39.95-.01-23.16-18.85-39.96-44.81-39.96zm0 55.9c-3.12 0-6.63.1-10.14.1-10.53 0-21.06-.9-21.06-8.07 0-9.57 18.72-23.93 31.2-23.93s20.8 6.38 20.8 15.95-8.32 15.95-20.8 15.95zm114.8-140.94c-7.34-11.88-20.06-18.97-34.03-18.97H422.3l-8.07-24.76C403.5 86.29 372.8 64 338.17 64H173.83c-34.64 0-65.33 22.29-76.06 55.22l-8.07 24.76H40.04c-13.97 0-26.69 7.09-34.03 18.97s-8 26.42-1.75 38.91l5.78 11.61c3.96 7.88 9.92 14.09 17 18.55-6.91 11.74-11.03 25.32-11.03 39.97V400c0 26.47 21.53 48 48 48h16c26.47 0 48-21.53 48-48v-16H384v16c0 26.47 21.53 48 48 48h16c26.47 0 48-21.53 48-48V271.99c0-14.66-4.12-28.23-11.03-39.98 7.09-4.46 13.04-10.68 17-18.57l5.78-11.56c6.24-12.5 5.58-27.05-1.76-38.92zM128.2 129.14C134.66 109.32 153 96 173.84 96h164.33c20.84 0 39.18 13.32 45.64 33.13l20.47 62.85H107.73l20.47-62.84zm-89.53 70.02l-5.78-11.59c-1.81-3.59-.34-6.64.34-7.78.87-1.42 2.94-3.8 6.81-3.8h39.24l-6.45 19.82a80.69 80.69 0 0 0-23.01 11.29c-4.71-1-8.94-3.52-11.15-7.94zM96.01 400c0 8.83-7.19 16-16 16h-16c-8.81 0-16-7.17-16-16v-16h48v16zm367.98 0c0 8.83-7.19 16-16 16h-16c-8.81 0-16-7.17-16-16v-16h48v16zm0-80.01v32H48.01v-80c0-26.47 21.53-48 48-48h319.98c26.47 0 48 21.53 48 48v48zm15.12-132.41l-5.78 11.55c-2.21 4.44-6.44 6.97-11.15 7.97-6.94-4.9-14.69-8.76-23.01-11.29l-6.45-19.82h39.24c3.87 0 5.94 2.38 6.81 3.8.69 1.14 2.16 4.18.34 7.79z"></path>
                    </svg>-->
                    @if($nav_menue->is==4)
                    @if($item->cat->icon !=null)
                    <i class=" {{$item->cat->icon}}"aria-hidden="true" focusable="false"></i>
                    @endif
                    @endif
                    @if($nav_menue->is!=2)
                    {{$item->name}}
                    @endif
                </a>
                </li>
               @endforeach
                <li>
                    <div data-toggle="modal" data-target="#Modal-Search">
                        <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="search" class="svg-nav svg-inline--fa fa-search fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M508.5 481.6l-129-129c-2.3-2.3-5.3-3.5-8.5-3.5h-10.3C395 312 416 262.5 416 208 416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c54.5 0 104-21 141.1-55.2V371c0 3.2 1.3 6.2 3.5 8.5l129 129c4.7 4.7 12.3 4.7 17 0l9.9-9.9c4.7-4.7 4.7-12.3 0-17zM208 384c-97.3 0-176-78.7-176-176S110.7 32 208 32s176 78.7 176 176-78.7 176-176 176z"></path>
                    </svg>@lang('site.search')
                    </div>
                </li>
                     @if(\App\Models\menues::find(5)->show==1)
                <li>
               
                    <a href="{{route('more_cats')}}">
                        <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="sitemap" class="svg-nav svg-inline--fa fa-sitemap fa-w-20 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M608 352h-32v-97.59c0-16.77-13.62-30.41-30.41-30.41H336v-64h48c17.67 0 32-14.33 32-32V32c0-17.67-14.33-32-32-32H256c-17.67 0-32 14.33-32 32v96c0 17.67 14.33 32 32 32h48v64H94.41C77.62 224 64 237.64 64 254.41V352H32c-17.67 0-32 14.33-32 32v96c0 17.67 14.33 32 32 32h96c17.67 0 32-14.33 32-32v-96c0-17.67-14.33-32-32-32H96v-96h208v96h-32c-17.67 0-32 14.33-32 32v96c0 17.67 14.33 32 32 32h96c17.67 0 32-14.33 32-32v-96c0-17.67-14.33-32-32-32h-32v-96h208v96h-32c-17.67 0-32 14.33-32 32v96c0 17.67 14.33 32 32 32h96c17.67 0 32-14.33 32-32v-96c0-17.67-14.33-32-32-32zm-480 32v96H32v-96h96zm240 0v96h-96v-96h96zM256 128V32h128v96H256zm352 352h-96v-96h96v96z"></path>
                    </svg>@lang('site.more cats')
                    </a>
                </li>
                @endif

            </ul>
        </div>
    </nav>
    @endif
    <!--========================== End Navbar ==========================-->
    
    
@if(!auth::check())
    <!--========================== Start Nav Bottom ==========================-->
    <section class="nav-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-2 col-4">
                      @if($setting->where('name','logo_name_show')->first()->value==1)
                        <a class="logo" href="{{url('/')}}"><img src="{{url('/')}}/{{$logo}}" alt="@lang('site.siteName')"></a>
                        @else
                        <a href="{{url('/')}}" class="logo_text">{{$setting->where('name','SiteName')->first()->value}}</a>
                        @endif 
                </div>
                <div class="col-sm-10 col-8 setting-site">
                    <div>
                        
                        <a href="{{route('login')}}" class="login-btn">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sign-in-alt" class="svg-inline--fa fa-sign-in-alt fa-w-16 fa-flip-horizontal " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M416 448h-84c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h84c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32h-84c-6.6 0-12-5.4-12-12V76c0-6.6 5.4-12 12-12h84c53 0 96 43 96 96v192c0 53-43 96-96 96zm-47-201L201 79c-15-15-41-4.5-41 17v96H24c-13.3 0-24 10.7-24 24v96c0 13.3 10.7 24 24 24h136v96c0 21.5 26 32 41 17l168-168c9.3-9.4 9.3-24.6 0-34z"></path>
                                </svg> @lang('site.login')
                        </a>
                        
                        <div class="langSwitch">
                            <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}">  <button class=" {{App::getLocale()=='ar'?'active':''}}"> عربي</button></a>
                            <a href="{{ LaravelLocalization::getLocalizedURL('en') }}"> <button class=" {{App::getLocale()=='en'?'active':''}}"> Eng</button></a>
                        </div>
                        <span class="sideToggleIcon d-inline-flex d-md-none"><i class="fas fa-th"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@else
  <!-- ===================== start header after login ======================== -->
  <div class="header-login">
        <nav class="mainNavbar">
            <div class="container">
                <div class=" headContent">
                    <div class="headLogo">
                        <!--<a class="logo" href="{{url('/')}}"><img alt="@lang('site.siteName')" src="{{url('/')}}/{{$logo}}"></a>-->
                          @if($setting->where('name','logo_name_show')->first()->value==1)
                            <a class="logo" href="{{url('/')}}"><img style="border-radius: 0" src="{{url('/')}}/{{$logo}}" alt="@lang('site.siteName')"></a>
                            @else
                            <a href="{{url('/')}}" class="logo_text">{{$setting->where('name','SiteName')->first()->value}}</a>
                            @endif 
                    </div>
                    <ul class="userMenu ul-plain">
                        <li class="hideSmall">
                            <a
                                <span class="sideToggleIcon d-inline-block d-md-none"><i class="fas fa-th" style="margin-top: 4px;"></i></span>
                            </a>
                        </li>
                        <li class="hideSmall">
                        <a href="{{url('/')}}/user/chat">
                          
                               @if(count(auth::user()->recieveMsg->where('read',0))>0)
                                <span class="badge badge-danger">{{count(auth::user()->recieveMsg->where('read',0))}}</span>
                                @endif
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope" class="svg-inline--fa fa-envelope fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path>
                                </svg>
                                <span class="item-text"> @lang('site.messages')</span>
                            </a>
                        </li>
                        <li class="hideSmall">
                            <a href="{{route('notification')}}">
                           @if(count(Auth::user()->unreadnotifications->whereIn('type',["App\Notifications\commentNotification"]))>0)
                            <span class="badge badge-danger">{{count(Auth::user()->unreadnotifications->whereIn('type',["App\Notifications\commentNotification"]))}}</span>
                            @endif
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" class="svg-inline--fa fa-bell fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z"></path></svg>           
                             <span class="item-text"> @lang('site.notifications')</span>
                            </a>
                        </li>
                        <li class="hideSmall">
                            <a href="{{route('fav_posts')}}">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path>
                                </svg>
                                <span class="item-text">@lang('site.favourites')</span>
                            </a>
                        </li>
                        <li class="hideSmall">
                            <a href="{{route('follow_up')}}">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="rss" class="svg-inline--fa fa-rss fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M128.081 415.959c0 35.369-28.672 64.041-64.041 64.041S0 451.328 0 415.959s28.672-64.041 64.041-64.041 64.04 28.673 64.04 64.041zm175.66 47.25c-8.354-154.6-132.185-278.587-286.95-286.95C7.656 175.765 0 183.105 0 192.253v48.069c0 8.415 6.49 15.472 14.887 16.018 111.832 7.284 201.473 96.702 208.772 208.772.547 8.397 7.604 14.887 16.018 14.887h48.069c9.149.001 16.489-7.655 15.995-16.79zm144.249.288C439.596 229.677 251.465 40.445 16.503 32.01 7.473 31.686 0 38.981 0 48.016v48.068c0 8.625 6.835 15.645 15.453 15.999 191.179 7.839 344.627 161.316 352.465 352.465.353 8.618 7.373 15.453 15.999 15.453h48.068c9.034-.001 16.329-7.474 16.005-16.504z"></path>
                                </svg>
                                <span class="item-text">@lang('site.follow_up')</span>
                            </a>
                        </li>
                        <li class="user-actions">
                            <a href="{{url('/')}}/user/{{auth::user()->id}}/profile">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" class="svg-inline--fa fa-user fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path>
                                </svg> {{auth::user()->name}}
                            </a>
                            <span>
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-down" class="svg-inline--fa fa-caret-down fa-w-10 toggle-user-action-handle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                                </svg>
                            </span>
                            <ul class="dropdown d-none">
                                <li>
                                    <a data-toggle="modal" data-target="#ModalSettings">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="cog" class="svg-inline--fa fa-cog fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M482.696 299.276l-32.61-18.827a195.168 195.168 0 0 0 0-48.899l32.61-18.827c9.576-5.528 14.195-16.902 11.046-27.501-11.214-37.749-31.175-71.728-57.535-99.595-7.634-8.07-19.817-9.836-29.437-4.282l-32.562 18.798a194.125 194.125 0 0 0-42.339-24.48V38.049c0-11.13-7.652-20.804-18.484-23.367-37.644-8.909-77.118-8.91-114.77 0-10.831 2.563-18.484 12.236-18.484 23.367v37.614a194.101 194.101 0 0 0-42.339 24.48L105.23 81.345c-9.621-5.554-21.804-3.788-29.437 4.282-26.36 27.867-46.321 61.847-57.535 99.595-3.149 10.599 1.47 21.972 11.046 27.501l32.61 18.827a195.168 195.168 0 0 0 0 48.899l-32.61 18.827c-9.576 5.528-14.195 16.902-11.046 27.501 11.214 37.748 31.175 71.728 57.535 99.595 7.634 8.07 19.817 9.836 29.437 4.283l32.562-18.798a194.08 194.08 0 0 0 42.339 24.479v37.614c0 11.13 7.652 20.804 18.484 23.367 37.645 8.909 77.118 8.91 114.77 0 10.831-2.563 18.484-12.236 18.484-23.367v-37.614a194.138 194.138 0 0 0 42.339-24.479l32.562 18.798c9.62 5.554 21.803 3.788 29.437-4.283 26.36-27.867 46.321-61.847 57.535-99.595 3.149-10.599-1.47-21.972-11.046-27.501zm-65.479 100.461l-46.309-26.74c-26.988 23.071-36.559 28.876-71.039 41.059v53.479a217.145 217.145 0 0 1-87.738 0v-53.479c-33.621-11.879-43.355-17.395-71.039-41.059l-46.309 26.74c-19.71-22.09-34.689-47.989-43.929-75.958l46.329-26.74c-6.535-35.417-6.538-46.644 0-82.079l-46.329-26.74c9.24-27.969 24.22-53.869 43.929-75.969l46.309 26.76c27.377-23.434 37.063-29.065 71.039-41.069V44.464a216.79 216.79 0 0 1 87.738 0v53.479c33.978 12.005 43.665 17.637 71.039 41.069l46.309-26.76c19.709 22.099 34.689 47.999 43.929 75.969l-46.329 26.74c6.536 35.426 6.538 46.644 0 82.079l46.329 26.74c-9.24 27.968-24.219 53.868-43.929 75.957zM256 160c-52.935 0-96 43.065-96 96s43.065 96 96 96 96-43.065 96-96-43.065-96-96-96zm0 160c-35.29 0-64-28.71-64-64s28.71-64 64-64 64 28.71 64 64-28.71 64-64 64z"></path>
                                        </svg> @lang('site.setting')
                                    </a>
                                </li>
                               @if(Auth::user()->hasRole(['admin', 'superAdmin']))
                                <li>
                                    <a href="{{route('dashboard')}}">
                                        <i class="fal fa-home"></i> @lang('site.dashboard')
                                    </a>
                                </li>
                                @endif
                                <li>
                                    <a href="{{route('logoutView')}}">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="sign-out" class="svg-inline--fa fa-sign-out fa-w-16 fa-flip-horizontal " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M48 64h132c6.6 0 12 5.4 12 12v8c0 6.6-5.4 12-12 12H48c-8.8 0-16 7.2-16 16v288c0 8.8 7.2 16 16 16h132c6.6 0 12 5.4 12 12v8c0 6.6-5.4 12-12 12H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48zm279 19.5l-7.1 7.1c-4.7 4.7-4.7 12.3 0 17l132 131.4H172c-6.6 0-12 5.4-12 12v10c0 6.6 5.4 12 12 12h279.9L320 404.4c-4.7 4.7-4.7 12.3 0 17l7.1 7.1c4.7 4.7 12.3 4.7 17 0l164.5-164c4.7-4.7 4.7-12.3 0-17L344 83.5c-4.7-4.7-12.3-4.7-17 0z"></path>
                                        </svg> @lang('site.logout')
                                    </a>
                                </li>
                                <li class="dropdown-footer">
                                    <span>@lang('site.language') :</span>
                                    <div class="langSwitch">
                                       <button onclick="window.location.href='{{ LaravelLocalization::getLocalizedURL('ar')}}'" class=" {{App::getLocale()=='ar'?'active':''}} lang" id="ar" >عربي</button>
                                        <button class="  {{App::getLocale()=='en'?'active':''}} lang" onclick="window.location.href='{{ LaravelLocalization::getLocalizedURL('en')}}'" id="en">Eng</button>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="mobileUserMenu hideLarge ">
            <a href="{{url('/')}}/user/chat">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope" class="svg-inline--fa fa-envelope fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="currentColor" d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"> 
                    </path>
                </svg>
            </a>
            <a href="{{route('notification')}}">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" class="svg-inline--fa fa-bell fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor" d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z">
                    </path>
                </svg>
            </a>
            <a href="{{route('fav_posts')}}">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="currentColor" d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z">
                    </path>
                </svg>
            </a>
            <a href="{{route('follow_up')}}">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="rss" class="svg-inline--fa fa-rss fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor" d="M128.081 415.959c0 35.369-28.672 64.041-64.041 64.041S0 451.328 0 415.959s28.672-64.041 64.041-64.041 64.04 28.673 64.04 64.041zm175.66 47.25c-8.354-154.6-132.185-278.587-286.95-286.95C7.656 175.765 0 183.105 0 192.253v48.069c0 8.415 6.49 15.472 14.887 16.018 111.832 7.284 201.473 96.702 208.772 208.772.547 8.397 7.604 14.887 16.018 14.887h48.069c9.149.001 16.489-7.655 15.995-16.79zm144.249.288C439.596 229.677 251.465 40.445 16.503 32.01 7.473 31.686 0 38.981 0 48.016v48.068c0 8.625 6.835 15.645 15.453 15.999 191.179 7.839 344.627 161.316 352.465 352.465.353 8.618 7.373 15.453 15.999 15.453h48.068c9.034-.001 16.329-7.474 16.005-16.504z">   
                    </path>
                </svg>
            </a>
            <a>
                <span class="sideToggleIcon d-inline-block d-md-none"><i class="fas fa-th" style="margin-top: 2px;"></i></span>
            </a>
         
        </div>
    </div>

    <!-- ===================== End header after login ======================== -->
@endif

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
    
    <!--===================== start Modal Search ======================-->

    <div class="modal fade" id="Modal-Search" tabindex="-1" role="dialog" aria-labelledby="ModalSearchTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modalFront" style="display: block;">
                    <div class="metaBody">
                        <span class="close" data-dismiss="modal" aria-label="Close">
                            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times-circle" class="svg-inline--fa fa-times-circle fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 464c-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216 0 118.7-96.1 216-216 216zm94.8-285.3L281.5 256l69.3 69.3c4.7 4.7 4.7 12.3 0 17l-8.5 8.5c-4.7 4.7-12.3 4.7-17 0L256 281.5l-69.3 69.3c-4.7 4.7-12.3 4.7-17 0l-8.5-8.5c-4.7-4.7-4.7-12.3 0-17l69.3-69.3-69.3-69.3c-4.7-4.7-4.7-12.3 0-17l8.5-8.5c4.7-4.7 12.3-4.7 17 0l69.3 69.3 69.3-69.3c4.7-4.7 12.3-4.7 17 0l8.5 8.5c4.6 4.7 4.6 12.3 0 17z"></path>
                            </svg>
                        </span>
                    </div>
                    <div id="searchBoxContent">
                          <form action="{{route('search')}}" method="get">
                                   
                            <div role="combobox" aria-haspopup="listbox" aria-owns="react-autowhatever-1" aria-expanded="false" class="react-autosuggest__container">
                                <div class="inputContainer form-input-group form-input-group__search"><input type="search" autocomplete="off" aria-autocomplete="list" aria-controls="react-autowhatever-1" class="form-control" name="search" placeholder="@lang('site.search for post....')" value=""><button class="btn btn-primary-alt"
                                        type="submit"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="search" class="svg-inline--fa fa-search fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M508.5 481.6l-129-129c-2.3-2.3-5.3-3.5-8.5-3.5h-10.3C395 312 416 262.5 416 208 416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c54.5 0 104-21 141.1-55.2V371c0 3.2 1.3 6.2 3.5 8.5l129 129c4.7 4.7 12.3 4.7 17 0l9.9-9.9c4.7-4.7 4.7-12.3 0-17zM208 384c-97.3 0-176-78.7-176-176S110.7 32 208 32s176 78.7 176 176-78.7 176-176 176z"></path></svg></button></div>
                            </div>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <!--===================== End Modal Search ======================-->
    <!--========================== End Nav Bottom ==========================-->
    @if(Route::currentRouteName() != 'index' && Route::currentRouteName() != 'login' && Route::currentRouteName() != 'register' && Route::currentRouteName() != 'password.request' && Route::currentRouteName() != 'password.email')
    <div id="addPost-btn" class="add_btn_other">
        <a class="add-btn btn-success" href="{{route('choose_cat_add_post')}}">@lang('site.Add Your Post')
            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="plus" class="svg-inline--fa fa-plus fa-w-12 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z"></path></svg>
        </a>
    </div>
    @endif
    

