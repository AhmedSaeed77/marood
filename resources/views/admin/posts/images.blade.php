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
                            <h4 class="m-t-0 header-title">
                                <a href="{{ route('posts.index') }}">{{ __('post_images.all_ads') }}</a> / {{ __('post_images.ad_images', ['title' => $post->title_ar]) }}
                            </h4>
                            <a class="btn btn-primary" data-toggle="modal" data-target="#add_img">{{ __('post_images.add_image') }}</a>

                            <table id="datatable-colvid" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('post_images.image') }}</th>
                                    <th>{{ __('post_images.sort') }}</th>
                                    <th>{{ __('post_images.buttons') }}</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($images as $i => $img)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td><img src="{{ url('/') }}/public/storage/{{ $img->image }}" width="60px" height="60px"/></td>
                                        <td>{{ $img->sort }}</td>
                                        <td>
                                            <a data-toggle="modal" data-target="#update_modal{{ $i }}" class="btn btn-info">{{ __('post_images.edit_section') }}</a>
                                            <div class="modal fade" id="update_modal{{ $i }}" role="dialog">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">{{ __('post_images.edit_image') }}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('update_img', $img->id) }}" method="post">
                                                                @csrf
                                                                <label>{{ __('post_images.update_sort') }}</label>
                                                                <input type="number" name="sort" value="{{ $img->sort }}" class="form-control">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="row">
                                                                <div class="col-md-6 col-lg-6">
                                                                    <button type="submit" class="btn btn-danger">{{ __('post_images.update') }}</button>
                                                                </div>
                                                                <div>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('post_images.close') }}</button>
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="" data-toggle="modal" data-target="#myModal{{ $i }}" class="btn btn-danger">{{ __('post_images.delete') }}</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal{{ $i }}" role="dialog">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">{{ __('post_images.delete') }}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ __('post_images.confirm_delete') }}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="row">
                                                                <div class="col-md-6 col-lg-6">
                                                                    <form action="{{ route('del_img', $img->id) }}" method="get">
                                                                        <button type="submit" class="btn btn-danger">{{ __('post_images.delete') }}</button>
                                                                    </form>
                                                                </div>
                                                                <div>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('post_images.close') }}</button>
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
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_img" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ __('post_images.add_image_modal') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form action="{{ route('post_add_img', $post->id) }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <input type="file" required name="file" class="form-control"/>
                            <input type="number" class="form-control" name="sort" placeholder="{{ __('post_images.image_order') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">{{ __('post_images.add') }}</button>
                    </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('post_images.close') }}</button>
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