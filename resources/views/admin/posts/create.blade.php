@extends('admin.layouts.app')
@section('style')
<!--Form Wizard-->
<link rel="stylesheet" type="text/css" href="{{url('/')}}/public/admin/assets/plugins/jquery.steps/css/jquery.steps.css" />
<style>
    .d-none{
        display:none;
    }
</style>
@endsection
@section('content')
         <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                   <!-- Wizard with Validation -->

                   <div class="row">
                       
							<div class="col-sm-12">
								<div class="card-box">
									<h4 class="m-t-0 header-title"><b>{{__('post_create.add_ad')}}</b></h4>
									<p class="text-muted m-b-30 font-13">

									</p>

									<form id="wizard-validation-form" action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
                                       @csrf
                                        <div>
                                            <h3>Step 1</h3>
                                            <section>
                                                <div class="form-group clearfix">
                                                    <label class="col-lg-2 control-label " for="parent_id">{{__('post_create.main_category')}} </label>
                                                    <div class="col-lg-10">
                                                        <select class="required form-control" id="parent_id" name="parent_id" >
                                                        <option value="" selected>{{__('post_create.main_category')}}</option>
                                                            @foreach($cats->where('parent_id',null) as $cat)
                                                            <option value="{{$cat->id}}" data-type="{{$cat->type}}" data-year="{{$cat->is_year}}">{{$cat->name_ar}}</option>
                                                            @endforeach
                                                        </select>
                                                           @if($errors->has('parent_id'))
                                                                 <strong class=" alert-danger">{{ $errors->first('parent_id') }}</strong>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix child">
                                                    <label class="col-lg-2 control-label " for="childCat_id">{{__('post_create.sub_category')}} </label>
                                                    <div class="col-lg-10 childSelect">
                                                    <select class="required form-control" id="childCat_id" name="cat_id">
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix subchild">
                                                    <label class="col-lg-2 control-label " for="subchildCat_id">{{__('post_create.sub_category_child')}} </label>
                                                    <div class="col-lg-10 subchildSelect">
                                                    <select class="required form-control"  id="subchildCat_id" name="cat_id">
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix ">

                        <label>{{__('post_create.mobile_or_communication')}}</label>
                        <br>
                        <input type="checkbox" name="noContact" id="hide-number" onclick="hideNumber()"> {{__('post_create.hide_mobile_number')}}<br>
                        <input name="contact" class="form-control" type="tel" value="{{auth::user()->phone??''}}" id="input-tel">

                                                </div>

                                            </section>
                                            <h3>Step 2</h3>
                                            <section>

                                                <div class="form-group clearfix">
                                                    <label class="col-lg-2 control-label" for="title_ar">{{__('post_create.title_arabic')}}</label>
                                                    <div class="col-lg-10">
                                                        <input id="title_ar" name="title_ar" type="text" class="required form-control">
                                                    </div>
                                                </div>
                                                <!--<div class="form-group clearfix">-->
                                                <!--    <label class="col-lg-2 control-label" for="title_en">العنوان باللغة الانجليزية</label>-->
                                                <!--    <div class="col-lg-10">-->
                                                <!--        <input id="title_en" name="title_en" type="text" class="form-control">-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                                <?php $y=date("Y");?>
                                                            <div class="form-group clearfix"id="is_year">
                                                    <label class="col-lg-2 control-label" for="model">{{__('post_create.car_model')}}</label>
                                                    <div class="col-lg-10">
                                                        <select name="model" id="model" class="form-control ">
                                                        <option value=""  selected disabled> {{__('post_create.car_model')}}</optio
                                                        <?php $models=\App\Models\setting::where('name','modelNumber')->first()->value;?>
                                                        @for($x=$models;$x<=$y;$x++)
                                                                      <option value="{{$x}}">{{$x}}</option>
                                                        @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="car_details">
                <div class="site-settings">
                            <div>
                                <div class="form-group">
                                    <label class="label-block">
                                        {{__('post_create.ad_type')}}</label>

                                    <select name="typeOfPost" id="typeOfPost" class="form-control">
                                        <option value="1">  {{__('post_create.sale')}}</option>
                                        <option value="2">  {{__('post_create.waiver')}}</option>
                                    </select>


                                </div>
                                <div class="d-none form-group" id="sellCar" style="margin-bottom: 20px;">
                                    <label class="label-block"> {{__('post_create.car_condition')}} </label>
                                    <select class="form-control"name="condition">
                                        <option value="1" >{{__('post_create.used')}} </option>
                                        <option value="2">{{__('post_create.an_agency')}} </option>
                                        <option value="3">{{__('post_create.tashleh')}} </option>
                                    </select>

                                </div>
                                <div class="d-none form-group" id="installment" style="margin-bottom: 20px;">
                                    <label class="label-block">
                                        {{__('post_create.installment_source')}}</label>
                                    <select  name="leaseSourse" class="form-control d-block">
                                    <option value="">{{__('post_create.undefined')}}</option>
                                    @foreach(\App\Models\HarajBank::get() as $bank)
                                    <option value="{{$bank->name}}">{{$bank->bankName}}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="form-group">
                                    <label class="label-block">
                                        {{__('post_create.gear_type')}}</label>
                                <select class="form-control" name="gear">
                                    <option value="1">{{__('post_create.Automatic')}}</option>
                                    <option value="0">{{__('post_create.normal')}}</option>

                                </select>

                                </div>
                                <div class="form-group">
                                    <label class="label-block">
                                        {{__('post_create.fuel_type')}}</label>
                                <select class="form-control" name="fuel">
                                    <option value="0"> {{__('post_create.petrol')}}</option>
                                    <option value="1"> {{__('post_create.hybrid')}}</option>
                                    <option value="2"> {{__('post_create.Hybrid')}}</option>
                                </select>
                                    </div>


                            <div class="form-group">
                                <label class="radio label-block">
                                    {{__('post_create.double')}}</label>
                                <select class="form-control" name="double">
                                    <option value="1">{{__('post_create.yes')}}</option>
                                    <option value="0">{{__('post_create.no')}}</option>
                                </select>

                            </div>
                            <br>
                            <div>
                                <label>{{__('post_create.odometer')}}</label>
                                <br>
                                <input class="range" type="range" name="km" min="0" max="1000000" value="0" step="1" onmousemove="rangevalue1.value=value + 'كم'" />
                                <br>
                                <output id="rangevalue1">
                                0 كم</output>
                                <hr>
                            </div>

                        </div>

                                              </div>
                           </div>
                                                <div class="form-group clearfix">
                                                   <label>{{__('post_create.set_price')}}</label>
                                                        <br>
                                                        <div>
                                                            <input type="radio" value="false" checked="" name="price">
                                                            <label style="margin-right: 5px;">{{__('post_create.yes')}}</label>
                                                            <br>
                                                            <input type="radio" value="true" name="price">
                                                            <label style="margin-right: 5px;">{{__('post_create.no')}}</label>
                                                        </div>
                                                        <input placeholder="1000" type="text" class="form-control" name="priceValue" value="" style="max-width: 200px;" id="priceInput">
                                                        <hr>
                                                </div>
                                                <!-- <input type="hidden" name="longitude" id="longitude"/>
                                                <input type="hidden" name="latitude" id="latitude"/>
                                                <div class="form-group clearfix mapp ">
                                                <label class="col-lg-2 control-label " for="map">*مكان العقار</label>
                                                    <div class="col-lg-10 ">
                                                     <div id="map" style="height: 300px;width:100%;"></div>
                                                    </div>
                                                </div> -->
                                                <div class="form-group clearfix country">
                                                    <label class="col-lg-2 control-label " for="country">{{__('post_create.country')}} </label>
                                                    <div class="col-lg-10">
                                                    <select class="required form-control" id="country" name="area_id">
                                                    <option value="" selected disabled>{{__('post_create.city')}}</option>
                                                    @foreach($areas as $area)
                                                    <option value="{{$area->id}}">{{$area->name_ar}}</option>
                                                    @endforeach
                                                     </select>
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix city ">
                                                    <label class="col-lg-2 control-label " for="city">{{__('post_create.city')}} </label>
                                                    <div class="col-lg-10 citySelect">
                                                    <select class="required form-control" id="city" name="area_id">

                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <label class="col-lg-2 control-label " for="price">{{__('post_create.ad_images')}}</label>
                                                    <div class="col-lg-10">
                                                    <input type="file" name="file[]" class="form-control requird" multiple />
                                                    </div>
                                                </div>

                                                <div class="form-group clearfix">
                                                    <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                                </div>

                                            </section>
                                            <h3>Step 3</h3>
                                            <section>
                                                <div class="form-group clearfix">
                                                    <div class="col-lg-12">
                                                     <textarea name="description" placeholder="{{__('post_create.ad_details')}}" class="form-control required" id="desc"></textarea>
                                                    </div>
                                                </div>
                                            </section>
                                            <h3>Step Final</h3>
                                            <section>
                                                <div class="form-group clearfix">
                                                    <div class="col-lg-12">
                                                        <input id="acceptTerms-2" name="acceptTerms2" type="checkbox" class="required">
                                                        <label for="acceptTerms-2">{{__('post_create.agree_terms')}}</label>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </form>
								</div>
							</div>
						</div>


                        <!-- End row -->
                    </div>
                </div>
            </div>

