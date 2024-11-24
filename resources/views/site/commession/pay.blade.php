@extends('site.layouts.app')
@section('title')
<title>@lang('site.Membership authentication')</title>
@endsection
@section('style')
<style>
body{
    background-color:#F2F4FA;
}
</style>
@endsection
@section('content')

  <!-- ===================== start payment page ======================== -->
  <section class="payment-page">
        <div class="container">
            <div class="com_pay_wrapper">
                <div class="indicator_wrapper">
                    <span class="point active">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="credit-card" class="svg-inline--fa fa-credit-card fa-w-18 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M0 432c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V256H0v176zm192-68c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H204c-6.6 0-12-5.4-12-12v-40zm-128 0c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM576 80v48H0V80c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48z"></path>
                        </svg>
                    </span>
                    <span class="point ">
                        <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="file-check" class="svg-inline--fa fa-file-check fa-w-12 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M369.941 97.941l-83.882-83.882A48 48 0 0 0 252.118 0H48C21.49 0 0 21.49 0 48v416c0 26.51 21.49 48 48 48h288c26.51 0 48-21.49 48-48V131.882a48 48 0 0 0-14.059-33.941zm-22.627 22.628a15.89 15.89 0 0 1 4.195 7.431H256V32.491a15.88 15.88 0 0 1 7.431 4.195l83.883 83.883zM336 480H48c-8.837 0-16-7.163-16-16V48c0-8.837 7.163-16 16-16h176v104c0 13.255 10.745 24 24 24h104v304c0 8.837-7.163 16-16 16zm-34.467-210.949l-134.791 133.71c-4.7 4.663-12.288 4.642-16.963-.046l-67.358-67.552c-4.683-4.697-4.672-12.301.024-16.985l8.505-8.48c4.697-4.683 12.301-4.672 16.984.024l50.442 50.587 117.782-116.837c4.709-4.671 12.313-4.641 16.985.068l8.458 8.527c4.672 4.709 4.641 12.313-.068 16.984z"></path>
                        </svg>
                    </span>
                    <div class="active_line" style="width: 0%;"></div>
                </div>
                <div class="h-card">
                
                    <a href="{{ url()->previous() }}" class="btn btn-borderless h-back-btn">
                        <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-circle-right" class="svg-inline--fa fa-arrow-circle-right fa-w-16 fa-2x " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" color="#0973C0"><path fill="currentColor" d="M8 256c0 137 111 248 248 248s248-111 248-248S393 8 256 8 8 119 8 256zM256 40c118.7 0 216 96.1 216 216 0 118.7-96.1 216-216 216-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216zm12.5 92.5l115.1 115c4.7 4.7 4.7 12.3 0 17l-115.1 115c-4.7 4.7-12.3 4.7-17 0l-6.9-6.9c-4.7-4.7-4.7-12.5.2-17.1l85.6-82.5H140c-6.6 0-12-5.4-12-12v-10c0-6.6 5.4-12 12-12h190.3l-85.6-82.5c-4.8-4.7-4.9-12.4-.2-17.1l6.9-6.9c4.8-4.7 12.4-4.7 17.1 0z"></path>
                        </svg>
                    </a>
              
                    <form class="payment_form_wrapper">
                        <div class="h_input_wrapper">
                            <label for="amount">@lang('site.Commission amount')</label>
                            <span class="addon_wrapper">
                                <input class="h_input INWI" id="amount" name="amount" placeholder="100" type="number" addonafter="ريال">
                                <span class="addon after">@lang('site.ryal')</span>
                            </span>
                        </div>
                        <div class="h_input_wrapper">
                            <label for="post_id">@lang('site.Post Number')</label>
                            <input class="h_input" id="post_id" name="post_id" placeholder="60000000 (اختياري)">
                        </div>
                        <div class="h_input_wrapper">
                            <label>@lang('site.Use a card registered in the browser')</label>
                            <button type="button" class="h-btn h-btn-xl" id="gPayBtn">
                                <span>@lang('site.use')</span>
                                <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" class="svg-inline--fa fa-google fa-w-16 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512"><path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="h_input_wrapper">
                            <label for="frmNameCC">@lang('site.The name as it appears on the card')</label>
                            <input class="h_input" placeholder="Abdul Aziz Kabalan" type="text" name="ccname" id="frmNameCC" autocomplete="cc-name">
                        </div>
                        <div class="h_input_wrapper">
                            <label for="frmCCNum">@lang('site.card number')</label>
                            <input class="h_input" placeholder="425xxxxxxx" required="" autocomplete="cc-number" autocorrect="off" spellcheck="false" id="frmCCNum" name="cardnumber" aria-label="Credit or debit card CVC/CVV" aria-placeholder="CVC" aria-invalid="false" type="text"
                                inputmode="numeric">
                        </div>
                        <div class="exp_cvc_wrapper">
                            <div class="h_input_wrapper">
                                <label>@lang('site.Expire Date')</label>
                                <div class="exp_wrapper">
                                    <input class="h_input INWI" type="number" id="cc-exp-year" name="cc-exp-year" autocomplete="cc-exp-year" x-autocompletetype="cc-exp-year" placeholder="2025">
                                    <input class="h_input INWI" type="number" id="cc-exp-month" name="cc-exp-month" autocomplete="cc-exp-month" x-autocompletetype="cc-exp-month" placeholder="05">
                                </div>
                            </div>
                            <div class="h_input_wrapper">
                                <label for="frmCCCVC">@lang('site.Verification code')(CVC)</label>
                                <input class="h_input" type="text" name="cvc" id="frmCCCVC" required="" autocomplete="cc-csc" placeholder="123">
                                <small>@lang('site.The last three numbers on the back of the card')</small>
                            </div>
                        </div>
                        <button type="submit" class="h-btn h-btn-xl h-btn-primary">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="credit-card" class="svg-inline--fa fa-credit-card fa-w-18 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M0 432c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V256H0v176zm192-68c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H204c-6.6 0-12-5.4-12-12v-40zm-128 0c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM576 80v48H0V80c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48z"></path>
                            </svg>
                            <span>@lang('site.pay')</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ===================== End payment page ======================== -->


@endsection

@section('script')

@endsection
