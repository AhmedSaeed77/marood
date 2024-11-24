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
                  
                          
                            <div class="col-md-12">
                            <div class="card-box" >
                         <form action="#" method="post">
                                     @csrf
                                     @foreach($all_roles as $role)
                                        <div class="form-group">
                                            <lable class="col-md-12" > {{$role->name}} </lable>
                                        </div>
                                      @if(!empty($role->permissions))
                                        @foreach($role->permissions as $perm)
                                        <div class="form-group">
                                        <lable>{{$perm->name}}</lable>
                                      
                                        </div>
                                        @endforeach
                                    @endif
                                    @endforeach
                           
                         </form> 
                         </div> 
                         </div>
                    </div>
                    </div>
                </div>
            </div>
@endsection