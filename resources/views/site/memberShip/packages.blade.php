@extends('site.layouts.app')
@section('title')
<title>{{$member->title}}</title>
@endsection
@section('style')
<style>

</style>
@endsection
@section('content')

    <!--========================== Start paln-2 page ==========================-->
    <section class="paln-2-page">
        <div class="container">
            <div class=""><br>
            <a href="{{ url()->previous() }}">
            <button class="backButton btn-link"><svg aria-hidden="true" focusable="false"
                        data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x "
                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor"
                            d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z">
                        </path>
                    </svg></button>
</a>
                <h3 class="green"><b>{{$member->title}}</b></h3>
                <div class="">
                    <p></p>
                    @foreach($packages as $i=>$package)
                    <p><strong>@lang('site.package') {{$i+1}}:</strong> {{$package->title}} </p><br>
                    @endforeach
                    <h3>@lang('site.subscripe method')</h3><br><b>@lang('site.first method'):</b>@lang('site.You can now subscribe and pay online using the mada network.')<br><br>
                    <!--<div class="random-help-message" style="display: flex; align-items: stretch;">-->
                    <!--    <span class="icon_wrapper" style="display: flex; align-items: center; font-size: 20px; background-color: rgb(255, 249, 219); color: rgb(255, 214, 10);">-->
                    <!--        <svg-->
                    <!--            class="svg-inline--hi hi-fw" viewBox="0 0 23.683 23.683"-->
                    <!--            xmlns="http://www.w3.org/2000/svg">-->
                    <!--            <path-->
                    <!--                d="M11.841 0a11.841 11.841 0 1011.842 11.842A11.842 11.842 0 0011.841 0zm0 19.137a.94.94 0 11.94-.94.941.941 0 01-.94.94zm.943-4.534a.942.942 0 11-1.884 0v-7.8a.942.942 0 111.884 0z"-->
                    <!--                fill="currentColor"></path>-->
                    <!--        </svg>-->
                    <!--    </span>-->
                    <!--    <span class="note">@lang('site.Our client The cream, if the payment is made by (mada) or (Apple Pay), the activation will be done automatically within 24 hours A notification via the site informing you of the acceptance of the process and the subscription')</span>-->
                    <!--</div>-->
                    <br>
                    
                    <div style="margin: 5px 5px 10px; display: flex;">
                        
                        
                        <!--<a class="btn-lg btn-success height_reset" href="#">-->
                        
                        <!--<span style="margin-left: 3px;">@lang('site.pay with mada')</span><svg-->
                        <!--        aria-hidden="true" focusable="false" data-prefix="fas" data-icon="credit-card"-->
                        <!--        class="svg-inline--fa fa-credit-card fa-w-18 fa-1x " role="img"-->
                        <!--        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">-->
                        <!--        <path fill="currentColor"-->
                        <!--            d="M0 432c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V256H0v176zm192-68c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H204c-6.6 0-12-5.4-12-12v-40zm-128 0c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM576 80v48H0V80c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48z">-->
                        <!--        </path>-->
                        <!--    </svg>-->
                            
                        <!--    </a>-->
                        
                          {{-- start elraghy transfer--}}
                           <form  method="post" action="{{route('payment-initiate')}}">
                           <input type="hidden" name="package_id" value="{{$member->id}}"/>

                            @csrf
                            <img style="width: 200px;height: 200px" src="{{asset('public/payment/elraghy.jpg')}}">
                           
                            <h1>{{$member->title}}</h1>
                            <p>@lang('site.elraghy')</p>
            
                              
                                
                                 <div class="form-group"><label>@lang('site.Subscription Amount'):</label><select class="form-control form-control-size-md" name="amount">
                                @foreach($member->packages as $package)
                                    <option value="{{$package->price}}">{{$package->price}}</option>
                                @endforeach
                            </select>
                             </div>
            
                            <button type="submit" class="btn btn-primary-alt btn-xlg mb-3">@lang('site.send_pay')</button>
                            
                                           
                        </form>
            
                       {{-- end elraghy transfer--}}
                
                            
                            </div>
                            
                            
                            <br>
                                
                                
                                @lang('site.The second method :')</b> @lang('site.Subscription and payment by bank transfer.')
                    <h3 class="green"><b>@lang('site.Bank transfers')</b></h3>@lang('site.Subscription steps'):<br><b>@lang('site.The first step'):</b> @lang('site.Transfer the subscription amount to our bank accounts shown in') <a href="{{url('/')}}/commission">
                        @lang('site.commission transfer page')</a>.<br><br><b>@lang('site.The second step'):</b> @lang('site.After transferring the subscription amount, the following form must be completed'):<br>
                </div><br>
                 <div class="member-plan-form">
                      @if ($errors->any())
                <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form method="post" action="{{route('user.store.transfer')}}" name="postform" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="1"/>
                    <input type="hidden" name="package" value="{{$member->id}}"/>

                        <h3>@lang('site.Subscription Transfer Form')</h3>
                        <div class="form-group"><label>@lang('site.mobile'):</label><input class="form-control form-control-size-sm" placeholder="@lang('site.mobile')" name="mobile" type="text" value="" required></div>
                        <div class="form-group"><label> @lang('site.username'):</label><input class="form-control form-control-size-sm" placeholder="@lang('site.username')" name="name" type="text" value="{{Auth::check()?auth::user()->name:''}}"></div>
                        <!--<div class="form-group"><label>@lang('site.Subscription Amount'):</label><input class="form-control form-control-size-sm" placeholder="@lang('site.Subscription Amount')" type="number" name="price" value="2500" required></div>-->
                        
                           <div class="form-group"><label>@lang('site.Subscription Amount'):</label><select class="form-control form-control-size-md" name="price">
                                @foreach($member->packages as $package)
                                    <option value="{{$package->price}}">{{$package->price}}</option>
                                @endforeach
                            </select>
                             </div>
                        <div class="form-group"><label>@lang('site.Transfer to bank'):</label><select class="form-control form-control-size-md" name="bank">
                                <option value="">@lang('site.Choose the bank name')</option>
                                @foreach($banks as $bank)
                                <option value="{{$bank->id}}">{{$bank->bankName}}</option>
                                @endforeach
                            </select>
                             @error('bank')
                        <span>{{$message}}</span>
                        @enderror
                            </div>
                        <div class="form-group"><label>@lang('site.date transfer')</label><select class="form-control form-control-size-md" required name="datetransfer">
                                <option value="" selected disabled>-- @lang('site.choose') --</option>
                                @foreach($dates as $date)
                                <option value="{{$date->id}}">{{$date->name}}</option>
                                 @endforeach
                            </select>
                             @error('datetransfer')
                        <span>{{$message}}</span>
                        @enderror</div>
                        <!--    <div class="form-group"><label>@lang('site.post number') :</label><input type="text" class="form-control form-control-size-md" name="link" value="" required>-->
                        <!--     @error('link')-->
                        <!--<span>{{$message}}</span>-->
                        <!--@enderror</div>-->
                        <div class="form-group"><label>@lang('site.sender name'):</label><input class="form-control form-control-size-md" placeholder="@lang('site.sender name')" required name="moneysender" type="text" value="">
                        @error('moneysender')
                        <span>{{$message}}</span>
                        @enderror
                        </div>
                         <div class="form-group"><label>@lang('site.A copy of the transfer receipt'):</label><input class="form-control form-control-size-md" required name="image" type="file" value="">
                        @error('image')
                        <span>{{$message}}</span>
                        @enderror
                        </div>
                        <div class="form-group"><label>@lang('site.notes'):</label><textarea class="form-control form-control-size-lg" name="message" cols="6" rows="5"></textarea>
                        </div>
                        <p>@lang('site.We hope that the information is correct and accurate')</p><button type="submit" class="btn btn-primary-alt btn-xlg">@lang('site.sent')</button>&nbsp;&nbsp;
                    </form><br>
                    
           
                
                </div>
                
                
            </div>
            
            
        </div>
        
        
     
    </section>
    
    
  
        
      
  
            

    <!--========================== End paln-2 page ==========================-->


@endsection