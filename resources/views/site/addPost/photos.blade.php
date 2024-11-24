
@extends('site.layouts.app_without_header')
@section('style')
    @if(app()->getLocale() == 'en')
        <style>
            body{
                direction: ltr;
            }


        </style>
    @endif
@endsection
@section('content')

    <!--========================== Start add post page ==========================-->
    <section class="add-post-page">
        <div class="container">
            <form class="mb-5" action="{{route('post_infos_add_post',[$cat->id,$area->id])}}" enctype="multipart/form-data" method="post">
            @csrf
                <input  name="lat" id="lat" value="{{$location['lat'] ?? ''}}" style="display:none">
    			<input  name="lng" id="lng" value="{{$location['lng'] ?? ''}}" style="display:none">
                <a href="javascript:history.back()">
                    <div><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path></svg></div>
                </a>
                <div class="addPost">
                    <h3>@lang('site.upload photos')</h3><br><br>
                    <output class="uploadThumb" id="result">
                </div>
                <br>
                <br>
                <div>
                @if($parent->type==1)
                    <div style="display: flex; flex-wrap: wrap;">
                        {{--
                        <div class="second-input">
                            <label class="btn-lg btn-info mt-1" for="files-5">
                                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="camera" class="svg-inline--fa fa-camera fa-w-16 fa-1x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M324.3 64c3.3 0 6.3 2.1 7.5 5.2l22.1 58.8H464c8.8 0 16 7.2 16 16v288c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16V144c0-8.8 7.2-16 16-16h110.2l20.1-53.6c2.3-6.2 8.3-10.4 15-10.4h131m0-32h-131c-20 0-37.9 12.4-44.9 31.1L136 96H48c-26.5 0-48 21.5-48 48v288c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V144c0-26.5-21.5-48-48-48h-88l-14.3-38c-5.8-15.7-20.7-26-37.4-26zM256 408c-66.2 0-120-53.8-120-120s53.8-120 120-120 120 53.8 120 120-53.8 120-120 120zm0-208c-48.5 0-88 39.5-88 88s39.5 88 88 88 88-39.5 88-88-39.5-88-88-88z"></path></svg>
                                @lang('site.choose post pictures')
                            </label>
                            <input class="d-none" name="all[]" id="files-5" type="file" multiple/>
                        </div>
                        --}}


                        <div class="image-uploader-item" style="border-color: #8F0303; color: #8F0303; cursor: pointer; margin-top: 10px;">
                            <label for="files-1"></label>
                            <input class="d-none" multiple  id="files-1" name="front[]" type="file" />
                            <button type="button" class="image-uploader-btn image-uploader-btn-text">
                                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="car" class="svg-inline--fa fa-car fa-w-16 fa-3x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" color="#8F0303"><path fill="currentColor" d="M120.81 248c-25.96 0-44.8 16.8-44.8 39.95 0 23.15 18.84 39.95 44.8 39.95l10.14.1c39.21 0 45.06-20.1 45.06-32.08-.01-24.68-31.1-47.92-55.2-47.92zm10.14 56c-3.51 0-7.02-.1-10.14-.1-12.48 0-20.8-6.38-20.8-15.95s8.32-15.95 20.8-15.95 31.2 14.36 31.2 23.93c0 7.17-10.54 8.07-21.06 8.07zm260.24-56c-24.1 0-55.19 23.24-55.19 47.93 0 11.98 5.85 32.08 45.06 32.08l10.14-.1c25.96 0 44.8-16.8 44.8-39.95-.01-23.16-18.85-39.96-44.81-39.96zm0 55.9c-3.12 0-6.63.1-10.14.1-10.53 0-21.06-.9-21.06-8.07 0-9.57 18.72-23.93 31.2-23.93s20.8 6.38 20.8 15.95-8.32 15.95-20.8 15.95zm114.8-140.94c-7.34-11.88-20.06-18.97-34.03-18.97H422.3l-8.07-24.76C403.5 86.29 372.8 64 338.17 64H173.83c-34.64 0-65.33 22.29-76.06 55.22l-8.07 24.76H40.04c-13.97 0-26.69 7.09-34.03 18.97s-8 26.42-1.75 38.91l5.78 11.61c3.96 7.88 9.92 14.09 17 18.55-6.91 11.74-11.03 25.32-11.03 39.97V400c0 26.47 21.53 48 48 48h16c26.47 0 48-21.53 48-48v-16H384v16c0 26.47 21.53 48 48 48h16c26.47 0 48-21.53 48-48V271.99c0-14.66-4.12-28.23-11.03-39.98 7.09-4.46 13.04-10.68 17-18.57l5.78-11.56c6.24-12.5 5.58-27.05-1.76-38.92zM128.2 129.14C134.66 109.32 153 96 173.84 96h164.33c20.84 0 39.18 13.32 45.64 33.13l20.47 62.85H107.73l20.47-62.84zm-89.53 70.02l-5.78-11.59c-1.81-3.59-.34-6.64.34-7.78.87-1.42 2.94-3.8 6.81-3.8h39.24l-6.45 19.82a80.69 80.69 0 0 0-23.01 11.29c-4.71-1-8.94-3.52-11.15-7.94zM96.01 400c0 8.83-7.19 16-16 16h-16c-8.81 0-16-7.17-16-16v-16h48v16zm367.98 0c0 8.83-7.19 16-16 16h-16c-8.81 0-16-7.17-16-16v-16h48v16zm0-80.01v32H48.01v-80c0-26.47 21.53-48 48-48h319.98c26.47 0 48 21.53 48 48v48zm15.12-132.41l-5.78 11.55c-2.21 4.44-6.44 6.97-11.15 7.97-6.94-4.9-14.69-8.76-23.01-11.29l-6.45-19.82h39.24c3.87 0 5.94 2.38 6.81 3.8.69 1.14 2.16 4.18.34 7.79z"></path>
                                </svg><span style="display: block; margin-top: 10px; color: #8F0303;">@lang('site.Front photos of the car')</span>
                            </button>
                        </div>

                        <div class="image-uploader-item" style="border-color: #8F0303; color: #8F0303; cursor: pointer; margin-top: 10px;">
                            <label for="files-2"></label>
                            <input class="d-none" id="files-2" multiple  name="side[]" type="file" />
                            <button type="button" class="image-uploader-btn image-uploader-btn-text"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="car-side" class="svg-inline--fa fa-car-side fa-w-20 fa-3x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" color="#8F0303"><path fill="currentColor" d="M544 192h-16L419.21 56.02A63.99 63.99 0 0 0 369.24 32H171.33c-26.17 0-49.7 15.93-59.42 40.23L64 192c-35.35 0-64 28.65-64 64v112c0 8.84 7.16 16 16 16h48c0 53.02 42.98 96 96 96s96-42.98 96-96h128c0 53.02 42.98 96 96 96s96-42.98 96-96h48c8.84 0 16-7.16 16-16v-80c0-53.02-42.98-96-96-96zM288 64h81.24c9.77 0 18.88 4.38 24.99 12.01L487.02 192H288V64zM141.62 84.12C146.51 71.89 158.17 64 171.33 64H256v128H98.46l43.16-107.88zM160 448c-35.35 0-64-28.65-64-64s28.65-64 64-64 64 28.65 64 64-28.65 64-64 64zm320 0c-35.35 0-64-28.65-64-64s28.65-64 64-64 64 28.65 64 64-28.65 64-64 64zm128-96h-37.88c-13.22-37.2-48.38-64-90.12-64s-76.9 26.8-90.12 64H250.12c-13.22-37.2-48.38-64-90.12-64s-76.9 26.8-90.12 64H32v-96c0-17.64 14.36-32 32-32h480c35.29 0 64 28.71 64 64v64z"></path></svg><span style="display: block; margin-top: 10px; color: #8F0303;">
                            @lang('site.Car side photos')</span>
                            </button></div>


                        <div class="image-uploader-item" style="border-color: #8F0303; color: #8F0303; cursor: pointer; margin-top: 10px;">
                            <label for="files-3"></label>
                            <input class="d-none" id="files-3" multiple name="inside[]" type="file" />
                            <button type="button" class="image-uploader-btn image-uploader-btn-text"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="steering-wheel" class="svg-inline--fa fa-steering-wheel fa-w-16 fa-3x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" color="#8F0303"><path fill="currentColor" d="M248 8C111.03 8 0 119.03 0 256s111.03 248 248 248 248-111.03 248-248S384.97 8 248 8zm0 32c119.1 0 215.99 96.89 216 215.98H358.38C350.94 219.52 318.64 192 280 192h-64c-38.64 0-70.94 27.52-78.38 63.98H32C32.01 136.89 128.9 40 248 40zm-5.66 299.7l-67.5-67.48c-4.62-4.62-5.94-11.6-3.55-17.68 7-17.86 24.41-30.54 44.71-30.54h64c20.3 0 37.71 12.68 44.71 30.54 2.39 6.09 1.07 13.06-3.55 17.68l-67.5 67.48a7.997 7.997 0 0 1-11.32 0zm-207.7-51.72h110.72L232 374.61v96.58c-100.94-7.46-182.6-84.45-197.36-183.21zM264 471.19v-96.58l86.64-86.63h110.72C446.6 386.74 364.94 463.73 264 471.19z"></path></svg><span style="display: block; margin-top: 10px; color: #8F0303;">
                            @lang('site.Photos inside the car')</span>
                            </button>
                        </div>


                        <div class="image-uploader-item" style="border-color: #8F0303; color: #8F0303; cursor: pointer; margin-top: 10px;">
                            <label for="files-4"></label>
                            <input class="d-none" name="other[]" multiple  id="files-4" type="file" />
                            <button type="button" class="image-uploader-btn image-uploader-btn-text"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="plus" class="svg-inline--fa fa-plus fa-w-12 fa-3x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" color="#8F0303"><path fill="currentColor" d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z"></path></svg><span style="display: block; margin-top: 10px; color: #8F0303;">
                            @lang('site.Other photos')</span>
                            </button>
                        </div>




                    </div>
                    <div id="upload-video" style="border-color: #8F0303; color: #8F0303; cursor: pointer; margin-top: 10px;">
                            <div class="upload-preview" id="result-video"></div>
                            <input type="file" accept="video/*" name="videos[]" multiple id="files-7" class="d-none">
                            <label class="button btn-lg btn-info mt-1" for="files-7">
                                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="video-plus" class="svg-inline--fa fa-video-plus fa-w-18 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M543.9 96c-6.2 0-12.5 1.8-18.2 5.7L416 171.6v-59.8c0-26.4-23.2-47.8-51.8-47.8H51.8C23.2 64 0 85.4 0 111.8v288.4C0 426.6 23.2 448 51.8 448h312.4c28.6 0 51.8-21.4 51.8-47.8v-59.8l109.6 69.9c5.7 4 12.1 5.7 18.2 5.7 16.6 0 32.1-13 32.1-31.5v-257c.1-18.5-15.4-31.5-32-31.5zM384 192v208.2c0 8.6-9.1 15.8-19.8 15.8H51.8c-10.7 0-19.8-7.2-19.8-15.8V111.8c0-8.6 9.1-15.8 19.8-15.8h312.4c10.7 0 19.8 7.2 19.8 15.8V192zm160 192.5l-1.2-1.3L416 302.4v-92.9L544 128v256.5zM296 240h-72v-72c0-4.4-3.6-8-8-8h-16c-4.4 0-8 3.6-8 8v72h-72c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h72v72c0 4.4 3.6 8 8 8h16c4.4 0 8-3.6 8-8v-72h72c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8z"></path>
                                </svg>@lang('site.upload video')
                            </label>
                            <p>@lang('site.* The length of the video must not exceed 30 seconds')</p>
                        </div>
                    @else
                    <!--===== اضافة اعلان الشكل التاني =====-->
                    <div class="second-input">
                        <label class="btn-lg btn-info mt-1" for="files-5">
                            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="camera" class="svg-inline--fa fa-camera fa-w-16 fa-1x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M324.3 64c3.3 0 6.3 2.1 7.5 5.2l22.1 58.8H464c8.8 0 16 7.2 16 16v288c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16V144c0-8.8 7.2-16 16-16h110.2l20.1-53.6c2.3-6.2 8.3-10.4 15-10.4h131m0-32h-131c-20 0-37.9 12.4-44.9 31.1L136 96H48c-26.5 0-48 21.5-48 48v288c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V144c0-26.5-21.5-48-48-48h-88l-14.3-38c-5.8-15.7-20.7-26-37.4-26zM256 408c-66.2 0-120-53.8-120-120s53.8-120 120-120 120 53.8 120 120-53.8 120-120 120zm0-208c-48.5 0-88 39.5-88 88s39.5 88 88 88 88-39.5 88-88-39.5-88-88-88z"></path></svg>
                            @lang('site.choose post pictures')
                        </label>
                        <input class="d-none" name="all[]" id="files-5" type="file" multiple/>
                    </div>

                    <div id="upload-video">
                        <div class="upload-preview" id="result-video"></div>
                        <input type="file" accept="video/*" name="videos[]" id="files-7" multiple class="d-none">
                        <label class="button btn-lg btn-info mt-1" for="files-7">
                            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="video-plus" class="svg-inline--fa fa-video-plus fa-w-18 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M543.9 96c-6.2 0-12.5 1.8-18.2 5.7L416 171.6v-59.8c0-26.4-23.2-47.8-51.8-47.8H51.8C23.2 64 0 85.4 0 111.8v288.4C0 426.6 23.2 448 51.8 448h312.4c28.6 0 51.8-21.4 51.8-47.8v-59.8l109.6 69.9c5.7 4 12.1 5.7 18.2 5.7 16.6 0 32.1-13 32.1-31.5v-257c.1-18.5-15.4-31.5-32-31.5zM384 192v208.2c0 8.6-9.1 15.8-19.8 15.8H51.8c-10.7 0-19.8-7.2-19.8-15.8V111.8c0-8.6 9.1-15.8 19.8-15.8h312.4c10.7 0 19.8 7.2 19.8 15.8V192zm160 192.5l-1.2-1.3L416 302.4v-92.9L544 128v256.5zM296 240h-72v-72c0-4.4-3.6-8-8-8h-16c-4.4 0-8 3.6-8 8v72h-72c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h72v72c0 4.4 3.6 8 8 8h16c4.4 0 8-3.6 8-8v-72h72c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8z"></path>
                            </svg>@lang('site.upload video')
                        </label>
                        <p>@lang('site.* The length of the video must not exceed 30 seconds')</p>
                    </div>
                    <!--======-->
                    @endif

                    <div class="mt-5">
                        <label>
                            <label>
                                <input name="agree7" type="checkbox" required value="" checked=""> @lang('site.I pledge that all attached pictures are the same item.')<br>
                                <span>&nbsp;</span>
                            </label>
                        </label>
                    </div>
                </div>
                <br><br>
                <div id="dropMsg" style="opacity: ;">
                    <h1>@lang('site.add photos')</h1>
                </div>
               <div class="buttons mt-4"><button class="button  btn-lg btn-success mt-1">@lang('site.continue') »</button></div>
            </form>
        </div>
    </section>

    <!--========================== End add post page ==========================-->





