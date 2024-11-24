<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class BlacklistController extends Controller
{
    use ApiTrait;


    public function check(Request $request){
        $request->validate(['user' => 'required']);

            $user = User::where('name', $request['user'])->where('phone',$request['phone'])->first();
            $status = 201;

            if($user){
                if($user->active ==2){
                    $black=__('site.The account or mobile number is in the blacklist');
                    $status = 200;
                }else{
                    $black=__('site.The account or mobile number is not in the blacklist');
                }
            }else{
                $black=__('site.user not found');
                $status = 202;
            }
            return response()->json([
                'status' => 'true',
                'message' => $black
            ] , $status);
    }
}
