<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Egyjs\Arb\Facades\Arb;
use Illuminate\Support\Facades\Validator;


class PaymentController extends Controller
{

  
    public function initiatePayment(Request $request)
    {
        
        $validator=  Validator::make($request->only('amount'), [
            'amount' => ['required', 'numeric'],

        ],[
            'amount.required' => 'amount is required',
            'amount.numeric' => 'amount is an numeric',
        ]);

        if ($validator->fails()) {
        return  response()->json(['message' => 'Validation failed', 'errors' => "يجب اضافه مبلغ العموله"], 422);

        }
       
       Arb::successUrl('https://maarod.com/api/arb/success')
       ->failUrl('https://maarod.com/api/arb/failed');
    
        $response = Arb::initiatePayment($request->amount);
        
        return  $response;
   
    }
    
    
    public function callBackUrlSuccess(){
        
          return "Success Payment";
       
    }
    
    
    
     public function callBackUrlFailed(){
        
        
        return "Failed Payment";
    
        
    }

   
}
