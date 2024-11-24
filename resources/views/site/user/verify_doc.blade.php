@extends('site.layouts.appWithoutFooter')
@section('title')
<title>@lang('site.Documenting membership and adding licenses')</title>
@endsection
@section('style')

@endsection
@section('content')

  
    <!-- ===================== start verify license ======================== -->
    <section class="verify">
        <div class="container">
            <div>
                <a href="{{ url()->previous() }}">
                <span>
                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path>
                    </svg>
                </span>
                </a>
                <h3>@lang('site.Documenting membership and adding licenses')</h3>
                <p>@lang('site.Documenting your membership by linking it to your official information helps protect your membership and increase its credibility.')</p>
                <p>@lang('site.Some advertisements for products or services require an official license, and the member must raise the official license through this system. For example, advertising for commenting services requires a commenting license to practice the activity. Anyone who makes announcements about a comment must document his comment license. All official documents are kept in a secure manner and are only available for publication with official government agencies, if requested.')</p>
                <br>
                <div class="row">
                    <div class="licenses col-md-4">
                        <div class="hui-item" data-licence-type="cId">
                            <div class="card card-empty">
                                <div class="card-body text-center">
                                    <h4 class="card-body-title">@lang('site.Document image')</h4>
                                    <div class="empty-body-icon" style="cursor: pointer;"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="save" class="svg-inline--fa fa-save fa-w-14 fa-3x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M433.941 129.941l-83.882-83.882A48 48 0 0 0 316.118 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48V163.882a48 48 0 0 0-14.059-33.941zM288 64v96H96V64h192zm128 368c0 8.822-7.178 16-16 16H48c-8.822 0-16-7.178-16-16V80c0-8.822 7.178-16 16-16h16v104c0 13.255 10.745 24 24 24h208c13.255 0 24-10.745 24-24V64.491a15.888 15.888 0 0 1 7.432 4.195l83.882 83.882A15.895 15.895 0 0 1 416 163.882V432zM224 232c-48.523 0-88 39.477-88 88s39.477 88 88 88 88-39.477 88-88-39.477-88-88-88zm0 144c-30.879 0-56-25.121-56-56s25.121-56 56-56 56 25.121 56 56-25.121 56-56 56z"></path></svg></div>
                                    <a href="{{route('verify_doc_2')}}" class="btn button btn-primary">@lang('site.Add Documentation')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>




    <!-- ===================== End verify license ======================== -->




@endsection
@section('script')
@endsection