@extends('site.layouts.app')
@section('title')
<title>{{$member->title}}</title>
@endsection
@section('style')
<style>
body{
    background-color: rgb(242, 244, 250);

}
</style>
@endsection
@section('content')
  <!--========================== Start member page ==========================-->

  <section class="member-page">
        <div class="container">
            <br>
            <a href="{{ url()->previous() }}">
            <button class="backButton btn-link" style="background-color: rgb(242, 244, 250);">
            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right"
                class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512">
                <path fill="currentColor"
                    d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z">
                </path>
            </svg>
          </a>
        </button>
            <h1><b>{{$member->title}}</b></h1>
            <div class="twoCards_wrapper">
                <div class="contnet_wrapper">
                    <span class="icon_wrapper">
                    <svg aria-hidden="true" focusable="false"
                        data-prefix="fas" data-icon="id-badge" class="svg-inline--fa fa-id-badge fa-w-12 " role="img"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                        <path fill="currentColor"
                            d="M336 0H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48zM144 32h96c8.8 0 16 7.2 16 16s-7.2 16-16 16h-96c-8.8 0-16-7.2-16-16s7.2-16 16-16zm48 128c35.3 0 64 28.7 64 64s-28.7 64-64 64-64-28.7-64-64 28.7-64 64-64zm112 236.8c0 10.6-10 19.2-22.4 19.2H102.4C90 416 80 407.4 80 396.8v-19.2c0-31.8 30.1-57.6 67.2-57.6h5c12.3 5.1 25.7 8 39.8 8s27.6-2.9 39.8-8h5c37.1 0 67.2 25.8 67.2 57.6v19.2z">
                        </path>
                    </svg>
                </span>
                    <h3>@lang('site.About Membership')</h3>
                  <?php echo $member->desc ;?>
                </div>
                <div class="contnet_wrapper"><span class="icon_wrapper"><svg aria-hidden="true" focusable="false"
                        data-prefix="fas" data-icon="star" class="svg-inline--fa fa-star fa-w-18 " role="img"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <path fill="currentColor"
                            d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z">
                        </path>
                    </svg></span>
                    <h3>@lang('site.Membership Advantages')</h3>
                   <?php echo $member->advantage ?>
                </div>
            </div>
            @if(!is_null($package))
            <div id="sub_wrapper" class="contnet_wrapper">
                <h3>@lang('site.package prices')</h3><span class="icon_wrapper"><svg aria-hidden="true" focusable="false"
                    data-prefix="fas" data-icon="credit-card" class="svg-inline--fa fa-credit-card fa-w-18 " role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path fill="currentColor"
                        d="M0 432c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V256H0v176zm192-68c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H204c-6.6 0-12-5.4-12-12v-40zm-128 0c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM576 80v48H0V80c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48z">
                    </path>
                </svg></span>
                <h2>{{$package->title ?? ''}}</h2><a id="sub_btn" href="{{route('packages',$member->id)}}">@lang('site.subscripe now')</a>
            </div>
            @endif
            <div class="contnet_wrapper terms_wrapper">
                <h3>@lang('site.MemberShip Conditions')</h3>
         <?php echo $member->condition?>
            </div>
            @if(count($member->questions)>0)
                @foreach($member->questions as $question)
                    <div class="qa_wrapper contnet_wrapper">
                        <div class="q">
                            <span class="str_wrapper">
                                <span class="q_icon">
                                    <svg aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="question-circle"
                                    class="svg-inline--fa fa-question-circle fa-w-16 " role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="currentColor"
                                        d="M504 256c0 136.997-111.043 248-248 248S8 392.997 8 256C8 119.083 119.043 8 256 8s248 111.083 248 248zM262.655 90c-54.497 0-89.255 22.957-116.549 63.758-3.536 5.286-2.353 12.415 2.715 16.258l34.699 26.31c5.205 3.947 12.621 3.008 16.665-2.122 17.864-22.658 30.113-35.797 57.303-35.797 20.429 0 45.698 13.148 45.698 32.958 0 14.976-12.363 22.667-32.534 33.976C247.128 238.528 216 254.941 216 296v4c0 6.627 5.373 12 12 12h56c6.627 0 12-5.373 12-12v-1.333c0-28.462 83.186-29.647 83.186-106.667 0-58.002-60.165-102-116.531-102zM256 338c-25.365 0-46 20.635-46 46 0 25.364 20.635 46 46 46s46-20.636 46-46c0-25.365-20.635-46-46-46z">
                                    </path>
                                </svg>
                            </span>
                            <span class="q_text">{{$question->question}}</span>
                            </span>
                            <span class="q_open_icon">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                data-icon="chevron-circle-down" class="svg-inline--fa fa-chevron-circle-down fa-w-16 "
                                role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor"
                                    d="M504 256c0 137-111 248-248 248S8 393 8 256 119 8 256 8s248 111 248 248zM273 369.9l135.5-135.5c9.4-9.4 9.4-24.6 0-33.9l-17-17c-9.4-9.4-24.6-9.4-33.9 0L256 285.1 154.4 183.5c-9.4-9.4-24.6-9.4-33.9 0l-17 17c-9.4 9.4-9.4 24.6 0 33.9L239 369.9c9.4 9.4 24.6 9.4 34 0z">
                                </path>
                            </svg>
                        </span>
                        </div>
                        <div class="answer"><?php echo $question->answer?> </div>
                    </div>
                @endforeach
             @endif
            <div class="singleContent text-center"><a href="#">
               @lang('site.Do you have any questions or comments?')</a></div>
        </div>
    </section>


    <!--========================== End member page ==========================-->

@endsection
@section('script')

@endsection