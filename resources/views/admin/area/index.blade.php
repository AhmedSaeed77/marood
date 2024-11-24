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
        <link href="{{url('/')}}/public/admin/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" />
        <link href="{{url('/')}}/public/admin/assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="{{url('/')}}/public/admin/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('/')}}/public/admin/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
        <link href="{{url('/')}}/public/admin/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
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
                            <h4 class="m-t-0 header-title"><b>{{ __('cities.title') }}</b></h4>
                            <p class="text-muted font-13 m-b-30">
                                <a class="btn btn-default" data-toggle="modal" data-target="#add_area">{{ __('cities.add_city') }}</a>
                            </p>

                            <!-- Add City Modal -->
                            <div class="modal fade" id="add_area" role="dialog">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">{{ __('cities.modal_title_add') }}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('area.store') }}">
                                                @csrf
                                                <input type="hidden" name="parent_id" />
                                                <div class="form-group">
                                                    <label class="col-md-3">{{ __('cities.name_arabic') }}</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" required name="name_ar" type="text" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">{{ __('cities.name_english') }}</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" name="name_en" type="text" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">{{ __('cities.latitude') }}</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" name="lat" type="number" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">{{ __('cities.longitude') }}</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" name="lng" type="number" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-info" type="submit">{{ __('cities.add') }}</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('cities.close') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table id="datatable-colvid" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('cities.name_arabic') }}</th>
                                    <th>{{ __('cities.name_english') }}</th>
                                    <th>{{ __('cities.latitude') }}</th>
                                    <th>{{ __('cities.longitude') }}</th>
                                    <th>{{ __('cities.buttons') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($areas->where('parent_id',null) as $i=>$area)
                                    <tr>
                                        <td>{{ $i+1 }}</td>
                                        <td>{{ $area->name_ar }}</td>
                                        <td>{{ $area->name_en }}</td>
                                        <td>{{ $area->lat }}</td>
                                        <td>{{ $area->lng }}</td>
                                        <td>
                                            <!-- @if(count($areas->where('parent_id',$area->id))>0) -->
                                            <!-- @endif -->
                                            <a href="{{route('area.city',$area->id)}}" class="btn btn-info">{{ __('cities.cities') }}</a>

                                            <a  data-target="#edit_modal{{$i}}" data-toggle="modal" class="btn btn-info">{{ __('cities.edit') }} </a>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit_modal{{ $i }}" role="dialog">
                                                <div class="modal-dialog ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">{{ __('cities.modal_title_edit', ['city_name' => $area->name_ar]) }}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="{{ route('area.update', $area->id) }}">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="put">
                                                                <div class="form-group">
                                                                    <label class="col-md-3">{{ __('cities.name_arabic') }}</label>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control" required name="name_ar" value="{{ $area->name_ar }}" type="text" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-3">{{ __('cities.name_english') }}</label>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control" name="name_en" value="{{ $area->name_en }}" type="text" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-3">{{ __('cities.latitude') }}</label>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control" name="lat" value="{{ $area->lat }}" type="number" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-3">{{ __('cities.longitude') }}</label>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control" name="lng" value="{{ $area->lng }}" type="number" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button class="btn btn-info" type="submit">{{ __('cities.edit') }}</button>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('cities.close') }}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#" data-target="#del_modal{{ $i }}" data-toggle="modal" class="btn btn-danger">{{ __('cities.delete') }}</a>
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="del_modal{{ $i }}" role="dialog">
                                                <div class="modal-dialog ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">{{ __('cities.modal_title_delete', ['city_name' => $area->name_ar]) }}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h2>{{ __('cities.confirm_delete') }}<h2>
                                                                    <form method="post" action="{{ route('area.destroy', $area->id) }}">
                                                                        @csrf
                                                                        <input type="hidden" name="_method" value="delete">
                                                                        <div class="form-group">
                                                                            <button class="btn btn-danger" type="submit">{{ __('cities.delete') }}</button>
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('cities.close') }}</button>
                                                                        </div>
                                                                    </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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