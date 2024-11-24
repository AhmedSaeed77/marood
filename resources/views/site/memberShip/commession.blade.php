
@extends('site.layouts.app')
@section('title')
<title>@lang('site.Calculation and payment of the site commission')</title>
@endsection
@section('style')
<style>
body{
    background-color: rgb(242, 244, 250);

}
</style>
@endsection
@section('content')

  <!--========================== Start commission page ==========================-->
   <section class="commission-page">
        <div class="container">
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($message = Session::get('success_payment'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>

                </div>
            @endif
            <!--<a href="{{ url()->previous() }}">-->
            <!--<button class="backButton btn-link" style="background-color: rgb(242, 244, 250);">-->
            <!--    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path>-->
            <!--    </svg>-->
            <!--</button>-->
            <!--   </a>-->
               
               
               
                 {{-- start elraghy transfer--}}
            <form class="mb-5" id="com_form" method="post" action="{{route('payment-initiate-commission')}}">
                @csrf
                <img style="width: 200px;height: 200px" src="{{asset('public/payment/elraghy.jpg')}}">
               
                <h1>@lang('site.elraghy_commission')</h1>
                <p>@lang('site.elraghy')</p>

                    <div class="input_wrapper small">
                        <label>@lang('site.Commission amount')* :</label>
                        <input min="1" type="number" name="amount" size="20" maxlength="60" value="20" required="required">
                        
                                            

                    </div>

                <button type="submit">@lang('site.elraghy_commission')</button>
                
                               


            </form>

            {{-- end elraghy transfer--}}
            <div class="row">
                <div class="col-md-6 info">
                    <div class="main_text">
                        <h1>@lang('site.Sell your product with a commission') {{$setting->where('name','cmshn')->first()->value}}% <br>@lang('site.just in') {{App::getLocale()=='ar'?$setting->where('name','SiteName')->first()->value:$setting->where('name','SiteNameEn')->first()->value}}</h1>
                        <p>@lang('site.whether the pledge is made for')<br>@lang('site.The route of the site or because of it, and its value is set out below')</p>
                        <a href="#cal_wrapper" class="btn btn-primary-alt smoothscroll">@lang('site.Commission account')
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-left" class="svg-inline--fa fa-arrow-left fa-w-14 fa-1x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z"></path>
                            </svg>
                        </a>
                        <div class="paymentOptions">
                            {{--
                            <img src="{{url('/')}}/public/site/assets/img/mada.png">
                            --}}
                            <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="apple-pay" class="svg-inline--fa fa-apple-pay fa-w-20 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M116.9 158.5c-7.5 8.9-19.5 15.9-31.5 14.9-1.5-12 4.4-24.8 11.3-32.6 7.5-9.1 20.6-15.6 31.3-16.1 1.2 12.4-3.7 24.7-11.1 33.8m10.9 17.2c-17.4-1-32.3 9.9-40.5 9.9-8.4 0-21-9.4-34.8-9.1-17.9.3-34.5 10.4-43.6 26.5-18.8 32.3-4.9 80 13.3 106.3 8.9 13 19.5 27.3 33.5 26.8 13.3-.5 18.5-8.6 34.5-8.6 16.1 0 20.8 8.6 34.8 8.4 14.5-.3 23.6-13 32.5-26 10.1-14.8 14.3-29.1 14.5-29.9-.3-.3-28-10.9-28.3-42.9-.3-26.8 21.9-39.5 22.9-40.3-12.5-18.6-32-20.6-38.8-21.1m100.4-36.2v194.9h30.3v-66.6h41.9c38.3 0 65.1-26.3 65.1-64.3s-26.4-64-64.1-64h-73.2zm30.3 25.5h34.9c26.3 0 41.3 14 41.3 38.6s-15 38.8-41.4 38.8h-34.8V165zm162.2 170.9c19 0 36.6-9.6 44.6-24.9h.6v23.4h28v-97c0-28.1-22.5-46.3-57.1-46.3-32.1 0-55.9 18.4-56.8 43.6h27.3c2.3-12 13.4-19.9 28.6-19.9 18.5 0 28.9 8.6 28.9 24.5v10.8l-37.8 2.3c-35.1 2.1-54.1 16.5-54.1 41.5.1 25.2 19.7 42 47.8 42zm8.2-23.1c-16.1 0-26.4-7.8-26.4-19.6 0-12.3 9.9-19.4 28.8-20.5l33.6-2.1v11c0 18.2-15.5 31.2-36 31.2zm102.5 74.6c29.5 0 43.4-11.3 55.5-45.4L640 193h-30.8l-35.6 115.1h-.6L537.4 193h-31.6L557 334.9l-2.8 8.6c-4.6 14.6-12.1 20.3-25.5 20.3-2.4 0-7-.3-8.9-.5v23.4c1.8.4 9.3.7 11.6.7z"></path>
                            </svg>
                            <img src="{{url('/')}}/public/site/assets/img/visa_master.png">
                        </div>
                    </div>
                </div>
                <div class="hero_video_wrapper col-md-6"></div>
            </div>
            <div class="sections_wrapper">
                <div class="row">
                    @foreach($comissions as $com)
                    <div class="col-lg-4 col-md-6">
                        <div class="dev_card">
                            <span class="icons_wrapper">
                        <img alt="house icon" loading="lazy" height="35" width="35" src="{{url('/')}}/public/storage/{{$com->Cat->photo??'cats/other.gif'}}">
                    </span>
                            <h4>{{$com->name}}</h4>
                          <?php echo $com->desc?>
                        </div>
                    </div>
                   
                    @endforeach
                </div>
            </div>
            <div class="sub_wrapper">
            @foreach($memberships as $member)
                <div class="content">
                    <span>
                        <span class="icons_wrapper">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="id-badge" class="svg-inline--fa fa-id-badge fa-w-12 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M336 0H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48zM144 32h96c8.8 0 16 7.2 16 16s-7.2 16-16 16h-96c-8.8 0-16-7.2-16-16s7.2-16 16-16zm48 128c35.3 0 64 28.7 64 64s-28.7 64-64 64-64-28.7-64-64 28.7-64 64-64zm112 236.8c0 10.6-10 19.2-22.4 19.2H102.4C90 416 80 407.4 80 396.8v-19.2c0-31.8 30.1-57.6 67.2-57.6h5c12.3 5.1 25.7 8 39.8 8s27.6-2.9 39.8-8h5c37.1 0 67.2 25.8 67.2 57.6v19.2z"></path>
                            </svg>
                        </span>
                    </span>
                    <strong>@lang('site.for subscripe with') {{$member->title}}</strong>
                    <a href="{{route('member',$member->id)}}">@lang('site.enterHere')</a>
                </div>
                @endforeach
            </div>
            <br>
            <div id="cal_wrapper">
                <h1>@lang('site.Commission account')</h1>
                <div class="cal_contnet">
                    <div class="com_input_wrapper">
                        <span>@lang('site.Enter the selling price')</span>
                        <input type="hidden"name="commission" id="commession" value="{{$setting->where('name','cmshn')->first()->value}}">
                        <input type="number" id="comm" name="total" maxlength="15" autocorrect="off" inputmode="numeric" autocomplete="off" placeholder="15000" value="" class="text-center">
                    </div>
                    <div class="output_wrapper">
                        <span class="labal">@lang('site.Commission payable')</span>
                        <span class="result" id="totalAmount">
                            <span id="resCom">0</span>
                        <span class="currency">@lang('site.ryal')</span>
                        <span id="more_info_logo" data-toggle="modal" data-target="#infoModal">
                                <svg class="svg-inline--hi " viewBox="0 0 45.512 68.269" xmlns="http://www.w3.org/2000/svg"><path d="M6.851 39.007a10.265 10.265 0 012.9 7.349 5.664 5.664 0 005.657 5.658h14.695a5.664 5.664 0 005.657-5.658 10.267 10.267 0 012.9-7.349 22.548 22.548 0 006.851-16.251 22.756 22.756 0 00-45.512 0 22.549 22.549 0 006.852 16.251zm24.032 16.258h-16.25a1.626 1.626 0 00-1.626 1.626v2.182a8.128 8.128 0 002.377 5.75l2.02 2.02a4.878 4.878 0 003.449 1.429h3.809a4.876 4.876 0 003.447-1.428l2.024-2.021a8.13 8.13 0 002.381-5.748v-2.183a1.626 1.626 0 00-1.631-1.627zm-8.017-21.026a2.731 2.731 0 01-2.731-2.731V13.194a2.732 2.732 0 012.731-2.731 2.731 2.731 0 012.731 2.731v18.313a2.731 2.731 0 01-2.731 2.732zm2.762 6.556a2.762 2.762 0 11-2.762-2.762 2.762 2.762 0 012.762 2.762z" fill="currentColor"></path>
                                </svg>
                            </span>
                        </span>
                    </div>
                    <br>
                </div>
                {{--
                <h3 id="payOptions">@lang('site.Payment method')</h3>
                <h5 id="optionOne">
                    <span>@lang('site.first method')</span>
                    <!--<strong>@lang('site.Mada card')</strong>-->
                </h5>
                <p class="greenAlert">
                    <svg class="svg-inline--hi " viewBox="0 0 23.683 23.683" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.841 0a11.841 11.841 0 1011.842 11.842A11.842 11.842 0 0011.841 0zm0 19.137a.94.94 0 11.94-.94.941.941 0 01-.94.94zm.943-4.534a.942.942 0 11-1.884 0v-7.8a.942.942 0 111.884 0z" fill="currentColor"></path>
                    </svg>@lang('site.If payment is made (mada), the commission will be activated in your account automatically within 24 hours (the transfer form does not need to be filled out)')
                </p>
                <div class="btnWrapper">
                    <a class="payBtn mada" href="#">
                        <span>@lang('site.Click here to pay with')</span>
                        <span class="pay_btn_icon_wrapper">
                            <img src="{{url('/')}}/public/site/assets/img/mada.png">
                            <img src="{{url('/')}}/public/site/assets/img/visa_master.png">
                        </span>
                    </a>
                </div>
                --}}
            </div>
            <div class="secondOptionWrapper">
                <h5 id="optionTwo">
                    <span>@lang('site.The second method :')</span>
                    <strong>@lang('site.Bank transfer')</strong>
                </h5>
                <p class="YellowAlert">
                    <svg class="svg-inline--hi " viewBox="0 0 23.683 23.683" xmlns="http://www.w3.org/2000/svg"><path d="M11.841 0a11.841 11.841 0 1011.842 11.842A11.842 11.842 0 0011.841 0zm0 19.137a.94.94 0 11.94-.94.941.941 0 01-.94.94zm.943-4.534a.942.942 0 11-1.884 0v-7.8a.942.942 0 111.884 0z" fill="currentColor"></path>
                    </svg>@lang('site.Pay by bank transfer to one of the following accounts, then fill in')
                    <a href="#com_form">@lang('site.Transfer Form')</a> @lang('site.And wait a week for activation.')
                </p>
            </div>
            <div class="banks_details_wrapper">
             @foreach($banks as $bank)
                <div class="bank_details">
                    <img src="{{url('/')}}/public/storage/{{$bank->bank_photo}}" class="logo">
                    <span class="labal">{{$bank->bankName}}</span>
                    <span class="number">{{$bank->accountnumber}}</span>
                    <span class="labal">@lang('site.Iban')</span>
                    <span class="iban">{{$bank->Iban}}</span>
                    <span class="name">{{$bank->userNameBank}}</span>
                </div>
             @endforeach
            </div>
            <form id="com_form" method="post" action="{{route('user.add.transfer')}}" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="type" value="0"/>
                <h1>@lang('site.Commission Transfer Form')</h1>
                <p>@lang('site.form in order to register the commission in the name of your membership and then obtain the site is features for customers')</p>
                <div class="field_wrapper">
                    <div class="input_wrapper small">
                        <label>@lang('site.username')* :</label>
                        <input type="text" name="name" required="" value="{{Auth::check()?auth::user()->name:''}}">
                    </div>
                    <div class="input_wrapper small">
                        <label>@lang('site.Commission amount')* :</label>
                        <input type="number" name="price" size="20" maxlength="60" required="" value="0">
                    </div>
                    <div class="input_wrapper small">
                        <label>@lang('site.Transfer to bank')* :</label>
                        <select name="bank" required="">
                            <option value="">@lang('site.Choose the bank name')</option>
                            @foreach($banks as $bank)
                                 <option value="{{$bank->id}}">{{$bank->bankName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input_wrapper small">
                        <label>@lang('site.date transfer') :</label>
                        <select name="datetransfer" required>
                          <option value="" selected disabled>@lang('site.choose')</option>
                          @foreach($dates as $date)
                                <option value="{{$date->id}}">{{$date->name}}</option>
                         @endforeach
                        </select>
                    </div>
                    <div class="input_wrapper small">
                        <label>@lang('site.sender name') * :</label>
                        <input type="text" name="moneysender" required="" value="">
                    </div>
                    <div class="input_wrapper small">
                        <label>@lang('site.The mobile number associated with your membership ')*:</label>
                        <input type="text" name="mobile" required="" value="">
                    </div>
                    <div class="input_wrapper small">
                        <label>@lang('site.post number') :</label>
                        <input type="text" name="link" value="" required>
                    </div>
                    <div class="input_wrapper large">
                        <label>@lang('site.notes') :</label>
                        <textarea name="message" rows="1" id="message"></textarea>
                        <small>@lang('site.Please ensure that the transfer information is correct and accurate')</small>
                    </div>
                </div>
                <div class="img_upload">
                    <div class="input_wrapper small">
                        <label>@lang('site.A copy of the transfer receipt') </label>
                        <input type="file" id="img_def_uploader" name="image"  accept="image/*" required>
                    </div>
                </div>
                <button type="submit">@lang('site.sent')</button>
                <?php $page=\App\Models\footerPages::where('link','payment-policy')->first();?>
                @if($page !=null)
                <a id="pay_terms_btn" href="{{url('/')}}/footer/{{$page->id}}/page/{{$page->link}}">{{$page->name}}</a>
                @endif
            </form>
            
        
        </div>
    </section>


    <!--========================== End commission page ==========================-->
@endsection
@section('script')
<script>
$(document).ready(function(){
var com=$('#commession').val();
$("#comm").keyup(function(){
   var price=$(this).val();
   var res=Math.floor((com*price)/100);
  $('#resCom').html(res);
});
});
</script>
@endsection