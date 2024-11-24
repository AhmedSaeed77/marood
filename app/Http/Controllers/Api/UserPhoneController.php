<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhoneRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserPhone;
use App\Traits\ApiTrait;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;

class UserPhoneController extends Controller
{    use ApiTrait , HelperTrait;

    public function store(PhoneRequest $request){
        $phones=User::find($request->user_id)->phones;
       $user = auth('api')->user();
        $user->update(['phone' => $request->number[0]]);
        foreach ($phones as $phone){
            UserPhone::where('id',$phone->id)->delete();
        }
        foreach ($request->number as $number){
                UserPhone::create(
                    [
                        'user_id'=>$request->user_id,
                        'number'=>$number,
                    ]
                );
            }

        return $this->sendResponse('success' , __('site.number_added_success'));

    }
    public function update(PhoneRequest $request){
        
            $user = auth('api')->user();
            $user->update(['phone' => $request->number]);
            UserPhone::where('id',$request->number_id)->update(
                [
                    'number'=>$request->number,
                ]
            );
        return $this->sendResponse('success' , __('site.number_updated_success'));

    }
}
