@extends('site.layouts.app')

@section('content')
    <!--========================== Start home content ==========================-->

    <section class="home-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 marks-side">
                    <div class="tagSide">
                        <div class="sideSearchHistory">
                            <a href="/tags/حراج السيارات">حراج السيارات</a>
                            <hr><a href="/tags/حراج العقار">حراج العقار</a>
                            <hr>
                            <div class="smallText"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times-circle" class="svg-inline--fa fa-times-circle fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 464c-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216 0 118.7-96.1 216-216 216zm94.8-285.3L281.5 256l69.3 69.3c4.7 4.7 4.7 12.3 0 17l-8.5 8.5c-4.7 4.7-12.3 4.7-17 0L256 281.5l-69.3 69.3c-4.7 4.7-12.3 4.7-17 0l-8.5-8.5c-4.7-4.7-4.7-12.3 0-17l69.3-69.3-69.3-69.3c-4.7-4.7-4.7-12.3 0-17l8.5-8.5c4.7-4.7 12.3-4.7 17 0l69.3 69.3 69.3-69.3c4.7-4.7 12.3-4.7 17 0l8.5 8.5c4.6 4.7 4.6 12.3 0 17z"></path></svg><span>مسح السجل</span>
                                <hr>
                            </div>
                        </div>
                        <div class="tagSelect">
                            <select class="tagSelectLevel1">
                                <option value=""{{isset($mainCat)??'selected'}}>الكل</option>
                                @foreach($cats as $cat)
                                <option value="{{$cat->id}}" {{isset($mainCat)?$mainCat->id==$cat->id?'selected':'':''}}>{{$cat->name}}</option>
                                @endforeach
                            </select>
                            @if(isset($mainCat))
                            @if(!empty($cats->where('parent_id',$mainCat->id)))
                            <select class="tagSelectLevel1">
                            @foreach($cats->where('parent_id',$mainCat->id) as $cat)
                            <option {{isset($catP)?$catP->id==$cat->id?'selected':'':''}}>{{$cat->name}}</option>
                            @endforeach
                             </select>
                            @endif
                            @endif
                            @if(isset($catP))
                            @if(!empty($cats->where('parent_id',$catP->id)))
                            <select class="tagSelectLevel1">
                            @foreach($cats->where('parent_id',$catP->id) as $cat)
                            <option {{isset($subCat)?$subCat->id==$cat->id?'selected':'':''}}>{{$cat->name}}</option>
                            @endforeach
                             </select>
                            @endif
                            @endif
                            <button type="submit" class="btn-success">
                                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="search" class="svg-inline--fa fa-search fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M508.5 481.6l-129-129c-2.3-2.3-5.3-3.5-8.5-3.5h-10.3C395 312 416 262.5 416 208 416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c54.5 0 104-21 141.1-55.2V371c0 3.2 1.3 6.2 3.5 8.5l129 129c4.7 4.7 12.3 4.7 17 0l9.9-9.9c4.7-4.7 4.7-12.3 0-17zM208 384c-97.3 0-176-78.7-176-176S110.7 32 208 32s176 78.7 176 176-78.7 176-176 176z"></path></svg>
                            </button>
                        </div>
                        <?php $sidebarFilter=\App\Models\menues::find(3);?>
                       @if($sidebarFilter->show==1)
                     
                            @if(!empty($sidebarFilter->items))
                            @foreach($sidebarFilter->items as $i=>$item)
                            @if(!empty($item->cat->child))
                            @if(isset($mainCat)) 
                           @if( $mainCat->id==$item->cat->id)
                           <br>
                            <hr><br>
                            <div id=" {{$item->sort==1?'mark':'other_marks_'}}">
                            <div class="brand-logos row">                      
                            @foreach($item->cat->child as $cat)
                                <div class="col-4">
                                    <a class="brand-logos--svg {{$item->img_filter==1?'imgasicon':''}} mainFilter mainF{{$item->cat->id}}" data-id="{{$cat->id}}" href="{{url('/')}}\tag\{{$cat->id}}">
                                       @if($cat->photo != null)
                                        @if($item->is==2||$item->is==3)
                                        <img alt="{{$cat->name}}" loading="lazy" height="60" width="60" class="svg-size-5x" src="{{url('/')}}/public/storage/{{$cat->photo}}">
                                        @endif
                                        @endif
                                        @if($item->is==3)
                                        <span class="text">{{$cat->name}}</span>
                                        @elseif($item->is==1)
                                        {{$cat->name}}
                                        @endif
                                      
                                    </a>
                                </div>
                            @endforeach
                            </div>
                          
                            </div>
                            @endif
                            @else
                            <br>
                            <hr><br>
                            <div id=" {{$item->sort==1?'mark':'other_marks_'}}">
                            <div class="brand-logos row">                      
                            @foreach($item->cat->child as $cat)
                                <div class="col-4">
                                    <a class="brand-logos--svg {{$item->img_filter==1?'imgasicon':''}} mainFilter" data-id="{{$cat->id}}" href="{{url('/')}}\tag\{{$cat->id}}">
                                       @if($cat->photo != null)
                                        @if($item->is==2||$item->is==3)
                                        <img alt="{{$cat->name}}" loading="lazy" height="60" width="60" class="svg-size-5x" src="{{url('/')}}/public/storage/{{$cat->photo}}">
                                        @endif
                                        @endif
                                        @if($item->is==3)
                                        <span class="text">{{$cat->name}}</span>
                                        @elseif($item->is==1)
                                        {{$cat->name}}
                                        @endif
                                      
                                    </a>
                                </div>
                            @endforeach
                         
                          
                            </div>
                            </div>
                            @endif
                            @endif
                         @endforeach
                         @endif
                       
                  
                    
                        @endif
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="tagMain">
                        <div class="space-between-md">
                            <div class="search-container-wrapper">
                                <div id="searchBoxContent">
                                    <form action="#">
                                        <div class="react-autosuggest__container">
                                            <div class="inputContainer form-input-group form-input-group__search">
                                                <input type="search" class="form-control" name="search_term_string" placeholder="ابحث عن سلعة .." value="">
                                                <button class="btn btn-primary-alt" type="submit">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="search" class="svg-inline--fa fa-search fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M508.5 481.6l-129-129c-2.3-2.3-5.3-3.5-8.5-3.5h-10.3C395 312 416 262.5 416 208 416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c54.5 0 104-21 141.1-55.2V371c0 3.2 1.3 6.2 3.5 8.5l129 129c4.7 4.7 12.3 4.7 17 0l9.9-9.9c4.7-4.7 4.7-12.3 0-17zM208 384c-97.3 0-176-78.7-176-176S110.7 32 208 32s176 78.7 176 176-78.7 176-176 176z"></path></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="addPost-btn" class="mt-1 mb-1">
                                <a class="add-btn btn-success" href="/post">أضف إعلانك 
                                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="plus" class="svg-inline--fa fa-plus fa-w-12 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z"></path></svg>
                                </a>
                            </div>
                        </div>
                        <?php $mainFilter=\App\Models\menues::find(2);?>
                       @if($mainFilter->show==1)
                        <div class="list-catig">
                            <ul class="tabs_list">
                                @foreach($mainFilter->items as $item)
                                <li class="tab " >
                                    <a class="tab_link {{isset($mainCat)?$mainCat->id==$item->cat->id?'active':'':''}}"data-id="{{$item->cat->id}}" href="{{url('/')}}/tag/{{$item->cat->id}}">
                                        @if(($mainFilter->is==3||$mainFilter->is==2)and $item->cat->photo != null)
                                        
                                        <img alt="{{$item->cat->name}}" loading="lazy" height="35" width="35" src="{{url('/')}}/public/storage/{{$item->cat->photo}}">
                                        @endif
                                        @if($mainFilter->is != 2)
                                        <span>{{$item->name}} </span>
                                        @endif
                                    </a>
                                </li>
                                @endforeach
                                <li class="tab">
                                    <a  class="tab_link {{!isset($mainCat)?'active':''}}" href="{{url('/')}}"><img loading="lazy" height="35" width="35" alt="@lang('site.all')" src="{{url('/')}}/public/site/assets/img/icons/more-icon.svg"><span>@lang('site.all')</span></a>
                                </li>
                                
                            </ul>
                            @if(isset($mainCat))
                            @if(!empty($cats->where('parent_id',$mainCat->id)))
                            @foreach($cats->where('parent_id',$mainCat->id) as $catt)
                            <div class="list-container-wrap">
                                <ul dir="auto" class="tabs_list supTabs list-container">
                                    <li class="supTab"><a class="supTab_link {{isset($catP)?$catP->id==$catt->id?'active':'':''}}" href="{{url('/')}}/tag/{{$catt->id}}">{{$catt->name}}</a></li>
                                </ul>
                            </div>
                            @endforeach
                            @endif
                            @endif
                            @if(isset($catP))
                            @if(!empty($cats->where('parent_id',$catP->id)))
                            @foreach($cats->where('parent_id',$catP->id) as $catt)
                            <div class="list-container-wrap">
                                <ul dir="auto" class="tabs_list supTabs list-container">
                                    <li class="supTab"><a class="supTab_link {{isset($subCat)?$subCat->id==$catt->id?'active':'':''}}" href="{{url('/')}}/tag/{{$catt->id}}">{{$catt->name}}</a></li>
                                </ul>
                            </div>
                            @endforeach
                            @endif
                            @endif
                        </div>
                        @endif
                        <div class="settings">
                            <select>
                                <option value="">كل المناطق</option>
                                <option value="">الرياض</option>
                                <option value="">الرياض</option>
                                <option value="">الرياض</option>
                                <option value="">الرياض</option>
                            </select>
                            <button class="filter-btn"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sliders-v" class="svg-inline--fa fa-sliders-v fa-w-14 fa-fw " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M112 96H96V16c0-8.8-7.2-16-16-16H48c-8.8 0-16 7.2-16 16v80H16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h16v336c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V160h16c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm320 128h-16V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v208h-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h16v208c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V288h16c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM272 352h-16V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v336h-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h16v80c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-80h16c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16z"></path></svg>تصفية</button>
                            <button class="map-btn"><i class="fas fa-map-marked-alt"></i></button>
                            <button class="search-btn"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="main-content">
                            @if(!empty($posts))
                                @foreach($posts as $post)
                               
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
                                        <?php $img=$post->images->where('type',0)->first();?>
                                        @if(!empty($img))
                                        <img src="{{url('/')}}/public/storage/{{$img->image}}" alt="{{$post->title}}">
                                        @endif
                                    </div>
                                </div>
                                    
                               
                                @endforeach 
                            @else
                            <h2>لا يوجد إعلانات فى هذا القسم</h2>
                            @endif
                    
                            <a href="#">
                                <button id="more" class="btn btn-primary">
                                    <span>مشاهدة المزيد</span>
                                    <span>... </span>
                                </button>
                            </a>

                         
                            <ul class="other-list">
                                <li><a href="#">حراج الرياض</a></li>
                                <li><a href="#">حراج جدة</a></li>
                                <li><a href="#">حراج مكة</a></li>
                                <li><a href="#">حراج الشرقية</a></li>
                                <li><a href="#">حراج حائل</a></li>
                                <li><a href="#">حراج القصيم</a></li>
                                <li><a href="#">حراج حرحر</a></li>
                                <li><a href="#">حراج الجوف</a></li>
                                <li><a href="#">حراج حائل</a></li>
                                <li><a href="#">حراج نجران</a></li>
                                <li><a href="#">حراج ينبع</a></li>
                                <li><a href="#">حراج تبوك</a></li>
                                <li><a href="#">حراج الطائف</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--========================== End home content ==========================-->
 @endsection
 @section('script')

 @endsection