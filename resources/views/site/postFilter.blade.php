@foreach($posts as $post)
<div class="postOneImage single-product mt-3">
    <div class="postInfo">
        <div class="postTitle">
            <a href="{{url('/')}}/single/post/{{$post->id}}" style="width: 100%;">{{$post->title}}</a>
            
        </div>
        <div class="postExtraInfo">
                   @if($post->comments->count()>0)
                        <div class="postExtraInfoPart">
                            <i class="fal fa-comments"></i>
                            <span>{{$post->comments->count()}} {{__('site.comment')}}</span>
                        </div>
                        @else
                        
                        <div class="postExtraInfoPart">
                            <i class="fal fa-comment-slash"></i>
                            <span>{{__('site.no_comments')}}</span>
                        </div>
                    @endif
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
        $logo= $setting->where('name','logo')->first()->value; 
        }else{
            $logo=$img->image;
        }
        ?>
        <img src="{{url('/')}}/public/storage/{{$logo}}" alt="{{$post->title}}">
    </div>
                                    
</div>
@endforeach

@foreach($posts as $post)
  <div class="PostImagesCarousel d-none  single-product1">
                                        <div class="owl-carousel owl-theme">
                                            @if(count($post->images->where('type',0))>0)
                                            @foreach($post->images->where('type',0) as $img)
                                            <div class="item">
                                                <img src="{{url('/')}}/public/storage/{{$img->image}}" alt="{{$post->title}}">
                                            </div>
                                            @endforeach
                                            @else
                                             <?php $logo= $setting->where('name','logo')->first()->value?>
                                               <div class="item">
                                                <img src="{{url('/')}}/public/storage/{{$logo}}" alt="{{$post->title}}">
                                            </div>
                                             @endif
                                           
                                        </div>
                                        <button type="button" class="PostImagesCarousel-fav-btn">
                                               @if(Auth::check())
                                                    <?php $fav=\App\Models\FavPosts::where('post_id',$post->id)->where('user_id',auth::user()->id)->first();?>
                                               <a  href="{{url('/')}}/post/{{$post->id}}/fav">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fal" style="{{!empty($fav)?'color:red':''}}" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16 fa-fw " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M462.3 62.7c-54.5-46.4-136-38.7-186.6 13.5L256 96.6l-19.7-20.3C195.5 34.1 113.2 8.7 49.7 62.7c-62.8 53.6-66.1 149.8-9.9 207.8l193.5 199.8c6.2 6.4 14.4 9.7 22.6 9.7 8.2 0 16.4-3.2 22.6-9.7L472 270.5c56.4-58 53.1-154.2-9.7-207.8zm-13.1 185.6L256.4 448.1 62.8 248.3c-38.4-39.6-46.4-115.1 7.7-161.2 54.8-46.8 119.2-12.9 142.8 11.5l42.7 44.1 42.7-44.1c23.2-24 88.2-58 142.8-11.5 54 46 46.1 121.5 7.7 161.2z"></path>
                                            </svg>
                                            </a>
                                            @else
                                              <svg aria-hidden="true" focusable="false" data-prefix="fal"  data-icon="heart" class="svg-inline--fa fa-heart fa-w-16 fa-fw " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M462.3 62.7c-54.5-46.4-136-38.7-186.6 13.5L256 96.6l-19.7-20.3C195.5 34.1 113.2 8.7 49.7 62.7c-62.8 53.6-66.1 149.8-9.9 207.8l193.5 199.8c6.2 6.4 14.4 9.7 22.6 9.7 8.2 0 16.4-3.2 22.6-9.7L472 270.5c56.4-58 53.1-154.2-9.7-207.8zm-13.1 185.6L256.4 448.1 62.8 248.3c-38.4-39.6-46.4-115.1 7.7-161.2 54.8-46.8 119.2-12.9 142.8 11.5l42.7 44.1 42.7-44.1c23.2-24 88.2-58 142.8-11.5 54 46 46.1 121.5 7.7 161.2z"></path>
                                            </svg>
                                            @endif
                                        </button>
                                        <div class="postInfo">
                                            <div class="postTitle">
                                                <a href="{{url('/')}}/single/post/{{$post->id}}" style="width: 100%;">{{$post->title}}</a>
                                                @if($post->special_id !=null)
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" class="svg-inline--fa fa-star fa-w-18 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg>
                                                @endif
                                            </div>
                                            <div class="postExtraInfo">
                                                <div class="postExtraInfoPart">

                                                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="thumbs-up" class="svg-inline--fa fa-thumbs-up fa-w-16 green" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M496.656 285.683C506.583 272.809 512 256 512 235.468c-.001-37.674-32.073-72.571-72.727-72.571h-70.15c8.72-17.368 20.695-38.911 20.695-69.817C389.819 34.672 366.518 0 306.91 0c-29.995 0-41.126 37.918-46.829 67.228-3.407 17.511-6.626 34.052-16.525 43.951C219.986 134.75 184 192 162.382 203.625c-2.189.922-4.986 1.648-8.032 2.223C148.577 197.484 138.931 192 128 192H32c-17.673 0-32 14.327-32 32v256c0 17.673 14.327 32 32 32h96c17.673 0 32-14.327 32-32v-8.74c32.495 0 100.687 40.747 177.455 40.726 5.505.003 37.65.03 41.013 0 59.282.014 92.255-35.887 90.335-89.793 15.127-17.727 22.539-43.337 18.225-67.105 12.456-19.526 15.126-47.07 9.628-69.405zM32 480V224h96v256H32zm424.017-203.648C472 288 472 336 450.41 347.017c13.522 22.76 1.352 53.216-15.015 61.996 8.293 52.54-18.961 70.606-57.212 70.974-3.312.03-37.247 0-40.727 0-72.929 0-134.742-40.727-177.455-40.727V235.625c37.708 0 72.305-67.939 106.183-101.818 30.545-30.545 20.363-81.454 40.727-101.817 50.909 0 50.909 35.517 50.909 61.091 0 42.189-30.545 61.09-30.545 101.817h111.999c22.73 0 40.627 20.364 40.727 40.727.099 20.363-8.001 36.375-23.984 40.727zM104 432c0 13.255-10.745 24-24 24s-24-10.745-24-24 10.745-24 24-24 24 10.745 24 24z"></path>
                                                    </svg>&nbsp;&nbsp;

                                                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="comments" class="svg-inline--fa fa-comments fa-w-18 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                        <path fill="currentColor" d="M569.9 441.1c-.5-.4-22.6-24.2-37.9-54.9 27.5-27.1 44-61.1 44-98.2 0-80-76.5-146.1-176.2-157.9C368.4 72.5 294.3 32 208 32 93.1 32 0 103.6 0 192c0 37 16.5 71 44 98.2-15.3 30.7-37.3 54.5-37.7 54.9-6.3 6.7-8.1 16.5-4.4 25 3.6 8.5 12 14 21.2 14 53.5 0 96.7-20.2 125.2-38.8 9.1 2.1 18.4 3.7 28 4.8 31.5 57.5 105.5 98 191.8 98 20.8 0 40.8-2.4 59.8-6.8 28.5 18.5 71.6 38.8 125.2 38.8 9.2 0 17.5-5.5 21.2-14 3.6-8.5 1.9-18.3-4.4-25zM155.4 314l-13.2-3-11.4 7.4c-20.1 13.1-50.5 28.2-87.7 32.5 8.8-11.3 20.2-27.6 29.5-46.4L83 283.7l-16.5-16.3C50.7 251.9 32 226.2 32 192c0-70.6 79-128 176-128s176 57.4 176 128-79 128-176 128c-17.7 0-35.4-2-52.6-6zm289.8 100.4l-11.4-7.4-13.2 3.1c-17.2 4-34.9 6-52.6 6-65.1 0-122-25.9-152.4-64.3C326.9 348.6 416 278.4 416 192c0-9.5-1.3-18.7-3.3-27.7C488.1 178.8 544 228.7 544 288c0 34.2-18.7 59.9-34.5 75.4L493 379.7l10.3 20.7c9.4 18.9 20.8 35.2 29.5 46.4-37.1-4.2-67.5-19.4-87.6-32.4z"></path>
                                                        </svg>
                                                    <span> {{count($post->comments)}}</span>
                                                </div>

                                                <div class="postExtraInfoPart"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="alarm-clock" class="svg-inline--fa fa-alarm-clock fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M32 112a80.09 80.09 0 0 1 80-80 79.23 79.23 0 0 1 50 18 253.22 253.22 0 0 1 34.44-10.8C175.89 15.42 145.86 0 112 0A112.14 112.14 0 0 0 0 112c0 25.86 9.17 49.41 24 68.39a255.93 255.93 0 0 1 17.4-31.64A78.94 78.94 0 0 1 32 112zM400 0c-33.86 0-63.89 15.42-84.44 39.25A253.22 253.22 0 0 1 350 50.05a79.23 79.23 0 0 1 50-18 80.09 80.09 0 0 1 80 80 78.94 78.94 0 0 1-9.36 36.75A255.93 255.93 0 0 1 488 180.39c14.79-19 24-42.53 24-68.39A112.14 112.14 0 0 0 400 0zM256 64C132.29 64 32 164.29 32 288a222.89 222.89 0 0 0 54.84 146.54L34.34 487a8 8 0 0 0 0 11.32l11.31 11.31a8 8 0 0 0 11.32 0l52.49-52.5a223.21 223.21 0 0 0 293.08 0L455 509.66a8 8 0 0 0 11.32 0l11.31-11.31a8 8 0 0 0 0-11.32l-52.5-52.49A222.89 222.89 0 0 0 480 288c0-123.71-100.29-224-224-224zm0 416c-105.87 0-192-86.13-192-192S150.13 96 256 96s192 86.13 192 192-86.13 192-192 192zm14.38-183.69V168a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v136a16 16 0 0 0 6 12.48l73.75 59a8 8 0 0 0 11.25-1.25l10-12.5a8 8 0 0 0-1.25-11.25z"></path></svg>
                                                    <span class="">{{$post->created_at->diffForHumans()}}</span>
                                                </div>
                                            </div>
                                            <div class="postExtraInfo">
                                                <div class="postExtraInfoPart">
                                                @if($post->area_id !=null)
                                                    <a href="{{url('/')}}/city/{{$post->area->name}}"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="map-marker" class="svg-inline--fa fa-map-marker fa-w-12 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M192 0C85.961 0 0 85.961 0 192c0 77.413 26.97 99.031 172.268 309.67 9.534 13.772 29.929 13.774 39.465 0C357.03 291.031 384 269.413 384 192 384 85.961 298.039 0 192 0zm0 473.931C52.705 272.488 32 256.494 32 192c0-42.738 16.643-82.917 46.863-113.137S149.262 32 192 32s82.917 16.643 113.137 46.863S352 149.262 352 192c0 64.49-20.692 80.47-160 281.931z"></path></svg> {{$post->created_at->diffForHumans()}}</a>
                                                @endif
                                                </div>
                                                <div class="postExtraInfoPart"><a href="{{url('/')}}/user/{{$post->post_user->user->id}}/profile"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="user" class="svg-inline--fa fa-user fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M313.6 288c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4zM416 464c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16v-41.6C32 365.9 77.9 320 134.4 320c19.6 0 39.1 16 89.6 16 50.4 0 70-16 89.6-16 56.5 0 102.4 45.9 102.4 102.4V464zM224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm0-224c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"></path></svg> {{$post->post_user->user->name}}</a></div>
                                            </div>
                                        </div>
                                    </div>
@endforeach
