@extends('site.layouts.appWithoutFooter')
@section('title')
<title>@lang('site.Document image')</title>
@endsection
@section('style')

@endsection
@section('content')

    <!-- ===================== start verify license ======================== -->
    <section class="verify">
        <div class="container">
            <div>
                <div>
                    <a href="{{ url()->previous() }}">
                    <span>
                        <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path>
                        </svg>
                    </span>
                    <h3>
                    @lang('site.Document image')</h3>
                    <form method="post" action="{{route('store_verify_type')}}" enctype="multipart/form-data">
                        @csrf
                         <input type="hidden" name="type" value="2"/>
                        <div class="form-group">
                            <label for="Full_Name">@lang('site.Registered Name') <span class="red">*</span></label>
                            <input class="form-control form-control-size-md" id="Full_Name" name="name" type="text" required="" value="{{auth::user()->name??''}}">
                            <div>
                                <div class="form-group">
                                    <label for="national-id"><span class="red">*</span>@lang('site.Document Number')</label>
                                    <input class="form-control form-control-size-md" id="national-id" name="numberAsString" type="text" autocomplete="off" required="" value="">
                                </div>
                                <div class="form-group">
                                    <label>@lang('site.Document image')<span class="red">*</span></label>
                                    <div>
                                        <div class="image-uploader-wrapper">
                                            <div class="image-uploader-item" id="result">
                                                <label class="image-uploader-btn custom-center" for="input_license">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="camera" class="svg-inline--fa fa-camera fa-w-16 fa-3x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M324.3 64c3.3 0 6.3 2.1 7.5 5.2l22.1 58.8H464c8.8 0 16 7.2 16 16v288c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16V144c0-8.8 7.2-16 16-16h110.2l20.1-53.6c2.3-6.2 8.3-10.4 15-10.4h131m0-32h-131c-20 0-37.9 12.4-44.9 31.1L136 96H48c-26.5 0-48 21.5-48 48v288c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V144c0-26.5-21.5-48-48-48h-88l-14.3-38c-5.8-15.7-20.7-26-37.4-26zM256 408c-66.2 0-120-53.8-120-120s53.8-120 120-120 120 53.8 120 120-53.8 120-120 120zm0-208c-48.5 0-88 39.5-88 88s39.5 88 88 88 88-39.5 88-88-39.5-88-88-88z"></path>
                                                    </svg>
                                                </label>
                                                <input id="input_license" name="doc" accept="image/*" type="file" class="d-none">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Comment_Msg">@lang('site.notes')</label>
                                    <textarea class="form-control form-control-size-lg" rows="4" id="Comment_Msg" name="comment"></textarea>
                                </div>
                                <button type="submit" class="button btn-lg btn-success">@lang('site.Add membership authentication')</button>
                    </form>
                    </div>
                    </div>
                </div>
    </section>




    <!-- ===================== End verify license ======================== -->




@endsection
@section('script')
@endsection