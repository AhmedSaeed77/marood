@extends('site.layouts.app')

@section('content')


<div class="container">
    
    <div class="card-header header-1 col-12 mt-5 mb-2">
       <p> {{ __('auth.verify_email') }}</p>
    </div>
    
         @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('auth.verification_link_sent') }}
            </div>
        @endif
    
    
    <div class="header-3 col-12 mb-2">

        <p>{{ __('auth.check_email') }}</p>
        <div class="col-12 mt-2 mb-2">
          <p>   {{ __('auth.did_not_receive_email') }}</p>
        </div>
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-primary mt-5 mb-5">{{ __('auth.request_another_link') }}</button>.
        </form> 
    </div>
    
    
</div>



<!--<div class="container mt-5 mb-5">-->
<!--    <div class="row justify-content-center">-->
<!--        <div class="col-md-12 col-sm-12">-->
<!--            <div class="card">-->
<!--                <div class="card-header">{{ __('auth.verify_email') }}</div>-->

<!--                <div class="card-body">-->
<!--                    @if (session('resent'))-->
<!--                        <div class="alert alert-success" role="alert">-->
<!--                            {{ __('auth.verification_link_sent') }}-->
<!--                        </div>-->
<!--                    @endif-->

<!--                    {{ __('auth.check_email') }}-->
<!--                    {{ __('auth.did_not_receive_email') }},-->
<!--                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">-->
<!--                        @csrf-->
<!--                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('auth.request_another_link') }}</button>.-->
<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
@endsection