@endsection
@section('script')

<script>
/*================================== settings of add images ======================================*/

window.onload = function() {

    //Check File API support
    if (window.File && window.FileList && window.FileReader) {
        var filesInput_1 = document.getElementById("files-1"),
            filesInput_2 = document.getElementById("files-2"),
            filesInput_3 = document.getElementById("files-3"),
            filesInput_4 = document.getElementById("files-4"),
            filesInput_5 = document.getElementById("files-5");
            filesInput_7 = document.getElementById("files-7");

if(filesInput_1 !=null){
        filesInput_1.addEventListener("change", function(event) {

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
                    div.classList.add('boxImage');

                    div.innerHTML = `<div class="thumWrapper" id="thumWrapper">
                    <div class="thumbContent">
                        <img src="${picFile.result}" title="${picFile.name}"><div style="height: 5px; max-height: 5px; display: flex; justify-content: flex-start;">
                    </div>
                    <div class="buttonsWrapper">
                        <span class="button btn-danger delete">@lang('site.delete')</span>
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
                        $(this).parents('.boxImage').remove();
                    })

                });

                //Read the image
                picReader.readAsDataURL(file);
            }

        });
    }
    if(filesInput_2 !=null){
        filesInput_2.addEventListener("change", function(event) {

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
                    div.classList.add('boxImage');

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
                        $(this).parents('.boxImage').remove();
                    })

                });

                //Read the image
                picReader.readAsDataURL(file);
            }

        });
    }
     if(filesInput_3 !=null){
        filesInput_3.addEventListener("change", function(event) {

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
                    div.classList.add('boxImage');

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
                        $(this).parents('.boxImage').remove();
                    })

                });

                //Read the image
                picReader.readAsDataURL(file);
            }

        });
     }
     if(filesInput_4 !=null){
        filesInput_4.addEventListener("change", function(event) {

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
                    div.classList.add('boxImage');

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
                        $(this).parents('.boxImage').remove();
                    })

                });

                //Read the image
                picReader.readAsDataURL(file);
            }

        });
     }
      if(filesInput_5 !=null){
        filesInput_5.addEventListener("change", function(event) {

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
                    div.classList.add('boxImage');

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
                        $(this).parents('.boxImage').remove();
                    })

                });

                //Read the image
                picReader.readAsDataURL(file);
            }

        });
      }
      if(filesInput_7 != null){
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
                            div.innerHTML = `<video loop muted controls>
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
      }
    } else {
        console.log("Your browser does not support File API");
    }
}

$('.uploadThumb .buttonsWrapper button').on('click', function(e) {
    e.stopPropagation()
})

</script>

@endsection
