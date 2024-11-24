<?php

namespace App\Customs\FollowingServices\Members;

use App\Http\Resources\FollowedMembersResource;
use App\Models\Follow_user;
use App\Models\followCat;
use Illuminate\Support\Facades\Auth;

class MemberFollowing
{

    public function followMember($id){
        $exists = Follow_user::where([
            'user_id' => Auth::user()->id,
            'follow_user_id' => $id
        ])->exists();
        if (!$exists){
            Follow_user::create([
                'user_id' => Auth::user()->id,
                'follow_user_id' => $id
            ]);
            return "Member Followed";
        }
        return "Already Followed";

    }

    public function members() {
        $members = Auth::user()->memberFollow;
        return FollowedMembersResource::collection($members);
    }


    public function membersUnFollow($id) {
        Follow_user::find($id)->delete();
        return 'Member Unfollowed';
    }

}
