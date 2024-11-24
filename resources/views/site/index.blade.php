@extends('site.layouts.app')
@section('title')
<title> @lang('site.siteName')</title>
@endsection
@section('style')
<style>
    .owl-carousel .owl-item img {
        height:300px;
    }
    .select{
        float:right;
    }
    
    
     /* Start Model ==================================================== */
    .home-content .tagMain .settings {
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        /* flex-direction: column; */
        flex-wrap: wrap;
        /* width: 100%; */
    }


    @media (max-width: 575px) {
        .home-content .tagMain .settings .select select,.home-content .tagMain .settings .select .select_area {
             width: auto;
            margin: 3px;
            margin-right: -7px;
        }

        .home-content .tagMain .settings button {

            margin: -2px;
        }


    }

    .sub_select_area {
        float: right;
        margin: 0 0px 3px 3px;
    }

    /* End Model ==================================================== */
        .sub_select_area{
        float:right;
    }
    
     .home-content .tagMain .list-catig ul .tab .tab_link {
        text-align: center;
        font-size: 1.2rem;
        color: #6c6c6c;
        white-space: nowrap;
        padding: 25px;
        display: block;
    }
    
     a.tag-filters__item {
        margin: 0 5px;
    }


    .home-content .tagMain .settings {
        margin-bottom: 6px;
        display: flex;
        align-items: center;
    }
    
     /*
     start tags
     */
    .tags {
        row-gap: 10px;
        column-gap: 10px;
        margin-top: 1rem;
        margin-bottom: 2rem;
        max-height: 300px;
        overflow-y: scroll;
        overflow-x: hidden;
        padding-right: 10px;
        .tag {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 16px 10px;
            border-radius: 4px;
            background-color: #f7fbfa !important;
            color: #919191 !important;
        }

    }

    /*
    end tags
    */

  
    
    
</style>

@if(app()->getLocale() == 'en')

   <style>
       /*
     start tags
     */
       .tags {
           row-gap: 10px;
           column-gap: 10px;
           margin-top: 1rem;
           margin-bottom: 2rem;
           max-height: 300px;
           overflow-y: scroll;
           overflow-x: hidden;
           padding-right: 10px;
           .tag {
               display: flex;
               justify-content: center;
               align-items: center;
               padding: 16px 10px;
               border-radius: 4px;
               background-color: #f7fbfa !important;
               color: #919191 !important;
               direction: ltr;
           }

       }

       /*
       end tags
       */
   </style>
@endif


@if(app()->getLocale() == 'en')
    <style>
        body{
            direction: ltr;
        }

        .home-content .tagMain .react-autosuggest__container .form-input-group {
            display: flex;
            direction: ltr;
        }

        .home-content .tagMain .react-autosuggest__container .form-input-group .btn {

            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
            margin-left: -5px;
        }
    </style>
