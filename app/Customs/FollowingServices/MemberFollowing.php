<?php

namespace App\Customs\FollowingServices;

use App\Http\Resources\FollowedMembersResource;
use App\Http\Resources\UserResource;
use App\Models\Follow_user;
use App\Models\followCat;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\FollowesrResource;
class MemberFollowing
{

    public function toggleMember($id){
        $exists = Follow_user::where([
            'user_id' => Auth::user()->id,
            'follow_user_id' => $id
        ])->exists();
        if (!$exists){
            Follow_user::create([
                'user_id' => Auth::user()->id,
                'follow_user_id' => $id
            ]);
            return __("site.Member Followed");
        }else{
            Follow_user::where([
                'user_id' => Auth::user()->id,
                'follow_user_id' => $id
            ])->delete();
            return __('site.Member Unfollowed');
        }
        }




    public function members() {
        $members = Auth::user()->memberFollow;
        return FollowedMembersResource::collection($members);
    }

    public function followers() {
        $members = Auth::user()->follower;
        return FollowesrResource::collection($members);
    }



}
