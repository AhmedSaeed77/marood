@extends('site.layouts.app')
@section('content')

<?php $mainCon=$conv?>
  <!-- ========================== start chat page =============================== -->
  <section class="chat-wrapper">
        <div class="wrapper">
            <div class="singleWrapper">
                <div class="container singlePage">
                    <div class="chat">
                        <div class="topics desktop-only">
                            <div class="topics-header">
                                <div class="top">
                                    <h3>@lang('site.conversations')</h3>
                                    <button id="search_box_btn"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="search" class="svg-inline--fa fa-search fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M508.5 481.6l-129-129c-2.3-2.3-5.3-3.5-8.5-3.5h-10.3C395 312 416 262.5 416 208 416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c54.5 0 104-21 141.1-55.2V371c0 3.2 1.3 6.2 3.5 8.5l129 129c4.7 4.7 12.3 4.7 17 0l9.9-9.9c4.7-4.7 4.7-12.3 0-17zM208 384c-97.3 0-176-78.7-176-176S110.7 32 208 32s176 78.7 176 176-78.7 176-176 176z"></path></svg>
                                    </button>
                                </div>
                                <div class="react-autosuggest__container">
                                    <input type="search" autocomplete="off" class="search-input" placeholder="@lang('site.search for user')" value="" id="vue-autosuggest__input">
                                </div>

                                <div id="vue-autowhatever-1" class="react-autosuggest__suggestions-container react-autosuggest__suggestions-container--open">
                                    <ul class="react-autosuggest__suggestions-list">
                                   
                                    </ul>
                                </div>
                            </div>
                            <div class="topic-list">
                            <ul>
                                
                                
                                    @foreach(Auth::user()->sendConver as $conv)
                                    <?php $msg=$conv->RecieveMsg->first();
                                    if($msg==null){
                                        $read=1;
                                        $msg=$conv->msgs->first();
                                        
                                    }else{
                                       
                                        $read=0;
                                    }
                                    ?>
                                    <li class="topic {{$conv->id==$mainCon->id?'selected':''}} ">
                                        <a class="{{$read==0?'unread':''}}" href="{{url('/')}}/chat/conv/{{$conv->id}}">
                                            <div class="header">
                                                <span class="title">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="user" class="svg-inline--fa fa-user fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M313.6 288c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4zM416 464c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16v-41.6C32 365.9 77.9 320 134.4 320c19.6 0 39.1 16 89.6 16 50.4 0 70-16 89.6-16 56.5 0 102.4 45.9 102.4 102.4V464zM224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm0-224c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"></path></svg>
                                                    {{$conv->Userreciev->name}}
                                                 </span>
                                                    @if($read==0)
                                                    <span class="badge badge-danger">{{count($conv->msgs->where('read',0)->where('reciever',auth::user()->id))}}</span>
                                                    @endif
                                                 @if($msg)
                                                <div class="time">{{$msg->created_at->month}}/{{$msg->created_at->day}}/{{$msg->created_at->year}}</div>
                                                 @endif
                                            </div>
                                            <div class="last-message" style="direction: rtl;">{{$msg?$msg->msg_content:''}}</div>
                                        </a>
                                    </li>
                                    @endforeach
                                    
                                    
                                    
                                    @foreach(Auth::user()->recievConver as $convv)
                                    @if($convv->user_id !=$convv->follow_user_id)
                                    <?php $msg=$convv->RecieveMsg->first();
                                    if($msg==null){
                                        $read=1;
                                        $msg=$convv->msgs->first();
                                    }else{
                                        $read=0;
                                    }
                                    ?>
                                    <li class="topic {{$convv->id==$mainCon->id?'selected':''}}">
                                        <a class="{{$read==0?'unread':''}}" href="{{url('/')}}/chat/conv/{{$convv->id}}">
                                            <div class="header">
                                                <span class="title">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="user" class="svg-inline--fa fa-user fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M313.6 288c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4zM416 464c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16v-41.6C32 365.9 77.9 320 134.4 320c19.6 0 39.1 16 89.6 16 50.4 0 70-16 89.6-16 56.5 0 102.4 45.9 102.4 102.4V464zM224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm0-224c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"></path></svg>
                                                    {{$convv->UserSend->name}}
                                                </span>
                                                    @if($read==0)
                                                    <span class="badge badge-danger">{{count($convv->msgs->where('read',0)->where('reciever',auth::user()->id))}}</span>
                                                    @endif
                                                    @if($msg)
                                                     <div class="time">{{$msg->created_at->month}}/{{$msg->created_at->day}}/{{$msg->created_at->year}}</div>
                                                    @endif
                                            </div>
                                            <div class="last-message" style="direction: rtl;">{{$msg?$msg->msg_content:''}}</div>
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                   
                                 
                                </ul>
                            </div>
                        </div>
                        <div class="messenger">
                            <div class="messenger-header">
                                <div class="info">
                                    <h3><a href="{{url('/')}}/user/{{auth::user()->id==$mainCon->Userreciev->id?$mainCon->UserSend->id:$mainCon->Userreciev->id}}/profile">
                                @if(auth::user()->id==$mainCon->Userreciev->id)
                                {{$mainCon->UserSend->name}}
                                @else
                                {{$mainCon->Userreciev->name}}
                                @endif
                                </a></h3>
                                    <span class="typing"></span>
                                </div>
                                <div class="toolbar">
                                    <button class="dropdown-btn">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="ellipsis-h-alt" class="svg-inline--fa fa-ellipsis-h-alt fa-w-16 toggle-user-action-handle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 184c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm0 112c-22.1 0-40-17.9-40-40s17.9-40 40-40 40 17.9 40 40-17.9 40-40 40zm176-112c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm0 112c-22.1 0-40-17.9-40-40s17.9-40 40-40 40 17.9 40 40-17.9 40-40 40zM80 184c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm0 112c-22.1 0-40-17.9-40-40s17.9-40 40-40 40 17.9 40 40-17.9 40-40 40z"></path></svg>
                                    </button>
                                    <input type="hidden" id="conv_id" value="{{$mainCon->id}}"/>
                                    <input type="hidden" id="conv_reciver" value="{{auth::user()->id==$mainCon->Userreciev->id?$mainCon->UserSend->id:$mainCon->Userreciev->id}}"/>
                                    <ul class="dropdown">
                                        <li>
                                            <a href="{{route('chat_conv_delete',$mainCon->id)}}">@lang('site.del conversation')
                                                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h18.9l33.2 372.3a48 48 0 0 0 47.8 43.7h232.2a48 48 0 0 0 47.8-43.7L421.1 96H440a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zm184.8 427a15.91 15.91 0 0 1-15.9 14.6H107.9A15.91 15.91 0 0 1 92 465.4L59 96h330z"></path>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="message-list msger-chat">
                                <ul>
                                    <?php $date=null; $x=0?>
                                    @foreach($mainCon->msgs as $msg)
                                    <?php 
                                    $msgDate=$msg->created_at->year.'/'.$msg->created_at->month.'/'.$msg->created_at->day;

                                       if($date!=$msgDate){
                                           $date=$msgDate;
                                           $x=1;
                                       }else{
                                           $x=0;
                                       }
                                    ?>
                                    <li>
                                        @if($x==1)
                                        <div class="chat-day"><span>{{Carbon\Carbon::parse($msg->created_at)->format('M')}} {{Carbon\Carbon::parse($msg->created_at)->format('d')}},{{Carbon\Carbon::parse($msg->created_at)->format('Y')}}</span></div>
                                        @endif
                                        <div class="chat-message {{$msg->Sender->id==auth::user()->id?'right':'left'}}">
                                            <span class="img_user"><img src="{{url('/')}}/public/storage/{{$msg->Sender->avatar??'users/avatar.png'}}"/></span>
                                            <div class="bubble {{$msg->Sender->id==auth::user()->id?'right':'left'}}">
                                                <span class="text">
                                                    {{$msg->msg_content}} 
                                                </span>
                                                <div class="meta"><span class="time {{$msg->Sender->id==auth::user()->id?'right':'left'}}">{{Carbon\Carbon::parse($msg->created_at)->format('H:i A')}}</span></div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                  
                                </ul>
                            </div>
                            <form class="composer msger-inputarea">
                                <div class="input">
                                    <input class="msger-input" placeholder="@lang('site.write here')" maxlength="700" style="max-height: 6rem; direction: rtl;">
                                </div>
                                <div class="send-button">
                                    <button type="submit">
                                        <span><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paper-plane" class="svg-inline--fa fa-paper-plane fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M476 3.2L12.5 270.6c-18.1 10.4-15.8 35.6 2.2 43.2L121 358.4l287.3-253.2c5.5-4.9 13.3 2.6 8.6 8.3L176 407v80.5c0 23.6 28.5 32.9 42.5 15.8L282 426l124.6 52.2c14.2 6 30.4-2.9 33-18.2l72-432C515 7.8 493.3-6.8 476 3.2z"></path></svg>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================== End chat page =============================== -->

