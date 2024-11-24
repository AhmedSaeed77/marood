<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Block;
use App\Models\User;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    use ApiTrait;
    public  function index(){
        $blocked_users=Block::where('user_id',auth('api')->user()->id)->with('user')->get();
        $users=$blocked_users->map(function ($blockeduser){
            return $blockeduser->user;
        });
        return $this->sendResponse('success' , UserResource::collection($users));
    }
    public  function store($id){
        $user=User::find($id);
        if($user->alreadyBlocked()){
            return $this->sendMessageResponse(__('site.user_blocked_before'));
        }else{
            if ($id==auth('api')->user()->id){
                return $this->sendMessageResponse("لا يمكنك حظر نفسك");
            }else{
                Block::create([
                    'user_id'=>auth('api')->user()->id,
                    'blocked_id'=>$user->id
                ]);
                return $this->sendMessageResponse(__('site.user_blocked_successfully'));
            }
        }
    }
    public function destroy($id){
        Block::where('user_id',auth('api')->user()->id)
            ->where('blocked_id',$id)->delete();
        return $this->sendMessageResponse(__('site.user_un_blocked_successfully'));
    }
}
