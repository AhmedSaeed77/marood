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
                                    <h4 class="m-t-0 header-title"><b>معلومات الموقع </b></h4>
                                    <form class="form-horizontal" role="form" action="{{route('setting.wm')}}" enctype="multipart/form-data" method="post">  
                                    @csrf              
                                    <!-- <input type="hidden" name="_method" value="put"/>   -->
                                    @foreach($settings->where('for','wm') as $s) 
                                                
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">{{$s->slug}} </label>
                                                        <div class="col-md-10 text-center">
                                                    @if($s->form_type!='textarea' && $s->form_type!='select' )    
                                                          <input type="{{$s->form_type}}" class="form-control {{$s->form_type=='file'?'filestyle':''}}" value="{{$s->value}}" name="{{$s->name}}"/>
                                                        @if($s->form_type=='file')
                                                               <img src="{{url('/')}}/public/storage/{{$s->value}}" width="200px" height="100px" />
                                                        @endif
                                                    @elseif($s->form_type =='textarea')
                                                           <textarea class="form-control" name="{{$s->name}}">{{$s->value}}</textarea>
                                                    @else
                                                    <select class="form-control" name="{{$s->name}}">
                                                             @if($s->name=="vm_active") 
                                                                  <option value="1" {{$s->value==1?'selected':''}}>تفعيل العلامه المائيه</option>
                                                                  <option value="0" {{$s->value==0?'selected':''}}>الغاء تفعيل العلامه المائيه</option>
                                                             @elseif($s->name=="WM_type")
                                                                  <option value="1" {{$s->value==1?'selected':''}}>صورة</option>
                                                                  <option value="0" {{$s->value==0?'selected':''}}>نص</option>
                                                             @elseif($s->name=="vm_position")
                                                             <option value="1" {{$s->value==1?'selected':''}}>صورة</option>
                                                                  <option value="0" {{$s->value==0?'selected':''}}>نص</option>
                                                             @endif
                                                    </select>
                                                    @endif
                                                        </div>
                                                    </div>
                                    @endforeach 
                                        <div class="form-group">
                                        <label class="col-md-2 control-label"></label>
                                                        <div class="col-md-10 text-center">
                                            <button type="submit" class="btn btn-default form-control">تعديل</button>
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
