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
                            <h4 class="m-t-0 header-title"><b>البنرات</b></h4>
                            <p class="text-muted font-13 m-b-30">
                            <a class="btn btn-default" data-toggle="modal" data-target="#add_slidear">اضافه بنر</a>
                                                                                       <!-- Modal -->
                                             <div class="modal fade" id="add_slidear" role="dialog">
                                                    <div class="modal-dialog ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">اضافه بنر جديده</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="{{route('slidear.store')}}" enctype="multipart/form-data" >
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <lable  class="col-md-3">البنر</lable>
                                                                        <div class="col-md-9">
                                                                          <input class="form-control" required name="photo" type="file" />
                                                                        </div>
                                                                    </div>
                                                                    
                                                                  <div class="form-group">
                                                                        <lable  class="col-md-3">رابط</lable>
                                                                        <div class="col-md-9">
                                                                          <input class="form-control"  name="url" type="text" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                      <button class="btn btn-info" type="submit">اضافه</button>
                                                                      <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق</button>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                     </div>
                                                    </div>
                                                </div>
                            </p>

                            <table id="datatable-colvid" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>البتر</th>
                                    <th>رابط</th>
                                    <th>buttons</th>
                                </tr>
                                </thead>


                                <tbody>
                                    @foreach($slidear as $i=>$s)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td><img src="{{url('/')}}/{{$s->image}}" width="150px"/></td>
                                    <td>{{$s->url}}</td>
                                    <td>
                                       

                                        <a  data-target="#edit_modal{{$i}}" data-toggle="modal" class="btn btn-info">تعديل </a>
                                                                                           <!-- Modal -->
                                             <div class="modal fade" id="edit_modal{{$i}}" role="dialog">
                                                    <div class="modal-dialog ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">تعديل البنر</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="{{route('slidear.update',$s->id)}}" enctype= "multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="_method" value="put">
                                                                    <div class="form-group">
                                                                        <lable  class="col-md-3">البنر</lable>
                                                                        <div class="col-md-9">
                                                                          <input class="form-control"  name="photo" type="file" />
                                                                        </div>
                                                                    </div>
                                                                     <div class="form-group">
                                                                        <lable  class="col-md-3">رابط</lable>
                                                                        <div class="col-md-9">
                                                                          <input class="form-control"  name="url" type="text" value="{{$s->url}}"/>
                                                                        </div>
                                                                    </div>
                                                                  
                                                                    <div class="form-group">
                                                                      <button class="btn btn-info" type="submit">تعديل</button>
                                                                      <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق</button>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                     </div>
                                                    </div>
                                                </div>
                                                <a  data-target="#del_modal{{$i}}" data-toggle="modal" class="btn btn-danger">حذف </a>
                                                                                           <!-- Modal -->
                                             <div class="modal fade" id="del_modal{{$i}}" role="dialog">
                                                    <div class="modal-dialog ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">حذف</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h2>متاكد من حذف البنر ؟<h2>
                                                            <form method="post" action="{{route('slidear.destroy',$s->id)}}" >
                                                                    @csrf
                                                                    <input type="hidden" name="_method" value="delete">
                                                                    <div class="form-group">
                                                                      <button class="btn btn-danger" type="submit">حذف</button>
                                                                      <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق</button>
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