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
                         <form action="{{route('assign.Role',$user->id)}}" method="post">
                                     @csrf
                                     @foreach($all_roles as $role)
                                        <div class="form-group">
                                            <lable class="col-md-4" > {{$role}} </lable>
                                            <input type="radio" name="role"{{$user->hasRole($role)?'checked':''}} value="{{$role}}">

                                        </div>
                                    @endforeach
                               <div>
                               <button type="submit" class="btn btn-primary">@lang('users.add_role')</button>
                               </div>
                         </form> 
                         </div> 
                         </div>
                    </div>
                    </div>
                </div>
            </div>
@endsection