@extends('site.layouts.app_without_header')
@section('content')


    <!--========================== Start add post page ==========================-->
    <section class="add-post-page">
        <div class="container">
            <div class="singleContent addPost">
                <br>@lang('site.You cannot add an ad because:')<br>
                
                @if(auth()->user()->member_id == null)
                <span class="label label-primary">@lang('site.You have reached the maximum number of ads during the month')</span>

                @else
                <span class="label label-primary">@lang('site.You have reached the maximum number of ads during the day')</span>

                @endif
                <!--<span class="label label-primary">@lang('site.You have reached the maximum number of ads during the day')</span>-->
                <br>
                <a href="javascript:history.back()">@lang('site.Back to main') </a>
            </div>
        </div>
    </section>

    <!--========================== End add post page ==========================-->

@endsection