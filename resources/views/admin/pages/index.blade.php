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
                            <h4 class="m-t-0 header-title"><b>{{ __('pages.site_pages') }}</b></h4>
                            <p class="text-muted font-13 m-b-30">
                                <a class="btn btn-info" href="{{ route('pages.create') }}">{{ __('pages.add_new_page') }}</a>
                            </p>

                            <table id="datatable-colvid" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>{{ __('pages.id') }}</th>
                                    <th>{{ __('pages.page_name_arabic') }}</th>
                                    <th>{{ __('pages.page_name_english') }}</th>
                                    <th>{{ __('pages.page_link') }}</th>
                                    <th>{{ __('pages.page_visibility') }}</th>
                                    <th>{{ __('pages.page_icon') }}</th>
                                    <th>{{ __('pages.buttons') }}</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($pages as $i => $page)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $page->name_ar }}</td>
                                        <td>{{ $page->name_en }}</td>
                                        <td>{{ $page->link }}</td>
                                        <td>{{ $page->active == 1 ? __('pages.visible') : __('pages.hidden') }}</td>
                                        <td><i class="fa {{ $page->icon ?? '' }}"></i></td>
                                        <td>
                                            @if($page->id != 11)
                                                <a data-toggle="modal" data-target="#del-page{{ $i }}" class="btn btn-danger">{{ __('pages.delete') }}</a>
                                            @endif
                                            <!-- Modal -->
                                            <div class="modal fade" id="del-page{{ $i }}" role="dialog">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">{{ __('pages.delete') }} {{ $page->name_ar }}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ __('pages.delete_confirmation', ['name' => $page->name_ar]) }}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="row">
                                                                <div class="col-md-6 col-lg-6">
                                                                    <form action="{{ route('pages.destroy', $page->id) }}" method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="_method" value="delete">
                                                                        <button type="submit" class="btn btn-danger">{{ __('pages.delete') }}</button>
                                                                    </form>
                                                                </div>
                                                                <div>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('pages.close') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="{{ route('pages.edit', $page->id) }}" class="btn btn-info">{{ __('pages.edit') }}</a>
                                            <a href="{{ route('pages.questions', $page->id) }}" class="btn btn-primary">{{ __('pages.page_questions') }}</a>
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