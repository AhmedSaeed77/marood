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
                                <form class="form-horizontal" role="form" action="{{route('pages.update',$page->id)}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="put">
	                                            <div class="form-group">
	                                                <label class="col-md-2 control-label  @if($errors->has('name_ar')) has-error @endif">*{{ __('page_create.page_name_arabic') }} </label>
	                                                <div class="col-md-10">
                                                        <input type="text" class="form-control" value="{{$page->name_ar}}" name="name_ar"/>
                                                        @if($errors->has('name_ar'))
                                                                 <strong class="alert alert-danger">{{ $errors->first('name_ar') }}</strong>
                                                        @endif
	                                                </div>
                                                </div>
                                                <div class="form-group">
	                                                <label class="col-md-2 control-label">{{ __('page_create.page_name_english') }} </label>
	                                                <div class="col-md-10">
	                                                    <input type="text" class="form-control"value="{{$page->name_en}}" name="name_en"/>
	                                                </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">{{ __('page_create.page_link') }} *</label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control required" value="{{$page->link}}" name="link"/>
                                                                @if($errors->has('link'))
                                                                 <strong class="alert alert-danger">{{ $errors->first('link') }}</strong>
                                                        @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">{{ __('page_create.show_hide_page') }}</label>
                                                                <div class="col-md-9">
                                                                 <select class="form-control" name="show" >
                                                                        <option value="1"{{$page->active==1?'selected':''}}>{{ __('page_create.show') }}</option>
                                                                        <option value="0" {{$page->active==0?'selected':''}}>{{ __('page_create.hide') }}</option>
                                                                 </select>
                                                                </div>
                                                            </div>
                                                      </div>
                                                   <div class="col-md-6">
                                                        <div class="form-group" id="photo">
                                                            <label class="col-md-2 control-label">{{ __('page_create.page_icon') }}</label>
                                                            <div class="col-md-10" >
                                                                <input class="form-control"value="{{$page->icon}}" required name="icon" type="text"/>
                                                                   <a href="{{url('/')}}/admin/icons" target="_blank" >{{ __('page_create.learn_about_icons') }}</a>
                                                             </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                            <div class="form-group">
                                                                 <textarea class="summernote" name="content">
                                                                   {{$page->content}}
                                                                </textarea>
                                                            </div>
                                                            
                                                             <div class="form-group">
                                                                 <textarea class="summernote" name="content_en">
                                                                   {{$page->content_en}}
                                                                </textarea>
                                                            </div>

	                                            <div class="form-group">
                                                <div class="col-md-2"></div>
                                                 <div class="col-md-10">
                                                    <button type="submit" class="btn btn-default  form-control">{{ __('page_create.submit') }}</button>
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
            height: 350,                 // set editor height
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