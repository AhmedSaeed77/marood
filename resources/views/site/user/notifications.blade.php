@extends('site.layouts.appWithoutFooter')
@section('title')
<title> @lang('site.notifications')</title>

@endsection

@section('style')
<style>
    .a-text {
        background: none;
        color: inherit;
        border: none;
        padding: 0;
        font: inherit;
        cursor: pointer;
        outline: inherit;
        background-color: #929aaa;
        color: #f2f4fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endsection
@section('content')

    <!-- ========================== start note page =============================== -->
    <section class="note-page">
        <div class="container">
            <div class=" note">
                <div class="actions">
                    <span class="right" >
                        <button class="ds_btn ds_btn_rounded" >

                            <a class="a-text" href="{{url('/')}}">
                            <svg aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="arrow-right"
                                class="svg-inline--fa fa-arrow-right fa-w-14 fa-1x " role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor"
                                    d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z">
                                </path>
                            </svg>

                            </a>
                            <br>
                        </button>
                        <h3>@lang('site.notifications')</h3>
                    </span>

                    <span style="display: flex;">
                        <!-- <div style="margin-left: 10px;">
                            <a href="notification-controls.html">
                            <button class="ds_btn ds_btn_type1" style="background: rgb(1, 115, 192);">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cog"
                                        class="svg-inline--fa fa-cog fa-w-16 fa-fw " role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M487.4 315.7l-42.6-24.6c4.3-23.2 4.3-47 0-70.2l42.6-24.6c4.9-2.8 7.1-8.6 5.5-14-11.1-35.6-30-67.8-54.7-94.6-3.8-4.1-10-5.1-14.8-2.3L380.8 110c-17.9-15.4-38.5-27.3-60.8-35.1V25.8c0-5.6-3.9-10.5-9.4-11.7-36.7-8.2-74.3-7.8-109.2 0-5.5 1.2-9.4 6.1-9.4 11.7V75c-22.2 7.9-42.8 19.8-60.8 35.1L88.7 85.5c-4.9-2.8-11-1.9-14.8 2.3-24.7 26.7-43.6 58.9-54.7 94.6-1.7 5.4.6 11.2 5.5 14L67.3 221c-4.3 23.2-4.3 47 0 70.2l-42.6 24.6c-4.9 2.8-7.1 8.6-5.5 14 11.1 35.6 30 67.8 54.7 94.6 3.8 4.1 10 5.1 14.8 2.3l42.6-24.6c17.9 15.4 38.5 27.3 60.8 35.1v49.2c0 5.6 3.9 10.5 9.4 11.7 36.7 8.2 74.3 7.8 109.2 0 5.5-1.2 9.4-6.1 9.4-11.7v-49.2c22.2-7.9 42.8-19.8 60.8-35.1l42.6 24.6c4.9 2.8 11 1.9 14.8-2.3 24.7-26.7 43.6-58.9 54.7-94.6 1.5-5.5-.7-11.3-5.6-14.1zM256 336c-44.1 0-80-35.9-80-80s35.9-80 80-80 80 35.9 80 80-35.9 80-80 80z">
                                        </path>
                                    </svg> @lang('site.setting')
                                </button>
                            </a>
                        </div> -->
                        <div><button class="ds_btn ds_btn_type1 delete-notes" id="del_notification">@lang('site.del notification')</button></div>
                    </span>
                </div>
                <div class="list">
                @foreach(Auth::user()->unreadnotifications as $not)
                 @if($not->type =="App\Notifications\commentNotification" || $not->type =="App\Notifications\postFollowNotification" ||"" )
                <?php $post=\App\Models\Post::find($not->data['post_id']);?>

                    <div class="card active" href="{{route('notification_show',$not->id)}}">
                        <span class="icon_wrapper icon_wrapper_reply success">
                            <svg class="svg-inline--hi hi-fw" viewBox="0 0 28.185 25.105"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.402 19.826a6.5 6.5 0 00.836 3.184H0a12.273 12.273 0 018.007-11.511 6.54 6.54 0 118.544 0 12.55 12.55 0 013.86 2.314 6.5 6.5 0 00-4.009 6.013zm11.782 0a5.282 5.282 0 11-5.282-5.281 5.282 5.282 0 015.283 5.278zm-1.789-.973l-.623-.936-4.155 2.771-1.062-1.68-.951.6 1.677 2.655z"
                                    fill="currentColor">

                                </path>
                            </svg>
                        </span>
                        <div class="content">
                            <div class="main">
                                <span>
                                @if($not->type=="App\Notifications\commentNotification")
                                <a class="title" href="{{route('notification_show_comment',[$not->id,$not->data['comment_id']])}}">{{$not->data['title']}}</a></span>
                                @else
                                <a class="title" href="{{route('notification_show',$not->id)}}">{{$not->data['title']}}</a></span>
                                @endif
                                <span class="meta_text">{{$post->title??$not->data['post_title']??'تم حذف الاعلان'}}</span>
                            </div>
                            <span class="meta_data">
                                <span>{{$post?$post->created_at->diffForHumans():''}}</span>
                            <a class="username" href="{{route('notification_show_user',$not->id)}}">{{$post?$post->post_user->user->name:''}}</a>
                            </span>
                        </div>
                    </div>

                 @endif
                 @if($not->type=="App\Notifications\activeNotification")
                                     <div class="card active" >
                        <span class="icon_wrapper icon_wrapper_reply success">
                            <svg class="svg-inline--hi hi-fw" viewBox="0 0 28.185 25.105"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.402 19.826a6.5 6.5 0 00.836 3.184H0a12.273 12.273 0 018.007-11.511 6.54 6.54 0 118.544 0 12.55 12.55 0 013.86 2.314 6.5 6.5 0 00-4.009 6.013zm11.782 0a5.282 5.282 0 11-5.282-5.281 5.282 5.282 0 015.283 5.278zm-1.789-.973l-.623-.936-4.155 2.771-1.062-1.68-.951.6 1.677 2.655z"
                                    fill="currentColor">

                                </path>
                            </svg>
                        </span>
                        <div class="content">
                            <div class="main">
                                <span>
                                <a class="title" href="{{route('notification_show',$not->id)}}">{{$not->data['title']}}</a>
                                </span>

                                <span class="meta_text">{{$post->title??$not->data['post_title']??'تم حذف الاعلان'}}</span>
                            </div>
                            <span class="meta_data">
                                <span>{{$not->created_at->diffForHumans()}}</span>
                            <a class="username">{{$not->data['reason']}}</a>
                            </span>
                        </div>
                    </div>


                 @endif
                 @endforeach
                       @foreach(Auth::user()->readnotifications as $not)
                       @if($not->type =="App\Notifications\commentNotification" || $not->type =="App\Notifications\postFollowNotification" )
                <?php $post=\App\Models\Post::find($not->data['post_id']);?>

                    <div class="card " href="{{route('notification_show',$not->id)}}">
                        <span class="icon_wrapper icon_wrapper_reply success">
                            <svg class="svg-inline--hi hi-fw" viewBox="0 0 28.185 25.105"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.402 19.826a6.5 6.5 0 00.836 3.184H0a12.273 12.273 0 018.007-11.511 6.54 6.54 0 118.544 0 12.55 12.55 0 013.86 2.314 6.5 6.5 0 00-4.009 6.013zm11.782 0a5.282 5.282 0 11-5.282-5.281 5.282 5.282 0 015.283 5.278zm-1.789-.973l-.623-.936-4.155 2.771-1.062-1.68-.951.6 1.677 2.655z"
                                    fill="currentColor">

                                </path>
                            </svg>
                        </span>
                        <div class="content">
                            <div class="main">
                                <span>
                                @if($not->type=="App\Notifications\commentNotification")
                                <a class="title" href="{{route('notification_show_comment',[$not->id,$not->data['comment_id']])}}">{{$not->data['title']}}</a></span>
                                @else
                                <a class="title" href="{{route('notification_show',$not->id)}}">{{$not->data['title']}}</a></span>
                                @endif
                                </span>

                                <span class="meta_text">{{$post?$post->title:$not->data['post_title']??'تم حذف الاعلان'}}</span>
                            </div>
                            <span class="meta_data">
                                <span>{{$post?$post->created_at->diffForHumans():''}}</span>
                            <a class="username" href="{{route('notification_show_user',$not->id)}}">{{$post?$post->post_user->user->name:''}}</a>
                            </span>
                        </div>
                    </div>
                @endif
                 @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- ========================== End note page =============================== -->

@endsection
@section('script')
<script>
$('#del_notification').on('click',function(){
    $.ajax({
        url:'{{ route('del_notification') }}',
        type:'get',
        data: {
         },success:function(res){
            $(".card").hide();
         },error:function(err){
             console.log(err);

         }
    });
});
</script>
@endsection
