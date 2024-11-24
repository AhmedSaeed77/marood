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
                            <h4 class="m-t-0 header-title"><b>{{__('banks.bank_accounts')}}</b></h4>
                            <p class="text-muted font-13 m-b-30">
                                <a class="btn btn-default" data-toggle="modal" data-target="#add-bank">{{__('banks.add_account')}}</a>
                            </p>

                            <table id="datatable-colvid" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('banks.bank_name')}}</th>
                                    <th>{{__('banks.account_name')}}</th>
                                    <th>{{__('banks.account_number')}}</th>
                                    <th>{{__('banks.iban')}}</th>
                                    <th>{{__('banks.bank_logo')}}</th>
                                    <th>{{__('banks.buttons')}}</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($banks as $i=>$bank)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$bank->bankName}}</td>
                                        <td>{{$bank->userNameBank}}</td>
                                        <td>{{$bank->accountnumber}}</td>
                                        <td>{{$bank->Iban}}</td>
                                        <td><img src="{{url('/')}}/public/storage/{{$bank->bank_photo}}" width="60px" height="60px"/></td>

                                        <td>
                                            <a  data-toggle="modal" data-target="#update_bank{{$i}}" class="btn btn-info">{{__('banks.edit')}}</a>
                                            <!--  Modal content for the above example -->
                                            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="update_bank{{$i}}" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-lg ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title" id="myLargeModalLabel">{{__('banks.edit_bank')}}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="{{route('update_bank',$bank->id)}}" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <lable class="col-md-2">{{__('banks.bank_name')}}</lable>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" value="{{$bank->bankName}}" name="name"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <lable class="col-md-2">{{__('banks.account_name')}}</lable>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" value="{{$bank->userNameBank}}" name="userBankName"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <lable class="col-md-2">{{__('banks.account_number')}}</lable>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" value="{{$bank->accountnumber}}"  name="account"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <lable class="col-md-2">{{__('banks.iban')}}</lable>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" value="{{$bank->Iban}}" name="Iban"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <lable class="col-md-2">{{__('banks.bank_logo')}}</lable>
                                                                        <div class="col-md-10">
                                                                            <input type="file" class="form-control filestyle" name="logo"/>
                                                                            <br>
                                                                        </div>

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <lable class="col-md-2"></lable>
                                                                        <div class="col-md-10">
                                                                            <button type="submit" class="btn btn-default form-control">{{__('banks.edit')}}</button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                            <a  data-toggle="modal" data-target="#del_bank{{$i}}" class="btn btn-danger">{{__('banks.delete')}}</a>
                                            <!--  Modal content for the above example -->
                                            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="del_bank{{$i}}" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-sm ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title" id="myLargeModalLabel">{{__('banks.delete_bank')}}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="get" action="{{route('del_bank',$bank->id)}}" enctype="multipart/form-data">
                                                                <h2>{{__('banks.confirm_delete')}}</h2>
                                                                <div class="form-group">
                                                                    <lable class="col-md-2"></lable>
                                                                    <div class="col-md-10">
                                                                        <button type="submit" class="btn btn-danger ">{{__('banks.delete')}}</button>
                                                                        <button type="button" class="btn btn-default " data-dismiss="modal" aria-hidden="true">{{__('banks.close')}}</button>

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
    <!--  Modal content for the above example -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="add-bank" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myLargeModalLabel">{{__('banks.add_bank_modal_title')}}</h4>
                </div
                <div class="modal-body">
                    <form method="post" action="{{route('setting.add.banks')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group">
                                <lable class="col-md-2">{{__('banks.bank_name')}}</lable>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" required name="name"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <lable class="col-md-2">{{__('banks.account_name')}}</lable>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" required name="userBankName"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <lable class="col-md-2">{{__('banks.account_number')}}</lable>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" required name="account"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <lable class="col-md-2">{{__('banks.iban')}}</lable>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" required name="Iban"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <lable class="col-md-2">{{__('banks.bank_logo')}}</lable>
                                <div class="col-md-10">
                                    <input type="file" required class="form-control filestyle" name="logo"/>
                                    <br>
                                </div>

                            </div>

                            <div class="form-group">
                                <lable class="col-md-2"></lable>
                                <div class="col-md-10">
                                    <button type="submit" class="btn btn-default form-control">{{__('banks.add')}}</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

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