@endsection

@section('afterscript')

    <!--Form Wizard-->
    <script src="{{url('/')}}/public/admin/assets/plugins/jquery.steps/js/jquery.steps.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="{{url('/')}}/public/admin/assets/plugins/jquery-validation/js/jquery.validate.min.js"></script>

        <!--wizard initialization-->
        <script src="{{url('/')}}/public/admin/assets/pages/jquery.wizard-init.js" type="text/javascript"></script>
        <script>
            $(document).ready(function(){
                $(".child").hide();
                $(".subchild").hide();
                $(".city").hide();
             
               
            });
                $('#parent_id').on('change',function(){
                    var cat_id=$(this).val();
             $(".car_details").hide();
                $("#is_year").hide();
                      
                               var type = $(this).children(":selected").attr("data-type");;
                    var year = $(this).children(":selected").attr("data-year");
                    console.log(type);
                    console.log(year);
                    if(type==1){
                        $(".car_details").show();
                    } 
                    if(year==1){
                        $("#is_year").show();
                    }
                    $(".child").hide();
                $(".subchild").hide();      
                    // console.log(cat_id);
                    $(".childSelect").empty();
                    // $(".child").show();
                    $.ajax({
                       url:"{{ route('getSubCat') }}",
                       type:"POST",
                       data: {
                           cat_id: cat_id,
                            _token: '{!! csrf_token() !!}',
                        },                
                       success:function (data)
                        {     if(data.length>0){
                            $(".child").show();
                            $(".child .childSelect").append('<select required class="childCat_id form-control" name="cat_id" id="subcat_'+cat_id+'"><option value="" disabled selected>اختر القسم الفرعى</option></select><br>')
                            $.each(data,function(index,model){
                                $('.child .childSelect .childCat_id').append('<option  data-value="'+model.name_ar+'" value="'+model.id+'">'+model.name_ar+'</option>');
                           
                              });
                        }
                          }
                   
                   });
                });
                $(document).on('change','.childCat_id',function(e){
                  var cat_id=$(this).val();
                    description();
                     var select = $(this).attr('id');
                     var id = $('#'+select).next();
                     
                      
                        if(id.length > 0){
                            $('#'+select).nextAll('.childCat_id').remove();
                        }else if( !$(this).attr('id') ){
                            $(".mainFilter").removeClass('active');
                       
                        console.log('deleted');
                            $(this).nextAll('.childCat_id').remove();
                           
                        }      
                    $.ajax({
                       url:"{{ route('getSubCat') }}",
                       type:"POST",
                       data: {
                           cat_id: cat_id,
                            _token: '{!! csrf_token() !!}',
                        },                  
                       success:function (data)
                        {   if(data.length>0){
                            $(".child .childSelect").append('<select name="cat_id" required class="childCat_id form-control" id="subcat_'+cat_id+'"><option value="" disabled selected>اختر القسم الفرعى</option></select><br>')
                            $.each(data,function(index,model){
                                $('.child .childSelect .childCat_id').append('<option  data-value="'+model.name_ar+'" value="'+model.id+'">'+model.name_ar+'</option>');
                           
                              });
                             }
                          }
                   
                   });
                });
                $("#subchildCat_id").on("change",function(){
                    description();
                });
                $('#country').on('change',function(){
                    var area_id=$(this).val();
                    $("#city").empty();  
                  
                    $.ajax({
                       url:"{{ route('getcity') }}",
                       type:"POST",
                       data: {
                           area_id: area_id,
                            _token: '{!! csrf_token() !!}',
                        },           
                        
                       success:function (data)
                        {   if(data.length>0){
                            $(".city").show();
                            $('.city .citySelect  #city').append('<option value="" disabled selected>'+"اختر المدينه "+'</option>');
                            $.each(data,function(index,model){
                                $('.city .citySelect  #city').append('<option value="'+model.id+'">'+model.name_ar+'</option>');
                           
                              });
                             }
                          }
                   
                   });
                });
                $("#use").on("change",function(){
                    description();
                });
                /* =============================== input radio =============================== */
  $('#priceInput').hide();
