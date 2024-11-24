@extends('admin.layouts.app')
@section('style')
@endsection

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{__('transfer.bank_transfers')}}</h3>
                            </div>
                            <div class="panel-body">
                                <ul class="nav nav-pills m-b-30">
                                    <li class="active">
                                        <a href="#navpills-11" data-toggle="tab" aria-expanded="true">{{__('transfer.commission_payment')}}</a>
                                    </li>
                                    <li>
                                        <a href="#navpills-21" data-toggle="tab" aria-expanded="false">{{__('transfer.memberships')}}</a>
                                    </li>
                                </ul>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-11" class="tab-pane active">
                                        <div class="row">
                                            <table id="datatable-colvid" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{__('transfer.sender_name')}}</th>
                                                    <th>{{__('transfer.phone_number')}}</th>
                                                    <th>{{__('transfer.used_bank')}}</th>
                                                    <th>{{__('transfer.account_name')}}</th>
                                                    <th>{{__('transfer.transfer_time')}}</th>
                                                    <th>{{__('transfer.advertisement_number')}}</th>
                                                    <th>{{__('transfer.payment_receipt')}}</th>
                                                    <th>{{__('transfer.notes')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($transfers->where('type', 0) as $i => $transfer)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $transfer->username }}</td>
                                                        <td>{{ $transfer->phone }}</td>
                                                        <td>{{ $transfer->Bank->bankName }}</td>
                                                        <td>{{ $transfer->userBankName }}</td>
                                                        <td>{{ $transfer->date ? $transfer->date->name : '' }}</td>
                                                        <td>{{ $transfer->post_number }}</td>
                                                        <td>
                                                            @if($transfer->receiptPhoto)
                                                                <img width="150px" height="100px" src="{{ url('/public/storage/' . $transfer->receiptPhoto) }}"/>
                                                            @endif
                                                        </td>
                                                        <td>{{ $transfer->notes }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div id="navpills-21" class="tab-pane">
                                        <div class="row">
                                            <table id="datatable-colvid1" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{__('transfer.sender_name')}}</th>
                                                    <th>{{__('transfer.phone_number')}}</th>
                                                    <th>{{__('transfer.used_bank')}}</th>
                                                    <th>{{__('transfer.account_name')}}</th>
                                                    <th>{{__('transfer.transfer_time')}}</th>
                                                    <th>{{__('transfer.membership')}}</th>
                                                    <th>{{__('transfer.payment_receipt')}}</th>
                                                    <th>{{__('transfer.notes')}}</th>
                                                    <th>{{__('transfer.buttons')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($transfers->where('type', 1) as $i => $transfer)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $transfer->username }}</td>
                                                        <td>{{ $transfer->phone }}</td>
                                                        <td>{{ $transfer->Bank->bankName }}</td>
                                                        <td>{{ $transfer->userBankName }}</td>
                                                        <td>{{ $transfer->date ? $transfer->date->name : '' }}</td>
                                                        <td>{{ optional($transfer->member)->title ?? __('transfer.no_membership') }}</td>
                                                        <td>
                                                            @if($transfer->receiptPhoto)
                                                                <img width="150px" height="100px" src="{{ url('/public/storage/' . $transfer->receiptPhoto) }}"/>
                                                            @endif
                                                        </td>
                                                        <td>{{ $transfer->notes }}</td>
                                                        <td>
                                                            <a class="btn btn-info" href="{{ route('active_member', $transfer->id) }}">
                                                                @if(optional($transfer->User)->member_id === optional($transfer->member)->id)
                                                                    {{__('transfer.deactivate_membership')}}
                                                                @else
                                                                    {{__('transfer.activate_membership')}}
                                                                @endif
                                                            </a>
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
        $('#datatable-colvid').DataTable();
        $('#datatable-colvid1').DataTable();
    });
</script>
@endsection