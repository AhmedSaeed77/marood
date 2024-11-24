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
                                <h4 class="m-t-0 header-title"><b>{{ __('site.member_create') }}</b></h4>
                                <form class="form-horizontal" role="form" action="{{ route('admin.store-member') }}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-md-2 control-label @if($errors->has('name')) has-error @endif">{{ __('add_user.username') }}</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" required name="name"/>
                                            @if($errors->has('name'))
                                                <strong class="alert-danger">{{ $errors->first('name') }}</strong>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label @if($errors->has('email')) has-error @endif">{{ __('add_user.email') }}</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" required name="email"/>
                                            @if($errors->has('email'))
                                                <strong class="alert-danger">{{ $errors->first('email') }}</strong>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label @if($errors->has('phone')) has-error @endif">{{ __('add_user.phone') }}</label>
                                        <div class="col-md-2 col-sm-2" style="padding-inline-start: 10px;">
                                            <select class="form-control @error('phone-code') is-invalid @enderror" name="phone-code" style="height: 34px;">
                                                <option value="966">+966 SAU</option>
                                                <option value="20" selected>+20 EG</option>
                                                <option value="973">+973 BHR</option>
                                                <option value="213">+213 ALG</option>
                                                <option value="971">+971 UAE</option>
                                                <option value="968">+968 OMN</option>
                                            </select>
                                            @error('phone-code')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" required name="phone"/>
                                            @if($errors->has('phone'))
                                                <strong class="alert-danger">{{ $errors->first('phone') }}</strong>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group" id="avatar">
                                        <label class="col-md-2 control-label">{{ __('add_user.profile_picture') }}</label>
                                        <div class="col-md-10">
                                            <label class="control-label">{{ __('add_user.profile_picture') }}</label>
                                            <input type="file" name="avatar" class="filestyle" data-iconname="fa fa-cloud-upload">
                                            @if($errors->has('avatar'))
                                                <strong class="alert-danger">{{ $errors->first('avatar') }}</strong>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label @if($errors->has('password')) has-error @endif">{{ __('add_user.password') }}</label>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" required name="password"/>
                                            @if($errors->has('password'))
                                                <strong class="alert-danger">{{ $errors->first('password') }}</strong>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label @if($errors->has('password_confirmation')) has-error @endif">{{ __('add_user.password_confirmation') }}</label>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" name="password_confirmation"/>
                                            @if($errors->has('password_confirmation'))
                                                <strong class="alert-danger">{{ $errors->first('password_confirmation') }}</strong>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10">
                                            <button type="submit" class="btn btn-default form-control">{{ __('add_user.add') }}</button>
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


@endsection