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

                            <h4 class="m-t-0 header-title"><b>{{ __('commissions.memberships') }}</b></h4>
                            <p class="text-muted font-13 m-b-30">
                                <a class="btn btn-info" data-toggle="modal" data-target="#add-commission">{{ __('commissions.add_new_commission') }}</a>
                            </p>

                            <table id="datatable-colvid" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('commissions.section_name') }}</th>
                                    <th>{{ __('commissions.title_arabic') }}</th>
                                    <th>{{ __('commissions.title_english') }}</th>
                                    <th>{{ __('commissions.description_arabic') }}</th>
                                    <th>{{ __('commissions.description_english') }}</th>
                                    <th>{{ __('commissions.buttons') }}</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($commissions as $i=>$commission)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$commission->Cat?$commission->Cat->name: __('commissions.all_sections')}}</td>
                                        <td>{{$commission->name_ar}}</td>
                                        <td>{{$commission->name_en}}</td>

                                        <td><?php echo $commission->desc_ar;?></td>
                                        <td><?php echo $commission->desc_en;?></td>

                                        <td><a data-toggle="modal" data-target="#del-page{{$i}}" class="btn btn-danger">{{ __('commissions.delete') }}</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="del-page{{$i}}" role="dialog">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">{{ __('commissions.delete') }} {{$commission->name_ar}}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ __('commissions.are_you_sure_delete') }} {{$commission->name_ar}}!?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="row">
                                                                <div class="col-md-6 col-lg-6">
                                                                    <form action="{{route('Commission.destroy',$commission->id)}}" method="get">
                                                                        <button type="submit" class="btn btn-danger">{{ __('commissions.delete') }}</button>
                                                                    </form>
                                                                </div>
                                                                <div>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('commissions.close') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a data-toggle="modal" data-target="#update_commision{{$i}}" class="btn btn-info">{{ __('commissions.edit') }}</a>

                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="update_commision{{$i}}" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">{{ __('commissions.edit_commission_for_section') }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12">
                                                            <form action="{{route('Commission.edit',$commission->id)}}" method="post">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <select class="form-control" name="cat">
                                                                        <option value="" {{$commission->cat_id != null??'selected'}}>{{ __('commissions.all_sections') }}</option>
                                                                        @foreach(\App\Models\Cat::where('parent_id',null)->get() as $cat)
                                                                            <option value="{{$cat->id}}" {{$commission->cat_id != null?$commission->cat_id==$cat->id?'selected':'':''}}> {{$cat->name}} </option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                                <br>
                                                                <div class="form-group">
                                                                    <input class="form-control" name="name_ar" value="{{$commission->name_ar}}" placeholder="{{ __('commissions.title_arabic') }}">
                                                                </div>
                                                                <br>
                                                                <div class="form-group">
                                                                    <input class="form-control" name="name_en" value="{{$commission->name_en}}"placeholder="{{ __('commissions.title_english') }}">
                                                                </div>
                                                                <br>
                                                                <div class="form-group">
                                                                    <textarea class="summernote" name="desc_ar" >{{$commission->desc_ar}}</textarea>
                                                                </div>
                                                                <br>
                                                                <div class="form-group">
                                                                    <textarea class="summernote" name="desc_en">{{$commission->desc_en}}</textarea>
                                                                </div>

                                                        </div>
                                                        <div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div>
                                                                <button type="submit" class="btn btn-info">{{ __('commissions.edit') }}</button>
                                                                </form>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('commissions.close') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end model -->
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="add-commission" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{ __('commissions.add_commission_to_section') }}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <form action="{{route('commission.create')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <select class="form-control" name="cat">
                                            <option value="">{{ __('commissions.all_sections') }}</option>
                                            @foreach(\App\Models\Cat::where('parent_id',null)->get() as $cat)
                                                <option value="{{$cat->id}}"> {{$cat->name}} </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <br>
                                    <div class="form-group">
                                        <input class="form-control" required name="name_ar"  placeholder="{{ __('commissions.title_arabic') }}">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input class="form-control" name="name_en" placeholder="{{ __('commissions.title_english') }}">
                                    </div>
                                    <br>
                                    <div class="form-group">

                                                                        <textarea class="summernote" required name="desc_ar" >

                                                                        </textarea>
                                    </div>
                                    <br>
                                    <div class="form-group">

                                                                  <textarea class="summernote" name="desc_en">

                                                                  </textarea>
                                    </div>

                            </div>
                            <div>
                            </div>
                            <div class="modal-footer">
                                <div>
                                    <button type="submit" class="btn btn-info">{{ __('commissions.add') }}</button>
                                    </form>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('commissions.close') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end model -->

                @endsection

@section('afterscript')
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