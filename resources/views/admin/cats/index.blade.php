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
        <link rel="stylesheet" href="{{url('/')}}/public/site/assets/vendor/FontAwesome/all.css">
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
                            <h4 class="m-t-0 header-title"><b>{{ __('category.main_ad_categories') }}</b></h4>
                            <p class="text-muted font-13 m-b-30">
                            </p>

                            <table id="datatable-colvid" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('category.name_ar') }}</th>
                                    <th>{{ __('category.name_en') }}</th>
                                    <th>{{ __('category.category_logo') }}</th>
                                    <th>{{ __('category.category_icon') }}</th>
                                    <th>{{ __('category.show_hide_category') }}</th>
                                    <th>{{ __('category.category_order') }}</th>
                                    <th>{{ __('category.add_year_model') }}</th>
                                    <th>{{ __('category.add_data_type') }}</th>
                                    <th>{{ __('category.buttons') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cats->where('parent_id', null) as $i => $cat)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $cat->name_ar }}</td>
                                        <td>{{ $cat->name_en }}</td>
                                        <td>@if($cat->photo != null)<img src="{{ url('/') }}/public/storage/{{ $cat->photo }}" width="60px" height="60px"/> @endif</td>
                                        <td><i aria-hidden="true" class="fal {{ $cat->icon }} fa-w-16"></i></td>
                                        <td>{{ $cat->show == 0 ? __('category.hide') : __('category.display') }}</td>
                                        <td>{{ $cat->sort }}</td>
                                        <td>{{ $cat->is_year == 1 ? __('category.yes') : __('category.no') }}</td>
                                        <td>{{ $cat->type == 1 ? __('category.car_data') : __('category.main_data') }}</td>
                                        <td>
                                            <a href="{{ route('update_cat', $cat->id) }}" class="btn btn-info">{{ __('category.edit_category') }}</a>
                                            @if(count($cats->where('parent_id', $cat->id)) > 0)
                                            @endif
                                            <a href="{{ route('show_child', $cat->id) }}" class="btn btn-primary">{{ __('category.sub_categories') }}</a>
                                            <a data-toggle="modal" data-target="#del_cat{{ $i }}" class="btn btn-danger">{{ __('category.delete') }}</a>

                                            <!-- Modal -->
                                            <div id="del_cat{{ $i }}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">{{ __('category.delete_category') }}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>{{ $cat->name_ar }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="row">
                                                                <button type="button" class="col-md-4 btn btn-default" data-dismiss="modal">{{ __('category.close') }}</button>
                                                                <form method="get" action="{{ route('del_cat', $cat->id) }}">
                                                                    <button class="col-md-4 btn btn-danger" type="submit">{{ __('category.delete') }}</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="" data-toggle="modal" data-target="#myModal{{ $i }}" class="btn btn-default">{{ __('category.add_category') }}</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal{{ $i }}" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">{{ $cat->name_ar }}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ __('category.add_sub_category') }} {{ $cat->name_ar }}!?

                                                            <div class="card-box modal-add-child">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
                                                                        <form action="{{ route('cat.store') }}" method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden" value="{{ $cat->id }}" name="parent_id"/>
                                                                            <input type="hidden" value="yes" name="for_parent_id"/>
                                                                            <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label class="col-md-2 control-label @if($errors->has('name_ar')) has-error @endif">{{ __('category.category_name_ar') }}</label>
                                                                                    <div class="col-md-10">
                                                                                        <input type="text" required class="form-control" name="name_ar"/>

                                                                                    </div>
                                                                                    @if($errors->has('name_ar'))
                                                                                        <strong class="alert alert-danger">{{ $errors->first('name_ar') }}</strong>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
                                                                                <div class="form-group">
                                                                                    <div class="row">
                                                                                        <label class="col-md-2 control-label">{{ __('category.category_name_en') }}</label>
                                                                                        <div class="col-md-10">
                                                                                            <input type="text" class="form-control" name="name_en"/>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
                                                                                <div class="form-group" id="photo">
                                                                                    <label class="col-md-2 control-label">{{ __('category.category_image') }}</label>
                                                                                    <div class="col-md-10">
                                                                                        <input type="file" name="photo" class="filestyle" data-iconname="fa fa-cloud-upload">
                                                                                        @if($errors->has('photo'))
                                                                                            <strong class="alert alert-danger">{{ $errors->first('photo') }}</strong>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label class="col-md-2 control-label">{{ __('category.show_hide') }}</label>
                                                                                    <div class="col-md-10">
                                                                                        <select class="form-control" name="show">
                                                                                            <option value="1">{{ __('category.display') }}</option>
                                                                                            <option value="0" selected>{{ __('category.hide') }}</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label class="col-md-2 control-label">{{ __('category.order') }}</label>
                                                                                    <div class="col-md-10">
                                                                                        <input type="number" class="form-control" name="sort"/>
                                                                                    </div>
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
                                    
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('category.close') }}</button>
                                                                <button type="submit" class="btn btn-danger">{{ __('category.submit') }}</button>
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