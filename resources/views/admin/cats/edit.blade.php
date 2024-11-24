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
                                <h4 class="m-t-0 header-title"><b>{{ __('category_edit.add_new_category') }}</b></h4>
                                <form class="form-horizontal" role="form" action="{{ url('/') }}/admin/cats/edit/{{ $cat->id }}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-md-2 control-label @if($errors->has('name_ar')) has-error @endif">{{ __('category_edit.category_name_ar') }}</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="name_ar" value="{{ $cat->name_ar }}"/>
                                            @if($errors->has('name_ar'))
                                                <strong class="alert-danger">{{ $errors->first('name_ar') }}</strong>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ __('category_edit.category_name_en') }}</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{ $cat->name_en }}" name="name_en"/>
                                        </div>
                                    </div>
                                    <div class="form-group" id="photo">
                                        <label class="col-md-2 control-label">{{ __('category_edit.category_image') }}</label>
                                        <div class="col-md-10">
                                            <label class="control-label">{{ __('category_edit.category_image') }}</label>
                                            <input type="file" name="photo" class="filestyle" data-iconname="fa fa-cloud-upload">
                                        </div>
                                    </div>
                                    <div class="form-group" id="icon">
                                        <label class="col-md-2 control-label">{{ __('category_edit.category_icon') }}</label>
                                        <div class="col-md-10">
                                            <label class="control-label">{{ __('category_edit.category_icon') }}</label>
                                            <input type="text" name="icon" value="{{ $cat->icon }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ __('category_edit.show_hide_category') }}</label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="show">
                                                <option value="1"{{ $cat->show == 1 ? 'selected' : '' }}>{{ __('category_edit.display') }}</option>
                                                <option value="0"{{ $cat->show == 0 ? 'selected' : '' }}>{{ __('category_edit.hide') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ __('category_edit.category_order') }}</label>
                                        <div class="col-md-10">
                                            <input type="number" class="form-control" name="sort" value="{{ $cat->sort }}"/>
                                        </div>
                                    </div>
                                    
                                    
                                    @if($cat->parent_id == null)
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">{{ __('category_edit.add_year_model') }}</label>
                                            <div class="col-md-10">
                                                <select name="is_year" class="form-control">
                                                    <option value="1"{{ $cat->is_year == 1 ? 'selected' : '' }}>{{ __('category_edit.yes') }}</option>
                                                    <option value="0"{{ $cat->is_year == 0 ? 'selected' : '' }}>{{ __('category_edit.no') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">{{ __('category_edit.data_type') }}</label>
                                            <div class="col-md-10">
                                                <select name="type" class="form-control">
                                                    <option value="2"{{ $cat->type == 2 ? 'selected' : '' }}>{{ __('category_edit.real_estate_data') }}</option>
                                                    <option value="1"{{ $cat->type == 1 ? 'selected' : '' }}>{{ __('category_edit.car_data') }}</option>
                                                    <option value="0"{{ $cat->type == 0 ? 'selected' : '' }}>{{ __('category_edit.main_data') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        
                                     <div class="form-group">
                                        <label class="col-md-2 control-label">{{ __('category_edit.meta_title') }}</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="meta_title" value="{{ $cat->meta_title }}"/>
                                        </div>
                                    </div>
                                    
                                    
                                       <div class="form-group">
                                        <label class="col-md-2 control-label">{{ __('category_edit.meta_description') }}</label>
                                        <div class="col-md-10">
                                           <textarea class="form-control" name="meta_description">{{ $cat->meta_description }}</textarea>
                                        </div>
                                    </div>
                                    
                                    
                                    @endif
                                    <div class="form-group">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10">
                                            <button type="submit" class="btn btn-default form-control">{{ __('category_edit.edit') }}</button>
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
<script>

</script>

@endsection