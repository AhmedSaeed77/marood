<?php

namespace App\Http\Controllers;

use App\Http\Resources\RatesResource;
use App\Models\User;
use App\Models\user_rate;
use App\Traits\ApiTrait;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Collection;

class RatingsController extends Controller
{
    use ApiTrait , HelperTrait;
    public function store(Request $request , $id){
        $request->validate([
            'notes' => 'required',
            'stars' => 'required',
            'recommend' => 'required',
            'rate_type' => 'required'
        ]);

        if (Auth::user()->id == $id)
            return $this->sendMessageResponse('cant rate Your Self');
        $name = null;
        if ($request->hasFile('image')){
            $file = $request->image;
            $name = $this->upload($file , 'rates/');
        }
        $rating = user_rate::where([
            'user_id' => Auth::user()->id,
            'rate_for_userid' => $id,
        ])->first();
        if (!$rating){
            user_rate::create([
                'user_id' => Auth::user()->id,
                'rate_for_userid' => $id,
                'notes' => $request['notes'],
                'stars' => $request['stars'],
                'rate_type' => $request['rate_type'],
                'recommend' => $request['recommend'],
                'image' => $name
            ]);
        }else{
            $rating->update([
                'notes' => $request['notes'] ,
                'stars' => $request['stars'] ,

                'rate_type' => $request['rate_type'],
                'recommend' => $request['recommend'],
                'image' => $name
            ]);
        }

        return $this->sendMessageResponse('rated');

    }
    public  function getAllRates($id){
            $user=User::find($id);
            if($user){
                $user_rates=$user->userRate;
                $data=RatesResource::collection($user_rates);
                //return $user_name;
                return $this->sendResponse('all user rates',$data);
            }else{
                return $this->sendFailedMessage('user not found');
            }

            //return $user;
    }
}
