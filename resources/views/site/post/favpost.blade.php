  
@extends('site.layouts.appWithoutFooter')
@section('content')

  <!-- ========================== start fav page =============================== -->
    <section class="fav-page">
        <div class="container">
            <a href="{{ url()->previous() }}">
            <button class="backButton btn-link">
                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path>
                </svg>
                <br>
            </button>
            </a>
            <div class="mt-5">
            @if(!empty($posts))
                                @foreach($posts as $postt)
                                <?php $post=$postt->Post;?>
                                <div class="single-product">
                                    <div class="postInfo">
                                        <div class="postTitle">
                                            <a href="{{url('/')}}/single/post/{{$post->id}}" style="width: 100%;">{{$post->title}}</a>
                                            
                                        </div>
                                        <div class="postExtraInfo">
                                                <div class="postExtraInfoPart"></div>
                                                <div class="postExtraInfoPart">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="alarm-clock" class="svg-inline--fa fa-alarm-clock fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M32 112a80.09 80.09 0 0 1 80-80 79.23 79.23 0 0 1 50 18 253.22 253.22 0 0 1 34.44-10.8C175.89 15.42 145.86 0 112 0A112.14 112.14 0 0 0 0 112c0 25.86 9.17 49.41 24 68.39a255.93 255.93 0 0 1 17.4-31.64A78.94 78.94 0 0 1 32 112zM400 0c-33.86 0-63.89 15.42-84.44 39.25A253.22 253.22 0 0 1 350 50.05a79.23 79.23 0 0 1 50-18 80.09 80.09 0 0 1 80 80 78.94 78.94 0 0 1-9.36 36.75A255.93 255.93 0 0 1 488 180.39c14.79-19 24-42.53 24-68.39A112.14 112.14 0 0 0 400 0zM256 64C132.29 64 32 164.29 32 288a222.89 222.89 0 0 0 54.84 146.54L34.34 487a8 8 0 0 0 0 11.32l11.31 11.31a8 8 0 0 0 11.32 0l52.49-52.5a223.21 223.21 0 0 0 293.08 0L455 509.66a8 8 0 0 0 11.32 0l11.31-11.31a8 8 0 0 0 0-11.32l-52.5-52.49A222.89 222.89 0 0 0 480 288c0-123.71-100.29-224-224-224zm0 416c-105.87 0-192-86.13-192-192S150.13 96 256 96s192 86.13 192 192-86.13 192-192 192zm14.38-183.69V168a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v136a16 16 0 0 0 6 12.48l73.75 59a8 8 0 0 0 11.25-1.25l10-12.5a8 8 0 0 0-1.25-11.25z"></path>
                                                    </svg>
                                                    <span class="">{{$post->created_at->diffForHumans()}}</span>
                                                </div>
                                        </div>
                                        <div class="postExtraInfo">
                                            <div class="postExtraInfoPart">
                                                @if($post->area_id != null)
                                                    <a href="{{url('/')}}/city/{{$post->area->id}}" class="location"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="map-marker" class="svg-inline--fa fa-map-marker fa-w-12 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M192 0C85.961 0 0 85.961 0 192c0 77.413 26.97 99.031 172.268 309.67 9.534 13.772 29.929 13.774 39.465 0C357.03 291.031 384 269.413 384 192 384 85.961 298.039 0 192 0zm0 473.931C52.705 272.488 32 256.494 32 192c0-42.738 16.643-82.917 46.863-113.137S149.262 32 192 32s82.917 16.643 113.137 46.863S352 149.262 352 192c0 64.49-20.692 80.47-160 281.931z"></path></svg> {{$post->area->name}}</a>
                                                @endif
                                            </div>
                                            <div class="postExtraInfoPart">
                                                <a href="{{url('/')}}/user/{{$post->post_user->user->id}}/profile">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="user" class="svg-inline--fa fa-user fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M313.6 288c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4zM416 464c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16v-41.6C32 365.9 77.9 320 134.4 320c19.6 0 39.1 16 89.6 16 50.4 0 70-16 89.6-16 56.5 0 102.4 45.9 102.4 102.4V464zM224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm0-224c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"></path>
                                                    </svg> {{$post->post_user->user->name}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="postImg">
                                        <?php $img=$post->images->where('type',0)->first();
                                        if($img==null){
                                        $logo=\App\Models\setting::where('name','logo')->first()->value; 
                                        }else{
                                            $logo=$img->image;
                                        }
                                        ?>
                                        <img src="{{url('/')}}/public/storage/{{$logo}}" alt="{{$post->title}}">
                                    </div>
                                </div>
                                @endforeach 
                                @endif
            </div>

        </div>
    </section>
    <!-- ========================== End fav page =============================== -->
@endsection