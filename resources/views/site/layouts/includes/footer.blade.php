

    <!--========================== Start footer ==========================-->
    <footer class="footer">
        <div class="container">
            <div class="download-apps text-center row">
            <?php $setting=\App\Models\setting::get();?>
            <div class="col-12">
                <a href="{{$setting->where('name','iosApp')->first()->value}}">
                <img src="{{url('/')}}/public/site/assets/img/01.png" alt="img">
                </a>
                <a href="{{$setting->where('name','androidApp')->first()->value}}">
                <img src="{{url('/')}}/public/site/assets/img/02.png" alt="img">
                </a>
            </div>
            <div class="col-12">
                <p>{{__('site.will be publish soon')}}</p>
            </div>
            </div>
            <hr>
            
            <ul class="ul-no-bullets footer-links">
            @foreach(\App\Models\footerPages::where('active',1)->get() as $page)
            <li>
                <a href="{{url('/')}}/footer/{{$page->id}}/page/{{$page->link}}">
                    <i class="{{$page->icon}} svg-inline--fa fa-fw "></i>{{$page->name}}                           
                </a>
            </li>
            
            @endforeach
            
                <li><a href="{{route('contact')}}"><i class="svg-inline--fa fas fa-file-signature fa-w-20 fa-fw "></i>@lang('site.Contact us form')</a></li>
                <li><a href="{{url('/')}}/commission"><i class="svg-inline--fa fas fa-money-bill-alt fa-w-20 fa-fw "></i>@lang('site.Calculation and payment of the site commission')</a></li>
                {{-- <li ><a href="{{url('/')}}/check/blacklist"><i class="svg-inline--fa fa fa-ban fa-w-20 fa-fw"></i>@lang('site.Blacklist and Tender Deal')</a></li> --}}
                @auth
                <li ><a href="{{url('/')}}/member/{{ auth()->user()->id }}"><i class="svg-inline--fa fa fa-id-card fa-w-20 fa-fw"></i>@lang('site.membership')</a></li>
                <!--<li ><a href="{{url('/')}}/verify/store/user/{{ auth()->user()->id }}"><i class="svg-inline--fa fa fa-book fa-w-20 fa-fw"></i>@lang('site.Membership authentication')</a></li>-->
                @endauth
            </ul>
            <hr>
            <div class="sochial_media">
                <div class="row">
                    <div class="col-12">
                    @php
                    $tiktok = \App\Models\setting::where('name','tiktok')->first();
                    $snapchat = \App\Models\setting::where('name','snap')->first();
                    $fb = \App\Models\setting::where('name','fb')->first();
                    $youtube = \App\Models\setting::where('name','youtube')->first();
                    $tw = \App\Models\setting::where('name','tw')->first();
                    $inst = \App\Models\setting::where('name','inst')->first();
                    @endphp
                    <a href="{{ $snapchat->value ?? '#' }}"><img src="{{url('/')}}/public/site/assets/img/snapchat.svg"  title="snapchat"></a>
                    <a href="{{ $tiktok->value ?? '#' }}"><img src="{{url('/')}}/public/site/assets/img/tiktok.svg" title="tiktok"></a>
                    <a href="{{ $fb->value ?? '#' }}"><img src="{{url('/')}}/public/site/assets/img/facebook.svg" title="facebook"></a>
                    <a href="{{ $inst->value ?? '#' }}"><img src="{{url('/')}}/public/site/assets/img/instagram-7.svg" title="instagram"></a>
                    <a href="{{ $youtube->value ?? '#' }}"><img src="{{url('/')}}/public/site/assets/img/youtube.svg" title="youtube"></a>
                    <a href="{{ $tw->value ?? '#' }}"><img src="{{url('/')}}/public/site/assets/img/x_twitter.png" title="twitter"></a>
                    </div>
                    <!--<span class="col-12 "> @lang('site.under work')</span>-->
                </div>
            </div>
            <hr>
            @if(Auth::check())
              <div style="justify-content: space-around; display: flex; margin-bottom: 1rem;">
                <div class="control-size text-center">
                    <button id="btn-decrease" class="btn btn-default" type="button">-A</button>
                    <button id="btn-increase" class="btn btn-default" type="button">+A</button>
                </div>
                <a href="{{route('logoutView')}}" class="d-flex align-items-center">
                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="sign-out" class="mx-2 svg-inline--fa fa-sign-out fa-w-16 fa-flip-horizontal fa-2x icon-vam" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M48 64h132c6.6 0 12 5.4 12 12v8c0 6.6-5.4 12-12 12H48c-8.8 0-16 7.2-16 16v288c0 8.8 7.2 16 16 16h132c6.6 0 12 5.4 12 12v8c0 6.6-5.4 12-12 12H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48zm279 19.5l-7.1 7.1c-4.7 4.7-4.7 12.3 0 17l132 131.4H172c-6.6 0-12 5.4-12 12v10c0 6.6 5.4 12 12 12h279.9L320 404.4c-4.7 4.7-4.7 12.3 0 17l7.1 7.1c4.7 4.7 12.3 4.7 17 0l164.5-164c4.7-4.7 4.7-12.3 0-17L344 83.5c-4.7-4.7-12.3-4.7-17 0z"></path>
                    </svg> @lang('site.logout')
                </a>
            </div>
            @else
            <div class="control-size text-center">
                <button id="btn-decrease" class="btn btn-default" type="button">-A</button>
                <button id="btn-increase" class="btn btn-default" type="button">+A</button>
            </div>
            @endif
        </div>
        <!--======================= Start copyright Section ===========================-->
        
        
        <div class="subfooter copyright">
            <!--======================= Start copyright Section ===========================-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 copy">
                        <!--<p>@lang('site.copy rights') {{\App\Models\setting::where('name','SiteName')->first()->value}} 2024</p>-->
                        
                        
                            <p>@lang('site.copy rights') {{__('site.footer_app')}} 2024</p>

                        
                        
                        
                    </div>
                    <div class="col-sm-6 image">
                        <div class="ryad-logo" style="display: inline-block;">
                            <a target="_balnk" href="https://elryad.com/ar/" title="تصميم مواقع" style="color:#fff">
                                <svg height="90" width="102" style=" transform: rotateY(180deg) scale(.35);float: left;width: 77px;">
                                    <line x1="0" y1="0" x2="90" y2="0" style="stroke:#f00;stroke-width:35" />
                                    <line x1="100" y1="0" x2="0" y2="10" style="stroke:#f00;stroke-width:20; transform:rotate(40deg)" />
                                    <line x1="10" y1="95" x2="50" y2="45" style="stroke:#f00;stroke-width:20;" />
                                </svg>
                            </a>
                            <div class="lolo-co" style="float: right;text-align: left;padding-top: 30px;position: relative;left: -15px;">
                                <a target="_balnk" href="https://elryad.com/ar/" title="تصميم مواقع" style="color:#fff;text-decoration: none;">
                                    <p style="text-transform: uppercase;font-family: sans-serif;font-size: 24px;line-height: 0.7;margin: 0;font-weight: 700;">elryad</p>
                                </a>
                                <span style="font-size: 12px;font-family: sans-serif; color:#fff;">
                                    <a target="_balnk" href="https://elryad.com/ar/" title="تصميم مواقع" alt="تصميم مواقع" style="font-size: 12px; font-family: sans-serif; color:inherit;text-decoration: none;">@lang('site.web design') </a> /
                                     <a target="_balnk" href="https://elryad.com/ar/برمجة-تطبيقات-الجوال/" title="تطبيقات" alt="تطبيقات" style="font-size: 12px; font-family: sans-serif; color:inherit;text-decoration: none;">@lang('site.app')</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--======================= Start copyright Section ===========================-->
        </div>
        <!--======================= Start copyright Section ===========================-->
    </footer>

    <!--========================== End footer ==========================-->
    





















