@extends('admin.layouts.app')
@section('style')
<link href="{{url('/')}}/public/admin/assets/plugins/summernote/summernote.css" rel="stylesheet" />

  <!-- Plugins css-->
  <link href="{{url('/')}}/public/admin/assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="{{url('/')}}/public/admin/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" />
        <link href="{{url('/')}}/public/admin/assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="{{url('/')}}/public/admin/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('/')}}/public/admin/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
        <link href="{{url('/')}}/public/admin/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />

@endsection

@section('content')
         <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                    <div class="row">
							<div class="col-sm-12">
                            <div class="card-box">
                                <div class="row">

                                <form class="form-horizontal" role="form" action="{{route('member.update',$member->id)}}" enctype="multipart/form-data" method="post">
                                @csrf
	                                          <div class="form-group">
                                                   <lable class="col-md-3  @if($errors->has('title_ar')) has-error @endif">{{ __('member_create.title_arabic') }}</lable>
                                                   <div class="col-md-9">
                                                       <input type="text" name="title_ar" class="form-control " value="{{$member->title_ar}}"/>
                                                       @if($errors->has('title_ar'))
                                                                 <strong class="alert alert-danger">{{ $errors->first('title_ar') }}</strong>
                                                        @endif
                                                   </div>
                                              </div>
                                              <div class="form-group">
                                                   <lable class="col-md-3">{{ __('member_create.title_english') }}</lable>
                                                   <div class="col-md-9">
                                                       <input type="text" name="title_en" class="form-control" value="{{$member->title_en}}"/>
                                                   </div>
                                              </div>
                                              <div class="form-group">
                                              <lable class="col-md-3 @if($errors->has('desc_ar')) has-error @endif"> {{ __('member_create.description_arabic') }}</lable>
                                              <div class="col-md-9">
                                                        <textarea class="summernote  " name="desc_ar">
                                                           <?php echo $member->desc_ar;  ?>
                                                        </textarea>
                                                        @if($errors->has('desc_ar'))
                                                                 <strong class="alert alert-danger">{{ $errors->first('desc_ar') }}</strong>
                                                        @endif
                                                        <br>
                                                </div>
                                               </div>
                                              <div class="form-group">
                                              <lable class="col-md-3">{{ __('member_create.description_english') }}</lable>
                                                  <div class="col-md-9">
                                                        <textarea class="summernote" name="desc_en"><?php echo $member->desc_en;  ?></textarea>
                                                        <br>

                                                </div>
                                               </div>
                                               <div class="form-group">
                                               <lable class="col-md-3 @if($errors->has('adv_ar')) has-error @endif">{{ __('member_create.advantages_arabic') }}</lable>
                                                   <div class="col-md-9">
                                                        <textarea class="summernote  " name="adv_ar"> <?php echo $member->advantage_ar;  ?> </textarea>
                                                        <br>
                                                        @if($errors->has('adv_ar'))
                                                                 <strong class="alert alert-danger">{{ $errors->first('adv_ar') }}</strong>
                                                        @endif
                                                    </div>
                                               </div>
                                                 <div class="form-group">
                                                 <lable class="col-md-3">{{ __('member_create.advantages_english') }}</lable>
                                                 <div class="col-md-9">
                                                    <textarea class="summernote" name="adv_en"> <?php echo $member->advantage_en;  ?> </textarea>
                                                    <br>
                                                </div>
                                               </div>
                                               <div class="form-group">
                                               <lable class="col-md-3">{{ __('member_create.conditions_arabic') }}</lable>
                                                 <div class="col-md-9">
                                                    <textarea class="summernote" name="cond_ar"> <?php echo $member->condition_ar;  ?> </textarea>
                                                    <br>
                                                 </div>

                                               </div> <div class="form-group"> <lable class="col-md-3">{{ __('member_create.conditions_english') }}</lable>
                                                 <div class="col-md-9">
                                                    <textarea class="summernote" name="cond_en"> <?php echo $member->condition_en;  ?></textarea>
                                                    <br>
                                                </div>
                                                </div>
	                                            <div class="form-group">
                                                <div class="col-md-2"></div>
                                                 <div class="col-md-10">
                                                    <button type="submit" class="btn btn-default  form-control">{{ __('member_create.edit') }}</button>
                                                 </div>
                                                 </div>


	                                        </form>
                                </div>
							</div>
                            </div>

						</div>

                    </div>
                </div>
            </div>

@endsection



@section('afterscript')
 <!--form validation init-->
 <script src="{{url('/')}}/public/admin/assets/plugins/summernote/summernote.min.js"></script>

<script>

    jQuery(document).ready(function(){

        $('.summernote').summernote({
            height: 100,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false                 // set focus to editable area after initializing summernote
        });
        
        $('.inline-editor').summernote({
            airMode: true            
        });

    });
</script>
<script src="{{url('/')}}/public/admin/assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
        <script src="{{url('/')}}/public/admin/assets/plugins/switchery/js/switchery.min.js"></script>
        <script type="text/javascript" src="{{url('/')}}/public/admin/assets/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="{{url('/')}}/public/admin/assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="{{url('/')}}/public/admin/assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="{{url('/')}}/public/admin/assets/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="{{url('/')}}/public/admin/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="{{url('/')}}/public/admin/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="{{url('/')}}/public/admin/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="{{url('/')}}/public/admin/assets/plugins/autocomplete/jquery.mockjax.js"></script>
        <script type="text/javascript" src="{{url('/')}}/public/admin/assets/plugins/autocomplete/jquery.autocomplete.min.js"></script>
        <script type="text/javascript" src="{{url('/')}}/public/admin/assets/plugins/autocomplete/countries.js"></script>
        <script type="text/javascript" src="{{url('/')}}/public/admin/assets/pages/autocomplete.js"></script>

        <script type="text/javascript" src="{{url('/')}}/public/admin/assets/pages/jquery.form-advanced.init.js"></script>


        

@endsection