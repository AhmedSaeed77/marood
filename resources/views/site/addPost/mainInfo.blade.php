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
            <form class="mb-5" action="{{route('store_post_user',$area->id)}}" method="post">
                @csrf
                <a href="javascript:history.back()">
                    <div><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path></svg></div>
                </a>
                <div class="addPost">
                    <div>
                    <label>@lang('site.post location')</label><br><span></span><span>{{$area->name}} </span>
                    <?php $parentArea=$area;?>
                    @while(!empty($parentArea->parent))
                        <?php   $parentArea=$parentArea->parent; ?>
                        <span>,{{$parentArea->name}}</span>
                    @endwhile
                </div>
                    <hr>
                    <div><label>@lang('site.post title')</label><br><input type="text"  placeholder="{{__('site.post_placholder')}}" maxlength="45" name="title_ar" required><small class="req_text">@lang('site.required')*</small>
                    
                    
                    
                    
                    
                    
                    <!--<label>@lang('site.post title en')</label><br><input type="text" placeholder="مثال:  هوندا اكورد 2017 فل كامل  " maxlength="45" name="title_en">-->
                        <hr><br>
                        
                        
                         @if($cat->parent_id != null && $cat->parent )
                                    {{$cat->parent->name}}
                                    <input type="hidden" name="cat_id" value="{{$cat->parent->id}}">
                                    @else
                                     {{$cat->name}}
                                    <input type="hidden" name="cat_id" value="{{$cat->id}}">
                                    @endif
                        @if($cat->id != '4030')
                            <div class="tag_selection_wrapper">
                            <div class="tag_selection_wrapper">
                                <div id="postingLevel1Off">

                                    <span class="change_main_cat">
                                    @if($cat->parent_id != null && $cat->parent )
                                    {{$cat->parent->name}}
                                    <input type="hidden" name"cat_id" value="{{$cat->parent->id}}">
                                    @else
                                     {{$cat->name}}
                                    <input type="hidden" name"cat_id" value="{{$cat->id}}">
                                    @endif
                                    </span>
                                    <span class="main_cat_appear" style="cursor: pointer;"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="edit" class="svg-inline--fa fa-edit fa-w-18 fa-1x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M417.8 315.5l20-20c3.8-3.8 10.2-1.1 10.2 4.2V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h292.3c5.3 0 8 6.5 4.2 10.2l-20 20c-1.1 1.1-2.7 1.8-4.2 1.8H48c-8.8 0-16 7.2-16 16v352c0 8.8 7.2 16 16 16h352c8.8 0 16-7.2 16-16V319.7c0-1.6.6-3.1 1.8-4.2zm145.9-191.2L251.2 436.8l-99.9 11.1c-13.4 1.5-24.7-9.8-23.2-23.2l11.1-99.9L451.7 12.3c16.4-16.4 43-16.4 59.4 0l52.6 52.6c16.4 16.4 16.4 43 0 59.4zm-93.6 48.4L403.4 106 169.8 339.5l-8.3 75.1 75.1-8.3 233.5-233.6zm71-85.2l-52.6-52.6c-3.8-3.8-10.2-4-14.1 0L426 83.3l66.7 66.7 48.4-48.4c3.9-3.8 3.9-10.2 0-14.1z"></path></svg>
                                    </span>

                                </div>
                                <div class="main_cat"></div>
                                <div class="sub_cat">
                                @if($cat->child->count()>0)
                                <select name="cat"  onchange="subCat()" class="cat removeSubCat" id="SubCatSelect" required>
                                    <option value="" selected disabled>@lang('site.choose category')</option>
                                @foreach($cat->child as $child)
                                    <option value="{{$child->id}}">{{$child->name}}</option>
                                @endforeach
                                </select>
                                @endif
                                </div>
                                <div class="catChild"></div>

                                <select name="model" class="model">
                                    <option value="" selected disabled>@lang('site.choose model')</option>

                                @for($i=date("Y")+1 ;$i >= $model; $i--)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                                </select>

                            </div>
                        </div>
                        @else
                        <div class="tag_selection_wrapper">
                            <div class="tag_selection_wrapper">
                                    <label>@lang('site.choose category')</label>
                                <div id="postingLevel2Off">
                                    @if($cat->child)
                                        @foreach($cat->child as $child)
                                        <div>
                                            <input type="radio" class="radio_cat" name="cat" value="{{ $child->id }}" >
                                            <label style="font-weight:normal">{{ $child->name }}</label>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="radio_sub_cat">
                                </div>
                                <div class="radio_sub_cat_button"></div>
                                <div class="radio_catChild"></div>

                            </div>

                            <div class="spare_parts">
                                <input type="hidden" value="{{ $cat->id }}" name="cat">
                                <div clas="row">
                                    <div>
                                        <label>@lang('site.choose the spare parts')</label>
                                    </div>
                                    <div>
                                    <select class="spare_parts custom-select" name="spares[]" multiple>
                                        @php
                                        $spares = App\Models\Cat::where('parent_id',4263)->get();
                                        @endphp
                                        @foreach($spares as $spare)
                                            <option value="{{ $spare->id }}">{{ $spare->name_ar }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endif
                        <small class="req_text">@lang('site.required')*</small>
                        
                          {{-- start data of real state---------------------------------------------------------------------------------------- --}}

                        <div style="display: none" class="show-real-state">
                            <select name="street" class="custom-select mt-3">
                                <option value="" disabled selected>@lang('site.street')</option>
                                <option value="residential">@lang('site.residential')</option>
                                <option value="commercial">@lang('site.commercial')</option>
                            </select>
                            <br>

                            <label class="mt-2">@lang('site.space')</label><br>
                            <input type="number" name="space" min="1"><br>

                            <label class="mt-2">@lang('site.age_of_state')</label><br>
                            <input name="age_of_state" type="range" id="rangeInput" min="1" max="100" value="1"> <span id="rangeValue">1</span><br>

                            <label class="mt-2">@lang('site.destination')</label><br>
                            <select class="custom-select" name="destination">
                                <option value="" disabled selected>@lang('site.destination_choose')</option>
                                <option value="north">@lang('site.north')</option>
                                <option value="south">@lang('site.south')</option>
                                <option value="east">@lang('site.east')</option>
                                <option value="west">@lang('site.west')</option>
                                <option value="southeast">@lang('site.southeast')</option>
                                <option value="southwest">@lang('site.southwest')</option>
                                  <option value="northeast">@lang('site.northeast')</option>
                                <option value="northwest">@lang('site.northwest')</option>
                                <option value="three_streets">@lang('site.three_streets')</option>
                                <option value="four_streets">@lang('site.four_streets')</option>
                            </select>
                            <br>

                            <label class="mt-2">@lang('site.street_width')</label><br>
                            <select class="custom-select" name="street_width">
                                <option value="" disabled selected>@lang('site.street_width_choose')</option>
                                <option value="6">6</option>
                                <option value="10">10</option>
                                <option value="12">12</option>
                                <option value="15">15</option>
                                <option value="18">18</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="60">60</option>
                                <option value="80">80</option>
                                <option value="100">100</option>
                            </select>
                            <br>

                            <label class="mt-2">@lang('site.rooms_number')</label><br>
                            <input name="rooms_number" type="range" id="rangeInput1" min="1" max="8" value="1"> <span id="rangeValue1">1</span><br>

                            <label class="mt-2">@lang('site.number_of_halls')</label><br>
                            <input name="number_of_halls" type="range" id="rangeInput2" min="1" max="8" value="1"> <span id="rangeValue2">1</span><br>

                            <label class="mt-2">@lang('site.number_of_bathrooms')</label><br>
                            <input name="number_of_bathrooms" type="range" id="rangeInput3" min="1" max="8" value="1"> <span id="rangeValue3">1</span><br>

                            <label class="mt-2">@lang('site.villa_type')</label><br>
                            <select class="custom-select" name="villa_type">
                                <option value="" disabled selected>@lang('site.villa_type_choose')</option>
                                <option value="independent">@lang('site.independent')</option>
                                <option value="duplex">@lang('site.duplex')</option>
                                <option value="townhouse">@lang('site.townhouse')</option>
                                <option value="with_apartments">@lang('site.with_apartments')</option>
                            </select>
                            <br>

                            <label class="mt-2">@lang('site.additional_options')</label><br>
                            <select class="custom-select" name="additional_options[]" multiple>
                                <option value="" disabled selected>@lang('site.additional_options_choose')</option>
                                <option value="equipped_kitchen">@lang('site.equipped_kitchen')</option>
                                <option value="feminine">@lang('site.feminine')</option>
                                <option value="driver_room">@lang('site.driver_room')</option>
                                <option value="maid_room">@lang('site.maid_room')</option>
                                <option value="there_is_a_fireplace">@lang('site.there_is_a_fireplace')</option>
                                <option value="appendix">@lang('site.appendix')</option>
                                <option value="car_entrance">@lang('site.car_entrance')</option>
                                <option value="elevator">@lang('site.elevator')</option>
                                <option value="vault">@lang('site.vault')</option>
                                <option value="air_conditioning">@lang('site.air_conditioning')</option>
                                <option value="swimming_pool">@lang('site.swimming_pool')</option>
                                <option value="drawer">@lang('site.drawer')</option>
                                <option value="monsters">@lang('site.monsters')</option>
                            </select>
                            <br>
                        </div>

                        {{-- end data of real state-------------------------------------------------------------------------------------- --}}

                    
                        
                        <hr>
                        <label>@lang('site.Mobile number or method of communication')</label>
                        <br>
                        <input type="checkbox" name="noContact" id="hide-number" onclick="hideNumber()"> @lang('site.Hide mobile number')<br>
                        <input name="contact" type="tel" value="{{auth::user()->phone??''}}" id="input-tel">
                        <hr>
                        <br>
                        <br>

                        <!--@if($parent->type==1 || $cat->type==1)-->
                        <!--<div class="site-settings">-->
                        <!--    <div>-->
                        <!--        <div style="margin-bottom: 20px;">-->
                        <!--            <label class="label-block">-->
                        <!--        @lang('site.post Type')</label>-->
                        <!--            <div>-->
                        <!--                <label class="radio-option-label">-->
                        <!--                <input data-name="نوع الأعلان"  type="radio" name="typeOfPost" data-name"@lang('site.post Type')" data-label="بيع" value="1"><span>@lang('site.sale')</span>-->
                        <!--            </label>-->
                        <!--            </div>-->
                        <!--            <div>-->
                        <!--                <label class="radio-option-label">-->
                        <!--        <input type="radio" data-name="نوع الأعلان" name="typeOfPost" data-label="تنازل" value="2">-->
                        <!--       <span> @lang('site.concession')</span></label>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="d-none" id="sellCar" style="margin-bottom: 20px;">-->
                        <!--            <label class="label-block">@lang('site.car status')</label>-->
                        <!--            <div>-->
                        <!--                <label class="radio-option-label">-->
                        <!--                <input type="radio" name="condition" data-name="حالة السيارة" data-label="مستعملة" value="1"><span>@lang('site.Used')</span></label>-->
                        <!--            </div>-->
                        <!--            <div>-->
                        <!--                <label class="radio-option-label">-->
                        <!--                    <input type="radio" name="condition" data-name="حالة السيارة" data-label="وكالة" value="2"><span>@lang('site.Agency')</span></label>-->
                        <!--            </div>-->
                        <!--            <div>-->
                        <!--                <label class="radio-option-label">-->
                        <!--                    <input type="radio" name="condition"data-name="حالة السيارة" data-label="تشليح" value="3"><span>@lang('site.Scraping')</span></label>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="d-none" id="installment" style="margin-bottom: 20px;">-->
                        <!--            <label class="label-block">-->
                        <!--           @lang('site.The installment side')</label>-->
                        <!--            <select name="leaseSourse" class="d-block">-->
                        <!--            <option value="">@lang('site.undefined')</option>-->
                        <!--            @foreach($banks as $bank)-->
                        <!--            <option value="{{$bank->name}}">{{$bank->bankName}}</option>-->
                        <!--            @endforeach-->
                        <!--        </select>-->
                        <!--        </div>-->
                        <!--        <div style="margin-bottom: 20px;">-->
                        <!--            <label class="label-block">-->
                        <!--        @lang('site.Gear type?')</label>-->
                        <!--            <div>-->
                        <!--                <label class="radio-option-label">-->
                        <!--        <input type="radio" name="gear" data-name="نوع القير"data-label="أتوماتيك" value="1">-->
                        <!--        @lang('automatic')</label>-->
                        <!--            </div>-->
                        <!--            <div>-->
                        <!--                <label class="radio-option-label">-->
                        <!--        <input type="radio" name="gear"data-name="نوع القير" data-label="عادى" value="0">-->
                        <!--        @lang('site.Normal')</label>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div style="margin-bottom: 20px;">-->
                        <!--            <label class="label-block">-->
                        <!--        @lang('site.Fuel type?')</label>-->
                        <!--            <div>-->
                        <!--                <label class="radio-option-label">-->
                        <!--        <input type="radio" name="fuel" data-name="نوع الوقود" data-label="بنزين" value="0">-->
                        <!--         @lang('site.petrol') </label>-->
                        <!--            </div>-->
                        <!--            <div>-->
                        <!--                <label class="radio-option-label">-->
                        <!--        <input type="radio" name="fuel" data-name="نوع الوقود" data-label="هجين" value="1">-->
                        <!--        @lang('site.hybrid')</label>-->
                        <!--            </div>-->
                        <!--            <div>-->
                        <!--                <label class="radio-option-label">-->
                        <!--        <input type="radio" name="fuel" data-name="نوع الوقود" data-label="ديزل" value="2">-->
                        <!--         @lang('site.diesel')</label>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div>-->
                        <!--        <label class="radio label-block">-->
                        <!--        @lang('site.Double ?')</label>-->
                        <!--        <div>-->
                        <!--            <input type="checkbox" value="1" name="double">-->
                        <!--            <label class="radio-option-label">-->
                        <!--        @lang('site.yes')</label>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <br>-->
                        <!--    <div>-->
                        <!--        <label>@lang('site.counter')</label>-->
                        <!--        <br>-->
                        <!--        <input class="range" id="counter" data-name="العداد" type="range" name="km" min="0" max="100" value="0" step="1" ontouchmove="rangevalue1.value=value + 'الف كم'" onmousemove="rangevalue1.value=value + 'الف كم'" />-->
                        <!--        <br>-->
                        <!--        <output id="rangevalue1">-->
                        <!--        0 @lang('site.km')</output>-->
                        <!--        <hr>-->
                        <!--    </div>-->

                        <!--</div>-->
                        <!--@endif-->
                        
                        
                         @if($parent->type==1 || $cat->type==1)
                        <div class="site-settings">
                            <div>
                                <div style="margin-bottom: 20px;">
                                    <label class="label-block">
                                @lang('site.post Type')</label>
                                    <div>
                                        <label class="radio-option-label">
                                        <input data-name="@lang('site.post Type')"  type="radio" name="typeOfPost" data-name"@lang('site.post Type')" data-label="@lang('site.sale')" value="1"><span>@lang('site.sale')</span>
                                    </label>
                                    </div>
                                    <div>
                                        <label class="radio-option-label">
                                <input type="radio" data-name="@lang('site.post Type')" name="typeOfPost" data-label="@lang('site.concession')" value="2">
                               <span> @lang('site.concession')</span></label>
                                    </div>
                                </div>
                                <div class="d-none" id="sellCar" style="margin-bottom: 20px;">
                                    <label class="label-block">@lang('site.car status')</label>
                                    <div>
                                        <label class="radio-option-label">
                                        <input type="radio" name="condition" data-name="@lang('site.car status')" data-label="@lang('site.Used')" value="1"><span>@lang('site.Used')</span></label>
                                    </div>
                                    <div>
                                        <label class="radio-option-label">
                                            <input type="radio" name="condition" data-name="@lang('site.car status')" data-label="@lang('site.Agency')" value="2"><span>@lang('site.Agency')</span></label>
                                    </div>
                                    <div>
                                        <label class="radio-option-label">
                                            <input type="radio" name="condition"data-name="@lang('site.car status')" data-label="@lang('site.Scraping')" value="3"><span>@lang('site.Scraping')</span></label>
                                    </div>
                                </div>
                                <div class="d-none" id="installment" style="margin-bottom: 20px;">
                                    <label class="label-block">
                                   @lang('site.The installment side')</label>
                                    <select name="leaseSourse" class="d-block">
                                    <option value="">@lang('site.undefined')</option>
                                    @foreach($banks as $bank)
                                    <option value="{{$bank->name}}">{{$bank->bankName}}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <label class="label-block">
                                @lang('site.Gear type?')</label>
                                    <div>
                                        <label class="radio-option-label">
                                <input type="radio" name="gear" data-name="@lang('site.Gear type?')" data-label="@lang('site.automatic')" value="1">
                                @lang('site.automatic')</label>
                                    </div>
                                    <div>
                                        <label class="radio-option-label">
                                <input type="radio" name="gear"data-name="@lang('site.Gear type?')" data-label="@lang('site.Normal')" value="0">
                                @lang('site.Normal')</label>
                                    </div>
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <label class="label-block">
                                @lang('site.Fuel type?')</label>
                                    <div>
                                        <label class="radio-option-label">
                                <input type="radio" name="fuel" data-name="@lang('site.Fuel type?')" data-label="@lang('site.petrol')" value="0">
                                 @lang('site.petrol') </label>
                                    </div>
                                    <div>
                                        <label class="radio-option-label">
                                <input type="radio" name="fuel" data-name="@lang('site.Fuel type?')" data-label="@lang('site.hybrid')" value="1">
                                @lang('site.hybrid')</label>
                                    </div>
                                    <div>
                                        <label class="radio-option-label">
                                <input type="radio" name="fuel" data-name="@lang('site.Fuel type?')" data-label="@lang('site.diesel')" value="2">
                                 @lang('site.diesel')</label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="radio label-block">
                                @lang('site.Double ?')</label>
                                <div>
                                    <input type="checkbox" value="1" name="double">
                                    <label class="radio-option-label">
                                @lang('site.yes')</label>
                                </div>
                            </div>
                            <br>
                            
                            <!--<div>-->
                            <!--    <label>@lang('site.counter')</label>-->
                            <!--    <br>-->
                            <!--    <input class="range" id="counter" data-name="@lang('site.counter')" type="range" name="km" min="0" max="100" value="0" step="1" ontouchmove="rangevalue1.value=value + '{{__('site.km')}}'" onmousemove="rangevalue1.value=value + '{{__('site.km')}}'" />-->

                            <!--    <br>-->
                            <!--    <output id="rangevalue1">-->
                            <!--    0 @lang('site.km')</output>-->
                                
                            <!--    <hr>-->
                            <!--</div>-->
                            
                            
                             <div>
                                <label>@lang('site.counter')</label>
                                <br>
                                <input class="range" id="counter" data-name="@lang('site.counter')" type="range" name="km" min="0" max="200000" value="0" step="1" ontouchmove="rangevalue1.value=value" onmousemove="rangevalue1.value=value" />

                                <br>
                                <output id="rangevalue1">
                                0 </output>
                                
                                <span>@lang('site.kilo')</span>
                                <hr>
                            </div>

                        </div>
                        @endif
                        
                        
                        <label>@lang('site.Would you like to set a price?')</label>
                        <br>
                        <div>
                            <input type="radio" value="0" checked="" name="price">
                            <label style="margin-right: 5px;">@lang('site.no')</label>
                            <br>
                            <input type="radio" value="1" name="price">
                            <label style="margin-right: 5px;">@lang('site.yes')</label>
                        </div>
                        <input placeholder="1000" type="text" name="priceValue" value="" style="max-width: 200px;" id="priceInput">
                        <hr>
                        <label>@lang('site.post text')</label>
                        <br>
                        <small class="green">@lang('site.Click on the following text to edit or add')<svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="edit" class="svg-inline--fa fa-edit fa-w-18 fa-1x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M417.8 315.5l20-20c3.8-3.8 10.2-1.1 10.2 4.2V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h292.3c5.3 0 8 6.5 4.2 10.2l-20 20c-1.1 1.1-2.7 1.8-4.2 1.8H48c-8.8 0-16 7.2-16 16v352c0 8.8 7.2 16 16 16h352c8.8 0 16-7.2 16-16V319.7c0-1.6.6-3.1 1.8-4.2zm145.9-191.2L251.2 436.8l-99.9 11.1c-13.4 1.5-24.7-9.8-23.2-23.2l11.1-99.9L451.7 12.3c16.4-16.4 43-16.4 59.4 0l52.6 52.6c16.4 16.4 16.4 43 0 59.4zm-93.6 48.4L403.4 106 169.8 339.5l-8.3 75.1 75.1-8.3 233.5-233.6zm71-85.2l-52.6-52.6c-3.8-3.8-10.2-4-14.1 0L426 83.3l66.7 66.7 48.4-48.4c3.9-3.8 3.9-10.2 0-14.1z"></path></svg></small><br>
                        <textarea id="bodyTEXT" name="description" rows="9" placeholder="@lang('site.details') :" required></textarea>
                        <small class="req_text">@lang('site.required')*</small><br>
                        <!-- <div class="subtagWrapper"><label>@lang('site.selected categories')</label><br><span class="subtag_options"><span class="subtag"><span class="remove_btn"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times" class="svg-inline--fa fa-times fa-w-10 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"></path></svg></span>                            Person</span><span class="subtag"><span class="remove_btn"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times" class="svg-inline--fa fa-times fa-w-10 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"></path></svg></span>                            Hat</span> -->
                            </span>
                        </div><br><br>
                <!--------------------------------------- Start Area Map -------------------------------------->

                <hr>
               {{--
                <div class="map">
                    <label class="mb-3">اضف موقعك علي الخريطة</label>
                    <div id="mapid" style="width: 500px; height: 500px;"></div>
                </div>
                --}}


                </div>
                <input name="lat" id="lat" value="{{$location['lat'] ?? ''}}" style="display:none">
    			<input name="lng" id="lng" value="{{$location['lng'] ?? ''}}" style="display:none">
                <!--------------------------------------- End Area Map ---------------------------------------->
            <div class="buttons mt-3">
                <button type="submit" class="button  btn-lg btn-success mt-1">@lang('site.sent post')</button>
            </div>
            </form>
            <br>
        </div>
    </section>

    <!--========================== End add post page ==========================-->

@endsection
@section('script')
<script>
    $('.map').hide();
</script>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
//   tinymce.init({
//     selector: 'textarea#bodyTEXT',
//     skin: 'bootstrap',
//     plugins: 'lists, link, image, media',
//     toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
//     menubar: false
//   });
</script>

{{--
@if(Request::segment(5) == '4033' || Request::segment(5) == '4034')
<script>
    $('.map').show();
</script>
@endif
--}}
<script>


        $('input[name="price"]').on('change',function(){
            console.log($(this).val());
            if($(this).val()==true){
                $('#priceInput').show();
            }else{
                $('#priceInput').hide();
            }

                    });
    /*================================== Start Sub Categrories ======================================*/
    $('.model').hide();
    $('.spare_parts').hide();
    $('.main_cat_appear').on('click',function(){
       $('#postingLevel1Off').remove();
       $('.removeSubCat').remove();

       $.ajax({
        url:'{{ route('get_main_cat') }}',
        type:'post',
        data: {
            _token: "{{ csrf_token() }}"
         },success:function(res){
                $('.subcat').remove();
                $('.model').hide();
                $('.model_year').remove();
                console.log(res);
            if(res != ''){
                $('.main_cat').html('<select class="cat" onchange="mainCat()" id="mainCatSelect" required><option value="" selected disabled>@lang("site.choose category") </option></select>');
                $.each(res, function( n , val ) {
                    $('.main_cat .cat').append('<option value="'+ val.id +'">'+ val.name_ar +'</option>');
                });    var x = $('select').hasClass("subcat");
            }else{}
         },error:function(err){
             console.log(err);
         }
    });



    });

    $('.model').hide();
    $('.radio_cat').on('change',function(){
        var cat_id=$('input[type="radio"][name="cat"]:checked').val();
        $('.radio_sub_cat').hide();
        $('.items').remove();
        $('.spare_parts').hide();
        $.ajax({
            url:'{{ route('get_subcat') }}',
            type:'post',
            data: {
                id : cat_id,
                _token: "{{ csrf_token() }}"
             },success:function(res){
                console.log(res);
                if(res != ''){
                    if(cat_id != '4044'){
                    $('.radio_sub_cat').show();
                    $('.radio_sub_cat_button').html('<label>@lang("site.choose type")</label>');
                    $.each(res, function( n , val ) {
                        $(".radio_sub_cat_button").append('<div class="items"><input type="radio" onchange="radiosubCat()" class="radio_subcat" name="subcat" value="'+val.id+'"><label style="font-weight:normal">'+val.name_ar+'</label></div>');
                    });
                    }else{
                        $(".radio_sub_cat_button").html('<div><label class="items">@lang("site.choose decorations and accessories")</label></div><div><select name="brands[]" class="custom-select items cat'+cat_id+'" id="catSub" multiple><option value="" selected disabled >@lang("site.choose category")</option></select></div>');
                        $.each(res, function( n , val ) {
                            $('.radio_sub_cat_button .cat'+cat_id).append('<option value="'+ val.id +'">'+ val.name_ar +'</option>');
                        });
                    }
                }else{}
            },error:function(err){
                console.log(err);
            }
        });

    });
    // input[name="subcat"]
    function radiosubCat(){
        var cat_id= $('input[type="radio"][name="subcat"]:checked').val();
        console.log(cat_id);
        $('.items_select').remove();
        $.ajax({
        url:'{{ route('get_subcat') }}',
        type:'post',
        data: {
            id : cat_id,
            _token: "{{ csrf_token() }}"
         },success:function(res){
             console.log(res);
            if(res.length != 0){
            $(".radio_catChild").html('<div><label class="items_select items">@lang("site.choose brand")<span class="text-success">@lang("site.choose up to")</span></label></div><div><select name="brands[]" class="custom-select items_select items  cat'+cat_id+'" data-id="cat'+cat_id+'" multiple><option value="" selected disabled>@lang("site.choose category")</option></select></div>');
              $.each(res, function( n , val ) {
                    $('.radio_catChild .cat'+cat_id).append('<option value="'+ val.id +'">'+ val.name_ar +'</option>');

                });
                $('.spare_parts').show();

            }else{
                console.log('test');
            }
         },error:function(err){
             console.log(err);
         }
    });
    }

    function mainCat(){
        var cat_id= $('#mainCatSelect').val();
        $('.subcat').remove();
        $('.model').hide();
        $('.model_year').remove();
        $.ajax({
        url:'{{ route('get_subcat') }}',
        type:'post',
        data: {
            id : cat_id,
            _token: "{{ csrf_token() }}"
         },success:function(res){
            if(res.length != 0){
                if(cat_id == '4033' || cat_id == '4034'){
                    $('.map').show();
                }else{
                    $('.map').hide();
                }
            $(".sub_cat").html('<select name="cat"  onchange="subCat()" class="subcat cat'+cat_id+'" data-id="'+cat_id+'" id="SubCatSelect" required><option value="" selected disabled>@lang("site.choose category")</option></select>');
                $.each(res, function( n , val ) {
                    $('.sub_cat .cat'+cat_id).append('<option value="'+ val.id +'">'+ val.name_ar +'</option>');
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
                              $(".site-settings").show();
                              $('.model').show();
                          }else{
                              $('.site-settings').hide();
                          }
                     },error:function(err){
                         console.log(err);
                     }
                });
            }else{
                $('.subcat').remove();
                $('.model').hide();
                $('.model_year').remove();
            }
         },error:function(err){
             console.log(err);
         }
    });
    }

    function subCat(){
        var cat_id= $('#SubCatSelect').val();
        
         var currentLocale = "{{ app()->getLocale() }}";

        $.ajax({
        url:'{{ route('get_subcat') }}',
        type:'post',
        data: {
            id : cat_id,
            _token: "{{ csrf_token() }}"
         },success:function(res){
            if(res.length != 0){
                    var nameField = 'name_' + currentLocale;

            $(".catChild").html('<select name="cat"  onchange="subcat()" class="subcat cat cat'+cat_id+'" data-id="cat'+cat_id+'" required><option value="" selected disabled>@lang("site.choose category")</option></select>');
              $.each(res, function( n , val ) {
                    $('.catChild .cat'+cat_id).append('<option value="'+ val.id +'">'+ val[nameField] +'</option>');

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
                              $(".site-settings").show();
                              $('.model').show();
                          }else{
                              $('.site-settings').hide();

                          }
                     },error:function(err){
                         console.log(err);
                     }
                });
            }else{
                console.log('test');
            }
         },error:function(err){
             console.log(err);
         }
    });
    }


        /*================================== disabled input ======================================*/
        var checkBox = document.getElementById("hide-number");
        var input_tel = document.getElementById("input-tel");
        var value_tel = input_tel.getAttribute('value');

        function hideNumber() {

            if (checkBox.checked == true) {
                input_tel.setAttribute("disabled", "");
                input_tel.setAttribute("value", "");
            } else {
                input_tel.removeAttribute("disabled");
                input_tel.setAttribute("value", value_tel);

            }
        }

