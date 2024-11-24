@extends('site.layouts.app')

@section('content')

    <!-- ========================== start follow page =============================== -->
    <section class="contact_page">
        <div class="container">
            <a href="javascript:history.back()" class=" btn backButton btn-link">
                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path>
                </svg>
                <br>
            </a>
            <div class="singleContent">
                <div class="contact-clean">
                    <form method="post" action="{{route('store_contact')}}" enctype="multipart/form-data">
                        @csrf
                        <h2 class="text-center">@lang('site.contact us')</h2>
                        <div class="form-group"></div>
                          <div class="form-group"><label>@lang('site.email')</label>
                     <input type="email" name="email"class="form-control" value="{{Auth::check()?auth::user()->email:''}}" required/></div>
                     
                        <div class="form-group"><label>@lang('site.reason for contact')</label>
                        <select class="form-control" required name="contactUsReason">
                            <option value=""  disabled selected>@lang('site.choose reason')</option>
                          @foreach($reasons as $reason)
                          <option value="{{$reason->id}}">{{$reason->title}}</option>
                          @endforeach
                            </select></div>
                        <div class="form-group"><label>@lang('site.message')</label><textarea class="form-control" name="message" cols="6" rows="5" required></textarea></div>
                        <div class="form-group"></div>
                        <div class="form-group"><label>@lang('site.photo or video for problem')</label><input name="files" type="file"  accept="image/*" style="display: block;"></div>
                          <div class="form-group"><label>@lang('site.phone')</label>
                     <input type="text" name="phone"class="form-control" value="{{Auth::check()?auth::user()->phone:''}}" required/></div>
                     
                        <div class="form-group"><button class="btn-lg btn-primary-alt" type="submit">send</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================== End follow page =============================== -->


@endsection