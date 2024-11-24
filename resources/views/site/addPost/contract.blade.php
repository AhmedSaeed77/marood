
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
            <form action="{{route('choose_area_add_post',$cat->id)}}">
                <a href="javascript:history.back()">
                    <div><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path></svg></div>
                </a>
                <h3> »@lang('site.commission agreement')</h3>
                <hr><span>بسم الله الرحمن الرحيم</span><br><span>قال الله تعالى:</span><b>" وَأَوْفُواْ بِعَهْدِ اللهِ إِذَا عَاهَدتُّمْ وَلاَ تَنقُضُواْ الأَيْمَانَ بَعْدَ تَوْكِيدِهَا وَقَدْ جَعَلْتُمُ اللهَ عَلَيْكُمْ كَفِيلاً "</b><span>صدق الله العظيم</span><br>
                <hr><br>
                
                <ul>
                    <label>
                        @if($cat->id == 5)
                        <input type="checkbox" required value=""> <p style="display: inline;">  @lang('site.pledge_real_state')<br><br>
                        
                        @else
                        <input type="checkbox" required value=""> <p style="display: inline;">  @lang('site.pledge')<br><br>

                        @endif
                        <span style="padding-right: 17px;"> *@lang('site.also pledge')</span></p><br><span> &nbsp; </span></label></ul><br>
                <div><br>
                    <div class="green">@lang('site.note')</div><br></div>
                <div class="buttons"><button type="submit" class="button  btn-lg btn-success mt-1">@lang('site.continue') »</button></div>
            </form>
        </div>
    </section>

    <!--========================== End add post page ==========================-->
@endsection