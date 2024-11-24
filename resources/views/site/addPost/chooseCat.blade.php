@extends('site.layouts.app_without_header')
@section('style')
    @if(app()->getLocale() == 'en')
        <style>
            body{
                direction: ltr;
            }


        </style>
    @endif
@endsection
@section('content')
    <!--========================== Start add post page ==========================-->
    <section class="add-post-page">
        <div class="container">
            <div class="singleContent addPost">
                <a href="javascript:history.back()">
                    <div><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path></svg></div>
                </a>
                <h1>@lang('site.add new post')</h1>
                <h3>@lang('site.choose post type')</h3>
              
              {{-- 
                @foreach($mainFilter->items as $item)
                <a class="listContFor2Items" href="{{url('/')}}/contract/{{$item->cat->id}}">
                    <div class="right">
                       <i class=" {{$item->cat->icon}}"></i> 
                      {{$item->name}}</div>
                    <div><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-left" class="svg-inline--fa fa-arrow-left fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M231.536 475.535l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L60.113 273H436c6.627 0 12-5.373 12-12v-10c0-6.627-5.373-12-12-12H60.113L238.607 60.506c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0L3.515 247.515c-4.686 4.686-4.686 12.284 0 16.971l211.051 211.05c4.686 4.686 12.284 4.686 16.97-.001z"></path></svg></div>
                </a>
                @endforeach
                --}}
                
                 @foreach($cats as $cat)
                    <a style="font-size: 20px" class="listContFor2Items" href="{{url('/')}}/contract/{{$cat->id}}">
                        <div class="right">
                            <i class=" {{$cat->icon}}"></i>
                           {{app()->getLocale() == 'ar' ? $cat->name_ar : $cat->name_en}}</div>
                           
                            <div>

                            @if(app()->getLocale() == 'en')

                            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.071c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.071c4.686 4.686 12.284 4.686 16.971 0l211.051-211.051c4.686-4.686 4.686-12.284 0-16.971L233.435 36.465c-4.686-4.686-12.284-4.686-16.971 0z"></path></svg>
                            @else

                            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-left" class="svg-inline--fa fa-arrow-left fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M231.536 475.535l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L60.113 273H436c6.627 0 12-5.373 12-12v-10c0-6.627-5.373-12-12-12H60.113L238.607 60.506c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0L3.515 247.515c-4.686 4.686-4.686 12.284 0 16.971l211.051 211.05c4.686 4.686 12.284 4.686 16.97-.001z"></path></svg>

                            @endif
                        </div>

                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!--========================== End add post page ==========================-->

@endsection