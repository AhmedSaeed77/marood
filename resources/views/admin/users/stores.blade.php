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
                            <h4 class="m-t-0 header-title"><b>{{ __('stores.store_verification_requests') }}</b></h4>
                            <p class="text-muted font-13 m-b-30"></p>
                            <ul class="nav nav-tabs tabs">
                                <li class="active tab">
                                    <a href="#home" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">{{ __('stores.stores') }}</span>
                                    </a>
                                </li>
                                <li class="tab">
                                    <a href="#home-2" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">{{ __('stores.verification_requests') }}</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home">
                                    <table id="datatable-colvid" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('stores.username') }}</th>
                                            <th>{{ __('stores.store_id') }}</th>
                                            <th>{{ __('stores.store_description') }}</th>
                                            <th>{{ __('stores.store_address') }}</th>
                                            <th>{{ __('stores.request_time') }}</th>
                                            <th>{{ __('stores.buttons') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($stores->where('verify',1) as $i => $store)
                                            <tr>
                                                <td>{{ $i+1 }}</td>
                                                <td>{{ $store->User->name }}</td>
                                                <td>{{ $store->User->store_identify ?? '' }}</td>
                                                <td>{{ $store->User->description_store ?? '' }}</td>
                                                <td>{{ $store->User->address_store ?? '' }}</td>
                                                <td>{{ $store->created_at->diffForHumans() }}</td>
                                                <td>
                                                    <a href="{{ url('/') }}/admin/accept/store/verify/{{ $store->id }}" class="btn btn-primary">{{ __('stores.cancel_verification') }}</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="home-2">
                                    <table id="datatable-colvid" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('stores.username') }}</th>
                                            <th>{{ __('stores.verification_type') }}</th>
                                            <th>{{ __('stores.id_number') }}</th>
                                            <th>{{ __('stores.document_number') }}</th>
                                            <th>{{ __('stores.document_photo') }}</th>
                                            <th>{{ __('stores.notes') }}</th>
                                            <th>{{ __('stores.buttons') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($stores->where('verify',0) as $i => $store)
                                            <tr>
                                                <td>{{ $i+1 }}</td>
                                                <td>{{ $store->User->name }}</td>
                                                <td>{{ $store->type == 1 ? 'أبشر' : 'وثائق' }}</td>
                                                <td>{{ $store->ID_number }}</td>
                                                <td>{{ $store->DocumentNumber ?? '' }}</td>
                                                <td>
                                                    @if($store->photo)
                                                        <img src="{{ url('/') }}/public/storage/{{ $store->photo ?? '' }}" width='200px' height="200px"/>
                                                    @endif
                                                </td>
                                                <td>{{ $store->notes }}</td>
                                                <td>
                                                    @if($store->verify == 0)
                                                        <a href="{{ url('/') }}/admin/accept/store/verify/{{ $store->id }}" class="btn btn-primary">{{ __('stores.verify') }}</a>
                                                    @endif
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
@endsection