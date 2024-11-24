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
                            <h4 class="m-t-0 header-title"><b>{{ __('posts.posts') }}</b></h4>
                            <p class="text-muted font-13 m-b-30"></p>
                            <div class="panel-body">
                                <ul class="nav nav-pills m-b-30">
                                    <li class="active">
                                        <a href="#navpills-11" data-toggle="tab" aria-expanded="true">{{ __('posts.new_unactivated_posts') }}</a>
                                    </li>
                                    <li class="">
                                        <a href="#navpills-12" data-toggle="tab" aria-expanded="false">{{ __('posts.activated_posts') }}</a>
                                    </li>
                                </ul>
                                <div class="tab-content br-n pn">
                                    <div id="navpills-11" class="tab-pane active">
                                        <div class="row">
                                            <table id="datatable-colvid" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>{{ __('posts.ad_number') }}</th>
                                                    <th>{{ __('posts.name_ar') }}</th>
                                                    <th>{{ __('posts.name_en') }}</th>
                                                    <th>{{ __('posts.ad_owner') }}</th>
                                                    <th>{{ __('posts.ad_location') }}</th>
                                                    <th>{{ __('posts.category') }}</th>
                                                    <th>{{ __('posts.price') }}</th>
                                                    <th>{{ __('posts.commission') }}</th>
                                                    <th>{{ __('posts.details') }}</th>
                                                    <th>{{ __('posts.contact_method') }}</th>
                                                    <th>{{ __('posts.deactivation_reason') }}</th>
                                                    <th>{{ __('posts.buttons') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($posts->where('active',0) as $i=>$post)
                                                    <tr id="{{$post->id}}">
                                                        <td>{{$post->id}}</td>
                                                        <td>{{$post->title_ar}}</td>
                                                        <td>{{$post->title_en}}</td>
                                                        <td>{{$post->post_user->User->name}}</td>
                                                        <td>{{$post->area_id != null?$post->area->name_ar:''}}</td>
                                                        <td>{{$post->Cat->name_ar}}</td>
                                                        <td>{{$post->price}}</td>
                                                        <td>{{$post->commission ?? '0'}}</td>
                                                        <td>{{substr($post->description, 0, 1000)}}</td>
                                                        <td>{{$post->contact == 0 ? $post->post_user->User->phone : 'الرسيال الخاصة'}}</td>
                                                        <td>{{$post->why_unactive}}</td>
                                                        <td class="text-center">
                                                            <a href="{{route('posts.edit',$post->id)}}" class="btn btn-info">{{ __('posts.edit') }}</a>
                                                            <a href="{{route('posts.images',$post->id)}}" class="btn btn-default">{{ __('posts.ad_images') }}</a>
                                                            <a href="{{route('posts.active',$post->id)}}" class="btn btn-primary mt-1">{{ $post->active == 0 ? __('posts.activate') : __('posts.deactivate') }}</a>
                                                            <a href="{{route('posts.enable.comment',$post->id)}}" class="btn btn-primary">{{ $post->comment == 1 ? __('posts.disable_comments') : __('posts.enable_comments') }}<a>
                                                                    <a data-toggle="modal" data-target="#del_post{{$i}}" class="btn btn-danger">{{ __('posts.delete') }}</a>
                                                                    <a href="{{route('posts.is_pay',$post->id)}}" class="btn btn-default">{{ $post->is_pay == 0 ? __('posts.confirm_payment') : __('posts.cancel_payment') }}</a>
                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="del_post{{$i}}" role="dialog">
                                                                        <div class="modal-dialog modal-sm">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">{{ __('posts.delete_confirmation') }} {{$post->title}}</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    {{ __('posts.confirm_delete') }} {{$post->title}}!?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6 col-lg-6">
                                                                                            <form action="{{route('del_post',$post->id)}}" method="get">
                                                                                                <button type="submit" class="btn btn-danger">{{ __('posts.delete_button') }}</button>
                                                                                            </form>
                                                                                        </div>
                                                                                        <div>
                                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('posts.close_button') }}</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <a href="{{route('posts.show.comment',$post->id)}}" class="btn btn-info">{{ __('posts.comments') }}<a>
                                                                            @if($post->Cat->parent_id == 2 || ($post->Cat->parent != null && $post->Cat->parent->parent_id == 2))
                                                                                <br>
                                                                                <a href="{{route('posts.edit.map',$post->id)}}" class="btn btn-default">{{ __('posts.edit_map_location') }}</a>
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
                                                    <th>{{ __('posts.ad_number') }}</th>
                                                    <th>{{ __('posts.name_ar') }}</th>
                                                    <th>{{ __('posts.name_en') }}</th>
                                                    <th>{{ __('posts.ad_owner') }}</th>
                                                    <th>{{ __('posts.ad_location') }}</th>
                                                    <th>{{ __('posts.category') }}</th>
                                                    <th>{{ __('posts.price') }}</th>
                                                    <th>{{ __('posts.commission') }}</th>
                                                    <th>{{ __('posts.details') }}</th>
                                                    <th>{{ __('posts.contact_method') }}</th>
                                                    <th>{{ __('posts.buttons') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($posts->where('active',1) as $i=>$post)
                                                    <tr id="{{$post->id}}">
                                                        <td>{{$post->id}}</td>
                                                        <td>{{$post->title_ar}}</td>
                                                        <td>{{$post->title_en}}</td>
                                                        <td>{{$post->post_user->User->name}}</td>
                                                        <td>{{$post->area_id != null ? $post->area->name_ar : ''}}</td>
                                                        <td>{{$post->Cat->name_ar}}</td>
                                                        <td>{{$post->price}}</td>
                                                        <td>{{$post->commission ?? '0'}}</td>
                                                        <td>{{substr($post->description, 0, 1000)}}</td>
                                                        <td>{{$post->contact == 0 ? $post->post_user->User->phone : 'الرسيال الخاصة'}}</td>
                                                        <td class="text-center">
                                                            <a href="{{route('posts.edit',$post->id)}}" class="btn btn-info">{{ __('posts.edit') }}</a>
                                                            <a href="{{route('posts.images',$post->id)}}" class="btn btn-default">{{ __('posts.ad_images') }}</a>
                                                            <a data-toggle="modal" data-target="#unActive{{$i}}" class="btn btn-primary mt-1">{{ __('posts.deactivate') }}</a>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="unActive{{$i}}" role="dialog">
                                                                <div class="modal-dialog modal-sm">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <h4 class="modal-title">{{ __('posts.deactivate') }} {{$post->title}}</h4>
                                                                        </div>
                                                                        <form action="{{route('posts.active',$post->id)}}" method="get">
                                                                            <div class="modal-body">
                                                                                <input type="text" name="reason" class="form-control" />
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <div class="row">
                                                                                    <div class="col-md-6 col-lg-6">
                                                                                        <button type="submit" class="btn btn-danger">{{ __('posts.deactivate') }}</button>
                                                                                    </div>
                                                                                    <div>
                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('posts.close_button') }}</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="{{route('posts.enable.comment',$post->id)}}" class="btn btn-primary">{{ $post->comment == 1 ? __('posts.disable_comments') : __('posts.enable_comments') }}<a>
                                                                    <a data-toggle="modal" data-target="#del_post{{$i}}" class="btn btn-danger">{{ __('posts.delete') }}</a>
                                                                    <a href="{{route('posts.is_pay',$post->id)}}" class="btn btn-default">{{ $post->is_pay == 0 ? __('posts.confirm_payment') : __('posts.cancel_payment') }}</a>
                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="del_post{{$i}}" role="dialog">
                                                                        <div class="modal-dialog modal-sm">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">{{ __('posts.delete_confirmation') }} {{$post->title}}</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    {{ __('posts.confirm_delete') }} {{$post->title}}!?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6 col-lg-6">
                                                                                            <form action="{{route('del_post',$post->id)}}" method="get">
                                                                                                <button type="submit" class="btn btn-danger">{{ __('posts.delete_button') }}</button>
                                                                                            </form>
                                                                                        </div>
                                                                                        <div>
                                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('posts.close_button') }}</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <a href="{{route('posts.show.comment',$post->id)}}" class="btn btn-info">{{ __('posts.comments') }}<a>
                                                                            @if($post->Cat->parent_id == 2 || ($post->Cat->parent != null && $post->Cat->parent->parent_id == 2))
                                                                                <br>
                                                                                <a href="{{route('posts.edit.map',$post->id)}}" class="btn btn-default">{{ __('posts.edit_map_location') }}</a>
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


<script>
    $(document).ready(function() {
        $('#datatable-colvid').DataTable();
                $('#datatable-colvid1').DataTable();

    });
</script>
@endsection