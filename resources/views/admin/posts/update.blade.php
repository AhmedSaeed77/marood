@extends('admin.layouts.app')
@section('style')
<!--Form Wizard-->
<link rel="stylesheet" type="text/css" href="{{url('/')}}/public/admin/assets/plugins/jquery.steps/css/jquery.steps.css" />
<style>
.hide{
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
                            <h4 class="m-t-0 header-title"><b>{{ __('edit_post.edit_ad') }}</b></h4>
                            <p class="text-muted m-b-30 font-13"></p>
                            <form id="wizard-validation-form" action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="put"/>
                                <div>
                                    <h3>{{ __('edit_post.steps.step1') }}</h3>
                                    <section>
                                        <label class="col-lg-12 control-label" for="parent_id">{{ __('edit_post.main_category') }} *</label>
                                        <?php $parent = $post->Cat; ?>
                                        <div class="form-group clearfix">
                                            <div class="rw">
                                                @if($parent->parent_id != null)
                                                    @while($parent->parent_id != null)
                                                        <div class="col-lg-6">
                                                            <select class="required form-control" id="parent_id" name="parent_id">
                                                                @foreach($cats->where('parent_id', null) as $cat)
                                                                    <option value="{{ $cat->id }}" {{ $parent->parent->id == $cat->id ? 'selected' : '' }}>{{ $cat->name_ar }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                            <?php $parent = $parent->parent; ?>
                                                    @endwhile
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group clearfix child">
                                            <label class="col-lg-2 control-label" for="child_id">{{ __('edit_post.sub_category') }} *</label>
                                            <div class="col-lg-10 childSelect">
                                                <select class="required form-control" id="child_id" name="cat">
                                                    @foreach($post->Cat->parent->child as $cat)
                                                        <option value="{{ $cat->id }}" {{ $post->cat_id == $cat->id ? 'selected' : '' }}>{{ $cat->name_ar }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </section>
                                    <h3>{{ __('edit_post.steps.step2') }}</h3>
                                    <section>
                                        <div class="form-group clearfix">
                                            <label class="col-lg-2 control-label" for="title_ar">{{ __('edit_post.title_ar') }} *</label>
                                            <div class="col-lg-10">
                                                <input id="title_ar" name="title_ar" value="{{ $post->title_ar }}" type="text" class="required form-control">
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <label>{{ __('edit_post.set_price') }}</label>
                                            <br>
                                            <div>
                                                <input type="radio" value="false" {{ $post->price <= 0 ? 'checked=checked' : '' }} name="price">
                                                <label style="margin-right: 5px;">{{ __('edit_post.no') }}</label>
                                                <br>
                                                <input type="radio" value="true" {{ $post->price > 0 ? 'checked=checked' : '' }} name="price">
                                                <label style="margin-right: 5px;">{{ __('edit_post.yes') }}</label>
                                            </div>
                                            <input placeholder="{{ __('edit_post.price_placeholder') }}" type="text" class="form-control" name="priceValue" value="{{ $post->price }}" style="max-width: 200px;" id="priceInput">
                                            <hr>
                                        </div>
                                        <div class="form-group clearfix country">
                                            <label class="col-lg-2 control-label" for="country">{{ __('edit_post.country') }} *</label>
                                            <div class="col-lg-10">
                                                <select class="required form-control" id="country" name="area_id">
                                                    @foreach($areas->where('parent_id', null) as $area)
                                                        <option value="{{ $area->id }}" {{ $post->area != null && $post->area->parent_id == $area->id ? 'selected' : '' }}>{{ $area->name_ar }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix city">
                                            <label class="col-lg-2 control-label" for="city">{{ __('edit_post.city') }} *</label>
                                            <div class="col-lg-10 citySelect">
                                                <select class="required form-control" id="city" name="area_id">
                                                    @foreach($areas as $area)
                                                        <option value="{{ $area->id }}" {{ $post->area_id == $area->id ? 'selected' : '' }}>{{ $area->name_ar }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <label class="col-lg-12 control-label">{{ __('edit_post.mandatory') }}</label>
                                        </div>
                                    </section>
                                    <h3>{{ __('edit_post.steps.step3') }}</h3>
                                    <section>
                                        <div class="form-group clearfix">
                                            <div class="col-lg-12">
                                                <textarea name="description" class="form-control" id="desc">{{ $post->description }}</textarea>
                                            </div>
                                        </div>
                                    </section>
                                    <h3>{{ __('edit_post.steps.step_final') }}</h3>
                                    <section>
                                        <div class="form-group clearfix">
                                            <div class="col-lg-12">
                                                <input id="acceptTerms-2" name="acceptTerms2" type="checkbox" class="required">
                                                <label for="acceptTerms-2">{{ __('edit_post.agree_terms') }}</label>
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
                            $(".child .childSelect").append('<select required class="childCat_id form-control" name="cat" id="subcat_'+cat_id+'"><option value="" disabled selected>اختر القسم الفرعى</option></select><br>')
                            $.each(data,function(index,model){
                                $('.child .childSelect .childCat_id').append('<option  data-value="'+model.name_ar+'" value="'+model.id+'">'+model.name_ar+'</option>');
                           
                              });
                        }
                          }
                   
                   });
                });
</script>
@endsection