@endif
@endsection
@section('content')

    <!--========================== Start home content ==========================-->

    <section class="home-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 marks-side">
                    <div class="tagSide">
                        <div class="sideSearchHistory">
                            <div class="session">
                        @if(session()->has('sessionCat'))
                            @foreach(session('sessionCat')->items as $i=>$item)
                            <a href="{{url('/')}}/tag/{{$item['id']}}">{{$item['title']}}</a>
                            <hr>
                            @endforeach

                           <a href="{{route('delSession')}}">
                                <div class="smallText">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times-circle" class="svg-inline--fa fa-times-circle fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 464c-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216 0 118.7-96.1 216-216 216zm94.8-285.3L281.5 256l69.3 69.3c4.7 4.7 4.7 12.3 0 17l-8.5 8.5c-4.7 4.7-12.3 4.7-17 0L256 281.5l-69.3 69.3c-4.7 4.7-12.3 4.7-17 0l-8.5-8.5c-4.7-4.7-4.7-12.3 0-17l69.3-69.3-69.3-69.3c-4.7-4.7-4.7-12.3 0-17l8.5-8.5c4.7-4.7 12.3-4.7 17 0l69.3 69.3 69.3-69.3c4.7-4.7 12.3-4.7 17 0l8.5 8.5c4.6 4.7 4.6 12.3 0 17z"></path></svg>
                                    <span>@lang('site.Clear the log')</span>
                                    </div>
                                </a>
                                <hr>
                        @endif
                        </div>

                        </div>
                        <div class="tagSelect">
                            <div class="subcat">
                                <select class="tagSelectLevel1 tagSelectLevel">
                                    <option value=""{{isset($mainCat)??'selected'}}>@lang('site.all')</option>
                                    @foreach($cats->where('parent_id',null) as $cat)
                                    <option value="{{$cat->id}}" {{isset($mainCat)?$mainCat->id==$cat->id?'selected':'':''}}>{{$cat->name}}</option>
                                    @endforeach
                                </select>
                                @if(isset($mainCat))
                                <?php $mainChild=\App\Models\Cat::where('parent_id',$mainCat->id)->get();?>
                                @if(!empty($mainChild))
                                <select class="tagSelectLevel1 tagSelectLevel" id="subcat_{{$mainCat->id}}" data-id="subcat2{{$mainCat->id}}">
                                @foreach($mainChild as $cat)
                                <option  value="{{$cat->id}}" >{{$cat->name}}</option>
                                @endforeach
                                 </select>
                                @endif
                                @endif

                                <select name="modal" class="modal_year d-none" ></select>
                            </div>
                            <!--<button type="submit" class="btn-success">-->
                            <!--    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="search" class="svg-inline--fa fa-search fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M508.5 481.6l-129-129c-2.3-2.3-5.3-3.5-8.5-3.5h-10.3C395 312 416 262.5 416 208 416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c54.5 0 104-21 141.1-55.2V371c0 3.2 1.3 6.2 3.5 8.5l129 129c4.7 4.7 12.3 4.7 17 0l9.9-9.9c4.7-4.7 4.7-12.3 0-17zM208 384c-97.3 0-176-78.7-176-176S110.7 32 208 32s176 78.7 176 176-78.7 176-176 176z"></path></svg>-->
                            <!--</button>-->
                            <div class="FilterGroup__Wrapper-kok8t0-0 iGsYXQ">
                                <span class="FilterGroup__Label-kok8t0-1 bdSIGk">@lang('site.filtering') <i class="fas fa-plus fa-minus"></i></span>
                                <div class="FilterGroup__ContentWrapper-kok8t0-2 YBCfw">
                                    <div>
                                        <?php $model=$setting->where('name','modelNumber')->first()->value;?>
                                        <div class="tag-filters-extra">
                                            <div class="FilterItem__Wrapper-sc-18vvs8g-0 feaUnB"><label class="FilterItem__Label-sc-18vvs8g-1 bSWGIJ">@lang('site.year')</label>
                                                <div class="FilterItem__ItemsWrapper-sc-18vvs8g-2 bpYvLN">
                                                    <div class="sc-furvIG lkLLxz">
                                                        <select class="form-control" name="from">
                                                            <option>@lang('site.from')</option>
                                                            @for($i=date("Y") ;$i >= $model; $i--)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                             @endfor
                                                        </select>
                                                    </div>
                                                    <div class="sc-furvIG lkLLxz">
                                                        <select class="form-control" name="to">
                                                            <option>@lang('site.to')</option>
                                                             @for($i=date("Y") ;$i >= $model; $i--)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                             @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="FilterItem__Wrapper-sc-18vvs8g-0 feaUnB"><label class="FilterItem__Label-sc-18vvs8g-1 bSWGIJ"></label>-->
                                            <!--    <div class="FilterItem__ItemsWrapper-sc-18vvs8g-2 bpYvLN">-->
                                            <!--        <div class="tag-filters__item_new checkbox-button"><input type="checkbox" id="diesel-checkbox" value="DIESEL"> <label for="diesel-checkbox">ديزل</label></div>-->
                                            <!--        <div class="tag-filters__item_new checkbox-button"><input type="checkbox" id="lease-checkbox" value="للتنازل تنازل"> <label for="lease-checkbox">تنازل</label></div>-->
                                            <!--        <div class="tag-filters__item_new checkbox-button"><input type="checkbox" id="wreck-checkbox" value="مصدوم مصدومة"><label for="wreck-checkbox">مصدومة</label></div>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <!--<div class="FilterItem__Wrapper-sc-18vvs8g-0 feaUnB"><label class="FilterItem__Label-sc-18vvs8g-1 bSWGIJ"></label>-->
                                            <!--    <div class="FilterItem__ItemsWrapper-sc-18vvs8g-2 bpYvLN">-->
                                            <!--        <div class="tag-filters__item_new checkbox-button"><input type="checkbox" id="hide-showrooms" value="true" style="width: 50px;"> <label for="hide-showrooms">بدون معارض</label></div>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <!--<div class="FilterItem__Wrapper-sc-18vvs8g-0 feaUnB"><label class="FilterItem__Label-sc-18vvs8g-1 bSWGIJ">الممشى</label>-->

                                            <!--    <div class="price_slider_range">-->
                                            <!--        <div class="range-slider flat" data-ticks-position='top' style='--min:500; --max:5000; --value-a:1000; --value-b:3000; --suffix:"$"; --text-value-a:"1000"; --text-value-b:"3000";'>-->
                                            <!--            <input type="range" min="500" max="5000" value="1000" oninput="this.parentNode.style.setProperty('--value-a',this.value); this.parentNode.style.setProperty('--text-value-a', JSON.stringify(this.value))">-->
                                            <!--            <output></output>-->
                                            <!--            <input type="range" min="500" max="5000" value="3000" oninput="this.parentNode.style.setProperty('--value-b',this.value); this.parentNode.style.setProperty('--text-value-b', JSON.stringify(this.value))">-->
                                            <!--            <output></output>-->
                                            <!--            <div class='range-slider__progress'></div>-->
                                            <!--        </div>-->
                                            <!--    </div>-->

                                            <!--</div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <?php $sidebarFilter=\App\Models\menues::find(3);?>
                              @if($sidebarFilter->show==1)
                            <div class="FilterGroup__Wrapper-kok8t0-0 iGsYXQ">
                                <span class="FilterGroup__Label-kok8t0-1 bdSIGk"> {{__('site.Fast_navigation')}} <i class="fas fa-plus fa-minus"></i></span>
                                <div class="FilterGroup__ContentWrapper-kok8t0-2 YBCfw">
                       @if($sidebarFilter->show==1)

                            @if(!empty($sidebarFilter->items))
                            @foreach($sidebarFilter->items as $i=>$item)
                            @if(!empty($item->cat->child))
                            @if(isset($mainCat))
                           @if( $mainCat->id==$item->cat->id)
                           <br>

                            <div id=" {{$item->sort==1?'mark':'other_marks_'}}" class="show_marka" data-main_cat="{{$item->cat->id}}">
                            <div class="brand-logos row">
                            @foreach($item->cat->child->where('show',1) as $cat)
                                <div class="col-4">
                                    <a class="brand-logos--svg {{$item->img_filter==1?'imgasicon':''}} mainFilter" data-id="{{$cat->id}}" href="{{url('/')}}\tag\{{$cat->id}}">
                                       @if($cat->photo != null)
                                        @if($item->is==2||$item->is==3)
                                        <img alt="{{$cat->name}}" loading="lazy" height="60" width="60" class="svg-size-5x" src="{{url('/')}}/public/storage/{{$cat->photo}}">
                                        @endif

                                     @elseif($item->is==3)
                                        <span class="text">{{$cat->name}}</span>
                                        @elseif($item->is==1)
                                        {{$cat->name}}
                                        @else
                                         {{$cat->name}}
                                        @endif

                                    </a>
                                </div>
                            @endforeach
                            </div>

                            </div>
                            @endif
                            @else

                            <div id=" {{$item->sort==1?'mark':'other_marks_'}}" class="show_marka" data-main_cat="{{$item->cat->id}}">
                                 <br>

                            <div class="brand-logos row">
                            @foreach($item->cat->child->where('show',1) as $cat)
                                <div class="col-4">
                                    <a class="brand-logos--svg {{$item->img_filter==1?'imgasicon':''}} mainFilter"  data-id="{{$cat->id}}" href="{{url('/')}}\tag\{{$cat->id}}">
                                    @if($cat->photo != null)
                                        @if($item->is==2||$item->is==3)

                                        <img alt="{{$cat->name}}" loading="lazy" height="60" width="60" class="svg-size-5x" src="{{url('/')}}/public/storage/{{$cat->photo}}">

                                        @endif
                                    @elseif($item->is==3)
                                    <span class="text">{{$cat->name}}</span>
                                    @elseif($item->is==1)
                                    {{$cat->name}}
                                    @else
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
                              @endif

                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="tagMain">
                        <div class="space-between-md">
                            <div class="search-container-wrapper">
                                <div id="searchBoxContent">
                                    <form action="{{route('search')}}" method="get">

                                        <div class="react-autosuggest__container">
                                            <div class="inputContainer form-input-group form-input-group__search">
                                                <input type="search" class="form-control" name="search" placeholder="@lang('site.search for post....') " value="">
                                                <button class="btn btn-primary-alt" type="submit" aria-label="submit">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="search" class="svg-inline--fa fa-search fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M508.5 481.6l-129-129c-2.3-2.3-5.3-3.5-8.5-3.5h-10.3C395 312 416 262.5 416 208 416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c54.5 0 104-21 141.1-55.2V371c0 3.2 1.3 6.2 3.5 8.5l129 129c4.7 4.7 12.3 4.7 17 0l9.9-9.9c4.7-4.7 4.7-12.3 0-17zM208 384c-97.3 0-176-78.7-176-176S110.7 32 208 32s176 78.7 176 176-78.7 176-176 176z"></path></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="addPost-btn" class="mt-1 mb-1">
                                <a class="add-btn btn-success" href="{{route('choose_cat_add_post')}}">@lang('site.Add Your Post')
                                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="plus" class="svg-inline--fa fa-plus fa-w-12 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z"></path></svg>
                                </a>
                            </div>
                        </div>
                        <?php $mainFilter=\App\Models\menues::find(2);?>
                        
                        
                       @if($mainFilter->show==1)
                        <div class="list-catig">
                            <ul class="tabs_list mainTab">
                                @foreach($mainFilter->items as $item)
                                <li class="tab" >
                                    <div class="tab_link {{isset($mainCat)?$mainCat->id==$item->cat->id?'active':'':''}} mainFilter mainF{{$item->cat->id}}" data-main="{{$item->cat->id}}" data-id="{{$item->cat->id}}" >
                                         <i class="fa {{$item->cat->icon}}"></i>

                                        @if($mainFilter->is != 2)
                                        <span>{{$item->name}} </span>
                                        @endif
                                    </div>
                                </li>
                                @endforeach


                            </ul>


                               <div class="listFilter">
                                    @if(isset($mainCat))
                                   <?php $mainChild=\App\Models\Cat::where('parent_id',$mainCat->id)->get();?>
                            @if(!empty($mainChild))
                            <div class="list-container-wrap" id="subcat2{{$mainCat->id}}" >
                                 <ul dir="rtl" class="tabs_list supTabs list-container">
                            @foreach($mainChild as $catt)


                                    <li class="supTab tt" data-id="{{$catt->if}}"><a class="supTab_link supTab_link{{$catt->id}}" data-id="{{$catt->id}}" >{{$catt->name}}</a></li>

                            @endforeach
                                </ul>
                            </div>
                               @endif
                            @endif
                            </div>


                        </div>
                        @endif



                        <div class="settings">
                            <div class="select select_area ">
                            <select id="area" name="area" aria-label="select-area">
                                <option value="*">@lang('site.areas_all')</option>
                                @foreach($areas->where('parent_id',null) as $are)
                                <option value="{{$are->id}}" {{isset($area) && $area->id==$are->id?'selected':''}}>{{$are->name}} </option>
                                @endforeach
                            </select>

                            </div>
                            
                           <div class="sub_select sub_select_area select_area" id="sub_select_area">
                            @if(isset($area) && $area->children->count()>0)
                            <select  name="area">
                                <option value="{{$area->id}}">@lang('site.all')</option>
                                @foreach($area->child as $area_c )
                                <option value="{{$area_c->id}}">{{$area_c->name}} </option>
                                @endforeach
                            </select>
                            @endif
                            
                            </div>
                            
                            <div class="modal-year">
                              <select name="modal" class="modal_year d-none" ></select>
                             
                            </div>
                            
                         
                        <button aria-label="filter" class="filter-btn" data><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sliders-v" class="svg-inline--fa fa-sliders-v fa-w-14 fa-fw " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M112 96H96V16c0-8.8-7.2-16-16-16H48c-8.8 0-16 7.2-16 16v80H16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h16v336c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V160h16c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm320 128h-16V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v208h-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h16v208c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V288h16c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM272 352h-16V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v336h-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h16v80c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-80h16c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16z"></path></svg>@lang('site.filtering')</button>



                            <div class="tag-filters__item " >
                                <button class="btn btn-dark" aria-label="dark">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="images" class="svg-inline--fa fa-images fa-w-18 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M480 416v16c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V176c0-26.51 21.49-48 48-48h16v208c0 44.112 35.888 80 80 80h336zm96-80V80c0-26.51-21.49-48-48-48H144c-26.51 0-48 21.49-48 48v256c0 26.51 21.49 48 48 48h384c26.51 0 48-21.49 48-48zM256 128c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-96 144l55.515-55.515c4.686-4.686 12.284-4.686 16.971 0L272 256l135.515-135.515c4.686-4.686 12.284-4.686 16.971 0L512 208v112H160v-48z"></path>
                                    </svg>
                                </button>
                            </div>

                            <button class="search-btn" data-toggle="modal" data-target="#Modal-Search" aria-label="search"><i class="fas fa-search"></i></button>

                        </div>
                        
                        
                            <div class="tags d-flex flex-wrap scrollbar"></div>

                        <div class="tag-filters-extra d-none">

                            <div class="tag-filters checkbox-button"><input type="checkbox" id="orderByPostIdCheckbox">
                                <label for="orderByPostIdCheckbox" class="show_filter_2">@lang('site.only new')</label>
                            </div>

                        </div>
                        <div class="tag-filters-extra-car d-none">
                            <div class="tag-filters checkbox-button"><input type="radio" id="diesel" name="carOnly" class="car-filter-diesel">
                                <label for="diesel" class="show_filter_2">@lang('site.diesel')</label>
                            </div>
                             <div class="tag-filters checkbox-button"><input type="radio" id="concession" name="carOnly" class="car-filter-concession">
                                <label for="concession" class="show_filter_2">@lang('site.concession')</label>
                            </div>
                            <div class="tag-filters checkbox-button"><input type="radio" id="scraping" name="carOnly" class="car-filter-scraping">
                                <label for="scraping" class="show_filter_2">@lang('site.Scraping')</label>
                            </div>
                        </div>
                        <div class="main-content">
                            @if(Auth::check())
                            @if(isset($mainCat))
                           <?php  $follow=\App\Models\followCat::where(['cat_id'=>$mainCat->id,'user_id'=>auth::user()->id])->first();?>
                                <div class="follow-switch-wrap">
                                <span class="icon">
                                    <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="bell" class="svg-inline--fa fa-bell fa-w-14 fa-fw " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M439.39 362.29c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71zM67.53 368c21.22-27.97 44.42-74.33 44.53-159.42 0-.2-.06-.38-.06-.58 0-61.86 50.14-112 112-112s112 50.14 112 112c0 .2-.06.38-.06.58.11 85.1 23.31 131.46 44.53 159.42H67.53zM224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64z"></path>
                                    </svg>
                                </span> @lang('site.follow') {{$mainCat->name}}
                                <div class="toggle-btn {{$follow != null?'active':''}}" id="{{$mainCat->id}}">
                                    <div class="mark {{$follow != null?'active':''}}"></div>
                                </div>
                            </div>
                            @endif
                            @endif
                            <div class="box-content active" id="items-show">
                                @if(!empty($posts))

                                    @foreach($posts->where('active',1) as $post)
                                    <div class="postOneImage single-product">


                                        <div class="postInfo">
                                            <div class="postTitle">
                                                <!--<a href="{{url('/')}}/single/post/{{$post->id}}" style="width: 100%;">{{$post->title}}</a>-->
                                                <a href="{{ route('single_post', ['id' => $post->id, 'slug' => $post->slug]) }}" style="width: 100%;">{{$post->title}}</a>


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
                                            $logo=$setting->where('name','logo')->first()->value;
                                            }else{
                                                $logo=$img->image;
                                            }
                                            ?>
                                            <img src="{{url('/')}}/public/storage/{{$logo}}"  alt="{{$post->title}}">
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="post_ajax"></div>

                                @endif
                          </div>

                            <div class="row">
                                         @if(!empty($posts))

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
                                            <button type="button" class="PostImagesCarousel-fav-btn" aria-label="fav">
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
                                                    <!--<a href="{{url('/')}}/single/post/{{$post->id}}" style="width: 100%;">{{$post->title}}</a>-->
                                                    
                                                <a href="{{ route('single_post', ['id' => $post->id, 'slug' => $post->slug]) }}" style="width: 100%;">{{$post->title}}</a>

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
                                    @endif
                                     <div class="post_ajax"></div>
                            </div>

                            <div class="post_ajax1  ">

                            </div>
                            <div>
                                <button id="more" class="btn btn-primary" aria-label="more">
                                    <span>@lang('site.see more')</span>
                                    <span>... </span>
                                </button>
                            </div>

                            <ul class="other-list cityList">
                               @foreach($areas->where('parent_id',null) as $area)
                              @if(!isset($mainCat))
                               <li><a href="{{url('/')}}/city/{{$area->id}}">@lang('site.siteName') {{$area->name}}</a></li>
                               @else
                                <li><a href="{{url('/')}}/city/{{$area->id}}/{{$mainCat->id}}" class="cityCat" data-id="{{$area->id}}" data-cat="{{$mainCat->id}}">@lang('site.siteName') {{$mainCat->name}} @lang('site.in') {{$area->name}} </a></li>

                               @endif
                               @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--========================== End home content ==========================-->

     <!--============= Start modal map ===============-->

    <div class="modal fade customModal" id="Modal_map" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true" style="padding: 0 17px;">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:100%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal_content">
                    <div class="map_wrapper">
                        <iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=%D8%A7%D9%84%D8%B3%D8%B9%D9%88%D8%AF%D9%8A%D8%A9%20%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0"
                            marginwidth="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--============= End modal map ===============-->

 @endsection
 @section('script')
