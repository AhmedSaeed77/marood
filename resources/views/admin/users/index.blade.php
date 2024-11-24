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
<style>
    .panel-body .nav > li > a {
     background-color: lightgrey;   
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
                        <h4 class="m-t-0 header-title"><b>{{ __('users.users') }}</b></h4>
                        <p class="text-muted font-13 m-b-30"></p>
                        <div class="panel-body">
                            <ul class="nav nav-pills m-b-30">
                                <li class="active">
                                    <a href="#navpills-11" data-toggle="tab" aria-expanded="true">{{ __('users.new_users') }}</a>
                                </li>
                                <li class="">
                                    <a href="#navpills-12" data-toggle="tab" aria-expanded="false">{{ __('users.activated_users') }}</a>
                                </li>
                                <li class="">
                                    <a href="#navpills-13" data-toggle="tab" aria-expanded="false">{{ __('users.blacklist') }}</a>
                                </li>
                            </ul>
                            <div class="tab-content br-n pn">
                                <div id="navpills-11" class="tab-pane active">
                                    <div class="row">
                                        <table id="datatable-colvid" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('users.profile_picture') }}</th>
                                                    <th>{{ __('users.username') }}</th>
                                                    <th>{{ __('users.email') }}</th>
                                                    <th>{{ __('users.phone') }}</th>
                                                    <th>{{ __('users.facebook') }}</th>
                                                    <th>{{ __('users.twitter') }}</th>
                                                    <th>{{ __('users.instagram') }}</th>
                                                    <th>{{ __('users.role') }}</th>
                                                    <th>{{ __('users.membership') }}</th>
                                                    <th>{{ __('users.actions') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users->where('active',0) as $i=>$user)
                                                    <tr id="{{ $user->id }}">
                                                        <td>{{ $i+1 }}</td>
                                                        <td><img src="{{ url('/') }}/public/storage/{{ $user->avatar ?? 'users/default.png' }}" width="60px" height="60px"/></td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->phone ?? '' }}</td>
                                                        <td>{{ $user->fb ?? '' }}</td>
                                                        <td>{{ $user->tw ?? '' }}</td>
                                                        <td>{{ $user->inst ?? '' }}</td>
                                                        <td>{{ $user->getRoleNames() ?? '' }}</td>
                                                        <td>{{ $user->member_id ? $user->memberShip->title_ar ?? '' : '' }}</td>
                                                        <td>
                                                            @if($user->id == 1)
                                                                <a class="btn btn-info" data-toggle="modal" data-target="#edit_admin">{{ __('users.edit_main_info') }}</a>
                                                                <div class="modal fade" id="edit_admin" role="dialog">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                <h4 class="modal-title">{{ __('users.edit_info') }}</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="{{ route('admin_edit_user', $user->id) }}" method="post">
                                                                                    @csrf
                                                                                    <div class="form-group">
                                                                                        <input value="{{ $user->name }}" type="text" name="name" class="form-control">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input value="{{ $user->email }}" type="email" name="email" class="form-control">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input value="{{ $user->phone }}" type="text" name="phone" class="form-control">
                                                                                    </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <div class="row">
                                                                                    <div class="col-md-6 col-lg-6">
                                                                                        <button type="submit" class="btn btn-primary">{{ __('users.edit') }}</button>
                                                                                    </div>
                                                                                    <div class="col-md-6 col-lg-6">
                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('users.close') }}</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <a href="{{ route('user.roles', $user->id) }}" class="btn btn-default">{{ __('users.permissions') }}</a>
                                                                <a href="{{ url('/') }}/admin/user_active/{{ $user->id }}" class="btn btn-info">{{ $user->active == 0 ? __('users.activate_user') : __('users.ban_user') }}</a>
                                                                <a href="#" data-toggle="modal" data-target="#deleteModal{{ $i }}" class="btn btn-danger">{{ __('users.delete_user') }}</a>
                                                                <div class="modal fade" id="deleteModal{{ $i }}" role="dialog">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                <h4 class="modal-title">{{ __('users.confirm_delete_user', ['user' => $user->name]) }}</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                {{ __('users.confirm_delete_user', ['user' => $user->name]) }}
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <div class="row">
                                                                                    <div class="col-md-6 col-lg-6">
                                                                                        <form action="{{ route('del_user', $user->id) }}" method="get">
                                                                                            <button type="submit" class="btn btn-danger">{{ __('users.confirm_delete') }}</button>
                                                                                        </form>
                                                                                    </div>
                                                                                    <div class="col-md-6 col-lg-6">
                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('users.cancel') }}</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="navpills-12" class="tab-pane">
                                    <div class="row">
                                        <table id="datatable-colvid1" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('users.profile_picture') }}</th>
                                                    <th>{{ __('users.username') }}</th>
                                                    <th>{{ __('users.email') }}</th>
                                                    <th>{{ __('users.phone') }}</th>
                                                    <th>{{ __('users.facebook') }}</th>
                                                    <th>{{ __('users.twitter') }}</th>
                                                    <th>{{ __('users.instagram') }}</th>
                                                    <th>{{ __('users.role') }}</th>
                                                    <th>{{ __('users.membership') }}</th>
                                                    <th>{{ __('users.actions') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users->where('active',1) as $i=>$user)
                                                    <tr id="{{ $user->id }}">
                                                        <td>{{ $i+1 }}</td>
                                                        <td><img src="{{ url('/') }}/public/storage/{{ $user->avatar ?? 'users/default.png' }}" width="60px" height="60px"/></td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->phone ?? '' }}</td>
                                                        <td>{{ $user->fb ?? '' }}</td>
                                                        <td>{{ $user->tw ?? '' }}</td>
                                                        <td>{{ $user->inst ?? '' }}</td>
                                                        <td>{{ $user->getRoleNames() ?? '' }}</td>
                                                        <td>{{ $user->member_id ? $user->memberShip->title_ar ?? '' : '' }}</td>
                                                        <td>
                                                            @if($user->id == 1)
                                                                <a class="btn btn-info" data-toggle="modal" data-target="#edit_admin">{{ __('users.edit_main_info') }}</a>
                                                                <div class="modal fade" id="edit_admin" role="dialog">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                <h4 class="modal-title">{{ __('users.edit_info') }}</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="{{ route('admin_edit_user', $user->id) }}" method="post">
                                                                                    @csrf
                                                                                    <div class="form-group">
                                                                                        <input value="{{ $user->name }}" type="text" name="name" class="form-control">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input value="{{ $user->email }}" type="email" name="email" class="form-control">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input value="{{ $user->phone }}" type="text" name="phone" class="form-control">
                                                                                    </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <div class="row">
                                                                                    <div class="col-md-6 col-lg-6">
                                                                                        <button type="submit" class="btn btn-primary">{{ __('users.edit') }}</button>
                                                                                    </div>
                                                                                    <div class="col-md-6 col-lg-6">
                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('users.close') }}</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <a href="{{ route('user.roles', $user->id) }}" class="btn btn-default">{{ __('users.permissions') }}</a>
                                                                <a href="{{ url('/') }}/admin/user_active/{{ $user->id }}" class="btn btn-warning">{{ $user->active == 0 ? __('users.activate_user') : __('users.ban_user') }}</a>
                                                                <a href="#" data-toggle="modal" data-target="#deleteModal{{ $i }}" class="btn btn-danger">{{ __('users.delete_user') }}</a>
                                                                <div class="modal fade" id="deleteModal{{ $i }}" role="dialog">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                <h4 class="modal-title">{{ __('users.confirm_delete_user', ['user' => $user->name]) }}</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                {{ __('users.confirm_delete_user', ['user' => $user->name]) }}
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <div class="row">
                                                                                    <div class="col-md-6 col-lg-6">
                                                                                        <form action="{{ route('del_user', $user->id) }}" method="get">
                                                                                            <button type="submit" class="btn btn-danger">{{ __('users.confirm_delete') }}</button>
                                                                                        </form>
                                                                                    </div>
                                                                                    <div class="col-md-6 col-lg-6">
                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('users.cancel') }}</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="navpills-13" class="tab-pane">
                                    <div class="row">
                                        <table id="datatable-colvid2" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('users.profile_picture') }}</th>
                                                    <th>{{ __('users.username') }}</th>
                                                    <th>{{ __('users.email') }}</th>
                                                    <th>{{ __('users.phone') }}</th>
                                                    <th>{{ __('users.facebook') }}</th>
                                                    <th>{{ __('users.twitter') }}</th>
                                                    <th>{{ __('users.instagram') }}</th>
                                                    <th>{{ __('users.role') }}</th>
                                                    <th>{{ __('users.membership') }}</th>
                                                    <th>{{ __('users.actions') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users->where('banned',1) as $i=>$user)
                                                    <tr id="{{ $user->id }}">
                                                        <td>{{ $i+1 }}</td>
                                                        <td><img src="{{ url('/') }}/public/storage/{{ $user->avatar ?? 'users/default.png' }}" width="60px" height="60px"/></td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->phone ?? '' }}</td>
                                                        <td>{{ $user->fb ?? '' }}</td>
                                                        <td>{{ $user->tw ?? '' }}</td>
                                                        <td>{{ $user->inst ?? '' }}</td>
                                                        <td>{{ $user->getRoleNames() ?? '' }}</td>
                                                        <td>{{ $user->member_id ? $user->memberShip->title_ar ?? '' : '' }}</td>
                                                        <td>
                                                            <a href="{{ route('user.roles', $user->id) }}" class="btn btn-default">{{ __('users.permissions') }}</a>
                                                            <a href="{{ url('/') }}/admin/user_unban/{{ $user->id }}" class="btn btn-warning">{{ __('users.unban_user') }}</a>
                                                            <a href="#" data-toggle="modal" data-target="#deleteModal{{ $i }}" class="btn btn-danger">{{ __('users.delete_user') }}</a>
                                                            <div class="modal fade" id="deleteModal{{ $i }}" role="dialog">
                                                                <div class="modal-dialog modal-sm">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <h4 class="modal-title">{{ __('users.confirm_delete_user', ['user' => $user->name]) }}</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            {{ __('users.confirm_delete_user', ['user' => $user->name]) }}
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <div class="row">
                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <form action="{{ route('del_user', $user->id) }}" method="get">
                                                                                        <button type="submit" class="btn btn-danger">{{ __('users.confirm_delete') }}</button>
                                                                                    </form>
                                                                                </div>
                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('users.cancel') }}</button>
                                                                                </div>
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
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end container -->
            </div><!-- end content -->
        </div><!-- end content-page -->
    </div>
    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->
</div><!-- end row -->
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
        $('#datatable-colvid1').DataTable();
        $('#datatable-colvid2').DataTable();
    });
</script>
@endsection