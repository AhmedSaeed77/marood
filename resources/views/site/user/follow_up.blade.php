@extends('site.layouts.appWithoutFooter')
@section('title')
<title> @lang('site.follow_up')</title>

@endsection

@section('style')

@endsection
@section('content')
    <!-- ========================== start follow page =============================== -->
    <section class="follow-page">
        <div class="container">
        <a href="{{ url()->previous() }}">
            <button class="backButton btn-link">
                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path>
                </svg>
                <br>
            </button>
        </a>
            <h2>@lang('site.follow_up')</h2>
            @if(count(auth::user()->userFollowCat)>0)
            <hr>
            <h3>@lang('site.follow_up_category')</h3>
            @foreach(auth::user()->userFollowCat as $followCat)
          
            <div id="hideCat{{$followCat->id}}">
            <a class="tag" href="{{url('/')}}/tag/{{$followCat->Cat->id}}">{{$followCat->Cat->name}}</a>
            <!-- <br>تنتهي المتابعة بعد 4 اسابيع و يوم<br> -->
            <br>
            <button class="button cancel_follow_cat" id="{{$followCat->id}}">
                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times-circle" class="svg-inline--fa fa-times-circle fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 464c-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216 0 118.7-96.1 216-216 216zm94.8-285.3L281.5 256l69.3 69.3c4.7 4.7 4.7 12.3 0 17l-8.5 8.5c-4.7 4.7-12.3 4.7-17 0L256 281.5l-69.3 69.3c-4.7 4.7-12.3 4.7-17 0l-8.5-8.5c-4.7-4.7-4.7-12.3 0-17l69.3-69.3-69.3-69.3c-4.7-4.7-4.7-12.3 0-17l8.5-8.5c4.7-4.7 12.3-4.7 17 0l69.3 69.3 69.3-69.3c4.7-4.7 12.3-4.7 17 0l8.5 8.5c4.6 4.7 4.6 12.3 0 17z"></path>
                </svg> @lang('site.cancel')</button>
            </div>
            <hr>
            @endforeach
            @endif
            @if(count(auth::user()->memberFollow )>0)
            <hr>
            <h3>@lang('site.Members you follow')</h3>
           @foreach(auth::user()->memberFollow as $member)
           <div id="hideUser{{$member->id}}">
            <a href="{{url('/')}}/user/{{$member->follow->id}}/profile">{{$member->follow->name}}</a>
            <br>
            <button class="button cancel_user_follow" id='{{$member->id}}'>
                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times-circle" class="svg-inline--fa fa-times-circle fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 464c-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216 0 118.7-96.1 216-216 216zm94.8-285.3L281.5 256l69.3 69.3c4.7 4.7 4.7 12.3 0 17l-8.5 8.5c-4.7 4.7-12.3 4.7-17 0L256 281.5l-69.3 69.3c-4.7 4.7-12.3 4.7-17 0l-8.5-8.5c-4.7-4.7-4.7-12.3 0-17l69.3-69.3-69.3-69.3c-4.7-4.7-4.7-12.3 0-17l8.5-8.5c4.7-4.7 12.3-4.7 17 0l69.3 69.3 69.3-69.3c4.7-4.7 12.3-4.7 17 0l8.5 8.5c4.6 4.7 4.6 12.3 0 17z"></path>
                </svg> @lang('site.cancel')
            </button>
            <hr>
            </div>
            @endforeach
            @endif 
            @if(count(auth::user()->userFollowPost )>0)
            <hr>
            <h3>@lang('site.posts whose comments you followed')</h3>
           @foreach(auth::user()->userFollowPost as $post)
           <div id="hidePost{{$post->id}}">
            <a href="{{url('/')}}/single/post/{{$post->id}}">{{$post->Post?$post->Post->title:'تم حذف الأعلان'}}</a>
            <br>
            <button class="button cancel_post_follow" id='{{$post->id}}'>
                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times-circle" class="svg-inline--fa fa-times-circle fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 464c-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216 0 118.7-96.1 216-216 216zm94.8-285.3L281.5 256l69.3 69.3c4.7 4.7 4.7 12.3 0 17l-8.5 8.5c-4.7 4.7-12.3 4.7-17 0L256 281.5l-69.3 69.3c-4.7 4.7-12.3 4.7-17 0l-8.5-8.5c-4.7-4.7-4.7-12.3 0-17l69.3-69.3-69.3-69.3c-4.7-4.7-4.7-12.3 0-17l8.5-8.5c4.7-4.7 12.3-4.7 17 0l69.3 69.3 69.3-69.3c4.7-4.7 12.3-4.7 17 0l8.5 8.5c4.6 4.7 4.6 12.3 0 17z"></path>
                </svg> @lang('site.cancel')
            </button>
            <hr>
            </div>
            @endforeach
            @endif
        </div>
    </section>
    <!-- ========================== End follow page =============================== -->


@endsection
@section('script')
<script>
$('.cancel_user_follow').on('click',function(){
var id=$(this).attr('id');
$.ajax({
        url:'{{ route("cancel_follow_user") }}',
        type:'post',
        data: {
            'id':id,
            _token: "{{ csrf_token() }}"
         },success:function(res){
            $('#hideUser'+id).hide();
         },error:function(err){
             console.log(err);
          
         }
    });
});
$('.cancel_follow_cat').on('click',function(){
var id=$(this).attr('id');
$.ajax({
        url:'{{ route("cancel_follow_cat") }}',
        type:'post',
        data: {
            'id':id,
            _token: "{{ csrf_token() }}"
         },success:function(res){
            $('#hideCat'+id).hide();
         },error:function(err){
             console.log(err);
          
         }
    });
});
$('.cancel_post_follow').on('click',function(){
var id=$(this).attr('id');
$.ajax({
        url:'{{ route("cancel_post_follow") }}',
        type:'post',
        data: {
            'id':id,
            _token: "{{ csrf_token() }}"
         },success:function(res){
            $('#hidePost'+id).hide();
         },error:function(err){
             console.log(err);
          
         }
    });
});

</script>
@endsection