<script>
var ENDPOINT = "{{ url('/') }}";
        var page = 1;

        $("#more").on("click",function(){
            page++;
                infinteLoadMore(page);

                $(this).hide();
        });

        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= ($(document).height()-50)) {
                page++;
                infinteLoadMore(page);
            }
        });

        function infinteLoadMore(page) {

            $.ajax({
                    url: "{{url('/')}}/{{app()->getLocale() }}?page=" + page,
                    datatype: "html",
                    type: "get",
                    beforeSend: function () {
                        $('.auto-load').show();

                    }
                })
                .done(function (response) {
                    if (response.length == 0) {
                        $('.auto-load').html("We don't have more data to display :(");
                        return;
                    }
                    $('.auto-load').hide();
                    $(".post_ajax1").append(response);
                   loadowl();
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }
</script>
<script>
    window.setTimeout(function(){
location.reload();
},900000);
</script>
<script>
$(document).on('change','.year_search',function(e) {
 var cat=$(this).attr('data-cat');
 var modal=e.target.value;

 $.ajax({
        url:'{{ route('search_with_modal') }}',
        type:'post',
        data: {
            id : cat,
            model:modal,
            _token: "{{ csrf_token() }}"
         },success:function(res){
               $('.single-product').remove();
               $('.single-product1').remove();
             $('.post_ajax1').prepend(res);
             loadowl();

         }});
});
$(document).on('change','.tagSelectLevel',function(e){
    // $(".show_marka").hide();
    var cat_id = e.target.value;
    var select = $(this).attr('id');
    var id = $('#'+select).next();
   var selecttab=$(this).attr('data-id');
 $('.show_marka').show();
 console.log("cat"+cat_id);

   console.log('deleted');
  console.log(selecttab);
    if(id.length > 0){
    //   $(".show_marka").attr("data-main_cat").val(main)
        $('#'+select).nextAll('.tagSelectLevel').remove();
         $('#'+selecttab).nextAll('.list-container-wrap').remove();
          $('.year_search').remove();
    }else if( !$(this).attr('id') ){
          $('.show_marka:not([data-main_cat="'+cat_id+'"])').hide();

        $(".mainFilter").removeClass('active');
    $(".mainF"+cat_id).addClass("active");
    console.log('deleted');
        lang = '{{ app()->getLocale() }}';
        console.log(lang);
        $(this).nextAll('.tagSelectLevel').remove();
        $(".listFilter").empty();
        $('.year_search').remove();
    }
 $(".supTab_link"+cat_id).addClass("active").parent().siblings().find("a").removeClass("active");
    $.ajax({
        url:'{{ route('get_subcat') }}',
        type:'post',
        data: {
            id : cat_id,

            _token: "{{ csrf_token() }}"
         },success:function(res){
            console.log(res);
            // $(this).next().addBack().remove();
            if(res.length>0){
                // alert($('.subcat_'+cat_id).length);
                if($('.subcat_'+cat_id).length == 0){
                    if(lang == 'ar'){
                        $('.subcat').append('<select class="tagSelectLevel" id="subcat_'+cat_id+'" data-id="subcat2'+cat_id+'" name="sub_cat"><option>--إختر القسم الفرعى--</option></select>');
                    }else{
                        $('.subcat').append('<select class="tagSelectLevel" id="subcat_'+cat_id+'" data-id="subcat2'+cat_id+'" name="sub_cat"><option>--Choose SubCategory--</option></select>');
                    }

                if(!$('#supTab'+cat_id).length){
               $('.listFilter').append('<div class="list-container-wrap"  id="subcat2'+cat_id+'" ><ul dir="rtl" class="tabs_list supTabs  list-container" id="supTab'+cat_id+'"></ul></div>');
                }
               $('#supTab'+cat_id).empty();
               $.each(res, function( n , val ) {
                   if(lang == "ar"){
                        $('#subcat_'+cat_id).append('<option value="'+ val.id +'">'+ val.name_ar +'</option>');
                        $('#supTab'+cat_id).append('<li class="supTab" data-id="'+val.id+'"><a class="supTab_link supTab_link'+val.id+'" data-id="'+val.id+'" >'+val.name_ar+'</a></li>');
                   }else{
                        $('#subcat_'+cat_id).append('<option value="'+ val.id +'">'+ val.name_en +'</option>');
                        $('#supTab'+cat_id).append('  <li class="supTab" data-id="'+val.id+'"><a class="supTab_link supTab_link'+val.id+'" data-id="'+val.id+'" >'+val.name_en+'</a></li>');

                   }
                    // $(this).child().remove();
                });
                }else{
                }
            }else{

                                        $.ajax({
                            url:'{{ route('get_cat') }}',
                            type:'post',
                            data: {
                                id : cat_id,
                                _token: "{{ csrf_token() }}"
                             },success:function(res){
                                 console.log(res[0].is_year);
                                //  if(res[0].is_year==1){
                                     
                                //      $('.modal-year').append(  '<select class=" year_search" id="subcat_'+cat_id+'" name="modal" data-cat="'+cat_id+'"><option>--@lang('site.choose model')--</option></select>');

                                     
                                //     $('.subcat').append(  '<select class=" year_search" id="subcat_'+cat_id+'" name="modal" data-cat="'+cat_id+'"><option>--@lang('site.choose model')--</option></select>');
                                //     $('.settings .select .sub_select').html('<select class=" year_search" id="subcat_'+cat_id+'" name="modal" data-cat="'+cat_id+'"><option>@lang('site.choose model')</option></select>')
                                //   console.log(res[2]);
                                //   for(var i=res[2];i>=res[1];i--){
                                //      $(".year_search").append('<option value="'+ i +'">'+ i +'</option>')
                                //   }
                                //  }
                                
                                if (res[0].is_year == 1) {
                                    // Create the select element for modal-year
                                    var modalYearSelect = $('<select class="year_search" id="subcat_' + cat_id + '" name="modal" data-cat="' + cat_id + '"><option>@lang('site.choose model')</option></select>');
                                
                                    // Create the select element for subcat
                                    var subcatSelect = $('<select class="year_search" id="subcat_' + cat_id + '" name="modal" data-cat="' + cat_id + '"><option>@lang('site.choose model')</option></select>');
                                
                                    // Create the select element for settings sub_select
                                    var settingsSelect = $('<select class="year_search" id="subcat_' + cat_id + '" name="modal" data-cat="' + cat_id + '"><option>@lang('site.choose model')</option></select>');
                                
                                    // Populate the select elements with year options
                                    for (var i = res[2]; i >= res[1]; i--) {
                                        modalYearSelect.append('<option value="' + i + '">' + i + '</option>');
                                        subcatSelect.append('<option value="' + i + '">' + i + '</option>');
                                        settingsSelect.append('<option value="' + i + '">' + i + '</option>');
                                    }
                                
                                    // Append the select elements to the respective containers
                                    $('.modal-year').append(modalYearSelect);
                                    $('.subcat').append(subcatSelect);
                                    $('.settings .select .sub_select').html(settingsSelect);
                                }

                             },error:function(err){
                                 console.log(err);}

                                        });
            }
         },error:function(err){
             console.log(err);
         }
    });
    var area=$('select[name="area"] option:selected').val();
        console.log('area:'+area);

    $.ajax({
        url:'{{ route('tagFilter') }}',
        type:'post',
        data: {
            cat_id : cat_id,
            area_id:area,
            _token: "{{ csrf_token() }}"
         },success:function(res){
             console.log('res'+res);
             $('.single-product').remove();
             $('.single-product1').remove();
             $('.post_ajax1').prepend(res);
             loadowl();
             $('#more').hide();
            }

    });
    $.ajax({
        url:'{{ route('city_ajax') }}',
        type:'post',
        data: {
            cat_id : cat_id,
            _token: "{{ csrf_token() }}"
         },success:function(res){

             $(".cityList").empty();

            $.each(res[0], function( n , val ) {
                if(lang == "ar"){
                    $(".cityList").append('<li><a href="{{url('/')}}/city/'+val.id+'/'+res[1].id+'"  class="cityCat" data-id="'+val.id+'" data-cat="'+res[1].id+'">@lang('site.siteName') '+res[1].name_ar+' @lang('site.in') '+val.name_ar+'</a></li>');
                }else{
                    $(".cityList").append('<li><a href="{{url('/')}}/city/'+val.id+'/'+res[1].id+'"  class="cityCat" data-id="'+val.id+'" data-cat="'+res[1].id+'">@lang('site.siteName') '+res[1].name_en+' @lang('site.in') '+val.name_en+'</a></li>');
                }
            });


            }

    });
    $.ajax({
        url:'{{ route('get_session_ajax') }}',
        type:'get',
        data: {
         },success:function(res){

             $(".session").empty();
             console.log(res);
            $.each(res, function( n , val ) {

                 $(".session").append('<a href="{{url('/')}}/tag/'+val.id+'">'+val.title+'</a><hr>');
                });
                $(".session").append('<a href="{{route('delSession')}}"> <div class="smallText"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times-circle" class="svg-inline--fa fa-times-circle fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 464c-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216 0 118.7-96.1 216-216 216zm94.8-285.3L281.5 256l69.3 69.3c4.7 4.7 4.7 12.3 0 17l-8.5 8.5c-4.7 4.7-12.3 4.7-17 0L256 281.5l-69.3 69.3c-4.7 4.7-12.3 4.7-17 0l-8.5-8.5c-4.7-4.7-4.7-12.3 0-17l69.3-69.3-69.3-69.3c-4.7-4.7-4.7-12.3 0-17l8.5-8.5c4.7-4.7 12.3-4.7 17 0l69.3 69.3 69.3-69.3c4.7-4.7 12.3-4.7 17 0l8.5 8.5c4.6 4.7 4.6 12.3 0 17z"></path></svg><span>مسح السجل</span> </div> </a><hr><br>')  ;
            }

    });



});

$(document).on('click','.mainFilter',function(e){
    $.ajax({
        url:'{{ route('get_session_ajax') }}',
        type:'get',
        data: {
         },success:function(res){

             $(".session").empty();
             console.log(res);
            $.each(res, function( n , val ) {
                 $(".session").append('<a href="{{url('/')}}/tag/'+val.id+'">'+val.title+'</a><hr>');
                });
                $(".session").append('<a href="{{route('delSession')}}"> <div class="smallText"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times-circle" class="svg-inline--fa fa-times-circle fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 464c-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216 0 118.7-96.1 216-216 216zm94.8-285.3L281.5 256l69.3 69.3c4.7 4.7 4.7 12.3 0 17l-8.5 8.5c-4.7 4.7-12.3 4.7-17 0L256 281.5l-69.3 69.3c-4.7 4.7-12.3 4.7-17 0l-8.5-8.5c-4.7-4.7-4.7-12.3 0-17l69.3-69.3-69.3-69.3c-4.7-4.7-4.7-12.3 0-17l8.5-8.5c4.7-4.7 12.3-4.7 17 0l69.3 69.3 69.3-69.3c4.7-4.7 12.3-4.7 17 0l8.5 8.5c4.6 4.7 4.6 12.3 0 17z"></path></svg><span>مسح السجل</span> </div> </a><hr><br>')  ;
            }

    });

    $('.mainFilter').removeClass('active');
var cat_id=$(this).attr('data-id');

$(".tagSelectLevel ").val(cat_id).change();
$(".tagSelectLevel ").find("option[value='"+cat_id+"']").attr("selected","selected");
});
$(document).on('click','.supTab_link',function(e){
    $(this).addClass("active").parent().siblings().find("a").removeClass("active");

    $.ajax({
        url:'{{ route('get_session_ajax') }}',
        type:'get',
        data: {
         },success:function(res){

             $(".session").empty();
             console.log(res);
            $.each(res, function( n , val ) {

                 $(".session").append('<a href="{{url('/')}}/tag/'+val.id+'">'+val.title+'</a><hr>');
                });
                $(".session").append('<a href="{{route('delSession')}}"> <div class="smallText"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times-circle" class="svg-inline--fa fa-times-circle fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 464c-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216 0 118.7-96.1 216-216 216zm94.8-285.3L281.5 256l69.3 69.3c4.7 4.7 4.7 12.3 0 17l-8.5 8.5c-4.7 4.7-12.3 4.7-17 0L256 281.5l-69.3 69.3c-4.7 4.7-12.3 4.7-17 0l-8.5-8.5c-4.7-4.7-4.7-12.3 0-17l69.3-69.3-69.3-69.3c-4.7-4.7-4.7-12.3 0-17l8.5-8.5c4.7-4.7 12.3-4.7 17 0l69.3 69.3 69.3-69.3c4.7-4.7 12.3-4.7 17 0l8.5 8.5c4.6 4.7 4.6 12.3 0 17z"></path></svg><span>مسح السجل</span> </div> </a><hr><br>')  ;
            }

    });

var cat_id=$(this).attr('data-id');
console.log(cat_id);
$.ajax({
        url:'{{ route('get_parentcat') }}',
        type:'post',
        data: {
            id : cat_id,
            _token: "{{ csrf_token() }}"
         },success:function(res){
             console.log(res.id);

             $("#subcat_"+res.id).find("option[value='"+cat_id+"']").change();
$("#subcat_"+res.id).find("option[value='"+cat_id+"']").attr("selected","selected");

            }

    });

});
$(document).on('change','.select_area select[name="area"]',function(e){
       var city=$(this).find('option:selected').val();
    var varList = new Array();
$(".tagSelectLevel").each(function(index, el) {

     varList[index] = el.value;

});
console.log(city);
$.ajax({
        url:'{{ route('get_post_area') }}',
        type:'post',
        data: {
            cat_ids : varList,
            area_id:city,
            _token: "{{ csrf_token() }}"
         },success:function(res){
            console.log('succss');
            console.log(res);

             $('.single-product').remove();
             $('.single-product1').remove();
             $('.post_ajax1').prepend(res);
              loadowl();
            },error:function(er){
                console.log(er);
            }

    });
    $.ajax({
        url:'{{ route('get_area_children') }}',
        type:'post',
        data: {
            area_id:city,
            _token: "{{ csrf_token() }}"
         },success:function(res){
console.log('succss');
console.log(res);
             if(res[2]>0){
                 $('#sub_select_area').empty();
                $("#sub_select_area").append('<select name="area" id="area_child">  <option value="'+res[0].id+'">@lang('site.all')</option></select>')  ;

                 $.each(res[1], function( n , val ) {
                     $("#sub_select_area select").append('<option value="'+val.id+'">'+val.name+'</option>');
                 });
            }
            },error:function(er){
                console.log(er);
            }

    });

console.log(varList);

});

/*====================== toggle button follow =======================*/

var toggle_btn = $('.follow-switch-wrap .toggle-btn'),
    toggle_mark = $('.follow-switch-wrap .mark');

toggle_btn.on('click', function() {
    console.log('jfh');
     $.ajax({
        url:'{{ route('followCat') }}',
        type:'post',
        data: {
            cat_id : toggle_btn.attr('id'),
            _token: "{{ csrf_token() }}"
         },success:function(res){
             console.log(res);
    toggle_btn.toggleClass('active');
    toggle_mark.toggleClass('active');
            },error:function(err){
                console.log(err);
            }

    });

})

</script>
<script>
    $('.filter-btn').on('click', function() {
        $(this).toggleClass('active');
        // var id = $('.mainFilter.active').attr('data-id');
        // console.log(id);
        // if(id == 1){

        //     $('.tag-filters-extra-car').toggleClass('d-none');
        //     $('.tag-filters-extra').toggleClass('d-none');
        // }else{
            // console.log('other');
            $('.tag-filters-extra').toggleClass('d-none');
            // $('.tag-filters-extra-car').addClass('d-none');
        // }
    });

    $('.car-filter-diesel').on('click',function(){
        $.ajax({
        url:'{{ route('tagFilterOnlyDiesel') }}',
        type:'post',
        data: {

            _token: "{{ csrf_token() }}"
        },success:function(res){
                $('.single-product').remove();
                $('.single-product1').remove();
                $('.post_ajax1').prepend(res);
                $('#more').hide();
                  loadowl();
        },error:function(err){
                console.log(err);
        }

        });
    });

    $('.car-filter-concession').on('click',function(){
        $.ajax({
        url:'{{ route('tagFilterOnlyConcession') }}',
        type:'post',
        data: {
            _token: "{{ csrf_token() }}"
        },success:function(res){
                $('.single-product').remove();
                $('.single-product1').remove();
                $('.post_ajax1').prepend(res);
                $('#more').hide();
                 loadowl();
        },error:function(err){
                console.log(err);
        }

        });
    });

    $('.car-filter-scraping').on('click',function(){
        $.ajax({
            url:'{{ route('tagFilterOnlyScraping') }}',
            type:'post',
            data: {

                _token: "{{ csrf_token() }}"
            },success:function(res){
                    $('.single-product').remove();
                    $('.single-product1').remove();
                    $('.post_ajax1').prepend(res);
                    $('#more').hide();
                          loadowl();
            },error:function(err){
                    console.log(err);
            }
        });
    });

    $("#orderByPostIdCheckbox").on('click',function(){


      $.ajax({
        url:'{{ route('tagFilterOnlyNew') }}',
        type:'post',
        data: {

            _token: "{{ csrf_token() }}"
         },success:function(res){

             $('.single-product').remove();
             $('.single-product1').remove();
             $('.post_ajax1').prepend(res);
             $('#more').hide();
               loadowl();
            },error:function(err){
                console.log(err);
            }

    });
});

</script>
<script>
    $("select[name='from']").on('change',function(){
        filterCreatedAt();
    });
       $("select[name='from']").on('change',function(){
        filterCreatedAt();
    });

    function filterCreatedAt(){
        var from=$("select[name='from']").val();
        var to=$("select[name='to']").val();
           $.ajax({
            url:'{{ route('filterByCreatedAt') }}',
            type:'post',
            data: {
                from:from,
                to:to,
                _token: "{{ csrf_token() }}"
            },success:function(res){
                    $('.single-product').remove();
                    $('.single-product1').remove();
                    $('.post_ajax1').prepend(res);
                    $(".main-content .owl-carousel").owlCarousel({
                        autoplay: false,
                        nav: true,
                        dots: true,
                        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                        loop: true,
                        items: 1
                    });
                    $('#more').hide();
            },error:function(err){
                    console.log(err);
            }
        });
       /* ===============================  question carousel  =============================== */

    }
</script>
<script>
    function loadowl(){
      $(".main-content .owl-carousel").owlCarousel({
    autoplay: false,
    nav: true,
    dots: true,
    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    loop: true,
    items: 1
});
    }
</script>
<script>
    $('.FilterGroup__Label-kok8t0-1').on('click', function() {
        $(this).parent().find('.YBCfw').slideToggle();
        $(this).find('i').toggleClass("fa-plus")
    })
</script>


@if(app()->getLocale() == 'ar')
    <script>
        $(document).ready(function () {

            function fetchTags() {
                let area_id = $('#area_child').val();
                let cat_id = $('.supTab_link.active').last().data('id');

                $.ajax({
                    url: '{{route('get-tags')}}',
                    type: 'GET',
                    data: {
                        "cat_id": cat_id,
                        "area_id": area_id
                    },
                    success: function (response) {
                        const category = response.category;
                        const area = response.area;

                        let tagsHtml = '';

                        if (area.children && area.children.length > 0) {
                            area.children.forEach(area_c => {

                                    tagsHtml += `<a class="tag" href="{{ url('city') }}/${area_c.id}/${cat_id}">${category.name_ar} في  ${area_c.name_ar} في ${area.name_ar} (${area_c.post_count})</a>`;


                            });


                        } else {
                            tagsHtml += `<a class="tag" href="{{url('city')}}/${area_id}/${cat_id}">${category.name_ar} في  ${area.name_ar} ${response.count}</a>`;
                        }

                        $('.tags').html(tagsHtml);

                    },
                    error: function (xhr) {
                        console.error('Error fetching tags:', xhr);
                    }
                });
            }

            $('#sub_select_area').change(function() {
                fetchTags();
            });

            $(document).on('click', '.supTab_link', function() {
                $('.supTab_link').removeClass('active');
                $(this).addClass('active');
                fetchTags();
            });
        });
    </script>

@else
    <script>
        $(document).ready(function () {

            function fetchTags() {
                let area_id = $('#area_child').val();
                let cat_id = $('.supTab_link.active').last().data('id');

                $.ajax({
                    url: '{{route('get-tags')}}',
                    type: 'GET',
                    data: {
                        "cat_id": cat_id,
                        "area_id": area_id
                    },
                    success: function (response) {
                        const category = response.category;
                        const area = response.area;

                        let tagsHtml = '';

                        if (area.children && area.children.length > 0) {
                            area.children.forEach(area_c => {

                                tagsHtml += `<a class="tag" href="{{ url('city') }}/${area_c.id}/${cat_id}">${category.name_en} in area ${area_c.name_en} in ${area.name_en} (${area_c.post_count})</a>`;

                            });


                        } else {
                            tagsHtml += `<a class="tag" href="{{url('city')}}/${area_id}/${cat_id}">${category.name_en} in ${area.name_ar} ${response.count}</a>`;
                        }

                        $('.tags').html(tagsHtml);

                    },
                    error: function (xhr) {
                        console.error('Error fetching tags:', xhr);
                    }
                });
            }

            $('#sub_select_area').change(function() {
                fetchTags();
            });

            $(document).on('click', '.supTab_link', function() {
                $('.supTab_link').removeClass('active');
                $(this).addClass('active');
                fetchTags();
            });
        });
    </script>


@endif





 @endsection