@endsection
@section('script')
    <script>
    /* ===============================  showBoxSearch  =============================== */
        $('#search_box_btn').on('click', function() {
            $(".react-autosuggest__container").toggleClass('show');
        })
    </script>
 <!--================ settings of chat page =================-->
 <script>
        const msgerForm = get(".msger-inputarea");
        const msgerInput = get(".msger-input");
        const msgerChat = get(".msger-chat");
        msgerChat.scrollTop += 5000;


        msgerForm.addEventListener("submit", event => {
            event.preventDefault();

            const msgText = msgerInput.value;
            if (!msgText) return;

            appendMessage("right", msgText);
            msgerInput.value = "";
            var conv_id=$('#conv_id').val();
            var to=$('#conv_reciver').val();
 console.log(to);
            // botResponse();
            $.ajax({
        url:'{{ route('send_msg_chat') }}',
        type:'post',
        data: {
            conv_id : conv_id,
            conv_reciver:to,
             msg:msgText,
            _token: "{{ csrf_token() }}"
         },success:function(res){
             console.log(res);
             location.reload();
            }
        
    });
        });

        function appendMessage(side, text) {
            //   Simple solution for small apps
            const msgHTML = `
            <li>
                <div class="chat-message ${side}">
                    <div class="bubble ${side}">
                        <span class="text">${text}</span>
                        <div class="meta">
                            <span class="time ${side}">12:35 PM</span>
                            <span class="ticks">
                                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="check" class="svg-inline--fa fa-check fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" color=""><path fill="currentColor" d="M413.505 91.951L133.49 371.966l-98.995-98.995c-4.686-4.686-12.284-4.686-16.971 0L6.211 284.284c-4.686 4.686-4.686 12.284 0 16.971l118.794 118.794c4.686 4.686 12.284 4.686 16.971 0l299.813-299.813c4.686-4.686 4.686-12.284 0-16.971l-11.314-11.314c-4.686-4.686-12.284-4.686-16.97 0z"></path></svg>
                            </span>
                        </div>
                    </div>
                </div>
            </li>
`;

            msgerChat.insertAdjacentHTML("beforeend", msgHTML);
            msgerChat.scrollTop += 500;
        }


        function botResponse() {
            const r = random(0, BOT_MSGS.length - 1);
            const msgText = BOT_MSGS[r];
            const delay = msgText.split(" ").length * 100;

            setTimeout(() => {
                appendMessage(BOT_NAME, BOT_IMG, "left", msgText);
            }, delay);
        }

        // Utils
        function get(selector, root = document) {
            return root.querySelector(selector);
        }

        function formatDate(date) {
            const h = "0" + date.getHours();
            const m = "0" + date.getMinutes();

            return `${h.slice(-2)}:${m.slice(-2)}`;
        }

        function random(min, max) {
            return Math.floor(Math.random() * (max - min) + min);
        }
    </script>

    <script>
        var input_chat = document.getElementById('vue-autosuggest__input'),
            result_search = document.getElementById('vue-autowhatever-1');

        input_chat.onkeyup = function() {
            $.ajax({
        url:'{{ route("search_user") }}',
        type:'post',
        data: {
            'text':input_chat.value,
            _token: "{{ csrf_token() }}"
         },success:function(res){
             $("#vue-autowhatever-1 .react-autosuggest__suggestions-list").empty();
             console.log($("#vue-autowhatever-1 .react-autosuggest__suggestions-list").lenght);
            $.each(res, function( n , val ) {
                console.log(val);
            $("#vue-autowhatever-1 .react-autosuggest__suggestions-list").append('<li role="option" class="react-autosuggest__suggestion react-autosuggest__suggestion--first" id="'+val.id+'">   <a href="{{url('/')}}/new/conv/'+val.id+'"><div class="username"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="user" class="svg-inline--fa fa-user fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M313.6 288c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4zM416 464c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16v-41.6C32 365.9 77.9 320 134.4 320c19.6 0 39.1 16 89.6 16 50.4 0 70-16 89.6-16 56.5 0 102.4 45.9 102.4 102.4V464zM224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm0-224c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"></path></svg>'+val.name+'   </div>  </a></li>');
            });
         },error:function(err){
             console.log(err);
          
         }
    });

            result_search.style.display = "block";
            var value = input_chat.value;
            var length = value.length;
            if (length < 1) {
                result_search.style.display = "none";
                $("#vue-autowhatever-1 .react-autosuggest__suggestions-list").empty();
            }

        }
        // input_chat.onblur = function() {
        //     result_search.style.display = "none";
        //     $("#vue-autowhatever-1 .react-autosuggest__suggestions-list").empty();
        // }
    </script>


@endsection