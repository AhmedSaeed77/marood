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
                            <h4 class="m-t-0 header-title">
                                <b>{{ __('category_child.subcategories_of', ['name' => $cat->name_ar]) }}</b>
                            </h4>
                            <p class="text-muted font-13 m-b-30">
                                <a href="{{ route('cat_index') }}">{{ __('category_child.main_categories') }}/</a>
                                @if($cat->parent != null)
                                    <a href="{{ route('show_child', $cat->parent->id) }}">{{ $cat->parent->name_ar }}/</a>
                                    <a href="#">{{ $cat->name_ar }}</a>
                                @else
                                    <a href="#">{{ $cat->name_ar }}</a>
                                @endif
                            </p>

                            <table id="datatable-colvid" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('category_child.name_ar') }}</th>
                                    <th>{{ __('category_child.name_en') }}</th>
                                    <th>{{ __('category_child.category_image') }}</th>
                                    <th>{{ __('category_child.show_hide_category') }}</th>
                                    <th>{{ __('category_child.category_order') }}</th>
                                    <th>{{ __('category_child.buttons') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cats as $i => $cat)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $cat->name_ar }}</td>
                                        <td>{{ $cat->name_en }}</td>
                                        <td>
                                            <img src="{{ url('/') }}/public/storage/{{ $cat->photo }}" width="60px" height="60px"/>
                                        </td>
                                        <td>{{ $cat->show == 0 ? __('category_child.hide') : __('category_child.show') }}</td>
                                        <td>{{ $cat->sort }}</td>
                                        <td>
                                            <a href="{{ route('update_cat', $cat->id) }}" class="btn btn-info">{{ __('category_child.edit_category') }}</a>
                                            <a href="#" data-toggle="modal" data-target="#myModal{{ $i }}" class="btn btn-danger">{{ __('category_child.delete') }}</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal{{ $i }}" role="dialog">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">{{ __('category_child.delete_category_confirm', ['name' => $cat->name_ar]) }}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ __('category_child.delete_category_confirm', ['name' => $cat->name_ar]) }}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="row">
                                                                <div class="col-md-6 col-lg-6">
                                                                    <form action="{{ route('del_cat', $cat->id) }}" method="get">
                                                                        <button type="submit" class="btn btn-danger">{{ __('category_child.delete') }}</button>
                                                                    </form>
                                                                </div>
                                                                <div>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('category_child.close') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(count($allcat->where('parent_id', $cat->id)) > 0)
                                                <a href="{{ route('show_child', $cat->id) }}" class="btn btn-primary">{{ __('category_child.subcategory_of') }}</a>
                                            @endif
                                            <a href="#" data-toggle="modal" data-target="#myModaladd{{ $i }}" class="btn btn-default ">{{ __('category_child.add_subcategory') }}</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="myModaladd{{ $i }}" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">{{ $cat->name_ar }}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ __('category_child.add_subcategory_to', ['name' => $cat->name_ar]) }}
                                                            <div class="card-box modal-add-child">
                                                                <div class="row">
                                                                    <form action="{{ url('/') }}/admin/cats/store" method="post" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input type="hidden" value="{{ $cat->id }}" name="parent_id"/>
                                                                        <input type="hidden" value="yes" name="for_parent_id"/>
                                                                        <div class="row">
                                                                            <div class="">
                                                                                <label class="col-md-4 control-label @if($errors->has('name_ar')) has-error @endif">{{ __('category_child.category_name_ar') }}</label>
                                                                                <div class="col-md-8">
                                                                                    <input required type="text" class="form-control" name="name_ar"/>
                                                                                    @if($errors->has('name_ar'))
                                                                                        <strong class="alert alert-danger">{{ $errors->first('name_ar') }}</strong>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="">
                                                                            <div class="row">
                                                                                <label class="col-md-4 control-label">{{ __('category_child.category_name_en') }}</label>
                                                                                <div class="col-md-8">
                                                                                    <input type="text" class="form-control" name="name_en"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="" id="photo">
                                                                                <label class="col-md-4 control-label">{{ __('category_child.category_photo') }}</label>
                                                                                <div class="col-md-8">
                                                                                    <input type="file" name="photo" class="filestyle" data-iconname="fa fa-cloud-upload">
                                                                                    @if($errors->has('photo'))
                                                                                        <strong class="alert alert-danger">{{ $errors->first('photo') }}</strong>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="">
                                                                                <label class="col-md-4 control-label">{{ __('category_child.show_hide') }}</label>
                                                                                <div class="col-md-8">
                                                                                    <select class="form-control" name="show">
                                                                                        <option value="1">{{ __('category_child.show') }}</option>
                                                                                        <option value="0" selected>{{ __('category_child.hide') }}</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="">
                                                                                <label class="col-md-4 control-label">{{ __('category_child.order') }}</label>
                                                                                <div class="col-md-8">
                                                                                    <input type="number" class="form-control" name="sort"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('category_child.close') }}</button>
                                                                <button type="submit" class="btn btn-default">{{ __('category_child.add') }}</button>
                                                            </div>
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