$('input:radio[name="price"]').change(
    function() {
        if (this.checked && this.value == 'false') {
            $('#priceInput').hide();
        } else if (this.checked && this.value == 'true') {
            $('#priceInput').show();
        }
    }
);
    
       $('#sellCar').removeClass("d-none");      
  $("#typeOfPost").on("change",function(){
      
         if ($(this).children(":selected").val() == '1') {
            $('#sellCar').removeClass("d-none");
            $("#installment").addClass('d-none');

        } else if ($(this).children(":selected").val()  == '2') {
            $("#installment").removeClass('d-none');
            $('#sellCar').addClass("d-none");
        }
      
  });
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
                function description(){
                //     if($("#parent_id").val()==1){
                //         var child=$('#childCat_id').find(':selected').attr('data-value');
                //   var car =$("#subchildCat_id").find(':selected').attr('data-value');
                //   var km=$("#km").val();
                //   var model=$("#model").val();
                //   var type=$("#type").val();
                //   var use=$("#use").val();
                //   console.log(child);
                 
                //     $("#desc").html("");
                //     $("#desc").html("السياره:"+child+'-'+car);
                //     if(km){
                //         $desc=$("#desc").val();
                //         $("#desc").html($desc+'\nحالة السياره:'+use);
                //     } 
                //     if(model!=null && model!=" "){
                      
                //         $desc=$("#desc").val();
                //         $("#desc").html($desc+'\nموديل:'+model);
                //     } 
                //     if(type){
                //         $desc=$("#desc").val();
                //         $("#desc").html($desc+'\nنوع القير:'+type);
                //     }  if(use){
                //         $desc=$("#desc").val();
                //         $("#desc").html($desc+'\n حاله الاستعمال:'+use);
                //     } 
                //     }
                }
        </script>
 
@endsection