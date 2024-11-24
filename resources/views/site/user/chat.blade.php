@extends('site.layouts.app')
@section('content')

    <!-- ========================== start chat page =============================== -->
    <section class="chat-wrapper">
        <div class="wrapper">
            <div class="singleWrapper">
                <div class="container singlePage">
                    <div class="chat">
                        <div class="topics ">
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
                                    <li class="topic  ">
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
                                    <li class="topic ">
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
                        <div class="no-messenger desktop-only">
                            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="comments-alt" class="svg-inline--fa fa-comments-alt fa-w-18 fa-5x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M512 160h-96V64c0-35.3-28.7-64-64-64H64C28.7 0 0 28.7 0 64v160c0 35.3 28.7 64 64 64h32v52c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4l76.9-43.5V384c0 35.3 28.7 64 64 64h96l108.9 61.6c2.2 1.6 4.7 2.4 7.1 2.4 6.2 0 12-4.9 12-12v-52h32c35.3 0 64-28.7 64-64V224c0-35.3-28.7-64-64-64zM64 256c-17.6 0-32-14.4-32-32V64c0-17.6 14.4-32 32-32h288c17.6 0 32 14.4 32 32v160c0 17.6-14.4 32-32 32H215.6l-7.3 4.2-80.3 45.4V256zm480 128c0 17.6-14.4 32-32 32h-64v49.6l-80.2-45.4-7.3-4.2H256c-17.6 0-32-14.4-32-32v-96h128c35.3 0 64-28.7 64-64v-32h96c17.6 0 32 14.4 32 32z"></path>
                            </svg>
                            <span>@lang('site.choose conversation')</span>
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

            // botResponse();
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
            </li>`;

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