function initialize() {
    var e = new google.maps.LatLng(24.701925,46.675415), t = {
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


    function appended_text(){
                document.getElementById("bodyTEXT").innerHTML="";
            var ele = $('input:radio');

            for(i = 0; i < ele.length; i++) {

                if(ele[i].type="radio") {
                    if(ele[i].checked ){
                                if( jQuery(ele[i]).attr('data-name') && jQuery(ele[i]).attr('data-label') ){
                                    document.getElementById("bodyTEXT").innerHTML
                                            +=jQuery(ele[i]).attr('data-name') + " : "
                                            + jQuery(ele[i]).attr('data-label') + "\n";
                            }
                        }
                    }
                }
               var counter=document.getElementById('counter');

            // if(counter.value>0){
            //         document.getElementById("bodyTEXT").innerHTML
            //                         += "العداد"+ " : "
            //                         + counter.value +"الف كم"+ "\n";
            // }

               if(counter.value>0){
                    document.getElementById("bodyTEXT").innerHTML
                                    += "{{__('site.counter')}}" + " : "
                                    + counter.value + "\n";
            }
            
            
           if($("input[name='price']".value==true)){

                var price=document.getElementById('priceInput');
                    document.getElementById("bodyTEXT").innerHTML
                                    += "{{__('site.price')}}" + " : "
                                    + price.value + "\n";
            }

        }
         $("input[type='radio'][name='typeOfPost']").on('change',function(){
           appended_text();
         });
              $("input[type='radio'][name='condition']").on('change',function(){
           appended_text();
         });
               $("input[type='radio'][name='sellCar']").on('change',function(){
           appended_text();
         });
               $("input[type='radio'][name='gear']").on('change',function(){
           appended_text();
         });
               $("input[type='radio'][name='fuel']").on('change',function(){
           appended_text();
         });

                 $("#input[type='radio'][name='priceValue']").on('change',function(){
           appended_text();
         });
         $("#counter").on('change',function(){
              appended_text();
         });
</script>


{{-- start data of real state--}}
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

<script>

    $(document).ready(function () {

        $('#SubCatSelect').on('change',function(){

        let SubCatSelect = $('#SubCatSelect').val();

        $.ajax({
            url:'{{ route('check-real-state-type') }}',
            type:'get',
            data: {
                id : SubCatSelect,

            },success:function(res){

                if(res.code == 200){

                    $('.show-real-state').show();
                }else if (res.code == 520){

                    $('.show-real-state').hide();
                }
                else{

                    $('.show-real-state').hide();

                }
            },error:function(err){
              console.log(err);
            }
        });

    });
    });
</script>

{{-- end data of real state--}}

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwqrlZASdsR2P-KqDBBaGQrVFb7Uom2Uk&language=ar&callback=initialize"></script>
@endsection
