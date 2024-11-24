@extends('admin.layouts.app')
@section('style')
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
                    <div class="col-sm-12 card-box table-responsive">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ __('contact.panel_title') }}</h3>
                            </div>
                            <div class="panel-body">
                                <ul class="nav nav-pills m-b-30">
                                    @foreach( $why as $i=>$w)
                                        <li class="{{$i==0?'active':''}}">
                                            <a href="#navpills-{{$i}}1" data-toggle="tab" aria-expanded="true">{{app()->getLocale() == 'ar' ? $w->title_ar : $w->title_en}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content br-n pn">
                                    @foreach( $why as $i=>$w)
                                        <div id="navpills-{{$i}}1" class="tab-pane {{$i==0?'active':''}}">
                                            <div class="row">
                                                <table id="datatable-colvid-{{$i}}" class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr >
                                                        <th>#</th>
                                                        <th>{{ __('contact.email') }}</th>
                                                        <th>{{ __('contact.phone_number') }}</th>
                                                        <th>{{ __('contact.message') }}</th>
                                                        <th>{{ __('contact.image') }}</th>
                                                        <th>{{ __('contact.message_date') }}</th>
                                                        <th>{{ __('contact.buttons') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($contact->where('why_id',$w->id) as $i=>$con)
                                                        <tr id="{{$con->id}}">
                                                            <td>{{$i+1}}</td>
                                                            <td>{{$con->email}}</td>
                                                            <td>{{$con->phone}}</td>
                                                            <td>{{$con->desc}}</td>
                                                            <td>
                                                                @if($con->photo)
                                                                    <img style="width: 100px;height: 100px" src="{{url('/')}}/public/storage/{{$con->photo??''}}"/>
                                                                @else
                                                                    {{ __('contact.no_image') }}
                                                                @endif
                                                            </td>
                                                            <td>{{$con->created_at}}</td>
                                                            <td><a data-toggle="modal" data-target="#del-msg{{$i}}" class="btn btn-danger">{{ __('contact.delete_message') }}</a></td>
                                                            <!-- Delete Modal -->
                                                            <div class="modal fade" id="del-msg{{$i}}" role="dialog">
                                                                <div class="modal-dialog modal-sm">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <h4 class="modal-title">{{ __('contact.delete_message') }}</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            {{ __('contact.confirm_delete', ['message' => $con->desc]) }}
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <div class="row">
                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <form action="{{route('contact.destroy',$con->id)}}" method="post">
                                                                                        @csrf
                                                                                        <input type="hidden" name="_method" value="delete"/>
                                                                                        <button type="submit" class="btn btn-danger">{{ __('contact.delete_message') }}</button>
                                                                                    </form>
                                                                                </div>
                                                                                <div>
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('contact.close') }}</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
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

<script>
    $(document).ready(function() {
        $('#datatable-colvid-0').DataTable();
          $('#datatable-colvid-1').DataTable();
            $('#datatable-colvid-2').DataTable();
              $('#datatable-colvid-3').DataTable();
    });
</script>
@endsection