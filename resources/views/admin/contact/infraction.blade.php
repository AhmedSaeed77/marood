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
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ __('infraction.infraction_messages') }}</h3>
                            </div>
                            <div class="panel-body">
                                <ul class="nav nav-pills m-b-30">
                                    @foreach($why as $i => $w)
                                        <li class="{{ isset($whyActive) ? ($whyActive == $w->id ? 'active' : '') : ($i == 0 ? 'active' : '') }}">
                                            <a href="#navpills-{{$i}}1" data-toggle="tab" aria-expanded="true">{{$w->title_ar}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content br-n pn">
                                    @foreach($why as $i => $w)
                                        <div id="navpills-{{$i}}1" class="tab-pane {{ isset($whyActive) ? ($whyActive == $w->id ? 'active' : '') : ($i == 0 ? 'active' : '') }}">
                                            <div class="row">
                                                <table id="datatable-colvid-{{$i}}" class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('infraction.message_owner') }}</th>
                                                        <th>{{ __('infraction.advertisement') }}</th>
                                                        <th>{{ __('infraction.advertisement_owner') }}</th>
                                                        <th>{{ __('infraction.notes') }}</th>
                                                        <!--<th>{{ __('infraction.status') }}</th>-->
                                                        <th>{{ __('infraction.message_date') }}</th>
                                                        <th>{{ __('infraction.buttons') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($contact->where('type_id', $w->id) as $i => $con)
                                                        <tr id="{{$con->id}}">
                                                            <td>{{$i + 1}}</td>
                                                            <td>{{$con->user->name}}</td>
                                                            <td><a href="{{route('single_post', $con->post->id)}}">{{$con->post->title_ar}}</a></td>
                                                            <td>{{$con->post->post_user->user->name}}</td>
                                                            <td>{{$con->notes ?? __('infraction.no_notes')  }}</td>
                                                            <!--<td>{{$con->status == 1 ? __('infraction.read') : __('infraction.unread') }}</td>-->
                                                            <td>{{$con->created_at}}</td>
                                                            <td><a data-toggle="modal" data-target="#del-msg{{$i}}" class="btn btn-danger">{{ __('infraction.delete') }}</a></td>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="del-msg{{$i}}" role="dialog">
                                                                <div class="modal-dialog modal-sm">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <h4 class="modal-title">{{ __('infraction.delete_message') }}</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            {{ __('infraction.confirm_delete', ['desc' => $con->desc]) }}
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <div class="row">
                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <form action="{{route('infraction.destroy', $con->id)}}" method="post">
                                                                                        @csrf
                                                                                        <input type="hidden" name="_method" value="delete"/>
                                                                                        <button type="submit" class="btn btn-danger">{{ __('infraction.delete') }}</button>
                                                                                    </form>
                                                                                </div>
                                                                                <div>
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('infraction.close') }}</button>
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

    });
</script>
@endsection
