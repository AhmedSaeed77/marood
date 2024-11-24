<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\setting;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    use ApiTrait;

    public function index() {
        $settings = setting::get(['id' , 'slug' , 'name' , 'value']);
        return $this->sendResponse('success' , $settings);
    }
    
      public function paymentStatus()
    {

        $setting = setting::query()->where('name','Payment')->select('id','name','value')->first();

        $data['payment_status'] = (int)$setting->value;
        return $this->sendResponse('success' , $data);
    }
    
    
    
     public function versions(){

        $version = setting::query()->where('name','version')->select('id','name','value')->first();
        $androidUrl = setting::query()->where('name','android_url')->select('id','name','value')->first();
        $iosUrl = setting::query()->where('name','ios_url')->select('id','name','value')->first();



        $data['version']       =   $version->value;
        $data['android_url'] =   $androidUrl->value;
        $data['ios_url']  =   $iosUrl->value;


        
        return $this->sendResponse('success' , $data,200);
    }
}
