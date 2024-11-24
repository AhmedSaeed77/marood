@extends('site.layouts.appWithoutFooter')
@section('content')
    <section class="sitemap-page">
        <div class="container">
            <a href="{{ url()->previous() }}"class="btn backButton btn-link">
                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path>
                </svg>
            </a>
          
            <div class="sitemap-cont">
                  @foreach($menue->items as $item)
                    <div class="sitemap-item">
                    <a href="{{url('/')}}/tag/{{$item->cat->id}}">
                        <h3>{{$item->name}}</h3>
                    </a>
                    <ul>
                        @foreach($item->cat->child as $cat)
                        <li><a href="{{url('/')}}/tag/{{$cat->id}}">{{$cat->name}}</a></li>
                        @if(count($cat->child)>0)
                        @foreach($cat->child as $child)
                        <ul class="children">
                           <li><a href="{{url('/')}}/tag/{{$child->id}}">{{$child->name}}</a></li>
                        </ul>
                        @endforeach
                        @endif
                        @endforeach
                    </ul>
                </div>
                  @endforeach
                    <!--<div class="sitemap-item">-->
                    <!--<a href="{{url('/')}}">-->
                    <!--    <h3>@lang('site.all') @lang('site.siteName')</h3>-->
                    <!--</a>-->
                    <!--<ul>-->
                    <!--    @foreach($menue->items->where('main',0) as $cat)-->
                      
                    <!--    <li><a href="{{url('/')}}/tag/{{$cat->id}}">{{$cat->name}}</a></li>-->
                    <!--    @if(!empty($cat->child))-->
                    <!--    @foreach($cat->child as $child)-->
                    <!--    <ul class="children">-->
                    <!--       <li><a href="{{url('/')}}/tag/{{$child->id}}">{{$child->name}}</a></li>-->
                    <!--    </ul>-->
                    <!--    @endforeach-->
                    <!--    @endif-->
                    <!--    @endforeach-->
                    <!--</ul>-->
                        
                    <!--</div>-->
            </div>
          
        </div>
    </section>

@endsection