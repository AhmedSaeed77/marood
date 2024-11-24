@extends('site.layouts.app_without_header')
@section('style')
    @if(app()->getLocale() == 'en')
        <style>
            body {
                direction: ltr;
            }
        </style>
    @endif
@endsection
@section('content')

    <!--========================== Start add post page ==========================-->
    <section class="add-post-page">
        <div class="container">
            <div>
                <a href="javascript:history.back()">
                    <div>
                        <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right"
                             class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="currentColor"
                                  d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z">
                            </path>
                        </svg>
                    </div>
                </a>
                <div>
                    <span>
                        <h3>{{  $areas[0]['parent_id'] == null ? __('site.choose_ar') : ($areas[0]['is_area'] == 1 ? __('site.hay') : __('site.choose_ar_ch'))}}</h3>
                    </span>
                </div>

                @if($areas[0]['is_area'] == 1)
                    <div class="col-md-12 col-12">
                        <input style="width: 100%;padding:20px" type="text" id="search"
                               placeholder="{{__('site.search_for_hay')}}" data-id="{{request('area_id')}}">
                    </div>
                @endif

                <div id="areas-list">
                    @foreach($areas as $area)
                        <div class="listContFor2Items">
                            <div class="right">
                                <a href="{{url('/')}}/photo/add/post/{{$cat->id}}/{{$area->id}}">
                                    <div class="pad">{{$area->name}}</div>
                                </a>
                            </div>
                            <div>
                                @if(app()->getLocale() == 'en')
                                    <a href="">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fal"
                                             data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x"
                                             role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path fill="currentColor"
                                                  d="M216.464 36.465l-7.071 7.071c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.071c4.686 4.686 12.284 4.686 16.971 0l211.051-211.051c4.686-4.686 4.686-12.284 0-16.971L233.435 36.465c-4.686-4.686-12.284-4.686-16.971 0z">
                                            </path>
                                        </svg>
                                    </a>
                                @else
                                    <a href="">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fal"
                                             data-icon="arrow-left" class="svg-inline--fa fa-arrow-left fa-w-14 fa-2x"
                                             role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path fill="currentColor"
                                                  d="M231.536 475.535l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L60.113 273H436c6.627 0 12-5.373 12-12v-10c0-6.627-5.373-12-12-12H60.113L238.607 60.506c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0L3.515 247.515c-4.686 4.686-4.686 12.284 0 16.971l211.051 211.05c4.686 4.686 12.284 4.686 16.97-.001z">
                                            </path>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
    <!--========================== End add post page ==========================-->

@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#search').on('keyup', function () {
                var query = $(this).val();
                var area_id = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route('areas.search') }}",
                    type: "GET",
                    data: {
                        'query': query,
                        'id': area_id
                    },
                    success: function (data) {
                        
                        var name = '';
                        @if(app()->getLocale() == 'en')
                            name = data.name_en;
                        @else
                            name = data.name_ar;
                        @endif
                        var html = '';
                            html += '<div class="listContFor2Items">';
                            html += '<div class="right"><a href="{{ url('/') }}/photo/add/post/' + "{{$cat->id}}/" + data.id + '"><div class="pad">' + name + '</div></a></div>';
                            html += '<div><a href=""><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.071c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.071c4.686 4.686 12.284 4.686 16.971 0l211.051-211.051c4.686-4.686 4.686-12.284 0-16.971L233.435 36.465c-4.686-4.686-12.284-4.686-16.971 0z"></path></svg></a></div>';
                            html += '</div>';
                        $('#areas-list').html(html);
                    }
                });
            });
        });
    </script>
@endsection
