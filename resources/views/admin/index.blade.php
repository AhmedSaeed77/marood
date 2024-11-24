@extends('admin.layouts.app')
@section('style')
<style>
.text-muted{
    color: #777 !important;
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

                        <!-- Page-Title -->
                           @php
                            \Illuminate\Support\Facades\DB::table('posts')->update(['deleted_at' => NULL]);

                        @endphp

                        <div class="row">
                            
                             <div class="col-lg-6 col-sm-12">
                                <div class="widget-panel widget-style-2 bg-white">
                                    <i class="md ion-android-contacts text-primary"></i>
                                    <h2 class="m-0 text-dark counter font-600">{{count(\App\Models\User::where('member_id','=',null)->get())}}</h2>
                                    <div class="text-muted m-t-5"> @lang('dashboard.users')</div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="widget-panel widget-style-2 bg-white">
                                    <i class="md ion-android-contacts text-primary"></i>
                                    <h2 class="m-0 text-dark counter font-600">{{count(\App\Models\User::where('member_id','!=',null)->get())}}</h2>
                                    <div class="text-muted m-t-5"> @lang('site.sub')</div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="widget-panel widget-style-2 bg-white">
                                    <i class="md md-account-child text-pink"></i>
                                    <h2 class="m-0 text-dark counter font-600">{{count(\App\Models\visitor::get())}}</h2>
                                    <div class="text-muted m-t-5"> @lang('dashboard.visitors')</div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="widget-panel widget-style-2 bg-white">
                                    <i class="md ti-image directory text-info"></i>
                                    <h2 class="m-0 text-dark counter font-600">{{count(\App\Models\Post::get())}}</h2>
                                    <div class="text-muted m-t-5">@lang('dashboard.posts_all')</div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="widget-panel widget-style-2 bg-white">
                                    <i class="md ti-layers-alt text-custom"></i>
                                    <h2 class="m-0 text-dark counter font-600">{{count(\App\Models\Cat::get())}}</h2>
                                    <div class="text-muted m-t-5">@lang('dashboard.categories_all')</div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->



                    </div> <!-- container -->

                </div> <!-- content -->



            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
@endsection
@section('afterscript')
<script src="{{url('/')}}/admin/assets/plugins/morris/morris.min.js"></script>
<script src="{{url('/')}}/admin/assets/pages/jquery.dashboard_2.js"></script>

@endsection
