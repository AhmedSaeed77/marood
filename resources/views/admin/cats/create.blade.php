@extends('admin.layouts.app')
@section('style')

  <!-- Plugins css-->
  <link href="{{url('/')}}/public/admin/assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="{{url('/')}}/public/admin/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" />
        <link href="{{url('/')}}/public/admin/assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="{{url('/')}}/public/admin/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('/')}}/public/admin/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
        <link href="{{url('/')}}/public/admin/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
@endsection
@section('after_style')

<link href="{{url('/')}}/public/site/assets/vendor/FontAwesome/all.css" rel="stylesheet">
<style>
select {
  font-family: 'Font Awesome 5 Free';
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
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="row">
                                <h4 class="m-t-0 header-title"><b>{{ __('category_create.add_new_category') }}</b></h4>
                                <form class="form-horizontal" role="form" action="{{ url('/') }}/admin/cats/store" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-md-2 control-label @if($errors->has('name_ar')) has-error @endif">{{ __('category_create.category_name_ar') }}</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="name_ar"/>
                                            @if($errors->has('name_ar'))
                                                <span class="alert alert-danger">{{ $errors->first('name_ar') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ __('category_create.category_name_en') }}</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="name_en"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ __('category_create.category_image') }}</label>
                                        <div class="col-md-10">
                                            <input type="file" name="photo" class="filestyle" data-iconname="fa fa-cloud-upload">
                                            @if($errors->has('photo'))
                                                <span class="alert alert-danger">{{ $errors->first('photo') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ __('category_create.main_category') }}</label>
                                        <div class="col-md-10">
                                            <input type="radio" name="for_parent_id" value="yes">{{ __('category_create.yes') }}
                                            <input type="radio" name="for_parent_id" checked value="no">{{ __('category_create.no') }}
                                        </div>
                                    </div>
                                    <div class="form-group" id="parent">
                                        <label class="col-md-2 control-label">{{ __('category_create.main_category_name') }}</label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="parent_id">
                                                @foreach($parents as $parent)
                                                    <option value="{{ $parent->id }}">{{ $parent->name_ar }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="icon">
                                        <label class="col-md-2 control-label">{{ __('category_create.category_icon') }}</label>
                                        <div class="col-md-10">
                                            <input type="text" name="icon" class="form-control"/>
                                            <a href="{{ url('/') }}/admin/icons">{{ __('category_create.learn_icons') }}</a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ __('category_create.show_hide_category') }}</label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="show">
                                                <option value="1">{{ __('category_create.show') }}</option>
                                                <option value="0" selected>{{ __('category_create.hide') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ __('category_create.category_order') }}</label>
                                        <div class="col-md-10">
                                            <input type="number" class="form-control" name="sort"/>
                                        </div>
                                    </div>
                                    <div class="form-group" id="is_year">
                                        <label class="col-md-2 control-label">{{ __('category_create.ad_with_year') }}</label>
                                        <div class="col-md-10">
                                            <select name="is_year" class="form-control">
                                                <option value="1">{{ __('category_create.yes') }}</option>
                                                <option value="0">{{ __('category_create.no') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="type">
                                        <label class="col-md-2 control-label">{{ __('category_create.data_type') }}</label>
                                        <div class="col-md-10">
                                            <select name="type" class="form-control">
                                                <option value="2">{{ __('category_create.real_estate_data') }}</option>
                                                <option value="1">{{ __('category_create.car_data') }}</option>
                                                <option value="0">{{ __('category_create.main_data') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                     <div class="form-group">
                                        <label class="col-md-2 control-label">{{ __('category_edit.meta_title') }}</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="meta_title"/>
                                        </div>
                                    </div>
                                    
                                    
                                       <div class="form-group">
                                        <label class="col-md-2 control-label">{{ __('category_edit.meta_description') }}</label>
                                        <div class="col-md-10">
                                           <textarea class="form-control" name="meta_description"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10">
                                            <button type="submit" class="btn btn-default form-control">{{ __('category_create.add') }}</button>
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
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-1/js/all.js" crossorigin="anonymous"></script>
<script>
$("#parent").hide();

$(document).ready(function(){
        $("input[type='radio']").on("change",function(){
            var radioValue = $("input[name='for_parent_id']:checked").val();
            if(radioValue=="yes"){
                $("#parent").show();
                 $("#type").hide();
                $("#is_year").hide();
            }
            else{
                $("#parent").hide();
                $("#type").show();
                $("#is_year").show();
               
            }
        });
    });
</script>

@endsection