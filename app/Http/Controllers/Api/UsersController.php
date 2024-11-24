<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\Rate;
use App\Models\User;
use App\Traits\ApiTrait;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\Concerns\Has;
use phpDocumentor\Reflection\DocBlock\Tags\Author;
use Tymon\JWTAuth\JWTAuth;

class UsersController extends Controller
{
    use ApiTrait , HelperTrait;

    public function profile(Request $request) {
//        return $request->bearerToken();
        $user = \auth('api')->user();
        return $this->sendResponse('success' , UserResource::make($user));
    }

    public function updateProfile(UpdateProfileRequest $request){
        $user = Auth::user();
        $exceptions = ['password' , 'active' , 'avatar' , 'cover'];
        $user->update($request->except($exceptions));
        if ($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $name = $this->upload($file , 'users/');
            $user->update(['avatar' => 'users/'. $name]);
        }
        if ($request->hasFile('cover')){
            $file = $request->file('cover');
            $name = $this->upload($file , 'users/' );
            $user->update(['cover' => 'users/'. $name]);
        }
        return $this->sendMessageResponse(__('Profile Updated'));
    }

    public function changePassword(Request $request){
        $data=[
            'old_password'=>$request->old_password,
            'new_password'=>$request->new_password,
        ];
        $validator=Validator::make($data,[
            'old_password'=>'required',
            'new_password'=>'required',
        ]);
        if ($validator->passes()) {
            // Validation passed
             if (Hash::check($request['old_password'] , Auth::user()->password)){
            $user = Auth::user()->update(['password' => Hash::make($request['new_password'])]);
            return $this->sendMessageResponse('Changed');
        }
        return $this->sendFailedMessage(__('site.Password InCorrect'));
        } else {
            return response()->json([
                'message'=>$validator->errors()
            ]);        }
    }


    public function visitProfile($id){
        $profile = User::find($id);
        $profile->average=$profile->userRate->avg('stars')>5?5:$profile->userRate->avg('stars');
        $profile->count=$profile->userRate->count();
        return $this->sendResponse('success' , UserResource::make($profile));
    }

    public function storeIdentity(Request $request){
        $request->validate([
            'store_identify' => 'required'
        ]);
        Auth::user()->update([
            'store_identify' => $request['store_identify']
        ]);
        return $this->sendMessageResponse(__('site.Updated User Identify'));
    }
    public function deleteAccount(){
        if(\auth('api')->check()){
            DB::beginTransaction();
            $user=User::find(\auth('api')->id());
            $postsIds=$user->user_posts()->pluck('user_posts.post_id');
            foreach ($postsIds as $id){
                Post::find($id)->delete();
            }
            $user->user_posts()->detach();
            $user->delete();
            DB::commit();
        }
        return $this->sendMessageResponse(__('site.deleted_successfully'));
    }

}
