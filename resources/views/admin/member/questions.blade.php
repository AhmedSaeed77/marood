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
                            <h4 class="m-t-0 header-title"><b><a href="{{route('memberShip.index')}}">{{ __('subscribe.add_offer_to_membership') }}</a></b></h4>
                            <p class="text-muted font-13 m-b-30">
                                <a class="btn btn-info" data-toggle='modal' data-target="#add-package">{{ __('subscribe.add_offer') }}</a>

                            </p>

                            <table id="datatable-colvid" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('subscribe.offer_title_arabic') }}</th>
                                    <th>{{ __('subscribe.offer_title_english') }}</th>
                                    <th>{{ __('subscribe.offer_price') }}</th>
                                    <th>{{ __('subscribe.offer_duration') }}</th>
                                    <th>{{ __('subscribe.buttons') }}</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($member->packages as $i=>$p)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$p->title_ar}}</td>
                                        <td>{{$p->title_en}}</td>
                                        <td>{{$p->price}}</td>
                                        <td>{{$p->number}}<?php if($p->duration==0)
                                            {echo __('subscribe.days');}
                                            elseif($p->duration==1)
                                            {echo __('subscribe.week');}
                                            elseif($p->duration==2){echo __('subscribe.month');}
                                            elseif($p->duration==3){echo __('subscribe.year');}
                                                              ?>
                                        </td>
                                        <td><a data-toggle="modal" data-target="#del-package{{$i}}" class="btn btn-danger">{{ __('subscribe.delete') }}</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="del-package{{$i}}" role="dialog">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">{{ __('subscribe.delete') }} {{$p->title_ar}}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ __('subscribe.confirm_delete') }} {{$p->title_ar}}!?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="row">
                                                                <div class="col-md-6 col-lg-6">
                                                                    <form action="{{route('member.package.destroy',$p->id)}}" method="get">
                                                                        <button type="submit" class="btn btn-danger">{{ __('subscribe.delete') }}</button>
                                                                    </form>
                                                                </div>
                                                                <div>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('subscribe.close') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a  class="btn btn-info" data-toggle="modal" data-target="#edit-package{{$i}}">{{ __('subscribe.edit') }}</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="edit-package{{$i}}" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">{{ __('subscribe.edit_offer_modal_title') }} {{$p->title_ar}}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12 col-lg-12">
                                                                    <form action="{{route('member.package.update',$p->id)}}" method="post">
                                                                        @csrf

                                                                        <div class="form-group">
                                                                            <input type="text" name="title_ar" class="form-control" value="{{$p->title_ar}}" placeholder="{{ __('subscribe.offer_title_arabic') }}"/>
                                                                        </div>
                                                                        <br>
                                                                        <div class="form-group">
                                                                            <input type="text" name="title_en" class="form-control" value="{{$p->title_en}}" placeholder="{{ __('subscribe.offer_title_english') }}"/>
                                                                        </div>
                                                                        <br>
                                                                        <div class="form-group ">
                                                                            <input type="number" required name="price" class="form-control" value="{{$p->price}}" placeholder="{{ __('subscribe.offer_price') }}"/>
                                                                        </div>
                                                                        <br>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <input type="number" name="number" class="form-control" value="{{$p->number}}" placeholder="{{ __('subscribe.offer_duration') }}"/>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <select class="form-control" name="duration">
                                                                                    <option value="0" {{$p->duration==0?'selected':''}}>{{ __('subscribe.days') }}</option>
                                                                                    <option value="1" {{$p->duration==1?'selected':''}}>{{ __('subscribe.week') }}</option>
                                                                                    <option value="2" {{$p->duration==2?'selected':''}}>{{ __('subscribe.month') }}</option>
                                                                                    <option value="3" {{$p->duration==3?'selected':''}}>{{ __('subscribe.year') }}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <br>

                                                                </div>
                                                                <hr>
                                                                <button type="submit" class="btn btn-info">{{ __('subscribe.edit') }}</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('subscribe.close') }}</button>
                                                                </form>
                                                                <div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end model -->

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="add-package" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">{{ __('subscribe.add_offer_modal_title') }}</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <form action="{{route('member.package.create',$member->id)}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" name="title_ar" required class="form-control"  placeholder="{{ __('subscribe.offer_title_arabic') }}"/>

                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <input type="text" name="title_en" class="form-control" placeholder="{{ __('subscribe.offer_title_english') }}"/>
                                            </div>
                                            <br>
                                            <div class="form-group ">
                                                <input type="number" name="price" required class="form-control"  placeholder="{{ __('subscribe.offer_price') }}"/>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <input type="number" name="number"required class="form-control" placeholder="{{ __('subscribe.offer_duration') }}"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <select class="form-control"required name="duration">
                                                        <option value="0">{{ __('subscribe.days') }}</option>
                                                        <option value="1">{{ __('subscribe.week') }}</option>
                                                        <option value="2" selected>{{ __('subscribe.month') }}</option>
                                                        <option value="3">{{ __('subscribe.year') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>


                                    </div>
                                    <div>
                                    </div>
                                    <div class="modal-footer">
                                        <div>
                                            <button type="submit" class="btn btn-info">{{ __('subscribe.add') }}</button>
                                            </form>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('subscribe.close') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end model -->

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