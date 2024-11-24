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
                            <h4 class="m-t-0 header-title"><b>@lang('menu_item.filters_list')</b>/<a href="{{ route('filter') }}">{{ $menue->name }}</a></h4>
                            <p class="text-muted font-13 m-b-30">
                                <a class="btn btn-default" data-toggle="modal" data-target="#add-item">@lang('menu_item.add_filter_item')</a>
                            </p>

                            <table id="datatable-colvid" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('menu_item.category')</th>
                                    <th>@lang('menu_item.name_ar')</th>
                                    <th>@lang('menu_item.name_en')</th>
                                    <th>@lang('menu_item.display_status')</th>
                                    <th>@lang('menu_item.order')</th>
                                    <th>@lang('menu_item.image_filter')</th>
                                    <th>@lang('menu_item.buttons')</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($items as $i => $item)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $item->cat_id ? $item->cat->name : trans('menu_item.all_categories') }}</td>
                                        <td>{{ $item->show_name_ar }}</td>
                                        <td>{{ $item->show_name_en }}</td>
                                        <td>
                                            @if($item->is == 1)
                                                @lang('menu_item.name_only')
                                            @elseif($item->is == 2)
                                                @lang('menu_item.image_only')
                                            @elseif($item->is == 3)
                                                @lang('menu_item.name_and_image')
                                            @elseif($item->is == 4)
                                                @lang('menu_item.name_and_icon')
                                            @endif
                                        </td>
                                        <td>{{ $item->sort }}</td>
                                        <td>{{ $item->img_filter == 1 ? trans('menu_item.image_filter_one_color') : trans('menu_item.image_filter_as_is') }}</td>
                                        <td>
                                            <a data-toggle="modal" data-target="#del-item{{ $i }}" class="btn btn-danger">@lang('menu_item.delete')</a>
                                            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="del-item{{ $i }}" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title" id="myLargeModalLabel">@lang('menu_item.delete')</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h3>@lang('menu_item.confirm_delete')</h3>
                                                            <form action="{{ route('del_item_menue', $item->id) }}" method="get">
                                                                <button type="submit" class="btn btn-danger">@lang('menu_item.delete')</button>
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">@lang('menu_item.cancel')</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <a data-toggle="modal" data-target="#update_bank{{ $i }}" class="btn btn-info">@lang('menu_item.edit')</a>
                                            <!-- Modal content for the above example -->
                                            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="update_bank{{ $i }}" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title" id="myLargeModalLabel">@lang('menu_item.edit')</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="{{ route('update_menue_item', $item->id) }}" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <label class="col-md-2">@lang('menu_item.name_ar')</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" name="name_ar" value="{{ $item->show_name_ar }}" class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-2">@lang('menu_item.name_en')</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" name="name_en" value="{{ $item->show_name_en }}" class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-2">@lang('menu_item.display_status')</label>
                                                                        <div class="col-md-10">
                                                                            <select class="form-control" name="is">
                                                                                <option value="1" {{ $menue->is == 1 ? 'selected' : '' }}>@lang('menu_item.name_only')</option>
                                                                                <option value="2" {{ $menue->is == 2 ? 'selected' : '' }}>@lang('menu_item.image_only')</option>
                                                                                <option value="3" {{ $menue->is == 3 ? 'selected' : '' }}>@lang('menu_item.name_and_image')</option>
                                                                                <option value="4" {{ $menue->is == 4 ? 'selected' : '' }}>@lang('menu_item.name_and_icon')</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-2">@lang('menu_item.order')</label>
                                                                        <div class="col-md-10">
                                                                            <input type="number" value="{{ $item->sort }}" name="sort" class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-2">@lang('menu_item.image_filter')</label>
                                                                        <div class="col-md-10">
                                                                            <select class="form-control" name="img_filter">
                                                                                <option value="1" {{ $item->img_filter == 1 ? 'selected' : '' }}>@lang('menu_item.image_filter_one_color')</option>
                                                                                <option value="0" {{ $item->img_filter == 0 ? 'selected' : '' }}>@lang('menu_item.image_filter_as_is')</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-2"></label>
                                                                        <div class="col-md-10">
                                                                            <button type="submit" class="btn btn-default form-control">@lang('menu_item.submit')</button>
                                                                        </div>
                                                                    </div>
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

        <!-- Modal content for the above example -->
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="add-item" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myLargeModalLabel">@lang('menu_item.add_filter')</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('add_menue_item', $menue->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-2">@lang('menu_item.category')</label>
                                    <div class="col-md-10">
                                        <select class="form-control" name="cat" required>
                                            <option value="" selected="" disabled="">@lang('menu_item.choose_category')</option>
                                            @foreach(\App\Models\Cat::where('parent_id', null)->get() as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name_ar }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">@lang('menu_item.name_ar')</label>
                                    <div class="col-md-10">
                                        <input type="text" name="name_ar" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">@lang('menu_item.name_en')</label>
                                    <div class="col-md-10">
                                        <input type="text" name="name_en" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">@lang('menu_item.display_status')</label>
                                    <div class="col-md-10">
                                        <select class="form-control" name="is">
                                            <option value="1" {{ $menue->is == 1 ? 'selected' : '' }}>@lang('menu_item.name_only')</option>
                                            <option value="2" {{ $menue->is == 2 ? 'selected' : '' }}>@lang('menu_item.image_only')</option>
                                            <option value="3" {{ $menue->is == 3 ? 'selected' : '' }}>@lang('menu_item.name_and_image')</option>
                                            <option value="4" {{ $menue->is == 4 ? 'selected' : '' }}>@lang('menu_item.name_and_icon')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">@lang('menu_item.order')</label>
                                    <div class="col-md-10">
                                        <input type="number" name="sort" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">@lang('menu_item.image_filter')</label>
                                    <div class="col-md-10">
                                        <select class="form-control" name="img_filter">
                                            <option value="1">@lang('menu_item.image_filter_one_color')</option>
                                            <option value="0">@lang('menu_item.image_filter_as_is')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2"></label>
                                    <div class="col-md-10">
                                        <button type="submit" class="btn btn-default form-control">@lang('menu_item.submit')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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