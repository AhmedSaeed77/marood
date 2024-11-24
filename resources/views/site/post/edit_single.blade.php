@extends('site.layouts.appWithoutFooter')
@section('title')
<title>{{$post->title}}</title>
@endsection
@section('style')
<style>body{
    background: #F2F4FA;
}

 .edit-post-page input {
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        box-sizing: border-box;
        height: 100%;
        border: 1px solid #ccc;
        width: 97%;
    }
    
     .wrapper_card {
    display: block;
    line-height: 1.5;
    white-space: pre-wrap;
    direction: rtl;
    
     }
</style>
@endsection
@section('content')

    <!-- ========================== start edit page =============================== -->
    <section class="edit-post-page">
        <div class="container">
            <div class="postMain">

                <a href="javascript:history.back()" class="  backButton btn-link">
                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path>
                    </svg>
                </a>


                <div class="edit_post_wrapper">
                    <span class="change_city">
                        <button class="btn-borderless btn-location">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marker-alt" class="svg-inline--fa fa-map-marker-alt fa-w-12 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path>
                            </svg>
                            @if(!is_null($post->area_id))
                            <span>{{$post->area->name}}</span>
                            @endif
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-down" class="svg-inline--fa fa-chevron-down fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor" d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"></path>
                            </svg>
                        </button>

                    <div class="ddm_wrapper d-none">
                        <!--<span class="ddm_option">الى موقعي الحالي</span> -->
                        <span class="ddm_option" data-toggle="modal" data-target="#locationModal">@lang('site.choose area')</span>
                    </div>

                    </span>
                     <form action="{{route('update_single_user_post',$post->id)}}" method="post" enctype="multipart/form-data">
                         @csrf
                    <div class="wrapper_card edit_post_title">
                        <label class="card_label">@lang('site.edit post title')</label>
                        <input class="card_input" name="title" value="{{$post->title}}" required>
                    </div>
                    <!--<div class="wrapper_card edit_post_title">-->
                    <!--    <label class="card_label">@lang('site.edit post title en')</label>-->
                    <!--    <input class="card_input" name="title_en" value="{{$post->title_en}}">-->
                    <!--</div>-->
                    <div class="wrapper_card">
                        <label class="card_label">@lang('site.edit post description')</label>
                        <textarea id="editor" rows="20" name="desc" class="card_input">{{$post->description}}</textarea>
                    </div>
                    <div class="addPost">
                        <h3>@lang('site.edit photo')</h3><br><br>
                        <output class="uploadThumb" name="photo" id="result">
                        <br><br>
                    </div>
                    <div>
                        <div>
                            <div class="roww">
                            @foreach($post->images as $img)
                                @if($img->type==0)
                                <div class="col-lg-4 file-{{$img->id}}">
                                <div class="thumbContent">
                                    <img src="{{url('/')}}/public/storage/{{$img->image}}" class="file-{{$img->id}}">
                                    <div style="height: 5px; max-height: 5px; display: flex; justify-content: flex-start;">
                                    </div>
                                    <div class="buttonsWrapper">
                                        <span class="button btn-danger delete-image" data-id="{{ $img->id }}">حذف</span>
                        <span class="up-arrow"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-up" class="svg-inline--fa fa-arrow-up fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M4.465 263.536l7.07 7.071c4.686 4.686 12.284 4.686 16.971 0L207 92.113V468c0 6.627 5.373 12 12 12h10c6.627 0 12-5.373 12-12V92.113l178.494 178.493c4.686 4.686 12.284 4.686 16.971 0l7.07-7.071c4.686-4.686 4.686-12.284 0-16.97l-211.05-211.05c-4.686-4.686-12.284-4.686-16.971 0L4.465 246.566c-4.687 4.686-4.687 12.284 0 16.97z"></path></svg></span>
                        <span class="down-arrow"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-down" class="svg-inline--fa fa-arrow-down fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M443.5 248.5l-7.1-7.1c-4.7-4.7-12.3-4.7-17 0L241 419.9V44c0-6.6-5.4-12-12-12h-10c-6.6 0-12 5.4-12 12v375.9L28.5 241.4c-4.7-4.7-12.3-4.7-17 0l-7.1 7.1c-4.7 4.7-4.7 12.3 0 17l211 211.1c4.7 4.7 12.3 4.7 17 0l211-211.1c4.8-4.8 4.8-12.3.1-17z"></path></svg></span>

                                    </div>
                                    <div style="color: rgb(208, 51, 51); display: flex; flex-direction: column; align-items: center;">
                                        <span>
                                        </span>
                                    </div>
                                </div>
                                </div>
                                @endif
                            @endforeach
                            </div>
                            <input multiple type="file" accept="image/jpg, image/gif,image/png" name="photos[]" id="files-6" class="d-none" multiple>
                            <label class="button  btn-lg btn-info mt-1" for="files-6">
                                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="camera" class="svg-inline--fa fa-camera fa-w-16 fa-1x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M324.3 64c3.3 0 6.3 2.1 7.5 5.2l22.1 58.8H464c8.8 0 16 7.2 16 16v288c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16V144c0-8.8 7.2-16 16-16h110.2l20.1-53.6c2.3-6.2 8.3-10.4 15-10.4h131m0-32h-131c-20 0-37.9 12.4-44.9 31.1L136 96H48c-26.5 0-48 21.5-48 48v288c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V144c0-26.5-21.5-48-48-48h-88l-14.3-38c-5.8-15.7-20.7-26-37.4-26zM256 408c-66.2 0-120-53.8-120-120s53.8-120 120-120 120 53.8 120 120-53.8 120-120 120zm0-208c-48.5 0-88 39.5-88 88s39.5 88 88 88 88-39.5 88-88-39.5-88-88-88z"></path>
                                </svg>@lang('site.choose post pictures')
                            </label>
                            <input name="imagesList" type="hidden">
                        </div>
                        <br>
                        <div id="dropMsg" style="opacity: 0;">
                            <h1>@lang('site.Add photo')</h1>
                        </div>
                    </div>
                    <div id="upload-video">
                        <div class="row">
                        @foreach($post->images as $img)
                            @if($img->type==1)
                            <div class="col-lg-4 file-{{$img->id}}">
                                <div class="thumbContent">
                                    <div>
                                    <video  controls>
                                        <source src="{{url('/')}}/public/storage/{{$img->image}}" class="d-none" type="video/mp4">
                                        Your browser does not support the video tag.
                                        </source>
                                    <video>
                                    </div>
                                    <div class="buttonsWrapper">
                                        <span class="button btn-danger delete-image" data-id="{{ $img->id }}">حذف</span>
                        <!--<span class="up-arrow"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-up" class="svg-inline--fa fa-arrow-up fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M4.465 263.536l7.07 7.071c4.686 4.686 12.284 4.686 16.971 0L207 92.113V468c0 6.627 5.373 12 12 12h10c6.627 0 12-5.373 12-12V92.113l178.494 178.493c4.686 4.686 12.284 4.686 16.971 0l7.07-7.071c4.686-4.686 4.686-12.284 0-16.97l-211.05-211.05c-4.686-4.686-12.284-4.686-16.971 0L4.465 246.566c-4.687 4.686-4.687 12.284 0 16.97z"></path></svg></span>-->
                        <!--<span class="down-arrow"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-down" class="svg-inline--fa fa-arrow-down fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M443.5 248.5l-7.1-7.1c-4.7-4.7-12.3-4.7-17 0L241 419.9V44c0-6.6-5.4-12-12-12h-10c-6.6 0-12 5.4-12 12v375.9L28.5 241.4c-4.7-4.7-12.3-4.7-17 0l-7.1 7.1c-4.7 4.7-4.7 12.3 0 17l211 211.1c4.7 4.7 12.3 4.7 17 0l211-211.1c4.8-4.8 4.8-12.3.1-17z"></path></svg></span>-->

                                    </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        </div>
                        <div class="upload-preview mt-5" id="result-video"></div>
                        <input type="file" accept="video/*" name="videos[]" id="files-7" class="d-none">
                        <label class="button btn-lg btn-info mt-1" for="files-7">
                            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="video-plus" class="svg-inline--fa fa-video-plus fa-w-18 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M543.9 96c-6.2 0-12.5 1.8-18.2 5.7L416 171.6v-59.8c0-26.4-23.2-47.8-51.8-47.8H51.8C23.2 64 0 85.4 0 111.8v288.4C0 426.6 23.2 448 51.8 448h312.4c28.6 0 51.8-21.4 51.8-47.8v-59.8l109.6 69.9c5.7 4 12.1 5.7 18.2 5.7 16.6 0 32.1-13 32.1-31.5v-257c.1-18.5-15.4-31.5-32-31.5zM384 192v208.2c0 8.6-9.1 15.8-19.8 15.8H51.8c-10.7 0-19.8-7.2-19.8-15.8V111.8c0-8.6 9.1-15.8 19.8-15.8h312.4c10.7 0 19.8 7.2 19.8 15.8V192zm160 192.5l-1.2-1.3L416 302.4v-92.9L544 128v256.5zM296 240h-72v-72c0-4.4-3.6-8-8-8h-16c-4.4 0-8 3.6-8 8v72h-72c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h72v72c0 4.4 3.6 8 8 8h16c4.4 0 8-3.6 8-8v-72h72c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8z"></path>
                            </svg>@lang('site.upload video')
                        </label>
                        <p>@lang('site.* The length of the video must not exceed 30 seconds')</p>
                    </div>
                    <div class="wrapper_card"><label class="card_label">@if($post->contact==1){{$post->mobile??''}} @else @lang('site.Communicate on private') @endif</label><input placeholder="@lang('site.Communicate on private')" class="card_input" name="mobile" value="{{$post->mobile??''}}"></div>

                    <!--------------------------------------- Start Area Map -------------------------------------->

                    @if(!is_null($post->lat) && !is_null($post->lng))
                        @if($post->Cat->parent_id == '4033' || $post->Cat->parent_id == '4034')
                        <div id="map">
                            <div class="wrapper_card">
                            <label class="card_label">@lang('site.edit your area')</label>
                            </div>
                            <div class="custom-padding">
                                <div id="mapid" style="width: 500px; height: 500px;"></div>
                            </div>
                        </div>
                        @endif
                    @endif
                    <input value="{{ old('lat') }}" name="lat" id="lat" value="" style="display:none">
        			<input value="{{ old('lng') }}" name="lng" id="lng" value="" style="display:none">

                    <!--------------------------------------- End Area Map -------------------------------------->
                    <!--------------------------------------- Start Edit Catrgories -------------------------------------->
                    <div class="tag_selection_wrapper mt-3">
                            <div class="tag_selection_wrapper">

                                    <?php
                                    // dd($post);
                                    if($post->Cat->id != '4030'){


                                    $cat=$post->Cat->parent;
                                    $parent=$cat;

                                    if(!is_null($parent)){
                                        if($parent->parent_id != null){
                                         while(!empty($parent->parent)){
                                            $parent=$parent->parent;
                                            }
                                        }
                                    }else{
                                        $cat = $post->Cat;
                                        $parent = $cat;
                                        if($parent->parent_id != null){
                                         while(!empty($parent->parent)){
                                            $parent=$parent->parent;
                                            }
                                        }
                                    }
                                    $model=App\Models\setting::where('name','modelNumber')->first()->value;
                                    }else{
                                        $cat = $post->cat;
                                        $parent = $post->cat;
                                    }
                                    ?>
                                {{-- dd($post->Cat) --}} <!-- Sub Sub Cat -->
                                {{-- dd($post->Cat->parent) --}} <!-- Sub Cat -->
                                {{-- dd($post->Cat->parent)->parent) --}} <!-- Main Cat -->
                                <input type="hidden" value="{{$cat->id}}" name="cat_id">
                                {{-- dd( $cat->id ) --}}
                                <div class="row">
                                    @if($cat->id != '4030')
                                    <!-- All Categories Selects -->
                                    <div class="catParent col-md-3">
                                    @if(!is_null($post->Cat->parent) && !is_null(($post->Cat->parent)->parent))
                                    <select class="cat" required>
                                        <option value="" selected disabled>@lang('site.choose category')</option>
                                    @foreach($cats as $child)
                                        <option value="{{$child->id}}" {{ ($post->Cat->parent)->parent->id == $child->id ? 'selected' : ''}}>{{$child->name}}</option>
                                    @endforeach
                                    </select>
                                    @elseif(!is_null($post->Cat->parent))
                                    <select class="cat" required>
                                        <option value="" selected disabled>@lang('site.choose category')</option>
                                    @foreach($cats as $child)
                                        <option value="{{$child->id}}" {{ ($post->Cat->parent)->id == $child->id ? 'selected' : ''}}>{{$child->name}}</option>
                                    @endforeach
                                    </select>
                                    @else
                                    <!-- Tools And Spare Parts For Cars And trucks -->
                                    <select name="cat" class="cat" required>
                                        <option value="" selected disabled>@lang('site.choose category')</option>
                                    @foreach($cats as $child)
                                        <option value="{{$child->id}}" {{ $post->Cat->id == $child->id ? 'selected' : ''}}>{{$child->name}}</option>
                                    @endforeach
                                    </select>
                                    @endif
                                    </div>
                                    <div class="sub_cat col-md-3">
                                        <select name="cat" onchange="subCat()" class="cat'+cat_id+'">
                                            <option value="" selected disabled>@lang('site.choose category')</option>
                                            @if(!is_null($post->Cat->parent) && !is_null(($post->Cat->parent)->parent))
                                                @php
                                                $cat_sub = ($post->Cat->parent)->parent->id;
                                                $sub_cats = App\Models\Cat::where('parent_id', $cat_sub)->get();
                                                @endphp
                                            @foreach($sub_cats as $sub_Cat)
                                                <option value="{{$sub_Cat->id}}" {{ $post->Cat->parent->id == $sub_Cat->id ? 'selected' : ''}}>{{$sub_Cat->name}}</option>
                                            @endforeach
                                            @elseif(!is_null($post->Cat->parent))
                                                @php
                                                $cat_sub = $post->Cat->parent->id;
                                                $sub_cats = App\Models\Cat::where('parent_id', $cat_sub)->get();
                                                @endphp
                                                @foreach($sub_cats as $sub_Cat)
                                                    <option value="{{$sub_Cat->id}}" {{  $post->Cat->id == $sub_Cat->id ? 'selected' : ''}}>{{$sub_Cat->name}}</option>
                                                @endforeach
                                            @else
                                                @php
                                                $cat_sub = $post->Cat->id;
                                                $sub_cats = App\Models\Cat::where('parent_id', $cat_sub)->get();
                                                @endphp
                                                @foreach($sub_cats as $sub_Cat)
                                                    <option value="{{$sub_Cat->id}}" {{ $post->Cat->id == $sub_Cat->id ? 'selected' : ''}}>{{$sub_Cat->name}}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                    </div>
                                    <div class="catChild col-md-3">
                                        @if(!is_null($post->Cat->parent) && !is_null(($post->Cat->parent)->parent))
                                        <select name="cat" onchange="subCat()" class=" cat'+cat_id+'">
                                            <option value="" selected disabled>@lang('site.choose category')</option>

                                            @php
                                            $sub_cats = App\Models\Cat::where('parent_id', $post->Cat->parent->id )->get();
                                            @endphp
                                            @foreach($sub_cats as $sub_Cat)
                                                <option value="{{$sub_Cat->id}}" {{ $post->Cat->id == $sub_Cat->id ? 'selected' : ''}}>{{$sub_Cat->name}}</option>
                                            @endforeach
                                            </select>
                                            @endif
                                    </div>

                                <div class="col-md-3">
                                @if($parent->is_year==1)
                                <select name="model" class="model_year" required>
                                    <option value="" selected disabled>@lang('site.choose model')</option>

                                @for($i=date("Y") ;$i >= $model; $i--)
                                    <option value="{{$i}}" {{ $post->model == $i ? 'selected':''}}>{{$i}}</option>
                                @endfor
                                </select>
                                @endif
                                <select name="model" class="model">
                                    <option value="" selected disabled>@lang('site.choose model')</option>

                                @for($i=date("Y") ;$i >= $model; $i--)
                                    <option value="{{$i}}" {{ $post->model == $i ? 'selected':''}}>{{$i}}</option>
                                @endfor
                                </select>
                                </div>
                                @else
                                    <div class="row">
                                       <!-- Start Main Cat -->
                                        <div class="catParent col-md-3" >
                                            @if(!is_null($cat))
                                            <select class="cat" name="cat" required>
                                                <option value="" selected disabled>@lang('site.choose category')</option>
                                            @foreach($cats as $child)
                                                <option value="{{$child->id}}" {{ $post->Cat->id == $child->id ? 'selected' : ''}}>{{$child->name}}</option>
                                            @endforeach
                                            </select>
                                            @endif
                                        </div>
                                        <!-- End Main Cat --><!-- Start sub Cat -->
                                        <div class="sub_cat col-md-3">
                                            <div class="items sub_item">
                                            @php
                                                $cat_sub = $post->Cat->id;
                                                $selects = json_decode($post->brands_id);
                                            @endphp
                                            @php
                                                $cat_select = App\Models\Cat::find($selects[0]);
                                                if(($cat_select->parent)->parent->id == 4030){
                                                    $cat_select_parent = ($cat_select->parent->id);
                                                }else{
                                                    $cat_select_parent = (($cat_select->parent)->parent->id);
                                                }
                                            @endphp


                                            <select name="cat" onchange="subCat()" id="catSub">
                                                <option value="" selected disabled>@lang('site.choose category')</option>
                                                @foreach($post->Cat->child as $sub_Cat)
                                                    <option value="{{$sub_Cat->id}}" {{ $sub_Cat->id == $cat_select_parent  ? 'selected' : ''}} > {{$sub_Cat->name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <!-- End sub Cat -->
                                        @if($cat_select_parent != '4044')
                                        <!-- Start Sub Cat -->
                                        <div class="catChild col-md-3">
                                            <div class="items child_item">
                                            @php
                                                $selects = json_decode($post->brands_id);
                                            @endphp
                                            @php
                                                $cat_select = App\Models\Cat::find($selects[0]);
                                                $cat_select_parent = (($cat_select->parent)->id);
                                            @endphp
                                            @if(!is_null( ($post->Cat->child)[0]->child) )
                                            <select name="cat" onchange="spare_Cat()" id="spareChild" class="childCat">
                                                <option value="" selected disabled>@lang('site.choose category')</option>
                                                @foreach(($post->Cat->child)[0]->child as $sub_Cat)
                                                    <option value="{{$sub_Cat->id}}" {{ $sub_Cat->id == $cat_select_parent  ? 'selected' : ''}} > {{$sub_Cat->name}}</option>
                                                @endforeach
                                            </select>
                                            @endif
                                            </div>
                                        </div>
                                        <!-- End Sub Cat -->
                                        @endif
                                        <!-- Start Brands Cat -->
                                        <div class="spareItems col-md-3">
                                            <div class="items spare_item">

                                            @php
                                                $cat_sub = $post->Cat->id;
                                                $selects = json_decode($post->brands_id);
                                                $cat_select = App\Models\Cat::find($selects[0]);
                                                $parent_sub_cat = $cat_select->parent->id;
                                                $cat_main_subs = App\Models\Cat::where('parent_id', $parent_sub_cat)->get();
                                            @endphp

                                            @if(!is_null($post->Cat))
                                            <select name="brands[]" class="spareCat" id="spareParts" multiple>
                                                <option value="" selected disabled>@lang('site.choose category')</option>
                                                @foreach($cat_main_subs as $sub_Cat)
                                                    <option value="{{$sub_Cat->id}}" {{ $sub_Cat->id == in_array( $sub_Cat->id ,$selects )  ? 'selected' : ''}} > {{$sub_Cat->name}}</option>
                                                @endforeach
                                            </select>
                                            @endif
                                            </div>
                                        </div>
                                        <!-- End Brands Cat -->
                                        <!-- Start Model Year -->
                                        <div class="col-md-3">
                                            @php
                                            $cat=$post->Cat->parent;
                                            $parent=$cat;
                                            if(!is_null($parent)){
                                                if($parent->parent_id != null){
                                                 while(!empty($parent->parent)){
                                                    $parent=$parent->parent;
                                                    }
                                                }
                                            }else{
                                                $cat = $post->Cat;
                                                $parent = $cat;
                                                if($parent->parent_id != null){
                                                 while(!empty($parent->parent)){
                                                    $parent=$parent->parent;
                                                    }
                                                }
                                            }
                                            @endphp
                                            @if($parent->is_year==1)
                                            <select name="model" class="model_year" required>
                                                <option value="" selected disabled>@lang('site.choose model')</option>

                                            @for($i=date("Y") ;$i >= $model; $i--)
                                                <option value="{{$i}}" {{ $post->model == $i ? 'selected':''}}>{{$i}}</option>
                                            @endfor
                                            </select>
                                            @endif
                                            <select name="model" class="model">
                                                <option value="" selected disabled>@lang('site.choose model')</option>

                                            @for($i=date("Y") ;$i >= 1990; $i--)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                            </select>

                                        </div>
                                        <!-- End Model Year -->
                                    </div>
                                @endif
                                </div>
                            </div>
                        </div>
                        <!--------------------------------------- End Edit Catrgories -------------------------------------->
                        
                        
                          {{-- start data of real state---------------------------------------------------------------------------------------- --}}

                     @if($post->Cat->type == 2 && $post->Cat->parent_id == 5)

                             <div  class="show-real-state">
                                 <select name="street" class="custom-select mt-3">
                                     <option value="" disabled selected>@lang('site.street')</option>
                                     <option value="residential" {{$post->street == 'residential' ? 'selected' : ''}}>@lang('site.residential')</option>
                                     <option value="commercial" {{$post->street == 'commercial' ? 'selected' : ''}}>@lang('site.commercial')</option>
                                 </select>
                                 <br>

                                 <label class="mt-2">@lang('site.space')</label><br>
                                 <input type="number" name="space" min="1" value="{{$post->space}}"><br>

                                 <label class="mt-2">@lang('site.age_of_state')</label><br>
                                 <input name="age_of_state" type="range" id="rangeInput" min="1" max="100" value="{{$post->age_of_state}}"> <span id="rangeValue">{{$post->age_of_state}}</span><br>

                                 <label class="mt-2">@lang('site.destination')</label><br>
                                 <select class="custom-select" name="destination">
                                     <option value="" disabled selected>@lang('site.destination_choose')</option>
                                     <option value="north" {{$post->destination == 'north' ? 'selected' : ''}}>@lang('site.north')</option>
                                     <option value="south" {{$post->destination == 'south' ? 'selected' : ''}}>@lang('site.south')</option>
                                     <option value="east" {{$post->destination == 'east' ? 'selected' : ''}}>@lang('site.east')</option>
                                     <option value="west" {{$post->destination == 'west' ? 'selected' : ''}}>@lang('site.west')</option>
                                     <option value="southeast" {{$post->destination == 'southeast' ? 'selected' : ''}}>@lang('site.southeast')</option>
                                     <option value="southwest" {{$post->destination == 'southwest' ? 'selected' : ''}}>@lang('site.southwest')</option>
                                      <option value="northeast" {{$post->destination == 'northeast' ? 'selected' : ''}}>@lang('site.northeast')</option>
                                     <option value="northwest" {{$post->destination == 'northwest' ? 'selected' : ''}}>@lang('site.northwest')</option>
                                     <option value="three_streets" {{$post->destination == 'three_streets' ? 'selected' : ''}}>@lang('site.three_streets')</option>
                                     <option value="four_streets" {{$post->destination == 'four_streets' ? 'selected' : ''}}>@lang('site.four_streets')</option>
                                 </select>
                                 <br>

                                 <label class="mt-2">@lang('site.street_width')</label><br>
                                 <select class="custom-select" name="street_width">
                                     <option value="" disabled selected>@lang('site.street_width_choose')</option>
                                     <option value="6" {{$post->street_width == 6 ? 'selected' : ''}}>6</option>
                                     <option value="10" {{$post->street_width == 10 ? 'selected' : ''}}>10</option>
                                     <option value="12" {{$post->street_width == 12 ? 'selected' : ''}}>12</option>
                                     <option value="15" {{$post->street_width == 15 ? 'selected' : ''}}>15</option>
                                     <option value="18" {{$post->street_width == 18 ? 'selected' : ''}}>18</option>
                                     <option value="20" {{$post->street_width == 20 ? 'selected' : ''}}>20</option>
                                     <option value="25" {{$post->street_width == 25 ? 'selected' : ''}}>25</option>
                                     <option value="30" {{$post->street_width == 30 ? 'selected' : ''}}>30</option>
                                     <option value="40" {{$post->street_width == 40 ? 'selected' : ''}}>40</option>
                                     <option value="60" {{$post->street_width == 60 ? 'selected' : ''}}>60</option>
                                     <option value="80" {{$post->street_width == 80 ? 'selected' : ''}}>80</option>
                                     <option value="100" {{$post->street_widt == 100 ? 'selected' : ''}}>100</option>
                                 </select>
                                 <br>

                                 <label class="mt-2">@lang('site.rooms_number')</label><br>
                                 <input name="rooms_number" type="range" id="rangeInput1" min="1" max="8" value="{{$post->rooms_number}}"> <span id="rangeValue1">{{$post->rooms_number}}</span><br>

                                 <label class="mt-2">@lang('site.number_of_halls')</label><br>
                                 <input name="number_of_halls" type="range" id="rangeInput2" min="1" max="8" value="{{$post->number_of_halls}}"> <span id="rangeValue2">{{$post->number_of_halls}}</span><br>

                                 <label class="mt-2">@lang('site.number_of_bathrooms')</label><br>
                                 <input name="number_of_bathrooms" type="range" id="rangeInput3" min="1" max="8" value="{{$post->number_of_bathrooms}}"> <span id="rangeValue3">{{$post->number_of_bathrooms}}</span><br>

                                 <label class="mt-2">@lang('site.villa_type')</label><br>
                                 <select class="custom-select" name="villa_type">
                                     <option value="" disabled selected>@lang('site.villa_type_choose')</option>
                                     <option value="independent"  {{$post->villa_type == 'independent' ? 'selected' : ''}}>@lang('site.independent')</option>
                                     <option value="duplex"  {{$post->villa_type == 'duplex' ? 'selected' : ''}}>@lang('site.duplex')</option>
                                     <option value="townhouse"  {{$post->villa_type == 'townhouse' ? 'selected' : ''}}>@lang('site.townhouse')</option>
                                     <option value="with_apartments"  {{$post->villa_type == 'with_apartments' ? 'selected' : ''}}>@lang('site.with_apartments')</option>
                                 </select>
                                 <br>

                                 <label class="mt-2">@lang('site.additional_options')</label><br>
                                 <select class="custom-select" name="additional_options[]" multiple>
                                     <option value="" disabled>@lang('site.additional_options_choose')</option>
                                     <option value="equipped_kitchen" {{in_array('equipped_kitchen',$list) ? 'selected'  : ''}}>@lang('site.equipped_kitchen')</option>
                                     <option value="feminine" {{in_array('feminine',$list) ? 'selected'  : ''}}>@lang('site.feminine')</option>
                                     <option value="driver_room" {{in_array('driver_room',$list) ? 'selected'  : ''}}>@lang('site.driver_room')</option>
                                     <option value="maid_room" {{in_array('maid_room',$list) ? 'selected'  : ''}}>@lang('site.maid_room')</option>
                                     <option value="there_is_a_fireplace" {{in_array('there_is_a_fireplace',$list) ? 'selected'  : ''}}>@lang('site.there_is_a_fireplace')</option>
                                     <option value="appendix"  {{in_array('appendix',$list) ? 'selected'  : ''}}>@lang('site.appendix')</option>
                                     <option value="car_entrance"  {{in_array('car_entrance',$list) ? 'selected'  : ''}}>@lang('site.car_entrance')</option>
                                     <option value="elevator"  {{in_array('elevator',$list) ? 'selected'  : ''}}>@lang('site.elevator')</option>
                                     <option value="vault"  {{in_array('vault',$list) ? 'selected'  : ''}}>@lang('site.vault')</option>
                                     <option value="air_conditioning"  {{in_array('air_conditioning',$list) ? 'selected'  : ''}}>@lang('site.air_conditioning')</option>
                                     <option value="swimming_pool"  {{in_array('swimming_pool',$list) ? 'selected'  : ''}}>@lang('site.swimming_pool')</option>
                                     <option value="drawer"  {{in_array('drawer',$list) ? 'selected'  : ''}}>@lang('site.drawer')</option>
                                     <option value="monsters"  {{in_array('monsters',$list) ? 'selected'  : ''}}>@lang('site.monsters')</option>
                                 </select>
                                 <br>
                             </div>

                         @endif
                         {{-- end data of real state-------------------------------------------------------------------------------------- --}}


                    <div class="save_btn_wrapper">
                    <button class="btn-borderless cancel_btn">@lang('site.cancel')</button>
                    <button type="submit" class="btn-borderless save_btn" id="save_btn">@lang('site.save changes')</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================== End edit page =============================== -->


       <!--============= start delete post ===============-->

       <div class="modal fade customModal" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                </div>
                <div class="modalWrapper">
                    <div style="height: 95%; overflow: auto;">
                        <div>
                            <div>
                                <span>
                                    <h3>@lang('site.choose area')</h3>
                                </span>
                            </div>
                            @foreach($post->Area->parent->child as $child)
                            <div class="listContFor2Items">
                                <div class="right"><a href="#" Class="AreaSelect" id="{{$child->id}}">{{$child->name}}</a></div>
                                <div>
                                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-left" class="svg-inline--fa fa-arrow-left fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M231.536 475.535l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L60.113 273H436c6.627 0 12-5.373 12-12v-10c0-6.627-5.373-12-12-12H60.113L238.607 60.506c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0L3.515 247.515c-4.686 4.686-4.686 12.284 0 16.971l211.051 211.05c4.686 4.686 12.284 4.686 16.97-.001z"></path>
                                    </svg>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--============= End delete post ===============-->


    @endsection
    @section('script')
    <script src="https://cdn.tiny.cloud/1/zuuzfjvupk9ggqvlcvvl5g0jiff9li7fsix2af1qqwnn91vi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
    //   tinymce.init({
    //     selector: 'textarea#editor',
    //     skin: 'bootstrap',
    //     plugins: 'lists, link, image, media',
    //     toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
    //     menubar: false
    //   });


        $('.model').hide();

    /*================================== Start Sub Categrories ======================================*/
    $(".cat").on('change',function(){
        var cat_id=$(this).val();
        if(cat_id == 5 || cat_id == 4033 || cat_id == 4034){
            $('#map').show();
        }else{
            $('#map').hide();
        }
        $('.childCat').remove();
        $('#spareParts').remove();
        $('#catSub').remove();
        $.ajax({
        url:'{{ route('get_subcat') }}',
        type:'post',
        data: {
            id : cat_id,
            _token: "{{ csrf_token() }}"
         },success:function(res){
                $('.subcat').remove();
                $('.model').hide();
                $('.model_year').remove();
            if(res != ''){
            $(".sub_cat").html('<select name="cat" onchange="subCat()" class="subcat cat'+cat_id+'" id="catSub" required><option value="" selected disabled>@lang("site.choose category")</option></select>');
                $.each(res, function( n , val ) {
                    $('.sub_cat .cat'+cat_id).append('<option value="'+ val.id +'">'+ val.name_ar +'</option>');
                });
                console.log(res);
                var x = $('select').hasClass("subcat");

            }else{}
         },error:function(err){
             console.log(err);
         }
    });

        $.ajax({
            url:'{{ route('get_cat_year') }}',
            type:'post',
            data: {
                id : cat_id,
                _token: "{{ csrf_token() }}"
             },success:function(res){
                   console.log();
                   if(res['is_year'] == 1){
                       $('.model_year').remove();
                       $('.model').show();
                   }
             },error:function(err){
                 console.log(err);
             }
        });
    });


    function subCat(){
        var cat_id= $($('#catSub')).val();
        $('.childCat').remove();
        $('#spareParts').remove();
        $('.model').hide();
        $.ajax({
        url:'{{ route('get_subcat') }}',
        type:'post',
        data: {
            id : cat_id,
            _token: "{{ csrf_token() }}"
         },success:function(res){
            if(res != ''){

                $(".catChild").html('<select name="cat" onchange="spare_Cat()" id="catChild" class="childCat cat cat'+cat_id+'" required><option value="" selected disabled>@lang("site.choose category")</option></select>');
                $.each(res, function( n , val ) {
                    $('.catChild .cat'+cat_id).append('<option value="'+ val.id +'">'+ val.name_ar +'</option>');

                });

                $.ajax({
                    url:'{{ route('get_cat_year') }}',
                    type:'post',
                    data: {
                        id : cat_id,
                        _token: "{{ csrf_token() }}"
                     },success:function(res){
                           console.log();
                           if(res['is_year'] == 1){
                               $('.model_year').remove();
                               $('.model').show();
                           }
                     },error:function(err){
                         console.log(err);
                     }
                });
            }else{}
         },error:function(err){
             console.log(err);
         }
    });
    }


    function spare_Cat(){
        var cat_id= $($('#catChild')).val();
        $('.spareCat').remove();
        $.ajax({
        url:'{{ route('get_subcat') }}',
        type:'post',
        data: {
            id : cat_id,
            _token: "{{ csrf_token() }}"
         },success:function(res){
            if(res != ''){

                $(".spareItems").html('<select name="brands[]" class="sparecat cat cat'+cat_id+'" id="spareParts" multiple required><option value="" selected disabled>@lang("site.choose category")</option></select>');
                $.each(res, function( n , val ) {
                    $('.spareItems .cat'+cat_id).append('<option value="'+ val.id +'">'+ val.name_ar +'</option>');
                });

            }else{}
         },error:function(err){
             console.log(err);
         }
    });
    }


    /*================================== End Sub Categrories ======================================*/
    /*================================== Start Child Categrories ======================================*/

    /*================================== End Child Categrories ======================================*/
        /*================================== settings of add images and videos ======================================*/

        window.onload = function() {

            //Check File API support
            if (window.File && window.FileList && window.FileReader) {
                var filesInput_6 = document.getElementById("files-6");
                var filesInput_7 = document.getElementById("files-7");



                filesInput_6.addEventListener("change", function(event) {

                    var files = event.target.files; //FileList object
                    var output = document.getElementById("result");

                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];

                        //Only pics
                        if (!file.type.match('image'))
                            continue;

                        var picReader = new FileReader();

                        picReader.addEventListener("load", function(event) {

                            var picFile = event.target;

                            var div = document.createElement("div");

                            div.innerHTML = `<div class="thumWrapper" id="thumWrapper">
                    <div class="thumbContent">
                        <img src="${picFile.result}" title="${picFile.name}"><div style="height: 5px; max-height: 5px; display: flex; justify-content: flex-start;">
                    </div>
                    <div class="buttonsWrapper">
                        <span class="button btn-danger delete">حذف</span>
                        <span class="up-arrow"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-up" class="svg-inline--fa fa-arrow-up fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M4.465 263.536l7.07 7.071c4.686 4.686 12.284 4.686 16.971 0L207 92.113V468c0 6.627 5.373 12 12 12h10c6.627 0 12-5.373 12-12V92.113l178.494 178.493c4.686 4.686 12.284 4.686 16.971 0l7.07-7.071c4.686-4.686 4.686-12.284 0-16.97l-211.05-211.05c-4.686-4.686-12.284-4.686-16.971 0L4.465 246.566c-4.687 4.686-4.687 12.284 0 16.97z"></path></svg></span>
                        <span class="down-arrow"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-down" class="svg-inline--fa fa-arrow-down fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M443.5 248.5l-7.1-7.1c-4.7-4.7-12.3-4.7-17 0L241 419.9V44c0-6.6-5.4-12-12-12h-10c-6.6 0-12 5.4-12 12v375.9L28.5 241.4c-4.7-4.7-12.3-4.7-17 0l-7.1 7.1c-4.7 4.7-4.7 12.3 0 17l211 211.1c4.7 4.7 12.3 4.7 17 0l211-211.1c4.8-4.8 4.8-12.3.1-17z"></path></svg></span>

                    </div>
                    <div style="color: rgb(208, 51, 51); display: flex; flex-direction: column; align-items: center;">
                        <span>
                        </span>
                    </div>
                </div>`;

                            output.insertBefore(div, null);

                            /*================================== remove btn i add post page ======================================*/
                            $('.thumWrapper .delete').click(function() {
                                $(this).parents('.thumWrapper').remove();
                            })

                        });

                        //Read the image
                        picReader.readAsDataURL(file);
                    }

                });

                filesInput_7.addEventListener("change", function(event) {

                    var files = event.target.files; //FileList object
                    var output_video = document.getElementById("result-video");

                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];

                        //Only pics
                        if (!file.type.match('video'))
                            continue;

                        var picReader = new FileReader();

                        picReader.addEventListener("load", function(event) {

                            var picFile = event.target;

                            var div = document.createElement("div");
                            div.classList.add('video-box');
                            div.innerHTML = `<video loop muted>
                                                <source src="${picFile.result}">
                                            </video>
                                            <div class="buttonsWrapper text-center">
                                                <span class="button btn-danger delete" style="padding: 5px 10px;">حذف</span>
                                            </div>`;

                            output_video.insertBefore(div, null);

                            /*================================== remove btn i add post page ======================================*/
                            $('.video-box .delete').click(function() {
                                $(this).parents('.video-box').remove();
                            })

                        });

                        //Read the image
                        picReader.readAsDataURL(file);
                    }

                    });

            } else {
                console.log("Your browser does not support File API");
            }
        }
        // ------------ Start delete images and videos ---------------------
        $('.delete-image').on('click',function(){
            
            var img_id = $(this).attr('data-id');
            $.ajax({
                url:"{{ url('delete/single/user_post/image') }}/"+img_id,
                method:'get',
                success:function(res){
                    console.log(res);
                    // x = JSON.parse(res);
                    $('.file-'+img_id).remove();
                    Swal.fire(
                      res['alert']['title'],
                      res['alert']['text'],
                      res['alert']['icon']
                    )
                    // location.reload();
                }
            })
        });

        $('.uploadThumb .buttonsWrapper button').on('click', function(e) {
            e.stopPropagation();
        });
    </script>
    <script>
     $('.AreaSelect').on('click',function(){
         var id=$(this).attr('id');
         $.ajax({
        url:'{{ route('update_area_post') }}',
        type:'post',
        data: {
            area_id : id,
            post_id:'{{$post->id}}',
            _token: "{{ csrf_token() }}"
         },success:function(res){
               window.location.reload();
            }

    });

     });

    function initialize() {
    var e = new google.maps.LatLng({{ $post->lat??0 }} , {{ $post->lng??0 }}), t = {
      zoom: 5,
      center: e,
      panControl: !0,
      scrollwheel: 1,
      scaleControl: !0,
      overviewMapControl: !0,
      overviewMapControlOptions: {opened: !0},
      mapTypeId: google.maps.MapTypeId.terrain
    };
    map = new google.maps.Map(document.getElementById("mapid"), t), geocoder = new google.maps.Geocoder, marker = new google.maps.Marker({
      position: e,
      map: map
    }), map.streetViewControl = !1, infowindow = new google.maps.InfoWindow({content: "(24.701925,46.675415)"}), google.maps.event.addListener(map, "click", function (e) {
      marker.setPosition(e.latLng);
      var t = e.latLng, o = "(" + t.lat().toFixed(6) + ", " + t.lng().toFixed(6) + ")";
      infowindow.setContent(o),
      document.getElementById("lat").value = t.lat().toFixed(6),
      document.getElementById("lng").value = t.lng().toFixed(6)
    })
  }

</script>


 <script>
        const rangeInput = document.getElementById('rangeInput');
        const rangeValue = document.getElementById('rangeValue');

        const rangeInput1 = document.getElementById('rangeInput1');
        const rangeValue1 = document.getElementById('rangeValue1');


        const rangeInput2 = document.getElementById('rangeInput2');
        const rangeValue2 = document.getElementById('rangeValue2');

        const rangeInput3 = document.getElementById('rangeInput3');
        const rangeValue3 = document.getElementById('rangeValue3');

        rangeInput.addEventListener('input', function() {
            rangeValue.textContent = rangeInput.value;
        });

        rangeInput1.addEventListener('input', function() {
            rangeValue1.textContent = rangeInput1.value;
        });


        rangeInput2.addEventListener('input', function() {
            rangeValue2.textContent = rangeInput2.value;
        });


        rangeInput3.addEventListener('input', function() {
            rangeValue3.textContent = rangeInput3.value;
        });
    </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwqrlZASdsR2P-KqDBBaGQrVFb7Uom2Uk&language=ar&callback=initialize"></script>

    @endsection
