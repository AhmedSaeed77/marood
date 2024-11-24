@extends('admin.layouts.app')
@section('style')
<link href="{{url('/')}}/public/admin/assets/plugins/summernote/summernote.css" rel="stylesheet" />

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
                            <h4 class="m-t-0 header-title"><b><a href="{{ route('pages.index') }}">{{ __('page_question.website_pages') }}</a></b>\{{ $page->name_ar }}</h4>
                            <p class="text-muted font-13 m-b-30">
                                <a class="btn btn-info" data-toggle='modal' data-target="#add-question">{{ __('page_question.add_question') }}</a>
                            </p>

                            <table id="datatable-colvid" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('page_question.question') }}</th>
                                    <th>{{ __('page_question.answer') }}</th>
                                    <th>{{ __('page_question.under_question') }}</th>
                                    <th>{{ __('page_question.buttons') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($questions as $i => $q)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $q->question }}</td>
                                        <td>{!! $q->answer !!}</td>
                                        <td>{{ $q->parent ? $q->parent->question : '' }}</td>
                                        <td>
                                            <a data-toggle="modal" data-target="#del-page{{ $i }}" class="btn btn-danger">{{ __('page_question.delete') }}</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="del-page{{ $i }}" role="dialog">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">{{ __('page_question.delete') }} {{ $q->question }}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ __('page_question.delete_confirm') }} {{ $q->question }}!?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="row">
                                                                <div class="col-md-6 col-lg-6">
                                                                    <form action="{{ route('pages.destroy.question', $q->id) }}" method="post">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-danger">{{ __('page_question.delete') }}</button>
                                                                    </form>
                                                                </div>
                                                                <div>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('page_question.close') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="btn btn-info" data-toggle="modal" data-target="#edit-question{{ $i }}">{{ __('page_question.edit') }}</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="edit-question{{ $i }}" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">{{ __('page_question.edit_question') }} {{ $q->question }}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12 col-lg-12">
                                                                    <form action="{{ route('pages.edit.question', $q->id) }}" method="post">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <select class="form-control" name="parent_id">
                                                                                <option value="" {{ $q->parent_id == null ? 'selected' : '' }}>{{ __('page_question.under_question') }}</option>
                                                                                @foreach($questions->where('parent_id', null) as $qq)
                                                                                    <option value="{{ $qq->id }}" {{ $q->parent_id == $qq->id ? 'selected' : '' }}> {{ $q->question }} </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" name="question" class="form-control" value="{{ $q->question }}" required placeholder="{{ __('page_question.placeholder_question') }}"/>
                                                                        </div>
                                                                        <br>
                                                                        <div class="form-group">
                                                                            <textarea class="summernote" name="answer" placeholder="{{ __('page_question.placeholder_answer') }}">{{ $q->answer }}</textarea>
                                                                        </div>
                                                                        <hr>
                                                                        <button type="submit" class="btn btn-info">{{ __('page_question.edit') }}</button>
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('page_question.close') }}</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end modal -->
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="add-question" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">{{ __('page_question.add_question_to_page') }}</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <form action="{{ route('pages.add.question', $page->id) }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <select class="form-control" name="parent_id">
                                                    <option value="">{{ __('page_question.under_question') }}</option>
                                                    @foreach($questions->where('parent_id', null) as $q)
                                                        <option value="{{ $q->id }}"> {{ $q->question }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="question" class="form-control" required placeholder="{{ __('page_question.placeholder_question') }}"/>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <textarea class="summernote" name="answer" placeholder="{{ __('page_question.placeholder_answer') }}"></textarea>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div>
                                    <button type="submit" class="btn btn-info">{{ __('page_question.add') }}</button>
                                    </form>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('page_question.close') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modal -->
            </div>
        </div>
    </div>
@endsection

@section('afterscript')
 <!--form validation init-->
 <script src="{{url('/')}}/public/admin/assets/plugins/summernote/summernote.min.js"></script>

<script>

    jQuery(document).ready(function(){

        $('.summernote').summernote({
            height: 100,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false                 // set focus to editable area after initializing summernote
        });
        
        $('.inline-editor').summernote({
            airMode: true            
        });

    });
</script>
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