@extends('admin.layouts.app')
@section('style')
<style>
.text-muted{
    color: #777 !important;
}
</style>
@endsection
@section('content')

<section class="my_notification_page inside_page">
        <div class="container">
            <div class="content">
                    @foreach(Auth::user()->notifications as $not)
                                         @if($not->type=="App\Notifications\commentNotification"||$not->type=="App\Notifications\addPostNotfication")
                                            <?php $post=\App\Models\Post::find($not->data['post_id']);?>
                                                @if($post)
                                                <a href="{{url('/')}}/admin/posts/show/{{$not->id}}/#{{$post->id}}">
                                                @else
                                                <a href="javascript:void(0);" > 
                                                @endif
                                                    <div class="item {{$not->unread()?'active':''}}">
                                                        <div class="info">
                                                            <h6 class="name"> 
                                                            @if($not->type=="App\Notifications\addPostNotfication" && $post)
                                                            لقد قام {{$post->post_user->User->name}} بإضافة إعلان جديد
                                                            @else
                                                            يوجد تعليق جديد 
                                                            @endif
                                                            </h6>
                                                            <p class="desc">{{$post?$post->title:$not->data['post_title']??'تم حذف الاعلان'}} </p>
                                                        </div>
                                                        <div class="time">
                                                            <div>
                                                                <i class="fal fa-clock"></i>
                                                                <span>{{$not->created_at->diffForHumans()}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                 </a>
                                           @elseif($not->type=="App\Notifications\contactNotfication")
                                                         
                                                <a href="{{url('/')}}/admin/contact/show/{{$not->id}}/#{{$not->data['contact_id']}}">
                                              
                                                    <div class="item {{$not->unread()?'active':''}}">
                                                        <div class="info">
                                                            <h6 class="name"> 
                                                              {{$not->data['title']}}
                                                            </h6>
                                                            <p class="desc">{{$not->data['msg']}} </p>
                                                        </div>
                                                        <div class="time">
                                                            <div>
                                                                <i class="fal fa-clock"></i>
                                                                <span>{{$not->created_at->diffForHumans()}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                 </a>
                                            @elseif($not->type=="App\Notifications\InfractionNotfication")
                                                   <a href="{{url('/')}}/admin/infraction/show/{{$not->id}}/#{{$not->data['infraction_id']}}">
                                              
                                                    <div class="item {{$not->unread()?'active':''}}">
                                                        <div class="info">
                                                            <h6 class="name"> 
                                                              {{$not->data['title']}}
                                                            </h6>
                                                            <p class="desc">{{$not->data['user']}} </p>
                                                        </div>
                                                        <div class="time">
                                                            <div>
                                                                <i class="fal fa-clock"></i>
                                                                <span>{{$not->created_at->diffForHumans()}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                 </a>
                                             @else
                                                  @if($not->type =="App\Notifications\newUserNotifications" )
                                                       <a href="{{url('/')}}/admin/users/show/{{$not->id}}/#{{$not->data['user_id']}}">
                                              
                                                        <div class="item {{$not->unread()?'active':''}}">
                                                            <div class="info">
                                                                <h6 class="name"> 
                                                                  {{$not->data['title']}}
                                                                </h6>
                                                                <p class="desc">{{$not->data['username']}} </p>
                                                            </div>
                                                            <div class="time">
                                                                <div>
                                                                    <i class="fal fa-clock"></i>
                                                                    <span>{{$not->created_at->diffForHumans()}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                     </a>
                                                  @endif
                                            @endif
                                        
               @endforeach
            </div>
        </div>
    </section>


@endsection