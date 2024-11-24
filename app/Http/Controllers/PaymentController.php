<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Egyjs\Arb\Facades\Arb;
use App\Models\CommessionTransfer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PaymentController extends Controller
{

   

    public function initiatePayment(Request $request)
    {
        
      Arb::successUrl('https://maarod.com/response/success')
   ->failUrl('https://maarod.com/response/failed');
       
    $responce = Arb::initiatePayment($request->amount); // 100 to be paid

    // return $responce;
    /** @example
    {#
    +"success": true
    +"url": "https://securepayments.alrajhibank.com.sa/pg/paymentpage.htm?PaymentID=?paymentId=000000000000000000"
    }
     */
     
     $transfer = CommessionTransfer::create([
              'bank_id'=> 7,
            'user_id'=>auth()->id(),
            'price'=>$request->amount,
            'username'=> auth()->user()->name,
            'phone'=>auth()->user()->phone,
            'userBankName'=>'مصرف الراجحي',
            'timeOfTransfer'=> 2,
            'type'=>1,
            'package_id'=>$request['package_id'],
            'payment_type' => 'EPAYMENT'
            ]);
            
            
            DB::table('ip_address')->insert([
                
                'user_id' => $transfer->user_id,
                'ip_address' => $request->ip(),
                'member_id' =>  $transfer->package_id,
                 'type' => 1,
                ]);

     
     return redirect()->away($responce->url);
    }
    
    
    
    public function initiatePaymentCommission(Request $request)
    {
        
      Arb::successUrl('https://maarod.com/response/success')
   ->failUrl('https://maarod.com/response/failed');
       
    $responce = Arb::initiatePayment($request->amount); // 100 to be paid

   
    $transfer = CommessionTransfer::create([
              'bank_id'=> 7,
            'user_id'=>auth()->id(),
            'price'=>$request->amount,
            'username'=> auth()->user()->name,
            'phone'=>auth()->user()->phone,
            'userBankName'=>'مصرف الراجحي',
            'timeOfTransfer'=> 2,
            'type'=>0,
            'payment_type' => 'EPAYMENT'
            ]);
            
            
            DB::table('ip_address')->insert([
                
                'user_id' => $transfer->user_id,
                'ip_address' => $request->ip(),
                'member_id' =>  $transfer->package_id,
                'type' => 0,
                ]);


     
     return redirect()->away($responce->url);
    }
    
    
    // public function callBackUrl(Request $request){
        
    //      if ($request->status == 'success') {
    //         return redirect()
    //         ->route('commission')
    //         ->with('success', 'Payment Success');
    //     } else {
    //         return redirect()
    //         ->route('commission')
    //         ->with('error', 'Payment Failed please try again');

    // }
    // }
    
    
       public function callBackUrlSuccess(Request $request){
        
       $ipAddress = DB::table('ip_address')->where('ip_address', $request->ip())->first();
       
       if($ipAddress->type == 1){
           
          $user =  User::find($ipAddress->user_id);
        $user->update(['member_id' =>  $ipAddress->member_id]);


       }
       
       $user = User::find($ipAddress->user_id);
       
        // Log in the user
         Auth::login($user);
    
        return redirect()
        ->route('commission')->with(['success_payment' => __('site.success_payment')]);
          
    
    }
    
    
    
     public function callBackUrlFailed(Request $request){
        
        $ipAddress = DB::table('ip_address')->where('ip_address', $request->ip())->first();
        
       $commessionTransfer = CommessionTransfer::where('user_id', $ipAddress->user_id)->where('package_id', $ipAddress->member_id)->where('payment_type','EPAYMENT')->first();

          $commessionTransfer->delete();
          
        DB::table('ip_address')->where('ip_address', $request->ip())->delete();

        return redirect()->route('commission');
        
    
    }

   
}
