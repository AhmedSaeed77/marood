@extends('admin.layouts.app')
@section('style')
    <!-- DataTables -->
    <link href="{{url('/')}}/public/admin/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/public/admin/assets//plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/public/admin/assets//plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/public/admin/assets//plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/public/admin/assets//plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/public/admin/assets//plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/public/admin/assets//plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/public/admin/assets//plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/public/admin/assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />

<style>
.form-inline .form-control ,.form-inline .form-group{
    width:100% !important;
    margin-top:1px;
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
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title"><b>@lang('dashboard.main_filters')</b></h4>
                            <p class="text-muted font-13 m-b-30">

                            </p>

                            <table id="datatable-colvid" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('dashboard.main_filters')</th>
                                    <th>@lang('dashboard.hidden') / @lang('dashboard.visible')</th>
                                    <th> @lang('dashboard.display_status')</th>
                                    <th>@lang('dashboard.horizontal') / @lang('dashboard.vertical')</th>
                                    <th>buttons</th>
                                </tr>
                                </thead>


                                <tbody>
                                    @foreach($menues as $i=>$menue)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td>{{$menue->name}}</td>
                                    <td>{{$menue->show==1?'ظاهر':'مخفى'}}</td>
                                    <td>@if($menue->is==1)
                                            @lang('dashboard.name_only')
                                        @elseif($menue->is==2)
                                            @lang('dashboard.image_only')
                                        @elseif($menue->is==3)
                                            @lang('dashboard.name_and_image')
                                     @elseif($menue->is==4)
                                            @lang('dashboard.name_and_icon')
                                     @endif
                                    </td>
                                    <td>{{$menue->h_v==2? __('dashboard.vertical') : __('dashboard.horizontal')}}</td>

                                    <td>
                                        <a href="{{route('menues_item',$menue->id)}}" class="btn btn-primary">@lang('dashboard.lists')</a>
                                        <a  data-toggle="modal" data-target="#update_bank{{$i}}" class="btn btn-info">@lang('dashboard.edit') </a>
                                          <!--  Modal content for the above example -->
                                              <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="update_bank{{$i}}" aria-hidden="true" style="display: none;">
                                                            <div class="modal-dialog modal-lg ">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        <h4 class="modal-title" id="myLargeModalLabel">@lang('dashboard.edit')</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                    <form method="post" action="{{route('update_menue_filter',$menue->id)}}" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="row">
                                                                            <div class="form-group">
                                                                                <lable class="col-md-2">@lang('dashboard.hidden') / @lang('dashboard.visible')</lable>
                                                                                <div class="col-md-10">
                                                                                    <select class="form-control" name="show">
                                                                                    <option value="0"{{$menue->show==0?'selected':''}}>@lang('dashboard.hidden')</option>
                                                                                    <option value="1"{{$menue->show==1?'selected':''}}>@lang('dashboard.visible')</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <lable class="col-md-2">@lang('dashboard.display_status')</lable>
                                                                                <div class="col-md-10">
                                                                                    <select class="form-control" name="is">
                                                                                    <option value="1"{{$menue->is==1?'selected':''}}> @lang('dashboard.name_only')</option>
                                                                                    <option value="2"{{$menue->is==2?'selected':''}}> @lang('dashboard.image_only')</option>
                                                                                    <option value="3"{{$menue->is==3?'selected':''}}>@lang('dashboard.name_and_image')</option>
                                                                                    <option value="4"{{$menue->is==4?'selected':''}}> @lang('dashboard.name_and_icon')</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <lable class="col-md-2"></lable>
                                                                                <div class="col-md-10">
                                                                                    <button type="submit" class="btn btn-default form-control"> @lang('dashboard.edit')</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </form>
                                                                    </div>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->
                                    </td>
                                  </tr>
                                 @endforeach
                            </tbody>
                     </table>
                 </div>
                    </div>
                </div>


                </div>
            </div>


@endsection
@section('afterscript')
<script src="{{url('/')}}/public/admin/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/public/admin/assets/plugins/datatables/dataTables.bootstrap.js"></script>

<script src="{{url('/')}}/public/admin/assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="{{url('/')}}/public/admin/assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="{{url('/')}}/public/admin/assets/plugins/datatables/jszip.min.js"></script>
<script src="{{url('/')}}/public/admin/assets/plugins/datatables/pdfmake.min.js"></script>
<script src="{{url('/')}}/public/admin/assets/plugins/datatables/vfs_fonts.js"></script>
<script src="{{url('/')}}/public/admin/assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="{{url('/')}}/public/admin/assets/plugins/datatables/buttons.print.min.js"></script>
<script src="{{url('/')}}/public/admin/assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
<script src="{{url('/')}}/public/admin/assets/plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="{{url('/')}}/public/admin/assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="{{url('/')}}/public/admin/assets/plugins/datatables/responsive.bootstrap.min.js"></script>
<script src="{{url('/')}}/public/admin/assets/plugins/datatables/dataTables.scroller.min.js"></script>
<script src="{{url('/')}}/public/admin/assets/plugins/datatables/dataTables.colVis.js"></script>
<script src="{{url('/')}}/public/admin/assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>
<script src="{{url('/')}}/public/admin/assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>

<script src="{{url('/')}}/public/admin/assets/pages/datatables.init.js"></script>
<script>
$(document).ready(function(){
    $('#datatable-colvid').DataTable({
            "dom": 'C<"clear">lfrtip',
            "colVis": {
                "buttonText": "Change columns"
            }
        });
});
</script>
@endsection